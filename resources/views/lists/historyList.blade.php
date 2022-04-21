@extends('layouts.app')

@section('content')


<center><h1 class="mt-5 pb-2">芸歴 {{ $year }} 年目</h1></center>

@include('commons.tab_combi')
<br><center>{!! link_to_route('lists.historyList', '<<1年後輩', ['year' => $minus],['class' => 'btn btn-outline-success']) !!}　{!! link_to_route('lists.historyList', '1年先輩>>', ['year' => $plus],['class' => 'btn btn-outline-success']) !!}</center>

    <div class="container">
        <div class="row">
            <div id="1" class="col-lg-4"><h2 class="mt-4 pb-2 display-5">ピン芸人</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>芸人</th>
                            <th>性別</th>
                        </tr>
                    </thead>
                     
                    <tbody>
                        @foreach ($pin as $entertainer)
                            @include('lists.history_common')
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
                        @foreach ($combi as $entertainer)
                            @include('lists.history_common')
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
                        @foreach ($trio as $entertainer)
                            @include('lists.history_common')
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