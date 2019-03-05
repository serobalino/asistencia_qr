<template>
    <div class="col-md-2">
        <div class="nav flex-column nav-pills"   role="tablist" aria-orientation="vertical">
            <a class="nav-link" :class="actual===item.url ? 'active' : ''"  :href="item.url" v-for="item in menu" >
                <i :class="item.icon"></i> {{item.name}}
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "opciones",
        data: () => ({
            menu:[],
        }),
        computed:{
            actual:function(){
                return location.origin+location.pathname;
            }
        },
        methods:{
            cargar:function(){
                let vm=this;
                axios({
                    method: 'GET',
                    url: location.origin+'/app/menu',
                }).then((response) => {
                    vm.menu=response.data.menu;
                }).catch((error) => {
                    vm.cargar();
                });
            },
        },
        created(){
            this.cargar();
        }
    }
</script>

<style scoped>

</style>