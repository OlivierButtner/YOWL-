<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateuserRequest;
use App\Http\Requests\StoreuserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\True_;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        if (auth()->user()->is_admin == 1) {
            $userCreated = User::create($request->only('username', 'email', 'password'));
            return response(json_encode($userCreated), 200);
        } else {
            return response('You cannot create users', 403);
        }
    }

    public function show($user)
    {
        return User::find($user);
    }

    public function update(Request $request,User $user)
    {
        if (auth()->user()->is_admin == 1) {
            $user->update([
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'is_admin' => $request->is_admin,
            ]);
          return response(json_encode($user), 200);
        } else {
            if (Auth::id() == $user->id) {
                $user->update([
                    'username' => $request->username,
                    'email' => $request->email,
            //       'password' => bcrypt($request->password),
                  //  'password' => $request->password,
                ]);
                return response(json_encode($user), 200);
            } else {
                return response('You cannot update users', 403);
            }
        }
    }

    public function destroy(User $user)
    {
        if (auth()->user()->is_admin == 1) {
            $user->delete();
            return response('User deleted !', 200);
        } else {
            if (auth()->user()->id == $user->id) {
                $user->delete();
                return response('Profil deleted !', 200);
            } else {
                return response('You cannot destroy users', 403);
            }
        }
    }
        public function searchUser(Request $request){

          $key = trim($request->get('searchTerm'));

            $userSearch = User::query()
                ->where('username', 'like', "%{$key}%")
                ->orderBy('created_at', 'desc')
                ->get();

            return response(json_encode($userSearch), 200);
        }
    /**
     * Count number of users
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Count number of comments per user
     *
     * @return \Illuminate\Http\Response
     */


}
