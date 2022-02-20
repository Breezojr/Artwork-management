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
    <div class="grid">
       <div class="grid-item">
     <div class="header">
       <h4 >Recently added Artworks Orders</h4>
     </div>
     @if (count($data) >= 1)
     <div class="body">
       <table>
          <thead>
              <tr>
              
                <th>Title</th>
                <th>price</th>
                <th>status</th>
                <th class="text-right">Designer(s)</th>
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

                  <td class="text-right"> @foreach ($data1->users as $data1) {{$data1->name}} <br>  @endforeach </td>
              </tr>
              @endif
              @endforeach
          </tbody>
      </table>
        </div>
        @else
          <div class="cont-empty1">
          <p> There is no data</p> 
          </div>
        @endif
       </div>
      


       <div class="grid-item">
       <div class="header">
          <h4 >Latest Completed Artworks Orders</h4>
      </div>
      
      @if (count($data) >= 1)
          <div class="body">
       <table>
          <thead>
              <tr>
                <th>Title</th>
                <th>price</th>
                <th>status</th>
                <th class="text-right">Designer(s)</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($data2 as $data1)
            @if($data1->status == true)
              <tr>
                <td>{{$data1->title}}</td>
                <td>{{$data1->price}}</td>

                    @if($data2)
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

                  <td  class="text-right"> @foreach ($data1->users as $data1) {{$data1->name}} <br>  @endforeach </td>
              </tr>
              @endif
              @endforeach
          </tbody>
      </table>

        </div>
        @else
                     <div class="cont-empty1">
                      <p> There is no data</p> 
                     </div>
                 
        @endif
       </div>
    </div>

    @hasrole('Admin')



    <div class=" designer-tab">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"> Designers</h4>
          </div>
          <div class="card-body">
            <div role="tabpanel" >
              <ul  class="nav nav-tabs" role="tablist">
                <div class="nav-header-cont">
                @foreach ($designers as $item)
                    <li  id="{{$item->id}}" role="presentation" class="tab-header {{ $item->id == 1 ? 'active' : '' }}">
                      <a href="#home{{ $item->id }}"   aria-controls="home" role="tab" data-toggle="tab">{{ $item->name }}</a>
                    </li>
                    
                  @endforeach

                </div>
                
                  
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
          @endhasrole

   
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