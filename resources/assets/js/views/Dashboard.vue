<template>
    <div v-if="can">
        user profile {{user.name}}
    <ul v-for="(order,i) in user.orders">
        <li :key="i" >{{order.error==null?order.id:''}}</li>

    </ul>
    </div>
</template>

<script>
    export default {
        name: "Dashboard",
        data(){
            return{
                user:window.App.user?window.App.user:false
            }
        },
        computed:{
            can(){
                return this.authorize(user=> user.id === this.user.id);
            }
        },
        mounted(){

            // console.log(this.$route)
        },
    }
</script>

<style scoped>

</style>