@extends('layouts.app')

@section('content')

    <h2 class="mt-5 pb-2">おすすめネタ動画</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Youtube</th>
                    <th>芸人</th>                    
                    <th>投稿者</th>
                    <th>いいね件数</th>                                        
                </tr>
            </thead>
            
            <tbody>
                @foreach ($youtubes as $value)
                <tr>
                    <td><a href="{{$value->youtube}}" target="_blank""><img src = "{{ $iframe[$loop->index] }}" alt="芸人さんの公式youtubeチャンネル"></a></td>
                    <td>{!! link_to_route('entertainers.show', $value->entertainer->name, ['id' => $value->entertainer->id]) !!}
                    <!--{{ $value->entertainer->name }}</td>-->
                    <td>{{ $value->user->name }}</td>
                    <td>{{ $value->favoritesUser()->count() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

@endsection