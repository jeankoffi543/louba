<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHolidayRequest;
use App\Models\PointEnrolement;
use App\Models\PublicHoliday;
use Exception;
use Illuminate\Http\Request;

class HolyDayController extends Controller
{
    public function index()
    {

        $holidays = PublicHoliday::with('enrolement')->get();

        return view('admin.holiday.index', compact('holidays'));
    }

    public function create()
    {
        $enrollementPoints = PointEnrolement::all();


        return view('admin.holiday.create', compact('enrollementPoints'));
    }
    public function edit(PublicHoliday $holiday)
    {
        $enrollementPoints = PointEnrolement::all();
        return view('admin.holiday.edit', compact('enrollementPoints', 'holiday'));
    }

    public function store(StoreHolidayRequest $request)
    {
        $publicHoliday = new PublicHoliday();

        $publicHoliday->name = $request->name;
        $publicHoliday->date = $request->date;
        // $publicHoliday->id_point_enrolement = $request->id_point_enrolement;

        $publicHoliday->save();

        return redirect()->route('holidays')->with('success_message', 'Le jour férié à été ajouté');
    }

    public function update(StoreHolidayRequest $request,  $id)
    {
        $publicHoliday = PublicHoliday::find($id);

        try {
            $publicHoliday->name = $request->name;
            $publicHoliday->date = $request->date;
            $publicHoliday->id_point_enrolement = $request->id_point_enrolement;

            $publicHoliday->update();

            return redirect()->route('holidays')->with('success_message', 'Le jour férié à été mis à jour');
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function delete($id)
    {

        try {
        $holiday = PublicHoliday::find($id);
            $holiday->delete();
            return redirect()->route('holidays')->with('success_message', 'Le jour férié à supprimé');
        } catch (Exception $e) {
            dd($e);
        }
    }
}
