<template>
    <div class="container">
        <div class="card">
            <div class="card-header">Atención del servidor público</div>
            <div class="card-body">
                <apexchart type=bar height=350 :options="chartOptions" :series="series" />
            </div>
        </div>
            
        
    </div>
</template>

<script>
    import VueApexCharts from 'vue-apexcharts'

    export default {
        mounted() {
            console.log('Graficas.'+routeBase)
            this.getDatos();
        },
        components: {
            apexchart: VueApexCharts,
        },
        data() {
            return {
                urlBase: routeBase,
                series: [],
                chartOptions: {
                    plotOptions: {
                        bar: {
                            horizontal: true,
                            columnWidth: '55%',
                            endingShape: 'rounded'	
                        },
                    },
                    chart: {
                        toolbar: {
                            show: false,
                        }
                    },                    
                    dataLabels: {
                        enabled: true,
                        style: {
                            fontSize: '18px',
                            colors: ["#304758"]
                        }                        
                    },                  
                    stroke: {
                        show: false,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: ['Atención', 'Tiempo de espera'],
                        },
                    yaxis: {
                        title: {
                            text: 'Servidor público',
                            style: {
                                color: undefined,
                                fontSize: '18px',
                            }
                        }
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                            return "# " + val + " preguntas"
                            }
                        }
                    }
                }
            }
        },
        methods: {
            getDatos() {                
                let le = this;
                axios.get( this.urlBase+'/grafica/atencion_servidor_publico' )
                .then(function (response) {
                    le.series = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });                
            },
        }        
    }
</script>