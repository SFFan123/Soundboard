<?php

namespace Soundboard\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Soundboard\Role;
use Soundboard\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Auth::user()->authorizeRoles('Manager');
        $users = User::all();
        return view('User.manage', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \Auth::user()->authorizeRoles('Manager');
        $roles = Role::all();
        return view('User.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Auth::user()->authorizeRoles('Manager');
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        new Registered($user = $this->storeUser($request->all()));
        $user->roles()->attach(Role::where('name', 'user')->first());

        //TODO make this dynamic LOL
        if($request->has('role_2'))
        {
            $user->roles()->attach(Role::where('name', Role::findOrFail('2')->name)->first());
        }

        return redirect()->route('ManageUser');
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
    public function edit($id)
    {
        if(\Auth::user()->id != $id)
        {
            \Auth::user()->authorizeRoles('Manager');
        }

        if(!is_numeric($id))
        {
            abort(404);
        }
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('User.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        if(!is_numeric($id))
        {
            abort(403);
        }
        if(\Auth::user()->id != $id)
        {
            \Auth::user()->authorizeRoles('Manager');
        }
        $user = User::findOrFail($id);

        $this->validate($request,
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
            ]);

        if($user->email != $request->email)
        {
            $this->validate($request,
                [
                    'email' => 'required|string|email|max:255|unique:users',
                ]);
            $user->email = trim($request->email);
        }
        if($request->password != null)
        {
            $this->validate($request,
                [
                    'password' => 'required|string|min:6|confirmed',
                ]);
            $user->password = Hash::make($request->password);
        }
        $user->name = trim($request->name);
        //TODO make this dynamic LOL
        $roles = Role::all();

        foreach ($roles as $role)
        {
            if($request->has('role_'. $role->id))
            {
                if(! $user->hasRole($role->name))
                {
                    $user->roles()->attach($role);
                }
            }
            else
            {
                if($user->hasRole($role->name))
                {
                    $user->roles()->detach($role);
                }
            }
        }
        $user->save();

        return back();
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($outid, Request $request)
    {
        $id = Crypt::decrypt($request->id);
        if($outid != $id)
        {
            abort(422 );
        }
        if(\Auth::user()->id != $id)
        {
            \Auth::user()->authorizeRoles('Manager');
        }
        $UserToDelete = User::find($id);

        $RolesToDelete = Role::where('user_id', $id);

        foreach ($RolesToDelete as $RoleToDelete)
        {
            $RoleToDelete->delete();
        }

        $UserToDelete->delete();

        return redirect('/user/manage');
    }


    private function storeUser(array $data)
    {
        \Auth::user()->authorizeRoles('Manager');

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->roles()->attach(Role::where('name', 'user')->first());

        return $user;
    }

    public function apiUser(Request $request){
        return $request->user();
    }
}
