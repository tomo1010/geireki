@extends('layouts.app')

@section('content')

    <h1>id = {{ $entertainer->id }} の詳細ページ</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $entertainer->id }}</td>
        </tr>
        <tr>
            <th>名前</th>
            <td>{{ $entertainer->name }}</td>
        </tr>
        <tr>
            <th>人数</th>
            <td>{{ $entertainer->numberofpeople }}</td>
        </tr>
        <tr>
            <th>別名</th>
            <td>{{ $entertainer->alias }}</td>
        </tr>
        <tr>
            <th>活動時期</th>
            <td>{{ $entertainer->active }}</td>
        </tr>
        <tr>
            <th>活動終了時期</th>
            <td>{{ $entertainer->activeend }}</td>
        </tr>
        <tr>
            <th>師匠</th>
            <td>{{ $entertainer->master }}</td>
        </tr>
        <tr>
            <th>旧名</th>
            <td>{{ $entertainer->oldname }}</td>
        </tr>
        <tr>
            <th>公式URL</th>
            <td>{{ $entertainer->official }}</td>
        </tr>
        <tr>
            <th>Youtubeチャンネル</th>
            <td>{{ $entertainer->youtube }}</td>
        </tr>
        <tr>
            <th>芸歴</th>
            <td>{{$now->diffInYears($entertainer->active)}}年目</td>
        </tr>
    </table>
    
    
            <h2>同期芸人</h2>
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
                </tr>
            </thead>
             
            <tbody>
                @foreach ($sync as $value)
                <tr>
                    <td nowrap>{!! link_to_route('entertainers.show', $value->name, $value->id) !!}</td>
                    <td>{{ $value->active }}</td>
                    <td>{{ $value->activeend }}</td>
                    <td>{{ $value->master }}</td>
                    <td>{{ $value->oldname }}</td>
                    <td><a href="{{ $value->official }}">公式</a></td>
                    <td><a href="{{ $value->youtube }}">Youtube</a></td>
                </tr>
                @endforeach
            </tbody>   
        </table>    
    
    
    
                <h2>1年後輩芸人</h2>
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
                </tr>
            </thead>
             
            <tbody>
                @foreach ($junior as $value)
                <tr>
                    <td nowrap>{!! link_to_route('entertainers.show', $value->name, $value->id) !!}</td>
                    <td>{{ $value->active }}</td>
                    <td>{{ $value->activeend }}</td>
                    <td>{{ $value->master }}</td>
                    <td>{{ $value->oldname }}</td>
                    <td><a href="{{ $value->official }}">公式</a></td>
                    <td><a href="{{ $value->youtube }}">Youtube</a></td>
                </tr>
                @endforeach
            </tbody>   
        </table>    
    
    
    
    
    
    
    
    
                    <h2>1年先輩芸人</h2>
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
                </tr>
            </thead>
             
            <tbody>
                @foreach ($senior as $value)
                <tr>
                    <td nowrap>{!! link_to_route('entertainers.show', $value->name, $value->id) !!}</td>
                    <td>{{ $value->active }}</td>
                    <td>{{ $value->activeend }}</td>
                    <td>{{ $value->master }}</td>
                    <td>{{ $value->oldname }}</td>
                    <td><a href="{{ $value->official }}">公式</a></td>
                    <td><a href="{{ $value->youtube }}">Youtube</a></td>
                </tr>
                @endforeach
            </tbody>   
        </table>
    
    
    

    {{-- 編集ページへのリンク --}}
    {!! link_to_route('entertainers.edit', 'このメッセージを編集', ['entertainer' => $entertainer->id], ['class' => 'btn btn-light']) !!}

    {{-- 削除フォーム --}}
    {!! Form::model($entertainer, ['route' => ['entertainers.destroy', $entertainer->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection