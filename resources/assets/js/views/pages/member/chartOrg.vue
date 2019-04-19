<template>
  <div>
    <el-row :gutter="5">
      <el-col :md="18">
        <el-card>
          <div id="chart"></div>
        </el-card>
      </el-col>
      <el-col :md="6">
        <el-card>
          <el-row>
            <br>
            <br>
            <el-col :md="6">
              <h4>Member</h4>
            </el-col>
            <el-col :md="18" style="color:blue;  text-align: right;">
              <h4>{{member.first_name}} {{member.last_name}}</h4>
            </el-col>
          </el-row>
          <el-row>
            <el-col :md="6">
              <h4>Status</h4>
            </el-col>
            <el-col :md="18" style="color:blue;  text-align: right;">
              <h4>{{member.className}}</h4>
            </el-col>
          </el-row>
          <el-row>
            <el-col :md="6">
              <h4>Upline</h4>
            </el-col>
            <el-col :md="18" v-if="upline != null" style="color:blue;  text-align: right;">
              <h4>{{upline.first_name}} {{upline.last_name}}</h4>
            </el-col>
            <el-col :md="18" v-else style="color:blue;  text-align: right;">
              <h4>You Are the root</h4>
            </el-col>
          </el-row>
          <el-row>
            <el-col :md="6">
              <h4>Downlines</h4>
            </el-col>
            <el-col :md="18" style="color:blue;  text-align: right;">
              <h4>{{downlinesCount}}</h4>
            </el-col>
          </el-row>
          <el-row>
            <el-col :md="16">
              <h4>Paid Months</h4>
            </el-col>
            <el-col :md="8" style="color:blue;  text-align: right;">
              <h4>{{downlinesCount}}</h4>
            </el-col>
          </el-row>
          <el-row :gutter="5">
            <el-col :md="14">
              <el-button type="success" @click="dialogAdd=true" size="small">Add Downline</el-button>
            </el-col>
            <el-col :md="10">
              <el-button type="danger" @click="dialogRelease=true" size="small">Release</el-button>
            </el-col>
          </el-row>
        </el-card>
      </el-col>
    </el-row>

    <el-dialog title="Release Motorcycle" :visible.sync="dialogRelease" width="60%">
      <el-form ref="form1" size="small" label-position="top" :model="form1" >
        <el-row :gutter="5">
      <el-col :md="12">
        <el-form-item label="Member Name">
          <el-select placeholder="please select member" v-model="form1.member_id" style="width:100%;">
            <el-option :label="`${member.first_name} ${member.last_name}`" :value="member.id"></el-option>
          </el-select>
        </el-form-item>
        </el-col>
    <el-col :md="12">
              <el-form-item label="Motor Brand">
          <el-select placeholder="please select motor brand" v-model="form1.motor_id" style="width:100%;">
            <el-option
              v-for="motor in motors"
              :key="motor.id"
              :value="motor.id"
              :label="`${motor.brand_name} ${motor.description}`"
            ></el-option>
          </el-select>
        </el-form-item>
    </el-col>
            
             <el-col :md="12">
            <el-form-item  label="Date Recieved">
            <el-date-picker @change="getDay" style="width:100%;"
      v-model="form1.date_recieved"
      type="date"
   
      placeholder="Please Select date">
    </el-date-picker>
            </el-form-item>
             </el-col>
             <el-col :md="12">
            <el-form-item  label="Due Date">
            <el-input v-model="form1.due_date" ></el-input>
            </el-form-item>
             </el-col>

             <el-col :md="3">
               <el-form-item label="is Loan">
                            <el-checkbox v-model="form1.is_loan">Loan</el-checkbox>
               </el-form-item>
    
             </el-col>
      <el-col :md="9">
     <el-form-item label="Down Payment">
          <el-input v-model="form1.down_payment" type="number"></el-input>
        </el-form-item>
      </el-col>
   
           <el-col :md="12">
   <el-form-item label="Monthly Due">
              <el-input v-model="form1.monthly_due" type="number"></el-input>
            </el-form-item>
             </el-col> 
         
            
  
            </el-row>
      </el-form>

      <span slot="footer" class="dialog-footer">
        <el-button @click="dialogRelease = false">Cancel</el-button>
        <el-button type="primary" @click="saveRelease">Save</el-button>
      </span>
    </el-dialog>

    <el-dialog title="Add Downline" :visible.sync="dialogAdd" width="60%">
     
        <el-form ref="form" :model="form" size="small"  label-position="top">
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
              <el-form-item label="Donation Fee">
                <el-input type="number" v-model="form.registration"></el-input>
              </el-form-item>
            </el-col>

            <el-col :md="8">
              <el-form-item label="Gender" >
                <el-select style="width:100%;" v-model="form.image" placeholder="Please Select gender">
                  <el-option
                    v-for="(val,index) in image_avatars"
                    :key="index"
                    :label="val.label"
                    :value="val.value"
                  ></el-option>
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :md="8">
           
            </el-col>
          </el-row>
        </el-form>
   

      <span slot="footer" class="dialog-footer">
        <el-button @click="dialogAdd = false">Cancel</el-button>
        <el-button type="primary" @click="saveMember">Save</el-button>
      </span>
    </el-dialog>
  </div>
</template>
<style scoped>
</style>


<script>
import OrgChart from "../../../helper/orgChart";
export default {
  data() {
    return {
      ds: {},
      member: {first_name:'',last_name:''},
      downlinesCount: 0,
      upline: {},
      dialogRelease: false,
      dialogAdd: false,
      form1: {
        member_id: "",
        down_payment: 0,
        motor_id: "",
        monthly_due:0,
        date_recieved:null,
        due_date:'',
        is_loan:false
      },
    
      form: {
        first_name: "",
        middle_name: "",
        last_name: "",
        mobile_no: "",
        age: "",
        address: "",
        birthdate: "",
        registration: "",
        monthly_amortization: "",
        image: "",
        parent_id: ""
      },
      motors: [],
      downlines: [{ first_name: "", last_name: "" }],
      image_avatars: [
        { label: "female", value: "/images/avatar2.png" },
        { label: "male", value: "/images/avatar.png" }
      ],
      monthly_amortization: [2800, 3000]
    }
  },
  methods: {
               getDay(){
            let day=this.form1.date_recieved.getDate()
            console.log(day)
            this.form1.due_date= "Every "+day+" of the Month"
        },
    getOrgData() {
      axios
        .get("/api/member/get/treeFlat/" + this.$route.params.id)
        .then(res => {
          console.log(res.data);
          this.downlines = res.data;
          this.downlines.forEach(el => {
            el.label = `${el.id} - ${el.first_name} ${el.last_name}`;
            let childCount = 0;
            this.downlines.forEach(e => {
              if (e.parent_id == el.id) {
                childCount++;
              }
            });
            el.childCount = childCount;
          });
        });
      var myNode = document.getElementById("chart");
      while (myNode.firstChild) {
        myNode.removeChild(myNode.firstChild);
      }

      axios.get("/api/member/get/" + this.$route.params.id).then(res => {
        this.ds = res.data[0];
        //console.log(res.data[0])

        let orgchart = new OrgChart({
          chartContainer: "#chart",
          data: this.ds,
          nodeContent: "title",
          depth: 4,
          zoom: true,
          pan: true,
          exportButton: true,
          exportFilename: "MyOrgChart"
        });
      });
    },

    saveMember() {
      axios
        .post("/api/member/create", this.form)
        .then(res => {
          this.$swal({
            type: "success",
            title: "Save",
            text: "Save Member Successfully!"
          });
          this.getOrgData();
           this.form= {
        first_name: "",
        middle_name: "",
        last_name: "",
        mobile_no: "",
        age: "",
        address: "",
        birthdate: "",
        registration: "",
        monthly_amortization: "",
        image: "",
        parent_id: ""
      }
        })
        .catch(err => {
          this.$swal({
            type: "error",
            title: "error",
            text: "Error Occur!"
          });
        });

        this.dialogAdd=false
    },
    saveRelease() {
      axios
        .post("/api/motorrelease/create", this.form1)
        .then(res => {
          this.$swal({
            type: "success",
            title: "Save",
            text: "Save  Successfully!"
          });
          this.dialogRelease = false;
          this.$router.push("/member/chart/" + this.$route.params.id);
        })
        .catch(err => {
          this.$swal({
            type: "error",
            title: "error",
            text: "Error Occur!"
          });
          this.dialogRelease = false;
        });
    }
  },
  computed: {
    filterParent() {
      return this.downlines.filter(el => el.childCount < 2);
    }
  },

  mounted() {
    axios.get("/api/motor/all").then(res => {
      this.motors = res.data;
    });

    axios.get("/api/member/show/" + this.$route.params.id).then(result => {
 
      this.member = result.data.member;
           console.log(this.member)
      this.downlinesCount = result.data.num_downLines;
      this.form.member_id = result.data.member.id;
      if (result.data.member.parent_id != null) {
        axios
          .get("/api/member/show/" + result.data.member.parent_id)
          .then(resp => {
            this.upline = resp.data.member;
          });
      } else {
        this.upline = null;
      }
    });

    this.getOrgData();
  }
};
</script>