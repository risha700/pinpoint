<template>
    <div>
        <h3>Payment Info</h3>
        <div class="form-row">
            <label>
                Credit or debit card
            </label>
            <div id="card-element" ref="cardElement">
                <!-- A Stripe Element will be inserted here. -->
            </div>

            <!-- Used to display Element errors. -->
            <div id="card-errors" role="alert"></div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "StripeCard",
        mounted(){
            let stripe = Stripe('pk_test_RUZqAN8CkTK39VGr7FuIxPWE');
            let elements  = stripe.elements();
            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            let card = elements.create('card',{hidePostalCode: true,style:style});
            card.mount('#card-element');
            card.addEventListener('change', ({error}) => {
                const displayError = document.getElementById('card-errors');
                if (error) {
                    displayError.textContent = error.message;
                } else {
                    displayError.textContent = '';
                }
            });
            window.events.$on('payNow',  async (event) => {

                let {token, error} = await stripe.createToken(card);

                if (error) {
                    const errorElement = document.getElementById('card-errors');
                    window.events.$emit('paymentIssue', error.message)
                    errorElement.textContent = error.message;
                    console.log('stripe-card: ' +error)
                } else {
                    window.events.$emit('tokenCreated', token)
                }
            })

        }
    }
</script>

<style scoped>

</style>