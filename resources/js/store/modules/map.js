import * as types from '../mutation-types'
// state
export const state = {
    showMapYesNoSidebar: true, //открыть закрыть сайдбар при клике на карту
    // showMapYesNoSidebar: true, //открыть закрыть сайдбар при клике на карту
    mapname: 'OpenStreet',
    // mapname: 'Yandex',
    // mapname: 'Google',
    center: [50.45466, 30.5238],
    zoom: 15,
    // markers: [],
    search: {
        value: '',
        latlng: {
            lat: 0,
            lng: 0
        },
        type: ""
    },
    user_position:{
        lat:null,
        lng:null
    },
    radius:null
}

// getters
export const getters = {
    mapname: mapname => state.mapname,
    zoom: zoom => state.zoom,
    center: center => state.center,
    user_position: user_position => state.user_position,
    radius: radius => state.radius,
    showMapYesNoSidebar: showMapYesNoSidebar => state.showMapYesNoSidebar,

    search_address: state => {
        return state.search.value
    },
    search_latlng: state => {
        return state.search.latlng
    },
    search_type: state => {
        return state.search.type
    },
}

// mutations
export const mutations = {

    [types.ACTIVE_MAP](state, map) {
        state.mapname = map
    },
    [types.SET_SEARCH](state, search) {
        state.search = search
    },
    [types.MAPSHOWHIDDENSIDEBAR](state) {
        state.showMapYesNoSidebar = !state.showMapYesNoSidebar
    },
    [types.ROUTERSHOWHIDDENSIDEBAR](state,show) {
        if (show) {
            state.showMapYesNoSidebar = true;
        } else {
            state.showMapYesNoSidebar = false;
        }
    },
    [types.USERPOSITION](state,ob){
        state.user_position=ob.coords;
        state.radius=ob.radius;
    }

}
// actions
// export const actions = {
//
// }
