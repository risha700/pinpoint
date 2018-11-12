<template>

            <v-layout column flex class="pa-3 uk-text-center" id="after-hero" uk-height-viewport>
                <div class="uk-text-center  uk-heading-line" ><h3 class="" style="color:#fff;">cart is empty</h3></div>

                <img src="/svg/bag.svg"  class="uk-align-center " id="cart_styles" uk-svg/>
                <v-container>
                    <v-btn color="orange" to="/shop" dark large>Go Shopping</v-btn>

                </v-container>


            </v-layout>



</template>

<script>
    export default {
        name: "EmptyCart"
    }
</script>

<style >
    #after-hero{
        /*border: solid 3px black;*/
        color:#845EC2;
        background-image: url('/svg/empty-cart.svg'),linear-gradient(to right top, #845EC2,#F9F871);
        box-shadow: #845EC2 2px 1px 3em;
        background-repeat: repeat;
        background-size: contain;
        background-blend-mode:soft-light;
        /*background-position:center bottom;*/
        background-blend-mode:soft-light;

    }
    #cart-arrow{
        transform-origin:50% 50%;
        animation: bounce 2s infinite ease-in-out;
    }


    /*#cart_styles{*/
        /*stroke: #845EC2;stroke-width:3px;color:#FF6F91;*/
        /*height:70px;*/
    /*}*/

</style>