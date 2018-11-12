<template >
    <v-navigation-drawer
            :mini-variant.sync="mini"
            v-model="drawer"
            fixed
            hide-overlay
            app
            dark
            stateless
            value="true"
    >
        <v-toolbar flat class="transparent" prominent tabs>
            <v-list class="pa-0">
                <v-list-tile avatar>
                    <v-list-tile-avatar>
                      <!--<img src="/images/pinpointoptics.png" width="120" height="120" alt="">-->
                        <v-icon large>face</v-icon>
                    </v-list-tile-avatar>
                    <v-list-tile-content>
                        <v-list-tile-title></v-list-tile-title>
                    </v-list-tile-content>
                    <v-list-tile-action>
                        <v-btn icon @click.native.stop="mini = !mini">
                            <v-icon>chevron_left</v-icon>
                        </v-btn>
                    </v-list-tile-action>
                </v-list-tile>
            </v-list>
        </v-toolbar>

        <!--routes-->
        <v-list>
            <v-list-tile
                    v-for="(menu, index) in router.options.routes"
                    :key="index" :to="router.options.routes[index].path"
                    @click.native="$scrollToTop"
                    v-if="menu.showInMenu"
            >
                <v-list-tile-action>
                    <v-badge v-show="menu.component.name ==='Cart' && store.state.cart.cartCount>0" color="success" left>
                        <span slot="badge">{{store.state.cart.cartCount}}</span>
                    </v-badge>

                    <v-icon large>{{menu.icon}}</v-icon>
                </v-list-tile-action>

                <v-list-tile-content>
                    <v-list-tile-title>{{menu.component.name}}</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
        <!--routes-ends-->
        <portal to="toggleDrawerHandler">
            <!--<v-toolbar-title style="width: 300px" class="ml-0 pl-3">-->
                <v-toolbar-side-icon v-if="drawer ==false" @click.stop="drawer = !drawer"></v-toolbar-side-icon>
                <v-icon v-if="drawer!=false" @click.stop="drawer = !drawer">close</v-icon>
            <!--</v-toolbar-title>-->
        </portal>

    </v-navigation-drawer>
</template>

<script>
    export default {
        name:'MiniDrawer',
        data () {
            return {
                drawer: false,
                mini: true,
                right: null,
                router:this.$router,
                store:this.$store,

            }
        },

        mounted(){
            // console.log(this.$router)
            window.events.$on('OpenMiniDrawer', () => {
                this.drawer = !this.drawer;
            })

            window.events.$on('minifyDrawer', () => {
                this.mini = true;
            });
        },
    }
</script>

<style scoped>

</style>