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

            <tbody>
                @foreach ($count as $key => $value)
                @continue($value < 5)
                <tr>
                    <td>{!! link_to_route('entertainers.show', $awards[$key]->name, ['id' => $awards[$key]->id]) !!}
                    <td>{{ $value }}</td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
    
    {{-- ページネーションのリンク
    {{ $awards->appends(request()->query())->links() }}    
--}} 
@endsection