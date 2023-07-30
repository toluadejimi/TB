<?php
namespace App\Console\Commands;
use App\Models\Rate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\User;
class DailyRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rate:daily';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update  Rate on daily bases';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }  
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $get_rate = Http::get("https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1/latest/currencies/rub/usd.json")->json();
        $getrate = Http::get('https://api.binance.com/api/v3/avgPrice?symbol=USDTNGN')->json() ?? null;


        $ngn = (int)$getrate['price'];

        $usd = $get_rate['usd'];


       Rate::where('pair', 'usd')->update(['amount' => $usd]);
       Rate::where('pair', 'ngn')->update(['amount' => $ngn]);

        $this->info('Successfully updated.');



        

    }
}