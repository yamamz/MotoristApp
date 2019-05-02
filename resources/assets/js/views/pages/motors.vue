<template>
    <div>
        <el-card>
            <el-row :gutter="5">
                <el-col :md="12">
                    <el-card>
                        <h5>Motor List</h5>
                     <el-table
    :data="motors"
    border
    style="width: 100%">
    <el-table-column
      prop="brand_name"
      label="Brand"
     >
    </el-table-column>
    <el-table-column
      prop="description"
      label="Description"
     >
    </el-table-column>
  
  </el-table>
                    </el-card>
                </el-col>
                <el-col :md="12">
                    <el-card>
                        <h5>Add Motor</h5>
                    <el-form size="small" label-position="top">
                            <el-form-item label="Brand Name">
                                <el-input placeholder="Brand Here" v-model="form.brand_name"></el-input>
                            </el-form-item>
                                 <el-form-item label="Description">
                                <el-input placeholder="Description" v-model="form.description"></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="saveMotor">Add</el-button>
                            </el-form-item>
                    </el-form>
                    </el-card>
                </el-col>
            </el-row>
   
        </el-card>

         <el-card>
            <el-row :gutter="5">
                <el-col :md="12">
                    <el-card>
                        <h5>Branch List</h5>
                     <el-table
    :data="branches"
    border
    style="width: 100%">
    <el-table-column
      prop="name"
      label="Branch"
     >
    </el-table-column>
   
  
  </el-table>
                    </el-card>
                </el-col>
                <el-col :md="12">
                    <el-card>
                        <h5>Add Branch</h5>
                    <el-form size="small" label-position="top">
                            <el-form-item label="Branch Name">
                                <el-input placeholder="Branch Here" v-model="form1.name"></el-input>
                            </el-form-item>
                             
                            <el-form-item>
                                <el-button type="primary" @click="saveBranch">Add</el-button>
                            </el-form-item>
                    </el-form>
                    </el-card>
                </el-col>
            </el-row>
   
        </el-card>

    </div>
</template>

<script>
export default {
data(){
    return{
        motors:[],
        branches:[],
        form:{
            brand_name:'',
            description:''
        },
        form1:{
            name:''
        }

    }


},
methods: {
    saveBranch(){
         axios.post('/api/branch/create',this.form1).then(res=>{
            this.branches.push(res.data)
            this.form={
            brand_name:'',
            description:''
        }
                  this.$swal({
            type: 'success',
            title: 'Save',
            text: 'Save  Successfully!'
        });
        })
    },
    saveMotor(){
        axios.post('/api/motor/create',this.form).then(res=>{
            this.motors.push(res.data)
            this.form={
            brand_name:'',
            description:''
        }
            this.$swal({
            type: 'success',
            title: 'Save',
            text: 'Save  Successfully!'
        });
        })
    }
},
mounted(){
    axios.get('/api/motor/all').then(res=>{
        this.motors=res.data
    })
    axios.get('/api/branch/all').then(res=>{
        this.branches=res.data
    })
}
}
</script>

<style>

</style>
