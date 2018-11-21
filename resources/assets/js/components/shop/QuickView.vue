
<template>

    <div>
        <div ref="modal" class="uk-modal-full uk-animation-scale-up" id="" uk-modal>
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






                    <v-form ref="form" v-model="valid" @submit.prevent="onSubmit" @keydown.native.stop="form.errors.clear($event.target.name)" lazy-validation  class="uk-padding">
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
                        <div >
                           <p class="uk-text-lead">Available in</p>
                            <!--<template v-for="(value, key, index) in originalProductOptions(product)">-->
                                    <!--{{key}}-->
                                <!--<select class="uk-select uk-border-rounded" @change="setSelectedVal($event.target.value, key)" >-->
                                    <!--<option v-for="val in value" :value="val" v-model="selected[`options-${key}`]">{{val}}</option>-->
                                <!--</select>-->
                            <!--</template>-->

                            <!--<template v-for="(value, key, index) in prepareProductOptions(product)">-->
                            <template v-for="(value, key, index) in productOptions(product)">
                                <div class="uk-grid uk-animation-scale-up"><p class=" uk-text-muted">{{key}}</p></div>
                                <v-radio-group v-model="form.options[`options-${key}`]" :rules="form.rules.option" row  >
                                    <v-radio class="uk-flex-1 uk-flex-column" v-for="val in value" :value="val" :key="val" :label="val" color="primary"></v-radio>
                                </v-radio-group >
                            </template>
                                <!--<template  v-for="(value, key, index) in originalProductOptions(product)">-->
                                    <!--<p class="uk-card-title uk-heading-divider">{{key}}</p>-->
                                    <!--<div class="uk-grid-match " uk-grid>-->
                                        <!--<div  v-for="val in value" class="uk-card">-->
                                                <!--<span class="uk-card-badge mark-selected uk-border-circle uk-button-primary" uk-icon="icon: check; ratio: 1.5"-->
                                                      <!--v-if="selected[`options-${key}`]==val" ></span>-->
                                                <!--<option class="uk-card uk-card-default uk-card-body uk-card-hover hover-style"-->
                                                        <!--:class="selected[`options-${key}`]==val?'hover-style-active':''"-->
                                                        <!--v-model="selected[`options-${key}`]"-->
                                                        <!--:key="val+index"-->
                                                        <!--@click="setSelectedVal($event.target.value, key)">-->
                                                    <!--{{val}}-->
                                                <!--</option>-->
                                        <!--</div>-->

                                     <!--</div>-->
                                <!--</template>-->


                        </div>

                        <v-btn @click.native.prevent.stop="onSubmit()" class=" uk-margin uk-border-pill " :key="product.id" color="primary">
                            Add to cart <v-icon @click.prevent>add_shopping_cart</v-icon>
                        </v-btn>


                    </v-form>

                </div>
                <!--LOADING INDICATOR-->

                <loading :loading="loading"></loading>

            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'


    export default {
        components: {},
        data(){
            return{
                form:new Form({
                    id:'',
                    name:'',
                    price:'',
                    options:{},
                    rules:{
                        option:[
                            v => !!v || 'Please set your desired option',
                        ],
                    }
                }),
                product:'',
                images:'',
                valid:null,
                loading:false,

            }
        },
        watch:{
            images(){
                if (this.images.length == 0){
                    this.images = [{'path':'/product.jpg'}]
                }
            },
            // options(e){
            //     // console.log(e)
            // }


        },
        computed:{
            ...mapGetters(['productOptions']),
        },
        methods:{

            async onSubmit(){
                if(this.$refs.form.validate()) {
                    await this.$store.dispatch('addToCart', this.form).then(()=>{

                        if(this.$refs.modal){
                            UIkit.modal(this.$refs.modal).hide()
                        }
                        this.form.options =this.form.originalData.options ? this.form.originalData.options: {}


                    }).catch((e)=>{
                        //manually reassign options object
                        // event.options = this.options
                        console.log(e);
                    })


                }

            },

            // setSelectedVal(e, i){
            //
            //     this.$set(this.selected, `options-${i}`, e)
            // },
            presentDescription(val){
                if(typeof val=='string'){
                    let v = val.split('.')
                    return v.filter(e=>!!e)
                }

            },


        },

        created(){
            window.events.$on('quickView', e => {
                this.loading=true
                this.product= e
                this.images = e.photos
                this.form.id = e.id
                this.form.name = e.name
                this.form.price = e.price

                if(UIkit.modal(this.$refs.modal)){
                    UIkit.modal(this.$refs.modal).show();
                }

                this.loading=false

            });


        },

        beforeCreate(){

            // this.$store.dispatch('loadAllProducts')
        },
        mounted(){
        }
    }
</script>

<style scoped>
.key{
    border:solid 2px;
    padding:3px;
}
    .mark-selected{
        max-width: 30px;
        position: absolute;
        top: 10px;
        right: 10px;

    }
</style>