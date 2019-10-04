<template>
    <div class="container">
        <div class="card">
            <div class="card-header">Estadistica recepción</div>
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
            console.log('Graficas.')
            this.getDatos();
        },
        components: {
            apexchart: VueApexCharts,
        },
        props() {
            return {
                urlBase: ''
            }
        },
        data() {
            return {
                series: [{
                    name: 'EXCELENTE',
                    data: [44, 55]
                }, {
                    name: 'BUENA',
                    data: [76, 85]
                }, {
                    name: 'REGULAR',
                    data: [35, 41]
                }, {
                    name: 'MALA',
                    data: [35, 41]
                }],
                chartOptions: {
                    plotOptions: {
                    bar: {
                        horizontal: true,
                        columnWidth: '55%',
                        endingShape: 'rounded'	
                    },
                    },
                    dataLabels: {
                    enabled: false
                    },
                    stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                    },

                    xaxis: {
                    categories: ['Atención', 'Tiempo de espera'],
                    },
                    yaxis: {
                    title: {
                        text: 'Recepción'
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
                axios.get( this.urlBase )
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });

                
            },


        }        
    }
</script>