<template>
    <div>
        <portal to="hero">
            <v-jumbotron
                    style="background:url('/topography.svg') no-repeat center, linear-gradient(to right top, #845EC2, #D65DB1, #FF6F91, #FF9671, #FFC75F,#F9F871);background-size:cover;"
                    dark
            >
                <v-container  fill-height>
                    <v-layout align-center>
                        <v-flex text-xs-center>
                            <h3 class="display-3">Home</h3>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-jumbotron>
        </portal>


        <h1>Home content</h1>

    </div>
</template>

<script>
    export default {

        name: "Home",
        data(){
            return{
                gradient: 'to right top, rgb(132,94,194, .7), rgb(214,93,177, .7), rgb(255,111,145, .7), rgb(255,150,113, .7), rgb(255,199,95, .7),rgb(249,248,113, .7)',
            }
        },
        mounted(){
            // axios.get('/api/product').then((data)=>console.log(data)).catch((error)=>console.log(error))
        }


    }
</script>

<style scoped>

</style>