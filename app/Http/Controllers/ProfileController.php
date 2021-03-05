<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Domains\Auth\Services\UserService;
use App\Http\Requests\User\UpdateProfileRequest;

class ProfileController extends Controller
{

     /**
     * @param  User  $user
     *
     * @return mixed
     */
    public function profile() {
        return view('auth.profile')->withUser(auth()->user());
    }

    /**
     * @param  UpdateProfileRequest  $request
     * @param  UserService  $userService
     *
     * @return mixed
     */
    public function update(UpdateProfileRequest $request, UserService $userService)
    {

        $logged_in_user = Auth::user();


        if(isset($request['id_front_image']))
        {
            $imageName = time().'.'.$request->id_front_image->extension();  
            $request->id_front_image->move(storage_path('app/public/images'), $imageName);   
            $request['id_front_image_name'] = $imageName;
        }

        if(isset($request['id_back_image']))
        {
            $imageName = time().'.'.$request->id_back_image->extension();  
            $request->id_back_image->move(storage_path('app/public/images'), $imageName);   
            $request['id_back_image_name'] = $imageName; 
        }

        if(isset($request['passport_front_image']))
        {
            $imageName = time().'.'.$request->passport_front_image->extension();  
            $request->passport_front_image->move(storage_path('app/public/images'), $imageName); 
            $request['passport_front_image_name'] = $imageName; 

        }

        if(isset($request['passport_back_image']))
        {
            $imageName = time().'.'.$request->passport_back_image->extension();  
            $request->passport_back_image->move(storage_path('app/public/images'), $imageName); 
            $request['passport_back_image_name'] = $imageName; 

        }
        $userService->updateProfile($request->user(), $request->all());

        if ($logged_in_user->isAdmin()) {
            return redirect()->route('admin.home')->withFlashSuccess(__('Profile successfully updated.'));
        } else {
            return redirect()->route('user.home')->withFlashSuccess(__('Profile successfully updated.'));
        }

    }
}
