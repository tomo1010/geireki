@extends('layouts.app')

@section('content')

    <h2 class="mt-5 pb-2">受賞数ランキング</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>名前</th>                    
                    <th>受賞数</th>
                </tr>
            </thead>


{{--
            <tbody>
                @foreach ($count as $value)
                <tr>
                    <td>{!! link_to_route('entertainers.show', $awards[$loop->index]->name, ['id' => $count[$loop->index]]) !!}
                    <td>{{ $value }}</td>
                </tr>
                @endforeach
            </tbody>
--}}            
            
            
            <tbody>
                @foreach ($awards as $value)
                <tr>
                    <td>{!! link_to_route('entertainers.show', $value->name, ['id' => $value->id]) !!}
                    <td>{{ $count[$loop->index] }}</td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
    
    {{-- ページネーションのリンク --}}
    {{ $awards->appends(request()->query())->links() }}    

@endsection