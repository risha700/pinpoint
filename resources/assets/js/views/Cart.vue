<template>
    <v-container>
        <portal to="hero">
            <v-responsive
                    class="uk-height-small"
                    style="background-image: linear-gradient(to right top, #845EC2, #D65DB1, #FF6F91, #FF9671, #FFC75F,#F9F871);background-size:cover;"
                    dark

            >
                <v-container  fill-height>
                    <v-layout align-center>
                        <v-container text-xs-center>
                                <div class="uk-animation-scale-up uk-heading-line"><h3 class="display-1 page_name">Shopping Cart</h3></div>

                        </v-container>
                    </v-layout>
                </v-container>
            </v-responsive>
        </portal>
        <!--<v-divider v-if="cart.cartCount!=0"></v-divider>-->

        <v-layout row wrap v-if="cart.cartCount>0" >

            <v-flex class="pr-1">
                <v-card raised>

                    <v-container>
                        <v-layout row wrap>
                            <v-flex sm10>
                                <p ><span  class="uk-text-success">#<span v-text="cart.cartCount"></span> {{cart.cartCount > 1 ?'items':'item'}} </span>in your cart</p>
                            </v-flex>
                            <v-flex d-inline-flex >

                                <!--<v-spacer></v-spacer>-->

                                <v-label>Qty</v-label>
                                <v-label>Price<small class="uk-text-success">|each</small></v-label>

                            </v-flex>
                        </v-layout>
                    </v-container>


                    <v-list three-line>
                        <template v-for="(item,i) in cart.cartContent">


                            <v-divider></v-divider>

                            <v-list-tile :key="item.rowId">
                                <v-list-tile-action>
                                    <img class="pr-2" :src="setPhotos(item)"  @click="quickView(item)" width="100px;" >
                                </v-list-tile-action>

                                <v-list-tile-content>
                                    <v-list-tile-title v-html="item.name" @click="quickView(item)"></v-list-tile-title>
                                    <!--<v-list-tile-sub-title v-html="item.rowId"></v-list-tile-sub-title>-->


                                    <template v-for="(ops,i) in item.options">
                                        <v-list-tile-sub-title>
                                                <i> {{ presentOptions(i) }} : {{ops}}</i>
                                        </v-list-tile-sub-title>
                                    </template>

                                </v-list-tile-content>

                                <v-list-tile-action>
                                     <select class="uk-select uk-border-rounded" @change="updateQty(item, $event.target.value)">
                                        <option
                                            class="uk-input"
                                            v-for="(val, i) in productStock(item)"
                                            :value="val"
                                            :key="i"
                                            :selected="item.qty == val ? 'selected' :''"
                                        >{{val}}</option>
                                    </select>
                                </v-list-tile-action>
                                <v-list-tile-action>

                                   <v-chip outline color="success" class="subheading"> <small>{{item.price | moneyFormat}}</small></v-chip>

                                </v-list-tile-action>
                            </v-list-tile>
                            <v-container>
                                <v-btn @click.native="removeItem(item,i)" flat small>
                                    <v-icon small color="red">delete_outline</v-icon>
                                    Remove item
                                </v-btn>
                                <v-btn @click.native="addToWishList(item)" flat small>
                                    <v-icon small color="orange">favorite_border</v-icon>
                                    Save for later
                                </v-btn>
                            </v-container>
                        </template>

                    </v-list>

                </v-card>

            </v-flex>
            <v-flex xs12 md4>
                <v-flex class="pr-0 pt-1" >
                    <div data-uk-sticky="offset: 50;">
                        <v-card raised>
                            <v-list one-line>
                                <v-list-tile>
                                   <v-list-tile-title>Purchase: </v-list-tile-title>
                                    <v-list-tile-action>{{cart.cartSubtotal | moneyFormat}}</v-list-tile-action>
                                </v-list-tile>
                                <v-list-tile>
                                   <v-list-tile-title>Tax: </v-list-tile-title>
                                    <v-list-tile-action>{{cart.cartTax | moneyFormat}}</v-list-tile-action>
                                </v-list-tile>
                                <v-divider class="mb-0"></v-divider>
                                <v-list-tile class="pt-0">
                                    <v-container d-flex>
                                    <v-list-tile-title class="title">Total: </v-list-tile-title>
                                    <v-list-tile-action class="title">{{cart.cartTotal | moneyFormat}}</v-list-tile-action>
                                    </v-container>
                                </v-list-tile>

                            </v-list>
                            <v-btn block color="primary"  to="/checkout">Checkout</v-btn>

                        </v-card>
                    </div>

                </v-flex>

                <!--WISHLIST-->
                <wish-list></wish-list>
            </v-flex>


        </v-layout>






        <quick-view></quick-view>
        <portal to="fullWidth"><empty-cart  v-if="cart.cartCount==0"></empty-cart></portal>
    </v-container>

</template>

<script>
    import {mapState, mapGetters} from 'vuex'
    import WishList from "../components/shop/WishList";
    import EmptyCart from "../components/shop/EmptyCart";
    export default {
        name: "Cart",
        components: { WishList, EmptyCart},
        data(){
          return{
              headers:['Price', 'Quantity'],
              loading:false

          }
        },

        computed:{
            ...mapState(['cart']),
            ...mapGetters(['productStock']),
        },

        methods: {
            // ...mapMutations(['updateQty']),
            // ...mapActions(['productStock']),
            updateQty(item, e) {
                this.$store.dispatch('updateQty', [item, e])
            },
            removeItem(item, i) {
                this.$store.dispatch('removeItem', [item, i])
            },
            addToWishList(item,i) {

                this.$store.dispatch('addToWishList', item)
            },
            quickView(item){
                let product = this.$store.state.cartProductList.find(i=>i.id==item.id)

                window.events.$emit('quickView', product);
            },
            setPhotos(item){
                let product = this.$store.state.cartProductList.find(i=>i.id==item.id)
                if(product){
                    if(product.photos[0]){
                        return  product.photos[0].path
                    }
                }
                    return '/product.jpg'
            },
            presentOptions(arr){

                    return  arr.replace(/(options-)/, '  ')

            }


        },
        beforeCreate(){
            //make product stock available
            this.$store.dispatch('loadAllProducts')
            this.$store.dispatch('fetchCart')
        }
    }
</script>

<style >


</style>