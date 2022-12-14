<?php

namespace App\Http\Controllers\Api\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationCollection;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request){
         $notification = $request->user()
         ->notifications()
         ->paginate(5);

         return new NotificationCollection($notification);
    }
}
