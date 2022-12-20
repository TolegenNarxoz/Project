<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
        $users = null;
        if($request->search){
            $users = User::where('name', 'LIKE', '%'.$request->search.'%')
            ->orWhere('email', 'LIKE', '%'.$request->search.'%')
            ->with('role')->get();
        }
        else{
            $users = User::with('role')->get();
        }
        return view('adm.users',['users' => $users]);
    }

    public function ban(User $user){
        $this->authorize('ban',$user);
        $user->update([
            'is_active' => false,
        ]);
        return back();
    }

    public function unban(User $user){
        $this->authorize('unban',$user);
        $user->update([
            'is_active' => true,
        ]);
        return back();
    }

    public function edit(User $user){
        $this->authorize('osgertu',$user);
        return view('users.edit', ['user' => $user, 'roles' => Role::all()]);
    }


    public function update(Request $request, User $user){

        $UpValidated = $request->validate([
            'role_id' => 'required',
        ]);

        $user->update($UpValidated);
        return redirect()->route('adm.users.index')->with('upmessage', 'Product update');
    }

    public function cart(User $user){

        return view('products.carts', ['user' => $user]);

    }

}
