<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Package;
use App\PackageCategory;
use App\About;
use App\Addons;
use Session;
use Validator;
use App\Item;
class PackagesController extends Controller
{
    
    public function index()
    {
        return view('packages');
    }
    public function show(Request $request)
    {
        $getpackages = Package::where('is_available','=','0')->get();
        
        $getpackage = Package::where(['package_id'=>$request->id,'is_available'=>'0'])->get();
        

       
        $getabout = About::where('id','=','1')->first();
        $user_id  = Session::get('id');
        $subsRequest = DB::table('subscription_request')->where('user_id',Session::get('id'))->get();
 
        return view('front.packages', compact('getpackages','getpackage','getabout','subsRequest'));
       
                // print_r($getabout);exit;

  
        
       
    }

    public function packageDetails(Request $request)
    {  
        $user_id  = Session::get('id');
        $getitem = Item::with('category')->select('item.*', DB::raw('(case when favorite.item_id is null then 0 else 1 end) as is_favorite'))
        ->leftJoin('favorite', function ($query) use ($user_id) {
            $query->on('favorite.item_id', '=', 'item.id')
            ->where('favorite.user_id', '=', $user_id);
        })->where('item.id', '=', 4)->first();

        // print_r($getitem);exit;
        $getabout = About::where('id', '=', '1')->first();
        $packages = Package::with("categories")->where(['package_id'=>$request->id])->get();
        // dd($packages->toArray());
        // $getPackage = Package::where('package_id',$request->id)->first();
        // $getPackageDetail = DB::table('packages as p')
        //     ->join('package_category as pc', 'p.package_id', '=', 'pc.package_id')
        //     ->select('pc.*', 'p.*')
        //     ->where(['p.package_id'=>$request->id,'pc.package_id'=>$request->id])
        //     ->get();
        $freeaddons = Addons::select('id', 'name', 'price')->where('item_id', '=', $request->id)->where('is_available', '=', '1')->where('price', '=', '0')->get();
        $subsRequest = DB::table('subscription_request')->where('user_id',Session::get('id'))->get();
        $paidaddons = Addons::select('id', 'name', 'price')->where('item_id', '=', $request->id)->where('is_available', '=', '1')->where('price', '!=', "0")->get();

            return view('front.package-details', compact('packages', 'getabout','subsRequest','freeaddons','paidaddons','getitem'));

    //    echo "<pre>"; dd($packages);exit;
       
    }
    public function status(Request $request)
    {
        // print_r($request->user_id);exit;
        $package = Package::where(['package_id'=>$request->id])->update( array('is_available'=>$request->status) );
        if ($package) {
           
            return 1;
        } else {
            return 0;
        }
    }
}
