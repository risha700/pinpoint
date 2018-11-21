<template>
    <div>
        <portal to="hero">
            <v-responsive
                    class="uk-height-small"
                    style="background-image: linear-gradient(to right top, #845EC2, #D65DB1, #FF6F91, #FF9671, #FFC75F,#F9F871);background-size:cover;"
                    dark
            >
                <v-container  fill-height>
                    <v-layout align-center>
                        <v-flex text-xs-center>
                            <transition
                                    name="fadeInUp"
                                    enter-active-class="animated fadeInUp"
                                    leave-active-class="animated fadeOutDown"
                            >
                                <div class=" uk-heading-line"><h3 class="display-1 page_name">Shop</h3></div>
                            </transition>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-responsive>
        </portal>
        <!--<v-container>-->

            <!--<h1>Products</h1>-->
            <!--<products></products>-->
            <categories></categories>
        <!--</v-container>-->
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
        created(){
            localStorage.setItem('hello risha','ho themere!!')
            console.log(localStorage)
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