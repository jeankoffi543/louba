<?php
namespace App\Http\Controllers;

use App\Models\PageLock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageLockController extends Controller
{
    public function lockPage(Request $request)
    {
        $pageIdentifier = $request->input('page_identifier');
        $userId = auth()->user()->id;

        // Vérifier si la page est déjà verrouillée
        PageLock::updateOrCreate(
            ['page_identifier' => $pageIdentifier],
            ['user_id' => $userId]
        );

        return response()->json(['status' => 'locked']);
    }

    public function unlockPage(Request $request)
    {
        $pageIdentifier = $request->input('page_identifier');
        $userId = auth()->user()->id;

        // Déverrouiller la page si c'est l'utilisateur qui a verrouillé
        PageLock::where('page_identifier', $pageIdentifier)
            ->where('user_id', $userId)
            ->delete();

        return response()->json(['status' => 'unlocked']);
    }

    public function isPageLocked(Request $request)
    {
        $pageIdentifier = $request->input('page_identifier');
        $lock = PageLock::where('page_identifier', $pageIdentifier)->first();

        return response()->json([
            'locked' => $lock ? true : false,
            'user_id' => $lock ? $lock->user_id : null
        ]);
    }
}
