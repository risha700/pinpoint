
<template>

    <div>
        <div ref="modal" class="uk-modal-full" id="quickModal" uk-modal>
            <div class="uk-modal-dialog">
                <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
                <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>



                    <div class="uk-position-relative uk-flex uk-flex-middle" uk-slideshow="animation: fade" uk-height-viewport>

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






                    <div class="uk-padding-large">
                        <h1> {{product.name}}</h1>
                        <p> {{product.description}}</p>
                        <p>  {{product.price | moneyFormat}}</p>
                        <v-btn @click.native.prevent.stop="sendItemToCart(product)" class="uk-button primary uk-border-rounded" :key="product.id">
                            Add to cart <v-icon @click.prevent>add_shopping_cart</v-icon>
                        </v-btn>

                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                product:'',
                images:'',
            }
        },
        watch:{
            images(){
                if (this.images.length == 0){
                    this.images = [{'path':'/product.jpg'}]
                }
            },
        },

        methods:{
            sendItemToCart(product){
                // window.events.$emit('AddToCart', product)
                this.$store.dispatch('addToCart', product);
                if(this.$refs.modal){
                    UIkit.modal(this.$refs.modal).hide()
                    this.product=''
                    this.images=''
                }

            },
        },
        mounted(){
            window.events.$on('quickView', (e) => {
                this.product = e
                this.images = e.photos
                if(UIkit.modal(this.$refs.modal)){
                UIkit.modal(this.$refs.modal).show();
                    }

            });
        },


    }
</script>

<style scoped>

</style>