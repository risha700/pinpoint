
import './bootstrap'
import Vuetify from 'vuetify'
import VueClipboard from 'vue-clipboard2'
import VueRouter from 'vue-router'
import PortalVue from 'portal-vue'
import router from './routes'
import'vuetify/es5/util/theme.js'
import store from './store'


Vue.use(Vuetify, {
    theme: {
        primary: "#304FFE",
        secondary: "#18FFFF",
        accent: "#b02932",
        error: "#FF5252",
        warning: "#FFCA28",
        info: "#2196f3",
        success: "#00E676"
    }
});

Vue.use({ VueRouter, PortalVue})

Vue.use(VueClipboard);
// VueClipboard.config.autoSetContainer = true; // add this line

Vue.component('passport-clients', require('./components/passport/Clients.vue'));
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue'));
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue'));

Vue.component('form-stepper', require('./components/FormStepper'));
Vue.component('checkout-stepper', require('./components/CheckoutStepper'));
Vue.component('checkout', require('./components/shop/Checkout'));
Vue.component('flash', require('./components/partials/Flash.vue'));
Vue.component('app-shell', require('./components/partials/AppShell'));
Vue.component('quick-view', require('./components/shop/QuickView'));
Vue.component('list', require('./components/partials/List'));


Vue.filter('moneyFormat', (number)=>{
    // number = parseInt(Math.ceil(number/100))
    number = number/100
    return number.toLocaleString('us-US', { style: 'currency', currency: 'USD' })
});
Vue.prototype.$scrollToTop = () => window.scrollTo(0,0)

const app = new Vue({
    el: '#app',
    router,
    store:new Vuex.Store(store)
});


require('./core/utilities');
