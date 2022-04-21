@extends('layouts.app')

@section('content')

        {{--事務所一覧--}}
        <div class="col-lg-12"><h2 class="mt-5 pb-2 display-5 border-bottom">事務所一覧</h2>
            <table class="table table-striped">
                <tbody>
                   @foreach ($offices as office)
                        <tr>
                            <td>
                            {{$office->office}}
                            </td>
                            <td align="right">
                            <a href="{{ route('lists.officeList', ['id'=>$office->id]) }}">{{$office = $office->entertainers_count}}</a>人
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
@endsection             