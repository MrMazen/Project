<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function index()
    {
       $usertype = Auth::user()->usertype;
       if ($usertype == 1) {
           return view('admin.index');

       }else{
        return view('home');
       }
    }


    public function delete_all(Request $request)
    {

        $delete_all_id = explode(",", $request->delete_all_id);
        Room::whereIn('id', $delete_all_id)->Delete();
        session()->flash('edit','تم الحذف بنجاح');
        return redirect()->route('room.index');

    }

}
