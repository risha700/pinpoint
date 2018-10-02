<template>


    <div>
        <v-alert
                :value="body"
                :color="level"
                :type="level"
                v-show="show"
                dismissible
                transition="slide-y-transition"
                id="message"
        >
            {{body}}
        </v-alert>
    </div>
</template>

<script>
    export default {


        props:['message'],

        data(){
            return{

                body:this.message,
                level:'success',
                show:false,
                timer:0
            }
        },

        created(){

            if (this.message) {

                this.flash();

            }
            window.events.$on(
                'flash', data =>
                    this.flash(data)

            );


        },
        methods:{

            flash(data){

                if(data){

                    this.body=data.message;
                    this.level = data.level;
                }
                this.show=true;
                this.hide();

            },

            hide(){
                if (this.timer!=0){
                    clearTimeout(this.timer)
                    this.timer = 0
                }
                this.timer =  setTimeout(()=>{
                    this.show = false;
                    },5000);

            },


        }




    }



</script>
<style scoped>


    #message {
        display: flex;
        top: 43px;
        z-index:1000;
        width:100%;
        position: fixed;
    }

</style>