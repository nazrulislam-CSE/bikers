<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Menuitem;
use App\Models\Category;
use App\Models\Page;
use Session;

class MenuBuilderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request)
{
    $desiredMenu = '';
    $data['menus'] = Menu::where('type', 'megaMenu')->get();

    if ($request->menu && $request->menu != 'new') {
        $desiredMenu = Menu::where('id', $request->menu)->first();

        // সব লেভেলের menu item লোড করা হচ্ছে
        $menuitems = Menuitem::with('subMenus.childMenus')
            ->where('menu_id', $desiredMenu->id)
            ->orderBy('position', 'asc')
            ->get();

        $data['menuitems'] = $menuitems->whereNull('parent_id'); // শুধু parent গুলো view-তে দেখানোর জন্য

        // সব লেভেলের page_id collect করার জন্য
        $addedPages = collect();

        foreach ($menuitems as $item) {
            if ($item->page_id) {
                $addedPages->push($item->page_id);
            }

            foreach ($item->subMenus as $sub) {
                if ($sub->page_id) {
                    $addedPages->push($sub->page_id);
                }

                foreach ($sub->childMenus as $child) {
                    if ($child->page_id) {
                        $addedPages->push($child->page_id);
                    }
                }
            }
        }

        $data['addedPages'] = $addedPages->unique()->toArray();
    } else {
        $data['menuitems'] = collect(); // empty collection for consistency
        $data['addedPages'] = [];
    }

    $data['categories'] = Category::with('subcategory')
        ->whereNull('parent_id')
        ->where('status', 1)
        ->get();

    $data['pages'] = Page::where('status', 1)->get();
    $data['desiredMenu'] = $desiredMenu;

    $data['pageTitle'] = 'Menu Builder';

    return view('admin.menu.menu-builder')->with($data);
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       if (Menu::count() >= 3) {
          flash()->addError("You are only allowed to create 3 menus.");
          return redirect()->back();
      }
        $menu = new Menu();

        $menu->name = $request->name;
        $menu->slug = strtolower(trim(preg_replace('/\s+/', '-', $request->name)));
        $menu->type = 'megaMenu';
        $menu->save();
        $menu->save();
        
        if($menu){ 
            flash()->addSuccess("Menu Created Successfully.");  
            $url = route('admin.menuBuilder')."?menu=".$menu->id;        
            return redirect($url);
        }else{
            flash()->addError("Failed to save menu !.");
            return redirect()->back();
        }
    }

    public function addItemToMenu(Request $request){
      $menuid = $request->menuid;
      $ids = $request->ids;
      // dd($ids);
      $menu = Menu::findOrFail($menuid);
      // dd($menu);
      if($menu){
        if($request->sourch == 'category'){
          if($request->ids && count($request->ids)>0){
            foreach($ids as $id){
              $category = Category::where('id',$id)->first();
              $menuItem = new Menuitem();
              $menuItem->title_en = $category->name_en;
              $menuItem->title_bn = $category->name_bn;
              $menuItem->url = 'category/'.$category->slug;
              $menuItem->sourch = 'category';
              $menuItem->parent_id = null;
              $menuItem->location = $menu->location;
              $menuItem->menu_id = $menuid;
              $menuItem->save();
            }
          }
          if($request->subids && count($request->subids)>0){
          
            foreach($request->subids as $id){
              $category = Category::where('id',$id)->first();
              $menuItem = new Menuitem();
              $menuItem->title_en = $category->name_en;
              $menuItem->title_bn = $category->name_bn;
              $menuItem->url = 'category/'.$category->slug;
              $menuItem->sourch = 'sub-category';
              $menuItem->parent_id = null;
              $menuItem->location = $menu->location;
              $menuItem->menu_id = $menuid;
              $menuItem->save();
            }
          }
  
          if($request->childids && count($request->childids)>0){
          
            foreach($request->childids as $id){
              $category = Category::where('id',$id)->first();
              $menuItem = new Menuitem();
              $menuItem->title_en = $category->name_en;
              $menuItem->title_bn = $category->name_bn;
              $menuItem->url = 'category/'.$category->slug;
              $menuItem->sourch = 'category';
              $menuItem->parent_id = null;
              $menuItem->location = $menu->location;
              $menuItem->menu_id = $menuid;
              $menuItem->save();
            }
          }
        
        }elseif ($request->sourch == 'page') {
            foreach ($ids as $index => $id) {
                $page = Page::where('id', $id)->first();
                // dd($page);

                // Check if a Menuitem with the same URL and menu_id already exists
                $exists = Menuitem::where('menu_id', $menuid)
                    ->where('url', $page->page_slug)
                    ->exists();

                if ($exists) {
                    flash()->addError("The page '{$page->page_title}' is already added to the menu.");
                    return redirect()->back();
                }

                if (!$exists) {
                    // Get the max position for the current menu
                    $maxPosition = Menuitem::where('menu_id', $menuid)->max('position');
                    $newPosition = $maxPosition ? $maxPosition + 1 : 1;

                    // Create and save new menu item
                    $menuItem = new Menuitem();
                    $menuItem->title = $page->page_title;
                    $menuItem->url = $page->page_slug;
                    $menuItem->sourch = 'page';
                    $menuItem->parent_id = null;
                    $menuItem->location = $menu->location;
                    $menuItem->position = $newPosition;
                    $menuItem->menu_id = $menuid;
                    $menuItem->page_id = $page->id;
                    $menuItem->save();
                }
            }
        }
        elseif($request->sourch == 'banner'){
            foreach($ids as $id){
              $banner = Banner::where('id',$id)->first();
              $menuItem = new Menuitem();
              $menuItem->title = $banner->title;
              $menuItem->url = $banner->id;
              $menuItem->sourch = 'banner';
              $menuItem->parent_id = null;
              $menuItem->menu_id = $menuid;
              $menuItem->save();
            }
        }else{
          // Check if a custom MenuItem with the same URL already exists for this menu
          $exists = Menuitem::where('menu_id', $menuid)
              ->where('url', $request->url)
              ->exists();

          if ($exists) {
              flash()->addError("The custom link '{$request->url}' is already added to the menu.");
              return redirect()->back();
          }

          if (!$exists) {
              $menuItem = new Menuitem();

              // Find the maximum position value for non-custom links
              $maxPosition = Menuitem::where('menu_id', $menuid)
                  ->where('sourch', '!=', 'custom')
                  ->max('position');

              $position = $maxPosition ? $maxPosition + 1 : 1;

              $menuItem->title = $request->link;
              $menuItem->url = $request->url;
              $menuItem->sourch = 'custom';
              $menuItem->parent_id = null;
              $menuItem->location = $menu->location;
              $menuItem->menu_id = $menuid;
              $menuItem->position = $position;
              $menuItem->save();
          }
        }

      }else{
          flash()->addError("Menu not found!.");
          return redirect()->route('admin.menuBuilder');
      }
      flash()->addSuccess("Menu Updated Successfully.");  
      return redirect()->back();
    }
    

      public function createMenu(Request $request){
          $menu = Menu::find($request->menuid);
          $menu->location = $request->location;
          $menu->save();

          flash()->addSuccess("Set Menu Created Location Successfully.");
      }

      public function updateMenu(Request $request){

          $menu = Menu::find($request->menuid);
          $menu->location = $request->location;
          $menu->save();

          flash()->addSuccess("Set Menu Location Updated Successfully.");  
          $menuItemOrder = json_decode($request->input('itemids'));
          $this->orderMenu($menuItemOrder, null); 
        }
      
        private function orderMenu(array $menuItems, $parentId)
        {
          foreach ($menuItems as $index => $menuItem) {
              $item = MenuItem::findOrFail($menuItem->id);
              $item->position = $index + 1;
              $item->parent_id = $parentId;
              $item->save();
              //if set child re-call function
              if(isset($menuItem->children)) {
                $this->orderMenu($menuItem->children, $item->id);
              }
          }
        }


       public function updateMenuItem(Request $request, $id){

        $item = Menuitem::find($id);
        // dd($item);

        if(!$request->title){
          flash()->addError("Title Field Required."); 
          return redirect()->back();
        }

        $item->title = $request->title;
        $item->url = ($request->url) ? $request->url : $item->url ;
        $item->save();

        flash()->addSuccess("Set Menu Item Updated Successfully."); 
        return redirect()->back();
      }

      /**
       * Display the specified resource.
       */
      public function show(string $id)
      {
          //
      }

      /**
       * Show the form for editing the specified resource.
       */
      public function edit(string $id)
      {
          //
      }

      /**
       * Update the specified resource in storage.
       */
      public function update(Request $request, string $id)
      {
          //
      }

      public function deleteMenuItem($id){        
          $menuitem = Menuitem::where('id',$id)->delete();
          if($menuitem ){
          $output = [
                  'status' => true,
                  'msg' => 'Item deleted successfully.'
              ];
          }else{
              $output = [
                  'status' => false,
                  'msg' => 'Item cannot deleted.'
              ];
            }
          return response()->json($output);
        } 

      /**
       * Remove the specified resource from storage.
       */
      public function destroy(string $id)
      {
          Menuitem::where('menu_id',$id)->delete();  
        Menu::findOrFail($id)->delete();
        flash()->addSuccess("Menu Permanently Deleted Successfully.");
        return redirect()->route('menuBuilder');
      }
  }
