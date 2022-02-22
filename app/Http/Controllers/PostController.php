<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Post;
use App\Models\User;
use Auth;
class PostController extends Controller
{
    public function index(){
        $user = Auth::user();
        if ($user->hasAnyRole('Admin', 'Accountant')){
            $data = Post::with('user','order')->has('order')->get();
          }

          else{
            $data = Post::with('user','order')->has('order')->where('user_id', '=',Auth::id())->get();
         }
       
        return view("posts.index",['data' => $data])
                ->with('i', (request()->input('page', 1) - 1) * 5);
        
    }


    public function create(){
        $cid = auth()->user()->id;
        // $orders = Order::where('status',false)->get(); 
        $orders = Order::whereHas('users', function ($query) {
            return $query->where('user_id', '=', Auth::id())
                          ->where('status', '=' ,false);
        })->get();
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

        
            $order = Order::with('client')->find($request->order_id);
            $client_id1 = $order->client->id;
      

        $input = $request->all();
        $input['image'] = $imgData;
        $input['client_id'] = $client_id1;
        $input['user_id'] = auth()->user()->id;
        Post::create($input);
        $status = Order::find($request->order_id);
        $status->update(['status'=> true ]);      
        return redirect()->route('posts.index')
                        ->with('success','Product created successfully.');
    }





    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post ]);
    }




    public function update(Request $request, $id) 
    {
        $request->validate([
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
       
        $post = Post::find($id);
        $post->order_id = $request->order_id;
        $post->note = $request->note;
        $post->image = $imgdata;
        $post->save();
        return redirect()->route('home')
                    ->with('success','Order created successfully');
    }









    public function destroy($id)
    {
        
        $order = Post::with('order')->find($id);
        $order_id = $order->order_id;
        $status = Order::find($order_id);
        $status->status = false;
        $status->save();   
        Post::find($id)->delete();   
        return redirect()->route('posts.index')
                        ->with('success','User deleted successfully');
    }





}
