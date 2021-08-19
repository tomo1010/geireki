@extends('layouts.app')

@section('content')

        {{--事務所一覧--}}
        <div class="col-lg-6"><h2 class="mt-2 pb-2 display-5 border-bottom">事務所一覧</h2>
            <table class="table table-striped">
                <tbody>
                   @foreach ($office as $value)
                        <tr>
                            <td>
                            {{$value->office}}
                            </td>
                            <td align="right">
                            <a href="{{ route('lists.officeList', ['id'=>$value->id]) }}">{{$office = $value->entertainers_count}}</a>人
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
@endsection             