@extends('layouts.app')

@section('content')

    <center><h1 class="mt-5 pb-2">年齢をとってから芸人に</h1></center>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>名前</th>
                        <th>デビュー年齢</th>
                        <th>現在の年齢</th>
                        <th>芸歴</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($elderly as $key => $value)
                        @if($value >= 30)
                        <tr>
                            <td nowrap>{!! link_to_route('perfomers.show', $perfomers[$key]->name, [$perfomers[$key]->id]) !!}<br>
                            <td>{{$value}}歳</td>
                            <td>{!! link_to_route('lists.age2List', $now->diffInYears($perfomers[$key]->birthday), ['yearsOld' => $now->diffInYears($perfomers[$key]->birthday)]) !!}</td>
                            <td>{!! link_to_route('lists.historyList', $now->diffInYears($perfomers[$key]->active), ['year' => $now->diffInYears($perfomers[$key]->active)]) !!}</td>
                        </tr>                            
                        @endif
                    @endforeach
                </tbody>   
            </table>

@endsection