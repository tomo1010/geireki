@extends('layouts.app')

@section('content')

    <h2 class="mt-2 pb-2">芸人一覧</h1>
    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>@sortablelink('name', '芸人')</th>
                    <th>事務所</th>
                    <th>SNS</th>                
                    <th>芸歴</th>                    
                </tr>
            </thead>
            
            <tbody>
                @foreach ($entertainers as $entertainer)
                    @if($entertainer->activeend == NULL) {{--解散済みの場合はグレー文字--}}
                    <tr>
                        <td nowrap>@include('commons.entertainer_name')</td>
                        @include('entertainers.all_common')
                    </tr>
                    @else
    
                    <tr class="text-secondary">
                        <td nowrap>@include('commons.entertainer_name')（解散済）</td>
                        @include('entertainers.all_common')
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

    {{-- ページネーションのリンク --}}
    {{ $entertainers->appends(request()->query())->links() }}

@endsection