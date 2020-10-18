<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\View\Factory as ViewFactory;

class ComposerServiceProvider extends ServiceProvider {

    public function register()
    {
        //
    }

    public function boot(ViewFactory $view)
    {
        $view->composers([
            'App\Http\ViewComposers\OptionComposer@includeData' => '*',
            'App\Http\ViewComposers\HeaderComposer@includeDataAdmin' => 'admin.partials.mainheader',
	        'App\Http\ViewComposers\SidebarComposer@includeDataAdmin' => 'admin.partials.sidebar'
        ]);
    }
}
