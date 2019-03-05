<template>
    <div class="col-md-10">
        <div class="alert alert-primary" role="alert">
            Double click to change the user's role.
        </div>
        <div class="card">
            <div class="card-body animated fadeIn">
                <vue-good-table
                        styleClass="table table-hover sorting"
                        :columns="columns"
                        :rows="rows"
                        @on-row-dblclick="cambiarRol"
                />

            </div>
        </div>
    </div>
</template>

<script>
    import { VueGoodTable } from 'vue-good-table';
    export default {
        name: "usuarios",
        components: {
            VueGoodTable,
        },
        data:()=>({
            columns: [
                {
                    label: 'Name',
                    field: 'name',
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
                    label: 'Admin',
                    field: 'admin',
                    filterOptions: {
                        enabled: true,
                    },
                }
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
            },
            cambiarRol:function(item){
                let vm=this;
                axios({
                    method: 'POST',
                    url: location.origin+location.pathname,
                    data:item.row,
                }).then((response) => {
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