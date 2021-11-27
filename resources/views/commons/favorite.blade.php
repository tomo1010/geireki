    @if (Auth::user()->is_favorite($value->id))
        {{-- お気に入りを外すのフォーム --}}
        {!! Form::open(['route' => ['user.unfavorite', $value->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unfavorite', ['class' => "btn btn-danger btn-block"]) !!}
        {!! Form::close() !!}
    @else
        {{-- お気に入りのフォーム --}}
        {!! Form::open(['route' => ['user.favorite', $value->id]]) !!}
            {!! Form::submit('Favorite', ['class' => "btn btn-primary btn-block"]) !!}
        {!! Form::close() !!}
    @endif