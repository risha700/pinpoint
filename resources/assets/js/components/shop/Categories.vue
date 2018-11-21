<template>
    <div>
        <v-layout grid-list-md text-xs-center v-if="!loading" >

            <v-container row wrap align-center justify-center  >


                <category-menu></category-menu>


                <v-flex
                        d-flex xs12
                        v-for="cat in categories" :key="cat.id">
                    <v-container grid-list-md row wrap :key="cat.id">



                        <v-card-text :class="setStyles(cat)">{{cat.name}}</v-card-text>
                        <sub-category v-if="cat.name=='Lasik Kits'"  :categories="categories"></sub-category>


                            <!--normal category-->

                        <v-layout  row wrap justify-center  v-if="cat.name!='Lasik Kits'" >
                            <v-flex  d-flex v-for="pro in cat.products" :key="pro.id" xs10 sm4 md3>
                                <v-card >
                                    <v-img
                                            :src=" pro.photos.length > 0 ? pro.photos[0].path : '/svg/018-eye-glasses.svg' "
                                            :key="pro.id"
                                            contain
                                            @click.native.prevent="$openModal(pro)"

                                    ></v-img>
                                    <v-card-text d-flex>
                                        <!--temp-->
                                        <router-link :to="{ name: 'product', params: { slug: pro.slug }}"  @click.native="$scrollToTop">{{pro.name}}</router-link>
                                        <div>{{pro.details}}</div>
                                        <div>
                                        <v-badge color="purple">{{pro.price | moneyFormat}}</v-badge>
                                        </div>

                                    </v-card-text>

                                    <div>
                                        <v-btn icon large flat color="orange"  @click.native.prevent="$openModal(pro)">
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
            </v-container>

        </v-layout>

        <!--Loading-->
        <portal to="fullWidth">
            <v-container align-center justify-center row fill-height  v-if="loading">
                <v-progress-circular
                        indeterminate
                        color="purple"
                        :size="100"
                        :width="5"
                        class="ma-1"

                >Loading...</v-progress-circular>
            </v-container>
        </portal>

    </div>
</template>

<script>

    import SubCategory from "./SubCategory";
    import CategoryMenu from "./CategoryMenu";
    export default {
        name: "Categories",
        components: {CategoryMenu, SubCategory},
        data(){
            return{
             loading:false,
            }
        },
        watch: {

            },
        computed:{
          categories(){
              if(this.$route.query.category){
                 return this.$store.state.categories.filter((cat,i)=>{
                      if(cat.slug == this.$route.query.category){
                          return cat
                      }
                  })
              }else{
                  return this.$store.state.categories

              }

          },

        },
        beforeCreate(){
            this.loading=true

        },
        mounted(){
            this.loading=false

        },
        methods:{
            setStyles(cat){
                switch (cat.name)
                {
                    case "Cataract Kits":
                        return 'amber cathead'
                    case "Lasik Kits":
                        return 'primary cathead'
                    case "WearOver Glasses":
                        return 'accent cathead'
                }
            },


        },





    }
</script>

<style >
    .amber {
        background-image: linear-gradient(to left top, #ffea00, #ffb603, #ff8037, #ff495a, #eb1278);

    }
    /*.hover-styles:hover, .hover-styles:hover .uk-fix{*/
        /*border:1.5px solid #5B95DA;*/

    /*}*/
    /*.hover-styles:hover .uk-fix-2{*/
        /*color:#5B95DA;*/

    /*}*/
    .cathead{
        margin-bottom: 2em;
        border: solid 2px;
        color: #fff;
        box-sizing: border-box;
        font-size: 2em;
        font-variant: small-caps;
        box-shadow:0 7px 14px -3px rgba(45,35,66,0.3), 0 2px 4px 0 rgba(45,35,66,0.4), inset 0 -2px 0 0 #cfd1e3;
    }
    .subcategory{
        border:double 3px;
        /*border-radius: 20px 0 ;*/
        margin:1em;
        /*color:#fff;*/
        font-weight:700;
        display:block;
        margin: 0 auto;
        box-shadow: 6px 3px 12px #000;
        background-image: linear-gradient(to top, #ff6e7f, #ff93ab, #ffb7d0, #ffdaec, #fffcfe);
    }
    .shop_background{
        background-color: #cad4d9;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='250' height='30' viewBox='0 0 1000 120'%3E%3Cg fill='none' stroke='%23bdbdbd' stroke-width='10' %3E%3Cpath d='M-500 75c0 0 125-30 250-30S0 75 0 75s125 30 250 30s250-30 250-30s125-30 250-30s250 30 250 30s125 30 250 30s250-30 250-30'/%3E%3Cpath d='M-500 45c0 0 125-30 250-30S0 45 0 45s125 30 250 30s250-30 250-30s125-30 250-30s250 30 250 30s125 30 250 30s250-30 250-30'/%3E%3Cpath d='M-500 105c0 0 125-30 250-30S0 105 0 105s125 30 250 30s250-30 250-30s125-30 250-30s250 30 250 30s125 30 250 30s250-30 250-30'/%3E%3Cpath d='M-500 15c0 0 125-30 250-30S0 15 0 15s125 30 250 30s250-30 250-30s125-30 250-30s250 30 250 30s125 30 250 30s250-30 250-30'/%3E%3Cpath d='M-500-15c0 0 125-30 250-30S0-15 0-15s125 30 250 30s250-30 250-30s125-30 250-30s250 30 250 30s125 30 250 30s250-30 250-30'/%3E%3Cpath d='M-500 135c0 0 125-30 250-30S0 135 0 135s125 30 250 30s250-30 250-30s125-30 250-30s250 30 250 30s125 30 250 30s250-30 250-30'/%3E%3C/g%3E%3C/svg%3E");
        background-size: auto;
        background-repeat: repeat;    }
</style>