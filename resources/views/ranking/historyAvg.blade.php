@extends('layouts.app')

@section('content')

    <center><h1 class="mt-5 pb-2">各個人の芸歴は長いけどコンビ芸歴は短いランキング</h1></center>

    <div class="container">
        <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>芸歴の差分</th>                            
                            <th>コンビの芸歴平均</th>
                            <th>芸歴</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($entertainers as $entertainer)
                            @if(!empty($entertainer->historyAvg))
                            <tr>
                                <td nowrap>{!! link_to_route('entertainers.show', $entertainer->name, [$entertainer->id]) !!}</td>
                                <td>{!!$entertainer->historyDiff!!}年</td>
                                <td>{!!$entertainer->historyAvg!!}年</td>
                                <td>{!! link_to_route('lists.historyList', $now->diffInYears($entertainer->active), ['year' => $now->diffInYears($entertainer->active)]) !!}</td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>   
                </table>
        </div>
    </div>
    
@endsection