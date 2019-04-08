<template>
  <div>
    <organization-chart :datasource="ds">
        <template slot-scope="{ nodeData }">
            <v-card height="80">
              <v-card-title>
                      <h5>{{nodeData.first_name}}</h5>
              </v-card-title>
            
            </v-card>

</template>
    </organization-chart>
  </div>
</template>

<script>
  import Vue from 'vue'
  import OrganizationChart from 'vue-organization-chart'
  import 'vue-organization-chart/dist/orgchart.css'

  export default {
    components: {
      OrganizationChart
    },
    created(){
     axios.get('/api/member/get/'+this.$route.params.id).then(res=>{
       console.log(res.data)
      this.ds=res.data[0]
     })
    },
    data () {
      return {

        ds:{}
      }
    }
  }
</script>