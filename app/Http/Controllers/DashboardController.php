<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Analythic;
use App\User;

class DashboardController extends Controller
{
    private function generateDateRange(Carbon $start_date, Carbon $end_date, $format, $type)
    {
        $dates = [];
        for($date = $start_date; $date->lte($end_date); $date->$type() ){
            array_push($dates, $date->format($format));
        }
        return $dates;
    }

    /**
     * Return the dashboard view
     * @method index
     * @return Response
     */
    public function index()
    {
        $this->authorize('can_access_dashboard', User::class);
        //return count($final_data);
        return view('admin.sites.home');
    }
    public function getAnalythics()
    {
        $options = [
            'year' => ['format' => 'o', 'Add' => 'addYears','increment' => 'addYear', 'Sub' => 'subYear'],
            'month' => ['format' => 'M.o', 'Add' => 'addMonths','increment' => 'addMonth', 'Sub' => 'subMonth'],
            'week' => ['format' => 'W M.o', 'Add' => 'addWeeks','increment' => 'addWeek', 'Sub' => 'subWeek'],
            'day' => ['format' => 'd.M.o', 'Add' => 'addDays','increment' => 'addDay', 'Sub' => 'subDays'],
            'hour' => ['format' => 'G:00 \U\h\r d.M.o', 'Add' => 'addHours','increment' => 'addHour', 'Sub' => 'subHour'],
            'minute' => ['format' => 'G:i d.M.o', 'Add' => 'addMinutes','increment' => 'addMinute', 'Sub' => 'subMinute'],
        ];
        $type = request('type');
        if(!request('type')){
            $type = 'day';
        }
        $range = request('range');
        if(!request('range')){
            $range = 7;
        }
        $sub_time = $options[$type]['Sub'];
        $add_time = $options[$type]['Add'];
        $format = $options[$type]['format'];
        $increment = $options[$type]['increment'];

        $start_date = Carbon::now()->$sub_time($range-1);

        $data = Analythic::whereBetween('created_at', [$start_date, Carbon::now()->$increment()])
        ->orderBy('created_at')->get()
        ->groupBy(function($date) use($format){
            return Carbon::parse($date->created_at)->format($format);
        })
        ->transform(function($item, $k) {
            return $item->groupBy('hash');
        })
        ->map(function ($item, $key){
            return $item->count();
        });

        $all_days_of_interval = $this->generateDateRange($start_date, Carbon::now(), $format, $increment);
        //return count($all_days_of_interval);
        //return json_encode($all_days_of_interval);
        //return json_encode($data);
        $formated = array_fill_keys($all_days_of_interval, 0);
        $final_data = array_replace($formated, $data->toArray());

        return response()->json([
            'values' => array_values($final_data),
            'keys' => array_keys($final_data),
        ]);
    }
}
