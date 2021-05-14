@extends('layouts.app')

@section('content')

<h1>芸歴 {{ $year }} 年目</h1>

    <h2>コンビ芸人</h2>
    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>芸人</th>
                    <th>活動時期</th>
                    <th>活動終了時期</th>
                    <th>師匠</th>
                    <th>旧名</th>
                    <th>公式</th>
                    <th>Youtube</th>
                    <th>芸歴</th>
                </tr>
            </thead>
             
            <tbody>
                @foreach ($results_2 as $value)
                @if($value->activeend == NULL)
                <tr>
                    <td nowrap>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}</td>
                    <td>{{ $value->active }}</td>
                    <td>{{ $value->activeend }}</td>
                    <td>{{ $value->master }}</td>
                    <td>{{ $value->oldname }}</td>
                    <td><a href="{{ $value->official }}">公式</a></td>
                    <td><a href="{{ $value->youtube }}">Youtube</a></td>
                    <td nowrap>{{$now->diffInYears($value->active)}}年</td>
                </tr>
                @else
                <tr class="text-secondary">
                    <td nowrap>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}（解散済）</td>
                    <td>{{ $value->active }}</td>
                    <td>{{ $value->activeend }}</td>
                    <td>{{ $value->master }}</td>
                    <td>{{ $value->oldname }}</td>
                    <td><a href="{{ $value->official }}">公式</a></td>
                    <td><a href="{{ $value->youtube }}">Youtube</a></td>
                    <td nowrap>{{$now->diffInYears($value->active)}}年</td>
                </tr>
                @endif
                @endforeach
            </tbody>   
        </table>    
        
            <h2>トリオ芸人</h2>
    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>芸人</th>
                    <th>活動時期</th>
                    <th>活動終了時期</th>
                    <th>師匠</th>
                    <th>旧名</th>
                    <th>公式</th>
                    <th>Youtube</th>
                    <th>芸歴</th>
                </tr>
            </thead>
             
            <tbody>
                @foreach ($results_3 as $value)
                @if($value->activeend == NULL)
                <tr>
                    <td nowrap>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}</td>
                    <td>{{ $value->active }}</td>
                    <td>{{ $value->activeend }}</td>
                    <td>{{ $value->master }}</td>
                    <td>{{ $value->oldname }}</td>
                    <td><a href="{{ $value->official }}">公式</a></td>
                    <td><a href="{{ $value->youtube }}">Youtube</a></td>
                    <td nowrap>{{$now->diffInYears($value->active)}}年</td>
                </tr>
                @else
                <tr class="text-secondary">
                    <td nowrap>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}（解散済）</td>
                    <td>{{ $value->active }}</td>
                    <td>{{ $value->activeend }}</td>
                    <td>{{ $value->master }}</td>
                    <td>{{ $value->oldname }}</td>
                    <td><a href="{{ $value->official }}">公式</a></td>
                    <td><a href="{{ $value->youtube }}">Youtube</a></td>
                    <td nowrap>{{$now->diffInYears($value->active)}}年</td>
                </tr>
                @endif
                @endforeach
            </tbody>   
        </table>    




            <h2>ピン芸人</h2>
    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>芸人</th>
                    <th>活動時期</th>
                    <th>活動終了時期</th>
                    <th>師匠</th>
                    <th>旧名</th>
                    <th>公式</th>
                    <th>Youtube</th>
                    <th>芸歴</th>
                </tr>
            </thead>
             
            <tbody>
                @foreach ($results_1 as $value)
                @if($value->activeend == NULL)
                <tr>
                    <td nowrap>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}</td>
                    <td>{{ $value->active }}</td>
                    <td>{{ $value->activeend }}</td>
                    <td>{{ $value->master }}</td>
                    <td>{{ $value->oldname }}</td>
                    <td><a href="{{ $value->official }}">公式</a></td>
                    <td><a href="{{ $value->youtube }}">Youtube</a></td>
                    <td nowrap>{{$now->diffInYears($value->active)}}年</td>
                </tr>
                @else
                <tr class="text-secondary">
                    <td nowrap>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}（解散済）</td>
                    <td>{{ $value->active }}</td>
                    <td>{{ $value->activeend }}</td>
                    <td>{{ $value->master }}</td>
                    <td>{{ $value->oldname }}</td>
                    <td><a href="{{ $value->official }}">公式</a></td>
                    <td><a href="{{ $value->youtube }}">Youtube</a></td>
                    <td nowrap>{{$now->diffInYears($value->active)}}年</td>
                </tr>
                @endif
                @endforeach
            </tbody>   
        </table>    





@endsection