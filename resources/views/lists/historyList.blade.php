@extends('layouts.app')

@section('content')



<h1 class="mt-2 pb-2">芸歴 {{ $year }} 年目</h1>
<center><a href="#1">ピン芸人</a>｜<a href="#2">コンビ芸人</a>｜<a href="#3">トリオ芸人</a><br>
　<<{!! link_to_route('lists.historyList', '1年先輩', ['year' => $plus]) !!}　{!! link_to_route('lists.historyList', '1年後輩', ['year' => $minus]) !!}>></center>

    <div class="container">
        <div class="row">
            <div class="col-lg-4" id="1"><h2 class="mt-2 pb-2 display-5">ピン芸人</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>芸人</th>
                            <th>性別</th>
                        </tr>
                    </thead>
                     
                    <tbody>
                        @foreach ($results_1 as $value)
                        @if($value->activeend == NULL){{--解散済みの場合はグレー文字--}}
                        <tr>
                            <td>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}</td>
                            @include('commons.gender')
                        </tr>
                        @else
                        <tr class="text-secondary">
                            <td>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}（解散済）</td>
                            <td>@include('commons.gender')</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>   
                </table>
            </div>
            <div class="col-lg-4" id="2"><h2 class="mt-2 pb-2 display-5">コンビ芸人</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>芸人</th>
                            <th>性別</th>
                        </tr>
                    </thead>
                     
                    <tbody>
                        @foreach ($results_2 as $value)
                        @if($value->activeend == NULL){{--解散済みの場合はグレー文字--}}
                        <tr>
                            <td>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}</td>
                            @include('commons.gender')
                        </tr>
                        @else
                        <tr class="text-secondary">
                            <td>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}（解散済）</td>
                            @include('commons.gender')
                        </tr>
                        @endif
                        @endforeach
                    </tbody>   
                </table>
            </div>
            <div class="col-lg-4" id="3"><h2 class="mt-2 pb-2 display-5">トリオ芸人</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>芸人</th>
                            <th>性別</th>
                        </tr>
                    </thead>
                     
                    <tbody>
                        @foreach ($results_3 as $value)
                        @if($value->activeend == NULL){{--解散済みの場合はグレー文字--}}
                        <tr>
                            <td>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}</td>
                            @include('commons.gender')
                        </tr>
                        @else
                        <tr class="text-secondary">
                            <td>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}（解散済）</td>
                            @include('commons.gender')
                        </tr>
                        @endif
                        @endforeach
                    </tbody>   
                </table>
            </div>
        </div>
    </div>
        
<center><a href="#1">ピン芸人</a>｜<a href="#2">コンビ芸人</a>｜<a href="#3">トリオ芸人</a><br>
　<<{!! link_to_route('lists.historyList', '1年先輩', ['year' => $plus]) !!}　{!! link_to_route('lists.historyList', '1年後輩', ['year' => $minus]) !!}>></center>　    

@endsection