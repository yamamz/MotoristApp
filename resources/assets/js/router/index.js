import Vue from 'vue'
import Router from 'vue-router'


// Containers
import Full from '@/containers/Full'
// Views
import Dashboard from '@/views/Dashboard'
// Views - Pages

import Login from '@/views/pages/Login'
import Register from '@/views/pages/Register'
import Members from '@/views/pages/member/members'
import AddMember from '@/views/pages/member/memberAdd'
import Chart from '@/views/pages/member/chartOrg'

Vue.use(Router)

export default new Router({
  mode: 'history', // Demo is living in GitHub.io, so required!
  linkActiveClass: 'open active',
  scrollBehavior: () => ({ y: 0 }),
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/register',
      name: 'Register',
      component: Register
    },
    {
      path: '/',
      redirect: '/',
      name: 'Home',
      component: Full,
      children: [
        {
          path: '',
          name: 'Dashboard',
          component: Dashboard
        },    
      ]
    },
    {
      path: '/member',
      name: 'Member',
      component: Full,
      children: [
        {
          path: '',
          name: 'members',
          component: Members
        }, 
        {
          path: 'add',
          name: 'member add',
          component: AddMember
        }, 
        {
          path: 'chart/:id',
          name: 'chart',
          component: Chart
        },   
      ]
    },
   
  ]
})
