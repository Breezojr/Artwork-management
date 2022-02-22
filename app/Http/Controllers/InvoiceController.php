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
        return view("invoice.show",compact('data' ));

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




 

 

 

  



    public function generatePDF($id)
        {
            $invoice_data = Invoice::with('order','user')->find($id);

            $data = [
                'client_name' => $invoice_data->client->name,
                'client_email' => $invoice_data->client->email,
                'client_phone' => $invoice_data->client->phon_no,
                'client_address' => $invoice_data->client->address,
                'invoice_number' => $invoice_data->invoice_number,
                'created_date' => $invoice_data->created_date,
                'total' => $invoice_data->total,
                'order_title' => $invoice_data->order->title,
                'quantity' => $invoice_data->quantity,
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
                    
                // URL
                $apiURL = 'https://graph.microsoft.com/v1.0/me/sendMail';

                // POST Data
                $message = [
                'subject' => 'Meet for lunch?',
                'body' => ['contentType' => 'Text',"content" => "The new cafeteria is open."],
                "toRecipients" => [
                    [
                      "emailAddress" => [
                        "address"=>"samanthab@contoso.onmicrosoft.com"
                      ]
                    ]
                  ],
                ];

                // Headers
                $headers = [
                    'Content-type' => 'application/json',
                    'Authorization' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsIng1dCI6Ik1yNS1BVWliZkJpaTdOZDFqQmViYXhib1hXMCIsImtpZCI6Ik1yNS1BVWliZkJpaTdOZDFqQmViYXhib1hXMCJ9.eyJhdWQiOiJodHRwczovL21hbmFnZW1lbnQuYXp1cmUuY29tLyIsImlzcyI6Imh0dHBzOi8vc3RzLndpbmRvd3MubmV0LzQ5OTRjZDJlLWM2ZmYtNGUzMS1iN2Q0LTNkNmY4MTBhOGEwMy8iLCJpYXQiOjE2NDU0NTk1MzgsIm5iZiI6MTY0NTQ1OTUzOCwiZXhwIjoxNjQ1NDYzNDM4LCJhaW8iOiJFMlpnWUNoWjgvUFJjL2VKNXNZZnVsZlZYV1VyQlFBPSIsImFwcGlkIjoiNmZiMzM0ZmEtOGIyZi00NjYyLWJlNjktNzQ3YTAwNWEzZDBmIiwiYXBwaWRhY3IiOiIxIiwiaWRwIjoiaHR0cHM6Ly9zdHMud2luZG93cy5uZXQvNDk5NGNkMmUtYzZmZi00ZTMxLWI3ZDQtM2Q2ZjgxMGE4YTAzLyIsImlkdHlwIjoiYXBwIiwib2lkIjoiOGQ0ZTcwMzAtZTJjNC00NGNhLTgwMzktNWUxYTYwNjg2NzU4IiwicmgiOiIwLkFVOEFMczJVU2ZfR01VNjMxRDF2Z1FxS0EwWklmM2tBdXRkUHVrUGF3ZmoyTUJOUEFBQS4iLCJzdWIiOiI4ZDRlNzAzMC1lMmM0LTQ0Y2EtODAzOS01ZTFhNjA2ODY3NTgiLCJ0aWQiOiI0OTk0Y2QyZS1jNmZmLTRlMzEtYjdkNC0zZDZmODEwYThhMDMiLCJ1dGkiOiJKaVJPbXpOUGNrS1Y3S1BXdWd6YUFBIiwidmVyIjoiMS4wIiwieG1zX3RjZHQiOjE2NDQ4MzAwNTB9.tGR8tYzIJtb-2McvBaYpp6HSMMU2WAHh53-R1_hCyBXU4FkAkYnqncd4n7Qy-JCYEJLkisktMcz30Opb1hfRiGphOI4fl56RGTFYhKzaoZUc4hoGvU539bNOrX5KSQt2nVfGzFuCdNzKwrSZb0lvXAPG3AOCgE0pUwLQ_sjIygVBqBs7vfeuE4zpMcJep9SCNl-DCt2-NhQIc9VPVLBabIo9NoQGn7mAr90tQsCJX8jnO8Jc2dL-mJbuKWQhrEMpA66o2gpanzFmPaWvfkATjxbjFQzCAwYGbQSGowdHf4NiOFsgT2kX6h-3yIZ5M46hsN5AN2SnoNmJAAmcEwjQrQ',
                ];

                $client = new \GuzzleHttp\Client();
                $response = $client->request('POST', $apiURL, ['form_params' => $message, 'headers' => $headers]);

                $responseBody = json_decode($response->getBody(), true);

                echo $statusCode = $response->getStatusCode(); // status code

                dd($responseBody); // body response



        }


       
        // public function sendEmail(Request $request)
        // {
        // MsGraph::emails()
        //     ->to(['breezojr@gmail.com'])
        //     ->subject('the subject')
        //     ->body(json_decode('content-type'))
        //     ->send();
        // }




       









}



