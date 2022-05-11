@if (Auth::check())

    @if (Auth::user()->is_favorite($youtube->id))
    
        {{-- お気に入りを外すのフォーム --}}
	    <a href="{{ route('user.unfavorite', $youtube->id) }}" class="btn btn-success btn-sm">
		いいね
	    </a>
	
    @else
    
        {{-- お気に入りのフォーム --}}
        <a href="{{ route('user.favorite', $youtube->id) }}" class="btn btn-secondary btn-sm">
		いいね
	    </a>
        
    @endif
    
@else
@endif



