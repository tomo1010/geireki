<footer class="footer">

<center><p>
    {{--一覧へのリンク--}}
    <p><br>
        {!! link_to_route('lists.history', '芸歴', [], ['class' => 'btn btn-primary']) !!}
        {!! link_to_route('lists.office', '事務所', [], ['class' => 'btn btn-primary']) !!}
        {!! link_to_route('lists.age', '年代', [], ['class' => 'btn btn-primary']) !!}
        {!! link_to_route('lists.birthday', '誕生日', [], ['class' => 'btn btn-primary']) !!}        
        {!! link_to_route('lists.pref', '出身', [], ['class' => 'btn btn-primary']) !!}
        {!! link_to_route('lists.award', '受賞歴', [], ['class' => 'btn btn-primary']) !!}
    </p>
        {!! link_to_route('search', '詳細検索', [], ['class' => 'btn btn-light']) !!}

</p></center>

    <nav class="navbar  navbar-dark bg-dark">

        <p class="text-light bg-dark">{!! link_to_route('entertainers.all', '芸人一覧', ) !!}</p>
        <p class="text-light bg-dark">{!! link_to_route('perfomers.all', '個人一覧', ) !!}</p>        
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