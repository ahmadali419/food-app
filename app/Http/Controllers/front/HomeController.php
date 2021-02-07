<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Item;
use App\Ratting;
use App\Slider;
use App\Banner;
use App\About;
use App\Contact;
use App\User;
use App\Pincode;
use App\Package;
use Session;
use Validator;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $getslider = Slider::all();
                     $getpackages =    new Package;
                     $user_id  = Session::get('id');
        $getpackage = $getpackages->limit('5')->where(['is_available'=>0])->get();
        // dd($getpackage);
        $getSubscribepackages = $getpackages->join('subscription_request as sr', 'sr.user_id','=','sr.user_id')
        ->join('users as u','u.id','=','sr.user_id')
        ->join('packages as p','p.package_id','=','sr.product_id')
        ->select('sr.*', 'u.*','p.*')
        ->where(['sr.user_id'=>$user_id,'status'=>'Request Approved'])
        ->orderBy('sr.id', 'asc')
        ->groupBy('sr.id')
        ->get();
    //   dd($getSubscribepackages);exit;
        $getcategory = Category::where('is_available','=','1')->get();
        $getabout = About::where('id','=','1')->first();
        
        $getitem = Item::with(['category','itemimage'])->select('item.cat_id','item.id','item.item_name','item.item_price','item.item_description',DB::raw('(case when favorite.item_id is null then 0 else 1 end) as is_favorite'))
        ->leftJoin('favorite', function($query) use($user_id) {
            $query->on('favorite.item_id','=','item.id')
            ->where('favorite.user_id', '=', $user_id);
        })
        ->where('item.item_status','1')
        ->orderby('cat_id')->get();
        $getreview = Ratting::with('users')->get();

        $getbanner = Banner::orderby('id','desc')->get();
        return view('front.home', compact('getslider','getcategory','getSubscribepackages','getpackage','getabout','getitem','getreview','getbanner'));
    }

    public function contact(Request $request)
    {
        if($request->firstname == ""){
            return response()->json(["status"=>0,"message"=>"First name is required"],200);
        }
        if($request->lastname == ""){
            return response()->json(["status"=>0,"message"=>"Last name is required"],200);
        }
        if($request->email == ""){
            return response()->json(["status"=>0,"message"=>"Email is required"],200);
        }
        if($request->message == ""){
            return response()->json(["status"=>0,"message"=>"Message is required"],200);
        }
        $category = new Contact;
        $category->firstname =$request->firstname;
        $category->lastname =$request->lastname;
        $category->email =$request->email;
        $category->message =$request->message;
        $category->save();

        if ($category) {
            return response()->json(['status'=>1,'message'=>'Your message has been successfully sent.!'],200);
        } else {
            return response()->json(['status'=>2,'message'=>'Something went wrong.'],200);
        }
    }

    public function checkpincode(Request $request)
    {

        $getdata=User::select('min_order_amount','max_order_amount')->where('type','1')
        ->get()->first();

        if($request->postal_code != ""){
            $pincode=Pincode::select('pincode')->where('pincode',$request->postal_code)
                        ->get()->first();
            if(@$pincode['pincode'] == $request->postal_code) {
                if(!empty($pincode))
                {
                    if ($getdata->min_order_amount > $request->order_total) {
                        return response()->json(['status'=>0,'message'=>"Order amount must be between ".env('CURRENCY')."".$getdata->min_order_amount." and ".env('CURRENCY')."".$getdata->max_order_amount.""],200);
                    } elseif ($getdata->max_order_amount < $request->order_total) {
                        return response()->json(['status'=>0,'message'=>"Order amount must be between ".env('CURRENCY')."".$getdata->min_order_amount." and ".env('CURRENCY')."".$getdata->max_order_amount.""],200);
                    } else {
                        return response()->json(['status'=>1,'message'=>'Pincode is available for delivery'],200);
                    }                
                }
            } else {
                return response()->json(['status'=>0,'message'=>'Delivery is not available in your area'],200);
            }
        } else {
            
            if ($getdata->min_order_amount > $request->order_total) {
                return response()->json(['status'=>0,'message'=>"Order amount must be between ".env('CURRENCY')."".$getdata->min_order_amount." and ".env('CURRENCY')."".$getdata->max_order_amount.""],200);
            } elseif ($getdata->max_order_amount < $request->order_total) {
                return response()->json(['status'=>0,'message'=>"Order amount must be between ".env('CURRENCY')."".$getdata->min_order_amount." and ".env('CURRENCY')."".$getdata->max_order_amount.""],200);
            } else {
                return response()->json(['status'=>1,'message'=>'Ok'],200);
            }   
        }
    }
}
