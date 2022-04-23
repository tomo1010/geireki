@extends('layouts.app')

@section('content')


<h1>個人一覧</h1>
    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>コンビ名など</th>
                    <th>@sortablelink('birthday', '年齢')</th>                    
                    <th>芸歴</th>
                    <th>SNS</th>                                
                </tr>
            </thead>
            
            <tbody>
                @foreach ($perfomers as $perfomer)
                @if($perfomer->activeend == NULL) {{--解散済みの場合はグレー文字--}}
                <tr>
                    <td nowrap>
                        @include('commons.perfomer_name')
                    </td>
                    <td>
                        {{--コンビ名など--}}
                        @if(!empty($perfomer->entertainer[0]->name))
                            {!! link_to_route('entertainers.show', $perfomer->entertainer[0]->name, $perfomer->entertainer[0]->id) !!}
                        @else
                        @endif
                
                    </td>
                    <td>
                        @empty($perfomer->birthday)
                        @else
                        @include('commons.perfomer_age')歳
                        @endempty
                    </td>

                    <td>
                        @empty($perfomer->active)
                        @else
                        @include('commons.perfomer_history')年
                        @endempty
                    </td>

                    <td>
                        @empty($perfomer->official)
                        @else
                        <a href="{{ $perfomer->official }}" target="new"><img src="../icon/web.png" width="30" alt="芸人さんの公式サイト"></a>
                        @endempty

                        @empty($perfomer->twitter)
                        @else
                        <a href="{{ $perfomer->twitter }}" target="new"><img src="../icon/twitter.png" width="30" alt="芸人さんの公式Twitter"></a>
                        @endempty
                        
                        @empty($perfomer->instagram)
                        @else
                        <a href="{{ $perfomer->instagram }}" target="new"><img src="../icon/instagram.png" width="30" alt="芸人さんの公式Instagram"></a>
                        @endempty
                        
                        @empty($perfomer->facebook)
                        @else
                        <a href="{{ $perfomer->facebook }}" target="new"><img src="../icon/facebook.png" width="30" alt="芸人さんの公式Facebook"></a>
                        @endempty
                        
                        @empty($perfomer->youtube)
                        @else
                        <a href="{{ $perfomer->youtube }}" target="new"><img src="../icon/youtube.png" width="30" alt="芸人さんの公式Youtube"></a>
                        @endempty                        
                        
                        @empty($perfomer->tiktok)
                        @else
                        <a href="{{ $perfomer->tiktok }}" target="new"><img src="../icon/tiktok.png" width="30" alt="芸人さんの公式Tiktok"></a>
                        @endempty                                                
                        
                        @empty($perfomer->blog)
                        @else
                        <a href="{{ $perfomer->blog }}" target="new"><img src="../icon/blog.png" width="30" alt="芸人さんの公式blog"></a>
                        @endempty
                    </td>
                </tr>
                @else

                <tr class="text-secondary">
                    <td nowrap>@include('commons.perfomer_name')（解散済）</td>
                    <td>{{ $perfomer->active}}</td>
                    <td>{{ $perfomer->activeend }}</td>
                    <td>{{ $perfomer->master }}</td>
                    <td>{{ $perfomer->oldname }}</td>

                    @empty($perfomer->official)
                    <td></td>
                    @else
                    <td><a href="{{ $perfomer->official }}">公式</a></td>
                    @endempty

                    @empty($perfomer->youtube)
                    <td></td>
                    @else
                    <td><a href="{{ $perfomer->youtube }}">Youtube</a></td>
                    @endempty
                    
                    <td nowrap>@include('commons.perfomer_history')年</td>
                </tr>
                @endif
                
                @endforeach
            </tbody>
        </table>

    {{-- ページネーションのリンク --}}
    {{ $perfomers->appends(request()->query())->links() }}
    

@endsection