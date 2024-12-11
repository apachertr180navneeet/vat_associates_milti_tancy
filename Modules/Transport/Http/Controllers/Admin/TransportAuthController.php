<?php

namespace Modules\Transport\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TransportAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function login()
    {
        return view('transport::admin.auth.login');
    }

    public function postLogin()
    {
        return redirect()->route("admin.dashboard")->with("success", "Welcome to your dashboard.");
    }


    public function adminDashboard()
    {
        return view("transport::admin.dashboard.index");
    }
}
