@if (count($favorites) > 0)

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>お気に入りネタ動画</th>
                            <th>芸人</th>                                  
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($favorites as $youtube)
                        <tr>
                            <td>
                                <a href="{{$youtube->youtube}}" target="_blank""><img src = "{{ $iframe[$loop->index] }}" alt="おすすめYoutubeネタ動画" hspace="5" vspace="5"></a>
                                </br>
                                
                                <span>
                                <img src="{{asset('../icon/nicebutton.png')}}" width="30px">
                            		<!-- 「いいね」の数を表示 -->
                            		<span class="badge">
                            			{{ $youtube->favoritesUser()->count() }}
                            		</span>
                                </span>
                                
                                @include('youtubes.favoriteAction')
                                </br>
                                
                                {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                                <img class="mr-2 rounded" src="{{ Gravatar::get($youtube->user->email, ['size' => 50]) }}" alt="">                        

                                <div>
                                    {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                                    {!! link_to_route('users.show', $youtube->user->name, ['user' => $youtube->user->id]) !!}
                                    {{--<span class="text-muted">posted at {{ $youtube->created_at }}</span>--}}
                                </div>
                        
                            </td>
                            <td nowrap>
                                {!! link_to_route('entertainers.show', $youtube->entertainer->name, ['id' => $youtube->entertainer->id]) !!}
                                </br>
                                {{ $youtube->pivot->created_at }}
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
        
    {{-- ページネーションのリンク --}}
    {{ $favorites->links() }}
@endif