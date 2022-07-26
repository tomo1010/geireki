

    <ul class="list-unstyled">

        @foreach ($tags as $tag)

            <li class="media mb-3">

                <div class="media-body">
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        {{--{!! link_to_route('users.show', $tag->user->name, ['user' => $tag->user->id]) !!}--}}
                        <span class="text-muted">{{ $tag->name }}</span>
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                        <p class="mb-0">                        
                        {!! link_to_route('entertainers.show', $entertainers[$loop->index]->name, ['id' => $entertainers[$loop->index]->id]) !!}
                		</p>

                    </div>
                    
                </div>
            </li>

        @endforeach

    </ul>
