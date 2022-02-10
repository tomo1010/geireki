@extends('layouts.app')

@section('content')

<h2>個別登録</h2>
    {!! link_to_route('entertainers.create', '芸人データ', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('perfomers.create', '個人データ', [], ['class' => 'nav-link']) !!}
    <p>
        
<h2>一括登録</h2>    
    {!! link_to_route('csv.importOffice', '１事務所csv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.importEntertainer', '２芸人csv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.importPerfomer', '３個人csv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.importMember', '４メンバー（中間テーブル）csv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.importAward', '５受賞歴csv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.importYoutube', '６Youtubeおすすめcsv', [], ['class' => 'nav-link']) !!}    
    {!! link_to_route('csv.importFavorite', '７Youtubeお気に入り（中間テーブル）csv', [], ['class' => 'nav-link']) !!}        
　　<p>

<h2>ダウンロード</h2>
    {!! link_to_route('csv.exportOffice', '１事務所csv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.exportEntertainer', '２芸人csv', [], ['class' => 'nav-link']) !!}    
    {!! link_to_route('csv.exportPerfomer', '３個人csv', [], ['class' => 'nav-link']) !!}        
    {!! link_to_route('csv.exportMember', '４メンバー（中間テーブル）csv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.exportAward', '５受賞歴csv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.exportYoutube', '６Youtubeおすすめcsv', [], ['class' => 'nav-link']) !!}    
    {!! link_to_route('csv.exportFavorite', '７Youtubeお気に入り（中間テーブル）csv', [], ['class' => 'nav-link']) !!}        
    


@endsection
