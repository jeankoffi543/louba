<?php

namespace App\Http\Controllers;

use App\Models\PointEnrolement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(auth()->user());
        $pointenrollements = PointEnrolement::latest()->paginate();

        return view('admin.tableau', compact('pointenrollements'));
    }
}
