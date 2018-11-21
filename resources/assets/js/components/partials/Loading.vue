<template>
    <v-layout align-center justify-center row fill-height v-if="loading" uk-height-viewport>
        <v-progress-circular
                indeterminate
                color="purple"
                :size="100"
                :width="5"
                class="ma-1"

        >Loading...</v-progress-circular>
    </v-layout>

</template>

<script>
    export default {
        name: "Loading",
        props:['loading']
    }
</script>

<style scoped>

</style>