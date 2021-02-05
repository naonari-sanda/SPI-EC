import Vue from 'vue'
import Router from 'vue-router'
import Home from './components/pages/HomeComponent'
import Cart from './components/pages/CartComponent'
import Detail from './components/pages/DetailComponent'
import Login from './components/pages/LoginComponent'
import Register from './components/pages/RegisterComponent'
import Acount from './components/pages/AcountComponent'

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/cart',
            name: 'cart',
            component: Cart
        },
        {
            path: '/detail/:stockId',
            name: 'detail',
            component: Detail,
            props: true
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/acount',
            name: 'acount',
            component: Acount
        }
    ]
})