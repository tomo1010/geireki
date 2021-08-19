@extends('layouts.app')

@section('content')

    {{--芸歴一覧--}}
    <div class="col-lg-6"><h2 class="mt-2 pb-2 display-5 border-bottom">芸歴年一覧</h2>
        <table class="table table-striped">
            <tbody>
                <?php $year=0; ?>
                @foreach ($counts as $count)
                    <tr>
                        <td>
                        <?php echo $year; ?>年
                        </td>
                        <td align="right">
                        {!! link_to_route('lists.historyList', $count, ['year' => $year]) !!}人
                        （ピン{{ $results_1[$loop->index] }}人　コンビ{{ $results_2[$loop->index] }}人　トリオ{{ $results_3[$loop->index] }}人）
                        <?php $year++; ?>
                        </td>
                    </tr>
    
                @endforeach
            </tbody>
        </table>
    </div>
        
@endsection        