<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AshAllenDesign\LaravelExchangeRates\ExchangeRate;

use Guzzle\Http\Exception\ClientErrorResponseException;

use carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function exchangeCurrency(Request $request) {

        $amount = ($request->amount)?($request->amount):(1);

        $apikey = 'c42f44790b8e53155f2c';

        $from_Currency = urlencode($request->from_currency);
        $to_Currency = urlencode($request->to_currency);
        $query =  "{$from_Currency}_{$to_Currency}";


        $json = file_get_contents("http://free.currencyconverterapi.com/api/v5/convert?q={$query}&compact=y&apiKey={$apikey}");

        $obj = json_decode($json, true);

        $val = $obj["$query"];

        $total = $val['val'] * 1;

        $formatValue = number_format($total, 2, '.', '');

        $data = "$amount $from_Currency = $to_Currency $formatValue";

        echo $data; die;



     }
}
