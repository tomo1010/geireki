@extends('layouts.app')

@section('content')

    {!! link_to_route('entertainers.create', '芸人データ個別　登録', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('perfomers.create', '個人データ個別　登録', [], ['class' => 'nav-link']) !!}
    
    {!! link_to_route('csv.importEntertainer', '芸人csv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.importOffice', '事務所csv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.importPerfomer', '個人csv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.importMember', '芸人個人の中間テーブルcsv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.importAward', '受賞歴テーブルcsv', [], ['class' => 'nav-link']) !!}

    {!! link_to_route('csv.exportOffice', 'ダウンロード事務所csv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.exportEntertainer', 'ダウンロード芸人csv', [], ['class' => 'nav-link']) !!}    
    {!! link_to_route('csv.exportPerfomer', 'ダウンロード個人csv', [], ['class' => 'nav-link']) !!}        


@endsection
