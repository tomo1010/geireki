@extends('layouts.app')

@section('content')

    <h2 class="mt-5 pb-2">背が高い芸人ランキング</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>名前</th>                    
                    <th>コンビ名など</th>                                        
                    <th>身長</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($talls as $value)
                <tr>
                    <td>{!! link_to_route('perfomers.show', $value->name, ['id' => $value->id]) !!}
                    <td>
                    @if(!empty($value->entertainer[0]->name))
                        {!! link_to_route('entertainers.show', $value->entertainer[0]->name, $value->entertainer[0]->id) !!}
                    @else
                    @endif    
                    </td>
                    <td>{{ $value->height }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    
    {{-- ページネーションのリンク --}}
    {{ $talls->appends(request()->query())->links() }}    

@endsection