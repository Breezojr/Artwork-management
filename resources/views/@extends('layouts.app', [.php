@extends('layouts.app', [
    'namePage' => 'Dashboard',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'home',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])

@section('content')
<div class=" small ">
    
    </div>

  <div class="big-content">
  <div class="content">
    <div class="row center">
     <div class="col-lg- col-md-3">
        <div class="card card-chart">
          <div class="card-header">
            <h4 class="card-title">Artworks Orders</h4>
            <div class="dropdown">
              <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                <i class="now-ui-icons loader_gear"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('orders.create') }}">Create New Order</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <a class="dropdown-item text-danger" href="#">Remove Data</a>
              </div>
            </div>
          </div>
          <div class="card-body">
         <table>
           <thead>
             <tr>
               <th>Title</th>
               <th>price</th>
               <th>status</th>
               <th>Designer(s)</th>
             </tr>
           </thead>
           <tbody>
           @foreach ($data as $data1)
             <tr>
               <td>{{$data1->title}}</td>
               <td>{{$data1->price}}</td>

                  @if($data)
                    @if($data1->status == true)
                    <td> Completed </td>
                    @elseif($data1->status == false)
                    <td> Pending </td>
                    @else 
                    <td> System Error </td>
                    @endif 
                    @else
                    {{$data1->status}}
                  @endif

                <td> @foreach ($data1->users as $data1) {{$data1->name}} <br>  @endforeach </td>
             </tr>
             @endforeach
           </tbody>
           </table>
           
          </div>
         
        </div>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="card card-chart">
          <div class="card-header">
            <h4 class="card-title">Completed Artworks</h4>
          </div>
          <div class="card-body">
          <table>
           <thead>
             <tr>
               <th>Title</th>
               <th>price</th>
               <th>status</th>
               <th>Designer(s)</th>
             </tr>
           </thead>
           <tbody>
           @foreach ($data as $data1)
           @if($data1->status == true)
             <tr>
               <td>{{$data1->title}}</td>
               <td>{{$data1->price}}</td>

                  @if($data)
                    @if($data1->status == true)
                    <td> Completed </td>
                    @elseif($data1->status == false)
                    <td> Pending </td>
                    @else 
                    <td> System Error </td>
                    @endif 
                    @else
                    {{$data1->status}}
                  @endif

                <td> @foreach ($data1->users as $data1) {{$data1->name}} <br>  @endforeach </td>
             </tr>
             @endif
             @endforeach
           </tbody>
           </table>
          </div>
       
        </div>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="card card-chart">
          <div class="card-header">
      
            <h4 class="card-title">Pending Artworks</h4>
          </div>
          <div class="card-body">
          <table>
           <thead>
             <tr>
               <th>Title</th>
               <th>price</th>
               <th>status</th>
               <th>Designer(s)</th>
             </tr>
           </thead>
           <tbody>
           @foreach ($data as $data1)
           @if($data1->status == false)
             <tr>
               <td>{{$data1->title}}</td>
               <td>{{$data1->price}}</td>

                  @if($data)
                    @if($data1->status == true)
                    <td> Completed </td>
                    @elseif($data1->status == false)
                    <td> Pending </td>
                    @else 
                    <td> System Error </td>
                    @endif 
                    @else
                    {{$data1->status}}
                  @endif

                <td> @foreach ($data1->users as $data1) {{$data1->name}} <br>  @endforeach </td>
             </tr>
             @endif
             @endforeach
           </tbody>
           </table>
          </div>
          <!-- <div class="card-footer">
            <div class="stats">
              <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
            </div>
          </div> -->
        </div>
      </div>
   
    </div>
    <div class="row">
     

      <div class=" designer-tab">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"> Designers</h4>
          </div>
          <div class="card-body">
            <div role="tabpanel" >
              <ul  class="nav nav-tabs" role="tablist">
                  @foreach ($designers as $item)
                    <li  id="{{$item->id}}" role="presentation" class="tab-header {{ $item->id == 1 ? 'active' : '' }}">
                      <a href="#home{{ $item->id }}"   aria-controls="home" role="tab" data-toggle="tab">{{ $item->name }}</a>
                    </li>
                    
                  @endforeach
              </ul>
              <div class="tab-content">
              @foreach ($designers as $item)
                    <div role="tabpanel" class="tab-pane  {{ $item->id == 1 ? 'active' : '' }} tab-body"  id="home{{ $item->id }}" class="active">
                      <ul class="">
                        @foreach ($item->posts as $element)
                          <li > <img src="{{ ($element->image)[0] }}" height="75" width="75" alt="" /> </li>
                        @endforeach
                      </ul>
                    </div>
              @endforeach
               </div>
             </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
 
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts()
    });
  </script>

<script>
     function changestyle(id){
       var element = document.getElementById(id)
       element.style.display ='none';
     }
  
  </script>

@endpush