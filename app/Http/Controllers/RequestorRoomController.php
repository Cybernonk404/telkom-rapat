<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\RequestorRoom;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class RequestorRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = date('Y-m-d');

        $data = DB::table('requestor_rooms')
                ->leftJoin('rooms', 'requestor_rooms.id_rooms', '=', 'rooms.id')
                ->leftJoin('images', 'images.id_rooms', '=', 'rooms.id')
                ->select('requestor_rooms.*', 'rooms.name', 'images.filename')
                ->where('requestor_rooms.date', '=', $date)
                ->orderBy('requestor_rooms.time_start', 'asc')      // tambah where conditional untuk filtering per load
                ->get();

        return response()->json(['status_code' => '200', 'data' => $data]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('form');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Response $response)
    {
        // dd($request->all());
        // var_dump($request->all());
        //
        // $validatedData = $request->validate([
        //     'name' => 'required|string',
        //     'date' => 'required',
        //     'time' => 'required',
        //     'unit' => 'required|string',
        //     'participant' => 'required|integer',
        //     'telephone' => 'required|string'
        // ]);
        // echo $validatedData['date'];

        $hex = Str::random(9);
        $book_number = '#' . $hex;
        // dd($book_number);

        $request_form = RequestorRoom::create([
            'booking_code' => $book_number,
            'id_rooms' => $request->input('inputIdRoom'),
            'name_requestor' => $request->input('inputNama'),
            'date' => $request->input('inputTglPesan'),
            'time_start' => $request->input('inputWktMulai'),
            'time_end' => $request->input('inputWktAkhir'),
            'unit' => $request->input('inputUnit'),
            'telephone' => $request->input('inputNoTelp'),
            'total_participants' => $request->input('inputJmlPeserta'),
        ]);

        // $check = gettype($request->input('time'));

        // return redirect()->route("dashboard");
        // return response()->json([
        //     'success' => true,
        // ]);
        return response()->json(['data' => $request_form]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestorRoom  $requestorRoom
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        // $requests = Room::with('requestRoom')->get();
        $date = $request->date;
        // dd($date);
        // $selectedRoom = Room::find($id);
        // $selectedRoom = Room::where('id', $id)->get();
        $data = DB::table('requestor_rooms')
                ->leftJoin('rooms', 'requestor_rooms.id_rooms', '=', 'rooms.id')
                ->leftJoin('images', 'images.id_rooms', '=', 'rooms.id')
                ->select('requestor_rooms.*', 'rooms.name', 'images.filename')
                ->where('requestor_rooms.date', '=', $date)
                ->orderBy('requestor_rooms.time_start', 'asc')      // tambah where conditional untuk filtering per load
                ->get();

        return response()->json(['status_code' => '200', 'data' => $data]);
        // return $requests;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestorRoom  $requestorRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestorRoom $requestorRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequestorRoom  $requestorRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestorRoom $requestorRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestorRoom  $requestorRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestorRoom $requestorRoom)
    {
        //
    }

    public function checkTime()
    {
        $date = '2023-02-23';
        $timeStart = '18:00:00';
        $timeEnd = '19:00:00';

        // $validateTime = DB::table('requetor_rooms')
        // ->where('date', '=', $date)
        // ->whereBetween(['time_start', 'end_date'], [$timeStart, $timeEnd])
        // ->get();

        $validateTime = DB::table('requestor_rooms')
              ->where('time_start', '=', '18:00:00')
              ->orWhere('time_end', '20:00:00')
              ->get();
        // if($validateTime == [])
        // {

        // }

        return $validateTime;
    }

    // public $middleware = [
    //     \App\Http\Middleware\VerifyCsrfToken::class
    // ];
}
