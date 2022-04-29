@extends('layouts.app')

@section('content')

        {{--誕生日一覧--}}
        <div class="col-lg-12"><h2 class="mt-5 pb-2 display-5 border-bottom">誕生日一覧</h2>
            <table class="table table-striped">
                <?php $month=1; ?>
                <tbody>
                    {{--@for ($month = 1; $month < 13; $month++)--}}

                        @foreach ($birthdays as $birthday)
                            <tr>
                                <td>
                                {{$birthday}}日
                                </td>
                                <td align="right">
                                <a href="{{ route('lists.birthdayList', ['birthday'=>$birthday]) }}">{{$birthdaysCount[$loop->index]}}</a>人
                                </td>
                            </tr>
                        @endforeach
{{--                    @endfor--}}
                </tbody>
            </table>
        </div>
        
@endsection             