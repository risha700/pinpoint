<template>
    <v-container grid-list-md text-xs-center>
        <v-layout row wrap align-content-space-around>

            <v-flex
                    d-flex xs12
                    v-for="cat in categories" :key="cat.id">
                <v-container grid-list-md row wrap :key="cat.id">
                    <v-flex></v-flex>
                    <v-card-text :class="setStyles(cat)">{{cat.name}}</v-card-text>
                        <v-layout row wrap >
                            <v-flex  d-flex v-for="pro in cat.products" :key="pro.id" xs12 md4>
                                <v-card >
                                    <v-img
                                            :src=" pro.photos.length > 0 ? pro.photos[0].path : '/svg/018-eye-glasses.svg' "
                                            :key="pro.id"
                                            contain
                                            @click.native.prevent="openModal(pro)"

                                    ></v-img>
                                    <v-card-text d-flex>
                                        <div>{{pro.name}}</div>
                                        <div>{{pro.details}}</div>
                                        <v-badge >{{pro.price | moneyFormat}}</v-badge>

                                    </v-card-text>

                                    <div>
                                        <v-btn icon large flat color="orange"  @click.native.prevent="openModal(pro)">
                                            <v-icon large>shopping_cart</v-icon>
                                        </v-btn>
                                        <v-btn icon large flat color="yellow" >
                                            <v-icon large>bookmark</v-icon>
                                        </v-btn>
                                    </div>

                                </v-card>
                            </v-flex>
                        </v-layout>

                </v-container>

            </v-flex>
        </v-layout>
        <quick-view></quick-view>

    </v-container>

</template>

<script>
    export default {
        name: "Categories",
        data(){
            return{
             categories:'',
            }
        },
        created(){

            this.loadAllCategories()

        },
        methods:{
             async loadAllCategories(){
                await  axios.get('api/categories').then(({data})=>{this.categories = data})
            },
            setStyles(cat){
                if (cat.id ==1){
                     return 'amber'
                }
                if (cat.id == 2){
                    return 'success'
                }
                if (cat.id == 3){
                    return 'grey'
                }
                if (cat.id == 4){
                    return 'red lighten-5'
                }


            },
            openModal(event){
                window.events.$emit('quickView', event);
            },

        },





    }
</script>

<style scoped>
    .amber {
        background-image: linear-gradient(to left top, #ffea00, #ffb603, #ff8037, #ff495a, #eb1278);

    }
    .hover-styles:hover, .hover-styles:hover .uk-fix{
        border:1px solid #5B95DA;

    }
    .hover-styles:hover .uk-fix-2{
        color:#5B95DA;

    }
</style>