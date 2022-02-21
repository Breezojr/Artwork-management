@extends('layouts.app3', [
    'namePage' => 'ARTWORK ORDERS',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'invoice',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])
@section('content')

<div class="small smaller">
  </div>    
  @if (count($data) >= 1)  
<div class="tbl-cont-outer">
 <div class="tabl-cont resp1">
 <div class="table-responsive resp ">
              <table class="table">
                <thead class=" text-primary">
                  <tr>
                    <th style="width:4%"></th>
                    <th> Invoice Number</th>
                    <th> Client Name</th>
                    <th> Artwotk Title </th>
                    <th>  Photo </th>
                    <th> Price </th>
                    <th>  </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $value)
                
                    <tr>
                      <td>{{++$i}}</td>
                      <td> {{ $value->invoice_number}} </td>
                      <td> {{ $value->client->name}} </td>
                      <td> {{ $value-> order->title}} </td>
                      <td><div class="art-img-cont1"><img class="art-image1" src="{{ ($value->post->image)[0] }}"  alt="" /> </div </td>
                      <td>{{ $value->total}} </td>
                      <td width="10px" class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" style=" cursor:pointer;"  href="{{ route('invoice.show',$value->id) }}"  >view
                          </a>
                      
                          <a class="dropdown-item" style=" cursor:pointer;"  href="{{ route('invoice.edit', $value->id) }}" >Edit</a>
                          <form action="{{ route('invoice.destroy',$value->id) }}" method="POST">
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
              {{ $data->links() }}
  </div>
 </div>
</div>
@else
                     <div class="cont-empty">
                      <p> There is no data</p> 
                     </div>
                  @endif
           
  @endsection
   