<template>
<div>
<v-toolbar
dark
color="success"
>
  <v-btn icon>
    <v-icon>directions_bike</v-icon>
  </v-btn>
    <v-toolbar-title>Motorist Inc.</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-toolbar-items class="hidden-sm-and-down">

      <v-btn flat>Account</v-btn>
    </v-toolbar-items>
  </v-toolbar>

 
</div>
</template>

<style scoped>



</style>

<script>
//import jwtToken from '~/helpers/jwt-token';



export default {
name:'Navbar',
  data(){
    return{
        drawer: null,
        items: [
          { title: 'Home', icon: 'dashboard' },
          { title: 'About', icon: 'question_answer' }
        ]
     
        
        
        
    }
  },
  
  
}
</script>
