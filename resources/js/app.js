import 'es6-promise/auto'
import axios from 'axios'
import Vue from 'vue'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'

import auth from './auth'
import router from './router'

require('./bootstrap');
require('./common');

// Set Vue globally
window.Vue = Vue

// Set Vue router
Vue.router = router
Vue.use(VueRouter)


// Set Vue authentication
Vue.use(VueAxios, axios)
if (process.env.NODE_ENV === 'production') {
    axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`
} else {
    axios.defaults.baseURL = `/api`
}


Vue.use(VueAuth, auth)

//шина
export const eventBus = new Vue();


Vue.component('LoginBlock', require('./components/Auth/LoginBlock.vue').default);
Vue.component('RegistrarBlock', require('./components/Auth/RegistrarBlock.vue').default);
// Vue.component('MenuBlock', require('./components/Auth/Menu.vue').default);

const app = new Vue({
    el: '#app',
    router
});
