<template>
    <div>
        <portal to="hero">
            <v-responsive class="uk-height-large hero"

            style="background-image: url('/svg/diagonal-lines.svg'), linear-gradient(to right top, #845EC2, #D65DB1, #FF6F91, #FF9671, #FFC75F,#F9F871);
            background-repeat:repeat;
            background-position: center bottom;
            background-size:inherit;
            background-blend-mode:soft-light; "


            >

                <v-container  fill-height>
                    <v-layout align-center>
                        <v-flex text-xs-center>

                            <h3 class="display-3">Clearly The BEST</h3>

                        </v-flex>
                    </v-layout>
                </v-container>
            </v-responsive>
        </portal>


        <h1>Home content</h1>

    </div>
</template>

<script>
    export default {

        name: "Home",
        data(){
            return{
                gradient: 'to right top, rgb(132,94,194, .7), rgb(214,93,177, .7), rgb(255,111,145, .7), rgb(255,150,113, .7), rgb(255,199,95, .7),rgb(249,248,113, .7)',
            }
        },
        mounted(){
            // axios.get('/api/product').then((data)=>console.log(data)).catch((error)=>console.log(error))
        }


    }
</script>

<style >
    .hero{


    }
    /*.home_background{*/
        /*background-image: url('/svg/floral-1.svg'),linear-gradient(to right bottom, #1143572b, #45587e00, #8469974f, #c37a9c42, #f2949217);*/
        /*background-position: bottom center;*/
        /*background-blend-mode: soft-light;*/
        /*background-repeat: repeat;*/
        /*background-size: cover;*/
    /*}*/

</style>