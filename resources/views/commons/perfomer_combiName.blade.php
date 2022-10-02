@foreach($perfomer->entertainer as $entertainer)

    @if($entertainer->activeend == null)

        {{--{!! link_to_route('entertainers.show', $perfomer->entertainer[0]->name, $perfomer->entertainer[0]->id) !!}--}}
        {!! link_to_route('entertainers.show', $entertainer->name, $entertainer->id) !!}
        
    @endif

@endforeach
