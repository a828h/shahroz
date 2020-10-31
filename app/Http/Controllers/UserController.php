<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\updateProfileRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
   
    public function profile()
    {
        return view('profile.edit')
            ->withUser(auth()->user())
            ->withPageTitle(__('client.users.title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateProfileRequest $request)
    {
        $user = auth()->user();
        $data = $request->all();
        $user->update([
            'first_name' => $data['first_name'] ?? $user->first_name,
            'last_name' => $data['last_name'] ?? $user->last_name,
            'brand' => $data['brand'] ?? $user->brand,
            'mobile' => $data['mobile'] ?? $user->mobile,
            'email' => $data['email'] ?? $user->email,
            'password' => Hash::make($data['password']) ?? $user->password,
        ]);

        return redirect()->back()->withSuccess(__('auth.profile.messages.updated'));
    }
}
