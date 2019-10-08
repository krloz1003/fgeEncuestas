<template>
    <div class="container">
        <div class="card">
            <div class="card-header">Documentos</div>
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
                    chart: {
                        height: 350,
                        type: 'bar',
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                position: 'center', // top, center, bottom
                            },
                        }
                    },
                    chart: {
                        toolbar: {
                            show: false,
                        }
                    },                    
                    dataLabels: {
                        enabled: true,
                        formatter: function (val) {
                            return val;
                        },
                        offsetY: -20,
                        style: {
                            fontSize: '22px',
                            colors: ["#304758"]
                        }
                    },
                    xaxis: {
                        categories: ["ACTA DE HECHOS", "MECANISMOS ALTERNATIVO", "ORIENTACION", "SEGUIMIENTO"],
                        position: 'top',
                        labels: {
                            offsetY: -18,
                        },
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        crosshairs: {
                            fill: {
                                type: 'gradient',
                                gradient: {
                                    colorFrom: '#D8E3F0',
                                    colorTo: '#BED1E6',
                                    stops: [0, 100],
                                    opacityFrom: 0.4,
                                    opacityTo: 0.5,
                                }
                            }
                        },
                        tooltip: {
                            enabled: true,
                            offsetY: -35,
                        }
                    },
                    fill: {
                        gradient: {
                            shade: 'light',
                            type: "horizontal",
                            shadeIntensity: 0.25,
                            gradientToColors: undefined,
                            inverseColors: true,
                            opacityFrom: 1,
                            opacityTo: 1,
                            stops: [50, 0, 100, 100]
                        },
                    },
                    yaxis: {
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false,
                        },
                        labels: {
                            show: true,
                            formatter: function (val) {
                            return val;
                            }
                        }

                    },
                    title: {
                        text: 'Tramites realizados',
                        floating: true,
                        offsetY: 320,
                        align: 'center',
                        style: {
                            color: '#444'
                        }
                    }
                }
                        
            }
        },
        methods: {
            getDatos() {                
                let le = this;
                axios.get( this.urlBase+'/data_documentos' )
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