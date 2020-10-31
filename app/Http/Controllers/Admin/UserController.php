<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\users\listUserRequest;
use App\Http\Requests\admin\users\storeUserRequest;
use App\Http\Requests\admin\users\updateUserRequest;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(listUserRequest $request)
    {
        $req = $request->all();
        $users = $this->user
            ->search($req['search'] ?? '')
            ->statusIs($req['status'] ?? '')
            ->roleIs($req['role'] ?? '')
            ->orderBy($req['order_col'] ?? 'id', $req['order_dir'] ?? 'desc')
            ->paginate($req['perpage'] ?? 10);

        return view('admin.users.index')
            ->withUsers($users)
            ->withData($req);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeUserRequest $request)
    {
        $data = $request->all();
        User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'brand' => $data['brand'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'role' => $data['role'],
            'status' => $data['status'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('admin.users.index')->withSuccess( __('admin.users.messages.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit')
            ->withUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateUserRequest $request, User $user)
    {
        $data = $request->all();
        $user->update([
            'first_name' => $data['first_name'] ?? $user->first_name,
            'last_name' => $data['last_name'] ?? $user->last_name,
            'brand' => $data['brand'] ?? $user->brand,
            'mobile' => $data['mobile'] ?? $user->mobile,
            'email' => $data['email'] ?? $user->email,
            'role' => $data['role'] ?? $user->role,
            'status' => $data['status'] ?? $user->status,
            'password' => Hash::make($data['password']) ?? $user->password,
        ]);

        return redirect()->route('admin.users.index')->withSuccess(__('admin.users.messages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->withSuccess(__('admin.users.messages.deleted'));
    }
}
