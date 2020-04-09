import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
    user: null,
}

// getters
export const getters = {
    user: state => state.user,
    check: state => state.user !== null
}

// mutations
export const mutations = {

    [types.FETCH_USER_SUCCESS](state, {
        user
    }) {
        state.user = user
    },
    [types.FETCH_USER_FAILURE](state) {
        localStorage.removeItem('laravel-vue-spa');
    },
    [types.LOGOUT](state) {
        state.user = null
    },
    [types.UPDATE_USER](state, {
        user
    }) {
        state.user = user
    }
}

// actions
export const actions = {
    async fetchUser({
        commit
    }) {
        try {
            const {
                data
            } = await axios.get('/api/user')
            commit(types.FETCH_USER_SUCCESS, {
                user: data
            })
        } catch (e) {
            commit(types.FETCH_USER_FAILURE)
        }
    },

    updateUser({
        commit
    }, payload) {
        commit(types.UPDATE_USER, payload)
    },
    async logout({
        commit
    }) {
        try {
            await axios.post('auth/logout')
        } catch (e) {

        }
        commit(types.LOGOUT)
    },
}
