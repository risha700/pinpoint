<template>
    <div>
        <v-progress-linear
                :value="progress"
                :color="color()"
                height="7"
        >

        </v-progress-linear>

        <v-form ref="form" v-model="valid" @submit.prevent="onSubmit" @keydown.native.stop="form.errors.clear($event.target.name)" lazy-validation id="payment-form">


            <v-stepper v-model="step" ref="stepper">

                <v-stepper-header>
                    <template v-for="n in steps">
                        <v-stepper-step
                                :complete="step > n"
                                :key="`${n}-step`"
                                :step="n"
                                :rules="[()=>stepInputErr(n)]"
                        >
                            Step {{ n }}
                        </v-stepper-step>

                        <v-divider
                                v-if="n !== steps"
                                :key="n"
                        ></v-divider>
                    </template>
                </v-stepper-header>

                <v-stepper-items>
                    <v-stepper-content
                            step="1"
                            fill-height
                            fluid
                            pa-2
                    >
                            <v-flex  xs12 sm6 text-xs-center offset-sm3>
                                <h3>Personal Information</h3>

                                <v-text-field

                                        v-model="form.name"
                                        :rules="rules.name"
                                        :counter="20"
                                        success
                                        outline
                                        append-icon="person"
                                        :append-outer-icon="form.name !='' && !form.errors.has('name')&&valid ?'check':''"
                                        :error-messages="form.errors.get('name')"
                                        label="Name"
                                        required
                                        clearable
                                        autofocus
                                        type="text"
                                ></v-text-field>
                                <v-text-field

                                        v-model="form.email"
                                        :rules="rules.email"
                                        label="E-mail"
                                        append-icon="mail"
                                        :append-outer-icon="!form.email =='' && !form.errors.has('email')&& valid ? 'check':''"
                                        :error-messages="form.errors.get('email')"
                                        outline
                                        success
                                        required
                                        clearable
                                        autofocus
                                        type="email"

                                ></v-text-field>
                                <v-text-field

                                        v-model="form.phone"
                                        :rules="rules.phone"
                                        :counter="20"
                                        success
                                        outline
                                        append-icon="call"
                                        :append-outer-icon="form.phone !='' && !form.errors.has('phone') && valid ?'check':''"
                                        :error-messages="form.errors.get('phone')"
                                        label="Phone"
                                        required
                                        clearable
                                        autofocus
                                        type="tel"
                                        mask="phone"

                                ></v-text-field>
                            </v-flex>
                    </v-stepper-content>
                    <v-stepper-content
                            step="2"
                            fill-height
                            fluid
                            pa-2
                    >
                        <v-flex  xs12 sm6 text-xs-center offset-sm3>

                            <v-text-field
                                        v-model="form.address"
                                        :rules="rules.address"
                                        :counter="40"
                                        success
                                        outline
                                        append-icon="place"
                                        :append-outer-icon="form.address !='' && !form.errors.has('address')&& valid ?'check':''"
                                        :error-messages="form.errors.get('address')"
                                        label="Address"
                                        required
                                        clearable
                                        autofocus

                                ></v-text-field>


                                <v-text-field
                                        v-model="form.country"
                                        :rules="rules.country"
                                        label="Country"
                                        :append-outer-icon="!form.country =='' && !form.errors.has('country')&& valid ? 'check':''"
                                        :error-messages="form.errors.get('country')"
                                        outline
                                        success
                                        required
                                        clearable
                                        type="text"

                                ></v-text-field>
                                <v-text-field
                                        v-model="form.state"
                                        :rules="rules.state"
                                        label="State"
                                        :append-outer-icon="!form.state =='' && !form.errors.has('state')&& valid ? 'check':''"
                                        :error-messages="form.errors.get('state')"
                                        outline
                                        success
                                        required
                                        clearable
                                        type="text"

                                ></v-text-field>
                                <v-text-field
                                        v-model="form.city"
                                        :rules="rules.city"
                                        label="City"
                                        :append-outer-icon="!form.city =='' && !form.errors.has('city')&& valid ? 'check':''"
                                        :error-messages="form.errors.get('city')"
                                        outline
                                        success
                                        required
                                        clearable
                                        type="text"

                                ></v-text-field>
                                <v-text-field
                                        v-model="form.zip"
                                        :rules="rules.zip"
                                        label="Zip"
                                        :append-outer-icon="!form.zip =='' && !form.errors.has('zip')&& valid ? 'check':''"
                                        :error-messages="form.errors.get('zip')"
                                        outline
                                        success
                                        required
                                        clearable
                                        type="text"

                                ></v-text-field>
                        </v-flex>
                    </v-stepper-content>
                    <v-stepper-content
                            step="3"
                            fill-height
                            fluid
                            pa-2
                    >

                        <v-flex  xs12 sm6 text-xs-center offset-sm3>


                            <stripe-card></stripe-card>
                        </v-flex>
                    </v-stepper-content>

                        <v-btn
                                flat
                                v-if="step != 1"
                                @click="step--"
                        ><v-icon large>arrow_back</v-icon></v-btn>


                        <v-btn
                                color="primary"
                                @click="step++"
                                v-if="step != steps"
                                :disabled="form.errors.any()||!valid || form.$children ==''"

                        >
                            Continue
                        </v-btn>

                        <v-btn
                                @click.prevent="onSubmit"
                                :loading="loading"
                                v-if="step === steps"
                                :disabled="form.errors.any()||!valid || form.$children =='' || loading"
                        >Purchase</v-btn>
                </v-stepper-items>
            </v-stepper>

        </v-form>
    </div>

</template>

<script>
    import StripeCard from "../components/shop/StripeCard";
    export default {
        name:'Checkout',
        components: {StripeCard},
        data() {
            return{
                loading:false,
                valid:null,
                steps:3,
                step:1,
                form: new Form({
                    name: '',
                    email:'',
                    phone:'',
                    address:'',
                    country:'',
                    state:'',
                    city:'',
                    zip:'',
                    stripeToken:'',
                    last4:''

                }),
                rules:{
                    name:[
                        v => !!v || 'Name is required',
                        v => (v && v.length <= 20) || 'Name must be less than 20 characters',
                    ],
                    email:[
                        v => !!v || 'E-mail is required',
                        v => /.+@.+/.test(v) || 'E-mail must be valid'
                    ],
                    phone:[
                        v => !!v || 'Phone is required',
                    ],
                    address:[
                        v => !!v || 'Address is required',
                        v => (v && v.length <= 40) || 'Address must be less than 40 characters',
                    ],
                    city:[
                        v => !!v || 'City is required',
                    ],
                    country:[
                        v => !!v || 'Country is required',
                    ],
                    state:[
                        v => !!v || 'State is required',
                    ],
                    zip:[
                        v => !!v || 'Zip code is required',
                    ],
                }


            }
        },
        computed: {
            progress() {

                return Math.min(100, this.step  / this.steps *100)
            }
        },
        watch: {
            steps (val) {
                if (this.step > val) {
                    this.step = val
                }
            },
            // form(val){
            //     window.events.$on('tokenCreated', (token)=>{
            //         this.form.last4 = token.card.last4
            //         this.form.stripeToken = token.id
            //     })
            // }
        },
        mounted() {

        },
        methods: {
            // onSubmit() {
            //     if(this.$refs.form.validate()){
            //         this.loading = !this.loading;
            //         window.events.$emit('payNow');
            //         window.events.$on('tokenCreated', (token)=>{
            //             this.form.last4 = token.card.last4
            //             this.form.stripeToken = token.id
            //             this.form.post('/checkout')
            //                 .then(response => {
            //                     console.log(['succeeeeeed:'+response]);
            //                     this.$refs.form.reset();
            //                     this.loading = !this.loading
            //                     // window.location.replace(window.location.origin);
            //                     UIkit.notification('order in process',  {status:'success'})
            //                 })
            //                 .catch(
            //                     ({errors}) => {
            //                         console.log('fail:'+Object.values(errors));
            //                         this.reportErr();
            //                         UIkit.notification(errors, {status:'danger'} )
            //                         this.loading = !this.loading;
            //
            //                     }
            //                 );
            //
            //         });
            //
            //     }
            // },
            onSubmit() {
                if(this.$refs.form.validate()){
                    this.loading = !this.loading;
                    window.events.$emit('payNow');
                    window.events.$on('tokenCreated', (token)=>{
                        this.form.last4 = token.card.last4
                        this.form.stripeToken = token.id
                        this.form.post('/checkout')
                            .then(response => {
                                console.log('successCheckout:'+response);
                                this.$refs.form.reset();
                                // window.location.replace(window.location.origin);
                                UIkit.notification(response,  {status:'success'})
                                this.loading = false;

                            })
                            .catch(
                                errors => {
                                    console.log('failCheckout:'+ Object.values(errors.errors));
                                    this.reportErr();
                                    UIkit.notification(Object.values(errors.errors), {status:'danger'} )
                                    this.loading = false;


                                }
                            );

                    });

                }
            },
            nextStep (n) {
                if (n === this.steps) {
                    this.step = 1
                } else {
                    this.step = n + 1
                }
            },
            reportErr(){
                let errField = Object.keys(this.form.errors.errors).filter((field)=>field)
                let dataArray = Object.keys(this.form.data())
                // dataArray.filter((e,i)=> e == errField[0] ? this.step = i+1 :null)
                dataArray.filter((e,i)=> e == errField[0] ? this.step = i :null)
            },
            stepInputErr(f){
                return this.valid && !this.form.errors.any() && f === this.step || f>this.step || f<this.step
            },
            color(){
                if(this.form.errors.any() || !this.valid){
                    return 'purple'
                }else {
                    return 'success'
                }
            },

        },

    }

</script>

<style scoped>

</style>