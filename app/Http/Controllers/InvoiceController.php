<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\User;
use Bryceandy\Selcom\Facades\Selcom;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;

class InvoiceController extends Controller
{



    public function index(Request $request){
        $data = Order::with('client')->where('status',true)->get();
        return view('invoice.index',compact('data'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
    }



    public function create(){
        $cid = auth()->user()->id;
         $orders = Order::where('user_id', $cid)->get();
         return view("posts.create", ['orders'=>$orders]);
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










    public function completed(Request $request){
        $data = Order::with('client')->where('status',true)->get();
        return view('invoice.completed',compact('data'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
    }



    public function show($id){
        $data = Order::with('client')->find($id);
        $date = Carbon::now();
        $quantity = 1;
        $total = $quantity * $data->price;
        return view("invoice.show",compact('data', 'date', 'quantity', 'total', ));

    }

    public function bill($id){
        $data = Order::with('user')->find($id);
        return view("invoice.index",compact('data'));

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
         $data = Invoice::with('order')->find($id);
            $payment_data = [
                // 'name' => $data->client->name, 
                // 'email' => $data->client->email,
                // 'phone' => $data->client->phon_no,
                   'amount' => $data->order->price,
                // 'transaction_id' => $data->client->id,
                'no_redirection' => true,
                // Optional fields
                // 'currency' => 'Default is TZS',
                // 'items' => 'Number of items purchased, default is 1',
                // 'payment_phone' => 'The number that will make the USSD transactions, if not specified it will use the phone value',
            ];

            return Selcom::checkout($payment_data);
        }






}



