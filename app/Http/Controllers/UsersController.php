<?php

namespace App\Http\Controllers;

use App\Models\Habilete;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    /*
$results = DB::table('users')
    ->where($column, 'LIKE', '%' . $value . '%')
    ->get();
    */


    public static function updatePassword(Request $request)
    {

        $users = DB::table('users')
            ->where('password', $request->oldPassword)
            ->where('id', auth()->user()->id)
            ->get();

        //dd(session('infoUserClient')->id_client, $clients->count(), $request->oldPassword);

        if ($users->count() == 1) {
            DB::table('users')
                ->where('id', auth()->user()->id)
                ->update([
                    'password' => $request->newPassword,
                ]);
            flash('Votre mot de passe a ete actualiser, veuillez vous reconnecter!');
            return redirect('/disconnect');
        } else {
            flash('Echec confirmation ancien mot de passe!');
            return redirect()->back();
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
        return redirect('admin_oni');
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


        DB::table('users')->insert([
            'nom' => $request->nom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => 123456,
            'id_role' => 4,
            'habilete_id' => $request->id_role,
            'id_point_enrolement' => $request->id_point_enrolement,
            'actif' => 1,
        ]);

        /*
        $message_sms = "Votre mot de passe est ".$request->telephone."-rz-". substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);


                $curl = new \GuzzleHttp\Client();
                $url = "https://smswanwaran.com/index.php";
                $response = $curl->request('GET', $url, ['query' => [
                                            'app' => "ws",
                                            'u' => "theonemonk",
                                            'h' => "67a3e2c5fab0c9f5e4df3286de3f7b5d",
                                            'op' => "pv",
                                            'to' => "224".$request->telephone,
                                            'msg' => $message_sms,
                                        ]]);
            */

        return redirect(route('user'));
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
                'password' => 123456,
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
