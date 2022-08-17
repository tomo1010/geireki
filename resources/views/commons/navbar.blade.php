<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/"><h1>芸歴.net</h1></a>

        {{-- ハンバーガーメニュー --}}
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- メニュー項目 --}}
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                
                {{-- 一覧へのリンク--}}                
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">一覧</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item">{!! link_to_route('lists.history', '芸歴', ) !!}</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">{!! link_to_route('lists.office', '事務所', ) !!}</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">{!! link_to_route('lists.age', '年代', ) !!}</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">{!! link_to_route('lists.pref', '出身地', ) !!}</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">{!! link_to_route('lists.award', '受賞歴', ) !!}</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">{!! link_to_route('lists.birthday', '誕生日', ) !!}</li>
                            <li class="dropdown-divider"></li>                                
                        </ul>
                </li>
                
                {{-- ランキングへのリンク--}}                
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">ランキング</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item">{!! link_to_route('ranking.ageDiff', '年の差', ) !!}</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">{!! link_to_route('ranking.favorite', 'ネタ動画お気に入り数', ) !!}</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">{!! link_to_route('ranking.tall', '高身長', ) !!}</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">{!! link_to_route('ranking.short', '低身長', ) !!}</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">{!! link_to_route('ranking.yearDiff', '年齢と芸歴の差', ) !!}</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">{!! link_to_route('ranking.tag', 'Tag', ) !!}</li>
                            <li class="dropdown-divider"></li>                                
                        </ul>
                </li>
                
                
                @if (Auth::check())
                    
                    {{-- システム管理者権限のみ表示 --}}
                    @can('admin-only') 
                    <li class="nav-item">{!! link_to_route('admin', '管理者ページ', [], ['class' => 'nav-link']) !!}</li>
                    @endcan
    
                    {{-- ログインユーザのみ表示 --}}
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                {{-- ユーザ詳細ページへのリンク --}}
                                <li class="dropdown-item">{!! link_to_route('users.show', 'プロフィール', ['user' => Auth::id()]) !!}</li>
                                <li class="dropdown-divider"></li>
                                {{-- ユーザ一覧ページへのリンク --}}
                                <li class="dropdown-item">{!! link_to_route('users.index', 'ユーザ一覧') !!}</li>
                                <li class="dropdown-divider"></li>
                                {{-- ログアウトへのリンク --}}
                                <li class="dropdown-item">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
                                <li class="dropdown-divider"></li>
                            </ul>
                    </li>

                @else

                    {{-- ログインページへのリンク--}}
                    <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>

                    {{-- ユーザ登録ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('signup.get', 'サインアップ', [], ['class' => 'nav-link']) !!}</li>

                @endif
                
            </ul>
        </div>
        
    </nav>


        {{--解散済み表示非表示のチェックBOX--}}
        <p style="text-align: right">
        <input type="checkbox" name="disband" value="1" onchange="myfunc(this.value)"  {{ request()->input('disband') ? 'checked' : '' }}/> 解散済みを含める　
        </p>

        
        {{--解散済みをコントローラへ渡す処理--}}
        <script>
            function myfunc(value) {
                let element = document.getElementsByName('disband');
                if (element[0].checked) {
                    location.href = location.pathname + '?disband=1';
                } else {
                    location.href = location.pathname;
                }
            }
        </script>


<center><p>
        
        {{--検索BOX--}}
        <form class="input-group col-md-5" action="{{ route('searchbox')}}" method="GET"> 
          <input type="search" name="search" class="form-control input-group-prepend" placeholder="芸人さんを入力"></input>
          <span class="input-group-btn input-group-append">
            <input type="submit" class="btn btn-primary"  value="検索">
          </span>
        </form>

</br>

        {{--芸歴リストへのセレクトBOX--}}
        <form method="post" action="{{ route('lists.select')}}">
            @csrf
            <select class="form-select" name="year" onchange="submit(this.form)">
                @for($i = 0; $i < 70; $i++)
                      <option value="{{$i}}">芸歴{{$i}}年目</option>
                @endfor
            </select>
        </form>
        

        
{{--一覧へのリンク
<p><br>
{!! link_to_route('lists.history', '芸歴', [], ['class' => 'btn btn-primary']) !!}
{!! link_to_route('lists.office', '事務所', [], ['class' => 'btn btn-primary']) !!}
{!! link_to_route('lists.age', '年代', [], ['class' => 'btn btn-primary']) !!}
{!! link_to_route('lists.pref', '出身地', [], ['class' => 'btn btn-primary']) !!}
{!! link_to_route('ranking.tag', 'Tag', [], ['class' => 'btn btn-primary']) !!}
</p>
--}}

</p></center>
        
</header>