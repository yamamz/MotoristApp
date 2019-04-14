<template>
  <div class="app">
    <AppHeader/>
    <div class="app-body">
      <Sidebars :navItems="nav"/>
      <main class="main">
        <breadcrumbs :list="list"/>
        <div class="container-fluid">
  
                   <router-view></router-view>
         
   
        </div>
      </main>
      <AppAside/>
    </div>
    <AppFooter/>
  </div>
</template>
<style scoped>

</style>


<script>
import nav from '../_nav'
import { Headers as AppHeader, Sidebars, Asides as AppAside, Footers as AppFooter, Breadcrumbs } from '../components/'

export default {
  name: 'full',
  components:{
    AppHeader,
    Sidebars,
    AppAside,
    AppFooter,
    Breadcrumbs
  }
     ,
  data () {
    return {
      nav: nav.items
    }
  },
  computed: {
    name () {
      return this.$route.name
    },
    list () {
      return this.$route.matched
    }
  }
}
</script>
