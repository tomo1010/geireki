@extends('layouts.app')

@section('content')
        <li class="nav-item">{!! link_to_route('entertainers.create', '芸人データ登録', [], ['class' => 'nav-link']) !!}</li>
        <li class="nav-item">{!! link_to_route('perfomers.create', '個人データ登録', [], ['class' => 'nav-link']) !!}</li>
    @include('users.users')
@endsection
