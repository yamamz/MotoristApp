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
    </div>
</template>

<script>
export default {
data(){
    return{
        motors:[],
        form:{
            brand_name:'',
            description:''
        }
    }


},
methods: {
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
}
}
</script>

<style>

</style>
