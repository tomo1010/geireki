@if (count($youtubes) > 0)
    <ul class="list-unstyled">
        @foreach ($youtubes as $youtube)
            <li class="media mb-3">
                {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                <img class="mr-2 rounded" src="{{ Gravatar::get($youtube->user->email, ['size' => 50]) }}" alt="">
                <div class="media-body">
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        {!! link_to_route('users.show', $youtube->user->name, ['user' => $youtube->user->id]) !!}
                        <span class="text-muted">posted at {{ $youtube->created_at }}</span>
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                        <p class="mb-0">{!! nl2br(e($youtube->youtube)) !!}                        

@include('youtubes.favorite',['value' => $youtube])                        
                        <!--<button type="" class="btn btn-primary">-->
                        <!--  <span class="badge bg-secondary">{{ $youtube->favoritesUser()->count() }}</span> いいね-->
                        <!--</button>-->
                        
                		</p>
                        {!! link_to_route('entertainers.show', $youtube->entertainer->name, ['id' => $youtube->entertainer->id]) !!}
                    </div>
                    
                    
                    <div>
                        @if (Auth::id() == $youtube->user_id)
                            {{-- 投稿削除ボタンのフォーム --}}
                            {!! Form::open(['route' => ['youtubes.destroy', $youtube->id], 'method' => 'delete']) !!}
                                {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                    
                    
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $youtubes->links() }}
@endif