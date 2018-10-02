import VueRouter from 'vue-router';


let routes=[
    {

        path:'/',
        component:require('./views/Home.vue'),
        icon:'home'

    },
    {

        path:'/shop',
        component:require('./views/Shop.vue'),
        icon:'store'
    },
    {

        path:'/bag',
        component:require('./views/Cart.vue'),
        icon:'shopping_cart'
    },
    {  path:'/checkout',
        component:require('./views/Checkout.vue'),
        icon:''
    },



];

export default new VueRouter({

    // mode: 'history',
    // hashbang: false,
    // base: '/',
    // fallback: true,
    linkActiveClass: 'v-btn--active',
    routes,

});
