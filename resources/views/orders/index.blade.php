@extends('layouts.app3', [
    'namePage' => 'ARTWORK ORDERS',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'order',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])
@section('content')

<div class="small smaller">
  </div>

       <div class="tbl-cont-outer">
         <div class="tabl-cont">
          <div class="resp">
            <div class="btnadd">
            <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('orders.create') }}">Add New Order</a>
            </div>
            @if (count($data) >= 1) 
            <div class="coontainer">
            <table >
                <thead class=" text-primary">
                  <tr>
                    <th style="width:4%">   </th>
                    <th>  Order Title  </th>
                    <th>  Client Name  </th>
                    <th>  Phone No. </th>
                    <th>  Email        </th>
                    <th>  Price        </th>
                    <th>  Designer     </th>
                    <th>  Description  </th>
                    <th>  Note         </th>
                    <th>  Status         </th>
                    <th class="text-right"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $value)
                  
                    <tr>
                     <td> {{ ++$i}} </td>
                      <td> {{ $value->title}} </td>
                      <td> {{ $value->client->name}} </td>
                      <td> {{ $value->client->phon_no}} </td>
                      <td>{{ $value->client->email}} </td>
                      <td>{{ $value->price}} </td>
                      <td> @foreach ($value->users as $data1) {{$data1->name}} <br>  @endforeach </td>
                      <td>{{ Str::limit( $value->description, 10) }}</td>
                      <td>{{ Str::limit( $value->note, 10) }}</td>
                      @if($data)
                          @if($value->status == true)
                          <td > Completed </td>
                          @elseif($value->status == false)
                          <td > Pending </td>
                          @else 
                          <td > System Error </td>
                          @endif 
                          @else
                          <td> {{$value->status}} </td>
                      @endif
                      <td class="btn-cont text-right">
                        <div class="dropdown">
                           <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="fas fa-ellipsis-v"></i>
                           </a>

                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                              <a class="dropdown-item" style=" cursor:pointer;"  href="{{ route('orders.show',$value->id) }}"  >view
                              </a>
                      
                               <a class="dropdown-item" style=" cursor:pointer;"  href="{{ route('orders.edit', $value->id) }}" >Edit</a>
                              <form action="{{ route('orders.destroy',$value->id) }}" method="POST">
                              @csrf
                              @method('DELETE')  
                              <button type="submit" class="dropdown-item">Delete</button>
                              </form>
                              </div>
                          </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
              {!! $data->links() !!}
           </div>
   </div>
   </div>  
        @else
                     <div class="cont-empty">
                      <p> There is no data</p> 
                     </div>
                  @endif 
  @endsection
   