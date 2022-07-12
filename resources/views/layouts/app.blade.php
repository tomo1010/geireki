<!DOCTYPE html>
<html lang="ja">
    <head>
        
        
        <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-2272724-34"></script>
            <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-2272724-34');
            </script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        
        
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5X583BF');</script>
<!-- End Google Tag Manager -->        
        
        
        <meta charset="utf-8">
        <title>芸人データベース｜芸歴.net</title>
        <meta content="芸人さんの芸歴データベース。芸歴一覧検索、お笑い芸人の芸歴検索、同期芸人一覧。先輩芸人、後輩芸人、同い年、今日誕生日の芸人さん。お笑い芸人ランキング。M-1ファイナリスト芸歴、キングオブコントファイナリスト芸歴" name="description">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset=”UTF-8″>

        <!--Facebook設定-->
        <meta property="og:url" content="http://www.geireki.net/" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="芸人さんの芸歴データベース｜芸歴.net" />
        <meta property="og:description" content="芸人さんの芸歴データベース。芸歴一覧検索、お笑い芸人の芸歴検索、同期芸人一覧。先輩芸人、後輩芸人、同い年、今日誕生日の芸人さん。お笑い芸人ランキング。M-1ファイナリスト芸歴、キングオブコントファイナリスト芸歴" />
        <meta property="og:site_name" content="芸歴.net" />
        <meta property="og:image" content="" />
        
        <!--Twitterカード設定-->
        <meta name="twitter:card" content="summary" /> <!--①-->
        <meta name="twitter:site" content="@geireki_" /> <!--②-->
        <meta property="og:url" content="https://www.geireki.net/" /> <!--③-->
        <meta property="og:title" content="芸人さんの芸歴データベース｜芸歴.net" /> <!--④-->
        <meta property="og:description" content="芸人さんの芸歴データベース。芸歴一覧検索、お笑い芸人の芸歴検索、同期芸人一覧。先輩芸人、後輩芸人、同い年、今日誕生日の芸人さん。お笑い芸人ランキング。M-1ファイナリスト芸歴、キングオブコントファイナリスト芸歴" /> <!--⑤-->
        <meta property="og:image" content="https://www.geireki.net/icon/icon.png" /> <!--⑥-->
        


        <!--AdSenseタグ-->
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8272433810922720"
        crossorigin="anonymous"></script>
        <!--AdSenseタグ-->

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

    </head>

    <body>

        
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5X583BF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
        

        {{-- ナビゲーションバー --}}
        @include('commons.navbar')

        <div class="container">
            {{-- エラーメッセージ --}}
            @include('commons.error_messages')

            @yield('content')
        </div>

        @include('commons.footer')

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>

 
    </body>
</html>