<template>
    <div>
        <form method="POST" action="/test2" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)" novalidate>
            <v-stepper v-model="e1">

                <v-stepper-header>
                    <v-stepper-step :complete="e1 > 1" step="1"
                                    :rules="[()=>!form.errors.has('name') , ()=>!form.errors.has('email') ]"
                    >Account Information</v-stepper-step>

                    <v-divider></v-divider>

                    <v-stepper-step :complete="e1 > 2"  step="2"
                                    :rules="[()=>!form.errors.has('phone'), ()=>!form.errors.has('address1')]"
                    >Personal Information</v-stepper-step>

                    <v-divider></v-divider>

                    <v-stepper-step step="3">Payment Information</v-stepper-step>
                </v-stepper-header>

                <v-stepper-items>
                    <v-stepper-content step="1">
                        <v-container>
                                <label for="name" class="uk-label">Name</label>

                                <input type="text" id="name" name="name" class="uk-input" v-model="form.name" :class="setDanger('name')" >

                                <span class="uk-alert-danger" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>

                                <label for="email" class="uk-label">Email</label>

                                <input type="email" id="email" name="email" class="uk-input" v-model="form.email" :class="setDanger('email')">

                                <span class="uk-alert-danger" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>

                        </v-container>

                        <v-btn
                                color="primary"
                                @click="nextWithSanizie"
                        >
                            Continue
                        </v-btn>

                        <v-btn flat>Cancel</v-btn>
                    </v-stepper-content>

                    <v-stepper-content step="2">
                        <v-container>


                                <v-label for="phone" class="uk-label">Phone</v-label>
                                <input type="phone" id="phone" name="phone" class="uk-input" v-model="form.phone" :class="setDanger('phone')">

                                <span class="uk-alert-danger" v-if="form.errors.has('phone')" v-text="form.errors.get('phone')"></span>

                                <label for="address1" class="uk-label">Address1</label>

                                <input type="text" id="address1" name="address1" class="uk-input" v-model="form.address1" :class="setDanger('address1')">

                                <span class="uk-alert-danger" v-if="form.errors.has('address1')" v-text="form.errors.get('address1')"></span>

                        </v-container>

                        <v-btn
                                color="primary"
                                @click="nextWithSanizie"
                        >
                            Continue
                        </v-btn>

                        <v-btn flat>Cancel</v-btn>
                    </v-stepper-content>

                    <v-stepper-content step="3">
                        <v-card
                                class="mb-5"
                                color="grey lighten-1"
                                height="200px"
                        ></v-card>

                        <v-btn
                                color="primary"
                                @click="nextWithSanizie(3)"
                        >
                            Continue
                        </v-btn>
                        <div class="control">
                            <button class="uk-button uk-button-primary" :disabled="form.errors.any()">Create</button>
                        </div>

                        <v-btn flat>Cancel</v-btn>
                    </v-stepper-content>
                </v-stepper-items>
            </v-stepper>





        </form>
    </div>
</template>

<script>
    export default {
        name: "CheckoutStepper",
        data(){
            return{
                form: new Form({
                   name:'',
                   email:'',
                   phone:'',
                   address1:'',
                   // address2:'',
                   // country:'',
                   // city:'',
                   // zip:'' ,
                }),
                e1: 0,
                // rules:[]
            }
        },
        methods: {
            onSubmit() {
                this.form.post('/test2')
                    .then(response => console.log(response))
                    .catch(errors=>[console.log(errors), this.rules = errors.errors]);
            },
            setDanger(field) {
                if (this.form.errors.has(field)) {
                    return 'uk-form-danger';
                }
            },
            nextWithSanizie(e){
                console.log(e);
                if (e == 3){
                    this.e1 = 1;
                    return;
                }
                this.e1++;
            },

        }

    }
</script>

<style scoped>

</style>