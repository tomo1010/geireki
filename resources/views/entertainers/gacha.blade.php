@extends('layouts.app')

@section('content')


    <h2 class="mt-5 pb-2" >本日のガチャ芸人</h2>    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>年齢</th>                    
                    <th>芸歴</th>
                    <th>SNS</th>                                
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td nowrap>
                        {!! link_to_route('perfomers.show', $gacha->name, ['id' => $gacha->id]) !!}
    
                        {{--コンビ名リンク、個人と芸人が同じ場合は表示しない--}}
                        @if(!empty($gacha->entertainer[0]->name))
                        @if (strcmp($gacha->entertainer[0]->name, $gacha->name) == 0 )
                        @else
                            </br><font size="small">{!! link_to_route('entertainers.show', $gacha->entertainer[0]->name, $gacha->entertainer[0]->id) !!}</font>
                        @endif
                        @endif
                    </td>
                    
                    {{--年齢リンク--}}
                    <td>
                    {!! link_to_route('lists.age2List', $now->diffInYears($gacha->birthday), ['yearsOld' => $now->diffInYears($gacha->birthday)]) !!}歳
                    </td>
    
                    {{--芸歴リンク--}}
                    @empty($gacha->active)
                        <td>-</td>
                    @else
                        <td nowrap>{!! link_to_route('lists.historyList', $now->diffInYears($gacha->active), ['year' => $now->diffInYears($gacha->active)]) !!}年</td>
                    @endempty
    
                    {{--SNSリンク--}}
                    <td>
                    <a href="https://twitter.com/intent/tweet?hashtags={{$gacha->name}},誕生日,誕生日おめでとう" class="twitter-hashtags-btn" target="_blank">
                      <img src="../icon/twitter.png" width="30" alt="Twitterでお祝いメッセージを">
                    </a>
                    </td>
                </tr>
    
            </tbody>
        </table>




    <h2 class="mt-5 pb-2" >ひな壇芸人ガチャ</h2>    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>年齢</th>                    
                    <th>芸歴</th>
                    <th>SNS</th>                                
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td nowrap>
                        {!! link_to_route('perfomers.show', $hinaGacha->name, ['id' => $hinaGacha->id]) !!}
    
                        {{--コンビ名リンク、個人と芸人が同じ場合は表示しない--}}
                        @if(!empty($hinaGacha->entertainer[0]->name))
                        @if (strcmp($hinaGacha->entertainer[0]->name, $hinaGacha->name) == 0 )
                        @else
                            </br><font size="small">{!! link_to_route('entertainers.show', $hinaGacha->entertainer[0]->name, $hinaGacha->entertainer[0]->id) !!}</font>
                        @endif
                        @endif
                    </td>
                    
                    {{--年齢リンク--}}
                    <td>
                    {!! link_to_route('lists.age2List', $now->diffInYears($hinaGacha->birthday), ['yearsOld' => $now->diffInYears($hinaGacha->birthday)]) !!}歳
                    </td>
    
                    {{--芸歴リンク--}}
                    @empty($hinaGacha->active)
                        <td>-</td>
                    @else
                        <td nowrap>{!! link_to_route('lists.historyList', $now->diffInYears($hinaGacha->active), ['year' => $now->diffInYears($hinaGacha->active)]) !!}年</td>
                    @endempty
    
                    {{--SNSリンク--}}
                    <td>
                    <a href="https://twitter.com/intent/tweet?hashtags={{$hinaGacha->name}},誕生日,誕生日おめでとう" class="twitter-hashtags-btn" target="_blank">
                      <img src="../icon/twitter.png" width="30" alt="Twitterでお祝いメッセージを">
                    </a>
                    </td>
                </tr>
    
            </tbody>
        </table>


@endsection