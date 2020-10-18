<?php namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Payment extends Authenticatable
{
    public $timestamps = false;
    protected $table = 'payments';
    protected $fillable = ['loan_id', 'amount', 'week', 'date'];

    public function loan()
    {
        return $this->belongsTo('App\Loan', 'loan_id');
    }
}

