<template>
    <div>
        <mini-drawer></mini-drawer>

        <!--Menu-->

            <v-toolbar fixed  app dense card nudge-top fadeIn v-scroll="onScroll"
                       :style="menuColor?menuColor: 'background-color: transparent;'"


        >


            <portal-target name="toggleDrawerHandler"></portal-target>


            <div class="uk-navbar-center">
                <v-toolbar-title class="uk-text-primary">
                    <img src="/images/pinpointoptics.png" width="120" height="100" alt=""
                         style="stroke: #6a1b9a;stroke-width:20px">


                </v-toolbar-title>
            </div>
            <v-spacer></v-spacer>

            <!--toolbar buttons vuerouter-->
            <!--<v-toolbar-items class="hidden-sm-and-down" v-for="(menu, index) in router.options.routes" :key="index" v-if="menu.component.name !='Checkout'">-->
            <v-toolbar-items class="hidden-sm-and-down" v-for="(menu, index) in router.options.routes" :key="index" v-if="menu.showInMenu ">
                <v-btn flat :to="menu.path" class="fix_underline" @click.native="$scrollToTop">
                    <v-badge v-show="menu.component.name ==='Cart' && store.state.cart.cartCount>0" color="purple" overlap>
                        <span slot="badge">{{store.state.cart.cartCount}}</span>
                    </v-badge>
                    <v-icon>{{menu.icon}}</v-icon>
                    {{menu.component.name}}

                </v-btn>

                <!--<v-badge v-html="store.state.cart.cartCount" v-show="menu.component.name ==='Cart' && store.state.cart.cartCount>0"></v-badge>-->
            </v-toolbar-items>
            <!--toolbar Vuerouter ends-->

        </v-toolbar>
        <!--home hero section-->
        <portal-target name="hero" ref="protalHero"></portal-target>
        <!--Full width for designing-->
        <portal-target name="fullWidth"></portal-target>

        <v-content @click.native="minifyDrawer" :class="setPageBackground()">

            <!--<v-layout row wrap>-->
                <flash></flash>
            <transition tag="section" :name="transitionName">
                <router-view :key="$route.fullPath"></router-view>
            </transition>
            <!--</v-layout>-->

            <!--<v-container grid-list-md text-xs-center>-->

            <!--</v-container>-->
        </v-content>
        <quick-view></quick-view>


    </div>
</template>

<script>
    import MiniDrawer from "../partials/MiniDrawer";

    export default {

        name: "AppShell",
        components: {MiniDrawer},
        data(){
            return{
                gradient: 'to right, #5433ff, #20bdff, #a5fecb',
                offsetTop: 0,
                menuColor:'',
                router:this.$router,
                store:this.$store,
                transitionName:''
            }
        },
        watch: {
            '$route' (to, from) {
                const toDepth = to.path.split('/').length
                const fromDepth = from.path.split('/').length
                this.transitionName = toDepth < fromDepth ? 'slide-right' : 'slide-left'
            }
        },
        methods:{
            onScroll (e) {
                this.offsetTop = window.pageYOffset || document.documentElement.scrollTop
                this.offsetTop > this.$refs.protalHero.$el.clientHeight -20 ?
                // this.offsetTop > 200 ?
                    this.menuColor = 'background-image: linear-gradient(to right top, #845EC2, #D65DB1, #FF6F91, #FF9671, #FFC75F,#F9F871);background-size:cover;':
                    this.menuColor = 'background-color: transparent;';
            },
            toggleMiniDrawer(){

                window.events.$emit('OpenMiniDrawer');
            },
            minifyDrawer(){
                window.events.$emit('minifyDrawer');

            },
            setPageBackground(){
                switch(this.$route.name){
                    case 'shop':
                        return 'shop_background'
                    case 'home':
                        return 'home_background'

                }
            }

        },
        beforeCreate(){
                //preparing all ajax requests once
                this.$store.dispatch('fetchCart');
                this.$store.dispatch('loadAllCategories');
                this.$store.dispatch('loadAllProducts');


        }

    }
</script>

<style>

    .slide-left-enter-active {
        animation: zoomInDown .2s ease;
    }
    .slide-left-leave-active {
        animation: zoomOutDown .1s ease-out;
    }
    .slide-right-enter-active {
        animation: zoomInUp .2s ease;
    }
    .slide-right-leave-active {
        animation: zoomOutUp .1s ease-out;
    }

</style>