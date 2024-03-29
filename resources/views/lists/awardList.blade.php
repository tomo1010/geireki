@extends('layouts.app')

@section('content')



<center><h1 class="mt-3 pb-0">{{$year}}年受賞の</h1>
<h1 class="mt-3 pb-2">芸人一覧</h1></center>

    <div class="container">
        <div class="row">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>大会名/コンビ名</th>
                            <th>当時の芸歴</th>
                            <th>現在の芸歴</th>   
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($awards as $value)
                        <tr>

                            <td>{{$value->award}}
                            </br>{!! link_to_route('entertainers.show', $value->entertainer->name, [$value->entertainer->id]) !!}
                            （{{$value->entertainer->office->office}}）</td>
                            <td>{{$now->diffInYears($value->entertainer->active)-$now->diffInYears($value->year.'-1-1')}}年目</td>   
                            <td>{{$now->diffInYears($value->entertainer->active)}}年目</td>  

                        </tr>
                        @endforeach
                    </tbody>   
                </table>

        </div>
    </div>



@endsection