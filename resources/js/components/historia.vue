<template>
    <div class="col-md-10">
        <div class="card">
            <div class="card-body animated fadeIn">
                <vue-good-table
                        styleClass="table table-hover"
                        :columns="columns"
                        :rows="rows"
                />
            </div>
        </div>
    </div>
</template>

<script>
    import { VueGoodTable } from 'vue-good-table';
    export default {
        name: "historia",
        components: {
            VueGoodTable,
        },
        data:()=>({
            columns: [
                {
                    label: 'DNI',
                    field: 'dueno.documento_identificacion',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Detail',
                    field: 'detalle_lo',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Name',
                    field: 'dueno.nombre_principal',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Type',
                    field: 'asistencia.tipo',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Date',
                    field: 'asistencia.fecha_as',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Created',
                    field: 'created_at',
                    filterOptions: {
                        enabled: true,
                    },
                },
            ],
            rows: [],
        }),
        methods:{
            cargar:function(){
                let vm=this;
                axios({
                    method: 'OPTIONS',
                    url: location.origin+location.pathname,
                }).then((response) => {
                    vm.rows=response.data;
                }).catch((error) => {
                    vm.cargar();
                });
            }
        },
        created(){
            this.cargar();
        }
    }
</script>

<style scoped>

</style>