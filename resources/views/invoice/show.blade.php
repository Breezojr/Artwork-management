@extends('layouts.app3', [
    'namePage' => 'INVOICE',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'invoice',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])
@section('content')

<div class="small smaller">
  </div>
  
<div class="row1">
  <div class="invoice-container">
      <div class="in-header">
         <div class="left">
            <h1>Invoice</h1>
          </div>
          <div class="right">
            <div class="right1"> 
              <p>0746154809</p>
              <p>artwork@gmail.com</p>
              <p>artwork.co.tz</p>
            </div>
            <div class="right2">
              <p>PPF Tower</p>
              <p>Dar es salaam</p>
              <p>Tanzania</p>
            </div>
          </div>
       </div>


      <div class="mini-body">
         <div class="left">
           <div class="left1">
              <h4>Billed to</h4>
              <p>{{$data->client->name}}</p>
              <p> {{$data->client->email}}</p>
              <p>{{$data->client->phon_no}}</p>
              <p>{{$data->client->address}}</p>
           </div>
           <div class="left2">
              <div class="bil-no">
                 <h4>Bill No</h4>
                 <p>{{$data->invoice_number}}</p>
              </div>
              <div class="isue-date">
                 <h4>Isue date</h4>
                 <p>{{ $date }}</p>
              </div>
            </div>
         </div>
         <div class="right">
            <h4>invoice Total</h4>
            <p>Tzs. {{ $total }}</p>
         </div>
      </div>



      <div class="max-body">
        <div class="table-container">
          <table class="min-tab">
            <thead>
              <tr>
                <th width="40%">Description</th>
                <th>Unity Cost</th>
                <th>Quantity</th>
                <th>price</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td width="40%">{{$data ->name}}</td>
                <td>{{$data ->price}}</td>
                <td>{{$quantity}}</td>
                <td>{{$total}} </td>
              </tr>
              
            </tbody>
          </table>
        </div>
      <div>


   <div class="subtotal1">
     <div class="subtotal">
       <div class="left">
          <p>subtotal</p>
          <p>Tax</p>
          <p>Total</p>
          <p>Amount Due</p>
       </div>
       <div class="right">
          <p>Tzs. {{ $total }}</p>
          <p>18%</p>
          <p>Tzs. {{ $total }}</p>
          <p>Tzs. {{ $total }}</p>
       </div>
     </div>
   </div>





   </div>
</div>

    <div class="buttonss">
        <div class="pdf">
          <a href="{{ route('pdf') }}" class="btn btn-primary"> Print </a>
        </div>
        <div class="email">
          <a href="{{ route('send-email') }}" class="btn btn-primary"> Send Email</a>
        </div>
        <div class="rp">
         <a href="{{ route('request-payment', $data->id) }}" class="btn btn-primary"> Request Payment </a>
        </div>  
    </div>
  @endsection
   
        