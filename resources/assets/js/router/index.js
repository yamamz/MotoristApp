import Vue from 'vue'
import Router from 'vue-router'


// Containers
import Full from '@/containers/Full'
// Views
import Dashboard from '@/views/Dashboard'
// Views - Pages

import Login from '@/views/pages/Login'
import Motors from '@/views/pages/motors'
import Register from '@/views/pages/Register'
import Members from '@/views/pages/member/members'
import AddMember from '@/views/pages/member/memberAdd'
import MotoRelease from '@/views/pages/member/addreleasemotor'
import Chart from '@/views/pages/member/chartOrg'
import EditMember from '@/views/pages/member/edit'
import Loan from '@/views/pages/acounting/loan'
import LoanDetails from '@/views/pages/acounting/loanDetails'
import AddLoan from '@/views/pages/acounting/addloan'
import EditLoan from '@/views/pages/acounting/editloan'
import Payable from '@/views/pages/report/payables'


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
      meta: { requiresAuth: true},
      children: [
        {
          path: '',
          name: 'Dashboard',
          component: Dashboard,
          meta: { requiresAuth: true},
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
        {
          path: 'edit/:memberid',
          name: 'edit member',
          component: EditMember
        },
        {
          path: 'motorrelease/add',
          name: 'motorrelease',
          component: MotoRelease
        },    
      ]
    },
    {
path:'/reports',
name: 'reports',
component:Full,
children:[
  {
    path:'payables',
    name:'r-payables',
    component: Payable
  }
]
    },
    {
      path: '/accounting',
      name: 'accounting',
      component: Full,
      children: [

        {
          path: 'loans',
          name: 'loans',
          component: Loan
        }, 
        {
          path: 'addloan',
          name: 'addloan',
          component: AddLoan
        }, 
        {
          path: 'editloan/:loanid',
          name: 'editloan',
          component: EditLoan
        }, 
        {
          path: 'loan/:loanid',
          name: 'viewloan',
          component: LoanDetails
        }, 
 
 
      ]
    },
    {
      path: '/settings',
      name: 'Setting',
      component: Full,
      children: [

        {
          path: 'motors',
          name: 'motor add',
          component: Motors
        }, 
 
      ]
    },
   
   
   
  ]
})
