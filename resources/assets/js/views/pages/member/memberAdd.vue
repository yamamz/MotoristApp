<template>
  <div>
    <el-card>
      <h5>Add Member</h5>
      <el-form label-position="top" v-model="form" size="small">
        <el-row :gutter="5">
          <el-col :md="8">
            <el-form-item label="First Name">
              <el-input name="first_name" v-validate="'required'" v-model="form.first_name"></el-input>

            </el-form-item>
          </el-col>
          <el-col :md="8">
            <el-form-item label="Middle Name">
              <el-input v-model="form.middle_name"></el-input>
            </el-form-item>
          </el-col>
          <el-col :md="8">
            <el-form-item  label="Last Name">
              <el-input v-validate="'required'" name="last_name" v-model="form.last_name"></el-input>
            </el-form-item>
          </el-col>
               <el-col :md="8">
            <el-form-item label="Location">
              <el-select  style="width:100%;" v-model="form.location_id">
                  <el-option v-for="location in locations"  :key="location.id" :value="location.id" :label="location.name"></el-option>
              </el-select>
            </el-form-item>
          </el-col>
          <el-col :md="8">
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
            <el-form-item label="Birthdate">
              <el-date-picker
                style="width:100%;"
                v-model="form.birthdate"
                type="date"
                placeholder="Please Select date"
              ></el-date-picker>
            </el-form-item>
          </el-col>
          <el-col :md="8">
            <el-form-item label="Monthly Amortization">
              <el-select
                style="width:100%;"
                placeholder="Please Select Monthly"
                v-model="form.monthly_amortization"
                v-validate="'required'"
              >
                <el-option v-for="(val,index) in monthly_amortization" :key="index" :value="val"></el-option>
              </el-select>
            </el-form-item>
          </el-col>
          <el-col :md="8">
            <el-form-item label="Upline">
              <el-select
                style="width:100%;"
                placeholder="Please Select you Upline"
                filterable
                v-model="form.parent_id"
              >
                <el-option
                  v-for="(val,index) in filterParent"
                  :key="index"
                  :label="`${val.name} ${val.first_name} ${val.last_name}`"
                  :value="val.id"
                ></el-option>
              </el-select>
            </el-form-item>
          </el-col>
          <el-col :md="8">
            <el-form-item label="Membership Donation Fee">
              <el-input v-validate="'required'" type="number" v-model="form.registration"></el-input>
            </el-form-item>
          </el-col>

          <el-col :md="8">
            <el-form-item label="Gender">
              <el-select style="width:100%;" v-model="form.image" placeholder="Select Gender">
                <el-option
                  v-for="(val,index) in image_avatars"
                  :key="index"
                  :label="val.label"
                  :value="val.value"
                ></el-option>
              </el-select>
            </el-form-item>
          </el-col>
    
          <el-card>

        
          <el-col :md="24">
              <el-table :data="form.trasaction_recs">
      
                <el-table-column prop="account_name" label="Account">

                </el-table-column>
                   <el-table-column  label="Debit">
    <template slot-scope="scope" v-if="scope.row.type== 'debit'">
      {{ scope.row.ammount }}
    </template>
                </el-table-column>
                <el-table-column prop="ammount" label="Credit">
                        <template slot-scope="scope" v-if="scope.row.type== 'credit'">
      {{ scope.row.ammount }}
    </template>
                </el-table-column>
              </el-table>
          </el-col>
            </el-card>
            <br>
          <el-col :md="8">
            <el-button :disabled="debitamt != creditamt || (debitamt == 0 || creditamt == 0)" @click="saveMember" type="success" size="small">Add Member</el-button>
                <el-button @click="dialogAdd=true" type="primary" size="small">Add Journal Entry</el-button>
          </el-col>
          <el-col :md="16">
              <template  v-show="errors.any()">
                <div>
                    <el-alert
                         v-if="errors.has('first_name')"
                    :title="errors.first('first_name') "

    type="warning">
  </el-alert>
                </div>
              </template>
          </el-col>
        </el-row>
      </el-form>
    </el-card>

  <el-dialog title="Add Journal Entry" :visible.sync="dialogAdd" width="40%">
      <el-form ref="form1" :model="form1" size="small" label-position="top">
        <el-row :gutter="5">
               <el-col :md="24">
              <el-form-item label="account">
              <el-select style="width:100%;" placeholder="Select Account" v-model="form1.account">
                <el-option v-for="account in accounts" :key="account.id" :label="`${account.account_code} ${account.name}`" :value="account"></el-option>  
              </el-select>
              </el-form-item>
            </el-col> 
          <el-col :md="12">
            <el-form-item label="Type">
              <el-select style="width:100%;" placeholder="Select Type" v-model="form1.type">
                <el-option v-for="type in types" :key="type" :label="type" :value="type"></el-option>  
              </el-select>
              </el-form-item>
            </el-col> 
                 <el-col :md="12">
            <el-form-item label="Ammount">
              <el-input style="width:100%;" placeholder="Enter Ammount" v-model="form1.ammount">
                  </el-input>
              </el-form-item>
            </el-col>
            <el-button type="primary" @click="addJournal" size="small">Add</el-button>  
       

        </el-row>
      </el-form>
    </el-dialog>

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

.el-form-item__content .el-input-group,
.el-form-item__label,
.el-tag .el-icon-close {
  vertical-align: middle;
}

label {
  display: inline-block;
  margin-bottom: 0.5rem;
}
</style>


<script>
export default {
  data() {
    return {
      image_avatars: [
        { label: "female", value: "/images/avatar2.png" },
        { label: "male", value: "/images/avatar.png" }
      ],
      monthly_amortization: [2800, 3000],
 rules: {
        first_name: 'required',
    
      },
      dialogAdd:false,
      types:["debit","credit"],
      form1:{
        ammount:8000,
        type:"",
        account:null,

      },
      form: {
        first_name: "",
        middle_name: "",
        last_name: "",
        mobile_no: "",
        age: "",
        address: "",
        birthdate: "",
        registration: 8000,
        monthly_amortization: 3000,
        image: "",
        parent_id: "",
        account_id:"",
        location_id:"",
        trasaction_recs:[]
      },
      members: [{ first_name: "", last_name: "" }],
      accounts:[],
      locations:[],
      debitamt:0,
      creditamt:0
    };
  },
  mounted() {

    axios.get('/api/account/all').then(res=>{
      this.accounts=res.data
    })
        axios.get('/api/location/all').then(res=>{
      this.locations=res.data
    })
    axios.get("/api/member/all").then(res => {
      console.log(res.data);
      this.members = res.data;
      this.members.forEach(el => {
        el.label = `${el.id} - ${el.first_name} ${el.last_name}`;
        let childCount = 0;
        this.members.forEach(e => {
          if (e.parent_id == el.id) {
            childCount++;
          }
        });
        el.childCount = childCount;
      });
    });
  },

  methods: {
    addJournal(){
      this.form.trasaction_recs.push({type:this.form1.type,account_id:this.form1.account.id,account_name:`${this.form1.account.account_code} ${this.form1.account.name}`,ammount:this.form1.ammount})
    
          this.form1={
        ammount:8000,
        type:"",
        account:"",
      }
        let debit=0
        let credit=0
        this.form.trasaction_recs.forEach(el=>{
          if(el.type=='debit'){
            debit=debit+el.ammount
          }else{
            credit=credit+el.ammount
          }
 

        })
                 this.debitamt=debit
                 this.creditamt=credit
      this.dialogAdd=false
      console.log(this.form.trasaction_recs)
    },
    saveMember() {
      axios.post("/api/member/searchByName", this.form).then(resp => {
        if (resp.data.exist == false) {
          axios
            .post("/api/member/create", this.form)
            .then(res => {
              this.$swal({
                type: "success",
                title: "Save",
                text: "Save Member Successfully!"
              });
              this.$router.push("/member");
            })
            .catch(err => {
              this.$swal({
                type: "error",
                title: "error",
                text: "Error Occur!"
              });
            });
        } else {
          this.$swal
            .fire({
              title: "member already exist!",
              text: "Are you sure do want to save?",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes, save it!"
            })
            .then(result => {
              if (result.value) {
                axios
                  .post("/api/member/create", this.form)
                  .then(res => {
                    this.$swal({
                      type: "success",
                      title: "Save",
                      text: "Save Member Successfully!"
                    });
                    this.$router.push("/member");
                  })
                  .catch(err => {
                    this.$swal({
                      type: "error",
                      title: "error",
                      text: "Error Occur!"
                    });
                  });
              }
            });
        }
      });
    }
  },
  computed: {
    filterParent() {
      return this.members.filter(el => el.childCount < 2);
    }
  }
};
</script>
