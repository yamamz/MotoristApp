<template>
    <div>
        <el-card>
            <h5>Add Member Loan</h5>
            <el-form size="small" label-position="top">
            <el-row :gutter="5"> 
             <el-col :md="12">
                 <el-form-item label="Member">
                     <el-select :filterable="true" v-model="form.member_id" placeholder="Please Select Member" style="width:100%;">
                         <el-option v-for="member in members" :label="`ID-${member.id} ${member.first_name} ${member.last_name}`" :value="member.id" :key="member.id"></el-option>
                     </el-select>
                 </el-form-item>
             </el-col>
                <el-col :md="12">
                        <el-form-item label="Principal Amount">
                            <el-input @change="calculateTotalAmount" v-model="form.principal_amount" type="number"></el-input>
                 </el-form-item>
             </el-col>
             <el-col :md="12">
                    <el-form-item label="Term" >
                     <el-select @change="changeInterest" v-model="form.term_id" placeholder="Please Select Term" style="width:100%;">
                         <el-option v-for="term in terms" :label="term.label" :value="term.value" :key="term.value"></el-option>
                     </el-select>
                 </el-form-item>
             </el-col>
                 <el-col :md="12">
                    <el-form-item label="Interest Rate">
                     <el-select v-model="form.interest_rate" placeholder="Please Select interest rate" style="width:100%;">
                         <el-option v-for="term in interest_rates" :label="term.label" :value="term.value" :key="term.value"></el-option>
                     </el-select>
                 </el-form-item>
             </el-col>
             <el-col :md="12">
            <el-form-item  label="Date Release">
            <el-date-picker @change="getDay" style="width:100%;"
      v-model="form.date_release"
      type="date"
   
      placeholder="Please Select date">
    </el-date-picker>
            </el-form-item>
             </el-col>
             <el-col :md="12">
            <el-form-item  label="Due Date">
            <el-input v-model="form.due_date" ></el-input>
            </el-form-item>
             </el-col>
                  <el-col :md="12">
            <el-form-item  label="Total Amount Due">
            <el-input v-model="form.total_amount_due" ></el-input>
            </el-form-item>
             </el-col>
             <el-col>
                 <el-button @click="saveLoan" type="success" size="small">Save</el-button>
             </el-col>
            </el-row>
            </el-form>
        
        </el-card>
    </div>
</template>

<script>
export default {
    data(){
        return{
            members:[],
            form:{
                member_id:'',
                term_id:'',
                interest_rate:0,
                date_release:null,
                due_date:'',
                total_amount_due:0,
                principal_amount:0,
                is_paid:false

            },
            terms:[{value:1,label:'1 Month'},{value:2,label:'2 Months'},{value:3,label:'3 Months'},
            {value:4,label:'4 Months'},{value:5,label:'5 Months'},{value:6,label:'6 Months'},],
             interest_rates:[{value:0.03,label:'3 percent'},{value:0.06,label:'6 percent'},{value:0.09,label:'9 percent'},
            {value:0.12,label:'12 Percent'},{value:0.15,label:'15 percent'},{value:0.18,label:'18 peercent'},],
            
        }
    },
    mounted(){
        axios.get('/api/member/all').then(res=>{
            this.members=res.data
        })
    },
    computed:{
  
    },
    methods:{
            saveLoan(){
              
                axios.post('/api/memberloan/create',this.form).then(res=>{
                    this.$swal({
            type: 'success',
            title: 'Save',
            text: 'Save Successfully!'
        });
       // this.$router.push('/member')
      }).catch(err=>{
         this.$swal({
            type: 'error',
            title: 'error',
            text: 'Error Occur!'
        });
      })
            },
            calculateTotalAmount(){
                this.form.total_amount_due=(parseFloat(this.form.principal_amount * this.form.interest_rate) + parseFloat(this.form.principal_amount)).toFixed(2)
            },
            getDay(){
            let day=this.form.date_release.getDate()
            console.log(day)
            this.form.due_date= "Every "+day+" day of the Month"
        },
        changeInterest(){
            console.log(this.form.term_id)
            if(this.form.term_id==1){
                console.log('ni ari')
                this.form.interest_rate=0.03
            }
            else if(this.form.term_id==2){
                this.form.interest_rate=0.06
            }
             else if(this.form.term_id==3){
                this.form.interest_rate=0.09
            }
             else if(this.form.term_id==4){
                this.form.interest_rate=0.12
            }
             else if(this.form.term_id==5){
                this.form.interest_rate=0.15
            }
            else{
                this.form.interest_rate=0.18
            }

            this.calculateTotalAmount()
        }
    }
}
</script>

<style>

</style>
