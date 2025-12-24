<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\About;
use App\Models\User;
use App\Models\Partner;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\Subscribe;
use App\Models\Service;
use App\Models\Gallery;
use App\Models\Counter;
use App\Models\Notice;
use Illuminate\Support\Carbon;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status',1)->latest()->get();
        $about = About::where('status', 1)->latest()->first();
        $teams = Team::orderBy('id','ASC')->where('status',1)->latest()->get();
        $testimonials = Testimonial::where('status',1)->latest()->get();
        $counters = Counter::where('status',1)->latest()->get();
        $services = Service::where('status',1)->latest()->get();
        $gallerys  = Gallery::where('status',1)->latest()->get();
        $partners  = Partner::where('status',1)->latest()->get();
        $notices = Notice::where('status', 1)->orderBy('date', 'desc')->get();
        $pageTitle = 'Best Bikers Club Bangladesh';


        return view('frontend.index',compact('sliders','about','teams','counters','services','gallerys','pageTitle','partners','notices'));
    }

    /* =========== SINGLE STUDY ABROAD SHOW ===========*/
    public function SingleStudy($slug){
        $singleStudy = StudyAbroad::where('status',1)->where('slug',$slug)->first();
        $studys = StudyAbroad::where('status',1)->latest()->get();
        $pageTitle = $singleStudy->country_name;
        return view('frontend.study.singleStudy',compact('singleStudy','pageTitle','studys'));

    }

    /* =========== SINGLE EDUCATION SHOW ===========*/
    public function SingleEducation($slug){
        $singleEducation = Education::where('status',1)->where('slug',$slug)->first();
        $educations = Education::where('status',1)->latest()->get();
        $pageTitle = $singleEducation->course_name;
        return view('frontend.education.singleEducation',compact('singleEducation','pageTitle','educations'));

    }

    /* =========== SINGLE TOURIST SHOW ===========*/
    public function SingleTourist($slug){
        $singleVisa = Visa::where('status',1)->where('slug',$slug)->first();
        $tourist_visas = Visa::where('visa_type',1)->where('status',1)->latest()->get();
        $work_visas = Visa::where('visa_type',2)->where('status',1)->latest()->get();
        $pageTitle = $singleVisa->country_name;
        return view('frontend.visa.singleVisa',compact('singleVisa','pageTitle','tourist_visas','work_visas'));

    }

    /* =========== SINGLE SERVICE SHOW ===========*/
    public function SingleService($slug){
        $singleService = Service::where('status',1)->where('slug',$slug)->first();
        $pageTitle = $singleService->title;
        $services = Service::where('status',1)->latest()->get();
        return view('frontend.service.singleService',compact('singleService','pageTitle','services'));

    }

    /* =========== SINGLE PRODUCT SHOW ===========*/
    public function SingleProduct($slug){
        $singleProduct = Product::where('status',1)->where('slug',$slug)->first();
        $pageTitle = $singleProduct->title;
        $products = Product::where('status',1)->latest()->get();
        return view('frontend.product.singleProduct',compact('singleProduct','pageTitle','products'));

    }

    /* =========== SINGLE UMRAH  SHOW ===========*/
    public function SingleUmrah($slug){
        $singleUmrah = UmrahTour::where('type',1)->where('status',1)->where('slug',$slug)->first();
        $pageTitle = $singleUmrah->name;
        $umrahs = UmrahTour::where('type',1)->where('status',1)->latest()->get();
        return view('frontend.umrahtour.singleUmrah',compact('singleUmrah','pageTitle','umrahs'));

    }

    /* =========== SINGLE TOUR  SHOW ===========*/
    public function SingleTour($slug){
        $singleTour = UmrahTour::where('type',2)->where('status',1)->where('slug',$slug)->first();
        $pageTitle = $singleTour->name;
        $tours = UmrahTour::where('type',2)->where('status',1)->latest()->get();
        return view('frontend.umrahtour.singleTour',compact('singleTour','pageTitle','tours'));

    }

    

    /* =========== ALL STUDY ABROAD S-OW ===========*/
    public function StudyAll(){
        $studys = StudyAbroad::where('status',1)->latest()->get();
        $first_studys = StudyAbroad::where('status',1)->first();
        $pageTitle = 'All Study Abroad';
        return view('frontend.study.all_study',compact('pageTitle','studys','first_studys'));

    }

    /* =========== ALL EDUCATION SHOW ===========*/
    public function EducationAll(){
        $educations = Education::where('status',1)->latest()->get();
        $first_educations = Education::where('status',1)->first();
        $pageTitle = 'All Educations';
        return view('frontend.education.all_education',compact('pageTitle','educations','first_educations'));

    }

    /* =========== ALL TOURIST VISA SHOW ===========*/
    public function TouristAll(){
        $visas = Visa::where('visa_type',1)->where('status',1)->latest()->get();
        $first_visa = Visa::where('visa_type',1)->where('status',1)->first();
        $pageTitle = 'All Tourist Visa';
        return view('frontend.visa.all_tourist_visa',compact('pageTitle','visas','first_visa'));

    }

    /* =========== ALL WORK PARMIT VISA SHOW ===========*/
    public function WorkparmitAll(){
        $visas = Visa::where('visa_type',2)->where('status',1)->latest()->get();
        $first_visa = Visa::where('visa_type',2)->where('status',1)->first();
        $pageTitle = 'All Work Parmit Visa';
        return view('frontend.visa.all_parmit_visa',compact('pageTitle','visas','first_visa'));

    }

    /* =========== ALL OUR SERVICES SHOW ===========*/
    public function ServiceAll(){
        $services = Service::where('status',1)->latest()->get();
        $first_service = Service::where('status',1)->first();
        $pageTitle = 'All Our Services';
        return view('frontend.service.all_services',compact('pageTitle','services','first_service'));

    }

    /* =========== ALL OUR PRODUCT SHOW ===========*/
    public function ProductAll(){
        $products = Product::where('status',1)->latest()->get();
        $first_product = Product::where('status',1)->first();
        $pageTitle = 'All Our Products';
        return view('frontend.product.all_products',compact('pageTitle','products','first_product'));

    }

    /* =========== ALL AGENT ALL SHOW ===========*/
    public function AgentAll(){
        $agents = User::where('status',1)->latest()->get();
        $pageTitle = 'All Our Agent';
        return view('frontend.agent.all_agent',compact('pageTitle','agents'));

    }


    
    

    


    /* =========== IELTS STORE STUDENT DATA ===========*/
    public function IeltStore(Request $request)
    {
        // dd($request->all());

        Ielt::create([
            'first_name'            => $request->first_name,
            'last_name'             => $request->last_name,
            'phone'                 => $request->phone,
            'email'                 => $request->email,
            'birth_day'             => $request->birth_day,
            'school_name'           => $request->school_name,
            'school_passing_year'   => $request->school_passing_year,
            'school_gpa'            => $request->school_gpa,
            'collage_name'          => $request->collage_name,
            'collage_passing_year'  => $request->collage_passing_year,
            'collage_gpa'           => $request->collage_gpa,
            'department'            => $request->department,
            'subject'               => $request->subject,
            'country'               => $request->country,
            'proficiency'           => $request->proficiency,
            'study_type'            => $request->study_type,
            'address'               => $request->address,
            'village'               => $request->village,
            'thana'                 => $request->thana,
            'district'              => $request->district,
            'message'               => $request->message
        ]);

        flash()->addSuccess("Student Information Store Successfully.");
        $url = 'page/'.$request->page_name;
        return redirect($url);
    }

    /*=================== Start SubsStore Methoed ===================*/
    public function SubsStore(Request $request){
        $subscriber = Subscribe::where('email', $request->email)->first();
        if($subscriber == null){
            $subscriber = new Subscribe;
            $subscriber->email = $request->email;
            $subscriber->created_at = Carbon::now();
            $subscriber->save();

            flash()->addSuccess("You have subscribed successfully.");
            return redirect()->back();
        }else{
          
            flash()->addError("You are  already a subscriber.");
            return redirect()->back();
        }
    }
    /*=================== End SubsStore Methoed ===================*/

    

}
