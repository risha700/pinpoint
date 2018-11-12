<template>
    <div>
        <a class="uk-button uk-button-secondary" @click="$router.go(-1)">back</a>

        <v-container>
           <div v-if="product" >
               <v-form @submit.prevent="onSubmit()">
                   <p>{{product.name}}</p>
                       <!--<input type="hidden" name="id" :value="product.id">-->
                       <!--<input type="hidden" name="name" :value="product.name">-->
                       <!--<input type="hidden" name="price" :value="product.price">-->
                   <v-btn @click.native.prevent="onSubmit(product)">Submit</v-btn>

               </v-form>
           </div>

        </v-container>


        <div>

<similar-products :products="relatedProducts"></similar-products>

        </div>

    </div>

</template>

<script>
    import {mapGetters} from 'vuex'
    import SimilarProducts from "../components/shop/SimilarProducts";

    export default {
        name: "Product",
        components: {SimilarProducts},
        data(){
          return{
              form:new Form({
                  product:'',
                  show:false,


              }),
              slug: this.$route.params.slug,
              store:this.$store

          }
        },
        computed:{
            ...mapGetters(['productSlug','categoryProducts']),
            product(){
              return this.productSlug(this.slug)
            },
            relatedProducts(){

                return this.categoryProducts(this.product)
            }

        },
        watch:{
          form(){
               this.form.product = this.product
          },
        watch: {
            '$route.params.slug': function () {
                this.handleErrorRoute()
                }

            },

        },
        methods:{
            async onSubmit(event){
                this.$store.dispatch('addToCart', event);
            },
            async originalProducts(){
               await this.$store.dispatch('loadAllProducts')
                return this.$store.state.cartProductList
            },
            handleErrorRoute(){
                this.originalProducts().then((p)=>p.find((v)=>v.slug == this.$route.params.slug))
                    .then((v)=>{
                    if(!v){this.$router.push({name: '404',params:{0:this.$route.params.slug}} )}
                })
            },



        },
        mounted(){
            this.handleErrorRoute()
        },
        beforeCreate(){
            this.$store.dispatch('loadAllProducts')
            this.$store.dispatch('loadAllCategories')
        },



    }
</script>

<style scoped>

</style>