@extends('layouts.app')

@section('content')

<?php
 $s_name = null;
 $s_bloodtype = null;
 $s_birthplace = null;
?>


{{--名前
{!! Form::open(['action' => 'SearchController@search','method' => 'get']) !!}

    <div class="form-group row">
        <label class="col-3 col-form-label">名前:</label>
        <div class="col-9">

        {!! Form::text('s_name', $request->input('s_name') ?? '', ['class' => 'form-control']) !!}        
        </div>
    </div>
--}}

{{--芸歴--}}
    <div class="form-group row">
        <label class="col-3 col-form-label">芸歴:</label>
        <div class="col-4">
        {!! Form::selectRange('s_start', 0, 100, old('s_start'),['placeholder' => '年から','class' => 'form-control']) !!}
        </div>
        <div class="col-4">
        {!! Form::selectRange('s_end', 1, 100, old('s_end'),['placeholder' => '年まで','class' => 'form-control']) !!} 
        </div>
    </div>


{{--年齢--}}    
    <div class="form-group row">
        <label class="col-3 col-form-label">年齢:</label>
        <div class="col-4">
        {!! Form::selectRange('s_ageStart', 18, 100, old('s_ageStart'),['placeholder' => '歳から','class' => 'form-control']) !!} 
        </div>
        <div class="col-4">
        {!! Form::selectRange('s_ageEnd', 19, 100, old('s_ageEnd'),['placeholder' => '歳まで','class' => 'form-control']) !!} 
        </div>
    </div>


{{--年代--}}    
    <div class="form-group row">
        <label class="col-3 col-form-label">年代:</label>
        <div class="col-8">
        {!! Form::select('s_age', [
            '10b' => '10代', 
            '20a' => '20代前半', 
            '20b' => '20代後半', 
            '30a' => '30代前半',
            '30b' => '30代後半',
            '40a' => '40代前半',
            '40b' => '40代後半',
            '50a' => '50代前半',
            '50b' => '50代後半',
            '60a' => '60代前半',
            '60b' => '60代後半',
            '70a' => '70代前半',
            '70b' => '70代後半',
            '80a' => '80代前半',
            '80b' => '80代後半',
            '90a' => '90代前半',
            '90b' => '90代後半',
            ], 'null', ['placeholder' => '選択','class' => 'form-control']) !!}            
        </div>
    </div>


{{--誕生日--}}
    <div class="form-group row">
        <label class="col-3 col-form-label">誕生日:</label>
        <div class="col-4">
        {!! Form::selectRange('s_month', 1, 12, old('s_month'),['placeholder' => '月','class' => 'form-control']) !!}
        </div>
        <div class="col-4">
        {!! Form::selectRange('s_day', 1, 31, old('s_day'),['placeholder' => '日','class' => 'form-control']) !!} 
        </div>
    </div>


{{--血液型--}}
    <div class="form-group row">
        <label class="col-3 col-form-label">血液型:</label>
        <div class="col-8">
        {!! Form::select('s_bloodtype', ['A' => 'A型', 'B' => 'B型', 'O' => 'O型', 'AB' => 'AB型'], 'null', ['placeholder' => '選択','class' => 'form-control']) !!}
        </div>
    </div>


{{--出身地--}}    
    <div class="form-group row">
        <label class="col-3 col-form-label">出身地:</label>
        <div class="col-8">
            <select name="s_birthplace" class="form-control">
            <option value="" selected="selected">選択</option>
              @foreach($prefs as $index=>$name)
                <option value="{{$name}}">{{$name}}</option>
              @endforeach
            </select>
        </div>
    </div>


{{--地方--}}
    <div class="form-group row">
        <label class="col-3 col-form-label">出身地方:</label>
        <div class="col-8">
            <select name="local" class="form-control">
            <option value="" selected="selected">選択（※は単一の都道府県で検索）</option>

                <option value="1">北海道※</option>
                <option value="2">東北</option>
                <option value="3">北関東</option>
                <option value="4">南関東</option>
                <option value="5">東京※</option>
                <option value="6">北陸信越</option>
                <option value="7">東海</option>
                <option value="8">近畿</option>
                <option value="9">大阪※</option>
                <option value="10">中国</option>
                <option value="11">四国</option>
                <option value="12">九州</option>
                <option value="13">沖縄※</option>

            </select>
        </div>
    </div>


{{--人数--}}
    <div class="form-group row">
        <label class="col-3 col-form-label">人数:</label>
        <div class="col-9 form-inline">

            <div class="form-check col-md-0 d-flex align-items-center pr-2">
                {{Form::checkbox('numberofpeople[]','1',false,['class'=>'col-md-0 form-check-input','id'=>'1'])}}
                {{Form::label('1','ピン　',['class' => 'col-md-0 form-check-label text-left'])}}
            </div>
            <div class="form-check col-md-0 d-flex align-items-center pr-2">
                {{Form::checkbox('numberofpeople[]','2',false,['class'=>'col-md-0 form-check-input','id'=>'2'])}}
                {{Form::label('2','コンビ　',['class' => 'col-md-0 form-check-label text-left'])}}
            </div>
            <div class="form-check col-md-0 d-flex align-items-center pr-2">
                {{Form::checkbox('numberofpeople[]','3',false,['class'=>'col-md-0 form-check-input','id'=>'3'])}}
                {{Form::label('3','トリオ',['class' => 'col-md-0 form-check-label text-left'])}}
            </div>

        </div>
    </div>


{{--内訳--}}
    <div class="form-group row">
        <label class="col-3 col-form-label">内訳:</label>
        <div class="col-9 form-inline">

            <div class="form-check col-md-0 d-flex align-items-center pr-2">
                {{Form::checkbox('gender[]','1',false,['class'=>'col-md-0 form-check-input','id'=>'1'])}}
                {{Form::label('1','男',['class' => 'col-md-0 form-check-label text-left'])}}
            </div>
            <div class="form-check col-md-0 d-flex align-items-center pr-2">
                {{Form::checkbox('gender[]','2',false,['class'=>'col-md-0 form-check-input','id'=>'2'])}}
                {{Form::label('2','女　',['class' => 'col-md-0 form-check-label text-left'])}}
            </div>            
            <div class="form-check col-md-0 d-flex align-items-center pr-2">
                {{Form::checkbox('gender[]','11',false,['class'=>'col-md-0 form-check-input','id'=>'11'])}}
                {{Form::label('11','男男',['class' => 'col-md-0 form-check-label text-left'])}}
            </div>
            <div class="form-check col-md-0 d-flex align-items-center pr-2">
                {{Form::checkbox('gender[]','22',false,['class'=>'col-md-0 form-check-input','id'=>'22'])}}
                {{Form::label('22','女女',['class' => 'col-md-0 form-check-label text-left'])}}
            </div>
            <div class="form-check col-md-0 d-flex align-items-center pr-2">
                {{Form::checkbox('gender[]','12',false,['class'=>'col-md-0 form-check-input','id'=>'12'])}}
                {{Form::label('12','男女　',['class' => 'col-md-0 form-check-label text-left'])}}
            </div>
            <div class="form-check col-md-0 d-flex align-items-center pr-2">
                {{Form::checkbox('gender[]','111',false,['class'=>'col-md-0 form-check-input','id'=>'111'])}}
                {{Form::label('111','男男男',['class' => 'col-md-0 form-check-label text-left'])}}
            </div>            
            <div class="form-check col-md-0 d-flex align-items-center pr-2">
                {{Form::checkbox('gender[]','222',false,['class'=>'col-md-0 form-check-input','id'=>'222'])}}
                {{Form::label('222','女女女',['class' => 'col-md-0 form-check-label text-left'])}}
            </div>


        </div>
    </div>

    
    
{{--事務所--}}    
    <div class="form-group row">
        <label class="col-3 col-form-label">事務所:</label>
        
        <div class="col-6">
        <select class="form-control" name="office_id">
            <option value="" selected="selected">選択</option>
            @foreach ($offices as $office)
                <option value="{{ $office->id }}">{{ $office->office }}</option>
            @endforeach
        </select>
        </div>
        
        <div class="col-2">
        {!! Form::select('judge', ['in' => 'のみ', 'notin' => '以外',], 'null', ['placeholder' => '選択','class' => 'form-control']) !!}
        </div>
    </div>
      


{{--NSC出身?--}}    
    <div class="form-group row">
        <label class="col-3 col-form-label">お笑い養成所:</label>
        <div class="col-9">

            <div class="form-check col-md-0 d-flex align-items-center pr-2">
                {{Form::checkbox('nsc[]','NSC',false,['class'=>'col-md-0 form-check-input','id'=>'nsc'])}}
                {{Form::label('nsc','NSC出身',['class' => 'col-md-0 form-check-label text-left'])}}
            </div>

            {{--
            <div class="form-check col-md-0 d-flex align-items-center pr-2">
                {{Form::checkbox('etc[]','キングオブコント',false,['class'=>'col-md-0 form-check-input','id'=>'king'])}}
                {{Form::label('king','キングオブコント',['class' => 'col-md-0 form-check-label text-left'])}}
            </div>
--}}

        </div>
    </div>
      


{{--その他--}}
    <div class="form-group row">
        <label class="col-3 col-form-label">その他:</label>
        <div class="col-9">

            <div class="form-check col-md-0 d-flex align-items-center pr-2">
                {{Form::checkbox('etc[]','M-1',false,['class'=>'col-md-0 form-check-input','id'=>'M-1'])}}
                {{Form::label('M-1','M-1ファイナリスト',['class' => 'col-md-0 form-check-label text-left'])}}
            </div>

            <div class="form-check col-md-0 d-flex align-items-center pr-2">
                {{Form::checkbox('etc[]','キングオブコント',false,['class'=>'col-md-0 form-check-input','id'=>'king'])}}
                {{Form::label('king','キングオブコントファイナリスト',['class' => 'col-md-0 form-check-label text-left'])}}
            </div>

        </div>
    </div>

    <div class="form-group row">
        <div class="offset-2 col-8">
        {!! Form::submit('検索',['class' => 'btn btn-primary btn-block']) !!}
        </div>
    </div>


    {{--<div class="form-group row">
        <div class="offset-2 col-9">
        {!! Form::reset('リセット', ['id' => 'reset-button', 'class' => 'btn btn-outline-success btn-lg']) !!}
        </div>
    </div>--}}
    
    
{!! Form::close() !!}





    <h2 class="mt-2 pb-2">芸人一覧</h1>
    
    
    {{--検索条件：{{$request->s_name}}{{$request->s_start}}--}}
    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>芸人</th>
                    <th>年齢</th>
                    <th>コンビ名など</th>
                    <th>事務所</th>                                   
                </tr>
            </thead>
            
            <tbody>
                @foreach ($perfomers as $value)
                
                    @if($value->activeend == NULL)
                    <tr>
                        <td>{!! link_to_route('perfomers.show', $value->name, ['id' => $value->id]) !!}</td>

                        {{--年齢もリンク--}}
                        @empty($value->birthday)
                        <td>-</td>
                        @else
                        <td>{!! link_to_route('lists.age2List', $now->diffInYears($value->birthday), ['yearsOld' => $now->diffInYears($value->birthday)]) !!}歳</td>
                        @endempty
                        <!--<td>{{!empty($value->birthday) ? $now->diffInYears($value->birthday) : '-' }}歳</td>                        -->
                        <!--<td>{{!empty($value->active) ? $now->diffInYears($value->active) : '-' }}年</td>-->
                       
                        {{--コンビ名リンク--}}                                
                        <td>
                            @if(!empty($value->entertainer[0]->name))
                                {!! link_to_route('entertainers.show', $value->entertainer[0]->name, $value->entertainer[0]->id) !!}
                            @else
                            @endif
                        </td>                       
                        <!--<td>{{!empty($value->entertainer[0]->name) ? $value->entertainer[0]->name : '' }}</td>  -->

                        {{--事務所リンク--}}                                
                        @empty($value->office->office)
                        <td>-</td>
                        @else
                        <td>{!! link_to_route('lists.officeList', $value->office->office, [$value->office->id]) !!}</td>
                        @endempty
                        <!--<td>{{!empty($value->office->office) ? $value->office->office : '' }}</td>                      -->
                    </tr>
    
                    @else
                    <tr class="text-secondary">  {{--解散済みの場合はグレー文字--}}
                        <td>{!! link_to_route('perfomers.show', $value->name, ['id' => $value->id]) !!}（解散済）</td>
                        <td>{{!empty($value->birthday) ? $now->diffInYears($value->birthday) : '-' }}歳</td>
                        <!--<td>{{!empty($value->active) ? $now->diffInYears($value->active) : '-' }}年</td>-->
                        <td>{{!empty($value->entertainer[0]->name) ? $value->entertainer[0]->name : '' }}</td>  
                        <td>{{!empty($value->office->office) ? $value->office->office : '' }}</td> 
                    </tr>
                    @endif
                
                @endforeach
            </tbody>
        </table>

    <!--ページネーションのリンク-->
    {{ $perfomers->appends(request()->query())->links() }}




@endsection