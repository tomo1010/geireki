@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-4"><h1 class="mt-3 pb-0">芸歴{{$now->diffInYears($perfomer->active)}}年目：</h1></div> 
            <div class="col-lg-8"><h1 class="mt-3 pb-2"><strong>{{ $perfomer->name }}</strong></h1></div>
        </div>
    </div>

    <table class="table">
        <tr>
            <th>本名</th>
            <td>{{ $perfomer->realname }}</td>
        </tr>
        <tr>
            <th>コンビ名など</th>
        <td>    
        @empty($perfomer->entertainer)
        <td></td>
        @else
        <table class="table table-bordered">
            {{--
            <thead>
                <tr>
                    <th>芸人</th>
                    <th>芸歴</th>
                </tr>
            </thead>
            --}}
            <tbody>
                @foreach ($perfomer->entertainer as $entertainer)
                    @empty($entertainer->activeend)
                    <tr>
                        <td nowrap>@include('commons.entertainer_name')</td>
                        @empty($entertainer->active)
                        <td>-</td>
                        @else
                        <td>芸歴@include('commons.entertainer_history')年</td>
                        @endempty
                    </tr>
                    @else                
                    <tr>
                        <td nowrap>@include('commons.entertainer_name')（解散済）</td>
                        @empty($entertainer->active)
                        <td>-</td>
                        @else
                        <td>活動芸歴 {{link_to_route('lists.historyList', $entertainer->active->diffInYears($entertainer->activeend), ['year' => $entertainer->active->diffInYears($entertainer->activeend)])}}年</td>
                        @endempty
                    </tr>
                    @endempty
                @endforeach
            </tbody>
            
        </table>
        @endempty
        </td>
        </tr>        
        <tr>
            <th>別名</th>
            <td>{{ $perfomer->alias }}</td>
        </tr>
        <tr>
            <th>誕生日</th>
            <td>{{!empty($perfomer->birthday) ? $perfomer->birthday->format('Y年m月d日') : '-' }}　

            {{--故人はカッコ表示--}}
                @empty($perfomer->deth)
                    @include('commons.perfomer_age')歳</td>
                @else
                    （@include('commons.perfomer_age')歳）</td>
                @endempty
        </tr>
        <tr>
            <th>没年月日</th>
            <td>{{!empty($perfomer->deth) ? $perfomer->deth->format('Y年m月d日') : '-' }}

            {{--享年表示--}}
                @empty($perfomer->deth)
                    </td>
                @else
                    　享年{{link_to_route('lists.age2List', $perfomer->birthday->diffInYears($perfomer->deth), ['yearsOld' => $perfomer->birthday->diffInYears($perfomer->deth)])}}歳</td>
                @endempty
        </tr>
        <tr>
            <th>出身地</th>
            <td>{{ $perfomer->birthplace }}</td>
        </tr>
        <tr>
            <th>血液型</th>
            <td>{{ $perfomer->bloodtype }}</td>
        </tr>        
        <tr>
            <th>身長</th>
            <td>{{ $perfomer->height }}</td>
        </tr>        
        <tr>
            <th>方言</th>
            <td>{{ $perfomer->dialect }}</td>
        </tr>
        <tr>
            <th>学歴</th>
            <td>{{ $perfomer->educational }}</td>
        </tr>        
        <tr>
            <th>師匠</th>
            <td>{{ $perfomer->master }}</td>
        </tr>
        <tr>
            <th>出身</th>
            <td>{{ $perfomer->school }}</td>
        </tr>        
        <tr>
            <th>活動時期</th>
            <td>{{!empty($perfomer->active) ? $perfomer->active->format('Y年～') : '-' }}</td>
        </tr>
        <tr>
            <th nowrap>活動終了時期</th>
            <td>{{!empty($perfomer->activeend) ? $perfomer->activeend->format('Y年') : '-' }}</td>
        </tr>
        <tr>
            <th>配偶者</th>
            <td>{{ $perfomer->spouse }}</td>
        </tr>
        <tr>
            <th>親族</th>
            <td>{{ $perfomer->relatives }}</td>
        </tr>
        <tr>
            <th>弟子</th>
            <td>{{ $perfomer->disciple }}</td>
        </tr> 
        <tr>
            <th>メモ</th>
            <td>{{ $perfomer->memo }}</td>
        </tr>                
        <tr>
            <th>ギャグ</th>
            <td>{{ $perfomer->gag }}</td>
        </tr>                        
        <tr>
            <th>事務所</th>
            <td>{!! link_to_route('lists.officeList', $office->office, [$perfomer->office_id]) !!}</td>
        </tr>
            <th>公式URL</th>
            @empty($perfomer->official)
            <td></td>
            @else
            <td><a href="{{ $perfomer->official }}" target="new"><img src="../icon/web.png" width="64" alt="{{$perfomer->name}}公式サイ"ト></a></td>
            @endempty
        </tr>
        <tr>
            <th>Twitter</th>
            @empty($perfomer->twitter)
            <td></td>
            @else
            <td><a href="{{ $perfomer->twitter }}" target="new"><img src="../icon/twitter.png" width="64" alt="{{$perfomer->name}}公式Twitter"></a></td>
            @endempty
        </tr>
        <tr>
            <th>Instagram</th>
            @empty($perfomer->instagram)
            <td></td>
            @else
            <td><a href="{{ $perfomer->instagram }}" target="new"><img src="../icon/instagram.png" width="64px alt="{{$perfomer->name}}公式Instagram""></a></td>
            @endempty
        </tr>        
        <tr>
            <th>Facebook</th>
            @empty($perfomer->facebook)
            <td></td>
            @else
            <td><a href="{{ $perfomer->facebook }}" target="new"><img src="../icon/facebook.png" width="64px" alt="{{$perfomer->name}}公式Facebook"></a></td>
            @endempty
        </tr>
        <tr>
            <th>Youtbe</th>
            @empty($perfomer->youtube)
            <td></td>
            @else
            <td><a href="{{ $perfomer->youtube }}" target="new"><img src="../icon/youtube.png"  width="64" alt="{{$perfomer->name}}公式Youtube"></a></td>
            @endempty
        </tr>        
        <tr>
            <th>TikTok</th>
            @empty($perfomer->tiktok)
            <td></td>
            @else
            <td><a href="{{ $perfomer->tiktok }}" target="new"><img src="../icon/tiktok.png" width="64px" alt="{{$perfomer->name}}公式TikTok"></a></td>
            @endempty
        </tr>        
        <tr>
            <th>Blog</th>
            @empty($perfomer->blog)
            <td></td>
            @else
            <td><a href="{{ $perfomer->blog }}" target="new"><img src="../icon/blog.png" width="64" alt="{{$perfomer->name}}公式blog"></a></td>
            @endempty
        </tr>                
            <th>芸歴</th>
            @empty($perfomer->active)
            <td></td>
            @else
            <td>@include('commons.perfomer_history')年目</td>
            @endempty
        </tr>
        </table>
    
    {{-- 修正依頼ページへのリンク --}}
    <p><center>
    <a href="https://forms.gle/DhSu4LLoKPhBSDLH8" class="btn btn-warning">修正依頼はこちら</a>
    </p></center>
    
    
    
</br></br>    

    @include('commons.tab_sync')
    
    <div class="tab-content">
        <div id="senior" class="tab-pane">
            <h2 class="mt-4 pb-1">１年先輩（個人）</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>名前</th>
                        <th>コンビ名など</th>
                    </tr>
                </thead>                        
                <tbody>                        
                    @foreach ($senior as $perfomer)
                    <tr>
                        @if($perfomer->activeend == NULL){{--解散済みの場合はグレー文字--}}
                            <td>@include('commons.perfomer_name')</td>

                            {{--コンビ名もリンク--}}
                            <td>
                            @if(!empty($perfomer->entertainer[0]->name))
                                @include('commons.perfomer_combiName')
                            @else
                            @endif    
                            </td>
                        @else
                            <td class="text-secondary">@include('commons.perfomer_combiName')（解散済）</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>   
            </table>
        </div>        
        
        <div id="sync"  class="tab-pane active">
            <h2 class="mt-4 pb-1">同期芸人（個人）</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>名前</th>
                        <th>コンビ名など</th>
                    </tr>
                </thead>                        
                <tbody>                        
                    @foreach ($sync as $perfomer)
                    <tr>
                        @if($perfomer->activeend == NULL){{--解散済みの場合はグレー文字--}}
                            <td>@include('commons.perfomer_name')</td>
                            
                            {{--コンビ名もリンク--}}
                            <td>
                            @if(!empty($perfomer->entertainer[0]->name))
                                @include('commons.perfomer_combiName')
                            @else
                            @endif    
                            </td>
                        @else
                            <td class="text-secondary">@include('commons.perfomer_name')（解散済）</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>   
            </table>
        </div>
        
        <div id="junior" class="tab-pane">
            <h2 class="mt-4 pb-1">１年後輩（個人）</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>名前</th>
                        <th>コンビ名など</th>
                    </tr>
                </thead>                        
                <tbody>                        
                    @foreach ($junior as $perfomer)
                    <tr>
                        @if($perfomer->activeend == NULL){{--解散済みの場合はグレー文字--}}
                            <td>@include('commons.perfomer_name')</td>
                            {{--コンビ名もリンク--}}
                            <td>
                            @if(!empty($perfomer->entertainer[0]->name))
                                @include('commons.perfomer_combiName')
                            @else
                            @endif    
                            </td>
                        @else
                            <td class="text-secondary">@include('commons.perfomer_name')（解散済）</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>   
            </table>   
        </div>
    </div>    


    
    
    
    {{-- 作成ページへのリンク --}}
    @if (Auth::check())
    {{-- 編集ページへのリンク --}}
    {!! link_to_route('perfomers.edit', 'この個人を編集', ['id' => $perfomer->id], ['class' => 'btn btn-light']) !!}

    {{-- 削除フォーム --}}
    {!! Form::model($perfomer, ['route' => ['perfomers.destroy', $perfomer->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
    @else
    @endif

@endsection