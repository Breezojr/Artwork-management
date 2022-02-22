<!DOCTYPE html>
<html>
<head>
<style>

.row1{
   width: 100%;
   
}
.invoice-container{
   margin-top: 50px;
   background-color: aliceblue;
   width: 60%;
   position: relative;
   left: 20%;
   margin-bottom: 200px;
   min-height: 550px;
}
.invoice-container .in-header{
   background-color: rgb(116, 162, 202);
   
}
.invoice-container .in-header .left{
   display: inline-block;
   margin-left: 20px;
   margin-top: 20px;
   
}

.invoice-container .in-header .right{
   margin-top: 10px;
   float:right;
   right: 20px;
   position: relative;
}

.invoice-container .in-header .right p{
   height: 5px;
}


.invoice-container .in-header .right .right1{
   display: inline-block;
   margin-right: 30px;
}
.invoice-container .in-header .right .right2{
   display: inline-block;
}


.invoice-container .mini-body .left .left1{
   float: left;
   margin-right: 70px;
   margin-left:20px;
}

.invoice-container .mini-body .left .left2{
   display: inline-block;
}

.invoice-container .mini-body .left{
   display: inline-block;
}
.invoice-container .mini-body .right{
   float: right;
   right: 20px;
   position: relative;
}

.invoice-container .mini-body p{
  height: 5px;
}

.invoice-container .mini-body h4{
   height: 20px;
   margin-bottom: 10px;
 }

 .max-body {
   margin-top: 50px;
 }
 .max-body .table-container{
   width:90%;
   left:4%;
   position: relative;
 }
.max-body .min-tab{
  border-top: 3px blue solid;
  width: 100%;
}

.max-body .min-tab  thead {
   padding-top: 0px;
   height: 50px;
 }

.max-body .min-tab  thead tr th{
   padding-left: 10px;
   padding-top: 0px;
 }

 .max-body .min-tab  tbody tr{
    border-bottom: 1px solid rgb(221, 217, 217);
 }
 
 .max-body .min-tab  tbody tr td{
   padding-left: 10px;
   padding-top: 0px;
 }
 .invoice-container .subtotal1{
     height: 150px;
  }

 .invoice-container .subtotal{
      margin-top: 50px;
      width: 40%;
      right: 20px;
      position: relative;
      float: right;
 }


 .invoice-container .subtotal p{
  height: 5px;
}



 .invoice-container .subtotal .left{
  display: inline-block;
 }

 .invoice-container .subtotal .right{
  float: right;
 }
</style>


    <title>Hi</title>
</head>

<body>


  
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
              <p>{{$client_name}}</p>
              <p> {{$client_email}}</p>
              <p>{{$client_phone}}</p>
              <p>{{$client_address}}</p>
           </div>
           <div class="left2">
              <div class="bil-no">
                 <h4>Bill No</h4>
                 <p>{{$invoice_number}}</p>
              </div>
              <div class="isue-date">
                 <h4>Isue date</h4>
                 <p>{{ $created_date }}</p>
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
                <td width="40%">{{$order_title}}</td>
                <td>{{ $total }}</td>
                <td>{{$quantity}}</td>
                <td>{{ $total }} </td>
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
</body>

</html>