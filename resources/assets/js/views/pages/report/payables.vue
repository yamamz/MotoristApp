<template>
  <div>
     <el-card>
      <div slot="header" class="clearfix">
                <el-button
          type="primary"
          style="float:right; margin:2px;"
          icon="el-icon-printer"
          size="mini"
          @click="print(selected_range)"
          :disabled="members.length==0"
        >Print</el-button>
        <el-select v-model="selected_range"   style="float:right; margin:2px;" placeholder="Select Range">
          <el-option v-for="range in rangesDate" :label="range.label" :value="range.value" :key="range.value" ></el-option>
        </el-select>

      </div>
      <v-client-table :data="motorReleases" :columns="headers"></v-client-table>
     </el-card>
         <!-- <div class="lds-css ng-scope overlay"><div style="width:100%;height:100%" class="lds-double-ring"><div></div><div></div></div></div> -->
  
  
  </div>
</template>

<script>
import pdfMake from "pdfmake/build/pdfmake";
import pdfFonts from "pdfmake/build/vfs_fonts";
pdfMake.vfs = pdfFonts.pdfMake.vfs;
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
   
    
      ]
    };
  },
  methods: {
     print(range){
       let total_due=0
      let filterMotorrelease=[]
      if(range==0){
        filterMotorrelease=this.motorReleases.filter(el=>{
               var date = new Date()
        let date_recieved=new Date(el.date_recieved)
        console.log(date_recieved.getDate)
            return (date_recieved.getUTCDate() >= 1 && date_recieved.getUTCDate() <= 15) && date_recieved.getUTCMonth()  != date.getUTCMonth() || (date_recieved.getUTCMonth()  == date.getUTCMonth() && date_recieved.getUTCFullYear() != date.getUTCFullYear())
            })
      }
      else if(range == 1){
        filterMotorrelease=this.motorReleases.filter(el=>{
               var date = new Date()
        let date_recieved=new Date(el.date_recieved)
            return (date_recieved.getUTCDate() >= 16 && date_recieved.getUTCDate() <= 31) && date_recieved.getUTCMonth()  != date.getUTCMonth() || (date_recieved.getUTCMonth()  == date.getUTCMonth() && date_recieved.getUTCFullYear() != date.getUTCFullYear())
            })
      }
      else{
         filterMotorrelease=this.motorReleases.filter(el=>{
               var date = new Date()
        let date_recieved=new Date(el.date_recieved)
            return date_recieved.getUTCMonth()  != date.getUTCMonth() || (date_recieved.getUTCMonth()  == date.getUTCMonth() && date_recieved.getUTCFullYear() != date.getUTCFullYear())
            })
      }
      filterMotorrelease.forEach(el=>{
        total_due=total_due+el.monthly_due
      })
        let filterLoan=this.members.filter(el=>el.loan != null)
      
          {
      var dd = {
        pageOrientation: "landscape",
        content: [
          {
            stack: [
              
           "Visayan Riders Ministry Inc",
         
              	{text: 'Payables to members report', style: 'subheader'},

            ],
            style: "header"
          },

          {
            style: "tableExample",
            table: {
              widths: [20,40,"*", "*","*","*", 60, 60, 80,60,60],
              body: [
                [
                  { text: "#", bold: true, style: "tableHeader",color:"white", margin: [0, 5, 0, 5] },
                  { text: "Branch", bold: true, style: "tableHeader",color:"white", margin: [0, 5, 0, 5] },
                  { text: "Full Name", bold: true, style: "tableHeader",color:"white", margin: [0, 5, 0, 5] },
                  { text: "Contact", bold: true, style: "tableHeader",color:"white", margin: [0, 5, 0, 5] },
                   { text: "Release", bold: true, style: "tableHeader",color:"white", margin: [0, 5, 0, 5] },
              
                  {
                    text: "Unit",
                    bold: true,
                    style: "tableHeader",color:"white",
                     margin: [0, 5, 0, 5]
                  },
                        { text: "Monthly Due.", bold: true, style: "tableHeader",alignment: "right",color:"white", margin: [0, 5, 0, 5] },
                  { text: "VRMI Due", bold: true, style: "tableHeader",alignment: "right",color:"white", margin: [0, 5, 0, 5] },
                  { text: "Excess", bold: true, style: "tableHeader",alignment: "right",color:"white", margin: [0, 5, 0, 5] },
                  { text: "Cash Downlines", bold: true, style: "tableHeader",alignment: "right",color:"white", margin: [0, 5, 0, 5] },
                  { text: "Loan Downlines", bold: true, style: "tableHeader",alignment: "right",color:"white", margin: [0, 5, 0, 5] }
             
                ]
              ]
            },
            	layout: {
                	hLineWidth: function (i, node) {
					return (i === 0 || i === node.table.body.length) ? 1 : 0.5;
				},
				vLineWidth: function (i, node) {
					return (i === 0 || i === node.table.widths.length) ? 1 : 0.5;
				},
				hLineColor: function (i, node) {
					return (i === 0 || i === node.table.body.length) ? 'black' : 'gray';
				},
				vLineColor: function (i, node) {
					return (i === 0 || i === node.table.widths.length) ? 'black' : 'gray';
				},
        	fillColor: function (rowIndex, node, columnIndex) {
					return (rowIndex == 0) ? '#2196f3' : null;
				},
              },
          },
          {
            text:"Total Due: "+(total_due).toFixed(2),
            alignment:"right"
          },
          // {
          //   text:"Total Loan Members: "+filterLoan.length,
          //   alignment:"right"
          // }

        ],

        styles: {
          header: {
            fontSize: 30,
            bold: true,
            alignment: "left",
            margin: [0, 0, 0, 20]
          },
          subheader: {
            fontSize: 16,
    
      
          },
          tableExample: {
            margin: [0, 5, 0, 15]
          },
          tableHeader: {
            bold: true,
            fontSize: 11,
            color: "black"
          }
        },
        defaultStyle: {
          // alignment: 'justify'
        }
      };
      filterMotorrelease.forEach((el,index) => {
       
        let all_downlines=el.downlines
        let filter_loan=all_downlines.filter(e=>e.loan != null)
        dd.content[1].table.body.push([
            { text:index+1 , fontSize: 9,},
          { text: (el.branch != null) ? el.branch.name : "", fontSize: 9, },
          { text: `${el.member.last_name}, ${el.member.first_name}`, fontSize: 9, },
             { text: `${el.member.mobile_no}`, fontSize: 9, },
                { text: `${el.date_recieved}`, fontSize: 9, },
          { text: `${el.motor.brand_name} ${el.motor.description}`, fontSize: 9,},
          { text: (el.monthly_due).toFixed(2),alignment: "right", fontSize: 9,},
          { text: (el.member.monthly_amortization).toFixed(2),alignment: "right", fontSize: 9,},
          { text: (el.monthly_due-el.member.monthly_amortization).toFixed(2),alignment: "right", fontSize: 9,},
          { text: (all_downlines.length - filter_loan.length-1),alignment: "right", fontSize: 9,},
          { text:  filter_loan.length,alignment: "right", fontSize: 9,}
        ]);
      });
      pdfMake.createPdf(dd).open();
      }
      
      }
      
  },
  mounted() {

    
        axios.get("/api/motorrelease/all").then(res => {
        this.motorReleases = res.data;
        console.log(res.data)
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
     
        el.downlines=filtertree.filter(e=> e.level <= filtertree[0].level + 4)

      });
    })


    });
  }
};
</script>

<style>
.overlay{
  position: relative;
  top: 50;
  left: 150;
  width: 100%;
  height: 100%;
  z-index: 10;
  background-color: rgba(0,0,0,0.0); /*dim the background*/
}
@keyframes lds-double-ring {
  0% {
    -webkit-transform: rotate(0);
    transform: rotate(0);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-webkit-keyframes lds-double-ring {
  0% {
    -webkit-transform: rotate(0);
    transform: rotate(0);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes lds-double-ring_reverse {
  0% {
    -webkit-transform: rotate(0);
    transform: rotate(0);
  }
  100% {
    -webkit-transform: rotate(-360deg);
    transform: rotate(-360deg);
  }
}
@-webkit-keyframes lds-double-ring_reverse {
  0% {
    -webkit-transform: rotate(0);
    transform: rotate(0);
  }
  100% {
    -webkit-transform: rotate(-360deg);
    transform: rotate(-360deg);
  }
}
.lds-double-ring {
  position: relative;
}
.lds-double-ring div {
  position: absolute;
  width: 160px;
  height: 160px;
  top: 20px;
  left: 20px;
  border-radius: 50%;
  border: 8px solid #000;
  border-color: #337ab7 transparent #337ab7 transparent;
  -webkit-animation: lds-double-ring 1s linear infinite;
  animation: lds-double-ring 1s linear infinite;
}
.lds-double-ring div:nth-child(2) {
  width: 140px;
  height: 140px;
  top: 30px;
  left: 30px;
  border-color: transparent #5bc0de transparent #5bc0de;
  -webkit-animation: lds-double-ring_reverse 1s linear infinite;
  animation: lds-double-ring_reverse 1s linear infinite;
}
.lds-double-ring {
  width: 200px !important;
  height: 200px !important;
  -webkit-transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
  transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
}
</style>
