<template>

    <div>
        <v-container>
            <div>
                <p class="uk-text-lead uk-text-center">
                    Shopping Cart
                </p>
            </div>
        </v-container>
        <v-divider></v-divider>

        <v-layout row wrap v-if="cart.cartCount>0" >
            <v-flex xs12 sm8 class="pa-2" >
                <v-card raised>

                    <v-layout
                            align-baseline
                            row
                            wrap
                            d-flex
                            pt-2
                    >
                        <v-subheader xs9>
                            <p>You have <span v-text="cart.cartCount"></span> {{cart.cartCount > 1 ?'items':'item'}} in your cart</p>
                        </v-subheader>
                        <v-flex
                            d-inline-flex
                            align-baseline
                            align-content-end
                            justify-content-end
                        >

                            <v-spacer></v-spacer>

                            <p>Qty</p>
                            <p>Price</p>

                        </v-flex>
                    </v-layout>


                    <v-list three-line>
                        <template v-for="(item,i) in cart.cartContent">


                            <v-divider></v-divider>

                            <v-list-tile :key="item.rowId">
                                <v-list-tile-action>
                                    <img class="pr-2" :src="setPhotos(item)"  @click="quickView(item)" width="100px;" >
                                </v-list-tile-action>

                                <v-list-tile-content>
                                    <v-list-tile-title v-html="item.name" @click="quickView(item)"></v-list-tile-title>
                                    <v-list-tile-sub-title v-html="item.rowId"></v-list-tile-sub-title>
                                    <v-list-tile-sub-title v-html="item.options[0]"></v-list-tile-sub-title>
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
                                    <v-container class="mr-3">
                                        <!--<v-list-tile-title>{{item.price | moneyFormat}}</v-list-tile-title>-->
                                        <v-chip outline color="success" class="subheading"> {{item.price | moneyFormat}}</v-chip>

                                    </v-container>
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
            <v-flex>
                <v-flex class="pr-0" >
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





        <v-layout row wrap v-if="cart.cartCount==0">
            <v-container text-sm-center >
                <v-card class="pa-3" >
                    <v-card-text><h1 color="white">Your cart is empty</h1></v-card-text>
                    <v-btn color="white" to="/shop"><v-icon color="warning">shopping_cart</v-icon>Go Shopping</v-btn>
                </v-card>

            </v-container>

        </v-layout>

        <quick-view></quick-view>
    </div>
</template>

<script>
    import {mapState, mapGetters} from 'vuex'
    import WishList from "../components/shop/WishList";
    export default {
        name: "Cart",
        components: {WishList},
        data(){
          return{
              headers:['Price', 'Quantity']

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
            }


        },
        beforeCreate(){
            //make product stock available
            this.$store.dispatch('loadAllProducts')
            this.$store.dispatch('fetchCart')
        }
    }
</script>

<style scoped>

</style>