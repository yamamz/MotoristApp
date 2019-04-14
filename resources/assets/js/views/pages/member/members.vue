<template>
<div>
<el-card>
 <v-client-table :data="members" :columns="headers">
    <el-button slot="Actions" slot-scope="props" size="mini" @click="viewChart(props.row.id)" type="danger">view</el-button>
 </v-client-table>
</el-card>
     

   

</div>
</template>

<script>
  export default {
    data () {
      return {
        search: '',
        members:[],
        headers: ['id','first_name','last_name', 'address','monthly_amortization','Actions'],
       
      }
    },
    methods:{
      viewChart(member){
        this.$router.push('/member/chart/'+member)
      },
      editItem(member){

      }
    },
    created(){
      axios.get('/api/member/all').then(res=>{
      console.log(res.data)
      this.members=res.data
    })
    // axios.get('/api/member/all/tree').then(res=>{
    //   console.log(res.data)

    // })
    }

  }
</script>