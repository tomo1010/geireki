@if (count($youtubes) > 0)
    <ul class="list-unstyled">

            <li class="media mb-3">

                 <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ネタ動画</th>
                            <th>芸人</th>                                  
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($youtubes as $youtube)
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
                        @include('youtubes.favorite')

                                @if (Auth::id() == $youtube->user_id)
                                    {{-- 投稿削除ボタンのフォーム --}}
                                    {!! Form::open(['route' => ['youtubes.destroy', $youtube->id], 'method' => 'delete']) !!}
                                        {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                @endif

                            </td>
                            <td nowrap>
                                {!! link_to_route('entertainers.show', $youtube->entertainer->name, ['id' => $youtube->entertainer->id]) !!}
                                </br>
                                {{ $youtube->created_at }}
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    
            </li>

    </ul>
    {{-- ページネーションのリンク --}}
    {{ $youtubes->links() }}
@endif