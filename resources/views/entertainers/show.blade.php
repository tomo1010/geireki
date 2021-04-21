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

    </table>

    {{-- 編集ページへのリンク --}}
    {!! link_to_route('entertainers.edit', 'このメッセージを編集', ['entertainer' => $entertainer->id], ['class' => 'btn btn-light']) !!}

    {{-- 削除フォーム --}}
    {!! Form::model($entertainer, ['route' => ['entertainers.destroy', $entertainer->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection