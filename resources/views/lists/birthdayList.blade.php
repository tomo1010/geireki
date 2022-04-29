@extends('layouts.app')

@section('content')


    <center><h1 class="mt-5 pb-2">{{$birthday}}日 生まれの芸人一覧</h1></center>

    <div class="container">
        <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>コンビ名など</th>                            
                            <th>年齢</th>
                            <th>芸歴</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perfomers as $perfomer)
                            @if($perfomer->activeend == NULL){{--解散済みの場合はグレー文字--}}
                            <tr>
                                {{--名前リンク--}}
                                <td nowrap>@include('commons.perfomer_name')</td>
                                @include('lists.age_common')
                            </tr>
                            @else
                            <tr class="text-secondary">
                                {{--名前リンク（解散済み）--}}
                                <td nowrap>@include('commons.perfomer_name')（解散済）</td>                            
                                @include('lists.age_common')
                            </tr>
                            @endif
                        @endforeach
                    </tbody>   
                </table>
        </div>
    </div>

@endsection