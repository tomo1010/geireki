@extends('layouts.app')

@section('content')



    <h2 class="mt-5 pb-2" >ひな壇芸人ガチャ</h2>    
    
    


一人目
{{--芸歴--}}
    <div class="form-group row">
        <label class="col-2 col-form-label">芸歴:</label>
        <div class="col-5">
        {!! Form::selectRange('start', 0, 100, old('start'),['placeholder' => '年から','class' => 'form-control']) !!}
        </div>
        <div class="col-5">
        {!! Form::selectRange('end', 1, 100, old('end'),['placeholder' => '年まで','class' => 'form-control']) !!} 
        </div>
    </div>
    
    
{{--年代--}}    
    <div class="form-group row">
        <label class="col-2 col-form-label">年代:</label>
        <div class="col-5">
        {!! Form::select('age', [
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
    
    
２人目
{{--芸歴--}}
    <div class="form-group row">
        <label class="col-2 col-form-label">芸歴:</label>
        <div class="col-5">
        {!! Form::selectRange('start', 0, 100, old('start_2'),['placeholder' => '年から','class' => 'form-control']) !!}
        </div>
        <div class="col-5">
        {!! Form::selectRange('end', 1, 100, old('end_2'),['placeholder' => '年まで','class' => 'form-control']) !!} 
        </div>
    </div>
    
    
{{--年代--}}    
    <div class="form-group row">
        <label class="col-2 col-form-label">年代:</label>
        <div class="col-5">
        {!! Form::select('age_2', [
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


{!! Form::open(['action' => 'EntertainersController@hinaGacha','method' => 'get']) !!}
        {!! Form::submit('ガチャ',['class' => 'btn btn-success btn-block']) !!}
{!! Form::close() !!}
    
    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>年齢</th>                    
                    <th>芸歴</th>
                </tr>
            </thead>
            
            <tbody>

                <tr>
                    @empty($hinaGacha)
                        <td>-</td>
                    @else
                        <td nowrap>
                            {!! link_to_route('perfomers.show', $hinaGacha->name, ['id' => $hinaGacha->id]) !!}
        
                            {{--コンビ名リンク、個人と芸人が同じ場合は表示しない--}}
                            @if(!empty($hinaGacha->entertainer[0]->name))
                            @if (strcmp($hinaGacha->entertainer[0]->name, $hinaGacha->name) == 0 )
                            @else
                                </br><font size="small">{!! link_to_route('entertainers.show', $hinaGacha->entertainer[0]->name, $hinaGacha->entertainer[0]->id) !!}</font>
                            @endif
                            @endif
                        </td>
                    @endempty                 

                    {{--年齢リンク--}}
                    @empty($hinaGacha)
                        <td>-</td>
                    @else
                        <td>
                            {!! link_to_route('lists.age2List', $now->diffInYears($hinaGacha->birthday), ['yearsOld' => $now->diffInYears($hinaGacha->birthday)]) !!}歳
                        </td>
                    @endempty

                    {{--芸歴リンク--}}
                    @empty($hinaGacha)
                        <td>-</td>
                    @else
                        @empty($hinaGacha->active)
                            <td>-</td>
                        @else
                            <td nowrap>{!! link_to_route('lists.historyList', $now->diffInYears($hinaGacha->active), ['year' => $now->diffInYears($hinaGacha->active)]) !!}年</td>
                        @endempty
                    @endempty
                </tr>


                <tr>
                    <td nowrap>
                        {!! link_to_route('perfomers.show', $hinaGacha_2->name, ['id' => $hinaGacha_2->id]) !!}
    
                        {{--コンビ名リンク、個人と芸人が同じ場合は表示しない--}}
                        @if(!empty($hinaGacha_2->entertainer[0]->name))
                        @if (strcmp($hinaGacha_2->entertainer[0]->name, $hinaGacha_2->name) == 0 )
                        @else
                            </br><font size="small">{!! link_to_route('entertainers.show', $hinaGacha_2->entertainer[0]->name, $hinaGacha_2->entertainer[0]->id) !!}</font>
                        @endif
                        @endif
                    </td>
                    
                    {{--年齢リンク--}}
                    <td>
                    {!! link_to_route('lists.age2List', $now->diffInYears($hinaGacha_2->birthday), ['yearsOld' => $now->diffInYears($hinaGacha_2->birthday)]) !!}歳
                    </td>
    
                    {{--芸歴リンク--}}
                    @empty($hinaGacha_2->active)
                        <td>-</td>
                    @else
                        <td nowrap>{!! link_to_route('lists.historyList', $now->diffInYears($hinaGacha_2->active), ['year' => $now->diffInYears($hinaGacha_2->active)]) !!}年</td>
                    @endempty
                </tr>
    
            </tbody>
        </table>



@endsection