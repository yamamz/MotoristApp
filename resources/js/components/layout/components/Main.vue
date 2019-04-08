<template>
<div id="main">
  <router-view/>
</div>

</template>

<script>
export default {
  name: 'Main',
  computed: {
    // key() {
    //   return this.$route.name !== undefined ? this.$route.name + +new Date() : this.$route + +new Date()
    // }
  }
}
</script>

<style scoped>
#main{
  margin-top:10px;
}
</style>
