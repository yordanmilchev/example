<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactsController extends Controller
{
    public function index()
    {
        return view('admin.inquiries.messages');
    }
}
