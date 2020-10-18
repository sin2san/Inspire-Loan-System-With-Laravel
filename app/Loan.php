<?php namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Loan extends Authenticatable
{
    protected $table = 'loans';
    protected $fillable = ['loan_id', 'user_id', 'term', 'amount', 'outstanding_amount', 'status'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function payment()
    {
        return $this->hasMany('App\Payment');
    }
}

