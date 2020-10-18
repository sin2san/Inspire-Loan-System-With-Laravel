<?php namespace App\Http\ViewComposers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

class HeaderComposer {

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function includeDataAdmin(View $view)
    {
        $users = $this->user->where('id', Auth::id())->first();
	    $view->with('users', $users);
    }
}
