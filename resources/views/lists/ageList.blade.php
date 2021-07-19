@extends('layouts.app')

@section('content')



<h1 class="mt-2 pb-2"> {{$year}}0代の芸人一覧</h1>

    <div class="container">
        <div class="row">

            <div class="col-lg-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>年齢</th>
                            <th>芸歴</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perfomer as $value)
                        @if($value->activeend == NULL){{--解散済みの場合はグレー文字--}}
                        <tr>
                            <td>{!! link_to_route('perfomers.show', $value->name, [$value->id]) !!}</td>
                            <td>{{$now->diffInYears($value->birthday)}}歳</td>
                            <td>{{$now->diffInYears($value->active)}}年目</td>

                        </tr>
                        @else
                        <tr class="text-secondary">
                            <td>{!! link_to_route('perfomers.show', $value->name, [$value->id]) !!}（解散済）</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>   
                </table>
            </div>
            
            

        </div>
    </div>


    {{-- ページネーションのリンク --}}
    {{ $perfomer->appends(request()->query())->links() }}        

@endsection