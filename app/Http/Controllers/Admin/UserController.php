<?php namespace App\Http\Controllers\Admin;

use Auth;
use Hash;
use App\User;
use App\Http\Requests\Admin\ProfileRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller {

    public function __construct(User $user)
    {
        $this->module = "user";
        $this->data = $user;

        $this->option = Cache::get('optionCache');
        $this->middleware('auth');
    }

    public function get_profile()
    {
        $module = $this->module;
        $singleData = $this->data->find(Auth::id());

        return view('admin.'.$module.'.profile', compact('singleData', 'module'));
    }

    public function post_profile(ProfileRequest $request)
    {
        $module = $this->module;
        $user = $this->data->find(Auth::id());
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $old_image = $image_name = $user->image;

        //PROFILE IMAGE UPLOAD FUNCTION
        if($request->image)
        {
            $image = $request->image;
            $image_name = 'PI_'.time().'.'.$image->getClientOriginalExtension();
            $image_path = $module.'s/'.$image_name;
            Storage::put($image_path, file_get_contents($image), 'public');
            if($old_image)
                Storage::delete($module.'s/'.$old_image);
            }
        $user->image = $image_name;
        $user->save();

        return redirect()->back()->with('success', 'Profile has been successfully updated');
    }

    public function delete_image()
    {
        $module = $this->module;
        $data = $this->data->find(Auth::id());

        if($data){
            Storage::delete($module.'s/'.$data->image);
            $data->update(['image' => NULL]);

            return redirect()->back()->with('success', 'Profile image has been deleted successfully.');
        }else{
            return redirect()->back()->with('error', 'Profile image has not been deleted.');
        }
    }
}
