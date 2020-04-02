@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Users List</h1>
            <br>
            @foreach($users as $user)
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
                        <a class="btn btn-info" href="{{ route('block_user', $user->id) }}">Block</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
