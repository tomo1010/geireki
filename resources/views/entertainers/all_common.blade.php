                    <td>@include('commons.entertainer_office')</td>

                    <td>
                        @empty($entertainer->official)
                        @else
                            <a href="{{ $entertainer->official }}" target="new"><img src="../icon/web.png" width="30" alt="芸人さんの公式サイト"></a>
                        @endempty 
                        
                        @empty($entertainer->twitter)
                        @else
                            <a href="{{ $entertainer->twitter }}" target="new"><img src="../icon/twitter.png" width="30" alt="芸人さんの公式Twitter"></a>
                        @endempty                         
                        
                        @empty($entertainer->youtube)
                        @else
                            <a href="{{ $entertainer->youtube }}" target="new"><img src="../icon/youtube.png" width="30" alt="芸人さんの公式Youtube"></a>
                        @endempty 
                        
                        @empty($entertainer->tiktok)
                        @else
                            <a href="{{ $entertainer->tiktok }}" target="new"><img src="../icon/tiktok.png" width="30" alt="芸人さんの公式Tiktok"></a>                        
                        @endempty  
                    </td>
                    
                    <td nowrap>@include('commons.entertainer_history')年</td>