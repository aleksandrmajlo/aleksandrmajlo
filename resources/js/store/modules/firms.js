import * as types from '../mutation-types'
// state
export const state = {
    coord_firms: [],// тут координаты
    firms: [],
    page_firms: [], // сюда загружаем фирмы который открываются по урл '/object/17'
    reviews: [], // отзывы для фирмы
    banners: "/img/@2x/banner-sm.jpg"
}
// getters
export const getters = {
    coord_firms: state => state.coord_firms,
    banners: state => state.banners,
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

    [types.SET_FIRMS](state, firms) {
        state.coord_firms = firms
    },

    [types.SET_FIRM](state, firm) {
        state.page_firms.push(firm)
    },
    [types.SET_REVIEW](state, reviews) {
        state.reviews.push(reviews)
    },

}
// actions
export const actions = {

    // это координаты для карты
    getGoordFirms({
        commit
    }) {
        axios.get('getFirms')
            .then(response => {
                commit(types.SET_FIRMS, response.data.firms)
            })
    },
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
    }


}
