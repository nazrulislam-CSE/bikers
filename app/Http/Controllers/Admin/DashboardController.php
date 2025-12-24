<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;   
use App\Models\Page;   
use App\Models\Menuitem;    
use App\Models\Team;   
use App\Models\Testimonial;   
use App\Models\Setting;   
use App\Models\Menu;   
use App\Models\Slider;   
use App\Models\About;     
use App\Models\User;  
use App\Models\Admin;  
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    public function index()
    {
        $pageTitle    = 'Dashboard';
        $sections     = Section::latest()->get();   
        $pages        = Page::latest()->get();   
        $menuitems    = Menuitem::latest()->get();   
        $teams        = Team::latest()->get();   
        $testimonials = Testimonial::latest()->get();   
        $settings     = Setting::latest()->get();   
        $menus        = Menu::latest()->get();   
        $sliders      = Slider::latest()->get();   
        $abouts       = About::latest()->get();   

        // Check if the public/storage symlink exists
        if (!File::exists(public_path('storage'))) {
            // Create the symlink
            app('files')->link(storage_path('app/public'), public_path('storage'));
        }

        return view('admin.dashboard.index', compact('pageTitle', 'sections', 'pages','menuitems','menus','testimonials','teams','sections','settings','sliders','abouts'));
    }
}
