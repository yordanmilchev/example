<?php

namespace App\Http\Controllers;

use App\Components\BreadcrumbComponent;
use App\Models\ContactInquiry;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        BreadcrumbComponent::addItem(trans('frontend.contacts'), route('contacts.index'));

        return view('front.contacts');
    }

    public function save(Request $request)
    {
        $rules = [
            'email' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'inquiry' => 'required',
            'g-recaptcha-response' => ['required', 'recaptcha'],
        ];

        $rules = RuleFactory::make($rules);
        $validator = \Validator::make(array_filter($request->all()), $rules);
        if ($validator->fails()) {
            $request->session()->flash('error', trans('Вашето запитване не беше изпратено !'));
            return back()->withErrors($validator)->withInput($request->all());
        } else {
            $inquiry = new ContactInquiry();

            $cleanData = $request->except([
                '_token', 'g-recaptcha-response',
            ]);

            $inquiry->fill($cleanData);
            $inquiry->save();

            try {
                $email=(new \App\Mail\ContactInquiry($inquiry))->onConnection('sync');
                Mail::to(setting_val('TYPE_FIRM_EMAIL'))->queue($email);
            } catch (\Exception $e) {
                Log::info($e);
            }

            $request->session()->flash('success', trans('Вашето запитване беше изпратено успешно!'));
        }

        return back();
    }
}
