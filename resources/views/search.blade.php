@extends('layouts.app')

@section('content')

<?php
 $s_name = null;
 $s_bloodtype = null;
 $s_birthplace = null;
?>




{!! Form::open(['action' => 'SearchController@search','method' => 'get']) !!}

    <div class="form-group row">
        <label class="col-2 col-form-label">名前:</label>
        <div class="col-10">
        {!! Form::text('s_name', $s_name, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-2 col-form-label">芸歴:</label>
        <div class="col-5">
        {!! Form::selectRange('s_start', 0, 100,old('s_start'),['placeholder' => '●年から','class' => 'form-control']) !!}
        </div>
        <div class="col-5">
        {!! Form::selectRange('s_end', 1, 100,old('s_end'),['placeholder' => '●年まで','class' => 'form-control']) !!} 
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-2 col-form-label">年齢:</label>
        <div class="col-5">
        {!! Form::selectRange('s_ageStart', 18, 100,old('s_ageStart'),['placeholder' => '●歳から','class' => 'form-control']) !!} 
        </div>
        <div class="col-5">
        {!! Form::selectRange('s_ageEnd', 19, 100,old('s_ageEnd'),['placeholder' => '●歳まで','class' => 'form-control']) !!} 
        </div>
    </div>

    <div class="form-group row">
        <label class="col-2 col-form-label">誕生日:</label>
        <div class="col-5">
        {!! Form::selectRange('s_month', 1, 12,old('s_month'),['placeholder' => '●月','class' => 'form-control']) !!}
        </div>
        <div class="col-5">
        {!! Form::selectRange('s_day', 1, 31,old('s_day'),['placeholder' => '●日','class' => 'form-control']) !!} 
        </div>
    </div>

    <div class="form-group row">
        <label class="col-2 col-form-label">血液型:</label>
        <div class="col-2">
        {!! Form::select('s_bloodtype', ['A' => 'A型', 'B' => 'B型', 'O' => 'O型', 'AB' => 'AB型'], 'null', ['placeholder' => '選択','class' => 'form-control']) !!}
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-2 col-form-label">出身地:</label>
        <div class="col-10">
            <select name="s_birthplace">
            <option value="" selected="selected">選択</option>
              @foreach($prefs as $index=>$name)
                <option value="{{$name}}">{{$name}}</option>
              @endforeach
            </select>
        </div>
    </div>
        
    {{--年代:{!! Form::select('s_start', ['20' => '20代', '30' => '30代', '40' => '40代', '50' => '50代', '60' => '60代', '70' => '70代'], 'null', ['placeholder' => '選択']) !!}～
         {!! Form::select('s_end', ['20' => '20代', '30' => '30代', '40' => '40代', '50' => '50代', '60' => '60代', '70' => '70代'], 'null', ['placeholder' => '選択']) !!}    
    --}}
    
    <div class="form-group row">
        <div class="offset-2 col-10">        
        {!! Form::submit('検索',['class' => 'btn btn-primary btn-block']) !!}
        </div>
    </div>
    
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