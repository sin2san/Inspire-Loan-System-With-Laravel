<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class OptionComposer {

    public function includeData(View $view )
    {
        $option = Cache::get('optionCache');
        $view->with('option', $option);
    }
}