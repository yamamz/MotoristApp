<template>
    <div>
        <el-card>
                  <v-client-table :data="motorReleases" :columns="headers">

      </v-client-table>
        </el-card>
    </div>
</template>

<script>
export default {
  data(){
      return {
          motorReleases:[],
           headers: ["id", "fullname", "motorname", "monthly_due","vrmi_due","excess"],
      }
  
  },
      mounted() {
        axios.get('/api/motorrelease/all').then(res=>{
            this.motorReleases=res.data
                      this.motorReleases.forEach(el => {
          el.motorname = el.motor.brand_name + " " + el.motor.description;
          el.fullname = el.member.title;
          el.vrmi_due = el.member.monthly_amortization;
          el.excess=el.monthly_due - el.member.monthly_amortization;
        });
        })  
      },

}
</script>

<style>

</style>
