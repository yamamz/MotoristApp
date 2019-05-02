<template>
  <div id="top">
      <el-card>
      <h5>Add Motor Release</h5>
      <el-form ref="form1" size="small" label-position="top" :model="form1">
        <el-row :gutter="5">
          <el-col :md="12">
            <el-form-item label="Member Name">
              <el-select
                filterable
                placeholder="please select member"
                v-model="form1.member_id"
                style="width:100%;"
              >
                <el-option
                  v-for="member in filterParent"
                  :key="member.id"
                  :label="`${member.first_name} ${member.last_name}`"
                  :value="member.id"
                ></el-option>
              </el-select>
            </el-form-item>
          </el-col>
          <el-col :md="12">
            <el-form-item label="Motor Brand">
              <el-select
              filterable
                placeholder="please select motor brand"
                v-model="form1.motor_id"
                style="width:100%;"
              >
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
            <el-form-item label="Date Recieved">
              <el-date-picker
                @change="getDay"
                style="width:100%;"
                v-model="form1.date_recieved"
                type="date"
                placeholder="Please Select date"
              ></el-date-picker>
            </el-form-item>
          </el-col>
          <el-col :md="12">
            <el-form-item label="Due Date">
              <el-input v-model="form1.due_date"></el-input>
            </el-form-item>
          </el-col>

          <el-col :md="12">
            <el-form-item label="Monthly Due">
              <el-input v-model="form1.monthly_due" type="number"></el-input>
            </el-form-item>
          </el-col>
          <el-col :md="12">
            <el-form-item label="Down Payment">
              <el-input v-model="form1.down_payment" type="number"></el-input>
            </el-form-item>
          </el-col>
            <el-col :md="12">
            <el-form-item label="Branch">
             <el-select
                placeholder="please select branch"
                v-model="form1.branch_id"
                style="width:100%;"
              >
                <el-option
                  v-for="motor in branches"
                  :key="motor.id"
                  :value="motor.id"
                  :label="motor.name"
                ></el-option>
              </el-select>
            </el-form-item>
          </el-col>
          <el-col :md="12">
            <el-form-item label="Loan">
              <el-checkbox v-model="form1.is_loan">Is this a Loan</el-checkbox>
            </el-form-item>
          </el-col>

          <el-col>
            <el-button type="primary" v-if="form1.id==null" @click="saveRelease" size="mini">Save</el-button>
            <el-button type="primary" v-else @click="update" size="mini">update</el-button>
          </el-col>
        </el-row>
      </el-form>
    </el-card>
    <el-card>
            <div slot="header" class="clearfix">
        <el-button
          type="primary"
          style="float:right; margin:2px;"
          icon="el-icon-printer"
          size="mini"
          @click="print"
        >Print</el-button>
      </div>
      <v-client-table :data="motorreleases" :columns="headers">
        <template slot="Actions" slot-scope="props">
          <div>
            <el-button size="mini" icon="el-icon-view" circle  type="primary"></el-button>
            <a href="#top"><el-button size="mini" icon="el-icon-edit"  circle @click="edit(props.row.id)" type="success"></el-button></a>
          </div>
        </template>
      </v-client-table>
    </el-card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      motors: [],
      members: [{ first_name: "", last_name: "" }],
      headers: ["id", "fullname", "motorname", "monthly_due", "Actions"],
      motorreleases: [],
      branches:[],
      form1: {
        id: null,
        member_id: "",
        down_payment: 0,
        motor_id: "",
        monthly_due: 0,
        date_recieved: null,
        due_date: "",
        is_loan: false,
        branch_id:""
      }
    };
  },
  mounted() {
        axios.get('/api/branch/all').then(res=>{
        this.branches=res.data
    })
    axios.get("/api/motor/all").then(res => {
      console.log(res.data);
      this.motors = res.data;
    });

    this.getmotorrelease();

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
    edit(id){
      
      let release=this.motorreleases.find(el=>el.id===id)
      console.log(release)
      if(release.is_loan == 1){
        release.is_loan=true
      }else{
          release.is_loan=false
      }
      this.form1=release
    },
    getmotorrelease() {
      axios.get("/api/motorrelease/all").then(res => {
        console.log(res.data);
          this.motorreleases = res.data;
          this.motorreleases.forEach(el => {
          el.motorname = el.motor.brand_name + " " + el.motor.description;
          el.fullname = el.member.title;
        });
      });
    },
    getDay() {
      let day = this.form1.date_recieved.getDate();
      console.log(day);
      this.form1.due_date = "Every " + day + " of the Month";
    },
    update(){
      axios.post("/api/motorrelease/update/"+this.form1.id, this.form1).then(res=>{
           this.$swal({
            type: "success",
            title: "update",
            text: "Update  Successfully!"
          });
          console.log(res.data)
          this.getmotorrelease();
          this.form1 = {
            id: null,
            member_id: "",
            down_payment: 0,
            motor_id: "",
            monthly_due: 0,
            date_recieved: null,
            due_date: "",
            is_loan: false
          };
      }).catch(err => {
          this.$swal({
            type: "error",
            title: "error",
            text: "Error Occur!"
          });
        });
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
          this.getmotorrelease();
          this.form1 = {
            id: null,
            member_id: "",
            down_payment: 0,
            motor_id: "",
            monthly_due: 0,
            date_recieved: null,
            due_date: "",
            is_loan: false
          };
        })
        .catch(err => {
          this.$swal({
            type: "error",
            title: "error",
            text: "Error Occur!"
          });
        });
    }
  },
  computed: {
    filterParent() {
      return this.members.filter(el => el.motor_release == null);
    }
  }
};
</script>

<style>
</style>
