<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Post;
use App\Models\User;
use Bryceandy\Selcom\Facades\Selcom;
use Barryvdh\DomPDF\Facade\Pdf;
use  MsGraph;
use DB;

class InvoiceController extends Controller
{
    public function index(Request $request){
        $data = Invoice::with('order','client','post')->latest()->has('order')->paginate(10);
        return view('invoice.index',compact('data'))
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }


    public function create(){

     }
     public function show($id){
        $data = Invoice::with('order','user')->find($id);
        $date = Carbon::now();
        $quantity = 1;
        $total =  $data->order->price;
        return view("invoice.show",compact('data', 'date', 'quantity', 'total', ));

    }









    public function destroy($id)
    {
        $invoice_data = Invoice::find($id);
        $order_id = $invoice_data->order_id;

        $posts = Post::where('order_id', $order_id)->get();
        foreach ($posts as $post){
            $post->status = false;
            $post->save();
        }
    
        Invoice::find($id)->delete();
        return redirect()->route('invoice.index')
                        ->with('success','User deleted successfully');
    }






 

 

  



    public function generatePDF()
        {
            $data = [
                'title' => 'Welcome to ItSolutionStuff.com',
                'date' => date('m/d/Y')
            ];
            $pdf = PDF::loadView('invoice', $data);
            return $pdf->download('invoice.pdf');
        }



        public function requestPayment($id)
        {
         $data = Order::with('client')->find($id);
            $payment_data = [
                'name' => $data->client->name, 
                'email' => $data->client->email,
                'phone' => $data->client->phon_no,
                'amount' => $data->price,
                'transaction_id' => $data->client->id,
                'no_redirection' => false,
            ];

            // return Selcom::checkout($payment_data);
        }


           
        public function sendEmail(Request $request)
        {
            

        MsGraph::emails()
            ->to(['breezojr#gmail.com'])
            ->subject('the subject')
            ->body(json_decode('content-type'))
            ->send();
        }




}



