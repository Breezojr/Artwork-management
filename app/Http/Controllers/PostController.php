<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        $data = Post::with('user','order')->get();
        return view("posts.index",['data' => $data])
                ->with('i', (request()->input('page', 1) - 1) * 5);
        ;
    }


    public function create(){
        $cid = auth()->user()->id;
        $orders = Order::where('status',false)->get();
        return view("posts.create", ['orders'=>$orders]);
    }

    public function store(Request $request){

        request()->validate([

            'order_id' => 'required',
            'note' => 'required',
            'image' => 'required',
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
        $input = $request->all();
        $input['image'] = $imgData;
        $input['user_id'] = auth()->user()->id;
        Post::create($input);
        $status = Order::find($request->order_id);
        $status->update(['status'=> true ]);      

      
        return redirect()->route('posts.index')

                        ->with('success','Product created successfully.');
    }
}
