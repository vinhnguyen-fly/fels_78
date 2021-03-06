@extends('layouts.admin')
@section('title', 'Search Results')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="well-w">
                <strong class="text-success">{{ plural($source, counting($results)) }}</strong> found for
                <strong class="text-danger">"{{ $pattern }}"</strong> keyword
            </div>
            @if(blank($results))
                @include('layouts.partials._empty')
            @else
                <div class="panel panel-success">
                    <div class="panel-heading">Searching Results</div>
                    <ul class="list-group auto-pagination">
                        @if($source === 'user')
                            @foreach($results as $user)
                                <li class="list-group-item item">
                                    <a href="{{ route('users.show', $user) }}">
                                        {{ $user->name }}
                                    </a>
                                </li>
                            @endforeach
                        @elseif($source === 'category')
                            @foreach($results as $category)
                                <li class="list-group-item item">
                                    <a href="{{ route('admin.categories.edit', $category) }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        @else
                            @foreach($results as $word)
                                <li class="list-group-item item">
                                    <a href="{{ route('admin.words.show', $word) }}">
                                        {{ $word->content }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                @include('layouts.partials._loader')
                {!! paginate($results, ['q' => $pattern, 'type' => $source]) !!}
            @endif
        </div>
    </div>
@stop
