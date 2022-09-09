@extends('layouts.app')

@section('content')

    <h2 class="mt-5 pb-2">Youtubeお気に入りランキング</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>動画</th>
                    <th align="center">お気に入り数</th>                                 
                </tr>
            </thead>
            
            <tbody>
                @foreach ($youtubes as $value)
                <tr>
                    <td>
                        <a href="{{$value->youtube}}" target="_blank""><img src = "{{ $iframe[$loop->index] }}"></a>
                        </br>
                        {!! link_to_route('entertainers.show', $value->entertainer->name, ['id' => $value->id]) !!}
                    </td>
                    <td align="center">{{ $value->favorites_user_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

@endsection