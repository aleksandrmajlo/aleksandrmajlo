import * as types from '../mutation-types'
// state
export const state = {
    coord_firms: [],// тут координаты
    firms: [],
    categories:[],
    page_firms: [], // сюда загружаем фирмы который открываются по урл '/object/17'
    reviews: [], // отзывы для фирмы
    banner_home: null,
    banner_bottom: null,
    banner_top: null,
}
// getters
export const getters = {
    categories (state, getters, rootState) {
        let res=[]
        state.categories.forEach(el=>{
            if(rootState.lang.locale=='ru'){
                 res.push({
                     title:el.title_ru,
                     id:el.id,
                     timeworkstatus:el.timeworkstatus
                 })
            }
            if(rootState.lang.locale=='en'){
                 res.push({
                     title:el.title_en,
                     id:el.id,
                     timeworkstatus:el.timeworkstatus
                 })
            }
            if(rootState.lang.locale=='uk'){
                 res.push({
                     title:el.title_uk,
                     id:el.id,
                     timeworkstatus:el.timeworkstatus
                 })
            }
        });
        return res;
    },
    coord_firms: state => state.coord_firms,
    banner_home: state => state.banner_home,
    banner_bottom: state => state.banner_bottom,
    banner_top: state => state.banner_top,
    getFirmById: state => id => {
        let index = state.page_firms.map(item => parseInt(item.id)).indexOf(parseInt(id));
        if (index !== -1) {
            return state.page_firms[index];
        }
        return null;
    },
    getReviewsByFirm_id: state => id => {
        let index = state.reviews.map(item => parseInt(item.firm_id)).indexOf(parseInt(id));
        if (index !== -1) {
            return state.reviews[index].reviews;
        }
        return null;
    },
}
// mutations
export const mutations = {
    [types.SET_FIRMS](state, data) {
        state.coord_firms = data.firms
        state.banner_home = data.banner_home
        state.banner_bottom = data.banner_bottom
        state.banner_top = data.banner_top
    },
    [types.SET_FIRM](state, firm) {
        state.page_firms.push(firm);

    },

    [types.SET_REVIEW](state, reviews) {
        state.reviews.push(reviews)
    },
    [types.SET_CATEGORIES](state,categories) {
        state.categories=categories
    },

}
// actions
export const actions = {
    // это координаты для карты
    //заодно и баннера получил
     async getGoordFirms({
        commit
    }) {
        return axios.get('getFirms')
            .then(response => {
                commit(types.SET_FIRMS, response.data)
            })
    },

    // получение фирмы
    getFirm({
        commit
    }, id) {
        return axios.post("getFirm", {
                id: id
            })
            .then(response => {
                commit(types.SET_FIRM, response.data.firm)
            })
            .catch(err => {
                alert('Такого объекта не существует')
            })
    },

    getReviews({
        commit
    }, id) {
        return axios.post("getReview", {
                id: id
            })
            .then(response => {
                commit(types.SET_REVIEW, response.data.reviews)
            })
            .catch(err => {
                alert('Такого объекта не существует')
            })
    },

    getCategories({commit,state}){
        if(state.categories.length>0) return false;
        return axios.post("getCategories")
            .then(response => {
                commit(types.SET_CATEGORIES, response.data.categories)
            })
            .catch(err => {
            })
    }


}
