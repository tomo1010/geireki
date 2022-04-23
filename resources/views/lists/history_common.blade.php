                        @if($entertainer->activeend == NULL){{--解散済みの場合はグレー文字--}}
                        <tr>
                            <td>@include('commons.entertainer_name')</td>
                            @include('commons.gender')
                        </tr>
                        @else
                        <tr class="text-secondary">
                            <td>@include('commons.entertainer_name')（解散済）</td>
                            @include('commons.gender')
                        </tr>
                        @endif