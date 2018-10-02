<template>
    <div >
            <v-container
                    fluid
                    grid-list-md
            >
                <v-layout row wrap>
                    <v-flex
                            v-for="(product,index) in $store.state.products"
                            v-bind="{ [`sm${6}`]: true ,[`md${4}`]: true }"
                            :key="index"
                    >
                        <v-card>
                            <v-card-media
                                    :src=" product.photos.length > 0 ? product.photos[0].path : '/product.jpg' "
                                    height="200px"
                                    :key="product.id"
                                    @click.native.prevent="openModal(product)"

                            >
                                <v-container
                                        fill-height
                                        fluid
                                        pa-2
                                >

                                </v-container>
                            </v-card-media>

                            <v-card-actions>

                                <v-layout fill-height>
                                    <v-flex xs12 align-end flexbox >
                                        <span  class="grey--text">{{product.price | moneyFormat}}</span>
                                        <div class="headline" v-text="product.name"></div>

                                    </v-flex>
                                </v-layout>

                                <v-spacer></v-spacer>
                                <v-btn icon  @click.native.prevent="triggerDesc(product)">
                                    <v-icon>{{ show ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</v-icon>
                                </v-btn>
                                <v-btn icon  @click.native.prevent="createWishList(product)">
                                    <v-icon>favorite</v-icon>
                                </v-btn>
                                <v-btn icon  @click.native.prevent="openModal(product)">
                                    <v-icon>remove_red_eye</v-icon>
                                </v-btn>
                                <v-btn icon @click.native.prevent="addItemToCart(product)">
                                    <v-icon>add_shopping_cart</v-icon>
                                </v-btn>
                            </v-card-actions>
                            <v-slide-y-transition>
                                <v-card-text  v-show="show"  :key="product.id">
                                    {{product.description|excerpt}}...
                                    <v-btn icon @click.native.prevent="openModal(product)">
                                        <v-icon>description</v-icon>
                                    </v-btn>
                                </v-card-text>
                            </v-slide-y-transition>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>

            <!--Infinite loader-->
            <div infinite-wrapper class="text-xs-center">
            <button
            @click="isTriggerFirstLoad=true"
            v-if="!isTriggerFirstLoad"
            class="uk-input uk-border-rounded uk-width-1-2 uk-button-default "
            >Load more</button>


            <infinite-loading
            @infinite="infiniteHandler"
            spinner="waveDots"
            v-else
            >
            <span slot="no-more">No more products for now...</span>

            </infinite-loading>
            </div>
            <!--Quick View Section-->
            <quick-view></quick-view>
            <!--QuickView modal ends-->
        </div>

</template>

<script>
    import InfiniteLoading from 'vue-infinite-loading';
    const api = '/api/product';
    export default {
        name:'Products',
        components: {
            InfiniteLoading,
        },
        data(){
            return{
                products:[],
                isLoading:false,
                isTriggerFirstLoad:true,
                show:false,
                perPage:'',

            }
        },
        watch:{

        },
        filters:{
            excerpt(text){
                return text.slice(0,50)
            }
        },
        methods: {
            infiniteHandler($state) {
                if(this.$store.state.products.length!=0){
                    if(this.$store.state.products.length === this.$store.state.totalProducts) return $state.complete();
                }
                this.$store.dispatch('loadProducts');
                window.events.$on('stateLoaded', ()=> {$state.loaded()})
                window.events.$on('FirstLoadTrigger',()=>{this.isTriggerFirstLoad = false})
                window.events.$on('stateComplete',()=>{$state.complete()})
            },
            openModal(event){
               window.events.$emit('quickView', event);
            },
            alertUser(error){
                window.Swal({
                    toast:true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000,
                    type: 'warning',
                    title: error.response.data,
                    showCloseButton: true,
                });

            },
            flashSuccess(response){
                window.Swal({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    showCloseButton: true,
                    timer: 3000,
                    type: 'success',
                    title: response.data,

                });
            },
            triggerDesc(e){
                this.show = !this.show;
            },
            addItemToCart(e){
                this.$store.dispatch('addToCart', e);

            },
            createWishList(product) {
                this.$store.dispatch('createWishList', product)
            },

        },




    }
</script>