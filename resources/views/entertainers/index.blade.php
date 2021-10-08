@extends('layouts.app')

@section('content')


   <div class="container">
        <div class="row">
            <div class="col-lg-8">    
                <h2 class="mt-2 pb-2" >本日誕生日の芸人</h2>    
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>芸人</th>
                                <th>コンビ名など</th>                                
                                <!--<th>誕生日</th>-->
                                <th>年齢</th>                    
                                <th>芸歴</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($birthday as $value)
                            <tr>
                                <td nowrap>{!! link_to_route('perfomers.show', $value->name, ['id' => $value->id]) !!}</td>
                                <td>{{!empty($value->entertainer[0]->name) ? $value->entertainer[0]->name : '' }}</td>                                  
                                <!--<td>{{ $value->birthday->format('Y年 n/j')}}</td>-->
                                <td>{{$now->diffInYears($value->birthday)}}歳</td>

                                @empty($value->active)
                                    <td>-</td>
                                @else
                                <td nowrap>{{$now->diffInYears($value->active)}}年</td>
                                @endempty
 
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
            <div class="col-lg-4">        
                <h2 class="mt-2 pb-2" >明日誕生日</h2>    
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>芸人</th>
                                <th>年齢</th>
                                <th>芸歴</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($birthdayTomorrow as $value)
                            <tr>
                                <td nowrap>{!! link_to_route('perfomers.show', $value->name, ['id' => $value->id]) !!}</td>
                                <td>{{$now->diffInYears($value->birthday)}}歳</td>
                                @empty($value->active)
                                    <td>-</td>
                                @else
                                    <td nowrap>{{$now->diffInYears($value->active)}}年</td>
                                @endempty
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>    
    </div>        


<h2 class="mt-2 pb-2">M1ラストイヤーの芸人</h2>    
            <table class="table table-striped">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>事務所</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($m1year as $value)
                <tr>
                    <td>{!! link_to_route('entertainers.show', $value->name, ['id' => $value->id]) !!}</td>
                    <td>{{$value->office->office}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>




    
<h2 class="mt-2 pb-2">今年解散した芸人</h2>    
            <table class="table table-striped">
            <thead>
                <tr>
                    <th>名前</th>
                    <!--<th>活動終了時期</th>-->
                    <th>芸歴</th>
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
    
        
<h2>キングオブコント2021結果</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>順位</th>                
                <th>芸人</th>
                <th>芸歴</th>                                
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


    {{-- 作成ページへのリンク --}}
    @if (Auth::check())
    {!! link_to_route('entertainers.create', '新規メッセージの投稿', [], ['class' => 'btn btn-primary']) !!}

    {{-- ユーザ登録ページへのリンク --}}
    {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
    @else
    @endif

@endsection