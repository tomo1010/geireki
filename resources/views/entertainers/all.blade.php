@extends('layouts.app')

@section('content')

    <h2 class="mt-2 pb-2">芸人一覧</h1>
    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>@sortablelink('name', '芸人')</th>
                    <th>事務所</th>
                    <th>SNS</th>                
                    <th>芸歴</th>                    
                </tr>
            </thead>
            
            <tbody>
                @foreach ($entertainers as $entertainer)
                @if($entertainer->activeend == NULL) {{--解散済みの場合はグレー文字--}}
                <tr>
                    <td nowrap>@include('commons.entertainer_name')</td>
                    <td>@include('commons.entertainer_office')</td>

                    <td>
                        @empty($entertainer->official)
                        @else
                            <a href="{{ $entertainer->official }}" target="new"><img src="../icon/web.png" width="30" alt="芸人さんの公式サイト"></a>
                        @endempty 
                        
                        @empty($entertainer->twitter)
                        @else
                            <a href="{{ $entertainer->twitter }}" target="new"><img src="../icon/twitter.png" width="30" alt="芸人さんの公式Twitter"></a>
                        @endempty                         
                        
                        @empty($entertainer->youtube)
                        @else
                            <a href="{{ $entertainer->youtube }}" target="new"><img src="../icon/youtube.png" width="30" alt="芸人さんの公式Youtube"></a>
                        @endempty 
                        
                        @empty($entertainer->tiktok)
                        @else
                            <a href="{{ $entertainer->tiktok }}" target="new"><img src="../icon/tiktok.png" width="30" alt="芸人さんの公式Tiktok"></a>                        
                        @endempty  
                    </td>
                    
                    <td nowrap>@include('commons.entertainer_history')年</td>
                </tr>
                @else

                <tr class="text-secondary">
                    <td nowrap>@include('commons.entertainer_name')（解散済）</td>
                    <td>@include('commons.entertainer_office')</td>

                    <td>
                        @empty($entertainer->official)
                        @else
                            <a href="{{ $entertainer->official }}" target="new"><img src="../icon/web.png" width="30" alt="芸人さんの公式サイト"></a>
                        @endempty 
                        
                        @empty($entertainer->twitter)
                        @else
                            <a href="{{ $entertainer->twitter }}" target="new"><img src="../icon/twitter.png" width="30" alt="芸人さんの公式Twitter"></a>
                        @endempty                         
                        
                        @empty($entertainer->youtube)
                        @else
                            <a href="{{ $entertainer->youtube }}" target="new"><img src="../icon/youtube.png" width="30" alt="芸人さんの公式Youtube"></a>
                        @endempty 
                        
                        @empty($entertainer->tiktok)
                        @else
                            <a href="{{ $entertainer->tiktok }}" target="new"><img src="../icon/tiktok.png" width="30" alt="芸人さんの公式Tiktok"></a>                        
                        @endempty  
                    </td>
                    
                    <td nowrap>@include('commons.entertainer_history')年</td>
                </tr>
                @endif
                
                @endforeach
            </tbody>
        </table>

    {{-- ページネーションのリンク --}}
    {{ $entertainers->appends(request()->query())->links() }}

@endsection