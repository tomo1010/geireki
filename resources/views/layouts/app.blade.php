<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>芸人データベース｜芸歴.net</title>
        <meta content="芸人さんの芸歴データベース。芸歴一覧検索、お笑い芸人の芸歴検索、同期芸人一覧。先輩芸人、後輩芸人、同い年、今日誕生日の芸人さん。お笑い芸人ランキング。M-1ファイナリスト芸歴、キングオブコントファイナリスト芸歴" name="description">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset=”UTF-8″>

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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        
        
        <!--<link rel="stylesheet" href="{{ asset('bootflat.github.io-master/css/bootstrap.min.css') }}">-->
        <link rel="stylesheet" href="bootstrap-social.css" >       
        <span style="color: #000000;"><head> <link rel="canonical" href="https://www.geireki.net/"> </head></span>

    </head>

    <body>
        

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