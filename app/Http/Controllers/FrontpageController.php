<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Property;
use App\Models\SubCategory;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Post;

class FrontpageController extends Controller
{
    
    public function index()
    {
      
   
        $properties     = Property::latest()->where('featured',1)->with('rating')->withCount('comments')->take(8)->get();
        $services       = Service::orderBy('service_order')->get();
        $testimonials   = Testimonial::latest()->get();
        $posts          = Post::latest()->where('status',1)->take(6)->get();
        $sliders        = Slider::latest()->get();
        
        $category=SubCategory::orderBy('name')->get();
        return view('frontend.index', compact('sliders','properties','services','testimonials','posts','category'));
    }

  public  function indexMobile($id){
     $properties     = Property::latest()->where('featured',1)->with('rating')->withCount('comments')->take(8)->get();
        $services       = Service::orderBy('service_order')->get();
        $testimonials   = Testimonial::latest()->get();
        $posts          = Post::latest()->where('status',1)->take(6)->get();
        $sliders        = Slider::latest()->get();
        return view('frontend.indexMobile', compact('sliders','properties','services','testimonials','posts','id'));
  }
    public function search(Request $request)
    {
        $city     = strtolower($request->city);
        $type     = $request->type;
        $purpose  = $request->purpose;
        $bedroom  = $request->bedroom;
        $bathroom = $request->bathroom;
        $minprice = $request->minprice;
        $maxprice = $request->maxprice;
        $minarea  = $request->minarea;
        $maxarea  = $request->maxarea;
        $featured = $request->featured;

        $properties = Property::latest()->withCount('comments')
                             
                                ->when($type, function ($query, $type) {
                                    return $query->where('type', '=', $type);
                                })
                                ->when($purpose, function ($query, $purpose) {
                                    return $query->where('purpose', '=', $purpose);
                                })
                                ->when($minprice, function ($query, $minprice) {
                                    return $query->where('price', '>=', $minprice);
                                })
                                ->when($maxprice, function ($query, $maxprice) {
                                    return $query->where('price', '<=', $maxprice);
                                })
                                ->when($featured, function ($query, $featured) {
                                    return $query->where('featured', '=', 1);
                                })
                                ->paginate(10); 

        return view('pages.search', compact('properties'));
    }

public function cd(Request $request){
dd($request->file);
}


public function propertyCategory($slug)
{
  $category=SubCategory::where('slug',$slug)->first();
  return view('pages.properties.propert-category',compact('slug','category'));
}



}
