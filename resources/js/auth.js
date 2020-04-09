import bearer from '@websanova/vue-auth/drivers/auth/bearer'
import axios from '@websanova/vue-auth/drivers/http/axios.1.x'
import router from '@websanova/vue-auth/drivers/router/vue-router.2.x'
import store from '~/store'
import * as types from '~/store/mutation-types'


const config = {
    auth: bearer,
    http: axios,
    router: router,
    tokenDefaultName: 'laravel-vue-spa',
    tokenStore: ['localStorage'],
    rolesVar: 'role',
    registerData: {
        url: 'auth/register',
        method: 'POST',
        redirect: '/login'
    },
    loginData: {
        url: 'auth/login',
        method: 'POST',
        redirect: '',
        fetchUser: true
    },
    logoutData: {
        url: 'auth/logout',
        method: 'POST',
        redirect: '/',
        makeRequest: true
    },
    fetchData: {
        url: 'auth/user',
        method: 'GET',
        enabled: true
    },
    refreshData: {
        url: 'auth/refresh',
        method: 'GET',
        enabled: true,
        interval: 3000
    },
    parseUserData: function (data) {
        try {
            if (typeof data.error !== "undefined" && data.error == "Unauthorized") {
                store.commit('auth/' + types.LOGOUT);
                store.commit('auth/' + types.FETCH_USER_FAILURE);
            } else {
                store.commit('auth/' + types.FETCH_USER_SUCCESS, {
                    user: data.user
                })
            }
        } catch (e) {
            console.log(e)
        }
    }

}

export default config
