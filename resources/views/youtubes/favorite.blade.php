@if (Auth::check())

    <span>
    <img src="{{asset('../icon/nicebutton.png')}}" width="30px">

    @if (Auth::user()->is_favorite($value->id))
        <!--{{-- お気に入りを外すのフォーム --}}-->
        <!--{!! Form::open(['route' => ['user.unfavorite', $value->id], 'method' => 'delete']) !!}-->
        <!--    {!! Form::submit('Unfavorite', ['class' => "btn btn-danger btn-block"]) !!}-->
        <!--{!! Form::close() !!}-->
        
        
	    <a href="{{ route('user.unfavorite', $value->id) }}" class="btn btn-success btn-sm">
		いいね
    		<!-- 「いいね」の数を表示 -->
    		<span class="badge">
    			{{ $value->favoritesUser()->count() }}
    		</span>
	    </a>
	
    @else
        {{-- お気に入りのフォーム --}}
        <!--{!! Form::open(['route' => ['user.favorite', $value->id]]) !!}-->
        <!--    {!! Form::submit('Favorite', ['class' => "btn btn-primary btn-block"]) !!}-->
        <!--{!! Form::close() !!}-->
        
        
        <a href="{{ route('user.favorite', $value->id) }}" class="btn btn-secondary btn-sm">
    		いいね
    		<!-- 「いいね」の数を表示 -->
    		<span class="badge">
    			{{ $value->favoritesUser()->count() }}
    		</span>
	    </a>
        
    @endif
    
    </span>

@else
        ※お気に入りにするには{!! link_to_route('login', 'Login', [], ['class' => 'nav-link']) !!}が必要です。
@endif



