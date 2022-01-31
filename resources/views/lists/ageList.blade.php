@extends('layouts.app')

@section('content')


    <center><h1 class="mt-5 pb-2">{{$year}}代の芸人一覧</h1></center>

    <div class="container">
        <div class="row">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>コンビ名など</th>                            
                            <th>年齢</th>
                            <th>芸歴</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perfomer as $value)
                        @if($value->activeend == NULL){{--解散済みの場合はグレー文字--}}
                        <tr>
                            <td nowrap>{!! link_to_route('perfomers.show', $value->name, [$value->id]) !!}</td>

                            {{--コンビ名もリンク--}}
                            <td>
                            @if(!empty($value->entertainer[0]->name))
                                {!! link_to_route('entertainers.show', $value->entertainer[0]->name, $value->entertainer[0]->id) !!}
                            @else
                            @endif    
                            </td>

                            <td>{{$now->diffInYears($value->birthday)}}歳</td>
                            <td>{{!empty($value->active) ? $now->diffInYears($value->active) : '-' }}年目</td>
                        </tr>
                        @else
                        <tr class="text-secondary">
                            <td nowrap>{!! link_to_route('perfomers.show', $value->name, [$value->id]) !!}（解散済）</td>
                            
                            {{--コンビ名もリンク--}}
                            <td>
                            @if(!empty($value->entertainer[0]->name))
                                {!! link_to_route('entertainers.show', $value->entertainer[0]->name, $value->entertainer[0]->id) !!}
                            @else
                            @endif    
                            </td>
                            
                            <td>{{$now->diffInYears($value->birthday)}}歳</td>
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