<?php namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Loan;
use App\Payment;
use App\Option;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->option = Cache::get('optionCache');
        $this->middleware('auth');
    }

    public function index()
    {
        $admins = User::role('admin')->count();
        $customers = User::role('customer')->count();

        if(Auth::user()->hasRole('admin')){
            $loans = Loan::count();
            $payments = Payment::count();
        }else{
            $loans = Loan::where('user_id', Auth::id())->count();
            $payments = Payment::WhereHas('loan', function($query){
                $query->where('user_id', Auth::id());
            })->count();
        }

        return view('admin.home.dashboard', compact('admins', 'customers', 'loans', 'payments'));
    }

    public function cache_flush()
    {
        Cache::flush();
        $option = Option::first();
        Cache::forever('optionCache', $option);

        return redirect()->back()->with('success', 'All cache data removed');
    }

}
