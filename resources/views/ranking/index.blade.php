@extends('layouts.app')

@section('content')

コンビ間の年齢差ランキング
            {!! link_to_route('ranking.ageDiff', '年の差', ) !!}</br>
若い時から芸人になったランキング
            {!! link_to_route('ranking.ageYoung', '若くして芸人に', ) !!}</br>
年を取ってから芸人になったランキング
            {!! link_to_route('ranking.ageElderly', '年を取ってから芸人に', ) !!}</br>            
お笑い好きがオススメするネタ動画ランキング
            {!! link_to_route('ranking.movieCount', 'Youtube投稿数', ) !!}</br>
お笑い好きがお気に入りのネタ動画ランキング
            {!! link_to_route('ranking.movieFavorite', 'Youtubeお気に入り数', ) !!}</br>                                    
背が高い芸人ランキング            
            {!! link_to_route('ranking.heightTall', '高身長', ) !!}</br>
背が低い芸人ランキング
            {!! link_to_route('ranking.heightShort', '低身長', ) !!}</br>
凸凹コンビランキング
            {!! link_to_route('ranking.heightDiff', '身長の差', ) !!}</br>        
２人ともデカいコンビは誰だ？威圧感ランキング
            {!! link_to_route('ranking.heightSum', '身長の合計', ) !!}</br>
実力者のひとつの指標。受賞数ランキング            
            {!! link_to_route('ranking.award', '受賞数', ) !!}</br>
お笑い好きの傾向がわかるタグランキング
            {!! link_to_route('ranking.tag', 'Tag', ) !!}</br>
実力コンビが一目瞭然ランキング
            {!! link_to_route('ranking.historyAvg', '各個人の芸歴は長いけどコンビ芸歴は短い', ) !!}</br>
            
@endsection