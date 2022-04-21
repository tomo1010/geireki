                            {{--コンビ名リンク--}}
                            @empty($perfomer->entertainer[0]->name)
                            <td></td>
                            @else
                            <td>@include('commons.perfomer_combiName')</td>
                            @endif    

                            {{--出身地--}}
                            <td>{{$perfomer->birthplace}}</td>
                        
                            {{--芸歴リンク--}}
                            @empty($perfomer->active)
                            <td>-</td>
                            @else
                            <td>@include('commons.perfomer_history')年</td>
                            @endempty