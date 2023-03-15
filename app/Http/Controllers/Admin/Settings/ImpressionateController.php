<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImpressionateController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('manage_system');

        \Auth::loginUsingId($request->get('user_id'));

        return response()->json(true);
    }
}
