@extends('layouts.app')

@section('content')
    {!! link_to_route('entertainers.create', '芸人データ登録', [], ['class' => 'nav-link']) !!}
    {!! link_to_route('perfomers.create', '個人データ登録', [], ['class' => 'nav-link']) !!}
@endsection
