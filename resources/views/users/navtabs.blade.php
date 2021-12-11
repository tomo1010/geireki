            <ul class="nav nav-tabs nav-justified mb-3">
                {{-- 投稿Youtube一覧タブ --}}
                <li class="nav-item">
                    <a href="{{ route('users.show', [$user->id]) }}" class="nav-link {{ Request::routeIs('users.show') ? 'active' : '' }}">
                        投稿Youtube
                        <span class="badge badge-secondary">{{ $user->youtubes_count }}</span>
                    </a>
                </li>
                {{-- お気に入りYoutube一覧タブ --}}
                <li class="nav-item">
                    <a href="{{ route('users.favorites', [$user->id]) }}" class="nav-link {{ Request::routeIs('users.favorites') ? 'active' : '' }}">
                        お気に入りYoutube
                        <span class="badge badge-secondary">{{ $user->favoritesyoutubes()->count() }}</span>
                    </a>
                </li>                
                
                <!--{{-- フォロー一覧タブ --}}-->
                <!--<li class="nav-item"><a href="#" class="nav-link">Followings</a></li>-->
                <!--{{-- フォロワー一覧タブ --}}-->
                <!--<li class="nav-item"><a href="#" class="nav-link">Followers</a></li>-->
            </ul>