@extends('layouts.default')
@section('title', 'Home')
@section('content')
    @if(auth()->guest())
        <div class="jumbotron home">
            <h2>Framgia E-learning System</h2>
            <img src="http://recruit.framgia.vn/assets/logo_framgia-8942793d84ada6ba4765a643ded3f89d.png" alt="Framgia">
            <p>
                <a class="btn btn-home" href="{{ route('auth.login') }}">Sign In</a>
                <a class="btn btn-home" href="{{ route('auth.register') }}">Sign Up</a>
            </p>
        </div>
    @else
        <div class="row">
            <div class="col-md-3 users">
                @include('users.profile.partials._profile_card', ['user' => $currentUser])
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-xs-6 text-right">
                        <a href="{{ route('words.index') }}" class="btn btn-home btn-lg">Words</a>
                    </div>
                    <div class="col-xs-6 text-left">
                        <a href="{{ route('categories.index') }}" class="btn btn-home btn-lg">Lessons</a>
                    </div>
                </div>
                <div class="list-group auto-pagination">
                    @include('users.activity.activity_list')
                </div>
                @include('layouts.partials._loader')
                {!! paginate($activityList) !!}
            </div>
        </div>
    @endif
@stop
