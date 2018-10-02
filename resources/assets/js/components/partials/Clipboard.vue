<template id="t">
    <div class="container">
        <input type="text" v-model="message">
        <button type="button" @click="doCopy">Copy!</button>
    </div>
</template>

<script>
    export default({
        data: function () {
            return {
                message: 'Copy These Text'
            }
        },
        methods: {
        }
    })
</script>

<style scoped>

</style>