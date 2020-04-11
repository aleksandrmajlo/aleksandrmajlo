import VueRouter from 'vue-router'
import store from '~/store'

// Pages
import Home from './views/Home'
import AddFirm from './views/AddFirm'
import Account from './views/Account'
import Search from './views/Search'
import Favorite from './views/Favorite'
import Object from './views/Object'
import Review from './views/Review'
import AddReview from './views/AddReview'
import AddPhoto from './views/AddPhoto'
// Routes
const routes = [{
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            auth: undefined
        }
    },

    {
        path: '/search/',
        name: 'search',
        component: Search,
        props: (route) => ({
            query: route.query.q
        }),
        meta: {
            auth: undefined
        }
    },


    {
        path: '/object/:id',
        name: 'object',
        component: Object,
        meta: {
            auth: undefined
        }
    },
    {
        path: '/review/:id',
        name: 'review',
        component: Review,
        meta: {
            auth: undefined
        }
    },


    {
        path: '/addreview/',
        name: 'addreview',
        component: AddReview,
        props: (route) => ({
            id: route.query.id
        }),
        meta: {
            auth: true
        }
    },

    {
        path: '/addphoto/',
        name: 'addphoto',
        component: AddPhoto,
        props: (route) => ({
            id: route.query.id
        }),
        meta: {
            auth: true
        }
    },

    {
        path: '/register',
        name: 'register',
        component: Home,
        meta: {
            auth: false
        }
    },

    {
        path: '/login',
        name: 'login',
        component: Home,
        meta: {
            auth: false
        }
    },

    {
        path: '/addobject',
        name: 'addobject',
        component: AddFirm,
        meta: {
            auth: true
        }
    },

    {
        path: '/account',
        name: 'account',
        component: Account,
        meta: {
            auth: true
        }
    },

    {
        path: '/favorite',
        name: 'favorite',
        component: Favorite,
        meta: {
            auth: true
        }
    },

    {
        path: '/404',
        name: '404',
        component: () => import("./views/NotFound.vue")
    },
    {
        path: '*',
        redirect: '/404'
    }
];

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
})

router.beforeEach((to, from, next) => {
    store.commit('map/ROUTERSHOWHIDDENSIDEBAR', false);
    next();
    setTimeout(() => {
        store.commit('map/ROUTERSHOWHIDDENSIDEBAR', true);
    }, 500)

})
export default router
