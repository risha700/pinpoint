<template>
    <div class="uk-container">
        <h1 class="uk-heading-line uk-text-center uk-padding-large"><span>Similar Products</span></h1>

        <div uk-slider="center: true">

            <div class="uk-position-relative uk-visible-toggle uk-light">

                <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-3@m uk-grid uk-grid-match"  >

                    <li v-for="(pro,index) in products"  >
                        <div class="uk-card uk-card-default">
                            <div class="uk-card-media-top">
                                <img src="/product.jpg" alt="" v-on:click="$openModal(pro)" :key="index">
                            </div>
                            <div class="uk-card-body">

                                <h3 class="uk-card-title uk-link-heading"
                                    @click="linkFormat(pro)"
                                >{{pro.name}}</h3>
                                <p>{{pro.details}}</p>
                            </div>
                        </div>
                    </li>

                </ul>

                <a class="uk-position-center-left uk-position-small uk-background-secondary" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-background-secondary" href="#" uk-slidenav-next uk-slider-item="next"></a>

            </div>

            <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>

        </div>
    </div>

</template>

<script>
    export default {
        name: "SimilarProducts",
        props:['products'],
        methods:{
            linkFormat(pro){
                this.$router.push({ name: 'product', params: { slug: pro.slug }})
                this.$scrollToTop()
            }
        },
    }
</script>

<style scoped>

</style>