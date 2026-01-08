<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //Welcome Page layout
    public function home(Request $request)  {

         return view("home.layout");
    }   
    
    //About Page linked externally
    public function aboutExternal(Request $request) {
        return view("home.about_external");
}

  public function about(Request $request) {
        return view("home.about");
}


//Course Handling
 public function courseExternal(Request $request) {

    return view("home.course_external");

 }

 
 public function course(Request $request) {

    return view("home.course");

 }

 //Trainsers Management
 public function trainerExternal(Request $request) {
    
    return view('home.trainer_external');
 }

 public function trainer(Request $request) {
    
    return view('home.trainer');
 }


 //Events Handling
  public function events(Request $request) {
    
    return view('home.event');

 }

 //Pricing Section
  public function pricing(Request $request) {
    
    return view('home.pricing');

 }

  //Pricing Section
  public function contact(Request $request) {
    
    return view('home.contact');

 }

}