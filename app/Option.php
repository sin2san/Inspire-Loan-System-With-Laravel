<?php namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Option extends Authenticatable
{
    protected $table = 'option';
    protected $fillable = ['name', 'title', 'description', 'keywords', 'phone', 'mobile', 'email', 'favicon', 'logo', 'company_name','company_web_url'];
}
