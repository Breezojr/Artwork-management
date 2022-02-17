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
        $data = Invoice::with('order','client','post')->latest()->paginate(10);
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






     public function store(Request $request){
        request()->validate([
            'order_id' => 'required',
            'note' => 'required',
            'image' => 'required',
        ]);
        $imgData = [];
        if(count($request->image)) {
            foreach($request->image as $file) {
                $path = '/images/artworks';
                $date = Carbon::now();
                $filename = hash('MD5', time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
                $tempName = env('APP_URL') . '/storage' . $path . '/'. $date->year.'/' . $filename;
                $filePath = $path . "/$date->year";
                $file->storeAs($filePath, $filename, 'public');
                $imgData[] = $tempName;
            }
        }
        $data = Invoice::all();
        if($data){
           $last3 = DB::table('invoices')->latest('id')->first();
           $status = Invoice::find($last3);
           $invoice_number1 = $status->invoice_number++;
        }
        else{
            $invoice_number1 = 1;
        }

        $input = $request->all();
        $input['image'] = $imgData;
        $input['invoice_number'] = $invoice_number1;
        $input['user_id'] = auth()->user()->id;
        Invoice::create($input);
        return redirect()->route('posts.index')
                        ->with('success','Product created successfully.');
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



