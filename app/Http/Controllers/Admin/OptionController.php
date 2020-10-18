<?php namespace App\Http\Controllers\Admin;

use App\Option;
use App\Http\Requests\Admin\OptionRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class OptionController extends Controller
{
    public function __construct(Option $option)
    {
        $this->module = "option";
        $this->data = $option;
        $this->middleware('auth');
    }

    public function get_edit()
    {
        $module = $this->module;
        $singleData = $this->data->first();

        return view('admin.'.$module.'.index',compact('singleData', 'module'));
    }

    public function post_edit(OptionRequest $request)
    {
        $module = $this->module;

        $this->data = $this->data->first();
        $old_favicon = $favicon_name = $this->data->favicon;
        $old_logo = $logo_name = $this->data->logo;
        $this->data->fill($request->all());

        //FAV ICON UPLOAD FUNCTION
        if($request->favicon) {
            $file_favicon = $request->favicon;
            $favicon_name = $file_favicon->getClientOriginalName();
            $favicon_path = $module.'s/'.$favicon_name;
            Storage::put($favicon_path, file_get_contents($file_favicon), 'public');
            if($old_favicon)
                Storage::delete($module.'s/'.$old_favicon);
        }
        $this->data->favicon = $favicon_name;

        //LOGO UPLOAD FUNCTION
        if($request->logo) {
            $file_logo = $request->logo;
            $logo_name = $file_logo->getClientOriginalName();
            $logo_path = $module.'s/'.$logo_name;
            Storage::put($logo_path, file_get_contents($file_logo), 'public');
            if($old_logo)
                Storage::delete($module.'s/'.$old_logo);
        }
        $this->data->logo = $logo_name;
        $this->data->save();

        Cache::forever('optionCache', $this->data);
        return redirect()->back()->with('success', 'Your data has been updated successfully');
    }

    public function delete_logo()
    {
        $module = $this->module;
        $data = Option::first();

        if($data){
            Storage::delete($module.'s/'.$data->logo);
            $data->update(['logo'=> NULL]);
            return redirect()->back()->with('success', 'The logo has been deleted successfully.');
        }else{
            return redirect()->back()->with('error', 'The logo has not been deleted.');
        }
    }

    public function delete_favicon()
    {
        $module = $this->module;
        $data = Option::first();

        if($data){
            Storage::delete($module.'s/'.$data->favicon);
            $data->update(['favicon'=> NULL]);
            return redirect()->back()->with('success', 'The favicon has been deleted successfully.');
        }else{
            return redirect()->back()->with('error', 'The favicon has not been deleted.');
        }
    }
}
