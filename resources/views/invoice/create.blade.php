@extends('layouts.app1', [
    'namePage' => 'INVOICES',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'art',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])
@section('content')
		 <div class=" small ">
			</div>

       <div >
	   <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf 
			<div class="row">

              <div class="form-group">
					<label>Select Order:</label>
					<select name="order_id" id="order_id">
					  <option value="-1"> Select Order to work with</option>
					  @foreach ($orders as $order)
					    <option value="{{ $order->id}}">{{ $order->name}} </option>
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


					<div class="form-group">
					<label class="descr" >Notes:</label>
					<textarea name="notes" class="form-control" placeholder="Best Describe the work in a very clear way"></textarea>
				</div>
              
              
			     <div class=" text-center">
			        	<button type="submit" class="btn btn-primary">Place an Order</button>
		    	 </div>
          </form>
	   </div>

@endsection