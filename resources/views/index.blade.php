@extends('layouts.app')

@section('content')



    <h2 class="mt-5 pb-2" >本日のギャグガチャ</h2>    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>ギャグ</th>                    
                    <th>芸歴</th>
                    <th>SNS</th>                
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    {{--名前リンク--}}
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
                    
                    {{--ギャグ--}}
                    @empty($gacha)
                        <td>-</td>
                    @else
                        <td>{{$gag}}</td>
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
                        <a href="https://twitter.com/intent/tweet?hashtags={{$gacha->name}},{{$gag}},ギャグガチャ,芸歴ネット" class="twitter-hashtags-btn" target="_blank">
                          <img src="../icon/twitter.png" width="30" alt="Twitterでギャグを広めよう！">
                        </a>
                        </td>
                    @endempty    
                </tr>
    
            </tbody>
        </table>

{!! link_to_route('top', 'ガチャ', ['gacha'=>1], ['class' => 'btn btn-outline-primary btn-block']) !!}





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
                            @foreach ($birthday as $perfomer)
                            
                            <tr>
                                {{--名前リンク--}}
                                <td nowrap>
                                    @include('commons.perfomer_name')

                                    {{--コンビ名リンク、個人と芸人が同じ場合は表示しない--}}
                                    @include('commons.perfomer_combiNameSync')                                    
                                </td>
                                
                                {{--年齢リンク--}}
                                <td>
                                    @include('commons.perfomer_age')歳
                                </td>

                                {{--芸歴リンク--}}
                                @empty($perfomer->active)
                                    <td>-</td>
                                @else
                                    <td nowrap>
                                        @include('commons.perfomer_history')年
                                    </td>
                                @endempty

                                {{--SNSリンク--}}
                                <td>
                                <a href="https://twitter.com/intent/tweet?hashtags={{$perfomer->name}},誕生日,誕生日おめでとう" class="twitter-hashtags-btn" target="_blank">
                                  <img src="../icon/twitter.png" width="30" alt="Twitterでお祝いメッセージを">
                                </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
            
            
            
    {{-- 
            システム管理者権限のみに表示される 
                                                    --}}        
    @can('admin-only')

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
                            @foreach ($birthdayTomorrow as $perfomer)
                            <tr>
                                {{--名前リンク--}}
                                <td nowrap>
                                    @include('commons.perfomer_name')
                                </td>
                                {{--年齢リンク--}}
                                <td>
                                    @include('commons.perfomer_age')歳
                                </td>
                                {{--芸歴リンク--}}
                                @empty($perfomer->active)
                                    <td>-</td>
                                @else
                                    <td nowrap>
                                    @include('commons.perfomer_history')年
                                    </td>
                                @endempty
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>    
    </div>        


{{--
    <h2 class="mt-5 pb-2" >新着の芸人</h2>    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>事務所</th>                    
                    <th>芸歴</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($creates as $entertainer)
                <tr>
                    <td nowrap>
                        @include('commons.entertainer_name')
                    </td>
                    
                    <td>
                        @include('commons.entertainer_office')
                    </td>
--}}    
                    {{--芸歴リンク
                    @empty($entertainer->active)
                        <td>-</td>
                    @else
                        <td>@include('commons.entertainer_history')</td>
                    @endempty
                </tr>
                @endforeach
            </tbody>
        </table>
--}}


    <h2 class="mt-5 pb-2">新着ネタ動画</h2>
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
                @foreach ($youtubes as $youtube)
                <tr>
                    <td>
                        <a href="{{$youtube->youtube}}" target="_blank""><img src = "{{ $iframe[$loop->index] }}" alt="おすすめYoutubeネタ動画" hspace="5" vspace="5"></a>
                        </br>
                        <span>
                        <img src="{{asset('../icon/nicebutton.png')}}" width="30px">
                    		<!-- 「いいね」の数を表示 -->
                    		<span class="badge">
                    			{{ $youtube->favoritesUser()->count() }}
                    		</span>
                        </span>
                        @include('youtubes.favorite')
                    </td>
                    <td nowrap>
                        {!! link_to_route('entertainers.show', $youtube->entertainer->name, ['id' => $youtube->entertainer->id]) !!}
                    </td>
                    <td>{{ $youtube->user->name }}</td>
                    <td>{{ $youtube->created_at }}</td>                    
                </tr>
                @endforeach
            </tbody>
        </table>
    「いいね」や「Youtube動画を紹介」するには<a href="{{route('login')}}">ログイン</a>が必要です。




<h2 class="mt-5 pb-2">M1ラストイヤーの芸人<strong>（芸歴15年目）</strong></h2>    
            <table class="table table-striped">
            <thead>
                <tr>
                    <th>芸人</th>
                    <th>事務所</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($m1year as $entertainer)
                <tr>
                    <td>
                    @include('commons.entertainer_name')
                    </td>

                    {{--事務所リンク--}}                                
                    @empty($entertainer->office->office)
                    <td>-</td>
                    @else
                    <td>
                    @include('commons.entertainer_office')
                    </td>
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
                    <th>芸歴</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($dissolutions as $entertainer)
                <tr>
                    <td nowrap>
                    @include('commons.entertainer_name')
                    </td>
                    <td>
                    @include('commons.entertainer_history')年
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>




<h2 class="mt-5 pb-2">実はNSC出身な芸人</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>事務所</th>                    
                    <th>芸歴</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($nsc as $perfomer)
                    <tr>
                        <td nowrap>@include('commons.perfomer_name')

                        {{--コンビ名リンク、個人と芸人が同じ場合は表示しない--}}
                        @include('commons.perfomer_combiNameSync')                                    

                    </td>
                    {{--事務所など--}}                    
                    <td>
                        {!! link_to_route('lists.officeList', $perfomer->office->office, $perfomer->office->id) !!}
                    </td>
                    {{--芸歴--}}
                    <td>
                        @empty($perfomer->active)
                        @else
                        @include('commons.perfomer_history')年
                        @endempty
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
{{--　404エラー        
{!! link_to_route('perfomers.nsc', '一覧', ) !!}
--}}

<h2 class="mt-5 pb-2">M1グランプリ2021 結果</h2>
        <table class="table table-striped">
        <thead>
            <tr>
                <th>順位
                <th>芸人</th>
                <th>事務所</th>                
                <th>芸歴</th>                         
            </tr>
        </thead>
            
            <tbody>
                @foreach ($m1 as $award)
                <tr>
                    <td>{{$award->rank}}</td>
                    <td nowrap>@include('commons.award_entertainerName')</td>
                    <td>@include('commons.award_entertainerOffice')</td>
                    <td>@include('commons.award_entertainerHistory')年</td>
                </tr>
                @endforeach
            </tbody>
        </table>


    
<h2 class="mt-5 pb-2">キングオブコント2021 結果</h2>
        <table class="table table-striped">
        <thead>
            <tr>
                <th>順位
                <th>芸人</th>
                <th>事務所</th>                
                <th>芸歴</th>                         
            </tr>
        </thead>
            
            <tbody>
                @foreach ($koc as $award)
                <tr>
                    <td>{{$award->rank}}</td>
                    <td nowrap>@include('commons.award_entertainerName')</td>
                    <td>@include('commons.award_entertainerOffice')</td>
                    <td>@include('commons.award_entertainerHistory')年</td>
                </tr>
                @endforeach
            </tbody>
        </table>


@endsection