@extends('layouts.app')

@section('content')



    {{--受賞年一覧--}}
    <div class="col-lg-6"><h2 class="mt-2 pb-2 display-5 border-bottom">受賞年一覧</h2>
        <table class="table table-striped">
            <tbody>

                @foreach ($years as $year)
                    <tr>
                        @if($counts[$loop->index] != 0)
                        <td>
                        {{$year}}年
                        </td>
                        <td align="right">
                        {!! link_to_route('lists.awardList', $counts[$loop->index], ['year' => $year]) !!}組（人）
                        </td>
                        
                        @endif
                    </tr>
    
                @endforeach
            </tbody>
        </table>
    </div>
        
@endsection        