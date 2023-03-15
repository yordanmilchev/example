<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page\RouteKey;

class AddRouteKeyController extends Controller
{
    public function addKey(Request $request)
    {
        $key = new RouteKey();
        $key->route_key = $request->get('route_key_content');
        $key->save();

        return ['success' => true,
            'route_key' =>  $key->route_key
        ];
    }
}
