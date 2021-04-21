@extends('layouts.app')

@section('content')

<h1>芸人一覧</h1>

    @if (count($entertainers) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>芸人</th>
                    <th>人数</th>
                    <th>別名</th>
                    <th>活動時期</th>
                    <th>活動終了時期</th>
                    <th>師匠</th>
                    <th>別名</th>
                    <th>公式</th>
                    <th>Youtubeチャンネル</th>
                    <th>芸歴</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($entertainers as $entertainer)
                <tr>
                    <td>{!! link_to_route('entertainers.show', $entertainer->id, ['entertainer' => $entertainer->id]) !!}</td>
                    <td>{{ $entertainer->name }}</td>
                    <td>{{ $entertainer->numberofpeople }}</td>
                    <td>{{ $entertainer->alias }}</td>
                    <td>{{ $entertainer->active }}</td>
                    <td>{{ $entertainer->activeend }}</td>
                    <td>{{ $entertainer->master }}</td>
                    <td>{{ $entertainer->oldname }}</td>
                    <td>{{ $entertainer->official }}</td>
                    <td>{{ $entertainer->youtube }}</td>
                    <td>{{ $diff[$loop->index] }}</td>

                </tr>
                @endforeach
                



                

            </tbody>
        </table>
        
    @endif
    
    {{-- 作成ページへのリンク --}}
    {!! link_to_route('entertainers.create', '新規メッセージの投稿', [], ['class' => 'btn btn-primary']) !!}

@endsection