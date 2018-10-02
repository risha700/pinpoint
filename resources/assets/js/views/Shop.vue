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
                            <h3 class="display-3">Shop</h3>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-jumbotron>
        </portal>
        <v-container>

            <h1>Products</h1>
            <products></products>
        </v-container>
    </div>
</template>

<script>
    import Products from "../components/shop/Products";
    export default {
        name: "Shop",
        components: {Products},
        data(){
          return{
          }
        },
        mounted(){

        },
        methods: {

        }
    }
</script>

<style scoped>

</style>