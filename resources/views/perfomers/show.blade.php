@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
        <div class="col-lg-3"><h1 class="mt-2 pb-2">芸歴{{$now->diffInYears($perfomer->active)}}年目：</h1></div> 
        <div class="col-lg-9"><h1 class="mt-2 pb-2">{{ $perfomer->name }}</h1></div>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>名前</th>
            <td>{{ $perfomer->name }}</td>
        </tr>
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
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>芸人</th>
                    <th>芸歴</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($perfomer->entertainer as $value)
                <tr>
                    <td nowrap>{!! link_to_route('entertainers.show', $value->name, ['id' => $value->id]) !!}</td>
                    <td nowrap>{{$now->diffInYears($value->active)}}年</td>
                </tr>
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
            <td>{{!empty($perfomer->birthday) ? $perfomer->birthday->format('Y年m月d日') : '-' }}</td>
        </tr>
        <tr>
            <th>没年月日</th>
            <td>{{!empty($perfomer->deth) ? $perfomer->deth->format('Y年m月d日') : '-' }}</td>
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
            <th>活動終了時期</th>
            <td>{{!empty($perfomer->activeend) ? $perfomer->activeend : '-' }}</td>
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
            <th>事務所</th>
            <td>{!! link_to_route('lists.officeList', $office->office, [$perfomer->office_id]) !!}</td>
        </tr>
            <th>公式URL</th>
            @empty($perfomer->official)
            <td></td>
            @else
            <td><a href="{{ $perfomer->official }}" target="new"><img src="../icon/web.png"></a></td>
            @endempty
        </tr>
        <tr>
            <th>Twitter</th>
            @empty($perfomer->twitter)
            <td></td>
            @else
            <td><a href="{{ $perfomer->twitter }}" target="new"><img src="../icon/twitter.png"></a></td>
            @endempty
        </tr>
        <tr>
            <th>Instagram</th>
            @empty($perfomer->instagram)
            <td></td>
            @else
            <td><a href="{{ $perfomer->instagram }}" target="new"><img src="../icon/instagram.png" width="64px"></a></td>
            @endempty
        </tr>        
        <tr>
            <th>Facebook</th>
            @empty($perfomer->facebook)
            <td></td>
            @else
            <td><a href="{{ $perfomer->facebook }}" target="new"><img src="../icon/facebook.png" width="64px"></a></td>
            @endempty
        </tr>
        <tr>
            <th>Blog</th>
            @empty($perfomer->blog)
            <td></td>
            @else
            <td><a href="{{ $perfomer->blog }}" target="new"><img src="../icon/blog.png" width="64px"></a></td>
            @endempty
        </tr>                
            <th>芸歴</th>
            <!--<td>{{$now->diffInYears($perfomer->active)}}年目</td>-->
            @empty($perfomer->active)
            <td>-</td>
            @else
            <td>{{$now->diffInYears($perfomer->active)}}年目</td>
            @endempty
        </tr>
        </table>
    
    {{-- 修正依頼ページへのリンク --}}
    <p><center>
    <a href="https://forms.gle/DhSu4LLoKPhBSDLH8" class="btn btn-warning">修正依頼はこちら</a>
    </p></center>
    
    
    
    
    
    <h2 class="mt-5 pb-2 border-bottom">関連芸人</h2>

    @include('commons.tab_sync')
    
    <div class="tab-content">
        <div id="senior" class="tab-pane">
            <h3 class="mt-2 pb-1">１年先輩</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>名前</th>
                        <th>コンビ名など</th>
                    </tr>
                </thead>                        
                <tbody>                        
                    @foreach ($senior as $value)
                    <tr>
                        @if($value->activeend == NULL){{--解散済みの場合はグレー文字--}}
                            <td>{!! link_to_route('perfomers.show', $value->name, $value->id) !!}</td>
                            <td>{{!empty($value->entertainer[0]->name) ? $value->entertainer[0]->name : '' }}</td>
                        @else
                            <td class="text-secondary">{!! link_to_route('perfomers.show', $value->name, $value->id) !!}（解散済）</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>   
            </table>
        </div>        
        
        <div id="sync"  class="tab-pane active">
            <h3 class="mt-2 pb-1">同期</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>名前</th>
                        <th>コンビ名など</th>
                    </tr>
                </thead>                        
                <tbody>                        
                    @foreach ($sync as $value)
                    <tr>
                        @if($value->activeend == NULL){{--解散済みの場合はグレー文字--}}
                            <td>{!! link_to_route('perfomers.show', $value->name, $value->id) !!}</td>
                            <td>{{!empty($value->entertainer[0]->name) ? $value->entertainer[0]->name : '' }}</td>
                        @else
                            <td class="text-secondary">{!! link_to_route('perfomers.show', $value->name, $value->id) !!}（解散済）</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>   
            </table>
        </div>
        
        <div id="junior" class="tab-pane">
            <h3 class="mt-2 pb-1">1年後輩</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>名前</th>
                        <th>コンビ名など</th>
                    </tr>
                </thead>                        
                <tbody>                        
                    @foreach ($junior as $value)
                    <tr>
                        @if($value->activeend == NULL){{--解散済みの場合はグレー文字--}}
                            <td>{!! link_to_route('perfomers.show', $value->name, $value->id) !!}</td>
                            <td>{{!empty($value->entertainer[0]->name) ? $value->entertainer[0]->name : '' }}</td>
                        @else
                            <td class="text-secondary">{!! link_to_route('perfomers.show', $value->name, $value->id) !!}（解散済）</td>
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