<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>芸歴.net</title>
        <meta content="芸人さんの芸歴データベース。M1ラストイヤーの実力派芸人は誰？芸歴から芸人の関係性もみえてくる。" name="description">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset=”UTF-8″>

        <meta property="og:url" content="http://www.geireki.net/" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="芸歴.net" />
        <meta property="og:description" content="芸人さんの芸歴データベース。M1ラストイヤーの実力派芸人は誰？芸歴から芸人の関係性もみえてくる。" />
        <meta property="og:site_name" content="芸歴.net" />
        <meta property="og:image" content="" />
        
        <!--Twitterカード設定-->
        <meta name="twitter:card" content="summary" /> <!--①-->
        <meta name="twitter:site" content="@geireki_" /> <!--②-->
        <meta property="og:url" content="https://www.geireki.net/" /> <!--③-->
        <meta property="og:title" content="芸歴.net" /> <!--④-->
        <meta property="og:description" content="芸人さんの芸歴をデータベースにしました。同期や先輩後輩、同い年芸人など" /> <!--⑤-->
        <meta property="og:image" content="https://www.geireki.net/icon.png" /> <!--⑥-->
        


        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-W3B7H8TZFM"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'G-W3B7H8TZFM');
        </script>
        <!-- Global site tag (gtag.js) - Google Analytics -->


        <!--AdSenseタグ-->
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8272433810922720"
        crossorigin="anonymous"></script>
        <!--AdSenseタグ-->

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <!--<link rel="stylesheet" href="{{ asset('bootflat.github.io-master/css/bootstrap.min.css') }}">-->

    </head>

    <body>
        

        {{-- ナビゲーションバー --}}
        @include('commons.navbar')

        <div class="container">
            {{-- エラーメッセージ --}}
            @include('commons.error_messages')

            @yield('content')
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>