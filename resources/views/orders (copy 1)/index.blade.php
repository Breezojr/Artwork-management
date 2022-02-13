@extends('layouts.app3', [
    'namePage' => 'ARTWORK ORDERS',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'home',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])
@section('content')

<div class="small smaller">
  </div>
 <div class="tabl-cont">
 <div class="table-responsive resp">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                   Order Title
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
                   Designer 
                  </th>
                  <th>
                  Description
                  </th>
                  <th>
                  Note
                  </th>
                  <th>
                  Photos
                  </th>
                  <th class="text-right">
                    Status
                  </th>
                </thead>
                <tbody>
                  @foreach($data as $value)
                  <tr>
                    <td>
                      {{ $value->name}}
                    </td>
                    <td>
                      {{ $value->client_name}}
                    </td>
                    <td>
                      {{ $value->phon_no}}
                    </td>
                    <td>
                      {{ $value->email}}
                    </td>
                    <td>
                      {{ $value->user->name}}
                    </td>
                    <td>
                      {{ $value->description}}
                    </td>
                    <td>
                      {{ $value->note}}
                    </td>
                    <td><img src="{{ ($value->image)[0] }}" height="75" width="75" alt="" />
                     
                    </td>
                    <td class="text-right">
                      Pending
                    </td>
                  </tr>
                  @endforeach
                  
                   
                </tbody>
              </table>
             
  </div>
 </div>
           
  @endsection
   