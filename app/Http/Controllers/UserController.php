<?php


namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function requestListAction()
    {
        $user = Auth::user();
        $friendships = $user->getFriendRequests();
        $sender = $friendships->pluck('sender_id')->all();
        $users = User::where('id', '!=', Auth::user()->id)->whereIn('id', $sender)->get();

        return view('user.request', ['users' => $users]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function blockedUserAction()
    {
        $user = Auth::user();
        $friendships = $user->getBlockedFriendships();
        $recipient = $friendships->pluck('recipient_id')->all();
        $users = User::where('id', '!=', Auth::user()->id)->whereIn('id', $recipient)->get();

        return view('user.block', ['users' => $users]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pendingUserAction()
    {
        $user = Auth::user();
        $friendships = $user->getPendingFriendships();
        $recipient = $friendships->pluck('recipient_id')->all();
        $users = User::where('id', '!=', Auth::user()->id)->whereIn('id', $recipient)->get();

        return view('user.pending', ['users' => $users]);
    }

    /**
     * @return \IlluminateContracts\View\Factory|\Illuminate\View\View
     */
    public function fiendsListAction()
    {
        $user = Auth::user();
        $friendships = $user->getAcceptedFriendships();
        $sender = $friendships->pluck('sender_id')->all();
        $recipient = $friendships->pluck('recipient_id')->all();
        $users = User::where('id', '!=', Auth::user()->id)->whereIn('id', array_merge($sender, $recipient))->get();

        return view('user.friends', ['users' => $users]);
    }
}
