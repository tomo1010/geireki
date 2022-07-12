@extends('layouts.app')

@section('content')


    <center><h1 class="mt-5 pb-2">芸人・コンビの年の差ランキング</h1></center>

    <div class="container">
        <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>年の差</th>
                            <th>芸歴</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $key => $value)
                            @if($value > 5)
                            <tr>
                                <td nowrap>{!! link_to_route('entertainers.show', $entertainers[$key]->name, [$entertainers[$key]->id]) !!}</td>
                                <td>{{$value}}</td>
                                <td>{!! link_to_route('lists.historyList', $now->diffInYears($entertainers[$key]->active), ['year' => $now->diffInYears($entertainers[$key]->active)]) !!}</td>
                            </tr>                            
                            @endif
                        @endforeach
                    </tbody>   
                </table>
        </div>
    </div>

@endsection