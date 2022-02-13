@extends('layouts.app1', [
    'namePage' => 'Artwork Order',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'home',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])
@section('content')
		 <div class=" small ">
			</div>

       <div class="create">
	   <form action="{{ route('artworks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf 
			<div class="row">
              <div class="col-lg-7 col-md-7">
                <div class="form-group">
					 <label>user id:</label>
					 <input type="text" name="user_id" class="form-control" placeholder="Enter Title of the artwork orderd">
			    </div>
				
                <div class="form-group">
					<label>Artwork </label>
					<input type="text" name="artwork_id" class="form-control" placeholder="Name of the Client">
				</div>
				
                <div class="form-group">
					<label>Note:</label>
					<input type="text" name="note" class="form-control" placeholder="Email">
				</div>
              
              <div class="col-lg-4 col-md-4">
			    	<div class="user-image img-cont-outer  ">
					    <div class="imgPreview img-cont-inner"> </div>
			    	</div>            
			    	<div class="custom-file">
				    	<input type="file" name="image[]" class="custom-file-input" id="images" multiple="multiple">
					    <label class="custom-file-label" for="images">Choose image</label>
			        </div>
                 </div>
              </div>
			     <div class=" text-center">
			        	<button type="submit" class="btn btn-primary">Place an Order</button>
		    	 </div>
          </form>
	   </div>

@endsection