@extends('layouts.app')

@section('content')

<h1>芸人一覧</h1>

    @if (count($entertainers) > 0)
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
                @foreach ($entertainers as $entertainer)
                <tr>
                    <td nowrap>{!! link_to_route('entertainers.show', $entertainer->name, ['entertainer' => $entertainer->id]) !!}</td>
                    <td>{{ $entertainer->active }}</td>
                    <td>{{ $entertainer->activeend }}</td>
                    <td>{{ $entertainer->master }}</td>
                    <td>{{ $entertainer->oldname }}</td>
                    <td><a href="{{ $entertainer->official }}">公式</a></td>
                    <td><a href="{{ $entertainer->youtube }}">Youtube</a></td>
                    <td nowrap>{{ $diff[$loop->index] }}年</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        
        <h2>今年M1ラストイヤーの芸人</h2>
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
                @foreach ($results as $value)
                <tr>
                    <td nowrap>{!! link_to_route('entertainers.show', $value->name, ['entertainer' => $entertainer->id]) !!}</td>
                    <td>{{ $value->active }}</td>
                    <td>{{ $value->activeend }}</td>
                    <td>{{ $value->master }}</td>
                    <td>{{ $value->oldname }}</td>
                    <td><a href="{{ $value->official }}">公式</a></td>
                    <td><a href="{{ $value->youtube }}">Youtube</a></td>
                    <td nowrap>{{ $diff[$loop->index] }}年</td>
                </tr>
                @endforeach
            </tbody>   
        </table>    
        
    @endif
    
    {{-- 作成ページへのリンク --}}
    {!! link_to_route('entertainers.create', '新規メッセージの投稿', [], ['class' => 'btn btn-primary']) !!}

@endsection