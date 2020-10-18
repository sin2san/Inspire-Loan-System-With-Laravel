<?php namespace App\Http\Controllers\Site;

use App\Option;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        if(Cache::has('optionCache')){
            $option = Cache::get('optionCache');
        }else{
            $option = Option::first();
            Cache::forever('optionCache', $option);
        }
        return view('site.home.index');
    }
}
