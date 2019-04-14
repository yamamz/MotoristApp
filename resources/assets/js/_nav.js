export default {
  items: [
    {
      name: 'Dashboard',
      url: '/dashboard',
      icon: 'icon-speedometer',
      // badge: {
      //   variant: 'primary',
      //   text: 'NEW'
      // }
    },
    {
      title: true,
      name: 'Main'
    },
    {
      name: 'Member',
      url: '/member',
      icon: 'icon-puzzle',
      children: [
        {
          name: 'members',
          url: '/member',
          icon: 'icon-puzzle'
        },
        {
          name: 'member add',
          url: '/member/add',
          icon: 'icon-puzzle'
        },
        
      ]
    },
    {
      name: 'Accounting',
      url: '/acounting',
      icon: 'icon-calculator',
      badge: {
        variant: 'danger',
      }
    },
    {
      name: 'Reports',
      url: '/reports',
      icon: 'icon-pie-chart'
    },
    {
      divider: true
    },
    {
      title: true,
      name: 'Extra'
    },
    {
      name: 'Seetings',
      url: '/pages',
      icon: 'icon-star',
      children: [
        {
          name: 'Login',
          url: '/login',
          icon: 'icon-star'
        },
        {
          name: 'Register',
          url: '/register',
          icon: 'icon-star'
        },
       
      ]
    }
  ]
}
