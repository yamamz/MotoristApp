<template>
  <div id="app">
  
    <v-app id="main">
    
    <router-view/>
    </v-app>
  </div>
</template>
<style scope>
#main{
  margin:0px 0px;
  }
</style>
<script>

export default {
  name: 'App'
}
</script>