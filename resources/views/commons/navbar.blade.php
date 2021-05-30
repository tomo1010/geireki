<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/">芸歴.net</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            
            <ul class="navbar-nav">
                @if (Auth::check())
                    {{-- メッセージ作成ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('entertainers.create', '新規メッセージの投稿', [], ['class' => 'nav-link']) !!}</li>
                    
                    {{-- ユーザ一覧ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('users.index', 'Users', [], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                {{-- ユーザ詳細ページへのリンク --}}
                                <li class="dropdown-item">{!! link_to_route('users.show', 'My profile', ['user' => Auth::id()]) !!}</li>
                                <li class="dropdown-divider"></li>
                                {{-- ログアウトへのリンク --}}
                                <li class="dropdown-item">{!! link_to_route('logout.get', 'Logout') !!}</li>
                            </ul>
                    </li>

                    {{-- ユーザ登録ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('signup.get', 'Signup', [], ['class' => 'nav-link']) !!}</li>

                @else
                    {{-- ログインページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('login', 'Login', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
        
        {{--解散済み表示非表示のチェックBOX
        <form method="post" action="{{ route('entertainers.check')}}">
         @csrf
            <input type="checkbox" name="check" value="1" onchange="submit(this.form)">
        </form>--}}



        
        
    </nav>

        {{--芸歴リストへのセレクトBOX--}}
        <center><p>
        <form method="post" action="{{ route('entertainers.select')}}">
            @csrf
            <select name="year" onchange="submit(this.form)">
                @for($i = 0; $i < 70; $i++)
                    <option value="{{$i}}">芸歴{{$i}}年目</option>
                @endfor
            </select>
        </form>
        </p></center>

</header>