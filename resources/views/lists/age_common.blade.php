    {{--年齢リンク--}}
    @empty($perfomer->birthday)
        <td>-</td>
    @else
        <td>@include('commons.perfomer_age')歳</td>
    @endempty
    
    {{--芸歴リンク--}}                            
    @empty($perfomer->active)
        <td>-</td>
    @else
        <td>@include('commons.perfomer_history')年</td>
    @endempty