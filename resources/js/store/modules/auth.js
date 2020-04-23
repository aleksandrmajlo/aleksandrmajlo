import axios from 'axios'
import * as types from '../mutation-types'
import Cookies from 'js-cookie'

// state
export const state = {
    user: null,
    user_review:[],
    user_firms:[],
    user_favorite:[],

}

// getters
export const getters = {
    user: state => state.user,
    user_review: state => state.user_review,
    user_firms: state => state.user_firms,
    user_favorite: state => state.user_favorite,
    check: state => state.user !== null
}

// mutations
export const mutations = {

    [types.FETCH_USER_SUCCESS](state, {
        user
    }) {
        state.user = user
    },

    [types.USER_REVIEW](state,
        user_review
    ) {
        state.user_review = user_review
    },

    [types.USER_FIRMS](state,
        user_firms
    ) {
        state.user_firms = user_firms
    },

    [types.USER_FAVORITE](state,
        user_firms
    ) {
        state.user_favorite = user_firms
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

    async get_review({commit,state}){
        try{
            await axios.post('my_review',{id:state.user.id})
                .then(response=>{
                    commit(types.USER_REVIEW, response.data.reviews)
                })
        }catch(e){

        }
    },

    async get_firms({commit,state}){
        try{
            await axios.post('my_firms',{id:state.user.id})
                .then(response=>{
                    commit(types.USER_FIRMS, response.data.firms)
                })
        }catch(e){

        }
    },

    async get_favorite({commit,state}){
        try{
            let FavoriteItems = Cookies.get('FavoriteItems');
            if(typeof FavoriteItems!=="undefined"){
                let arr = JSON.parse(FavoriteItems);
                await axios.post('my_favorite',arr)
                    .then(response=>{
                        commit(types.USER_FAVORITE, response.data.firms)
                    })
            }

        }catch(e){

        }
    },



}
