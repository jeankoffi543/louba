<?php

namespace App\Http\Controllers;

use App\Events\NewNotificationEvent;
use App\Http\Jobs\NotificationsJob;
use App\Http\Jobs\SendSmsJob;
use App\Http\Resources\AdminActionResource;
use App\Http\Resources\SignalementResource;
use App\Mail\GlobalSenderMail;
use App\Mail\SendRepport;
use App\Models\Admin;
use App\Models\AdminAction;
use App\Models\Signalement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdminActionController extends Controller
{
    public function index()
    {
        $page =  request('page', 1);
        $perPage = request('per_page', 5);
        $statut = request('statut');
        $habilete_id = request('habilete_id');
        $signalement_id = request('signalement_id');
        $code = request('code');
        $query = AdminAction::query();

        if ($code) {
            $query->whereHas('signalement', function ($query) use ($code) {
                $query->where('code', 'like', '%' . $code . '%');
            });
        }
        if ($statut) {
            $statutValues = explode(',', str_replace(' ', '', $statut));
            $query->whereHas('signalement', function ($query) use ($statutValues) {
                $query->whereIn('statut', $statutValues);
            });
        }
        if ($habilete_id) {
            $query->whereHas('habilete', function ($query) use ($habilete_id) {
                $query->where('habilete_id', $habilete_id);
            });
        }

        if ($signalement_id) {
            $query->whereHas('signalement', function ($query) use ($signalement_id) {
                $query->where('signalement_id', $signalement_id);
            });
        }

        $count = $query->count();

        $adminActions = $query->paginate($perPage, ['*'], 'page', $page);

        $adminAction = AdminActionResource::collection($adminActions);

        return response()->json([
            'error' => false,
            'data' => $adminAction,
            'total' => $count,
        ]);
    }

    public function store(Request $request)
    {
        $adminAction = AdminAction::create($request->all());
        $first_create = $request->first_create;

        $signalement_id = $request->signalement_id;
        $habilete_id = $request->habilete_id;
        $signalements = Signalement::find($signalement_id);
        $data =  new SignalementResource($signalements);
        $mailData = [
            'tableData' => $data,
        ];

        $message = "Le signalement " . $signalements->code . " a été transferé à votre groupe";
        $message2 = "Le signalement " . $signalements->code . " a ete transfere a votre groupe";


        $admins = Admin::where('habilete_id', $habilete_id)->get();
        $admin_ids = optional($admins)->pluck('id')->toArray();
        $admin_emails = optional($admins)->pluck('email')->toArray();
        $admin_contacts = optional($admins)->pluck('contact')->toArray();

        $super_admin = Admin::query()->where('role', "superadmin")->get();
        $super_admin_ids = optional($super_admin)->pluck('id')->toArray();
        $super_admin_emails = optional($super_admin)->pluck('email')->toArray();
        $super_admin_contacts = optional($super_admin)->pluck('contact')->toArray();

        $emails = array_merge($admin_emails, $super_admin_emails);
        $ids = array_merge($admin_ids, $super_admin_ids);
        $contacts = array_merge($admin_contacts, $super_admin_contacts);

        $habilete_position = $signalements->habilete_position;

        // if ($habilete_position != 0) {
            dispatch(new NotificationsJob("SIGNALEMENT", $ids, $message, false, $signalements->id, null));
            event(new NewNotificationEvent($message));
        // }
        // Send SMS to group
        dispatch(new SendSmsJob($contacts, $message2));

        // Send email to group
        Mail::to($emails)->queue(new GlobalSenderMail("ANSSI", "Cher utilisateur", $message, "NOUVEAU SIGNALEMENT", []));

        $adminAction = new AdminActionResource($adminAction);
        return response()->json([
            'error' => false,
            'data' => $adminAction,
        ]);
    }

    public function show(String $id)
    {
        $data = AdminAction::find($id);
        return response()->json([
            'error' => false,
            'data' => $data,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->all();

        $adminAction = AdminAction::find($id);
        if ($request->action) {
            $adminAction->action = $data['action'];
        }

        $adminAction->fill($data);

        $status = $adminAction->save();
        return response()->json([
            'error' => false,
            'data' => $status,
        ]);
    }

    public function destroy(string $id)
    {
        $adminAction = AdminAction::find($id);

        $adminAction->delete();

        return response()->json([
            'error' => false,
            'message' => "Suppression éffectuée",
        ]);
    }
}
