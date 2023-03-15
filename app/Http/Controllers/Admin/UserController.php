<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ACL\Role;
use App\Models\User;
use App\Models\Dossier;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.list_user');
    }

    public function edit(Request $request)
    {
        if (!empty($request->id)) {
            $user = User::find($request->id);
        } else {
            $user = new User();
        }

        if ($request->method() == 'POST') {
            $request->validate([
                    'name' => 'required',
                    'email' => 'required|email',
                    'password' => 'nullable|string|min:8|different:email',
                    'password_confirmation' => 'same:password'
                ]);

            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            if ($request->password){
                $user->password = Hash::make($request->password);
            }

            $user->save();

            $request->session()->flash('success', 'Записът беше осъществен успешно !');

            return view('admin.users.edit_user', [
                    'user' => $user
                ]);
        }

        $request->flash();


        return view('admin.users.edit_user', [
            'user' => $user,
        ]);
    }

    public function summary(User $user)
    {
        $ordersInfo = OrderRepository::getUserOrders($user->id);

        $dossier = Dossier::firstOrCreate(
            ['email' => $user->email]
        );

        if(empty($user->dossier_id)){
           User::where('id', $user->id)->update(['dossier_id' => $dossier->id]);
        }

        $dossierUsers = User::where('dossier_id', $dossier->id)
            ->orWhere('email', $dossier->email)
            ->get();


        return view('admin.users.summary', [
            'dossierUsers' => $dossierUsers,
            'ordersInfo' => $ordersInfo,
            'user' => $user
        ]);
    }

    public function topBuyers()
    {
        return view('admin.users.top_buyers');
    }
}
