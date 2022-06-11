@extends('layouts.app')

@section('content')


    <center><h1 class="mt-5 pb-2">年の差　芸人一覧</h1></center>

    <div class="container">
        <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>年の差</th>
                            <th>芸歴</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $result)
                            <tr>
                                <td nowrap></td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td>@include('commons.entertainer_history')</td>
                            </tr>                            
                        @endforeach
                    </tbody>   
                </table>
        </div>
    </div>

@endsection