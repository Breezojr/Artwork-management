@extends('layouts.app3', [
    'namePage' => 'ARWORK WORKSPACE',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'art',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])
@section('content')

<div class="small smaller">
  </div>
  <div class="content art-content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
              <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('posts.create') }}">Add</a>
            <h4 class="card-title"> ARTWORKS</h4>
            <div class="col-12 mt-2">
                                        </div>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                <th>No</th>
                <th>Artwotk Title</th>
                <th>Photo</th>
                <th>Designer Name</th>
                <th>Notes</th>
                <th>Status</th>
                
                </tr>
              </thead> 
              <tfoot>
              <tr>
                <th >No</th>
                <th width="15%">Artwotk Title</th>
                <th width="12%">Photo</th> 
                <th>Designer Name</th>
                <th>Notes</th>
                <th>Status</th>
                <th></th>
                
                </tr>
              </tfoot>
              <tbody>
              @foreach ($data as $key => $post)
          <tr>
          <td>{{ ++$i }}</td>
          <td>{{ $post->order->title }}</td>
          <td> <div class="art-img-cont"><img class="art-image" src="{{ ($post->image)[0] }}"  alt="" /> </div></td>
          <td>{{ $post->user->name }}</td>
          <td>{{ $post->note }}</td>
          <td>Completed</td>
          <td class="btn-cont text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" style=" cursor:pointer;"  href="{{ route('posts.edit', $post->id) }}" >Edit</a>

                          <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
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
          
  @endsection
   