<template>
    <v-layout row>
        <v-flex xs12 sm6 offset-sm3>
            <v-card height="500" class="uk-overflow-auto">
                <v-toolbar color="teal" dark>
                    <v-toolbar-side-icon></v-toolbar-side-icon>

                    <v-toolbar-title class="text-xs-center">New Chat</v-toolbar-title>

                    <v-spacer></v-spacer>

                    <v-btn icon>
                        <v-icon>search</v-icon>
                    </v-btn>
                </v-toolbar>

                <v-list subheader>
                    <v-subheader>Recent chat</v-subheader>
                    <v-list-tile
                            v-for="(product,index) in $store.state.cartProductList"

                            :key="index"
                            avatar
                            @click=""
                    >
                        <v-list-tile-avatar>
                            <!--<img :src="item.avatar">-->
                        </v-list-tile-avatar>

                        <v-list-tile-content>
                            <v-list-tile-title v-html="product.price"></v-list-tile-title>
                        </v-list-tile-content>

                        <v-list-tile-action>
                            <!--<v-icon :color="item.active ? 'teal' : 'grey'">chat_bubble</v-icon>-->
                        </v-list-tile-action>
                    </v-list-tile>
                </v-list>

                <v-divider></v-divider>

                <v-list subheader>
                    <v-subheader>Previous chats</v-subheader>

                    <v-list-tile
                            v-for="(product,index) in $store.state.cartProductList"
                            :key="index"
                            avatar
                            @click=""
                    >
                        <v-list-tile-avatar>
                            <!--<img :src="item.avatar">-->
                        </v-list-tile-avatar>

                        <v-list-tile-content>
                            <v-list-tile-title v-html="product.name"></v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
            </v-card>
        </v-flex>
    </v-layout>
</template>
<script>
    export default {
        data () {
            return {
                items: [
                    { active: true, title: 'Jason Oner', avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg' },
                    { active: true, title: 'Ranee Carlson', avatar: 'https://cdn.vuetifyjs.com/images/lists/2.jpg' },
                    { title: 'Cindy Baker', avatar: 'https://cdn.vuetifyjs.com/images/lists/3.jpg' },
                    { title: 'Ali Connors', avatar: 'https://cdn.vuetifyjs.com/images/lists/4.jpg' }
                ],
                items2: [
                    { title: 'Travis Howard', avatar: 'https://cdn.vuetifyjs.com/images/lists/5.jpg' }
                ]
            }
        },
        beforeCreate(){
            //make product stock available
            this.$store.dispatch('loadAllProducts')
        }
    }
</script>

<style scoped>

</style>