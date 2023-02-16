<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\RoomController;

class DashboardController extends Controller
{
    //

    public function show() {
        $RoomController = new RoomController();
        $RequestoRoomController = new RequestorRoomController();

        $room_data = $RoomController->show();
        $request_data = $RequestoRoomController->index();

        $data = ['rooms' => $room_data, 'requests' => $request_data];
        // dd(sizeof($request_data));
        return view('components.dashboard', $data);
    }
}
