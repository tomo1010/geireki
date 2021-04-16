@extends('layouts.app')

@section('content')

<h1>芸人一覧</h1>

    @if (count($entertainers) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>芸人</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($entertainers as $entertainer)
                <tr>
                    <td>{!! link_to_route('entertainers.show', $entertainer->id, ['entertainer' => $entertainer->id]) !!}</td>
                    <td>{{ $entertainer->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    {{-- 作成ページへのリンク --}}
    {!! link_to_route('entertainers.create', '新規メッセージの投稿', [], ['class' => 'btn btn-primary']) !!}

@endsection