@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Encuestas</div>
                <div class="card-body">
                    <table class="table" id="table"></table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
$(function(){
    var table       = $('#table');

    table.bootstrapTable({
        locale: 'es-MX',
        search: true,
        pagination: true,
        pageList: [5, 10, 25, 50],
        pageSize: 10,
        url: routeBase+'/encuesta/get_all_encuestas',
        columns: [{					
            field: 'folio',
            title: 'Folio',
        }, {					
            field: 'fecha_registro',
            title: 'Fecha registro',
        }, {					
            field: 'recepcion_atencion',
            title: 'Atención',
        }, {					
            field: 'recepcion_tiempo_espera',
            title: 'Tiempo espera',
        }, {					
            field: 'tramite_realizado',
            title: 'Tramite',
        }, {					
            field: 'servidor_publico',
            title: 'Servidor publico',
        }, {					
            field: 'tipo_servidor_publico',
            title: 'Tipo',
        }, {					
            field: 'servidor_atencion',
            title: 'Atencion',
        }, {					
            field: 'servidor_tiempo_atencion',
            title: 'Tiempo de atencion',
        }, {					
            field: 'observaciones',
            title: 'Observaciones',
        }]
    })

    
})
</script>
@endsection
