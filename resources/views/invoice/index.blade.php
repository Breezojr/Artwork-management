@extends('layouts.app3', [
    'namePage' => 'ARTWORK ORDERS',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'invoice',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])
@section('content')

<div class="small smaller">
  </div>
 <div class="tabl-cont">
 <div class="table-responsive resp">
              <table class="table">
                <thead class=" text-primary">
                  <tr>
                    <th> Order Title </th>
                    <th> Client Name </th>
                    <th> Phone Number </th>
                    <th>  Email </th>
                    <th> Price </th>
                    <th> Designer </th>
                    <th>  Description </th>
                    <th>  Note </th>
                    <th>  Photo </th> 
                    <th class="text-right">Status</th>
                  </tr>

                </thead>
                <tbody>
                  @foreach($data as $value)
                
                    <tr>
                      <td> {{ $value->title}} </td>
                      <td> {{ $value->client->name}} </td>
                      <td> {{ $value->client->phon_no}} </td>
                      <td>{{ $value->client->email}} </td>
                      <td>{{ $value->price}} </td>
                      <td> @foreach ($value->users as $data) {{$data->name}} <br>  @endforeach </td>
                      <td>{{ $value->description}}</td>
                      <td>{{ $value->note}} </td>
                      <td><img src="{{ ($value->image)[0] }}" height="75" width="75" alt="" /> </td>
                      <td class="text-right">{{ $value->status}}  </td>
                    </tr>
                   
                  @endforeach
                </tbody>
              </table>
             
  </div>
 </div>
           
  @endsection
   