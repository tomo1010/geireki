@extends('layouts.app')

@section('content')


    <center><h1 class="mt-5 pb-2">{{$year}}代の芸人一覧</h1></center>

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

                            {{--コンビ名リンク--}}
                            @empty($perfomer->entertainer[0]->name)
                            <td>-</td>
                            @else
                                <td>@include('commons.perfomer_combiName')</td>
                            @endempty
                            
                            {{--年齢リンク--}}
                            @empty($perfomer->birthday)
                            <td>-</td>
                            @else
                            <td>@include('commons.perfomer_age')歳</td>
                            @endempty

                            {{--芸歴リンク--}}                            
                            @empty($perfomer->active)
                            <td>-</td>
                            @else
                            <td>@include('commons.perfomer_history')年</td>
                            @endempty
                        </tr>
                        @else
                        <tr class="text-secondary">
                            <td nowrap>{!! link_to_route('perfomers.show', $perfomer->name, [$perfomer->id]) !!}（解散済）</td>
                            
                            {{--コンビ名もリンク--}}
                            <td>
                            @if(!empty($perfomer->entertainer[0]->name))
                                {!! link_to_route('entertainers.show', $perfomer->entertainer[0]->name, $perfomer->entertainer[0]->id) !!}
                            @else
                            @endif    
                            </td>
                            
                            {{--年齢もリンク--}}
                            @empty($perfomer->birthday)
                            <td>-</td>
                            @else
                            <td>{!! link_to_route('lists.age2List', $now->diffInYears($perfomer->birthday), ['yearsOld' => $now->diffInYears($perfomer->birthday)]) !!}歳</td>
                            @endempty

                            {{--芸歴もリンク--}}                            
                            @empty($perfomer->active)
                            <td>-</td>
                            @else
                            <td>{!! link_to_route('lists.historyList', $now->diffInYears($perfomer->active), ['year' => $now->diffInYears($perfomer->active)]) !!}年</td>
                            @endempty
                        </tr>
                        @endif
                        @endforeach
                    </tbody>   
                </table>


        </div>
    </div>



    {{-- ページネーションのリンク --}}

        {{ $perfomers->appends(request()->query())->links() }}        

@endsection