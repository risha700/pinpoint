<template>
    <v-flex class="pl-2" v-if="Object.keys($store.state.cart.wishList).length > 0">
        <v-divider></v-divider>

        <div data-uk-sticky="offset: 300;" >
            <div>
            <v-flex
                    d-inline-flex
                    justify-center

            >
                <v-icon color="primary" dark large>info</v-icon> <p >Your wish list</p>
            </v-flex>
            </div>
            <v-card raised>
                <v-list
                        five-line
                        style="height: 200px;"
                        class="uk-overflow-auto"
                >
                    <template  v-for="(item,i) in $store.state.cart.wishList">
                        <v-list-tile
                                :key="i"


                        >
                            <v-list-tile-avatar>
                                <!--<v-icon :class="[item.iconClass]">{{ item.icon }}</v-icon>-->
                                <img @click="quickView(item)" class="pr-2" :src="setPhotos(item)"   width="100px;" >
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title>{{ item.name }}</v-list-tile-title>
                                <v-list-tile-sub-title>{{item.price | moneyFormat}}</v-list-tile-sub-title>
                            </v-list-tile-content>
                            <v-list-tile-action>
                                <v-btn @click.native="removeWishList(item)" flat small>
                                    <v-icon small color="red">delete_outline</v-icon>
                                    Remove item

                                </v-btn>
                                <v-btn @click.native="moveToCart(item)" flat small v-if="setProductStock(item)">
                                    <v-icon small color="green">shopping_cart</v-icon>
                                    Add to cart
                                </v-btn>
                                <v-btn disabled flat small v-else="!setProductStock(item)" :key="item.id">
                                    <v-icon small color="green">shopping_cart</v-icon>
                                   OUT OF STOCK
                                </v-btn>
                            </v-list-tile-action>
                        </v-list-tile>
                        <v-divider v-if="i != $store.state.cart.wishList.length - 1"></v-divider>

                    </template>

                </v-list>
            </v-card>

        </div>

    </v-flex>

</template>

<script>
    export default {
        name: "WishList",
        methods:{
            setPhotos(item){
                let product = this.$store.state.cartProductList.find(i=>i.id==item.id)
                if(product){
                    if(product.photos[0]){
                        return  product.photos[0].path
                    }
                }
                return '/product.jpg'
            },
            moveToCart(item){
                this.$store.dispatch('moveToCart', item)
            },
            removeWishList(item) {
                this.$store.dispatch('removeWishList', item)
            },
            setProductStock(item){
                let product = this.$store.state.cartProductList.find(i=>i.id==item.id)
                if(product){

                    return product.stock
                }

            },
            quickView(item){
                let product = this.$store.state.cartProductList.find(i=>i.id==item.id)

                window.events.$emit('quickView', product);
            },

        }
    }
</script>

<style scoped>

</style>