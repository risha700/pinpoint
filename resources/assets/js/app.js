
import './bootstrap'
import VueClipboard from 'vue-clipboard2'
import VueRouter from 'vue-router'
import PortalVue from 'portal-vue'
import router from './routes'
import'vuetify/es5/util/theme.js'
import store from './store'


Vue.use({ VueRouter, PortalVue})
Vue.use(VueClipboard);

Vue.component('passport-clients', require('./components/passport/Clients.vue'));
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue'));
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue'));
Vue.component('form-stepper', require('./components/FormStepper'));
Vue.component('checkout-stepper', require('./components/CheckoutStepper'));
Vue.component('checkout', require('./components/shop/Checkout'));
Vue.component('flash', require('./components/partials/Flash.vue'));
Vue.component('app-shell', require('./components/partials/AppShell'));
Vue.component('quick-view', require('./components/shop/QuickView'));
Vue.component('page-not-found', require('./components/partials/PageNotFound'));


Vue.filter('moneyFormat', (number)=>{
    number = number/100
    return number.toLocaleString('us-US', { style: 'currency', currency: 'USD' })
});
Vue.prototype.$scrollToTop = () => window.scrollTo(0,0)
Vue.prototype.$openModal = (event) => window.events.$emit('quickView', event);
// Vue.prototype.$get = (vm)=>(field) => { if (vm[field]) {return vm[field];}}

Vue.prototype.authorize = (handler)=>{ let user = window.App.user ; return user ? handler(user) : false};

const app = new Vue({
    el: '#app',
    router,
    store:new Vuex.Store(store)
});

// router.beforeEach((to, from, next) => {
//     console.log(router.app.$store.getters.checkUserAccess())
// });
require('./core/utilities');
