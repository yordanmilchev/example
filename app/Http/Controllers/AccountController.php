<?php

namespace App\Http\Controllers;

use App\Components\BreadcrumbComponent;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function editProfile()
    {
        BreadcrumbComponent::addItem(trans('frontend.profile'), route('account.profile_edit'));

        return view('front.profile_edit', [
            'user' => auth()->user()
        ]);
    }

    public function orders()
    {
        $user = Auth::user();

        $orders = Order::where('primary_email', $user->email)
            ->orWhere('user_id', '=', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        BreadcrumbComponent::addItem(trans('frontend.orders'), route('account.orders'));

        return view('front.orders', [
            'orders' => $orders
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function anonymize(Request $request)
    {
        $user = Auth::user();

        $user->name = Hash::make($user['name']);
        $user->lastname = Hash::make($user['lastname']);
        $user->email = Hash::make($user['email']);
        $user->phone_number = Hash::make($user['phone_number']);
        $user->is_anonymous = true;
        $user->save();

        $request->session()->flash('info' , trans('Вашият акаунт беше деактивиран и aнонимизиран успешно!'));
        auth()->logout();

        return redirect()->route('homepage');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ];

        $validator = \Validator::make($request->input(), $rules);
        if ($validator->fails()){
            $request->session()->flash('error', trans('Записът не може да бъде осъществен !'));
            return back();
        }

        $user->email = $request->email;
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->phone_number = $request->phone_number;
        $user->save();

        $request->session()->flash('success', trans('Записът беше осъществен успешно !'));
        return back();
    }
}
