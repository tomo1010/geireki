@extends('layouts.app')

@section('content')

    <h1>id = {{ $message->id }} の詳細ページ</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $entertainer->id }}</td>
        </tr>
        <tr>
            <th>メッセージ</th>
            <td>{{ $entertainer->content }}</td>
        </tr>
    </table>

    {{-- 編集ページへのリンク --}}
    {!! link_to_route('entertainers.edit', 'このメッセージを編集', ['entertainer' => $entertainer->id], ['class' => 'btn btn-light']) !!}

    {{-- 削除フォーム --}}
    {!! Form::model($entertainer, ['route' => ['entertainers.destroy', $entertainer->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection