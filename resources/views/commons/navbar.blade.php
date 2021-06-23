<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/">芸歴</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            
            <ul class="navbar-nav">
                @if (Auth::check())
                    {{-- メッセージ作成ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('entertainers.create', '芸人データ登録', [], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item">{!! link_to_route('perfomers.create', '個人データ登録', [], ['class' => 'nav-link']) !!}</li>
                    
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


    <input type="checkbox" name="disband" value="1" onchange="myfunc(this.value)"  {{ request()->input('disband') ? 'checked' : '' }}/> <font color="white">解散済みを含める</font>
        <script>
            function myfunc(value) {
            let element = document.getElementsByName('disband');
            if (element[0].checked) {
                location.href = '/?disband=1';
            } else {
                location.href = '/';
            }
        }
    </script>
        

            {{--Google検索BOX--}}
<script async src="https://cse.google.com/cse.js?cx=cac89bc70139611b6"></script>
<div class="gcse-search"></div>

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