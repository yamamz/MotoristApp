export default {
  items: [
    {
      name: 'Dashboard',
      url: '/',
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
          icon: 'icon-list'
        },
        {
          name: 'member add',
          url: '/member/add',
          icon: 'icon-notebook'
        },
        
      ]
    },
    {
      name: 'Accounting',
      url: '/accounting',
      icon: 'icon-calculator',
      badge: {
        variant: 'danger',
      },
      children: [
        {
          name: 'loan',
          url: '/accounting/loans',
          icon: 'icon-list'
        },
        {
          name: 'addloan',
          url: '/accounting/addloan',
          icon: 'icon-notebook'
        },
        
        
      ]
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
      name: 'Settings',
      url: '/Settings',
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
        {
          name: 'Motor',
          url: '/settings/motors',
          icon: 'icon-star'
        },
       
      ]
    }
  ]
}
