<template>
<div>
  <el-row :gutter="5">
    <el-col :md="18">
      <el-card>
        <div id="chart">

        </div>
      </el-card>
  
    </el-col>
    <el-col :md="6">
      <el-card>
        <el-row>
          <br>
          <br>
          <el-col :md="6"><h4>Member</h4></el-col>
          <el-col :md="18" style="color:blue;  text-align: right;"><h4>{{member.first_name}} {{member.last_name}}</h4></el-col>
          </el-row>
        <el-row>
          <el-col :md="6"><h4>Status</h4></el-col>
          <el-col :md="18" style="color:blue;  text-align: right;"><h4>{{member.className}}</h4></el-col>
          </el-row>
          <el-row>
           <el-col :md="6" ><h4>Upline</h4></el-col>
          <el-col :md="18" v-if="upline != null" style="color:blue;  text-align: right;"><h4>{{upline.first_name}} {{upline.last_name}}</h4></el-col>
         <el-col :md="18" v-else style="color:blue;  text-align: right;"><h4>You Are the root</h4></el-col>
  
         </el-row>
         <el-row>
          <el-col :md="6" ><h4>Downlines</h4></el-col>
          <el-col :md="18" style="color:blue;  text-align: right;"><h4>{{downlinesCount}}</h4></el-col>
        </el-row>
          <el-row>
          <el-col :md="16" ><h4>Paid Months</h4></el-col>
          <el-col :md="8" style="color:blue;  text-align: right;"><h4>{{downlinesCount}}</h4></el-col>
        </el-row>
        <el-row :gutter="5">
          <el-col :md="14" ><el-button type="success" size="small">Add Payment</el-button></el-col>
          <el-col :md="10" ><el-button type="danger" @click="dialogRelease=true" size="small">Release</el-button></el-col>
        </el-row>
      </el-card>
    </el-col>
  </el-row>

  <el-dialog
  title="Release Motorcycle"
  :visible.sync="dialogRelease"
  width="40%"
>
<el-form>
  <el-form-item label="Member Name">
    <el-select v-model="form.member_id" style="width:100%;">
      <el-option :label="`${member.first_name} ${member.last_name}`" :value="member.id"></el-option>
    </el-select>
  </el-form-item>
    <el-form-item label="Motor Brand">
    <el-select v-model="form.motor_id" style="width:100%;">
      <el-option v-for="motor in motors" :key="motor.id" :value="motor.id" :label="`${motor.brand_name} ${motor.description}`"></el-option>
    </el-select>
  </el-form-item>
</el-form>

  <span slot="footer" class="dialog-footer">
    <el-button @click="dialogRelease = false">Cancel</el-button>
    <el-button type="primary" @click="saveRelease">Save</el-button>
  </span>
</el-dialog>

</div>
 
</template>
<style scoped>


	
</style>


<script>
  import OrgChart from '../../../helper/orgChart';
  export default {

    data () {
      return {
        ds: {},
        member:{},
        downlinesCount:0,
        upline:{},
        dialogRelease:false,
        form:{
          member_id:'',
          down_payment:0,
          motor_id:''
        },
        motors:[]

       
        }
    },
    methods:{
      saveRelease(){

      }
    },
    mounted(){

      axios.get('/api/motor/all').then(res=>{
        this.motors=res.data
      })


   axios.get('/api/member/show/'+this.$route.params.id).then(res=>{
     this.member=res.data.member
     this.downlinesCount=res.data.num_downLines
     this.form.member_id=res.data.member.id
     if(res.data.member.parent_id!=null){
        axios.get('/api/member/show/'+res.data.member.parent_id).then(resp=>{
         this.upline=resp.data.member
       })
     }else{
       this.upline=null
     }
      

   })
     

     axios.get('/api/member/get/'+this.$route.params.id).then(res=>{
       
    this.ds=res.data[0]
    //console.log(res.data[0])

  let orgchart = new OrgChart({
'chartContainer': '#chart',
    'data' : this.ds,
    'nodeContent': 'title',
        'depth': 4,
        'zoom':true,
        'pan':true,
        'exportButton':true,
        'exportFilename': 'MyOrgChart',
   

  });








       
     })

    }
  }
</script>