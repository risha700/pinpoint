<template>
    <div>
        <portal to="hero">
            <v-responsive
                    class="uk-height-small uk-position-top uk-padding-medium-top"
                    style="background-image: linear-gradient(to right top, #845EC2, #D65DB1, #FF6F91, #FF9671, #FFC75F,#F9F871);background-size:cover;"
                    dark
            >
                <v-container  fill-height>
                    <v-layout align-center>
                        <v-container text-xs-center>
                            <transition
                                    name="fadeInUp"
                                    enter-active-class="animated fadeInUp"
                                    leave-active-class="animated fadeOutDown"
                            >
                                <div class=" uk-heading-line"><h3 class="display-1 page_name">Login</h3></div>
                            </transition>
                        </v-container>
                    </v-layout>
                </v-container>
            </v-responsive>
        </portal>

        <v-container v-if="!user" text-xs-center d-flex  >
            <v-container class="uk-card-default uk-margin-medium-top uk-border-rounded">
                <h3 class="uk-heading-line"><p class="uk-text-lead">Login</p></h3>
                <v-form ref="loginForm" v-model="valid" @submit.prevent="onSubmit" @keydown.native.stop="form.errors.clear($event.target.name)" lazy-validation class="uk-width-1-2@m uk-text-center uk-align-center">
                    <v-text-field
                            v-model="form.email"
                            :rules="rules.email"
                            label="E-mail"
                            append-icon="mail"
                            :error-messages="form.errors.get('email')"
                            outline
                            success
                            clearable
                            required
                            type="email"
                            @keyup.enter.native.stop="enterToClick()"
                    ></v-text-field>
                    <v-text-field
                            v-model="form.password"
                            :rules="rules.password"
                            label="Password"
                            append-icon="lock"
                            outline
                            clearable
                            success
                            required
                            type="password"
                            @keyup.enter.native.stop="enterToClick()"

                    ></v-text-field>
                    <v-btn @click.prevent="onSubmit" :loading="loading" :disabled="form.errors.any()||!valid || form.$children =='' || loading">Login</v-btn>
                    <div class=" uk-align-right uk-flex uk-flex-column">
                        <a class="uk-text-left uk-text-bold" href="#">Sign Up! </a>
                        <a  class="uk-text-left uk-text-bold" href="#">Reset password</a>
                    </div>
                </v-form>

            </v-container>
        </v-container>

        <v-form v-if="user" @submit.prevent="logout()" xs9>
            <v-btn @click="logout()" @click.native.prevent="logout()" :loading="loading"
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
                redirect:'',
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
        created(){
            // console.log(this)
        },
        beforeRouteEnter(to,from,next){
            next(vm=>from.name !=null ? vm.redirect = from :false)
        },
        methods:{
           async onSubmit(){
               this.loading=true
                if(this.$refs.loginForm.validate()) {
                    await this.$store.dispatch('login',this.form)
                        .then(()=>{
                            if(this.redirect){
                                this.$router.go(-1)
                            }else{
                                this.$router.push({name:'home'})
                            }
                            this.refresh()
                            flash(`Welcome back`)

                        }).catch(()=>{
                            // flash(this.form.errors.get('email'), 'error')
                            this.loading = false;
                        })

                }
            },
            async logout(){
                this.loading=true
                await axios.post('logout').then(()=>{
                    this.$router.push({ name: 'home'})
                    this.refresh()
                    flash('Logged Out')



                })
            },
            enterToClick(){
                //moking native submit
                if(this.$refs.loginForm.validate()) {
                    return this.onSubmit();
                }
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