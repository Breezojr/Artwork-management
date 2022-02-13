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
   </div>
</div>
          
  @endsection
   