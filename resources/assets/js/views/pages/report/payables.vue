<template>
  <div>
    <el-card>
      <div slot="header" class="clearfix">
                <el-button
          type="primary"
          style="float:right; margin:2px;"
          icon="el-icon-printer"
          size="mini"
          @click="print"
        >Print</el-button>
        <el-select v-model="selected_range"   style="float:right; margin:2px;" placeholder="Select Range">
          <el-option v-for="range in rangesDate" :label="range.label" :value="range.value" :key="range.value" ></el-option>
        </el-select>

      </div>
      <v-client-table :data="motorReleases" :columns="headers"></v-client-table>
    </el-card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      selected_range:'',
      rangesDate:[{label:"1-15 of the month",value:0},{label:"16-30 of the month",value:1},{label:"Whole Month",value:2}],
      motorReleases: [],
      members:[],
      headers: [
        "id",
        "fullname",
        "motorname",
        "monthly_due",
        "vrmi_due",
        "excess",
        "downlines"
    
      ]
    };
  },
  methods: {
    print() {}
  },
  mounted() {

    
        axios.get("/api/motorrelease/all").then(res => {
        this.motorReleases = res.data;
              this.motorReleases.forEach(el => {
        el.motorname = el.motor.brand_name + " " + el.motor.description;
        el.fullname = el.member.title;
        el.vrmi_due = el.member.monthly_amortization;
        el.excess = el.monthly_due - el.member.monthly_amortization;
              })

  axios.get("/api/member/all/withtree").then(ress=>{
      this.members=ress.data
      this.motorReleases.forEach(el => {

        let member=this.members.find(e=>e.id === el.member.id)
        console.log(member)
        let filtertree=member.tree
     
        el.downlines=filtertree.filter(e=> e.level <= filtertree[0].level + 4).length -1

        

      });
    })


    });
  }
};
</script>

<style>
</style>
