@extends('layouts.app')

@section('content')

    {{--芸歴年　〇人　ピンコンビトリオ〇人　　一覧表示--}}

    <div class="col-lg-12"><h2 class="mt-5 pb-2 display-5 border-bottom">芸歴年一覧</h2>
        <table class="table table-striped">
            <tbody>
                <?php $year=0; ?>

                @foreach ($counts as $count)
                    <tr>
                        <td>
                        <?php echo $year; ?>年
                        </td>
                        <td align="right">
                        {!! link_to_route('lists.historyList', $count, ['year' => $year]) !!}人</br>
                        ピン:{{ $pin[$loop->index] }} コンビ:{{ $combi[$loop->index] }} トリオ:{{ $trio[$loop->index] }}
                        <?php $year++; ?>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
        
@endsection        