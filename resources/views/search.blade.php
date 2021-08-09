@extends('layouts.app')

@section('content')

<?php
 $s_name = null;
 $s_bloodtype = null;
 $s_birthplace = null;
?>




{!! Form::open(['action' => 'SearchController@search','method' => 'get']) !!}
    名前:{!! Form::text('s_name', $s_name) !!}
    血液型:{!! Form::select('s_bloodtype', ['A' => 'A型', 'B' => 'B型', 'O' => 'O型', 'AB' => 'AB型'], 'null', ['placeholder' => '選択']) !!}
    出身地:
        <select name="s_birthplace">
        <option value="" selected="selected">選択</option>
          @foreach($prefs as $index=>$name)
            <option value="{{$name}}">{{$name}}</option>
            {{--{!! Form::select('s_birthplace', $name,'null', ['placeholder' => '選択']) !!}--}}
          @endforeach
        </select>
        
    {{--年代:{!! Form::select('s_start', ['20' => '20代', '30' => '30代', '40' => '40代', '50' => '50代', '60' => '60代', '70' => '70代'], 'null', ['placeholder' => '選択']) !!}～
         {!! Form::select('s_end', ['20' => '20代', '30' => '30代', '40' => '40代', '50' => '50代', '60' => '60代', '70' => '70代'], 'null', ['placeholder' => '選択']) !!}    
    --}}
    
    年齢:{!! Form::selectRange('s_ageStart', 18, 100,old('s_ageStart'),['placeholder' => '選択']) !!}～
         {!! Form::selectRange('s_ageEnd', 19, 100,old('s_ageEnd'),['placeholder' => '選択']) !!}




    
    {!! Form::submit('検索') !!}
{!! Form::close() !!}





    <h2 class="mt-2 pb-2">芸人一覧</h1>
    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>芸人</th>
                    <th>活動時期</th>
                    <th>活動終了時期</th>
                    <th>旧名</th>
                    <th>公式</th>
                    <th>年齢</th>
                    <th>芸歴</th>
                    <th>コンビ名など</th>               
                    <th>事務所</th>                                   
                </tr>
            </thead>
            
            <tbody>
                @foreach ($perfomers as $value)
                @if($value->activeend == NULL) {{--解散済みの場合はグレー文字--}}
                <tr>
                    <td nowrap>{!! link_to_route('perfomers.show', $value->name, ['id' => $value->id]) !!}</td>
                    @empty($value->active)
                    <td></td>
                    @else
                    <td>{{ $value->active }}</td>
                    @endempty
                    
                    <td></td>
                    <td>{{ $value->oldname }}</td>

                    @empty($value->official)
                    <td></td>
                    @else
                    <td><a href="{{ $value->official }}">公式</a></td>
                    @endempty

                    
                    <td>{{$now->diffInYears($value->birthday)}}歳</td>
                    <td nowrap>{{$now->diffInYears($value->active)}}年</td>
                    
                    <td>{{!empty($value->entertainer[0]->name) ? $value->entertainer[0]->name : '' }}</td>  
                    <td>{{!empty($value->office->office) ? $value->office->office : '' }}</td>                      
                </tr>
                @else

                <tr class="text-secondary">
                    <td nowrap>{!! link_to_route('perfomers.show', $value->name, ['id' => $value->id]) !!}（解散済）</td>
                    
                    @empty($value->active)
                    <td></td>
                    @else                    
                    <td>{{ $value->active }}</td>
                    @endempty                    
                    
                    <td>{{ $value->activeend }}</td>
                    <td>{{ $value->master }}</td>
                    <td>{{ $value->oldname }}</td>

                    @empty($value->official)
                    <td></td>
                    @else
                    <td><a href="{{ $value->official }}">公式</a></td>
                    @endempty

                    @empty($value->youtube)
                    <td></td>
                    @else
                    <td><a href="{{ $value->youtube }}">Youtube</a></td>
                    @endempty
                    
                    <td>{{$now->diffInYears($value->birthday)}}歳</td>                    
                    <td nowrap>{{$now->diffInYears($value->active)}}年</td>
                </tr>
                @endif
                
                @endforeach
            </tbody>
        </table>

    {{-- ページネーションのリンク --}}
    {{ $perfomers->appends(request()->query())->links() }}




@endsection