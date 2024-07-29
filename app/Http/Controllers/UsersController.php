<?php

namespace App\Http\Controllers;

use App\Helpers\SendSmS;
use App\Mail\GlobalSenderMail;
use App\Models\Habilete;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    /*
$results = DB::table('users')
    ->where($column, 'LIKE', '%' . $value . '%')
    ->get();
    */


    public static function updatePassword(Request $request)
    {

        $user = auth()->user();
        if(Hash::check($request->oldPassword, $user->password)) {
            $user = User::find($user->id);
            $user->password = Hash::make($request->newPassword);
            $user->update();
            return redirect('/disconnect');
        }else{
            return redirect()->back()->with('error_message', 'Erreur de mot de passe');
        }
    }


    public static function resetPassword($id, $request)
    {
        // $id = $id;
        //$id = session('infoUser')->id;

        $newPassword = $request->telephone . "-rz-" . substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10 / strlen($x)))), 1, 10);

        DB::table('users')
            ->where('id', $id)
            ->update([
                'password' => $newPassword,
            ]);
        flash('Le mot de passe a ete actualiser avec success');
        return redirect()->back();
    }


    public static function login()
    {
        return view('admin.auth.login');
    }

    public function handleLogin(Request $request)
    {
        if (Auth::attempt($request->only(['email', 'password']))) {
            $user = auth()->user();
            if ($user->actif == 0) {
                $data['message'] = "Echec connection : Utilisateur suspendu";
                $data['client'] = null;

                return response()->json($data, 421);
            }

            return redirect('/dashboard');
        } else {
            return redirect()->back()->with('error_message', 'Email ou mot de passe non valide');
        }
    }

    public static function disconnect()
    {
        //remove single session
        session()->forget('infoUser');
        //remove multiple sessions
        //Session::forget(['sessionKey1', 'sessionkey2']);
        //remove all sessions
        //Session::flush();
        Auth::logout();
        return redirect('administration');
    }



    public static function get()
    {
        // if (session('infoUser') == Null) return redirect('admin_oni');

        $users = User::with('enrollPoint', 'role', 'habilete')->latest()->get();

        $roles = Habilete::all();

        $pointsEnrolements = DB::table('point_enrolement')->get();

        //dd($users);
        return view('admin.users.index', [
            'users' => $users,
            'roles' => $roles,
            'pointsEnrolements' => $pointsEnrolements,
        ]);
    }


    public static function insert(Request $request)
    {
        $data = $request->all();

        $valodator = Validator::make($data, [
            'nom' => 'required',
            'email' => 'required|unique:users,email',
            'telephone' => 'required|unique:users,telephone',
            'id_point_enrolement' => 'required',
            'id_role' => 'required',
        ]);

        if (!$valodator->fails()) {
            DB::table('users')->insert([
                'nom' => $request->nom,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'password' => Hash::make('123456789'),
                'id_role' => 4,
                'habilete_id' => $request->id_role,
                'id_point_enrolement' => $request->id_point_enrolement,
                'actif' => 1,
            ]);

            $msgSMS = "Hello, " . $request->nom . " Votre compte a éé créé avec succès. Votre mot de passe est 123456789, Veuillez changer votre mot de passe à la prochaine connexion. Cordialement. " . env('APP_URL', "Omniform");

            $msgMail =  $request->nom . " Votre compte a éé créé avec succès. Votre mot de passe est 123456789, Veuillez changer votre mot de passe à la prochaine connexion. Cordialement. " . env('APP_URL', "Omniform");


            $sms = new SendSmS();
            $sms->send($request->telephone, $msgSMS);
            Mail::to(request()->email)->send(new GlobalSenderMail($msgMail, "CREATION DE COMPTE", []));

            return redirect(route('user'))->with('success_message', $valodator->errors()->first());
        } else {
            return redirect(route('user'))->with('error_message', $valodator->errors()->first());
        }
    }


    //
    public static function update(Request $request)
    {

        DB::table('users')
            ->where('id', $request->id)
            ->update([
                'nom' => $request->nom,
                'email' => $request->email,
                'telephone' => $request->telephone,
                // 'password' => 123456,
                'id_role' => 4,
                'habilete_id' => $request->id_role,
                'id_point_enrolement' => $request->id_point_enrolement,
            ]);

        return redirect(route('user'));
    }


    public static function actif(User $user, Request $request)
    {
        $user->actif = $request->actif;
        $user->update();
        return redirect()->back()->with('success_message', 'Statut de l\'utilisateur mis a jour');
    }
}
