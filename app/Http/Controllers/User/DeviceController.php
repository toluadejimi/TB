<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Flag;
use App\Models\NetflixProduct;
use App\Models\NetLog;
use App\Models\Product;
use App\Models\Rate;
use App\Models\Server2Services;
use App\Models\Service;
use App\Models\Sold;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Hosting;
use App\Models\Reply;
use App\Models\Tempsale;


use App\Models\Smstransaction;
use App\Models\Template;
use App\Models\Plan;
use App\Models\User;
use DB;
use Auth;
use Session;
use Carbon\Carbon;
use App\Traits\Whatsapp;
use Aws\Api\Service as ApiService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;


class DeviceController extends Controller
{
    use Whatsapp;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = Device::where('user_id', Auth::id())->withCount('smstransaction')->latest()->paginate(20);


        $products = Product::all();
        $netflix_p = NetflixProduct::all();

        $wallet = \Illuminate\Support\Facades\Auth::user()->wallet;



        return view('user.device.index', compact('devices', 'products', 'wallet', 'netflix_p'));
    }



    public function rentview()
    {

        $wallet = Auth::user()->wallet;
        $token = env('TOKEN');
        $country = Http::get("http://api.sms-man.com/control/countries?token=$token")->json();
        return view('user.rent.rent', compact('country', 'wallet'));
    }


    public function instantview()
    {



        $wallet = Auth::user()->wallet;

        $countries = Flag::all();
        $services = Service::all();

        $country = null;
        $amount = null;
        $count = null;
        $service = null;
        $number_view = null;







        return view('user.instant.index', compact('wallet', 'number_view', 'service', 'amount', 'count', 'country', 'countries', 'services'));
    }



    public function server2()
    {

        $api_key = env('P2KEY');

        //$get_prices = Http::get("https://daisysms.com/stubs/handler_api.php?api_key=$api_key&action=getPricesVerification")->json() ?? null;

        $get_lists = Http::get("https://daisysms.com/stubs/handler_api.php?api_key=$api_key&action=getPrices")->json() ?? null;

        $getrate = Rate::where('pair', 'ngn')->first()->amount;


        $get2 = $get_lists['187'];

        $get_prices = [];
        foreach ($get2 as $key => $value) {
            $get_prices[] = array(
                "code" => $key,
                "name" => $value['name'],
                "count" => $value['count'],
                "cost" => $value['cost'] * $getrate,
                "cost2" => Crypt::encrypt($value['cost'] * $getrate),
            );



            // DB::table('server2_services')->insert($get_prices);




        }



        $wallet = Auth::user()->wallet;

        $countries = Flag::all();
        $services = Service::all();

        $country = null;
        $amount = null;
        $count = null;
        $service = null;
        $number_view = null;

        return view('user.instant.server2', compact('wallet', 'get_prices', 'number_view', 'service', 'amount', 'count', 'country', 'countries', 'services'));
    }


    public function ban_server2(Request $request)
    {

        $api_key = env('P2KEY');

        $service = $request->service;
        $code = $request->code;

        $cost = Crypt::decrypt($code);

        if (Auth::user()->wallet < $cost) {
            return back()->with('bad', 'Insufficient Funds, Please fund your wallet');
        }


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://daisysms.com/stubs/handler_api.php?api_key=$api_key&action=getNumber&service=$service",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
            ),
        ));
        $var = curl_exec($curl);
        $number = list($status, $id, $phone) = explode(':', $var) ?? null;


        if ($var != null) {


            $get_lists = Http::get("https://daisysms.com/stubs/handler_api.php?api_key=$api_key&action=getPrices")->json() ?? null;

            $getrate = Rate::where('pair', 'ngn')->first()->amount;


            $get2 = $get_lists['187'];

            $get_prices = [];
            foreach ($get2 as $key => $value) {
                $get_prices[] = array(
                    "code" => $key,
                    "name" => $value['name'],
                    "count" => $value['count'],
                    "cost" => $value['cost'] * $getrate,
                    "cost2" => Crypt::encrypt($value['cost'] * $getrate),
                );
            }

            $wallet = Auth::user()->wallet;
            $countries = Flag::all();
            $services = Service::all();

            $country = null;
            $amount = null;
            $count = null;
            $service = null;
            $number_view = 1;
            $country_name = "USA";
            $country_code = "+1";
            $number = $number['2'];
            $nid = $number['3'];
            $cost = $cost;



        
        $id = $request->nid;
        $api_key = env('P2KEY');

        $ban_sms = Http::get("https://daisysms.com/stubs/handler_api.php?api_key=$api_key&action=setStatus&id=$id&status=8")->json();

        dd($ban_sms);


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


        return view('user.instant.server2', compact('wallet', 'cost', 'get_prices', 'country_name', 'nid', 'country_code',  'number', 'number_view', 'service', 'amount', 'count', 'country', 'countries', 'services'));



    }







    public function buy_server2(request $request)
    {



        $api_key = env('P2KEY');

        $service = $request->service;
        $code = $request->code;

        $cost = Crypt::decrypt($code);

        if (Auth::user()->wallet < $cost) {
            return back()->with('bad', 'Insufficient Funds, Please fund your wallet');
        }


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://daisysms.com/stubs/handler_api.php?api_key=$api_key&action=getNumber&service=$service",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
            ),
        ));
        $var = curl_exec($curl);
        $number = list($status, $id, $phone) = explode(':', $var) ?? null;


        if ($var != null) {


            $get_lists = Http::get("https://daisysms.com/stubs/handler_api.php?api_key=$api_key&action=getPrices")->json() ?? null;

            $getrate = Rate::where('pair', 'ngn')->first()->amount;


            $get2 = $get_lists['187'];

            $get_prices = [];
            foreach ($get2 as $key => $value) {
                $get_prices[] = array(
                    "code" => $key,
                    "name" => $value['name'],
                    "count" => $value['count'],
                    "cost" => $value['cost'] * $getrate,
                    "cost2" => Crypt::encrypt($value['cost'] * $getrate),
                );
            }

            $wallet = Auth::user()->wallet;
            $countries = Flag::all();
            $services = Service::all();

            $country = null;
            $amount = null;
            $count = null;
            $service = null;
            $number_view = 1;
            $country_name = "USA";
            $country_code = "+1";
            $number = $number['2'];
            $nid = $number['3'];
            $cost = $cost;



            return view('user.instant.server2', compact('wallet', 'cost', 'get_prices', 'country_name', 'nid', 'country_code',  'number', 'number_view', 'service', 'amount', 'count', 'country', 'countries', 'services'));
        }







    }







    public function hostingview()
    {

        $products = Hosting::all();
        $wallet = Auth::user()->wallet;
        $soldhost = Sold::where('type', 2)->get();


        return view('user.host.index', compact('products', 'soldhost', 'wallet'));
    }


    public function log_out(request $request)
    {

        \Illuminate\Support\Facades\Session::flush();

        \Illuminate\Support\Facades\Auth::logout();

        return redirect('login');
    }

    /**
     * return device statics informations
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deviceStatics()
    {
        $data['total'] = Device::where('user_id', Auth::id())->count();
        $data['active'] = Device::where('user_id', Auth::id())->where('status', 1)->count();
        $data['inActive'] = Device::where('user_id', Auth::id())->where('status', 0)->count();
        $limit  = json_decode(Auth::user()->plan);
        $limit = $limit->device_limit ?? 0;

        if ($limit == '-1') {
            $data['total'] = $data['total'];
        } else {
            $data['total'] = $data['total'] . ' / ' . $limit;
        }


        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.device.create');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (getUserPlanData('device_limit') == false) {
            return response()->json([
                'message' => __('Maximum Device Limit Exceeded')
            ], 401);
        }

        $validated = $request->validate([
            'name' => 'required|max:100',
        ]);

        $device = new Device;
        $device->user_id = Auth::id();
        $device->name = $request->name;
        $device->save();

        return response()->json([
            'redirect' => url('user/device/' . $device->uuid . '/qr'),
            'message' => __('Device Created Successfully')
        ], 200);
    }

    public function scanQr($id)
    {
        $device = Device::where('user_id', Auth::id())->where('uuid', $id)->first();
        abort_if(empty($device), 404);
        return view('user.device.qr', compact('device', 'product'));
    }

    public function getQr($id)
    {
        $device = Device::where('user_id', Auth::id())->where('uuid', $id)->first();


        abort_if(empty($device), 404);

        $id = $device->id;
        $response = Http::post(env('WA_SERVER_URL') . '/sessions/add', [
            'id'       => 'device_' . $id,
            'isLegacy' => false
        ]);

        if ($response->status() == 200) {
            $body = json_decode($response->body());
            $data['qr'] = $body->data->qr;
            $data['message'] = $body->message;
            $device->qr = $body->data->qr;
            $device->save();

            return response()->json($data);
        } elseif ($response->status() == 409) {
            $data['qr']      = $device->qr;
            $data['message'] = __('QR code received, please scan the QR code');
            return response()->json($data);
        }
    }

    public function checkSession($id)
    {
        $device = Device::where('user_id', Auth::id())->where('uuid', $id)->first();
        abort_if(empty($device), 404);

        $id = $device->id;
        $response = Http::get(env('WA_SERVER_URL') . '/sessions/status/device_' . $id);

        $device->status = $response->status() == 200 ? 1 : 0;
        if ($response->status() == 200) {
            $res = json_decode($response->body());
            if (isset($res->data->userinfo)) {
                $device->user_name = $res->data->userinfo->name ?? '';
                $phone = str_replace('@s.whatsapp.net', '', $res->data->userinfo->id);
                $phone = explode(':', $phone);
                $phone = $phone[0] ?? null;

                $device->phone = $phone;
                $device->qr = null;
            }
        }
        $device->save();

        $message = $response->status() == 200 ? __('Device Connected Successfully') : null;

        return response()->json(['message' => $message, 'connected' => $response->status() == 200 ? true : false]);
    }

    public function setStatus($device_id, $status)
    {

        $device_id = str_replace('device_', '', $device_id);

        $device = Device::where('id', $device_id)->first();
        if (!empty($device)) {
            $device->status = $status;
            $device->save();
        }
    }

    public function webHook(Request $request, $device_id)
    {

        $session = $device_id;
        $device_id = str_replace('device_', '', $device_id);

        $device = Device::with('user')->whereHas('user')->where('id', $device_id)->first();
        if (empty($device)) {
            return response()->json([
                'message'  => array('text' => 'this is reply'),
                'receiver' => $request->from,
                'session_id' => $session
            ], 403);
        }

        if (getUserPlanData('chatbot', $device->user_id) == false) {
            return response()->json([
                'message'  => array('text' => 'this is reply'),
                'receiver' => $request->from,
                'session_id' => $session
            ], 401);
        }

        $request_from = explode('@', $request->from);
        $request_from = $request_from[0];

        $message_id = $request->message_id ?? null;
        $message = $request->message ?? null;
        $device_id = $device_id;


        if (strlen($message) < 50 && $device != null && $message != null) {
            $replies = Reply::where('device_id', $device_id)->with('template')->where('keyword', 'LIKE', '%' . $message . '%')->latest()->get();

            foreach ($replies as $key => $reply) {
                if ($reply->match_type == 'equal') {

                    if ($reply->reply_type == 'text') {

                        return response()->json([
                            'message'  => array('text' => $reply->reply),
                            'receiver' => $request->from,
                            'session_id' => $session
                        ], 200);
                    } else {
                        if (!empty($reply->template)) {
                            $template = $reply->template;

                            if (isset($template->body['text'])) {
                                $body = $template->body;
                                $text = $this->formatText($template->body['text'], [], $device->user);
                                $body['text'] = $text;
                            } else {
                                $body = $template->body;
                            }

                            return response()->json([
                                'message'  => $body,
                                'receiver' => $request->from,
                                'session_id' => $session
                            ], 200);
                        }
                    }

                    break;
                }
            }
        }


        return response()->json([
            'message'  => array('text' => 'this is reply'),
            'receiver' => $request->from,
            'session_id' => $session
        ], 403);
    }

    public function logoutSession($id)
    {
        $device = Device::where('user_id', Auth::id())->where('uuid', $id)->first();
        abort_if(empty($device), 404);

        $device->status = 0;
        $device->qr = null;
        $device->save();

        $id = $device->id;
        $response = Http::delete(env('WA_SERVER_URL') . '/sessions/delete/device_' . $id);

        return response()->json(['message' => __('Congratulations! Your Device Successfully Logout')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $device = Device::where('user_id', Auth::id())->where('uuid', $id)->first();
        abort_if(empty($device), 404);

        $posts = Smstransaction::where('user_id', Auth::id())->where('device_id', $device->id)->latest()->paginate();
        $totalUsed = Smstransaction::where('user_id', Auth::id())->where('device_id', $device->id)->count();
        $todaysMessage = Smstransaction::where('user_id', Auth::id())->where('device_id', $device->id)->whereDate('created_at', Carbon::today())->count();
        $monthlyMessages = Smstransaction::where('user_id', Auth::id())
            ->where('device_id', $device->id)
            ->where('created_at', '>', now()->subDays(30)->endOfDay())
            ->count();


        return view('user.device.show', compact('device', 'posts', 'totalUsed', 'todaysMessage', 'monthlyMessages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $device = Device::where('user_id', Auth::id())->where('uuid', $id)->first();
        abort_if(empty($device), 404);
        return view('user.device.edit', compact('device'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
        ]);

        $device = Device::where('user_id', Auth::id())->where('uuid', $id)->first();
        abort_if(empty($device), 404);

        $device->name = $request->name;
        $device->save();

        return response()->json([
            'redirect' => url('/user/device'),
            'message' => __('Device Updated Successfully')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $device = Device::where('user_id', Auth::id())->where('uuid', $id)->first();
        abort_if(empty($device), 404);
        try {
            if ($device->status == 1) {
                Http::delete(env('WA_SERVER_URL') . '/sessions/delete/device_' . $device->id);
            }
        } catch (Exception $e) {
        }
        $device->delete();

        return response()->json([
            'message' => __('Congratulations! Your Device Successfully Removed'),
            'redirect' => route('user.device.index')
        ]);
    }

    public function get_number(request $request)
    {


        $get_country = $request->country;
        $get_service = $request->service;
        $api_key = env('POKEY');


        $country = Flag::where('country', $get_country)->first()->code;
        $service = Service::where('service', $get_service)->first()->code;



        $wallet = Auth::user()->wallet;

        $countries = Flag::all();
        $services = Service::all();




        $get_rate = Rate::where('pair', 'usd')->first()->amount;
        $getrate = Rate::where('pair', 'ngn')->first()->amount;




        if ($getrate == null) {
            $rate = 780;
        }
        $ngn_rate = (int)$getrate;
        $get_service_price = Http::get("https://simsms.org/priemnik.php?metod=get_service_price&country=$country&service=$service&apikey=$api_key")->json();
        $get_count = Http::get("https://simsms.org/priemnik.php?metod=get_count_new&service=$service&apikey=$api_key&country=$country")->json();
        $service_price = $get_service_price['price'] ?? null;

        $get_amount = round($service_price * $get_rate * $ngn_rate);

        if ($get_amount <= 500) {
            $amount = 1000;
        } elseif ($get_amount <= 1000) {

            $amount = 1800;
        } elseif ($get_amount <= 1800) {

            $amount = 2800;
        } elseif ($get_amount <= 1800) {

            $amount = 3800;
        } elseif ($get_amount <= 3800) {

            $amount = 4800;
        } elseif ($get_amount <= 4800) {

            $amount = 5800;
        } else {

            $amount = 7800;
        }

        $flag =  Flag::where('code', $country)->first()->flag ?? null;
        $country =  Flag::where('code', $country)->first()->country ?? null;

        $service =  Service::where('code', $service)->first()->service ?? null;

        $count =  $get_count['total'] ?? null;

        $number_view = 2;




        if ($service_price == null || $count == null) {
            return back()->with('error', 'Number not available, check server 2');
        }

        return view('user.instant.index', compact('amount', 'number_view', 'count', 'country', 'flag', 'service', 'wallet', 'countries', 'services'))->with('message', "Number is availave for use");
    }


    public function ban_number(request $request)
    {

        $country = $request->country;
        $service = $request->service;
        $id = $request->id;
        $api_key = env('POKEY');


        $wallet = Auth::user()->wallet;

        $countries = Flag::all();
        $services = Service::all();
        $number_view = null;


        $ban_sms = Http::get("https://simsms.org/priemnik.php?metod=ban&service=$service&id=$id&apikey=$api_key")->json();


        $response = $ban_sms['response'] ?? null;




        if ($response == 1) {


            $country = null;
            $amount = null;
            $count = null;
            $service = null;
            $number_view = null;

            return view('user.instant.index', compact('wallet', 'number_view', 'service', 'amount', 'count', 'country', 'countries', 'services'));
        }


        if ($response == 2) {

            $country = null;
            $amount = null;
            $count = null;
            $service = null;
            $number_view = null;

            return view('user.instant.index', compact('wallet', 'number_view', 'service', 'amount', 'count', 'country', 'countries', 'services'));
        }


        if ($response == 3) {
            $country = null;
            $amount = null;
            $count = null;
            $service = null;
            $number_view = null;

            return view('user.instant.index', compact('wallet', 'number_view', 'service', 'amount', 'count', 'country', 'countries', 'services'));
        }
    }




    public function buy_instant(request $request)
    {


        $country = $request->country;
        $service = $request->service;
        $amount = $request->amount;

        $api_key = env('POKEY');

        $get_country_code =  Flag::where('country', $country)->first()->code ?? null;
        $get_service_code =  Service::where('service', $service)->first()->code ?? null;

        $wallet = Auth::user()->wallet;

        $countries = Flag::all();
        $services = Service::all();

        if ($amount > $wallet) {
            return back()->with('error', 'Insufficient Balance, Please Fund your wallet');
        }




        $get_number = Http::get("https://simsms.org/priemnik.php?metod=get_number&country=$get_country_code&service=$get_service_code&apikey=$api_key")->json();
        $response = $get_number['response'] ?? null;

        if ($response == 1) {

            $number = $get_number['number'] ?? null;
            $country_code = $get_number['CountryCode'] ?? null;
            $id = $get_number['id'] ?? null;
            $country = $get_number['country'] ?? null;
            $number_view = 1;


            $country_cc = $get_country_code;
            $service_cc = $get_service_code;



            $get_rate = Rate::where('pair', 'usd')->first()->amount;
            $getrate = Rate::where('pair', 'ngn')->first()->amount;



            if ($getrate == null) {
                $rate = 780;
            }
            $ngn_rate = (int)$getrate;
            $get_service_price = Http::get("https://simsms.org/priemnik.php?metod=get_service_price&country=$country&service=$service&apikey=$api_key")->json() ?? null;
            $get_count = Http::get("https://simsms.org/priemnik.php?metod=get_count_new&service=$service&apikey=$api_key&country=$country")->json() ?? null;


            $service_price = $get_service_price['price'] ?? null;



            $get_amount = round($service_price * $get_rate * $ngn_rate);

            if ($get_amount <= 500) {
                $amount = 1000;
            } elseif ($get_amount <= 1000) {

                $amount = 1800;
            } elseif ($get_amount <= 1800) {

                $amount = 2800;
            } elseif ($get_amount <= 1800) {

                $amount = 3800;
            } elseif ($get_amount <= 3800) {

                $amount = 4800;
            } elseif ($get_amount <= 4800) {

                $amount = 5800;
            } else {

                $amount = 7800;
            }



            $flag =  Flag::where('code', $country)->first()->flag ?? null;
            $country_name =  Flag::where('code', $country)->first()->country ?? null;

            $country =  Flag::where('code', $country)->first()->country ?? null;



            $service =  Service::where('code', $service)->first()->service ?? null;

            $count =  $get_count['total'] ?? null;




            return view('user.instant.index', compact('amount', 'service_cc', 'country_cc', 'id', 'number', 'country_name', 'country_code', 'number_view', 'count', 'country', 'flag', 'service', 'wallet', 'countries', 'services'))->with('message', "Number is availave for use");
        } else {

            return back()->with('error', 'Service not available, Try server 2');
        }
    }
}
