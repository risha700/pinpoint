<template>
    <div>
        <portal to="hero">
            <v-responsive
                    class="uk-height-medium"
                    style="background-image: linear-gradient(to right top, #845EC2, #D65DB1, #FF6F91, #FF9671, #FFC75F,#F9F871);background-size:cover;"
                    dark
            >
                <v-container  fill-height>
                    <v-layout align-center>
                        <v-flex text-xs-center>
                            <h3 class="display-3">


                            </h3>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-responsive>
        </portal>
        <v-container>

            <!--<h1>Products</h1>-->
            <!--<products></products>-->
            <categories></categories>
        </v-container>
    </div>
</template>

<script>
    import Products from "../components/shop/Products";
    import Categories from "../components/shop/Categories";
    export default {
        name: "Shop",
        components: {Categories, Products},
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
    .shop-hero{
        background-image: linear-gradient(to right top, #845EC2, #D65DB1, #FF6F91, #FF9671, #FFC75F,#F9F871);background-size:cover;
    }
</style>