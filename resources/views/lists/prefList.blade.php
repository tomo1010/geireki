@extends('layouts.app')

@section('content')



<center><h1 class="mt-2 pb-2">{{$pref}}出身の</h1><h1 class="mt-2 pb-2">芸人一覧</h1></center>

    <div class="container">
        <div class="row">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>コンビ名、芸名</th>       
                            <th>出身地</th>
                            <th>芸歴</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perfomer as $value)
                        @if($value->activeend == NULL){{--解散済みの場合はグレー文字--}}
                        <tr>
                            <td nowrap>{!! link_to_route('perfomers.show', $value->name, [$value->id]) !!}</td>
                            <td>{{!empty($value->entertainer[0]->name) ? $value->entertainer[0]->name : '' }}</td>                              
                            <td>{{$value->birthplace}}</td>
                            <td>{{!empty($value->active) ? $now->diffInYears($value->active) : '-' }}年目</td>

                        </tr>
                        @else
                        <tr class="text-secondary">
                            <td nowrap>{!! link_to_route('perfomers.show', $value->name, [$value->id]) !!}（解散済）</td>
                            <td>{{!empty($value->entertainer[0]->name) ? $value->entertainer[0]->name : '' }}</td>                              
                            <td>{{$value->birthplace}}</td>
                            <td>{{!empty($value->active) ? $now->diffInYears($value->active) : '-' }}年目</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>   
                </table>


        </div>
    </div>


    {{-- ページネーションのリンク --}}
    {{ $perfomer->appends(request()->query())->links() }}        

@endsection