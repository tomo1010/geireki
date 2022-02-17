@extends('layouts.app')

@section('content')



<h1 class="mt-2 pb-2">検索結果</h1>



<h2 class="mt-2 pb-2">芸人一覧</h1>
    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>芸人</th>
                    <th>芸歴</th>
                </tr>
            </thead>
            
            <tbody>
                
                {{--芸人の検索結果--}}
                @foreach ($search_1 as $value)
                    @if($value->activeend == NULL) {{--解散済みの場合はグレー文字--}}
                    <tr>
                        <td nowrap>{!! link_to_route('entertainers.show', $value->name, ['id' => $value->id]) !!}</td>
                        <td>{{$now->diffInYears($value->active)}}年</td>
                    </tr>
                    @else
    
                    <tr class="text-secondary">
                        <td nowrap>{!! link_to_route('entertainers.show', $value->name, ['id' => $value->id]) !!}（解散済）</td>
                        <td>{{$now->diffInYears($value->active)}}年</td>
                    </tr>
                    @endif
                @endforeach
                
                {{--個人の検索結果--}}                
                @foreach ($search_2 as $value)
                    @if($value->activeend == NULL) {{--解散済みの場合はグレー文字--}}
                    <tr>
                        <td nowrap>{!! link_to_route('perfomers.show', $value->name, ['id' => $value->id]) !!}（個人）</td>
                        <td>{{$now->diffInYears($value->active)}}年</td>
                    </tr>
                    @else
    
                    <tr class="text-secondary">
                        <td nowrap>{!! link_to_route('perfomers.show', $value->name, ['id' => $value->id]) !!}（解散済）</td>
                        <td>{{$now->diffInYears($value->active)}}年</td>
                    </tr>
                    @endif
                @endforeach
                
            </tbody>
        </table>



@endsection