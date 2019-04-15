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
        name: "registroTotal",
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
                    label: 'Name',
                    field: 'dueno.nombre_principal',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Subject',
                    field: 'dueno.tipo.nom_inscr',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Type',
                    field: 'tipo',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Date',
                    field: 'fecha_as',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Created',
                    field: 'creado',
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