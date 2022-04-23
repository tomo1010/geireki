                    <td>
                        {{--コンビ名など--}}
                        @if(!empty($perfomer->entertainer[0]->name))
                            {!! link_to_route('entertainers.show', $perfomer->entertainer[0]->name, $perfomer->entertainer[0]->id) !!}
                        @else
                        @endif
                
                    </td>
                    <td>
                        @empty($perfomer->birthday)
                        @else
                        @include('commons.perfomer_age')歳
                        @endempty
                    </td>

                    <td>
                        @empty($perfomer->active)
                        @else
                        @include('commons.perfomer_history')年
                        @endempty
                    </td>

                    <td>
                        @empty($perfomer->official)
                        @else
                        <a href="{{ $perfomer->official }}" target="new"><img src="../icon/web.png" width="30" alt="{{$perfomer->name}}公式サイト"></a>
                        @endempty

                        @empty($perfomer->twitter)
                        @else
                        <a href="{{ $perfomer->twitter }}" target="new"><img src="../icon/twitter.png" width="30" alt="{{$perfomer->name}}公式Twitter"></a>
                        @endempty
                        
                        @empty($perfomer->instagram)
                        @else
                        <a href="{{ $perfomer->instagram }}" target="new"><img src="../icon/instagram.png" width="30" alt="{{$perfomer->name}}公式Instagram"></a>
                        @endempty
                        
                        @empty($perfomer->facebook)
                        @else
                        <a href="{{ $perfomer->facebook }}" target="new"><img src="../icon/facebook.png" width="30" alt="{{$perfomer->name}}公式Facebook"></a>
                        @endempty
                        
                        @empty($perfomer->youtube)
                        @else
                        <a href="{{ $perfomer->youtube }}" target="new"><img src="../icon/youtube.png" width="30" alt="{{$perfomer->name}}公式Youtube"></a>
                        @endempty                        
                        
                        @empty($perfomer->tiktok)
                        @else
                        <a href="{{ $perfomer->tiktok }}" target="new"><img src="../icon/tiktok.png" width="30" alt="{{$perfomer->name}}公式Tiktok"></a>
                        @endempty                                                
                        
                        @empty($perfomer->blog)
                        @else
                        <a href="{{ $perfomer->blog }}" target="new"><img src="../icon/blog.png" width="30" alt="{{$perfomer->name}}の公式blog"></a>
                        @endempty
                    </td>