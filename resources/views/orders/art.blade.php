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
	   <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf 
			<div class="row">
              <div class="col-lg-7 col-md-7">
                <div class="form-group">
					 <label>Artwork Title:</label>
					 <input type="text" name="name" class="form-control" placeholder="Enter Title of the artwork orderd">
			    </div>
				
                <div class="form-group">
					<label>Name of the Client:</label>
					<input type="text" name="client_name" class="form-control" placeholder="Name of the Client">
				</div>
				
                <div class="form-group">
					<label>Email:</label>
					<input type="text" name="email" class="form-control" placeholder="Email">
				</div>
                <div class="form-group">
					<label>Phone Number:</label>
					<input type="text" name="phon_no" class="form-control" placeholder="Phone number">
				</div>
				<div class="form-group">
					<label class="descr" >Description:</label>
					<textarea name="description" class="form-control" placeholder="Best Describe the work in a very clear way"></textarea>
				</div>
				<div class="form-group">
					<label>Note:</label>
					<input type="text" name="note" class="form-control" placeholder="Any Note for the work" required>
				</div>
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