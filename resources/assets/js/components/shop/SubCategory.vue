<template>
        <v-layout  row wrap justify-center>
                <v-flex d-flex  v-for="(sub,i) in subcategories"  :class="setBackground(i)" :key="i" justify-center>

                    <v-flex  v-if="i=='POLK - Deluxe Kit'" v-for="(pro,index) in sub"  :key="index"  xs10 >
                        <p class="subcategory" v-if="i=='POLK - Deluxe Kit'">{{i}}</p>

                        <v-card>
                                <v-img
                                        :src=" pro.photos.length > 0 ? pro.photos[0].path : '/svg/018-eye-glasses.svg' "
                                        :key="pro.id"
                                        contain
                                        @click.native.prevent="$openModal(pro)"

                                ></v-img>
                                <v-card-text d-flex>
                                    <!--temp-->
                                    <router-link  :to="{ name: 'product', params: { slug: pro.slug }}" @click.native="$scrollToTop">{{pro.name}}</router-link>
                                    <div>{{pro.details}}</div>
                                    <v-badge color="success">{{pro.price | moneyFormat}}</v-badge>

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

<!--list for components & pouches -->


                    <v-card v-if="i!='POLK - Deluxe Kit'">
                        <p class="subcategory">{{i}}</p>
                        <v-list three-line subheader>
                            <!--<v-subheader inset><p class="subcategory">{{i}}</p></v-subheader>-->

                            <v-list-tile
                                    v-for="(pro,index) in sub" :key="index"
                                    avatar
                                    @click=""
                                    :to="{ name: 'product', params: { slug: pro.slug }}"
                                    @click.native="$scrollToTop"
                            >
                                <!--buggy avatar directive-->
                                <!--<v-list-tile-avatar>-->
                                    <!--<v-img-->
                                            <!--:src=" pro.photos.length > 0 ? pro.photos[0].path : '/svg/018-eye-glasses.svg' "-->
                                            <!--:key="pro.id"-->
                                            <!--contain-->
                                            <!--@click.native.prevent="$openModal(pro)"-->

                                    <!--&gt;</v-img>-->
                                <!--</v-list-tile-avatar>-->

                                <v-list-tile-content>
                                    <!--<v-list-tile-title :to="`#/shop/${pro.slug}`">{{pro.name}}</v-list-tile-title>-->
                                    <v-list-tile-title>{{pro.name}}</v-list-tile-title>
                                    <v-badge >{{pro.price | moneyFormat}}</v-badge>
                                    <v-list-tile-sub-title>{{pro.details}}</v-list-tile-sub-title>
                                </v-list-tile-content>

                                <v-list-tile-action>
                                    <v-btn icon ripple @click.native.prevent="$openModal(pro)">
                                        <v-icon color="orange lighten-1">shopping_cart</v-icon>
                                    </v-btn>
                                </v-list-tile-action>

                            </v-list-tile>
                        </v-list>
                    </v-card>
                </v-flex>
        </v-layout>

</template>

<script>
    export default {
        name: "SubCategory",
        props:['categories'],
        computed:{
            subcategories(){
                let sub1=[];
                let sub2=[];
                let sub3=[];
                let temp=Object.create(null);
                let cat = this.categories.find((p)=> p.name == 'Lasik Kits')
                cat.products.filter((product)=>{

                    if(product.id==6 || product.id==7){
                        sub1.push(product)
                        temp['POLK - Deluxe Kit']=sub1

                    }
                    if(product.id>=8 && product.id<=11){
                        sub2.push(product)
                        temp['Pouches']=sub2

                    }
                    if(product.id>11){
                        sub3.push(product)
                        temp['Components']=sub3

                    }
                });
                return temp;

            }

        },
        methods:{
            setBackground(sub){
                switch (sub)
                {
                    case "POLK - Deluxe Kit":
                        return 'sub1 sub'
                        break;

                    case "Pouches":
                        return 'sub sub2'
                        break;

                    case "Components":
                        return 'sub sub3'
                        break;


                }


            },

        }
    }
</script>

<style scoped>

</style>