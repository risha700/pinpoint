<template>
    <!--<v-card color="transparent" flat data-uk-sticky>-->


    <v-flex   d-flex row >

        <v-container  justify-center v-for="cat in $store.state.categories" :key="cat.id" >
            <v-card
                     class="hover-style" hover raised ripple
                    exact-active-class="hover-style-active"
                    :to="{ name: 'shop', query: { category: cat.slug }}" >
                <v-card-text>
                    {{cat.name}}
                </v-card-text>
            </v-card>
        </v-container>

    </v-flex >
    <!--</v-card>-->
</template>

<script>
    export default {
        name: "CategoryMenu"
    }
</script>

<style scoped>

</style>