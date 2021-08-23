@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">

            {{--主要レース一覧--}}
            <div class="col-lg-4"><h2 class="mt-2 pb-2 display-5 border-bottom">主要賞レース</h2>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>
                                M1グランプリ
                            </td>
                            <td align="right">
                                {!! link_to_route('lists.awardGp', $m1_count ,['gp' => 'M-1'] ) !!}組
                            </td>    
                        </tr>
                        <tr>
                            <td>
                                キングオブコント
                            </td>
                            <td align="right">
                                {!! link_to_route('lists.awardGp', $king_count ,['gp' => 'キングオブコント'] ) !!}組
                            </td>                            
                        </tr>
                        <tr>
                            <td>
                                上方漫才大賞
                            </td>
                            <td align="right">
                                {!! link_to_route('lists.awardGp', $kamigata_count ,['gp' => '上方漫才大賞'] ) !!}組
                            </td>                            
                        </tr>
                    </tbody>
                </table>    
            </div>    
            {{--受賞年一覧--}}
            <div class="col-lg-8"><h2 class="mt-2 pb-2 display-5 border-bottom">受賞年一覧</h2>
                <table class="table table-striped">
                    <tbody>
                        @foreach ($years as $year)
                            <tr>
                                @if($counts[$loop->index] != 0)
                                <td>
                                {{$year}}年
                                </td>
                                <td align="right">
                                {!! link_to_route('lists.awardList', $counts[$loop->index], ['year' => $year]) !!}組（人）
                                </td>
                                
                                @endif
                            </tr>
            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endsection        