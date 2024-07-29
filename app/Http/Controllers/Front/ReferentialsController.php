<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Actuality;
use App\Models\Equipe;
use App\Models\Jourferier;
use App\Models\Partner;
use App\Models\PointEnrolement;
use App\Models\Product;
use App\Models\PublicHoliday;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Social;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ReferentialsController extends Controller
{

    public static function getProducts()
    {
        try {
            return response()->json(Product::all());
        } catch (\Exception $ex) {
            return response(500)->json([
                "error" => $ex->getMessage(),
                "file" => $ex->getFile(),
                "line" => $ex->getLine(),
            ]);
        }
    }

    public static function getServices()
    {

        try {

            return response()->json(Service::all());
        } catch (\Exception $ex) {
            return response(500)->json([
                "error" => $ex->getMessage(),
                "file" => $ex->getFile(),
                "line" => $ex->getLine(),
            ]);
        }
    }

    public static function getTeams()
    {

        try {
            return response()->json(Equipe::all());
        } catch (\Exception $ex) {
            return response(500)->json([
                "error" => $ex->getMessage(),
                "file" => $ex->getFile(),
                "line" => $ex->getLine(),
            ]);
        }
    }

    public static function getSliders()
    {

        try {

            return response()->json(Slider::all());
        } catch (\Exception $ex) {
            return response(500)->json([
                "error" => $ex->getMessage(),
                "file" => $ex->getFile(),
                "line" => $ex->getLine(),
            ]);
        }
    }

    public static function getPointEnrolement()
    {
        try {
            return response()->json(PointEnrolement::with('services')->get());
        } catch (\Exception $ex) {
            return response(500)->json([
                "error" => $ex->getMessage(),
                "file" => $ex->getFile(),
                "line" => $ex->getLine(),
            ]);
        }
    }

    public static function getPublicHoliday()
    {
        try {
            return response()->json(PublicHoliday::all());
        } catch (\Exception $ex) {
            return response(500)->json([
                "error" => $ex->getMessage(),
                "file" => $ex->getFile(),
                "line" => $ex->getLine(),
            ]);
        }
    }

    public static function getPartners()
    {
        try {
            return response()->json(Partner::all());
        } catch (\Exception $ex) {
            return response(500)->json([
                "error" => $ex->getMessage(),
                "file" => $ex->getFile(),
                "line" => $ex->getLine(),
            ]);
        }
    }

    public static function getActualitiesPaginate()
    {

        try {
            $page = $request->page ?? 1;
            $size = $request->size > 0 ? $request->size : -1;
            $limit = $size;
            $offset = ($page * $limit) - $size;

            $query = Actuality::query()->orderBy('id', "DESC");
            $total = $query->count();
            if ($limit > 0) {
                $items = $query->skip($offset)->take($limit)->get();
            } else {
                $items = $query->get();
            }

            $data['total'] = $total;
            $data['items'] = $items;
            return response()->json($data);
        } catch (\Exception $ex) {
            return response(500)->json([
                "error" => $ex->getMessage(),
                "file" => $ex->getFile(),
                "line" => $ex->getLine(),
            ]);
        }
    }

    public static function getOneArticle($id)
    {
        try {
            return response()->json(Actuality::where('id', '=', $id)->first());
        } catch (\Exception $ex) {
            return response(500)->json([
                "error" => $ex->getMessage(),
                "file" => $ex->getFile(),
                "line" => $ex->getLine(),
            ]);
        }
    }

    public static function getSocialLink()
    {
        try {
            return response()->json(Social::all());
        } catch (\Exception $ex) {
            return response(500)->json([
                "error" => $ex->getMessage(),
                "file" => $ex->getFile(),
                "line" => $ex->getLine(),
            ]);
        }
    }
}
