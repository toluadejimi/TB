<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Sold;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Smstransaction;
use App\Models\Schedulemessage;
use App\Models\Contact;
use App\Models\Link;
use Carbon\Carbon;
use Auth;
use Session;
use Illuminate\Support\Facades\Http;


class DashboardController extends Controller
{
    public function index(request $request)
    {
        
        $transactions = Transaction::latest()->where('user_id', Auth::id())
        ->paginate('10');


        $wallet = Auth::user()->wallet;


        $token = env('TOKEN');
        $tc_log = Sold::where('user_id', Auth::id())->count();
        $c_logs = Sold::where('user_id', Auth::id())->count();

        $amount = Transaction::where('user_id', Auth::id())->where('type', 1)->sum('amount');


        $link = Link::where('id', 2)->first();

        $getrate = Http::get('https://api.binance.com/api/v3/avgPrice?symbol=USDTNGN')->json() ?? null;

        if($getrate == null){
            $rate = 780;
        } $rate = (int)$getrate['price'] + 30;

       
        $whatapplink = Link::where('name', 'whatsapp')->first()->data ?? null; 
       
        return view('user.dashboard', compact('transactions', 'link', 'rate', 'amount', 'whatapplink', 'wallet', 'c_logs', 'tc_log', 'request'));
    }

    public function dashboardData()
    {
        $data['devicesCount'] = Device::where('user_id',Auth::id())->count();
        $data['messagesCount'] = Smstransaction::where('user_id',Auth::id())->count();
        $data['contactCount'] = Contact::where('user_id',Auth::id())->count();
        $data['scheduleCount'] = Schedulemessage::where('status','pending')->where('user_id',Auth::id())->count();
        
        $data['devices'] = Device::where('user_id',Auth::id())->withCount('smstransaction')->orderBy('status','DESC')->latest()->get()->map(function($rq){
                $map['uuid']= $rq->uuid;
                $map['name']= $rq->name;
                $map['status']= $rq->status;
                $map['phone']= $rq->phone;
                $map['smstransaction_count']= $rq->smstransaction_count;
                return $map;
        });
        $data['messagesStatics'] = $this->getMessagesTransaction(7);
        $data['typeStatics'] = $this->messagesStatics(7);
        $data['chatbotStatics'] = $this->getChatbotTransaction(7);

        
        return response()->json($data);

    }

    public function getMessagesTransaction($days)
    {
       $statics= Smstransaction::query()->where('user_id',Auth::id())
                ->whereDate('created_at', '>', Carbon::now()->subDays($days))
                ->orderBy('id', 'asc')
                ->selectRaw('date(created_at) date, count(*) smstransactions')
                ->groupBy('date')
                ->get();

        return $statics;
                
    }

    public function getChatbotTransaction($days)
    {
        $statics= Smstransaction::query()
                ->where('user_id',Auth::id())
                ->where('type','chatbot')
                ->whereDate('created_at', '>', Carbon::now()->subDays($days))
                ->orderBy('id', 'asc')
                ->selectRaw('date(created_at) date, count(*) smstransactions')
                ->groupBy('date')
                ->get();

        return $statics;
    }

    public function messagesStatics($days)
    {
        $statics= Smstransaction::query()->where('user_id',Auth::id())
                ->whereDate('created_at', '>', Carbon::now()->subDays($days))
                ->orderBy('id', 'asc')
                ->selectRaw('type type, count(*) smstransactions')
                ->groupBy('type')
                ->get();

        return $statics;
    }
}
