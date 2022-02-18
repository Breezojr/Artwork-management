<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;
use App\Models\User;
use Auth;



class OrderController extends Controller
{ 

    public function index(Request $request)
    {

        $user = Auth::user();
        if($user->hasRole('Admin')){
            $data = Order::with('client')->latest()->paginate(15);
        }

        else{
            $data1= Order::all();
            foreach($data1 as $us_data){
                if(count($us_data) > 1)
                foreach($us_data->users as $user){
                    $data = Order::with('client')->where( 'user->id',$user->id)->latest()->paginate(15);
                }
            }

        }

        
        
        return view('orders.index',compact('data'))
        ->with('i', ($request->input('page', 1) - 1) * 15);
    }


    public function create()
    {
        $designers = User::all();
        // $designers = User::role('Designer')->get();
        return view('orders.create', ['designers'=>$designers]);
    }
    public function show($id)
    {
        $data = Order::with('client')->find($id);
        return view('orders.show',compact('data'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'note' => 'required',
            'email' => 'required|email|unique:clients,email',
            'phon_no' =>  'required|digits:10',
            'name' => 'required',
            'title' => 'required',
            'price' => 'required|numeric|gt:0',
            'description' => 'required',
           
        ]);
        
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
        $artwork->save();
        $user = User::find([1, 2]);
        $artwork->users()->attach($user);
        return redirect()->route('home')
                    ->with('success','Order created successfully');
    }

    public function edit(Order $order)
    {
        $designers = User::all();
        // $designers = User::role('Designer')->get();
        return view('orders.edit', ['designers'=>$designers,'order' => $order ]);
    }

    public function update(Request $request, $id) 
    {
        $request->validate([
            'note' => 'required',
            'email' => 'required',
            'phon_no' => 'required',
            'name' => 'required',
            'title' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
       
        $client = Client::find($id);
        $client->email = $request->email;
        $client->phon_no = $request->phon_no;
        $client->name = $request->name;
        $client->address = $request->address;
        $client->save();
        $artwork = Order::find($id);
        $artwork->title = $request->title;
        $artwork->note = $request->note;
        $artwork->client_id = $client->id;
        $artwork->price = $request->price;
        $artwork->description = $request->description;
        $artwork->save();
        $user = User::find([1, 2]);
        $artwork->users()->attach($user);
        return redirect()->route('home')
                    ->with('success','Order created successfully');
    }



    public function destroy($id)
    {
        Order::find($id)->delete();
        return redirect()->route('orders.index')
                        ->with('success','User deleted successfully');
    }

}
