@extends('layouts.app')

@section('content')


    <h2 class="mt-5 pb-2" >本日の芸人ガチャ</h2>    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>年齢</th>                    
                    <th>芸歴</th>
                    <th>SNS</th></th>                    
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    @empty($gacha)
                        <td>-</td>
                    @else
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
                    @endempty
                    
                    {{--年齢リンク--}}
                    @empty($gacha)
                        <td>-</td>
                    @else
                        @empty($gacha->birthday)
                        <td>-</td>
                        @else
                            <td>{!! link_to_route('lists.age2List', $now->diffInYears($gacha->birthday), ['yearsOld' => $now->diffInYears($gacha->birthday)]) !!}歳</td>
                        @endempty
                    @endempty
                    
                    {{--芸歴リンク--}}
                    @empty($gacha)
                        <td>-</td>
                    @else
                        @empty($gacha->active)
                            <td>-</td>
                        @else
                            <td nowrap>{!! link_to_route('lists.historyList', $now->diffInYears($gacha->active), ['year' => $now->diffInYears($gacha->active)]) !!}年</td>
                        @endempty
                    @endempty
                    
                    {{--SNSリンク--}}
                    @empty($gacha)
                        <td>-</td>
                    @else
                        <td>
                        <a href="https://twitter.com/intent/tweet?hashtags={{$gacha->name}},芸人ガチャ,芸歴ネット" class="twitter-hashtags-btn" target="_blank">
                          <img src="../icon/twitter.png" width="30" alt="Twitterでお祝いメッセージを">
                        </a>
                        </td>
                    @endempty    
                </tr>
    
            </tbody>
        </table>

{!! link_to_route('top', 'ガチャ', ['gacha'=>1], ['class' => 'btn btn-outline-primary btn-block']) !!}



{{--<a href="{{ route('hinaGacha') }}">その他のガチャ</a>--}}

{{--{{$gag->gag}}--}}


   <div class="container">
        <div class="row">
            <div class="col-lg-8">    
                <h2 class="mt-5 pb-2" >本日誕生日の芸人</h2>    
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
                            @foreach ($birthday as $value)
                            
                            <tr>
                                <td nowrap>
                                    {!! link_to_route('perfomers.show', $value->name, ['id' => $value->id]) !!}

                                    {{--コンビ名リンク、個人と芸人が同じ場合は表示しない--}}
                                    @if(!empty($value->entertainer[0]->name))
                                        @if (strcmp($value->entertainer[0]->name, $value->name) == 0 )
                                        @else
                                            </br><font size="small">{!! link_to_route('entertainers.show', $value->entertainer[0]->name, $value->entertainer[0]->id) !!}</font>
                                        @endif
                                    @endif
                                </td>
                                
                                {{--年齢リンク--}}
                                <td>
                                {!! link_to_route('lists.age2List', $now->diffInYears($value->birthday), ['yearsOld' => $now->diffInYears($value->birthday)]) !!}歳
                                </td>

                                {{--芸歴リンク--}}
                                @empty($value->active)
                                    <td>-</td>
                                @else
                                    <td nowrap>{!! link_to_route('lists.historyList', $now->diffInYears($value->active), ['year' => $now->diffInYears($value->active)]) !!}年</td>
                                @endempty

                                {{--SNSリンク--}}
                                <td>
                                <a href="https://twitter.com/intent/tweet?hashtags={{$value->name}},誕生日,誕生日おめでとう" class="twitter-hashtags-btn" target="_blank">
                                  <img src="../icon/twitter.png" width="30" alt="Twitterでお祝いメッセージを">
                                </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
            
            
    @can('admin-only') {{-- システム管理者権限のみに表示される --}}

        本日誕生日の芸人さん、おめでとうございます^^
            @foreach ($birthday as $value)
                    #{{$value->name}}
                    @if(!empty($value->entertainer[0]->name))
                    @if (strcmp($value->entertainer[0]->name, $value->name) == 0 )
                    @else
                        #{{$value->entertainer[0]->name}}
                    @endif
                    @endif                    
            @endforeach
        #芸歴 #誕生日 #誕生日おめでとう https://www.geireki.net/
    @endcan
            
            
            
            <div class="col-lg-4">        
                <h2 class="mt-5 pb-2" >明日誕生日</h2>    
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>名前</th>
                                <th>年齢</th>
                                <th><strong>芸歴</strong></th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($birthdayTomorrow as $value)
                            <tr>
                                <td nowrap>{!! link_to_route('perfomers.show', $value->name, ['id' => $value->id]) !!}</td>
                                <td>{!! link_to_route('lists.age2List', $now->diffInYears($value->birthday), ['yearsOld' => $now->diffInYears($value->birthday)]) !!}歳</td>
                                @empty($value->active)
                                    <td>-</td>
                                @else
                                    <td nowrap>{!! link_to_route('lists.historyList', $now->diffInYears($value->active), ['year' => $now->diffInYears($value->active)]) !!}年</td>
                                @endempty
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>    
    </div>        


    <h2 class="mt-5 pb-2">おすすめネタ動画</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Youtube</th>
                    <th>芸人</th>                    
                    <th>投稿者</th>
                    <th>投稿日</th>                    
                </tr>
            </thead>
            
            <tbody>
                @foreach ($youtubes as $value)
                <tr>
                    <td><a href="{{$value->youtube}}" target="_blank""><img src = "{{ $iframe[$loop->index] }}" alt="芸人さんの公式youtubeチャンネル"></a>@include('youtubes.favorite')</td>
                    <td>{!! link_to_route('entertainers.show', $value->entertainer->name, ['id' => $value->entertainer->id]) !!}
                    <!--{{ $value->entertainer->name }}</td>-->
                    <td>{{ $value->user->name }}</td>
                    <td>{{ $value->created_at }}</td>                    
                </tr>
                @endforeach
            </tbody>
        </table>
    Youtube動画を紹介するには<a href="{{route('login')}}">ログイン</a>が必要です。




<h2 class="mt-5 pb-2">M1ラストイヤーの芸人<strong>（芸歴15年目）</strong></h2>    
            <table class="table table-striped">
            <thead>
                <tr>
                    <th>芸人</th>
                    <th>事務所</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($m1year as $value)
                <tr>
                    <td>{!! link_to_route('entertainers.show', $value->name, ['id' => $value->id]) !!}</td>

                    {{--事務所リンク--}}                                
                    @empty($value->office->office)
                    <td>-</td>
                    @else
                    <td>{!! link_to_route('lists.officeList', $value->office->office, [$value->office->id]) !!}</td>
                    @endempty
                </tr>
                @endforeach
            </tbody>
        </table>




    
<h2 class="mt-5 pb-2">今年解散した芸人</h2>    
            <table class="table table-striped">
            <thead>
                <tr>
                    <th>芸人</th>
                    <!--<th>活動終了時期</th>-->
                    <th><strong>芸歴</strong></th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($dissolutions as $dissolution)
                <tr>
                    <td nowrap>{!! link_to_route('entertainers.show', $dissolution->name, ['id' => $dissolution->id]) !!}</td>
                    <!--<td>{{ $dissolution->activeend->format('Y年m月d日') }}</td>-->
                    <td>{{$now->diffInYears($dissolution->active)}}年</td>
                </tr>
                @endforeach
            </tbody>
        </table>



<h2 class="mt-5 pb-2">M1グランプリ2021 結果</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>順位
                <th>芸人</th>
                <th><strong>芸歴</strong></th>                                
                <th>同期</th>
            </tr>
        </thead>
        
        <tbody>
            <tr>
                <td>優勝</td>
                <td nowrap><a href="https://www.geireki.net/entertainers/830">錦鯉</a> おめでとう！</td>
                <td>9年</td>                                  
                <td><a href="https://www.geireki.net/entertainers/830#sync">同期芸人</a></td>
            </tr>            
            <tr>
                <td>2</td>                                                  
                <td nowrap><a href="https://www.geireki.net/entertainers/187">オズワルド</a></td>
                <td>7年</td>                                  
                <td><a href="https://www.geireki.net/entertainers/187#sync">同期芸人</a></td>
            </tr>
            <tr>
                <td>3</td>
                <td nowrap><a href="https://www.geireki.net/entertainers/109">インディアンス</a></td>
                <td>12年</td>                                  
                <td><a href="https://www.geireki.net/entertainers/109#sync">同期芸人</a></td>
            </tr>            
            <tr>
                <td>4</td>
                <td nowrap><a href="https://www.geireki.net/entertainers/1312">ロングコートダディ</a></td>
                <td>14年</td>                                  
                <td><a href="https://www.geireki.net/entertainers/1312#sync">同期芸人</a></td>
            </tr>                                

            <tr>
                <td>5</td>
                <td nowrap><a href="https://www.geireki.net/entertainers/1188">もも</a></td>
                <td>4年</td>                                  
                <td><a href="https://www.geireki.net/entertainers/1188#sync">同期芸人</a></td>
            </tr>

            <tr>
                <td>6</td>                                              
                <td nowrap><a href="https://www.geireki.net/entertainers/1628">ゆにばーす</a></td>
                <td>8年</td>                                  
                <td><a href="https://www.geireki.net/entertainers/1628#sync">同期芸人</a></td>
            </tr>
            <tr>
                <td>6</td>
                <td nowrap><a href="https://www.geireki.net/entertainers/537">真空ジェシカ</a></td>
                <td>10年</td>                                  
                <td><a href="https://www.geireki.net/entertainers/537#sync">同期芸人</a></td>
            </tr>            


            <tr>
                <td>8</td>                                                  
                <td nowrap><a href="https://www.geireki.net/entertainers/1178">モグライダー</a></td>
                <td>12年</td>                                  
                <td><a href="https://www.geireki.net/entertainers/1178#sync">同期芸人</a></td>
            </tr>    

            <tr>
                <td>9</td>                                                  
                <td nowrap><a href="https://www.geireki.net/entertainers/917">ハライチ</a></td>
                <td>15年</td>                                  
                <td><a href="https://www.geireki.net/entertainers/917#sync">同期芸人</a></td>
            </tr>            

            <tr>
                <td>10</td>                                              
                <td nowrap><a href="https://www.geireki.net/entertainers/1257">ランジャタイ</a></td>
                <td>14年</td>                                  
                <td><a href="https://www.geireki.net/entertainers/1257#sync">同期芸人</a></td>
            </tr>            


        </tbody>
    </table>

    
        
<h2 class="mt-5 pb-2">キングオブコント2021結果</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>順位</th>                
                <th>芸人</th>
                <th><strong>芸歴</strong></th>                                
                <th>同期</th>
            </tr>
        </thead>
        
        <tbody>
            <tr>
                <td>1</td>                                                  
                <td nowrap>空気階段</td>
                <td>9年</td>                                  
                <td><a href="https://www.geireki.net/entertainers/318#sync">同期芸人</a></td>
            </tr>            
            <tr>
                <td>2</td>                                                  
                <td nowrap>ザ・マミィ</td>
                <td>3年</td>                                  
                <td><a href="https://www.geireki.net/entertainers/433#sync">同期芸人</a></td>
            </tr>
            <tr>
                <td>2</td>                                                  
                <td nowrap>男性ブランコ</td>
                <td>10年</td>                                  
                <td><a href="https://www.geireki.net/entertainers/674#sync">同期芸人</a></td>
            </tr>            
            <tr>
                <td>4</td>                                                  
                <td nowrap>ニッポンの社長</td>
                <td>8年</td>                                  
                <td><a href="https://www.geireki.net/entertainers/839#sync">同期芸人</a></td>
            </tr>            

            <tr>
                <td>5</td>                                                  
                <td nowrap>ジェラードン</td>
                <td>13年</td>                                  
                <td><a href="https://www.geireki.net/entertainers/1759#sync">同期芸人</a></td>
            </tr>    

            <tr>
                <td>6</td>                                                  
                <td nowrap>蛙亭</td>
                <td>10年</td>                                  
                <td><a href="https://www.geireki.net/entertainers/1555#sync">同期芸人</a></td>
            </tr>
            <tr>
                <td>7</td>                                                  
                <td nowrap>うるとらブギーズ</td>
                <td>12年</td>                                  
                <td><a href="https://www.geireki.net/entertainers/135#sync">同期芸人</a></td>
            </tr>
            <tr>
                <td>8</td>                                                  
                <td nowrap>そいつどいつ</td>
                <td>6年</td>                                  
                <td><a href="https://www.geireki.net/entertainers/600#sync">同期芸人</a></td>
            </tr>            
            <tr>
                <td>9</td>                                                  
                <td nowrap>マヂカルラブリー</td>
                <td>14年</td>                                  
                <td><a href="https://www.geireki.net/entertainers/1118#sync">同期芸人</a></td>
            </tr>                                

            <tr>
                <td>10</td>                                  
                <td nowrap>ニューヨーク</td>
                <td>11年</td>                                  
                <td><a href="https://www.geireki.net/entertainers/842#sync">同期芸人</a></td>
            </tr>                        

        </tbody>
    </table>


@endsection