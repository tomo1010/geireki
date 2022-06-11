@extends('layouts.app')

@section('content')

        {{--年の差
        <div class="col-lg-6"><h2 class="mt-5 pb-2 display-5 border-bottom">年代別一覧</h2>
            <table class="table table-striped">
                <tbody>
                <?php $year=1; ?>                    
                   @foreach ($age as $value)
                        <tr>
                            <td>
                                <?php echo $year; ?>0代　
                            </td>
                            <td align="right">
                                <a href="{{ route('lists.ageList', ['year'=>$year]) }}">{{$value}}</a>人
                                <?php $year++; ?>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        --}}
@endsection