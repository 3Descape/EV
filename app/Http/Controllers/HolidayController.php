<?php

namespace App\Http\Controllers;

use App\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{

    public function index()
    {
        $school = Holiday::schoolFree();
        $autonomous = Holiday::schoolAutonomous();

        return view('admin.sites.holidays.holiday_index',[
            'ferien' => $school,
            'schulautonom' => $autonomous,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:5',
            'date' => 'required',
            'category' => 'required'
        ]);

        Holiday::create($request->all());
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function edit(Holiday $holiday)
    {
        return view('admin.sites.holidays.holiday_edit', [
            'holiday' => $holiday,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Holiday $holiday)
    {
        $this->validate($request,[
            'name' => 'required|min:5',
            'date' => 'required',
            'category' => 'required'
        ]);

        $holiday->update($request->all());
        return redirect()->route('holiday_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holiday $holiday)
    {
        $holiday->delete();
        return back();
    }
}
