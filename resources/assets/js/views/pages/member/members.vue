<template>
<div>
<el-card>
 <v-client-table :data="members" :columns="headers">
    <template slot="Actions" slot-scope="props">
      <div>
        <el-button  size="mini" icon="el-icon-view" circle @click="viewChart(props.row.id)" type="primary"></el-button>
    <el-button  size="mini" icon="el-icon-edit" circle @click="editMember(props.row.id)" type="success"></el-button>
      </div>
    </template>
    
 
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
      editMember(member){
  this.$router.push('/member/edit/'+member)
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