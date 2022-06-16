@extends('layouts.app')

@section('content')


    <center><h1 class="mt-5 pb-2">年齢と芸歴の差ランキング</h1></center>

    <div class="container">
        <div class="row">

            <div class="col-lg-6">    
            <h2 class="mt-5 pb-2" >年齢をとってから芸人に</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>年齢</th>
                            <th>芸歴</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($young as $key => $value)
                            @if($value >= 30)
                            <tr>
                                <td nowrap>{!! link_to_route('perfomers.show', $perfomers[$key]->name, [$perfomers[$key]->id]) !!}<br>
                                <td>{!! link_to_route('lists.age2List', $now->diffInYears($perfomers[$key]->birthday), ['yearsOld' => $now->diffInYears($perfomers[$key]->birthday)]) !!}</td>
                                <td>{!! link_to_route('lists.historyList', $now->diffInYears($perfomers[$key]->active), ['year' => $now->diffInYears($perfomers[$key]->active)]) !!}</td>
                            </tr>                            
                            @endif
                        @endforeach
                    </tbody>   
                </table>
            </div>


            <div class="col-lg-6">
            <h2 class="mt-5 pb-2" >若い時から芸人に</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>年齢</th>
                            <th>芸歴</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($elderly as $key => $value)
                            @if($value <= 15)
                            <tr>
                                <td nowrap>{!! link_to_route('perfomers.show', $perfomers[$key]->name, [$perfomers[$key]->id]) !!}</td>
                                <td>{!! link_to_route('lists.age2List', $now->diffInYears($perfomers[$key]->birthday), ['yearsOld' => $now->diffInYears($perfomers[$key]->birthday)]) !!}</td>
                                <td>{!! link_to_route('lists.historyList', $now->diffInYears($perfomers[$key]->active), ['year' => $now->diffInYears($perfomers[$key]->active)]) !!}</td>
                            </tr>                            
                            @endif
                        @endforeach
                    </tbody>   
                </table>
            </div>
        
        </div>
    </div>

@endsection