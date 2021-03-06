import Vue from 'vue'
window.Vue = Vue

require('./bootstrap');
require('./common');


// Set Vue authentication
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)
if (process.env.NODE_ENV === 'production') {
    axios.defaults.baseURL = `https://wikirent.info/api`
    // axios.defaults.baseURL = `/api`
} else {
    axios.defaults.baseURL = `/api`
}

//роутер
import router from './router'
import VueRouter from 'vue-router'
Vue.router = router
Vue.use(VueRouter)

// auth
import VueAuth from '@websanova/vue-auth'
import auth from './auth'
Vue.use(VueAuth, auth)



//Loading
import Loading from 'vue-loading-overlay';
Vue.use(Loading);

// Lang
import i18n from '~/plugins/i18n'

// store
import store from '~/store'

// show-side
import VShowSlide from 'v-show-slide'
Vue.use(VShowSlide)


// popup
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);

// Google map ************************
/*
import * as VueGoogleMaps from 'vue2-google-maps'
Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyDLV3jrTwKlpeDY2nXTrQfvnAr8AGDDd_0',
        // libraries: 'places',
        // OR: libraries: 'places,drawing'
        // OR: libraries: 'places,drawing,visualization'
        // (as you require)

        //// If you want to set the version, you can do so:
        // v: '3.26',
    },
    installComponents: true
})
*/
// Google map ************************




//шина
export const eventBus = new Vue();

Vue.component('LoginBlock', require('./components/Auth/LoginBlock.vue').default);
Vue.component('RegistrarBlock', require('./components/Auth/RegistrarBlock.vue').default);
Vue.component('LangButton', require('./components/LangButton/LangButton.vue').default);
Vue.component('MapBlock', require('./components/Map/MapBlock.vue').default);
Vue.component('GeolocationMy', require('./components/Map/GeolocationMy.vue').default);
Vue.component('SearchBlock', require('./components/Search/SearchBlock.vue').default);

// миксин
import GlobalMixin from './mixin/mixin'
Vue.mixin(GlobalMixin);

Vue.config.productionTip = false

const app = new Vue({
    el: '#app',
    i18n,
    router,
    store,
});
