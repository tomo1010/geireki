@extends('layouts.app')

@section('content')

    <h2>個別登録</h1>
    {!! link_to_route('entertainers.create', '芸人データ個別　登録', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('perfomers.create', '個人データ個別　登録', [], ['class' => 'nav-link']) !!}
    <h2>csvアップロード</h1>    
    {!! link_to_route('csv.importEntertainer', '芸人csv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.importOffice', '事務所csv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.importPerfomer', '個人csv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.importMember', '芸人個人の中間テーブルcsv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.importAward', '受賞歴テーブルcsv', [], ['class' => 'nav-link']) !!}
    <h2>csvダウンロード</h1>    
    {!! link_to_route('csv.exportOffice', 'DL事務所csv', [], ['class' => 'btn btn-outline-success']) !!}
    {!! link_to_route('csv.exportEntertainer', 'DL芸人csv', [], ['class' => 'btn btn-outline-success']) !!}    

@endsection
