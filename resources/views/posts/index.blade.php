@extends('layouts.app3', [
    'namePage' => 'ARWORK WORKSPACE',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'art',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])
@section('content')

<div class="small smaller">
  </div>
  <div class="content">
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
                <th>Name</th>
             
                </tr>
              </thead>
              <tfoot>
              <tr>
                <th>No</th>
                <th>Name</th>
                
                </tr>
              </tfoot>
              <tbody>
              @foreach ($data as $key => $post)
          <tr>
          <td>{{ ++$i }}</td>
          <td>{{ $post->user_id }}</td>
          <td>{{ $post->artwork_id }}</td>
          <td>{{ $post->note }}</td>
          <td><img src="{{ ($post->image)[0] }}" height="75" width="75" alt="" />
         
        </tr>
      @endforeach
                              </tbody>
            </table>
          
  @endsection
   