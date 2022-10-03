    {{--出身地--}}
    <td>{{$perfomer->birthplace}}</td>

    {{--芸歴リンク--}}
    @empty($perfomer->active)
        <td>-</td>
    @else
        <td>@include('commons.perfomer_history')年</td>
    @endempty