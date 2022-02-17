@extends('layouts.app3', [
    'namePage' => 'ARTWORK ORDERS',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'completed',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])
@section('content')

<div class="small smaller">
  </div>
  @if (count($data) >= 1)
 <div class="tabl-cont">
      <div class="table-responsive resp">
            <table class="table">
                <thead class=" text-primary">
                  <th>
                   Artwork Title
                  </th>
                  <th>
                  Photo
                  </th>
                  <th>
                   Client Name
                  </th>
                  <th>
                   Phone Number
                  </th>
                  <th>
                   Email
                  </th>
                  <th>
                   Price
                  </th>
                  <th>
                   Designer 
                  </th>
                  <th>
                  Description
                  </th>
                  <th>
                  Note
                  </th>
                 
                  <!-- <th class="text-right">
                    Status
                  </th> -->
                  <th class="text-right">
                   
                  </th>
                </thead>
                <tbody>

               
                  @foreach($data as $value)
                  <tr>
                    <td>
                      {{ $value->order->title}}
                    </td>
                    <td><img src="{{ ($value->image)[0] }}" height="75" width="75" alt="" /> </td>
                    <td>
                      {{ $value->client->name}}
                    </td>
                    <td>
                      {{ $value->client->phon_no}}
                    </td>
                    <td>
                      {{ $value->client->email}}
                    </td>
                    <td>
                      {{ $value->order->price}}
                    </td>
                    <td>
                      {{ $value->user->name}}
                    </td>
                  
                    <td>
                      {{ $value->order->description}}
                    </td>
                    <td>
                      {{ $value->note}}
                    </td>
                    <td>
                      {{ $value->status}}
                    </td>
                    <!-- <td class="text-right">
                    {{ $value->status}}
                    </td> -->
                    <td class="billa">
                      <a class="btn btn-primary bil btm" href="{{ route('generate-bill', $value->id ) }}">Generate Bill in TZS</a> 
                      <a class="btn btn-primary bil" href="{{ route('generate-bill', $value->id ) }}">Generate Bill in USD</a> 
                    </td>
                  </tr>
                  @endforeach

                
              
                   
                </tbody>
              </table>
             
  </div>
 </div>
 @else
                     <div class="cont-empty">
                      <p> There is no data</p> 
                     </div>
                  @endif
           
  @endsection
   