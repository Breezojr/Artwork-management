@extends('layouts.app1', [
    'namePage' => 'Artwork Order',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'art',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])
@section('content')
		 <div class=" small ">
			</div>

       <div class="art-post">
	       <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf 
			<div class="row2">
			@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif
				<div class="sel">
				  <label>Select Order:</label>
					<select name="order_id" id="order_id">
					  <option value="-1"> Select Order to work with</option>
					  @foreach ($orders as $order)
					    <option value="{{ $order->id}}">{{ $order->title}} </option>
					   @endforeach
					</select>
				
				</div>
               
		    	<div class="user-image img-cont-outer  ">
					    <div class="imgPreview img-cont-inner"> </div>
			    	</div>            
			    	<div class="custom-file">
				    	<input type="file" name="image[]" class="custom-file-input" id="images" multiple="multiple">
					    <label class="custom-file-label" for="images">Choose image</label>
			        </div>


				<div class="note">
			     	<label class="descr" >Notes:</label>
					<textarea name="note"  placeholder="Best Describe the work in a very clear way"></textarea>
		
				</div>
					
        
			     <div class="text-center text-blw">
			        	<button type="submit" class="btn btn-primary">Upload Artwork</button>
		    	 </div>
          </form>
	   </div>

@endsection