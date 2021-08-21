@extends('layouts.app')

@section('content')



<h1 class="mt-2 pb-2"> {{$year}}年受賞の芸人一覧</h1>

    <div class="container">
        <div class="row">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>受賞名</th>
                            <th>コンビ名、芸名</th>                                                   
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($awards as $value)
                        {{--@if($value->entertainer->activeend == NULL){{--解散済みの場合はグレー文字--}}
                        <tr>
                            <td>{{$value->award}}</td>
                            <td nowrap>{!! link_to_route('entertainers.show', $value->entertainer->name, [$value->entertainer->id]) !!}</td>
                        </tr>
                        {{--
                        @else

                        <tr class="text-secondary">
                            <td nowrap>{!! link_to_route('perfomers.show', $value->name, [$value->id]) !!}（解散済）</td>
                            <td>{{$now->diffInYears($value->birthday)}}歳</td>
                            <td>{{$now->diffInYears($value->active)}}年目</td>
                            <td>{{!empty($value->entertainer[0]->name) ? $value->entertainer[0]->name : '' }}</td>                            
                        </tr>

                        @endif
                        --}}
                        @endforeach
                    </tbody>   
                </table>


        </div>
    </div>



@endsection