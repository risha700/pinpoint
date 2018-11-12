<template>
    <section class="page_404">
        <div class="uk-container">
            <div class="uk-flex-row">
                <div class="uk-width-1-1">
                    <div class="uk-text-center">
                        <div class="four_zero_four_bg">
                            <h1 class="uk-text-center ">404</h1>


                        </div>

                        <div class="contant_box_404">
                            <h3 class="h2">
                                Look like you're lost
                            </h3>

                            <p>the page you are looking for not avaible!</p>

                            <a href="/shop" class="link_404">Go to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>

<script>
    export default {
        name: "PageNotFound"
    }
</script>

<style scoped>

    /*======================
        404 page
    =======================*/


    .page_404{ padding:40px 0; background:#fff; font-family: 'Arvo', serif;
    }

    .page_404  img{ width:100%;}

    .four_zero_four_bg{

        background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
        height: 400px;
        background-position: center;
    }


    .four_zero_four_bg h1{
        font-size:80px;
    }

    .four_zero_four_bg h3{
        font-size:80px;
    }

    .link_404{
        color: #fff!important;
        padding: 10px 20px;
        background: #39ac31;
        margin: 20px 0;
        display: inline-block;}
    .contant_box_404{ margin-top:-50px;}
</style>