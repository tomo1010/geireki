@extends('layouts.app')

@section('content')


<h1>個人一覧</h1>
    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>コンビ名など</th>
                    <th>@sortablelink('birthday', '年齢')</th>                    
                    <th>芸歴</th>
                    <th>SNS</th>                                
                </tr>
            </thead>
            
            <tbody>
                @foreach ($perfomers as $perfomer)
                    @if($perfomer->activeend == NULL) {{--解散済みの場合はグレー文字--}}
                    <tr>
                        <td nowrap>@include('commons.perfomer_name')</td>
                        @include('perfomers.all_common')
                    </tr>
                    @else
                    <tr class="text-secondary">
                        <td nowrap>@include('commons.perfomer_name')（引退済）</td>
                        @include('perfomers.all_common')
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

    {{-- ページネーションのリンク --}}
    {{ $perfomers->appends(request()->query())->links() }}
    

@endsection