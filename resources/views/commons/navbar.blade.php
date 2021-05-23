<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/">MessageBoard</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                {{-- メッセージ作成ページへのリンク --}}
                <li class="nav-item">{!! link_to_route('entertainers.create', '新規メッセージの投稿', [], ['class' => 'nav-link']) !!}</li>
            </ul>
        </div>
        
        {{--解散済み表示非表示のチェックBOX
        <form method="post" action="{{ route('entertainers.check')}}">
         @csrf
            <input type="checkbox" name="check" value="1" onchange="submit(this.form)">
        </form>--}}

        
    </nav>
</header>