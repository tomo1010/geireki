@extends('layouts.app')

@section('content')

    <h2>タグの一覧</h2>

    @if (count($tags) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>カテゴリー</th>
                    <th>タグ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->category }}</td>                    
                    <td>{!! link_to_route('tags.show', $tag->name, ['tag' => $tag->id]) !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    {{-- メッセージ作成ページへのリンク --}}
    {!! link_to_route('tags.create', '新規タグの投稿', [], ['class' => 'btn btn-primary']) !!}
    
@endsection