<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all()->except(Auth::id());

        return view('home', ['users' => $users]);
    }

    public function blockedUserAction()
    {

    }

    public function pendingUserAction()
    {
        $user = Auth::user();
        $friendships    = $user->getPendingFriendships();
        $senders        = $friendships->pluck('recipient_id')->all();
        $users          = User::where('id', '!=', Auth::user()->id)->whereIn('id', $senders)->get();

        return view('user.pending', ['users' => $users]);
    }

    public function fiendsListAction()
    {
        $user = Auth::user();
        $users = $user->getAcceptedFriendships();

        return view('user.pending', ['users' => $users]);
    }
}
