<template>
  <div>
    <el-card>
      <h5>Loan Details</h5>
      <el-form size="small" label-position="top">
        <el-row :gutter="5">
          <el-col :md="4">
            <el-form-item label="ID">
              <el-input disabled v-model="loan.member.name"></el-input>
            </el-form-item>
          </el-col>
          <el-col :md="8">
            <el-form-item label="Full Name">
              <el-input disabled v-model="loan.member.title"></el-input>
            </el-form-item>
          </el-col>
          <el-col :md="12">
            <el-form-item label="Address">
              <el-input disabled v-model="loan.member.address"></el-input>
            </el-form-item>
          </el-col>
          <el-col :md="4">
            <el-form-item label="Terms">
              <el-input disabled v-model="loan.term_id"></el-input>
            </el-form-item>
          </el-col>
          <el-col :md="4">
            <el-form-item label="Due Date">
              <el-input disabled v-model="loan.due_date"></el-input>
            </el-form-item>
          </el-col>
          <el-col :md="4">
            <el-form-item label="Interest Rate">
              <el-input disabled v-model="loan.interest_rate"></el-input>
            </el-form-item>
          </el-col>
          <el-col :md="6">
            <el-form-item label="Pricipal Amount">
              <el-input disabled v-model="loan.principal_amount">
                <template slot="prepend">PHP</template>
              </el-input>
            </el-form-item>
          </el-col>
          <el-col :md="6">
            <el-form-item label="Total Amount Due">
              <el-input disabled v-model="loan.total_amount_due">
                <template slot="prepend">PHP</template>
              </el-input>
            </el-form-item>
          </el-col>
        </el-row>
      </el-form>

       </el-card>
      <el-card>

         <div slot="header" class="clearfix">
    <span>Payment Details</span>
        <el-button
            type="success"
            style="float:right;"
            @click="openDialog"
            round
            size="small"
          >Add Payment</el-button>
  </div>
      <br>
      <el-row>
        <el-col>
          <el-table :data="payments" stripe border style="width: 100%">
            <el-table-column prop="date_of_payment" label="Date" width="180"></el-table-column>
            <el-table-column prop="beginning_balance" label="Beginning Balance" width="180"></el-table-column>
            <el-table-column prop="paid_interest" label="Paid Interest"></el-table-column>
            <el-table-column prop="paid_principal" label="Paid Principal"></el-table-column>
            <el-table-column prop="ending_balance" label="Ending Balance"></el-table-column>
          </el-table>
        </el-col>
      </el-row>
     
      <el-row>
        <el-col>
          <h5  style="float:right;">Interest Balance : {{(caltotInterest).toFixed(2)}} </h5>

        </el-col>
        <el-col>
                    <h5  style="float:right;">Principal Balance: {{(calcTotprincipalPaid).toFixed(2)}} </h5>
        
        </el-col>
        <el-col>
            <h5  style="float:right;">Total Balance: {{(caltotInterest + calcTotprincipalPaid).toFixed(2)}}</h5>
        </el-col>
      </el-row>
      </el-card>
      
   

    <el-dialog title="Add Payment" :visible.sync="dialogAdd" width="60%">
      <el-form ref="form" :model="form" size="small" label-position="top">
        <el-row :gutter="5">
          <el-col :md="12">
            <el-form-item label="payment date">
              <el-date-picker
                style="width:100%;"
                v-model="form.date_of_payment"
                type="date"
                placeholder="Please Select date"
              ></el-date-picker>
            </el-form-item>
          </el-col>
          <el-col :md="12">
            <el-form-item label="Beginning Balance">
              <el-input v-model="form.beginning_balance" :value="calculateBeginningbal"></el-input>
            </el-form-item>
          </el-col>
          <el-col :md="12">
            <el-form-item label="Paid Interest">
              <el-input v-model="form.paid_interest" :value="caltotInterest"></el-input>
            </el-form-item>
          </el-col>
          <el-col :md="12">
            <el-form-item label="Paid Principal">
              <el-input v-model="form.paid_principal" :value="calcTotprincipalPaid"></el-input>
            </el-form-item>
          </el-col>
          <el-col :md="24">
            <el-form-item label="Ending Balance">
              <el-input :value="calculateEndingBal" v-model="form.ending_balance"></el-input>
            </el-form-item>
          </el-col>
          <el-col>
            <el-button type="primary" size="small" @click="savePayment">Save Payment</el-button>
          </el-col>
        </el-row>
      </el-form>
    </el-dialog>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loan: {
        member: { name: "" }
      },
      form: {
        date_of_payment: new Date(),
        beginning_balance: 0.0,
        paid_interest: 0.0,
        paid_principal: 0.0,
        ending_balance: 0.0,
        member_loan_id:this.$route.params.loanid
      },
      dialogAdd: false,
      payments:[]
    };
  },
  methods: {
    openDialog(){
      this.dialogAdd=true
    },
    calBeginingBal(){
            let total_interest_paid = 0;
      let total_principal_paid = 0;
      this.payments.forEach(el => {
        total_interest_paid = parseFloat(el.paid_interest) + parseFloat(total_interest_paid)
        total_principal_paid = parseFloat(total_principal_paid) + parseFloat(el.paid_principal)
      });
      this.form.beginning_balance =
        parseFloat(this.loan.total_amount_due) -
        (parseFloat(total_interest_paid) + parseFloat(total_principal_paid));
 
    },
    savePayment(){
      
      axios.post('/api/loanpayment/create',this.form).then(res=>{
        this.payments.push(res.data)
                      
                    this.$swal({
            type: 'success',
            title: 'Save',
            text: 'Save Successfully!'
        });

        this.dialogAdd=false

             form= {
        date_of_payment: new Date(),
        beginning_balance: 0.0,
        paid_interest: 0.0,
        paid_principal: 0.0,
        ending_balance: 0.0,
        member_loan_id:this.$route.params.loanid
      }


      })
    }
  },

  computed: {
    calculateEndingBal() {
      let total;
      try {
        total =
          parseFloat(this.form.beginning_balance) -
          (parseFloat(this.form.paid_interest) +
            parseFloat(this.form.paid_principal));
        console.log(total);
      } catch (err) {
        total = 0;
      }

      this.form.ending_balance = total;
      return total;
    },
    calculateBeginningbal(){
      let total_interest_paid = 0;
      let total_principal_paid = 0;
      this.payments.forEach(el => {
        total_interest_paid = parseFloat(el.paid_interest) + parseFloat(total_interest_paid);
        total_principal_paid = parseFloat(total_principal_paid) + parseFloat(el.paid_principal);
      });

      
      this.form.beginning_balance =
        parseFloat(this.loan.total_amount_due) -
        (parseFloat(total_interest_paid) + parseFloat(total_principal_paid));

        return total_interest_paid+total_principal_paid
    },
    caltotInterest(){
      let total_interest_paid = 0;
      this.payments.forEach(el => {
        total_interest_paid = parseFloat(el.paid_interest) + parseFloat(total_interest_paid);
      });
        let interest=parseFloat(this.loan.principal_amount) * parseFloat(this.loan.interest_rate)
        let bal=interest-total_interest_paid
        let interest_monthly=(parseFloat(this.loan.principal_amount) * parseFloat(this.loan.interest_rate))/parseFloat(this.loan.term_id)
    
        if(bal>=interest_monthly){
       //   console.log('diri')
           this.form.paid_interest=(parseFloat(this.loan.principal_amount) * parseFloat(this.loan.interest_rate))/parseFloat(this.loan.term_id)
         // return (parseFloat(this.loan.principal_amount) * parseFloat(this.loan.interest_rate))/parseFloat(this.loan.term_id)
   
        }
        else{
           this.form.paid_interest=bal
           //return bal
        }

        return bal

       
    },
    calcTotprincipalPaid(){
            let total_principal_paid = 0;
      this.payments.forEach(el => {
        total_principal_paid = parseFloat(el.paid_principal) + parseFloat(total_principal_paid);
      });
       
        let bal=this.loan.principal_amount-total_principal_paid
        let principal_monthly=(parseFloat(this.loan.principal_amount))/parseFloat(this.loan.term_id)
    
        if(bal>=principal_monthly){
          console.log('diri')
           this.form.paid_principal=principal_monthly
           //  return principal_monthly
        }
        else{
           this.form.paid_principal=bal
         //  return bal
        }

        return bal
    }
  },
  mounted() {
    axios.get("/api/memberloan/show/" + this.$route.params.loanid).then(res => {
      this.loan = res.data;
      this.payments=res.data.loan_payments
      this.loan.principal_amount = this.loan.principal_amount.toFixed(2);
      this.loan.total_amount_due = this.loan.total_amount_due.toFixed(2);

     // this.form.paid_interest=(parseFloat(this.loan.principal_amount) * parseFloat(this.loan.interest_rate))/parseFloat(this.loan.term_id)
      //this.form.paid_principal=((parseFloat(this.loan.total_amount_due))-(parseFloat(this.loan.principal_amount) * parseFloat(this.loan.interest_rate)))/parseFloat(this.loan.term_id)
      
   


      this.calBeginingBal()

    });
  }
};
</script>

<style>
</style>
