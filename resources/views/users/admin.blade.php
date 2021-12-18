@extends('layouts.app')

@section('content')
<h2>個別登録</h2>
    {!! link_to_route('entertainers.create', '芸人データ', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('perfomers.create', '個人データ', [], ['class' => 'nav-link']) !!}
<h2>一括登録</h2>    
    {!! link_to_route('csv.importOffice', '１）事務所csv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.importEntertainer', '２）芸人csv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.importPerfomer', '３）個人csv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.importMember', '４）芸人個人の中間テーブルcsv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.importAward', '５）受賞歴csv', [], ['class' => 'nav-link']) !!}
<h2>ダウンロード</h2>
    {!! link_to_route('csv.exportOffice', '事務所csv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.exportEntertainer', '芸人csv', [], ['class' => 'nav-link']) !!}    
    {!! link_to_route('csv.exportPerfomer', '個人csv', [], ['class' => 'nav-link']) !!}        


@endsection
