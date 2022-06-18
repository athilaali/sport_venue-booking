<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VenueControlle extends Controller
{
    protected $AVAILABLE_SLOTS = [
        '7 AM',
        '8 AM',
        '9 AM',
        '10 AM',
        '11 AM',
        '12 noon',
        '1 PM',
        '2 PM',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venues = Venue::all();
        $results = [];

        foreach ($venues as $key => $venue) {
            $venue_obj = array('name'=> $venue->name, 'type' => $venue->type, 'category' => $venue->category());

            $results[] = $venue_obj;
        }

        return response()->json($results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [ //inputs are not empty or null
            'venue_id' => 'required',
            'from' => 'required',
        ]);

        $from = $request->input('from');
        $is_booked = Booking::where(['from' => $from]);

        if ($is_booked) {
            return response()->json(['status' => 'Failed', 'message' => 'This slote is already booked!']);
        }

        $user_id = Auth::user()->id;

        $booking = new Booking;
        $booking->venue_id = $request->input('venue_id');
        $booking->user_id = $user_id;
        $booking->from = $request->input('from');

        $booking->save();

        return response()->json($booking, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
