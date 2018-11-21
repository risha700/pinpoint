import VueRouter from 'vue-router';


let routes=[
    {

        path:'/',
        name:'home',
        component:require('./views/Home.vue'),
        icon:'home',
        showInMenu:true

    },
    {

        path:'/shop',
        name:'shop',
        query: { category:'slug'},
        component:require('./views/Shop.vue'),
        icon:'store',
        showInMenu:true
    },
    {
        path:'/shop/:slug',
        name:'product',
        component:require('./views/Product.vue'),
        icon:'',
        showInMenu:false
    },
    {

        path:'/bag',
        name:'cart',
        component:require('./views/Cart.vue'),
        icon:'shopping_basket',
        showInMenu:true
    },
    {  path:'/checkout',
        name:'checkout',
        component:require('./views/Checkout.vue'),
        icon:'',
        showInMenu:false
    },

    {
        path:'*',
        name:'404',
        component:require('./components/partials/PageNotFound'),
        icon:'',
        showInMenu:false
    },
    {
        path:'/dashboard',
        name:'dashboard',
        component:require('./views/Dashboard.vue'),
        icon:'dashboard',
        showInMenu:false
    },
    {
        path:'/login',
        name:'login',
        component:require('./views/Login.vue'),
        icon:'',
        showInMenu:false
    },




];

export default new VueRouter({

    // mode: 'history',
    // hashbang: false,
    // base: '/',
    fallback: true,
    linkActiveClass: 'v-btn--active',
    routes,

});
