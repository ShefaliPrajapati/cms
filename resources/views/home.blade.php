@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Users List</h1>
            <br>
            <form class="form-div form-inline" method="get">
                <div class="row">
                    <div class="col-lg-12">
                        <input type="hidden" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <input type="radio" name="gender" value="MALE" >Male
                                <input type="radio" name="gender" value="FEMALE" >Female
                            </div>
                            <div class="form-group">
                                @foreach($hobbies as $hobby)
                                    <input type="checkbox" id="{{ $hobby->id }}" name="hobbies[]" value="{{ $hobby->id }}">
                                    <label for="{{ $hobby->id }}"> {{ $hobby->name }}</label>
                                @endforeach
                            </div>
                            <input type="submit" class="btn btn-info" value="Filter">
                        <button type="button" class="btn btn-info" onClick="window.location.href=location.href.split('?')[0];">Reset</button>
                    </div>
                </div>
            </form>
            @foreach($users as $user)
                @if(!Auth::user()->isBlockedBy($user))
            <div class="registered-user jumbotron">
                <div class="row">
                    <div class="col-md-2 col-sm-2">
                        <img height="70" width="70" src="@if($user->gender == 'FEMALE') {{ asset('images/female.png') }} @else {{ asset('images/male.png') }} @endif" alt="user" class="profile-photo-lg">
                    </div>
                    <div class="col-md-5 col-sm-5">
                        <h4 class="text-success"> {{ $user->name }}</h4>
                        <p>
                            <b>Email:</b> {{ $user->email }} <br>
                            <b>Gender:</b> <span class="badge badge-light">{{ $user->gender }} </span> <br>
                            <b>Hobbies:</b>
                                @foreach($user->hobbies as $hobby)
                                    <span class="badge badge-info">{{ $hobby->name }}</span>
                                @endforeach
                        </p>
                    </div>
                    <div class="col-md-5 col-sm-5">
                        @if(Auth::user()->hasSentFriendRequestTo($user))
                            <button class="btn btn-secondary">Pending</button>
                        @elseif(Auth::user()->isFriendWith($user))
                            <button class="btn btn-info">Friend</button>
                        @elseif(Auth::user()->hasFriendRequestFrom($user))
                            <a class="btn btn-info" href="{{ route('accept', $user->id) }}">Accept</a>
                            <a class="btn btn-danger" href="{{ route('deny', $user->id) }}">Deny</a>
                        @elseif(Auth::user()->hasBlocked($user))
                            <a class="btn btn-info" href="{{ route('unblock_user', $user->id) }}">Unblock</a>
                        @else
                            <a class="btn btn-info" href="{{ route('send_request', $user->id) }}">Add Friend</a>
                            <a class="btn btn-danger" href="{{ route('block_user', $user->id) }}">Block</a>
                        @endif
                    </div>
                </div>
            </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
