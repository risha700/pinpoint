<template>
    <form method="POST" action="/test" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
        <div class="uk-inline">
            <label for="name" class="uk-label">Project Name:</label>

            <input type="text" id="name" name="name" class="uk-input" :class="setDanger('name')" v-model="form.name" :focus="focus('name')">

            <span class="uk-alert-danger" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
        </div>

        <div class="uk-inline">
            <label for="description" class="uk-label">Project Description:</label>

            <input type="text" id="description" name="description" class="uk-input" :class="setDanger('description')"  v-model="form.description">

            <span class="uk-alert-danger" v-if="form.errors.has('description')" v-text="form.errors.get('description')"></span>
        </div>

        <div class="control">
            <button class="uk-button uk-button-primary" :disabled="form.errors.any()">Create</button>
        </div>
    </form>
</template>

<script>

    export default {
        name: "VueForm",
        data() {
                return{
                form: new Form({
                    name: '',
                    description: ''
                })
            }
        },
        methods: {
            onSubmit() {
                this.form.post('/test')
                    .then(response => console.log(response))
                    .catch(errors=>console.log(errors));
            },
            setDanger(field) {
                if (this.form.errors.has(field)) {
                    return 'uk-form-danger';
                }
            },
            focus(e){
                window.onload = function() {
                    document.getElementById(e).focus();
                };
            }

        }
    }
</script>

<style scoped>

</style>
