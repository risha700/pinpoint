<template>
    <div>
        <mini-drawer></mini-drawer>

        <!--Menu-->
        <v-toolbar fixed  app dense card nudge-top fadeIn v-scroll="onScroll"
                   :color="menuColor? menuColor :'transparent' "


        >


            <portal-target name="toggleDrawerHandler"></portal-target>


            <div class="uk-navbar-center">
                <v-toolbar-title class="uk-text-primary">
                    <img src="logo.svg" width="50" height="60" alt=""
                         style="stroke: #6a1b9a;stroke-width:20px"
                         uk-svg>
                </v-toolbar-title></div>
            <v-spacer></v-spacer>

            <!--toolbar buttons vuerouter-->
            <v-toolbar-items class="hidden-sm-and-down" v-for="(menu, index) in router.options.routes" :key="index" v-if="menu.component.name !='Checkout'">
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
        <portal-target name="hero"></portal-target>
        <v-content @click.native="minifyDrawer">

            <v-layout row wrap>
                <flash></flash>
                <v-container>
                    <router-view></router-view>
                </v-container>
            </v-layout>

            <!--<v-container grid-list-md text-xs-center>-->

            <!--</v-container>-->
        </v-content>

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
                color:'',
                cards: [
                    { text: 'hello hello',  icon:'check_circle_outline'},
                    { text: 'Bar Bar' ,icon:'face'},
                    { text: 'Foo FOO' ,icon:'flight_takeoff'},
                ],


            }
        },


        methods:{
            onScroll (e) {
                this.offsetTop = window.pageYOffset || document.documentElement.scrollTop
                this.offsetTop > 200 ? this.menuColor = 'blue-grey lighten-1': this.menuColor = 'transparent';
            },
            toggleMiniDrawer(){

                window.events.$emit('OpenMiniDrawer');
            },
            minifyDrawer(){
                window.events.$emit('minifyDrawer');

            }
        },
        mounted(){
                this.$store.dispatch('fetchCart');
        }

    }
</script>

<style scoped>


</style>