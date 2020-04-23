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
import Advertising from './views/Advertising'
import Error from './views/Error'
import Message from './views/Message'
import Myreview from './views/Myreview'
import Myfirm from './views/Myfirm'
// Routes
const routes = [

    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            auth: undefined
        }
    },

    {
        path: '/advertising',
        name: 'advertising',
        component: Advertising,
        meta: {
            auth: undefined
        }
    },

    {
        path: '/error',
        name: 'error',
        component: Error,
        meta: {
            auth: undefined
        }
    },

    {
        path: '/message',
        name: 'message',
        component: Message,
        meta: {
            auth: undefined
        }
    },

    {
        path: '/search',
        name: 'search',
        component: Search,
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
        path: '/my_review',
        name: 'my_review',
        component: Myreview,
        meta: {
            auth: true
        }
    },

    {
        path: '/my_firm',
        name: 'my_firm',
        component: Myfirm,
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
        // path: '/404',
        path: '*',
        name: '404',
        component: () => import("./views/NotFound.vue")
    },
    // {
    //     path: '*',
    //     redirect: '/404'
    // }
];

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
})

router.beforeEach((to, from, next) => {
    // console.log(to,'to')
    // console.log(from,'from')
    // console.log(next,'next')
    store.commit('map/ROUTERSHOWHIDDENSIDEBAR', false);
    // для мобилки скрыть меню при переходе
    $('.toggle-menu-mobile_my').removeClass('on');
    $(".menu-mobile--js").removeClass("active");
    $('body').removeClass("fixed");
    // для мобилки скрыть меню при переходе
    setTimeout(() => {
        store.commit('map/ROUTERSHOWHIDDENSIDEBAR', true);
    }, 400)
    next();

})
router.onError(er => {
    console.log(er)
})
export default router
