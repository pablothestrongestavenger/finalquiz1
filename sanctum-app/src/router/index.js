import { createRouter, createWebHistory } from 'vue-router'
import LoginPage from '../components/LoginPage.vue'
import RegisterPage from '../components/RegisterPage.vue'
import PostPage from '../components/PostPage.vue'

const routes = [
  { path: '/', component: LoginPage, name: 'login' },
  { path: '/register', component: RegisterPage, name: 'register' },
  {
    path: '/home', component: PostPage, name: 'home',
    beforeEnter: (to, from, next) => {
      if (localStorage.getItem('token')) {
        next()
      } else {
        next('/')
      }
    }
  },
  {
    path: '/logout',
    name: 'logout',
    component: LoginPage,
    beforeEnter: (to, from, next) => {
      localStorage.removeItem('token');
      next('/');
    }
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
