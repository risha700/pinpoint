
<template>

    <div>
        <div ref="modal" class="uk-modal-full uk-animation-scale-up" id="quickModal" uk-modal>
            <div class="uk-modal-dialog" >
                <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
                <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid  uk-height-viewport v-if="!loading">


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






                    <v-form v-model="valid" class="uk-padding" lazy-validation ref="form">
                        <h1 class="uk-heading-bullet"> {{product.name}}</h1>
                        <!--<p>{{product.description}}</p>-->
                        <ul v-for="desc in presentDescription(product.description)">
                            <li v-text="desc">    </li>
                        </ul>
                        <p>
                            <span uk-icon="icon: tag"></span>
                            {{product.details}}
                        </p>
                        <p>  {{product.price | moneyFormat}} <span class="uk-sub">each</span></p>
                        <div v-if="this.options.length > 0">
                           <p class="uk-text-lead">Available in</p>
                            <!--<template v-for="(value, key, index) in originalProductOptions(product)">-->
                                    <!--{{key}}-->
                                <!--<select class="uk-select uk-border-rounded" @change="setSelectedVal($event.target.value, key)" >-->
                                    <!--<option v-for="val in value" :value="val" v-model="selected[`options-${key}`]">{{val}}</option>-->
                                <!--</select>-->
                            <!--</template>-->

                            <template v-for="(value, key, index) in originalProductOptions(product)">
                                <div class="uk-grid uk-animation-scale-up"><p class=" uk-text-muted">{{key}}</p></div>
                                <v-radio-group v-model="selected[`options-${key}`]" @change="setSelectedVal($event,key)" :rules="rules.option" row>
                                    <v-radio class="uk-flex-1 uk-flex-column" v-for="val in value" :value="val" :key="val+index" :label="val"></v-radio>
                                </v-radio-group >
                            </template>

                        </div>
                        <v-btn @click.native.prevent.stop="sendItemToCart(product)" class="uk-button primary uk-border-rounded" :key="product.id">
                            Add to cart <v-icon @click.prevent>add_shopping_cart</v-icon>
                        </v-btn>


                    </v-form>

                </div>
                <!--LOADING-->
                <v-layout align-center justify-center row fill-height v-if="loading" uk-height-viewport>
                    <v-progress-circular
                            indeterminate
                            color="purple"
                            :size="100"
                            :width="5"
                            class="ma-1"

                    >Loading...</v-progress-circular>
                </v-layout>

            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    let temp=[];

    export default {
        components: {},
        data(){
            return{
                product:'',
                images:'',
                options:'',
                selected:{},
                valid:null,
                rules:{
                    option:[
                        v => !!v || 'Please set your desired option',
                    ],
                },
                loading:false,

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

                if(this.$refs.form.validate()) {

                        this.$store.dispatch('addToCart', event);
                    if(this.$refs.modal){
                        UIkit.modal(this.$refs.modal).hide()
                    }
                    this.product=''
                    this.images=''
                    this.options = ''
                    this.selected={}

                }

            },
            setSelectedVal(e, i){

                this.$set(this.selected, `options-${i}`, e)
            },
            presentDescription(val){
                if(typeof val=='string'){
                    let v = val.split('.')
                    return v.filter(e=>!!e)
                }

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
            this.loading=true

            window.events.$on('quickView', e => {
                this.product = e
                this.images = e.photos
                this.options = e.options
                if(UIkit.modal(this.$refs.modal)){
                    UIkit.modal(this.$refs.modal).show();
                }
            });
            this.loading=false

        },

        beforeCreate(){
            this.$store.dispatch('loadAllProducts')
        }
    }
</script>

<style scoped>
.key{
    border:solid 2px;
    padding:3px;
}
</style>