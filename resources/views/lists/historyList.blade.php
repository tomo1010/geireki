@extends('layouts.app')

@section('content')



<center><h1 class="mt-5 pb-2">芸歴 {{ $year }} 年目</h1></center>

@include('commons.tab_combi')
<br><center>{!! link_to_route('lists.historyList', '<<1年後輩', ['year' => $minus],['class' => 'btn btn-outline-success']) !!}　{!! link_to_route('lists.historyList', '1年先輩>>', ['year' => $plus],['class' => 'btn btn-outline-success']) !!}</center>

    <div class="container">
        <div class="row">
            <div id="1" class="col-lg-4"><h2 class="mt-5 pb-2 display-5">ピン芸人</h2>
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
            <div id="2" class="col-lg-4"><h2 class="mt-4 pb-2 display-5">コンビ芸人</h2>
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
            <div id="3" class="col-lg-4"><h2 class="mt-4 pb-2 display-5">トリオ芸人</h2>
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
        
        
</br>
@include('commons.tab_combi')
</br><center>{!! link_to_route('lists.historyList', '<<1年後輩', ['year' => $minus],['class' => 'btn btn-outline-success']) !!}　{!! link_to_route('lists.historyList', '1年先輩>>', ['year' => $plus],['class' => 'btn btn-outline-success']) !!}</center>

@endsection