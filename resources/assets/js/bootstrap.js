
import Icons from 'uikit/dist/js/uikit-icons';
import Form from './core/Form';
import Vuetify from 'vuetify'

window.Form = Form;
window._ = require('lodash');
window.Popper = require('popper.js').default;

window.Swal = require('sweetalert2');
window.Vue = require('vue');
window.Vuex = require('vuex');


try {
    window.$ = window.jQuery = require('jquery');
    window.UIkit = require('uikit');
    UIkit.use(Icons);
} catch (e) {console.log(e)}


window.axios = require('axios');

let token = document.head.querySelector('meta[name="csrf-token"]');
window.axios.defaults.headers.common = {
    'X-Requested-With':'XMLHttpRequest',
    'Accept': 'application/json',
    'Content-Type': 'application/json'
};
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}



// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
window.events= new Vue();

window.flash = function(message, level ='success'){

    window.events.$emit('flash', { message, level });

};


//vueJs settings
Vue.use(Vuex);
Vue.use(Vuetify, {
    theme: {
        primary: "#304FFE",
        secondary: "#18FFFF",
        accent: "#0d94b0",
        error: "#FF5252",
        warning: "#FFCA28",
        info: "#2196f3",
        success: "#00E676"
    }
});
