<?php

namespace App\Http\Controllers;

use App\Hobbies;
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
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $users = User::all()->except(Auth::id());
        $hobbies = Hobbies::all();

        $data = $request->all();
        if ($data) {
            if (isset($data['gender']) && isset($data['hobbies'])) {
                $q = User::where('gender', $data['gender'])->whereHas('hobbies', function ($query) use ($data) {
                    $query->whereIn('hobbies.id', $data['hobbies']);
                });
            } elseif (isset($data['gender'])) {
                $q = User::where('gender', $data['gender']);
            } elseif (isset($data['hobbies'])) {
                $q = User::whereHas('hobbies', function ($query) use ($data) {
                    $query->whereIn('hobbies.id', $data['hobbies']);
                });
            }

            $users = $q->get();
        }

        return view('home', ['users' => $users, 'hobbies' => $hobbies]);
    }
}
