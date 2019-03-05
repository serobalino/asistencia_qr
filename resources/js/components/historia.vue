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
                    label: 'Detalle',
                    field: 'detalle_ca',
                    filterOptions: {
                        enabled: true,
                        placeholder: 'Filtro por siglas',
                    },
                },
                {
                    label: 'Estado',
                    field: 'estado_ca',
                },
                {
                    label: 'Empieza',
                    field: 'desde_ca',
                    filterOptions: {
                        enabled: true,
                        placeholder: 'Filtro por fecha',
                    },
                },
                {
                    label: 'Finaliza',
                    field: 'vence_ca',
                    filterOptions: {
                        enabled: true,
                        placeholder: 'Filtro por fecha',
                    },
                },
            ],
            rows: [],
        }),
    }
</script>

<style scoped>

</style>