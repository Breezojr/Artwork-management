@extends('layouts.app1', [
    'namePage' => 'Artwork Order',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'order',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])
@section('content')
		 <div class=" small ">
			</div>

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
       <div class="create">
	      <form action="{{ route('orders.update', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf 
			<div class="row">
            
                <div class="form-group">
					 <label>Artwork Title:</label>
					 <input type="text" name="title" value="{{$order->title}}" class="form-control" placeholder="Enter Title of the artwork orderd">
			    </div>
		
                <div class="form-group">
					<label>Name of the Client:</label>
					<input type="text" name="name" value="{{$order->client->name}}" class="form-control" placeholder="Name of the Client">
				</div>
				
                <div class="form-group">
					<label>Email:</label>
					<input type="text" name="email" value="{{$order->client->email}}" class="form-control" placeholder="Email">
				</div>
                <div class="form-group">
					<label>Phone Number:</label>
					<input type="text" name="phon_no" value="{{$order->client->phon_no}}" class="form-control" placeholder="Phone number">
				</div>
				<div class="form-group">
					<label>Address:</label>
					<input type="text" name="address" value="{{$order->client->address }}" class="form-control" placeholder="Phone number">
				</div>
				<div class="form-group">
					<label>Price:</label>
					<input type="text" name="price" value="{{$order->price}}" class="form-control" placeholder="Price">
				</div>
				<div class="form-group">
					<label class="descr" >Description:</label>
					<textarea name="description"   class="form-control" placeholder="Best Describe the work in a very clear way">{{$order->description}}</textarea>
				</div>
				<div class="form-group">
					<label>Note:</label>
					<input type="text" name="note" value="{{$order->note}}" class="form-control" placeholder="Any Note for the work" required>
				</div>
            
             
			     <div class=" text-center">
			        	<button type="submit" class="btn btn-primary">Place an Order</button>
		    	 </div>
          </form>
	   </div>

@endsection