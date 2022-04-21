@extends('layouts.app')

@section('content')



<center><h1 class="mt-3 pb-0">{{ $office }} 所属の</h1><h1 class="mt-3 pb-2">芸人一覧</h1></center>
</br>
@include('commons.tab_combi')

    <div class="container">
        <div class="row">

            <div class="col-lg-4" id="1"><h2 class="mt-5 pb-2 display-5">ピン芸人</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>芸人</th>
                            <th>性別</th>
                            <th>芸歴</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pin as $entertainer)
                            @include('lists.office_common')
                        @endforeach
                    </tbody>   
                </table>
            </div>
            
            
            <div class="col-lg-4" id="2"><h2 class="mt-5 pb-2 display-5">コンビ芸人</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>芸人</th>
                            <th>性別</th>
                            <th>芸歴</th>
                        </tr>
                    </thead>
                     
                    <tbody>
                        @foreach ($combi as $entertainer)
                            @include('lists.office_common')
                        @endforeach
                    </tbody>   
                </table>
            </div>
            
            
            <div class="col-lg-4" id="3"><h2 class="mt-5 pb-2 display-5">トリオ芸人</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>芸人</th>
                            <th>性別</th>                            
                            <th>芸歴</th>
                        </tr>
                    </thead>
                     
                    <tbody>
                        @foreach ($trio as $entertainer)
                            @include('lists.office_common')
                        @endforeach
                    </tbody>   
                </table>
            </div>
        </div>
    </div>

</br>        
    @include('commons.tab_combi')

@endsection