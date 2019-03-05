<template>
    <div class="col-md-10">
        <div class="card">
            <div class="card-body animated fadeIn">
                <button class="btn btn-success" v-on:click="descargar">Descargar QR</button>
                <vue-good-table
                        styleClass="table table-hover"
                        @on-selected-rows-change="seleccionadas"
                        :columns="columns"
                        :rows="rows"
                        :pagination-options="{
                            enabled: true,
                            mode: 'records',
                            perPage: 10}"
                        :select-options="{ enabled: true }"
                >
                    <template slot="table-row" slot-scope="props">
                        <span v-if="props.column.field =='inscripcion.imagen' ">
                          <a :href="props.row.inscripcion.imagen" target="_blank" v-if="props.row.inscripcion!==null" >Foto</a>
                        </span>
                        <span v-else>
                          {{props.formattedRow[props.column.field]}}
                        </span>
                    </template>
                </vue-good-table>
            </div>
        </div>
    </div>
</template>

<script>
    import { VueGoodTable } from 'vue-good-table';
    let JSZip = require("jszip");
    export default {
        name: "registros",
        components: {
            VueGoodTable,
        },
        data:()=>({
            columns: [
                {
                    label: 'ID',
                    field: 'id',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'DNI',
                    field: 'documento_identificacion',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Name 1',
                    field: 'nom_paterno',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Name 2',
                    field: 'nom_materno',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Surname 1',
                    field: 'ape_paterno',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Surname 2',
                    field: 'ape_materno',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Address',
                    field: 'direccion',
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
                    label: 'Cellphone',
                    field: 'celular',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Disability',
                    field: 'discapacidad.nom_disca',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Inscription',
                    field: 'tipo.nom_inscr',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Status',
                    field: 'inscripcion.estado',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Bill',
                    field: 'inscripcion.facturado',
                },
                {
                    label: 'Deposit',
                    field: 'inscripcion.num_deposito',
                },
                {
                    label: 'Voucher',
                    field: 'inscripcion.imagen',
                    filterOptions: {
                        enabled: true,
                    }
                },
            ],
            rows: [],
            seleccionados:[],
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
            },
            seleccionadas:function(items){
                this.seleccionados=items.selectedRows;
            },
            descargar:function(){
                if(this.seleccionados.length>0){

                }
            }
        },
        created(){
            this.cargar();
        }
    }
</script>

<style scoped>

</style>