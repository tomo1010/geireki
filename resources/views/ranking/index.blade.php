@extends('layouts.app')

@section('content')

    <ul class="nav nav-tabs justify-content-center">
    <li class="nav-item"><a href="#award" class="nav-link" data-toggle="tab">受賞数</a></li>
    <li class="nav-item"><a href="#favorite" class="nav-link active" data-toggle="tab">お気に入りYoutube数</a></li>
    <li class="nav-item"><a href="#short" class="nav-link" data-toggle="tab">背が低い</a></li>
    <li class="nav-item"><a href="#tall" class="nav-link" data-toggle="tab">背が高い</a></li>    
    <li class="nav-item"><a href="#yearDiff" class="nav-link" data-toggle="tab">年齢差コンビ</a></li>        
    </ul>


    <div class="tab-content">
    <div id="award" class="tab-pane">
        {{--@include('ranking.award')--}}
    </div>


{!! link_to_route('ranking.award', '受賞歴',) !!}
{!! link_to_route('ranking.favorite', 'お気に入り数',) !!}
{!! link_to_route('ranking.short', '背が低い',) !!}
{!! link_to_route('ranking.tall', '背が高い',) !!}
{!! link_to_route('ranking.yearDiff', '年齢差コンビ',) !!}

@endsection