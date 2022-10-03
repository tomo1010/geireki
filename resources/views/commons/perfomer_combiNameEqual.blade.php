@foreach($perfomer->entertainer as $entertainer)

    @if($entertainer->activeend == null)

        @if (strcmp($perfomer->name, $entertainer->name) == 0 ) {{--個人名と芸人名を比較--}}
        @else
            {!! link_to_route('entertainers.show', $entertainer->name, $entertainer->id) !!}
        @endif
        
    @endif

@endforeach