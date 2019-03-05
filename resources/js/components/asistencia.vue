<template>
    <div class="col-md-10">
        <div class="card">
            <div class="card-body animated fadeIn">
                <vue-good-table
                        styleClass="table table-hover"
                        :columns="columns"
                        :rows="rows"
                        :pagination-options="{
                            enabled: true,
                            mode: 'records',
                            perPage: 10}"
                        :select-options="{ enabled: true }"
                >
                </vue-good-table>
            </div>
        </div>
    </div>
</template>

<script>
    import { VueGoodTable } from 'vue-good-table';
    export default {
        name: "asistencia",
        components: {
            VueGoodTable,
        },
        data:()=>({
            columns: [
                {
                    label: 'DNI',
                    field: 'documento_identificacion',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Name',
                    field: 'nombre_principal',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Email',
                    field: 'email',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Celular',
                    field: 'celular',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Time',
                    field: 'horas',
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