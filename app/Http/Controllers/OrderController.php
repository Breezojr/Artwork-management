<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;



class OrderController extends Controller
{ 

    public function index(Request $request)
    {
        
        $data = Order::with('user')->get();
        
        return view('orders.index',compact('data'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        $designers = User::all();
        // $designers = User::role('Designer')->get();

        return view('orders.orders', ['designers'=>$designers]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'note' => 'required',
            'user_id' => 'required',
            'client_name' => 'required',
            'email' => 'required',
            'phon_no' => 'required',
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|array',
            'image.*' => 'mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $imgData = [];
        if(count($request->image)) {
            foreach($request->image as $file) {
                $path = '/images/orders';
                $date = Carbon::now();
                $filename = hash('MD5', time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
                $tempName = env('APP_URL') . '/storage' . $path . '/'. $date->year.'/' . $filename;
                $filePath = $path . "/$date->year";
                $file->storeAs($filePath, $filename, 'public');
                $imgData[] = $tempName;
            }
        }
        $artwork = new Order;
        $artwork->client_name = $request->client_name;
        $artwork->email = $request->email;
        $artwork->phon_no = $request->phon_no;
        $artwork->note = $request->note;
        $artwork->user_id = $request->user_id;
        $artwork->name = $request->name;
        $artwork->description = $request->description;
        $artwork->image = $imgData;
        $artwork->save();
        return redirect()->route('home')
                    ->with('success','Order created successfully');
    }
}
