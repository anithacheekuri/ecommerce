<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use Session;
use Mail;

use Illuminate\Support\Facades\Log;

class Signin extends Controller
{

   public function __construct()
    { 
   // $this->middleware('test');
    }
      ###TODO THIS IS LOGON METHOD
   


   // admin dashboard 

   public function dashboard(Request $request){

   $producuts = product::take('3')->get();

  
      //$producuts = DB::table('producuts')->get();

      return view('shopping',['producuts'=>$producuts]);

   }

   
  


  public function logout(Request $request){

   $request->session()->forget('user');

   return redirect('signin');

   }

   public function producut(Request $request){

       
      return view('home2')->with('userdata',$request->session()->get('user'));
   
      }
}
