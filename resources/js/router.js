import VueRouter from 'vue-router'

// Pages
import Home from './views/Home'

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
]

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
})

export default router
