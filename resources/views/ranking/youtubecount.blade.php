@extends('layouts.app')

@section('content')

    <h2 class="mt-5 pb-2">Youtube投稿数ランキング</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>芸人</th>
                    <th align="center">動画投稿数</th>                                        
                </tr>
            </thead>
            
            <tbody>
                @foreach ($youtubes as $value)
                <tr>
                    <td>{!! link_to_route('entertainers.show', $value->name, ['id' => $value->id]) !!}
                    <td align="center">{{ $value->youtubes_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

@endsection