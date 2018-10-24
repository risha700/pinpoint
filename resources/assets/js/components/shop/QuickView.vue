
<template>

    <div>
        <div ref="modal" class="uk-modal-full" id="quickModal" uk-modal>
            <div class="uk-modal-dialog">
                <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
                <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid  uk-height-viewport>


                    <div class="uk-position-relative uk-flex uk-flex-middle uk-grid-divider" uk-slideshow="animation: fade" >

                        <div class="uk-position-small uk-width-1-3 ">
                            <ul class="uk-thumbnav uk-thumbnav-vertical"  uk-margin>



                                <li v-for="(image,index) in images" :uk-slideshow-item="index" :key="index">


                                    <a href=""><img :src="image.path" width="100" :alt="product.name" :key="index"></a>

                                </li>


                            </ul>
                        </div>

                        <!-- lightbox -->

                        <div class="uk-position-small uk-width-3-1" >
                            <ul class="uk-slideshow-items" uk-lightbox="animation: slide">

                                <li class="uk-flex uk-flex-middle" v-for="(image,index) in images" >
                                    <a class="uk-inline" :href="image.path" :data-caption="product.name" :key="index">

                                        <img :src="image.path"  :alt="product.name" :key="index">
                                    </a>
                                </li>
                            </ul>
                        </div>


                    </div>






                    <div class="uk-padding">
                        <h1 class="uk-heading-bullet"> {{product.name}}</h1>
                        <p>{{product.description}}</p>
                        <p>
                            <span uk-icon="icon: tag"></span>
                            {{product.details}}
                        </p>
                        <p>  {{product.price | moneyFormat}} <span class="uk-sub">each</span></p>
                        <div v-if="this.options.length > 0">
                           <p >Available in</p>
                            <template v-for="(value, key, index) in originalProductOptions(product)">
                                    {{key}}
                                <select class="uk-select uk-border-rounded" @change="setSelectedVal($event.target.value, key)" >
                                    <option v-for="val in value" :value="val" v-model="selected">{{val}}</option>
                                </select>
                            </template>

                            <!--<v-select :items="originalProductOptions(product)" label="choose color" @change="setSelectedVal($event)" >-->
                                <!--<input type="hidden" v-model="selected" name="options"/>-->
                            <!--</v-select>-->
                            <!--<v-radio-group v-model="selected">-->
                                <!--<v-radio-->
                                        <!--v-for="(p,i) in originalProductOptions(product)"-->
                                        <!--:key="i"-->
                                        <!--:label="`${p}`"-->
                                        <!--:value="p"-->
                                <!--&gt;</v-radio>-->
                            <!--</v-radio-group>-->
                        </div>
                        <v-btn @click.native.prevent.stop="sendItemToCart(product)" class="uk-button primary uk-border-rounded" :key="product.id">
                            Add to cart <v-icon @click.prevent>add_shopping_cart</v-icon>
                        </v-btn>


                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    let temp=[];

    export default {
        data(){
            return{
                product:'',
                images:'',
                options:'',
                selected:{},

            }
        },
        watch:{
            images(){
                if (this.images.length == 0){
                    this.images = [{'path':'/product.jpg'}]
                }
            },

        },
        computed:{
            // ...mapGetters(['productOptions']),

        },
        methods:{
            sendItemToCart(event){


                if(this.options && this.selected){
                    event.options = this.selected
                }



                this.$store.dispatch('addToCart', event);

                if(this.$refs.modal){
                    UIkit.modal(this.$refs.modal).hide()
                }
                this.product=''
                this.images=''
                this.options = ''
                this.selected={}
            },
            setSelectedVal(e, i){
                  this.$set(this.selected, `options-${i}`, e)
            },
            originalProductOptions(data){
                let product = this.$store.state.cartProductList.find(i=>i.id==data.id)
                let obj = Object.values(product.options)


                function mergeNames (arr) {
                    return _.chain(arr).groupBy('name').mapValues(function (v) {
                        return _.chain(v).mapValues('type').value()
                    }).value();
                }

                return mergeNames(obj)
            }

        },
        created(){
            window.events.$on('quickView', e => {
                this.product = e
                this.images = e.photos
                //read from getters??
                // if(!Array.isArray(this.options)){
                //     this.options = this.manualForceUpdate(e)

                // }
                this.options = e.options
                if(UIkit.modal(this.$refs.modal)){
                    UIkit.modal(this.$refs.modal).show();
                }
            });

        },

        beforeCreate(){
            //quick and dirty to make options available
            this.$store.dispatch('loadAllProducts')
        }
    }
</script>

<style scoped>

</style>