<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if($request->user()->roles->first()->name == "Sales"){
            return view('sales.home');
        }
        else if($request->user()->roles->first()->name == "Admin"){
            return view('Admin.Home');
        }
        else if($request->user()->roles->first()->name == "Warehouse"){
            return view('Warehouse.home');
        }
        else if($request->user()->roles->first()->name == "Super Admin"){
            return view('Superadmin.home');
        }
        else{
            return view('Cashier.home');
        }
    }
}
