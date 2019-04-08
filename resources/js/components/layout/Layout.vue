<template>
<v-app>
  <v-container fluid>

 
    <Navbar/> 
           
            <v-layout row wrap>
<v-flex lg3 xs2><Sidebar/></v-flex>
<v-flex lg9 xs10>

  <Main/>
  </v-flex>
            </v-layout>
           

  </v-container>
</v-app>
</template>

<script>
import { Navbar, Main,Sidebar} from './components'

export default {
  name: 'Layout',
  components: {
    Navbar,
    Main,
    Sidebar

  },
 
}
</script>

<style scoped>
.container,.fluid{
padding:0px;
}
</style>