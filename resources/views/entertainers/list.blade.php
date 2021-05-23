@extends('layouts.app')

@section('content')

<h1>芸歴 {{ $year }} 年目</h1>


    <table class="table table-striped">
        <tr>
            <td>ピン芸人</td>
            <td>コンビ芸人</td>
            <td>トリオ芸人</td>
        </tr>
        
        <tr>
            <td>
            <table class="table table-striped">
            <thead>
                <tr>
                    <th>芸人</th>
                    <th>活動時期</th>
                    <th>活動終了時期</th>
                    <th>師匠</th>
                    <th>旧名</th>
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
                </tr>
                @else
                <tr class="text-secondary">
                    <td nowrap>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}（解散済）</td>
                    <td>{{ $value->active }}</td>
                    <td>{{ $value->activeend }}</td>
                    <td>{{ $value->master }}</td>
                    <td>{{ $value->oldname }}</td>
                </tr>
                @endif
                @endforeach
            </tbody>   
        </table>    
            </td>
            <td>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>芸人</th>
                        <th>活動時期</th>
                        <th>活動終了時期</th>
                        <th>師匠</th>
                        <th>旧名</th>
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
                    </tr>
                    @else
                    <tr class="text-secondary">
                        <td nowrap>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}（解散済）</td>
                        <td>{{ $value->active }}</td>
                        <td>{{ $value->activeend }}</td>
                        <td>{{ $value->master }}</td>
                        <td>{{ $value->oldname }}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>   
            </table>            
            </td>
            <td>
                                <table class="table table-striped">
            <thead>
                <tr>
                    <th>芸人</th>
                    <th>活動時期</th>
                    <th>活動終了時期</th>
                    <th>師匠</th>
                    <th>旧名</th>
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
                </tr>
                @else
                <tr class="text-secondary">
                    <td nowrap>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}（解散済）</td>
                    <td>{{ $value->active }}</td>
                    <td>{{ $value->activeend }}</td>
                    <td>{{ $value->master }}</td>
                    <td>{{ $value->oldname }}</td>
                </tr>
                @endif
                @endforeach
            </tbody>   
        </table>
            </td>

        </tr>
        
        
        





@endsection