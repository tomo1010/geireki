@extends('layouts.app')

@section('content')

    @can('admin-only') {{-- システム管理者権限のみに表示される --}}

        {{-- 作成ページへのリンク --}}
        <!--@if (Auth::check())-->

        {{-- 編集ページへのリンク --}}
        {!! link_to_route('entertainers.edit', 'この芸人データを編集', ['id' => $entertainer->id], ['class' => 'btn btn-light']) !!}

        {{-- 削除フォーム --}}
        {!! Form::model($entertainer, ['route' => ['entertainers.destroy', $entertainer->id], 'method' => 'delete']) !!}
            {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
        <!--@else-->
        <!--@endif-->
        
    @endcan
    

@if (session('message'))
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
@endif

    <div class="container">
        <div class="row">
            <div class="col-lg-3"><h1 class="mt-3 pb-0">芸歴{{$now->diffInYears($entertainer->active)}}年目：</h1></div>
            <div class="col-lg-9"><h1 class="mt-3 pb-2"><strong>{{ $entertainer->name }}</strong></h1></div>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>芸人</th>
            <td>{{ $entertainer->name }}{{!empty($entertainer->activeend) ? '（解散済）' : '' }}</td>
        </tr>
        <tr>
            <th>別名</th>
            <td>{{ $entertainer->alias }}</td>
        </tr>
        <tr>
            <th>メンバー</th>
            <td>
                @empty($entertainer->perfomers)
                <td></td>
                @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>年齢</th>
                            <th>芸歴</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($entertainer->perfomers as $perfomer)
                        <tr>
                            {{--メンバー名前--}}
                            <td>@include('commons.perfomer_name'){{!empty($perfomer->deth) ? '（故人）' : '' }}</td>
                            
                            {{--メンバー年齢--}}                            
                            @empty($perfomer->birthday)
                            <td>-</td>
                            @else
                            <td>@include('commons.perfomer_age')歳</td>
                            @endempty
                            
                            {{--メンバー芸歴--}}
                            @empty($perfomer->active)
                            <td>-</td>
                            @else
                            <td>@include('commons.perfomer_history')年</td>
                            @endempty
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
            <th nowrap>活動終了時期</th>

            @empty($entertainer->activeend)
            <td></td>
            @else
            <td>{{ $entertainer->activeend->format('Y年')}}　（活動芸歴 {{link_to_route('lists.historyList', $entertainer->active->diffInYears($entertainer->activeend), ['year' => $entertainer->active->diffInYears($entertainer->activeend)])}}年）
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
            <th>名前の由来</th>
            <td>{{ $entertainer->named }}</td>
        </tr> 
        <tr>
            <th>メモ</th>
            <td>{{ $entertainer->memo }}</td>
        </tr>
        <tr>
            <th>受賞歴</th>
            <td>
                <table>
                @empty($award)
                <td></td>
                @else
                    @foreach ($award as $value)
                        <tr>
                            <td nowrap>{{$value->year}}年</td>
                            <td>{{$value->award}}</td>
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
            <td><a href="{{ $entertainer->official }}" target="new"><img src="../icon/web.png" width="64" alt="{{$entertainer->name}}の公式サイト"></a></td>
            @endempty
        </tr>
        <tr>
            <th>Twitter</th>
            @empty($entertainer->twitter)
            <td></td>
            @else
            <td><a href="{{ $entertainer->twitter }}" target="new"><img src="../icon/twitter.png" width="64" alt="{{$entertainer->name}}の公式Twitter"></a></td>
            @endempty
        </tr>
        <tr>
            <th>Youtube</th>
            @empty($entertainer->youtube)
            <td></td>
            @else
            <td><a href="{{ $entertainer->youtube }}" target="new"><img src="../icon/youtube.png" width="64" alt="{{$entertainer->name}}の公式Instagram"></a></td>
            @endempty
        </tr>
        <tr>
            <th>TikTok</th>
            @empty($entertainer->tiktok)
            <td></td>
            @else
            <td><a href="{{ $entertainer->tiktok }}" target="new"><img src="../icon/tiktok.png" width="64px" width="64" alt="{{$entertainer->name}}の公式Tiktok"></a></td>
            @endempty
        </tr>        
        <tr>
            <th>芸歴</th>
            <td>@include('commons.entertainer_history')年目</td>
        </tr>
    </table>
        
    {{-- 修正依頼ページへのリンク --}}
    <p><center>
    <a href="https://forms.gle/PayWcxWhphTi36zRA" class="btn btn-success">修正依頼はこちら</a>
    </p></center>



    {{--tagボタン--}}

    <div class="border-bottom" style="padding:10px;">
        <h2 class="mt-5 pb-2">タグ </h2>    
        @if (Auth::check())
        @else
        タグするには<a href="{{route('login')}}">ログイン</a>が必要です。
        @endif
    </div> <!--下ボーダー -->


        <table class="table">

            @foreach($tags as $tag)

            <tr>

                @if (Auth::check())
                
                    @include('tags.category')
                    
                    @if (Auth::user()->is_tagging($tag->id,$entertainer->id))

                            {{-- お気に入りを外す --}}
                            {!! Form::open(['method'=>'delete', 'route' => 'tagentertainer.destroy']) !!}
                                <input type="hidden" value="{{$entertainer->id}}" name="entertainer_id">
                                <input type="hidden" value="{{$tag->id}}" name="tag_id">	    
                                <button type="submit" class="btn btn-success btn-lg mr-1">
                                #{{$tag->name}}
                                </button>
                    	    {!! Form::close() !!} 
                    	  
                    @else
        
                            {{-- お気に入りにする --}}
                            {!! Form::open(['route' => 'tagentertainer.store']) !!}
                                <input type="hidden" value="{{$entertainer->id}}" name="entertainer_id">
                                <input type="hidden" value="{{$tag->id}}" name="tag_id">
                                <button type="submit" class="btn btn-secondary btn-lg m-1">
                                #{{$tag->name}}
                                </button>
                    	    {!! Form::close() !!} 
                        
                    @endif
                    
                @else
                
                    @include('tags.category')
        
                            {{-- タグ表示のみ --}}
                            <button class="btn btn-secondary btn-lg m-1">
                            #{{$tag->name}}
                            </button>
                                
                @endif
        
            </tr>

            @endforeach
    
        </table>    
    
    
    
    
    
    
    
    
    
    
    {{--Youtube表示＆投稿フォーム--}}
    <h2 class="mt-5 pb-2">おすすめネタ動画</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Youtube</th>
                    <th>コメント</th>
                    <th>投稿者</th>                    
                </tr>
            </thead>
            
            <tbody>
                @foreach ($youtubes as $youtube)
                <tr>
                    <td><a href="{{$youtube->youtube}}" target="_blank""><img src = "{{ $iframe[$loop->index] }}"></a>@include('youtubes.favorite')</td>
                    <td>{{ $youtube->comment }}</td>
                    <td>{{ $youtube->user->name }}</td>                    
                </tr>
                @endforeach
            </tbody>
        </table>
    Youtube動画を紹介するには<a href="{{route('login')}}">ログイン</a>が必要です。
    
    @if (Auth::check())    
        {{-- 投稿フォーム --}}
        {!! Form::open(['route' => 'youtubes.store']) !!}
            <input type="hidden" value="{{$entertainer->id}}" name="entertainer_id">
            <div class="form-group row">
                <label class="col-2 col-form-label">Youtube URL:</label>
                <div class="col-10">
                {!! Form::textarea('youtube', null, ['class' => 'form-control', 'rows' => '2']) !!}
                </div>
                <label class="col-2 col-form-label">コメント:</label>
                <div class="col-10">
                {!! Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '2']) !!}
                </div>
                <div class="offset-2 col-10">
                {!! Form::submit('投稿', ['class' => 'btn btn-primary btn-block']) !!}
                </div>
            </div>
        {!! Form::close() !!} 
    @else
        {{-- ログインページへのリンク 
        ※YoutubeのURLを投稿するには{!! link_to_route('login', 'Login', [], ['class' => 'nav-link']) !!}が必要です。--}} 
    @endif
    

    








</br></br>    
    
    @include('commons.tab_sync')

    <div class="tab-content">
    
        {{--先輩芸人--}}

        <div id="senior" class="tab-pane">
            <h2 class="mt-4 pb-1">1年先輩</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>芸人</th>
                        <th>人数</th>
                    </tr>
                </thead>                
                <tbody>
                    @foreach ($senior as $entertainer)
                    <tr>
                        @if($entertainer->activeend == NULL){{--解散済みの場合はグレー文字--}}
                            <td>@include('commons.entertainer_name')</td>
                        @else
                            <td class="text-secondary">@include('commons.entertainer_name')（解散済）</td>
                        @endif
                            @include('commons.gender')
                    </tr>
                    @endforeach
                </tbody>   
            </table>
        </div>

    
        {{--同期芸人--}}

        <div id="sync"  class="tab-pane active">
            <h2 class="mt-4 pb-1">同期芸人</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>芸人</th>
                        <th>人数</th>
                    </tr>                        
                </thead>
                <tbody>                
                    @foreach ($sync as $entertainer)
                    <tr>
                        @if($entertainer->activeend == NULL){{--解散済みの場合はグレー文字--}}
                            <td>@include('commons.entertainer_name')</td>
                        @else
                            <td class="text-secondary">@include('commons.entertainer_name')（解散済）</td>
                        @endif
                            @include('commons.gender')
                    </tr>
                    @endforeach
                </tbody>   
            </table>
        </div>
    

        {{--後輩芸人--}}

        <div id="junior" class="tab-pane">
            <h2 class="mt-4 pb-1">1年後輩</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>芸人</th>
                        <th>人数</th>
                    </tr>
                </thead>
                <tbody>                                
                    @foreach ($junior as $entertainer)
                    <tr>
                        @if($entertainer->activeend == NULL){{--解散済みの場合はグレー文字--}}
                            <td>@include('commons.entertainer_name')</td>
                        @else
                            <td class="text-secondary">@include('commons.entertainer_name')（解散済）</td>
                        @endif
                            @include('commons.gender')
                    </tr>
                    @endforeach
                </tbody>   
            </table>
        </div>
    </div>    


@endsection