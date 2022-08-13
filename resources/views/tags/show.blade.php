@extends('layouts.app')

@section('content')


    <h2>id = {{ $tag->id }} のタグ詳細ページ</h2>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $tag->id }}</td>
        </tr>
        <tr>
            <th>カテゴリー</th>
            <td>{{ $tag->category }}</td>
        </tr>
        <tr>
            <th>タグ</th>
            <td>{{ $tag->name }}</td>
        </tr>
    </table>

    {{-- タグ編集ページへのリンク --}}
    {!! link_to_route('tags.edit', 'このタグを編集', ['tag' => $tag->id], ['class' => 'btn btn-light']) !!}
    
    {{-- タグ削除フォーム --}}
    {!! Form::model($tag, ['route' => ['tags.destroy', $tag->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

    
@endsection