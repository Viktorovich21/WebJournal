import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../components/Login'
import Registration from '../components/Registration'
import Index from '../components/Index'
import Publication from '../components/Publication'
import UserMain from '../components/usercab/UserMain'
import NewArticle from '../components/usercab/NewArticle'
import AllUserList from '../components/AllUserList'
import UserInfoPage from '../components/usercab/UserInfoPage'
Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Index',
    component: Index
  },
  {
    path: '/users',
    name: 'Users',
    component: AllUserList
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/registration',
    name: 'Registration',
    component: Registration
  },
  {
    path: '/publication/:id',
    name: 'Publication',
    component: Publication
  },
  {
    path: '/user/home',
    name: 'UserHome',
    component: UserMain
  },
  {
    path: '/user/article',
    name: 'New article',
    component: NewArticle
  },
  {
    path: '/user/:id',
    name: 'UserInfo',
    component: UserInfoPage
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
