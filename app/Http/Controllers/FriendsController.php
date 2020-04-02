<?php


namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function sendRequestAction($id)
    {
        $user = Auth::user();
        $anotherUser = User::findorfail($id);
        $user->befriend($anotherUser);

        return redirect('home')->with('success', 'Request sent successfully!');
    }

    public function blockUserAction($id)
    {
        $user = Auth::user();
        $anotherUser = User::findorfail($id);
        $user->blockFriend($anotherUser);

        return redirect('home')->with('success', 'User is Blocked now!');
    }

    public function unblockUserAction($id)
    {
        $user = Auth::user();
        $anotherUser = User::findorfail($id);
        $user->unblockFriend($anotherUser);

        return redirect('home')->with('success', 'User is Unblocked now!');
    }

    public function acceptAction($id)
    {
        $user = Auth::user();
        $anotherUser = User::findorfail($id);
        $user->acceptFriendRequest($anotherUser);

        return redirect(route('pending_user'))->with('success', 'You are now friends!');
    }

    public function denyAction($id)
    {
        $user = Auth::user();
        $anotherUser = User::findorfail($id);
        $user->denyFriendRequest($anotherUser);

        return redirect(route('pending_user'))->with('success', 'Request Canceled Successfully!');
    }
}
