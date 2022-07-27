@extends('layouts.app')

@section('content')

@include('ranking.tag_tab');


@for($i = 6 ; $i<9 ; $i++)

    <h3 class="mt-5 pb-2">
    <button class="btn btn-success btn-lg m-1">#{{$tags[$i]->name}}</button>
    </h3>
        <table class="table table-striped">
            <thead>
                @include('ranking.tag_thead')
            </thead>
            
            <tbody>
                @php
                    $i++;
                    $value = 'tagCount_'.$i;
                @endphp
                @foreach ($$value as $entertainer)
                    @include('ranking.tag_tbody')
                @endforeach
                @php
                    $i--;
                @endphp
            </tbody>
        </table>

@endfor

        
@endsection