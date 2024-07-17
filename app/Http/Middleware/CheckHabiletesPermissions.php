<?php

namespace App\Http\Middleware;

use App\Models\Habilete;
use Closure;
use Illuminate\Http\Request;

class CheckHabiletesPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ?string ...$permissionName)
    {

        // Check if the habilete_id has permission to access the requested resource
        if (!$this->checkPermission($permissionName)) {
            return response('Forbidden', 403);
        }

        return $next($request);
    }

    private function checkPermission($permission)
    {
        $checker = false;
        $user = auth()->user();
        if ($user->id_role === 1) return true;
        if ($user->id_role && $user->id_role === 4) {
            if ($user) {
                $habilete = Habilete::where('id', $user->habilete_id)->with('permissions')->first()->permissions->pluck('libelle');
                // $habilete = Habilete::where('id', 3)->with('permissions')->first()->permissions->pluck('libelle')->toArray();
            if (count(array_intersect($permission, $habilete->toArray())) > 0) {
                    $checker = true;
                }
            }
        }
        return $checker;
    }
}
