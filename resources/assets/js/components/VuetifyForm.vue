<template>
    <v-form ref="form" v-model="valid" lazy-validation>
        <v-text-field
                ref="name"
                v-model="name"
                :rules="nameRules"
                :counter="10"
                success
                outline
                append-icon="person"
                :append-outer-icon="this.name !='' && this.$refs.name.valid ? 'check':''"
                label="Name"
                required
        ></v-text-field>
        <v-text-field
                ref="email"
                v-model="email"
                :rules="emailRules"
                label="E-mail"
                append-icon="mail"
                :append-outer-icon="this.email !='' && this.$refs.email.valid ? 'check':''"
                outline
                success
                required
        ></v-text-field>
        <v-select
                v-model="select"
                :items="items"
                :rules="[v => !!v || 'Item is required']"
                label="Item"
                outline
                success
                required
        ></v-select>
        <v-checkbox
                v-model="checkbox"
                :rules="[v => !!v || 'You must agree to continue!']"
                label="Do you agree?"
                required
        ></v-checkbox>

        <v-btn
                :disabled="!valid"
                @click="submit"
        >
            submit
        </v-btn>
        <v-btn @click="clear">clear</v-btn>
    </v-form>
</template>
<script>
    export default {
        data: () => ({
            valid: null,
            name: '',
            nameRules: [
                v => !!v || 'Name is required',
                v => (v && v.length <= 10) || 'Name must be less than 10 characters'
            ],
            email: '',
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+/.test(v) || 'E-mail must be valid'
            ],
            select: null,
            items: [
                'Item 1',
                'Item 2',
                'Item 3',
                'Item 4'
            ],
            checkbox: false
        }),

        methods: {
            submit () {
// console.log(this.$refs.form.$children[1].$data.valid )
                if (this.$refs.form.validate()) {

                    // Native form submission is not yet supported
                    axios.post('/test', this.$data
                        // name: this.name,
                        // email: this.email,
                        // select: this.select,
                        // checkbox: this.checkbox
                    ).then(response=> UIkit.notification(response.statusText,  {status:'success'}) )
                        .catch(errors =>UIkit.notification(Object.values(errors.response.data.errors)[0], {status:'danger'} ) );
                }
            },
            clear () {
                this.$refs.form.reset()
            }

        }
    }
</script>

<style scoped>

</style>