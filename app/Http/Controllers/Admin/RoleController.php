<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ACL\Permission;
use App\Models\ACL\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.acl.roles_list');
    }
}
