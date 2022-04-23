@extends('layouts.app')

@section('content')



<center><h1 class="mt-5 pb-2">{{$gp}}</h1>
<h1 class="mt-2 pb-2">芸人一覧</h1></center>

    <div class="container">
        <div class="row">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>年</th>
                            <th>大会名</th>
                            <th>コンビ名</th>                                                   
                            <th>事務所</th>                                                                           
                            <th>当時の芸歴</th>
                            <th>現在の芸歴</th>                                                                                                       
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($awards as $award)
                        <tr>
                            <td>{{$award->year}}</td>                            
                            <td>{{$award->award}}</td>
                            <td>{!! link_to_route('entertainers.show', $award->entertainer->name, [$award->entertainer->id]) !!}</td>
                            <td>{{$award->entertainer->office->office}}</td>
                            <td>{!! link_to_route('lists.historyList', $now->diffInYears($award->entertainer->active)-$now->diffInYears($award->year.'-1-1'), ['year' => $now->diffInYears($award->entertainer->active)-$now->diffInYears($award->year.'-1-1')]) !!}年</td>
                            <td>{!! link_to_route('lists.historyList', $now->diffInYears($award->entertainer->active), ['year' => $now->diffInYears($award->entertainer->active)]) !!}年</td>                            

                        </tr>
                        @endforeach
                    </tbody>   
                </table>

        </div>
    </div>



@endsection