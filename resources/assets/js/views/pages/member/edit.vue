<template>
  <div>

    <el-card>
      <h5>Add Member</h5>
      <el-form label-position="top" size="small">
        <el-row :gutter="5">
          <el-col :md="8">
            <el-form-item label="First Name">
              <el-input v-model="form.first_name"></el-input>
            </el-form-item>
            </el-col>
           <el-col :md="8">
                  <el-form-item label="Middle Name">
              <el-input v-model="form.middle_name"></el-input>
            </el-form-item>
           </el-col>
            <el-col :md="8">
                   <el-form-item label="Last Name">
              <el-input v-model="form.last_name"></el-input>
            </el-form-item>
            </el-col>
                <el-col :md="16">
            <el-form-item label="Address">
              <el-input v-model="form.address"></el-input>
            </el-form-item>
            </el-col>
           <el-col :md="8">
                  <el-form-item label="Cellphone Number">
              <el-input v-model="form.mobile_no"></el-input>
            </el-form-item>
           </el-col>
           <el-col :md="8">
                  <el-form-item label="Age">
              <el-input type="number" v-model="form.age"></el-input>
            </el-form-item>
           </el-col>
           <el-col :md="8">
    <el-form-item  label="Birthdate">
                <el-date-picker style="width:100%;"
      v-model="form.birthdate"
      type="date"
      placeholder="Please Select date">
    </el-date-picker>
            </el-form-item>
           </el-col>
           <el-col :md="8">
          <el-form-item label="Monthly Amortization">
              <el-select style="width:100%;" 
                placeholder="Please Select Monthly"
              v-model="form.monthly_amortization">
                <el-option v-for="(val,index) in monthly_amortization" :key="index" :value="val">
                </el-option>
              </el-select>
            </el-form-item>
           </el-col>
           <el-col :md="8">
          <el-form-item label="Upline">
              <el-select style="width:100%;" 
              filterable
              placeholder="Please Select you Upline"
              v-model="form.parent_id">

                   <el-option label="No Upline" value=""></el-option>
               

                    <el-option v-for="(val,index) in filterParent" :key="index"  :label="`${val.name} ${val.first_name} ${val.last_name}`" :value="val.id">
                </el-option>
              </el-select>
            </el-form-item>
           </el-col>
              <el-col :md="8">
                  <el-form-item label="Donation Fee">
              <el-input type="number" v-model="form.registration"></el-input>
            </el-form-item>
           </el-col>
           
               <el-col :md="8">
          <el-form-item label="Gender" placeholder="Please Select your Avatar">
              <el-select style="width:100%;" v-model="form.image">
                <el-option v-for="(val,index) in image_avatars" :key="index" :label="val.label" :value="val.value">
                </el-option>
              </el-select>
            </el-form-item>
           </el-col>
           <el-col :md="8">
             <el-button @click="saveMember" type="success" size="small">Update</el-button>
           </el-col>
        </el-row>
      </el-form>

    </el-card>
  </div>
 

</template>

<style scoped>
.el-form--label-top .el-form-item__label {
    float: none;
    display: inline-block;
    text-align: left;
    /* padding: 0 0 10px; */
}


.el-form-item__label {
    text-align: right;
    float: left;
    font-size: 14px;
    color: #606266;
    line-height: 0px;
    padding: 0 0px 0 0;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.el-form-item__content .el-input-group, .el-form-item__label, .el-tag .el-icon-close {
    vertical-align: middle;
}

label {
    display: inline-block;
    margin-bottom: .5rem;
}


</style>


<script>
export default {

  data(){
    return{
      image_avatars:[{label:'female',value:'/images/avatar2.png'},{label:'male',value:'/images/avatar.png'}],
      monthly_amortization:[2800,3000],
      form:{
        first_name:'',
        middle_name:'',
        last_name:'',
        mobile_no:'',
        age:'',
        address:'',
        birthdate:'',
        registration:'',
        monthly_amortization:'',
        image:'',
        parent_id:''
      },
      members:[{first_name:'',last_name:''}]
    }
  },
  mounted(){
          axios.get("/api/member/show/" + this.$route.params.memberid).then(res => {
         this.form = res.data.member;
        
      })
    axios.get('/api/member/all').then(res=>{
      console.log(res.data)
      this.members=res.data
      this.members.forEach(el=>{
          el.label=`${el.id} - ${el.first_name} ${el.last_name}`
          let childCount=0
          this.members.forEach(e=>{
              if(e.parent_id==el.id){
                childCount++
              }
          })
          el.childCount=childCount

          
      })


    })
  },

  methods:{
    saveMember(){
      axios.post('/api/member/edit/'+this.$route.params.memberid,this.form).then(res=>{
          if(res.data.ok == true){
                      this.$swal({
            type: 'success',
            title: 'Save',
            text: 'Save Member Successfully!'
        });
        this.$router.push('/member')
          }else{
            this.$swal({
            type: 'error',
            title: 'error',
            text: 'Upline is in binary form!'
        });
          }

      }).catch(err=>{
         this.$swal({
            type: 'error',
            title: 'error',
            text: 'Error Occur!'
        });
      })
    }
  }
  ,
  computed:{
    filterParent(){
    return this.members
    }
  }
}
</script>
