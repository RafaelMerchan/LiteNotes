import { createRouter, createWebHashHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import RegisterView from '../views/RegisterView.vue'
import LoginView from '../views/LoginView.vue'
import NewNote from '../views/NewNote.vue'
import NoteDetail from '../views/NoteDetail.vue'
import EditNote from '../views/EditNote.vue'

const routes = [
  {
    path: '/login',
    name: 'Login',
    component: LoginView
  },
  {
    path: '/register',
    name: 'Register',
    component: RegisterView
  },
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  { 
    path: '/notes/new', 
    name: 'new-note', 
    component: NewNote 
  },
  { 
    path: '/notes/:id', 
    name: 'note-detail', 
    component: NoteDetail 
  },
  { 
    path: '/notes/:id/edit', 
    name: 'edit-note', 
    component: EditNote 
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  const isAuthenticated = !!localStorage.getItem('token')

  const publicPages = ['Login', 'Register']

  if (!publicPages.includes(to.name) && !isAuthenticated) {
    next({ name: 'Login' })
  } else if (to.name === 'Login' && isAuthenticated) {
    next({ name: 'home' })
  } else {
    next()
  }
})


export default router
