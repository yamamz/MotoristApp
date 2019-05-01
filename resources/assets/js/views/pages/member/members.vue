<template>
<div>
<el-card>
         <div slot="header" class="clearfix">

        <el-button
          type="primary"
          style="float:right; margin:2px;"
         
          icon="el-icon-printer"
          size="mini"
          @click="printMembers"
        >Print</el-button>
      </div>
 <v-client-table :data="members" :columns="headers">
    <template slot="Actions" slot-scope="props">
      <div>
        <el-button  size="mini" icon="el-icon-view" circle @click="viewChart(props.row.id)" type="primary"></el-button>
       <el-button  size="mini" icon="el-icon-edit" circle @click="editMember(props.row.id)" type="success"></el-button>
      </div>
    </template>
    
 
   </v-client-table>

</el-card>
     

   

</div>
</template>

<script>
import pdfMake from "pdfmake/build/pdfmake";
import pdfFonts from "pdfmake/build/vfs_fonts";
pdfMake.vfs = pdfFonts.pdfMake.vfs;
  export default {
    data () {
      return {
        search: '',
        members:[],
        headers: ['id','first_name','last_name', 'address','monthly_amortization','Actions'],
        countloan:0
       
      }
    },
    methods:{
      
      viewChart(member){
        this.$router.push('/member/chart/'+member)
      },
      editMember(member){
      this.$router.push('/member/edit/'+member)
      },
      printMembers(){
      let mems=this.members.sort((a, b) => a.fullname < b.fullname ? -1 : (a.fullname > b.fullname ? 1 : 0))
      let filterLoan=this.members.filter(el=>el.loan != null)
      console.log(mems)
          {
      var dd = {
        pageOrientation: "landscape",
        content: [
          {
            stack: [
              
           "Visayan Riders Ministry Inc",
         
              	{text: 'Registered Members', style: 'subheader'},

            ],
            style: "header"
          },

          {
            style: "tableExample",
            table: {
              widths: [20,"*", "*", 80, 130, 160,"*"],
              body: [
                [
                    { text: "#", bold: true, style: "tableHeader",color:"white", margin: [0, 5, 0, 5] },
                  { text: "Full Name", bold: true, style: "tableHeader",color:"white", margin: [0, 5, 0, 5] },
                  {
                    text: "Address",
                    bold: true,
                    style: "tableHeader",color:"white",
                     margin: [0, 5, 0, 5]
                  },
                  { text: "Contact No.", bold: true, style: "tableHeader",alignment: "right",color:"white", margin: [0, 5, 0, 5] },
                  { text: "Monthly Amortization", bold: true, style: "tableHeader",alignment: "right",color:"white", margin: [0, 5, 0, 5] },
                  { text: "Membership Donation Free", bold: true, style: "tableHeader",alignment: "right",color:"white", margin: [0, 5, 0, 5] },
                  { text: "Is Loan", bold: true, style: "tableHeader",alignment: "right",color:"white", margin: [0, 5, 0, 5] }
             
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
            text:"Total Members: "+this.members.length,
            alignment:"right"
          },
          {
            text:"Total Loan Members: "+filterLoan.length,
            alignment:"right"
          }

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
      this.members.forEach((el,index) => {
        let loan=""
        let loanCount=0

        if(el.loan == null){
          loan="Cash"
        }
        else{
          loan= "Loan"
          loanCount++
        }
        this.countloan=loanCount
        dd.content[1].table.body.push([
            { text:index+1 , fontSize: 11,},
          { text: `${el.last_name}, ${el.first_name}`, fontSize: 11, },
          { text: el.address, fontSize: 11,},
          { text: el.mobile_no,alignment: "right", fontSize: 11,},
          { text: (el.monthly_amortization).toFixed(2),alignment: "right", fontSize: 11,},
          { text: (el.registration).toFixed(2),alignment: "right", fontSize: 11,},
          { text: loan,alignment: "right", fontSize: 11,}
        ]);
      });

      pdfMake.createPdf(dd).open();
      }
      }
    },
    created(){
     
      axios.get('/api/member/all').then(res=>{
      console.log(res.data)
      this.members=res.data
      this.members.forEach(el=>{
        el.fullname=`${el.last_name}, ${el.first_name}`
      })
    })
    // axios.get('/api/member/all/tree').then(res=>{
    //   console.log(res.data)

    // })
    }

  }
</script>