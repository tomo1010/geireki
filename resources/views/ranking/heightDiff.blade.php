@extends('layouts.app')

@section('content')

    <center><h1 class="mt-5 pb-2">芸人・コンビの身長の差ランキング</h1></center>

    <div class="container">
        <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>身長の差</th>
                            <th>芸歴</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($entertainers as $entertainer)
                            @if(!empty($entertainer->diff))
                            <tr>
                                <td nowrap>{!! link_to_route('entertainers.show', $entertainer->name, [$entertainer->id]) !!}</td>
                                <td>{!!$entertainer->diff!!}cm</td>
                                <td>{!! link_to_route('lists.historyList', $now->diffInYears($entertainer->active), ['year' => $now->diffInYears($entertainer->active)]) !!}</td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>   
                </table>
        </div>
    </div>
    
@endsection