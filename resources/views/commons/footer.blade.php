<footer class="mb-4">

        <center><p>
{{--一覧へのリンク--}}
<p><br>
{!! link_to_route('search', '詳細検索', [], ['class' => 'btn btn-primary']) !!}
{!! link_to_route('lists.history', '芸歴', [], ['class' => 'btn btn-primary']) !!}
{!! link_to_route('lists.office', '事務所', [], ['class' => 'btn btn-primary']) !!}
{!! link_to_route('lists.age', '年代', [], ['class' => 'btn btn-primary']) !!}
{!! link_to_route('lists.pref', '出身県', [], ['class' => 'btn btn-primary']) !!}
{!! link_to_route('lists.award', '受賞歴', [], ['class' => 'btn btn-primary']) !!}
</p>


        </p></center>

    <nav class="navbar  navbar-dark bg-dark">
        
        {{-- トップページへのリンク --}}
        <center><p class="text-light bg-dark">© 2021 芸歴.net</p></center>

    </nav>
    

</footer>