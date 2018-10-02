<template>

    <div>
        <v-progress-linear
                :value="progress"
                color="success"
                height="7"
        >

        </v-progress-linear>

        <v-form ref="form" @keydown.native.stop="form.errors.clear($event.target.name)" v-model="valid" lazy-validation>
            <v-stepper v-model="step">
                <v-stepper-header>

                    <v-stepper-step
                            :complete="step > 1" step="1"
                            :rules="[()=>!form.errors.has('name') ]"
                    >Name</v-stepper-step>
                    <v-divider></v-divider>

                    <v-stepper-step
                            :complete="step > 2" step="2"
                            :rules="[()=>!form.errors.has('email') ]"
                    >Email</v-stepper-step>

                    <v-divider></v-divider>

                </v-stepper-header>




                <v-stepper-items>
                    <v-stepper-content step="1">

                        <v-text-field
                                ref="name"
                                v-model="form.name"
                                :rules="nameRules"
                                :counter="20"
                                success
                                outline
                                append-icon="person"
                                :append-outer-icon="this.form.name !='' && this.$refs.name.valid && !form.errors.has('name') ?'check':''"
                                :error-messages="form.errors.get('name')"
                                label="Name"
                                required

                        ></v-text-field>

                        <v-btn
                                color="primary"
                                @click="step++"
                                :disabled="form.errors.any()||!valid||this.form.name =='' "

                        >
                            Continue

                        </v-btn>

                        <v-btn flat>Cancel</v-btn>
                    </v-stepper-content>

                    <v-stepper-content step="2">

                        <v-text-field
                                ref="email"
                                v-model="form.email"
                                :rules="emailRules"
                                label="E-mail"
                                append-icon="mail"
                                :append-outer-icon="this.form.email !='' && this.$refs.email.valid && !form.errors.has('email')  ? 'check':''"
                                :error-messages="form.errors.get('email')"
                                outline
                                success
                                required

                        ></v-text-field>


                        <v-btn
                                color="primary"
                                @click="step++"
                                :disabled="form.errors.any()|| !valid || this.form.email =='' "
                        >
                            Continue
                        </v-btn>

                        <v-btn @click="step--" flat>Back</v-btn>


                        <v-btn
                                @click.prevent="onSubmit"
                                :disabled="form.errors.any()||!valid || this.form.$children ==''"
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
                valid:false,
                steps:2,
                step:1,
                form: new Form({
                    name: '',
                    email:'',
                }),
                nameRules: [
                    v => !!v || 'Name is required',
                    v => (v && v.length <= 20) || 'Name must be less than 20 characters',

                ],
                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+/.test(v) || 'E-mail must be valid'
                ],

            }
        },
        computed: {
            progress() {

                return Math.min(100, this.step  / this.steps *100)
            },
        },
        methods: {
            onSubmit() {
                // console.log(Object.values(this.$vnode.elm).find(input) )
                if(this.$refs.form.validate()){
                    this.form.post('/test')
                        .then(response => {
                            console.log(response);
                            this.$refs.form.reset();
                        })
                        .catch(errors=>console.log(errors));
                }
            },
            setDanger(field) {
                if (this.form.errors.has(field)) {
                    return 'uk-form-danger';
                }
            },


        }
    }
</script>

<style scoped>

</style>
