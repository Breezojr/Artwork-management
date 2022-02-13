<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index(){
        return view("invoice.index");
    }


    public function create(){
       $cid = auth()->user()->id;
        
        $orders = Order::where('user_id', $cid)->get();
        return view("posts.create", ['orders'=>$orders]);
    }

    public function store(Request $request){

        request()->validate([

            'order_id' => 'required',
            'note' => 'required',
            'image' => 'required',
           
        ]);
        $imgData = [];
        if(count($request->image)) {
            foreach($request->image as $file) {
                $path = '/images/artworks';
                $date = Carbon::now();
                $filename = hash('MD5', time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
                $tempName = env('APP_URL') . '/storage' . $path . '/'. $date->year.'/' . $filename;
                $filePath = $path . "/$date->year";
                $file->storeAs($filePath, $filename, 'public');
                $imgData[] = $tempName;
            }
        }

    
        $input = $request->all();

        $input['image'] = $imgData;

        $input['user_id'] = auth()->user()->id;

    
        Post::create($input);

    
        return redirect()->route('posts.index')

                        ->with('success','Product created successfully.');
    }
}