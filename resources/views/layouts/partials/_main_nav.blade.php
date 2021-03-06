<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#fels-nav">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">FELS</a>
        </div>
        <div class="collapse navbar-collapse" id="fels-nav">
            <ul class="nav navbar-nav">
                @if(auth()->check())
                    <li><a href="{{ route('categories.index') }}">Categories</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Word <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('words.index') }}">Word List</a></li>
                            <li><a href="{{ route('users.learned.words', $currentUser) }}">Learned Words</a></li>
                            <li><a href="{{ route('pages.leaderboard') }}">Leaderboard</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('pages.members') }}">Members</a></li>
                @endif
                <li><a href="{{ route('pages.about') }}">About</a></li>
                <li><a href="{{ route('pages.help') }}">Help</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(auth()->guest())
                    <li><a href="{{ route('auth.login') }}">Sign In</a></li>
                    <li><a href="{{ route('auth.register') }}">Sign Up</a></li>
                @endif
                @if(auth()->check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{ $currentUser->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('users.show', $currentUser) }}">Profile</a></li>
                            <li><a href="{{ route('users.edit', $currentUser) }}">Settings</a></li>
                            <li><a href="{{ route('auth.logout') }}">Sign Out</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
