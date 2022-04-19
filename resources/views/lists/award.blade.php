@extends('layouts.app')

@section('content')

</br>
                                M-1グランプリ{!! link_to_route('lists.awardGp', $m1_count ,['gp' => 'M-1グランプリ'] ) !!}組｜
                                キングオブコント{!! link_to_route('lists.awardGp', $king_count ,['gp' => 'キングオブコント'] ) !!}組｜
                                上方漫才大賞{!! link_to_route('lists.awardGp', $kamigata_count ,['gp' => '上方漫才大賞'] ) !!}組

    <div class="container">
        <div class="row">

            {{--年別一覧--}}
            <div class="col-lg-3"><h2 class="mt-5 pb-2 display-5 border-bottom">年別一覧</h2>
                <table class="table table-striped">
                    <tbody>
                        @foreach ($years as $year)
                            <tr>
                                @if($counts[$loop->index] != 0)
                                <td>
                                {{$year}}年
                                </td>
                                <td align="right">
                                {!! link_to_route('lists.awardList', $counts[$loop->index], ['year' => $year]) !!}組
                                </td>
                                
                                @endif
                            </tr>
            
                        @endforeach
                    </tbody>
                </table>    
            </div>    
            {{--受賞年一覧--}}
            <div class="col-lg-9"><h2 class="mt-5 pb-2 display-5 border-bottom">受賞年一覧</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>年</th>
                            <th>大会名</th>
                            <th>コンビ名</th>                                                   
                            <th>当時の芸歴</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($awards as $value)
                        <tr>
                            <td>{{$value->year}}</td>                            
                            <td>{{$value->award}}</td>
                            <td nowrap>{!! link_to_route('entertainers.show', $value->entertainer->name, [$value->entertainer->id]) !!}</td>
                            <td>{{$now->diffInYears($value->entertainer->active)-$now->diffInYears($value->year.'-1-1')}}年目</td>   

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                    {{-- ページネーションのリンク --}}
                    {{ $awards->appends(request()->query())->links() }}
                
            </div>
        </div>
    </div>
    
@endsection        