<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Post;

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
        $data = Order::with('client')->latest()->take(5)->get();
        $data2 = Order::with('client')->latest()->take(5)->get();
        $designers = User::role('Designer')->with('posts')->get();
        return view('home', ['data' => $data,  'data2' => $data2, 'designers'=> $designers])->with('i', ($request->input('page', 1) - 1) * 5);;
    }
}
