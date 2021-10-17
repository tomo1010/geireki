@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-3"><h1 class="mt-2 pb-2">芸歴{{$now->diffInYears($entertainer->active)}}年目：</h1></div>
            <div class="col-lg-9"><h1 class="mt-2 pb-2">{{ $entertainer->name }} </h1></div>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>名前</th>
            <td>{{ $entertainer->name }}</td>
        </tr>
        <tr>
            <th>別名</th>
            <td>{{ $entertainer->alias }}</td>
        </tr>
        <tr>
            <th>
                メンバー
            </th>
            <td>
                @empty($entertainer->perfomers)
                <td></td>
                @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>年齢</th>
                            <!--<th>出身</th>-->
                            <!--<th>芸歴</th>-->
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($entertainer->perfomers as $value)
                        <tr>
                            <td>{!! link_to_route('perfomers.show', $value->name, ['id' => $value->id]) !!}</td>
                            <td>{{!empty($value->birthday) ? $now->diffInYears($value->birthday) : '-' }}歳</td>
                            <!--<td>{{$now->diffInYears($value->birthday)}}歳</td>-->
                            <!--<td>{{ $value->school }}</td>-->
                            <!--<td>{{$now->diffInYears($value->active)}}年</td>-->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endempty
            </td>
        </tr>
        <tr>
            <th>活動時期</th>
            
            @empty($entertainer->active)
            <td></td>
            @else
            <td>{{ $entertainer->active->format('Y年～')}}</td>
            @endempty
            
        </tr>
        <tr>
            <th>活動終了時期</th>

            @empty($entertainer->activeend)
            <td></td>
            @else
            <td>{{ $entertainer->activeend->format('Y年')}}　
                （活動{{$now->diffInYears($entertainer->active)-$now->diffInYears($entertainer->activeend)}}年）</td>   
            </td>
            @endempty
            
        </tr>
        <tr>
            <th>師匠</th>
            <td>{{ $entertainer->master }}</td>
        </tr>
        <tr>
            <th>旧名</th>
            <td>{{ $entertainer->oldname }}</td>
        </tr>
        <tr>
            <th>ネタ製作者</th>
            <td>{{ $entertainer->brain }}</td>
        </tr>
        <tr>
            <th>出会い</th>
            <td>{{ $entertainer->encounter }}</td>
        </tr>        
        
        
        <tr>
            <th>
                受賞歴
            </th>
            <td>
                <table>
                @empty($award)
                <td></td>
                @else
                    @foreach ($award as $value)
                        <tr>
                            <td>
                                {{$value->award}}
                            </td>
                        </tr>
                    @endforeach
                @endempty
                </table>
            </td>
        </tr>
        
        
        <tr>
            <th>事務所</th>
            <td>{!! link_to_route('lists.officeList', $office->office, [$entertainer->office_id]) !!}</td>
        </tr>
            <th>公式URL</th>
            @empty($entertainer->official)
            <td></td>
            @else
            <td><a href="{{ $entertainer->official }}" target="new"><img src="../icon/web.png"></a></td>
            @endempty
        </tr>
        <tr>
            <th>Youtubeチャンネル</th>
            @empty($entertainer->youtube)
            <td></td>
            @else
            <td><a href="{{ $entertainer->youtube }}" target="new"><img src="../icon/youtube.png"></a></td>
            @endempty
        </tr>
        <tr>
            <th>芸歴</th>
            <td>{{$now->diffInYears($entertainer->active)}}年目</td>
        </tr>
        </table>
        
    {{-- 修正依頼ページへのリンク --}}
    <p><center>
    <a href="https://forms.gle/PayWcxWhphTi36zRA" class="btn btn-success">修正依頼はこちら</a>
    </p></center>
    
    {{--
    <h2 class="mt-5 pb-2">関連Youtube</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>URL</th>
                    <th>時間</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($youtube as $value)
                <tr>
                    <td>{{ $value->youtube }}</td>
                    <td>{{ $value->time }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    
    @if (Auth::check())    
        {{-- 投稿フォーム --
        {!! Form::open(['route' => 'youtubes.store']) !!}
            <input type="hidden" value="{{$entertainer->id}}" name="entertainer_id">
            <div class="form-group row">
                <label class="col-2 col-form-label">Youtube URL:</label>
                <div class="col-10">
                {!! Form::textarea('youtube', null, ['class' => 'form-control', 'rows' => '2']) !!}
                </div>
                <label class="col-2 col-form-label">コメント:</label>
                <div class="col-10">
                {!! Form::textarea('time', null, ['class' => 'form-control', 'rows' => '2']) !!}
                </div>
                <div class="offset-2 col-10">
                {!! Form::submit('投稿', ['class' => 'btn btn-primary btn-block']) !!}
                </div>
            </div>
        {!! Form::close() !!} 
    @else
        {{-- ログインページへのリンク 
        ※YoutubeのURLを投稿するには{!! link_to_route('login', 'Login', [], ['class' => 'nav-link']) !!}が必要です。
    @endif

    --}}
    
    
    <h2 class="mt-5 pb-2 border-bottom">関連芸人</h2>
    <center><a href="#junior">後輩</a>｜<a href="#sync">同期</a>｜<a href="#senior">先輩</a></center>
    
    <div class="container">
        <div class="row">
            
                <div class="col-lg-4" id="junior"><h3 class="mt-2 pb-1">1年後輩</h3>
                    <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>名前</td><td>人数</td>
                        </tr>                        
                        @foreach ($junior as $value)
                        <tr>
                            @if($value->activeend == NULL){{--解散済みの場合はグレー文字--}}
                                <td>{!! link_to_route('entertainers.show', $value->name, $value->id) !!}</td>
                            @else
                                <td class="text-secondary">{!! link_to_route('entertainers.show', $value->name, $value->id) !!}（解散済）</td>
                            @endif
                            
                                @include('commons.gender')
                                
                        </tr>
                        @endforeach
                    </tbody>   
                    </table>                
                </div>


                <div class="col-lg-4" id="sync"><h3 class="mt-2 pb-1">同期</h3>
                    <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>名前</td><td>人数</td>
                        </tr>                        
                        @foreach ($sync as $value)
                        <tr>
                            @if($value->activeend == NULL){{--解散済みの場合はグレー文字--}}
                                <td>{!! link_to_route('entertainers.show', $value->name, $value->id) !!}</td>
                            @else
                                <td class="text-secondary">{!! link_to_route('entertainers.show', $value->name, $value->id) !!}（解散済）</td>
                            @endif
                            
                                @include('commons.gender')
                                
                        </tr>
                        @endforeach
                    </tbody>   
                    </table>
                </div>    

                <div class="col-lg-4" id="senior"><h3 class="mt-2 pb-1">1年先輩</h3>
                    <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>名前</td><td>人数</td>
                        </tr>    
                        @foreach ($senior as $value)
                        <tr>
                            @if($value->activeend == NULL){{--解散済みの場合はグレー文字--}}
                                <td>{!! link_to_route('entertainers.show', $value->name, $value->id) !!}</td>
                            @else
                                <td class="text-secondary">{!! link_to_route('entertainers.show', $value->name, $value->id) !!}（解散済）</td>
                            @endif

                                @include('commons.gender')
                                
                        </tr>
                        @endforeach
                    </tbody>   
                    </table>
                </div>


        </div>
    </div>
    
    <center><a href="#senior">先輩</a>｜<a href="#sync">同期</a>｜<a href="#junior">後輩</a></center>


    {{-- 作成ページへのリンク --}}
    @if (Auth::check())
    {{-- 編集ページへのリンク --}}
    {!! link_to_route('entertainers.edit', 'このメッセージを編集', ['id' => $entertainer->id], ['class' => 'btn btn-light']) !!}

    {{-- 削除フォーム --}}
    {!! Form::model($entertainer, ['route' => ['entertainers.destroy', $entertainer->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
    @else
    @endif

@endsection