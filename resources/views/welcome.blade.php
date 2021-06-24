@extends('layouts.app')

@section('content')

    {!! link_to_route('entertainers.create', '芸人データ登録', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('perfomers.create', '個人データ登録', [], ['class' => 'nav-link']) !!}
    
    {!! link_to_route('csv.importEntertainer', '芸人csv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.importOffice', '事務所csv', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('csv.importPerfomer', '個人csv', [], ['class' => 'nav-link']) !!}
@endsection
