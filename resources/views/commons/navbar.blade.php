<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/"><h1>芸歴.net</h1></a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            
            <ul class="navbar-nav">
                @if (Auth::check())
                    
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

                <!--    {{-- ユーザ登録ページへのリンク --}}-->
                <!--    <li class="nav-item">{!! link_to_route('signup.get', 'Signup', [], ['class' => 'nav-link']) !!}</li>-->

                <!--@else-->
                <!--    {{-- ログインページへのリンク--}}-->
                <!--    <li class="nav-item">{!! link_to_route('login', 'Login', [], ['class' => 'nav-link']) !!}</li>-->
 
                <!--@endif-->
            </ul>
            


    {{--検索BOX--}}
 
    <form class="form-inline my-2 my-lg-0 ml-2" action="{{ route('entertainers.searchbox')}}">
      <div class="form-group">
      <input type="search" class="form-control mr-sm-2" name="search"  value="{{request('search')}}" placeholder="キーワードを入力" aria-label="検索...">
      </div>
      <input type="submit" value="検索" class="btn btn-info">
    </form>


            
        </div>
    </nav>

        {{--解散済み表示非表示のチェックBOX--}}
        <p style="text-align: right">
        <input type="checkbox" name="disband" value="1" onchange="myfunc(this.value)"  {{ request()->input('disband') ? 'checked' : '' }}/> 解散済みを含める　
        </p>
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
        {{--芸歴リストへのセレクトBOX--}}
        
        <form method="post" action="{{ route('lists.select')}}">
            @csrf
            <select name="year" onchange="submit(this.form)">
                @for($i = 0; $i < 70; $i++)
                      <option value="{{$i}}">芸歴{{$i}}年目</option>
                @endfor
            </select>
        </form>
        

        
{{--一覧へのリンク--}}
<p><br>
{!! link_to_route('search', '詳細検索', [], ['class' => 'btn btn-primary']) !!}
{!! link_to_route('lists.history', '芸歴別一覧', [], ['class' => 'btn btn-primary']) !!}
{!! link_to_route('lists.office', '事務所別一覧', [], ['class' => 'btn btn-primary']) !!}
{!! link_to_route('lists.age', '年代別一覧', [], ['class' => 'btn btn-primary']) !!}
{!! link_to_route('lists.pref', '出身県別一覧', [], ['class' => 'btn btn-primary']) !!}
{!! link_to_route('lists.award', '受賞年別一覧', [], ['class' => 'btn btn-primary']) !!}
</p>


        </p></center>
        

</header>