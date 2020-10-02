<?php

namespace App\Http\Controllers\Admin;

use App\Address;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    // public function get($code='')
    // {
    // return Address::where('_code','Like',"${code}__")->orderBy('_name_en')->get()->pluck('_code','_name_en');
    // }
    public function index(Request $request)
    {
        return Address::where('_code','Like',$request->code."__")
        ->orderBy('_name_en')
        ->pluck('_code','_name_en');

    }

    // public function test(){
    // // return Address::where('_code','01')->select('_type_kh')->get();
    // // return 'dfgr';
    // dd('hfjghf');
    // }


}
