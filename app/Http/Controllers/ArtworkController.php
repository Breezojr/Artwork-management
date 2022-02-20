<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Invoice;
use Carbon\Carbon;


class ArtworkController extends Controller
{
  

    function __construct()
    {
         $this->middleware('permission:completed', ['only' => ['completed']]);
      
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
                    $path = '/images/artworks';
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
    

        

   
    public function completed(Request $request){
        $data = Post::with('order','user')->has('order')->Where('status',false)->latest()->paginate();
        return view('artworks.completed',compact('data'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function generateBill(Request $request, $id){
        $data = Post::with('order','user','client')->find($id);
        $data->status = true;
        $data->save();
        $date = Carbon::now();
        $quantity = 1;
        $total = $quantity * $data->price;
        $invoice = new Invoice;

        $i_number =   Invoice::latest()->first();
        if($i_number){
            $invoic_number = $i_number->invoice_number +1;
        }else{
         $invoic_number = 1;
        }
        $invoice->created_date = Carbon::today();
        $invoice->order_id = $data->order->id;
        $invoice->client_id = $data->client->id;
        $invoice->user_id = $data->user->id;
        $invoice->quantity = $data->quantity;
        $invoice->post_id = $data->id;
        $invoice->invoice_number = $invoic_number;
        $invoice->save();
        $status1 = Post::find($id);
        $status1->update(['status'=> true ]);      

        
        return view('artworks.generate-bill',compact('data', 'date', 'quantity', 'total', ))
        ->with('i', ($request->input('page', 1) - 1) * 5);
    }


}
