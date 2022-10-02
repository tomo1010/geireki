<footer class="footer">

<center><p>

        {{--詳細検索ボタン--}}
        {!! link_to_route('search', '詳細検索', [], ['class' => 'btn btn-success']) !!}

</p></center>

    <nav class="navbar  navbar-dark bg-dark">


<table class="table table-borderless">
    <tr>
        <th><div class="text-light bg-dark">一覧</div></th>
        <th><div class="text-light bg-dark">ランキング</div></th>
        <th><div class="text-light bg-dark">すべてのデータ</div></th>        
    </tr>
    <tr>
        <td>
            {!! link_to_route('lists.history', '芸歴', ) !!}</br>
            {!! link_to_route('lists.office', '事務所', ) !!}</br>
            {!! link_to_route('lists.age', '年代', ) !!}</br>
            {!! link_to_route('lists.pref', '出身地', ) !!}</br>
            {!! link_to_route('lists.award', '受賞歴', ) !!}</br>
            {!! link_to_route('lists.birthday', '誕生日', ) !!}
        </td>
  
        <td>
            {!! link_to_route('ranking.heightTall', '高身長', ) !!}</br>
            {!! link_to_route('ranking.heightShort', '低身長', ) !!}</br>
            {!! link_to_route('ranking.award', '受賞数', ) !!}</br>
            {!! link_to_route('ranking.movieCount', 'Youtube投稿数', ) !!}</br>
            {!! link_to_route('ranking.movieFavorite', 'Youtubeお気に入り数', ) !!}</br>            
            {!! link_to_route('ranking.tag', 'Tag', ) !!}

        </td>
        
        <td>
            {!! link_to_route('entertainers.all', 'すべての芸人', ) !!}</br>
            {!! link_to_route('perfomers.all', 'すべての個人', ) !!}            
        </td>
    </tr>
</table>



        <p class="text-light bg-dark">{!! link_to_route('search', '詳細検索', ) !!}</p>                
        <p class="text-light bg-dark"><a href="mailto:info@geireki.net"><img src="/icon/icon_mail.png" width="24" alt="メール｜芸歴.net"></a></p> 
        <p class="text-light bg-dark">© 2021 芸歴.net</p> 
    </nav>

<!--SNSおまとめボタン-->
<div class="ninja_onebutton">
<script type="text/javascript">
//<![CDATA[
(function(d){
if(typeof(window.NINJA_CO_JP_ONETAG_BUTTON_5e8054e4a9dccfb38299338173a6db39)=='undefined'){
    document.write("<sc"+"ript type='text\/javascript' src='\/\/omt.shinobi.jp\/b\/5e8054e4a9dccfb38299338173a6db39'><\/sc"+"ript>");
}else{
    window.NINJA_CO_JP_ONETAG_BUTTON_5e8054e4a9dccfb38299338173a6db39.ONETAGButton_Load();}
})(document);
//]]>
</script><span class="ninja_onebutton_hidden" style="display:none;"></span><span style="display:none;" class="ninja_onebutton_hidden"></span>
</div>
<!--SNSおまとめボタン-->

</footer>