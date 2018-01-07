<?php

namespace App\Http\Controllers;

use App\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index()
    {
        $this->authorize('can_access_holiday', User::class);
        $school = Holiday::schoolFree();
        $autonomous = Holiday::schoolAutonomous();

        return view('admin.sites.holidays.holiday_index', [
            'ferien' => $school,
            'schulautonom' => $autonomous,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('can_access_holiday', User::class);
        $this->validate($request, [
            'name' => 'required',
            'date' => 'required',
            'category' => 'required'
        ]);

        Holiday::create($request->all());

        return back();
    }

    public function edit(Holiday $holiday)
    {
        $this->authorize('can_access_holiday', User::class);

        return view('admin.sites.holidays.holiday_edit', [
            'holiday' => $holiday,
        ]);
    }

    public function update(Request $request, Holiday $holiday)
    {
        $this->authorize('can_access_holiday', User::class);
        $this->validate($request, [
            'name' => 'required|min:5',
            'date' => 'required',
            'category' => 'required'
        ]);

        $holiday->update($request->all());

        return redirect()->route('holiday_index');
    }

    public function destroy(Holiday $holiday)
    {
        $this->authorize('can_access_holiday', User::class);
        $holiday->delete();

        return back();
    }
}
