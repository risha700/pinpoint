<template>
    <div>
        <portal to="hero" v-if="product">
            <v-responsive
                    class="uk-position-top uk-height-small uk-padding-small-top"
                    style="background-image: linear-gradient(to right top, #845EC2, #D65DB1, #FF6F91, #FF9671, #FFC75F,#F9F871);background-size:cover;"
                    dark
            >
                <v-container  fill-height>
                    <v-layout align-center>
                        <v-container text-xs-center>
                            <transition
                                    name="fadeInUp"
                                    enter-active-class="animated fadeInUp"
                                    leave-active-class="animated fadeOutDown"
                            >
                            <div class=" uk-heading-line"><h3 class="display-1 page_name">{{product.name}}</h3></div>
                            </transition>
                        </v-container>
                    </v-layout>
                </v-container>
            </v-responsive>
        </portal>
        <!--<div class="uk-position-top-left">-->
            <!--<a class="uk-button uk-button-secondary" @click="$router.go(-1)">back</a>-->
        <!--</div>-->
        <v-container v-if="product && !loading" >
            <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle uk-card-default uk-margin-medium-top" uk-grid >


                <div class="uk-position-relative uk-flex uk-flex-middle uk-grid-divider" uk-slideshow="animation: fade" >

                    <div class="uk-position-small uk-width-1-3 ">
                        <ul class="uk-thumbnav uk-thumbnav-vertical"  uk-margin>



                            <li v-for="(image,index) in images" :uk-slideshow-item="index" :key="index">


                                <a href=""><img :src="image.path" width="100" :alt="product.name" :key="index"></a>

                            </li>


                        </ul>
                    </div>

                    <!-- lightbox -->

                    <div class="uk-position-small uk-width-3-1" >
                        <ul class="uk-slideshow-items" uk-lightbox="animation: slide">

                            <li class="uk-flex uk-flex-middle" v-for="(image,index) in images" >
                                <a class="uk-inline" :href="image.path" :data-caption="product.name" :key="index">

                                    <img :src="image.path"  :alt="product.name" :key="index">
                                </a>
                            </li>
                        </ul>
                    </div>


                </div>


                <v-form ref="form" v-model="valid" @submit.prevent="onSubmit" @keydown.native.stop="form.errors.clear($event.target.name)" lazy-validation  class="uk-padding">
                    <h1 class="uk-heading-bullet"> {{product.name}}</h1>
                    <ul v-for="desc in presentDescription(product.description)">
                        <li v-text="desc">    </li>
                    </ul>
                    <p>
                        <span uk-icon="icon: tag"></span>
                        {{product.details}}
                    </p>
                    <p>  {{product.price | moneyFormat}} <span class="uk-sub">each</span></p>

                   <template v-for="(value, key, index) in productOptions(product)">
                       <div class="uk-grid uk-animation-scale-up"><p class=" uk-text-muted">{{key}}</p></div>
                       <v-radio-group v-model="form.options[`options-${key}`]" :rules="form.rules.option" row  >
                           <v-radio class="uk-flex-1 uk-flex-column" v-for="val in value" :value="val" :key="val" :label="val" color="primary"></v-radio>
                       </v-radio-group >
                   </template>

                   <v-btn @click.native.prevent="onSubmit()" :loading="btnLoading">Add to cart</v-btn>

               </v-form>
           </div>
            <div>

                <similar-products :products="relatedProducts"></similar-products>

            </div>
        </v-container>


        <loading :loading="loading"></loading>

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
              valid:false,
              loading:false,
              images:'',
              form:new Form({
                  id:'',
                  name:'',
                  price:'',
                  options:{},
                  rules:{
                      option:[
                          v => !!v || 'Please set your desired option',
                      ],
                  }
              }),
              btnLoading:false,


          }
        },
        computed:{
            ...mapGetters(['productSlug','categoryProducts','productOptions']),
            product(){
              return this.productSlug(this.$route.params.slug)
            },
            relatedProducts(){

                return _.shuffle(this.categoryProducts(this.product))
            },
        },
        watch:{
            images(){
                if (this.images.length == 0){
                    this.images = [{'path':'/product.jpg'}]
                }
            },
        },
        methods:{
            async onSubmit(){
                if(this.$refs.form.validate()) {
                    this.btnLoading = true
                    await this.$store.dispatch('addToCart', this.form)
                    .then(()=>{
                        this.form.options =this.form.originalData.options ? this.form.originalData.options: {}
                        this.assignFormProduct()
                        this.btnLoading = false
                    }).catch(({error})=>{console.log(error);this.btnLoading = false});
                }
            },
            async assignFormProduct(){
                    await this.$store.dispatch('loadAllProducts')
                       if(this.product){
                           this.images=this.product.photos
                           return Object.keys(this.form).filter((v,i)=>{
                               if( v ==  'id' || v == 'name'||v == 'price')
                                    this.$set(this.form, v ,this.product[v])
                           })
                       }

                },
            presentDescription(val){
                if(typeof val == 'string'){
                    let v = val.split('.')
                    return v.filter(e=>!!e)
                }

            },





        },
        created(){
            this.assignFormProduct();
        },
        beforeRouteUpdate (to, from, next) {
            let product = this.$store.state.cartProductList.find((product)=>product.slug == to.params.slug)
            if(!product){this.$router.push({ name: '404',params:{0:to.params.slug} })}
            next()
        },

    }
</script>

<style scoped>

</style>