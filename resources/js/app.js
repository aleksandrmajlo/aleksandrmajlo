import 'es6-promise/auto'
import Vue from 'vue'
window.Vue = Vue

require('./bootstrap');
require('./common');


// Set Vue authentication
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)
if (process.env.NODE_ENV === 'production') {
    axios.defaults.baseURL = `https://wikirent.info/api`
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


// миксин
import GlobalMixin from './mixin/mixin'
Vue.mixin(GlobalMixin);




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
    //// If you intend to programmatically custom event listener code
    //// (e.g. `this.$refs.gmap.$on('zoom_changed', someFunc)`)
    //// instead of going through Vue templates (e.g. `<GmapMap @zoom_changed="someFunc">`)
    //// you might need to turn this on.
    // autobindAllEvents: false,

    //// If you want to manually install components, e.g.
    //// import {GmapMarker} from 'vue2-google-maps/src/components/marker'
    //// Vue.component('GmapMarker', GmapMarker)
    //// then set installComponents to 'false'.
    //// If you want to automatically install all the components this property must be set to 'true':
    installComponents: true
})
// Google map ************************


//шина
// export const eventBus = new Vue();


Vue.component('LoginBlock', require('./components/Auth/LoginBlock.vue').default);
Vue.component('RegistrarBlock', require('./components/Auth/RegistrarBlock.vue').default);
Vue.component('LangButton', require('./components/LangButton/LangButton.vue').default);
Vue.component('Flag', require('./components/LangButton/Flag.vue').default);

Vue.component('MapBlock', require('./components/Map/MapBlock.vue').default);
Vue.component('GeolocationMy', require('./components/Map/GeolocationMy.vue').default);

Vue.component('SearchBlock', require('./components/Search/SearchBlock.vue').default);

// Vue.config.productionTip = false

const app = new Vue({
    el: '#app',
    i18n,
    router,
    store,

});
