                        @if($entertainer->activeend == NULL){{--解散済みの場合はグレー文字--}}
                        <tr>
                            <td nowrap>@include('commons.entertainer_name')</td>                           
                            @include('commons.gender')                            

                            @empty($entertainer->active)
                            <td>-</td>
                            @else
                            <td>@include('commons.entertainer_history')年</td>
                            @endempty
                        </tr>
                        @else
                        <tr class="text-secondary">
                            <td nowrap>@include('commons.entertainer_name')（解散済）</td>
                            @include('commons.gender')                            

                            @empty($entertainer->active)
                            <td>-</td>
                            @else
                            <td>@include('commons.entertainer_history')年</td>
                            @endempty
                        </tr>
                        @endif