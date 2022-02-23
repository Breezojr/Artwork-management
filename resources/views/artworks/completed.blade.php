@extends('layouts.app3', [
    'namePage' => 'COMPLETED ARTWORKS',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'completed',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])
@section('content')

<div class="small smaller">
  </div>
  @if (count($data) >= 1)
 <div class="tabl-cont">
      <div class="table-responsive resp tblo">
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
                  Note
                  </th>

                  <th style="width:10%">
                 
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
                      {{ $value->note}}
                    </td>
                  
                    <td class="bills">
                      <a class="top" href="{{route('generate-bill',$value->id)}}">Generate bill in Tzs</a>
                      <a href="{{route('generate-billUSD',$value->id)}}">Generate bill in Usd</a>
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
   