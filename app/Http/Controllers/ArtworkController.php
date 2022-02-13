<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('artworks.art');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
