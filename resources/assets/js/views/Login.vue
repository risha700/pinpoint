<template>
    <div>
         <v-container v-if="!user" text-xs-center d-flex class="uk-height-viewport" color="purple">
            <v-container>
<h3 class="uk-heading-line"><p>Login</p></h3>
                <v-form ref="form" v-model="valid" @submit.prevent="onSubmit" @keydown.native.stop="form.errors.clear($event.target.name)" lazy-validation>
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
                            type="email"
                            @keyup.enter.native.stop="enterToClick()"


                    ></v-text-field>
                    <v-text-field
                            v-model="form.password"
                            :rules="rules.password"
                            label="Password"
                            append-icon="lock"
                            :append-outer-icon="!form.password =='' && !form.errors.any()&& valid ? 'check':''"
                            :error-messages="form.errors.get('email')"
                            outline
                            success
                            required
                            type="password"
                            @keyup.enter.native.stop="enterToClick()"

                    ></v-text-field>
                    <v-btn @click.prevent="onSubmit" :loading="loading" :disabled="form.errors.any()||!valid || form.$children =='' || loading">Login</v-btn>
                </v-form>
            </v-container>
        </v-container>

        <v-form v-if="user" @submit.prevent="logout()" xs9>
            <v-btn @click="logout()" @click.native.prevent="logout()"
            >Logout</v-btn>
        </v-form>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data(){
            return{
                loading:false,
                user:window.App.user?window.App.user:false,
                form:new Form({
                    email:null,
                    password:null
                }),
                valid:null,
                rules:{
                    password:[
                        v => !!v || 'Please enter a valid password',

                    ],
                    email:[
                        v => !!v || 'E-mail is required',
                        v => /.+@.+/.test(v) || 'E-mail must be valid'
                    ],
                }

            }
        },
        mounted(){
        },
        methods:{
           async onSubmit(){
                if(this.$refs.form.validate()) {
                   await this.form.post('/login')
                        .then((res) => {
                            this.loading=true
                            this.$router.go(-1)
                            // this.refresh()
                            flash('logged in')
console.log(res)
                       }).catch((error) => console.log(error))
                    // this.$store.commit('login', this.form);
                }
            },
            async logout(){
                await axios.post('logout').then(()=>{
                    this.$router.push({ name: 'home'})
                    this.refresh()
                    flash('logged out')

                })
            },
            enterToClick(){
                return this.onSubmit();
            },
            refresh(){
                setTimeout(()=>{
                    location.reload()
                },100)
            }
        }
    }
</script>

<style scoped>

</style>