@extends('layouts.app')

@section('content')

    <h2 class="mt-5 pb-2">Youtubeお気に入りランキング</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>芸人</th>
                    <th>ネタ動画</th>                    
                    <th>投稿者</th>
                    <th>いいね件数</th>                                        
                </tr>
            </thead>
            
            <tbody>
                @foreach ($youtubes as $value)
                <tr>
                    <td>{!! link_to_route('entertainers.show', $value->entertainer->name, ['id' => $value->entertainer->id]) !!}
                    <td>{{ $value->comment }}</td>
                    <td>{{ $value->user->name }}</td>
                    <td>{{ $value->user_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

@endsection