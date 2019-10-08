@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <encuesta-graficas></encuesta-graficas>
            <documento-graficas></documento-graficas>
            <atencion-servidor></atencion-servidor>
        </div>
    </div>
</div>
@endsection
