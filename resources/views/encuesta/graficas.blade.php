@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <encuesta-graficas url="{!! url('data_graficas') !!}"></encuesta-graficas>
        </div>
    </div>
</div>
@endsection
