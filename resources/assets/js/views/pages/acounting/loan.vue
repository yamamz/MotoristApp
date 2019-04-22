<template>
    <div>
        <el-card>
            <h5>Member Loan List</h5>
             <v-client-table :options="options" :data="loans" :columns="headers">
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
    data(){
        return{
            headers: ['id','member.title','principal_amount', 'total_amount_due','interest_rate','Actions'],
            loans:[],
          options: {
        headings: {

          'member.title': 'Member',
        }
          }}
  
        
        
    },
    mounted(){
        axios.get('/api/memberloan/all').then(res=>{
            this.loans=res.data
            console.log(res.data)
        }).catch(err=>console.log(err))
    }
}
</script>

<style>

</style>
