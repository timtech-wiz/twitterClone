<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request){
        $user = $request->user()->avatar();
        return view('notifications.index', ['user' => $user]);
    }
}
