<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SwitchlangController extends Controller
{
    public function index(Request $request, $locale)
    {
        event(new \App\Events\SwitchLangEvent($locale));


        if(config('app.localization_method')=="domain") {
            $urlRootPartsArr = explode(".", request()->root()); //request()->root() i.e.:
            $urlRootPartsArr[count($urlRootPartsArr)-1] = $locale;
            return redirect(implode(".", $urlRootPartsArr), 307); //307 will not cache redirect
        }
        $request->session()->put('locale', $locale);
        return redirect($request->root(), 307);
    }


}
