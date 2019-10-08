@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{ $comentarios->links() }}
            @foreach($comentarios as $comentario)
            <div class="card">
                <div class="card-header">                    
                    <span class="navbar-text">
                    {{ $comentario->folio }}
                    </span>                        
                    <small class="text-muted float-right">
                        {{ $comentario->created_at }}
                    </small>
                    
                </div>
                <div class="card-body">
                    {{ $comentario->observaciones }}
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</div>
@endsection