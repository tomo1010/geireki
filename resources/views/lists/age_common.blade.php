
                            {{--コンビ名リンク--}}
                            @empty($perfomer->entertainer[0]->name)
                            <td>-</td>
                            @else
                                <td>@include('commons.perfomer_combiName')</td>
                            @endempty
                            
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