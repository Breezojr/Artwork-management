<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;
use App\Models\User;



class OrderController extends Controller
{ 

    public function index(Request $request)
    {
        $data2 = Order::with('client')->get();
        foreach( $data2 as $data3){
           $data4 = $data3->users;
        }
        $cid = auth()->user()->id;
        $data = Order::with('client')->get();
        foreach($data as $data1){
            if($data1->status == false ){
                $status1 = "Pending";
            }
            else if($data1->status == true ){
                $status1 = "completed";
            }
            else {
                $status1 = "System error";
            }
        };
        return view('orders.index',compact('data', 'status1','cid', 'data4'))
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
            'email' => 'required',
            'phon_no' => 'required',
            'name' => 'required',
            'title' => 'required',
            'price' => 'required',
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
        $client = new Client;
        $client->email = $request->email;
        $client->phon_no = $request->phon_no;
        $client->name = $request->name;
        $client->address = $request->address;
        $client->save();
        $artwork = new Order;
        $artwork->title = $request->title;
        $artwork->note = $request->note;
        $artwork->client_id = $client->id;
        $artwork->price = $request->price;
        $artwork->description = $request->description;
        $artwork->image = $imgData;
        $artwork->save();
        $user = User::find([1, 2]);
        $artwork->users()->attach($user);
        return redirect()->route('home')
                    ->with('success','Order created successfully');
    }
}
