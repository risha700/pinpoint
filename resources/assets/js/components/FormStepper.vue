<template>

    <div>
        <v-progress-linear
            :value="progress"
            :color="color()"
            height="7"
        >

        </v-progress-linear>

         <v-form ref="form" v-model="valid" @submit.prevent="onSubmit" @keydown.native.stop="form.errors.clear($event.target.name)" lazy-validation>
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
                        ref="stepContent"
                        v-for="n in steps"
                        :key="`${n}-content`"
                        :step="n"
                        fill-height
                        fluid
                        pa-2
                >
                            <v-flex xs12 sm6 offset-sm3>

                                <v-text-field
                                v-if="step === 1"
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
                                @keyup.enter.native.stop="enterToClick()"
                                ></v-text-field>


                                <v-text-field
                                v-else-if="step == 2"
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
                                @keyup.enter.native.stop="enterToClick()"

                                ></v-text-field>


                                <v-text-field
                                v-else-if="step == 3"
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
                                @keyup.enter.native.stop="enterToClick()"

                                ></v-text-field>
                                <v-text-field
                                v-else-if="step == 4"
                                v-model="form.address"
                                :rules="rules.address"
                                :counter="40"
                                success
                                outline
                                append-icon="place"
                                @click:append="getLocation()"
                                :append-outer-icon="form.address !='' && !form.errors.has('address')&& valid ?'check':''"
                                :error-messages="form.errors.get('address')"
                                label="Address"
                                required
                                clearable
                                autofocus
                                @keyup.enter.native.stop="enterToClick()"

                                ></v-text-field>



                            </v-flex>

                            <v-btn
                                    flat
                                    v-if="step != 1"
                                    @click="step--"
                            ><v-icon large>arrow_back</v-icon></v-btn>


                            <v-btn
                                    color="primary"
                                    @click="nextStep(n)"
                                    v-if="step != steps"
                                    :disabled="form.errors.any()||!valid || form.$children ==''"

                            >
                                Continue
                            </v-btn>

                            <v-btn
                            @click.prevent="onSubmit"
                            v-if="step === steps"
                            :disabled="form.errors.any()||!valid || form.$children ==''"
                            >Create</v-btn>
                </v-stepper-content>
            </v-stepper-items>
        </v-stepper>

    </v-form>
</div>
</template>

<script>

    export default {
        data() {
            return{
                valid:null,
                steps:4,
                step:1,
                form: new Form({
                    name: '',
                    email:'',
                    phone:'',
                    address:'',
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
            }
        },
        mounted(){
        },
        methods: {
            onSubmit() {
                if(this.$refs.form.validate()){
                    this.form.post('/test2')
                    .then(response => {
                        console.log(response);
                        this.$refs.form.reset();
                        UIkit.notification('Success',  {status:'success'})
                    })
                    .catch(
                        errors=>{
                            console.log(errors.errors);
                            this.reportErr();
                            UIkit.notification(Object.values(errors.errors), {status:'danger'} )
                        }
                    );
                }
            },
            nextStep (n) {
                if (n === this.steps) {
                    this.step = 1
                } else {
                    this.step = n + 1
                    this.setAutoFocus()
                }
            },
            reportErr(){
                let errField = Object.keys(this.form.errors.errors).filter((field)=>field)
                let dataArray = Object.keys(this.form.data())
                dataArray.filter((e,i)=> e == errField[0] ? this.step = i+1 :null)
                this.setAutoFocus()
            },
            stepInputErr(f){
                return this.valid && !this.form.errors.any() && f === this.step || f>this.step || f<this.step
            },
            setAutoFocus(){
              setTimeout(()=>{
                  this.$refs.stepContent[this.step-1].$children[0].focus()
              },500)
            },
            enterToClick(){
                this.$refs.stepContent[this.step-1].$children[1].$el.click()
            },
            color(){
                if(this.form.errors.any() || !this.valid){
                    return 'warning'
                }else {
                    return 'success'
                }
            },
            getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition((location) =>{
                        let latitude = location.coords.latitude
                        let longitude = location.coords.longitude
                        let apiKey = '&?key=AIzaSyBDow6F37BCP8VXNozK60grjdloSEz_c5c'
                        let accuracy = location.coords.accuracy
                        let instance = axios.create()
                        delete instance.defaults.headers.common['X-CSRF-TOKEN']
                        delete instance.defaults.headers.common['X-Requested-With']
                        let url= 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+latitude+','+longitude+apiKey
                        instance({method:'GET',url:url})
                            .then(res=> this.form.address = res.data.results[0].formatted_address)
                            .catch(error=>console.log(error))

                    })

                } else {
                    console.log('Not Supported')
                }
            },


        }
    }
</script>

<style scoped>

</style>
