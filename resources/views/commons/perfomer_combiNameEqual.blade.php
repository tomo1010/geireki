@if(!empty($perfomer->entertainer[0]->name))
    @if (strcmp($perfomer->entertainer[0]->name, $perfomer->name) == 0 )
    @else
        </br>{!! link_to_route('entertainers.show', $perfomer->entertainer[0]->name, $perfomer->entertainer[0]->id) !!}
    @endif
@endif