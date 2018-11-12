<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.index');
    }



    public function show($name)
    {
        $purchaser =  User::where('name', preg_replace("/-/", ' ',$name))->get();

        if(auth()->check() && auth()->user()->id == $purchaser->first()->id || auth()->user()->is_admin){

            return view('dashboard.show', compact('purchaser'));

        }else{

            flash()->overlay('Opps!','Unauthorized action', 'error');
            return redirect()->route('dashboard');
        }


    }

}
