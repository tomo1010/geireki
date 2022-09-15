            <ul class="nav nav-tabs nav-justified mb-3">


                {{-- Tag一覧タブ --}}
                <li class="nav-item">
                    <a href="{{ route('users.tags', [$user->id]) }}" class="nav-link {{ Request::routeIs('users.tags') ? 'active' : '' }}">
                        Tag
                        <span class="badge badge-secondary">{{ $user->tags()->count() }}</span>
                    </a>
                </li>

                
                {{-- 投稿Youtube一覧タブ --}}
                <li class="nav-item">
                    <a href="{{ route('users.youtubes', [$user->id]) }}" class="nav-link {{ Request::routeIs('users.youtubes') ? 'active' : '' }}">
                        投稿Youtube
                        <span class="badge badge-secondary">{{ $user->youtubes()->count() }}</span>
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