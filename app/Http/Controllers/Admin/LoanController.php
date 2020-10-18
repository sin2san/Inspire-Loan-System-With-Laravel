<?php namespace App\Http\Controllers\Admin;

use Auth;
use DateTime;
use App\Loan;
use App\Payment;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\LoanRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class LoanController extends Controller
{
    public function __construct(Loan $loan, Payment $payment)
    {
        $this->module = "loan";
        $this->data = $loan;
        $this->payment = $payment;
        $this->option = Cache::get('optionCache');
        $this->middleware('auth');
    }

    public function index()
    {
        $module = $this->module;
        if(Auth::user()->hasRole('admin')){
            $allData = $this->data->orderBy('id', 'DESC')->get();
        }else{
            $allData = $this->data->orderBy('id', 'DESC')->where('user_id', Auth::id())->get();
        }

        return view('admin.'.$module.'.index', compact('allData', 'module'));
    }

    public function get_apply()
    {
        $module = $this->module;

        return view('admin.'.$module.'.apply', compact('module'));
    }

    public function post_apply(LoanRequest $request)
    {
        if(($this->data->count())>0){
            $loan = $this->data->orderBy('loan_id', 'DESC')->first();
            $loanId = $loan->loan_id + 1;
        }else{
            $loanId = 100000;
        }
        $this->data->fill($request->all());
        $this->data->user_id = Auth::id();
        $this->data->loan_id = $loanId;
        $this->data->outstanding_amount = $request->amount;
        $this->data->status = 0;
        $this->data->save();

        return redirect()->back()->with('success', 'You are successfully applied for loan.');
    }

    public function update_status($id, $status)
    {
        $id = \Crypt::decrypt($id);
        $singleData = $this->data->find($id);
        if($status == 'update-status-approve') {
            $value = 1;
        }else{
            $value = 2;
        }
        $singleData->status = $value;
        $singleData->save();

        return redirect()->back()->with('success', 'Loan status is successfully updated.');
    }

    public function update_payment($id, Request $request){
        $id = \Crypt::decrypt($id);

        $request->validate([
            'amount' => 'numeric|min:0|required'
        ]);

        $singleData = $this->data->find($id);
        $this->payment->amount = $request->amount;
        $this->payment->loan_id = $id;
        $this->payment->date = new DateTime;

        $payment = $this->payment->where('loan_id', $id)->orderBy('id', 'DESC')->first();

        if($payment){
            $weekNo = $payment->week + 1;
        }else{
            $weekNo = 1;
        }

        $this->payment->week = $weekNo;
        $outstandingAmount = $singleData->outstanding_amount - $request->amount;
        $singleData->outstanding_amount = $outstandingAmount;

        if($outstandingAmount < 0)
        return redirect()->back()->with('error', 'Please enter a valid amount.');

        $this->payment->save();
        $singleData->save();

        return redirect()->back()->with('success', 'Your payment is successfully recorded as paid.');
    }

    public function get_view($id)
    {
        $id = \Crypt::decrypt($id);

        $module = $this->module;
        $singleData = $this->data->find($id);
        $payments = $this->payment->where('loan_id', $id)->orderBy('id', 'DESC')->get();

        return view('admin.'.$module.'.view',compact('module', 'singleData', 'payments'));
    }
}
