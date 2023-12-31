<?php

namespace App\Http\Controllers;

use App\Mail\AdminMail;
use App\Models\Hosting;
use App\Models\ItemLog;
use App\Models\Order;
use App\Models\PendingFund;
use App\Models\Product;
use App\Models\Sold;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Facades\Redirect;
use Mail;
use MercadoPago\Item;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;
use Vonage\SMS\Webhook\Factory;

class ProductController extends Controller
{


    public function fund_now(request $request)
    {

        $key = env('WEBKEY');
        $ref = "DIG-" . random_int(100000, 999999);

        $url = "https://web.enkpay.com/pay?amount=$request->amount&key=$key&ref=$ref&email=$request->email";


        $trx = new Transaction();
        $trx->amount = $request->amount;
        $trx->user_id = Auth::id();
        $trx->status = 0;
        $trx->trx_ref = $ref;
        $trx->type = 2;
        $trx->save();


        return Redirect::to($url);
    }

  

    public function verify_trx(request $request)
    {

        $trx_id = $request->trans_id;
        $amount = $request->amount;
        $status = $request->status;
        $ip = $request->ip();



        if ($status == 'failed') {

            Transaction::where('trx_ref', $trx_id)->where('status', 0)->update(['status' => 2]);


            $message =  Auth::user()->name . "| canceled funding |";
            send_notification($message);

            return redirect('user/dashboard')->with('error', 'Transaction Declined');
        }




        if ($status == 'success') {



            $trxstatus = Transaction::where('trx_ref', $trx_id)->first()->status ?? null;

            if($trxstatus == 1){

                $message =  Auth::user()->name . "| is trying to fund  with | $request->trx_id  | " . number_format($request->amount, 2) . "\n\n IP ====> ".$request->ip();
                send_notification($message);
                return redirect('user/dashboard')->with('error', 'Transaction already confirmed or not found');


            }



            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://web.enkpay.com/api/verify',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('trans_id' => "$trx_id"),
            ));

            $var = curl_exec($curl);
            curl_close($curl);
            $var = json_decode($var);

            $status1 = $var->detail ?? null;
            $amount2 = $var->price ?? null;
            $status2 = $var->status ?? null;




            


            if ($status1 == 'success') {

                Transaction::where('trx_ref', $trx_id)->where('status', 0)->update(['status' => 1]);
                User::where('id', Auth::id())->increment('wallet', $amount2);

                $message =  Auth::user()->name . "| funding successful |" . number_format($amount, 2) . "\n\n IP ====> $ip";
                send_notification($message);

                $usr = User::where('id', Auth::id())->first() ?? null;

                $data = array(
                    'fromsender' => 'notify@toolzbank.tools', 'Toolz Bank',
                    'subject' => "Wallet Funded",
                    'toreceiver' => Auth::user()->email,
                    'amount' => $amount,
                    'name' => Auth::user()->name,
                );


                \Illuminate\Support\Facades\Mail::send('mails.fund', ["data1" => $data], function ($message) use ($data) {
                    $message->from($data['fromsender']);
                    $message->to($data['toreceiver']);
                    $message->subject($data['subject']);
                });



                return redirect('user/dashboard')->with('message', "Wallet has been funded with $amount");
            }

            $message =  Auth::user()->name . "| is trying to fund  with | $request->trx_id  | " . number_format($request->amount, 2) . "\n\n IP ====> ".$request->ip();
            send_notification($message);
            return redirect('user/dashboard')->with('error', 'Transaction already confirmed or not found');
        }
    }









    public function buyNow(request $request)
    {



        $amount = $request->amount ?? 0;



        if ($amount > Auth::user()->wallet) {

            return redirect('user/dashboard')->with('error', 'Insufficient Balance, Fund your wallet');
        }

        if ($amount > Auth::user()->wallet) {
            return response()->json([
                'redirect' => route('dashboard'),
                'message'  => __('.')
            ]);
        }

        if ($amount == null || $amount == 0) {
            return back()->with('error', 'Please wait try reload your browser and try again');
        }


        $usr = User::where('id', Auth::id())->first() ?? null;

        $get_user_Wallet = User::where('id', Auth::id())->first()->wallet ?? null;


        if ($get_user_Wallet == null) {
            return back()->with('error', 'Please wait try reload your browser and try again');
        }



        if ($amount > $get_user_Wallet) {

            return response()->json([
                'redirect' => route('dashboard'),
                'message'  => __('Insufficient Balance, Fund your wallet.')
            ]);
        } else {

            User::where('id', Auth::id())->decrement('wallet', $amount);

            $pr = ItemLog::where('id', $request->area_code)->first();



            $trx_ref = "TRX - " . random_int(1000000, 9999999);
            $trx = new Transaction();
            $trx->trx_ref = $trx_ref;
            $trx->user_id = Auth::id();
            $trx->amount = $pr->price;
            $trx->type = 1;
            $trx->status = 1;
            $trx->save();



            $sold = new Sold();
            $sold->user_id = Auth::id();
            $sold->area_code = $pr->area_code;
            $sold->amount = $pr->price;
            $sold->data = $pr->data;
            $sold->save();


            $order = new Order();
            $order->order_id = "TRX - " . random_int(1000000, 9999999);
            $order->user_id = Auth::id();
            $order->amount = $pr->price;
            $order->save();



            $message = "Log purchase | NGN $$amount | $trx_ref ";
            send_notification($message);




            ItemLog::where('id', $request->area_code)->delete();
            return redirect('user/dashboard')->with('message', "Log purchase successful");


            //send mail
            $data = array(
                'fromsender' => 'notify@toolzbank.tools', 'Toolz Bank',
                'subject' => "LOG Purchase",
                'toreceiver' => Auth::user()->email,
                'logdata' => $pr->data,
                'area_code' => $pr->area_code,
                'name' => Auth::user()->name,
            );

            \Illuminate\Support\Facades\Mail::send('mails.log', ["data1" => $data], function ($message) use ($data) {
                $message->from($data['fromsender']);
                $message->to($data['toreceiver']);
                $message->subject($data['subject']);
            });
        }

        return back()->with('error', "Insufficient Balance, Fund your wallet");
    }



    public function buyHosting(request $request)
    {



        $amount = $request->amount ?? 0;
        $id = $request->ref_trans_id ?? null;




        if ($amount > Auth::user()->wallet) {

            return redirect('user/host')->with('error', 'Insufficient Balance, Fund your wallet');
        }

        if ($amount > Auth::user()->wallet) {
            return response()->json([
                'redirect' => route('dashboard'),
                'message'  => __('.')
            ]);
        }

        if ($amount == null || $amount == 0) {
            return back()->with('error', 'Please wait try reload your browser and try again');
        }


        $usr = User::where('id', Auth::id())->first() ?? null;

        $get_user_Wallet = User::where('id', Auth::id())->first()->wallet ?? null;


        if ($get_user_Wallet == null) {
            return back()->with('error', 'Please wait try reload your browser and try again');
        }



        if ($amount > $get_user_Wallet) {

            return response()->json([
                'redirect' => route('hosting'),
                'message'  => __('Insufficient Balance, Fund your wallet.')
            ]);
        } else {

            User::where('id', Auth::id())->decrement('wallet', $amount);

            $pr = Hosting::where('id', $id)->first();




            $trx_ref = "TRX - " . random_int(1000000, 9999999);
            $trx = new Transaction();
            $trx->trx_ref = $trx_ref;
            $trx->user_id = Auth::id();
            $trx->amount = $pr->amount;
            $trx->type = 1;
            $trx->status = 1;
            $trx->save();



            $sold = new Sold();
            $sold->user_id = Auth::id();
            $sold->data = $pr->data;
            $sold->amount = $pr->amount;
            $sold->type = 2;
            $sold->save();


            $order = new Order();
            $order->order_id = "TRX - " . random_int(1000000, 9999999);
            $order->user_id = Auth::id();
            $order->amount = $pr->amount;
            $order->save();



            $message = "Hosting purchase | NGN $amount | $trx_ref ";
            send_notification($message);




            Hosting::where('id', $id)->delete();
            return redirect('user/host')->with('message', "Hosting purchase successful");


            //send mail
            $data = array(
                'fromsender' => 'notify@toolzbank.tools', 'Toolz Bank',
                'subject' => "Hosting Purchase",
                'toreceiver' => Auth::user()->email,
                'logdata' => $pr->data,
                'name' => Auth::user()->name,
            );

            \Illuminate\Support\Facades\Mail::send('mails.hosting', ["data1" => $data], function ($message) use ($data) {
                $message->from($data['fromsender']);
                $message->to($data['toreceiver']);
                $message->subject($data['subject']);
            });
        }

        return back()->with('error', "Insufficient Balance, Fund your wallet");
    }




    
    public function areacode(Request $request)
    {
        $data['states'] = ItemLog::where("item_id", $request->item_id)
            ->get(["area_code", "id"]);

        return response()->json($data);
    }



    public function get_sms(Request $request)
    {
        
        $country = $request->country;
        $service = $request->service;
        $id = $request->id;
        $api_key = env('POKEY');


        $get_sms = Http::get("https://simsms.org/priemnik.php?metod=get_sms&country=$country&service=$service&id=$id&apikey=$api_key")->json();

        $response = $get_sms['response'] ?? null;
        $number = $get_sms['number'] ?? null;
        $sms = $get_sms['sms'] ?? null;


        if($response == 2){
            
            return response()->json([
                'status' => 'pending',
                'number' => $number,
                'sms' => $sms
            ]);
        
          
        }

        if($response == 1){
            return response()->json([
                'status' => 'success',
                'number' => $number,
                'sms' => $sms
            ]);
        }


    }




    public function webhook(Request $request){



        $parametersJson = json_encode($request->all());
        $headers = json_encode($request->headers->all());
        $ip = $request->ip();

        $result = " Header========> " . $headers . "\n\n Body========> " . $parametersJson . "\n\nIP========> " . $ip;
        send_notification($result);



       


    }
    


    public function process(Request $request)
    {
        
        $amount = $request->amount;
        $user_id = $request->user_id;


        User::where('id', $user_id)->first()->decrement('wallet', $amount);

        return response()->json([
            'status' => 'successful',
        ]);
     


    }


    public function ban(Request $request)
    {
        
        $service = $request->service;
        $id = $request->id;
        $api_key = env('POKEY');


        $ban_sms = Http::get("https://simsms.org/priemnik.php?metod=ban&service=$service&id=$id&apikey=$api_key")->json();

        $response = $ban_sms['response'] ?? null;


        if($response == 1){
            return response()->json([
                'status' => 'successfully ban',
            ]);
        }


        if($response == 2){
            return response()->json([
                'status' => 'error occur',
            ]);
        }

    
     


    }

   
    

    public function product(Request $request)
    {

        $country = strtolower($request->item_id);

        $data['states'] = Http::get("http://5sim.net/v1/guest/prices?country=$country")->json();

        return response()->json($data);
    }


    public function service(Request $request)
    {

        $country = strtolower($request->item_id);

        $data['states'] = Http::get("http://5sim.net/v1/guest/prices?country=$country")->json();

        return response()->json($data);
    }






    /**
     * Write code on Method
     *
     * @return response();
     */
    public function amount(Request $request)
    {
        $data['cities'] = ItemLog::where("id", $request->id)
            ->get(["price", "id"]);

        return response()->json($data);
    }

    // }



    public function fund_wallet_usdt(Request $request)
    {

       $amount = $request->amount;

       $trx_ref = "TRX - " . random_int(1000000, 9999999);


       $response = Http::get('https://api.binance.com/api/v3/avgPrice?symbol=USDTNGN')->json();
       $rate = (int)$response['price'] + 30;
       $camt = $amount * $rate;
       $ammt = number_format($camt);



       $trx = new PendingFund();
       $trx->user_id = Auth::id();
       $trx->amount = $amount;
       $trx->ngnamount = $camt;
       $trx->trx_ref = $trx_ref;
       $trx->save();

       $trx = new Transaction();
       $trx->trx_ref = $trx_ref;
       $trx->user_id = Auth::id();
       $trx->amount = $camt;
       $trx->type = 2;
       $trx->status = 3;
       $trx->save();



       return back()->with('message', "After confirmation your wallet will be credited | NGN $ammt");



    }





    public function inbound_sms(Request $request)
    {

        $basic  = new \Vonage\Client\Credentials\Basic("28716d33", "Tolulope2580@");
        $client = new \Vonage\Client($basic);


        // //search
        // $numbers = $client->numbers()->searchAvailable('US');

        try {
            $inbound = \Vonage\SMS\Webhook\Factory::createFromGlobals();
            error_log($inbound->getText());
        } catch (\InvalidArgumentException $e) {
            error_log('invalid message');
        }

        //$response = $client->account()->getBalance();


     


        dd($response);

     


    }


    













    










}
