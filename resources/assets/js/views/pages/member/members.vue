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
          :disabled="memberss.length==0"
        >Print</el-button>
      </div>
 <v-client-table :data="members" :columns="headers">
    <template slot="Actions" slot-scope="props">
      <div>
        <el-button  size="mini" icon="el-icon-view" circle @click="viewChart(props.row.id)" type="primary"></el-button>
       <el-button  size="mini" icon="el-icon-edit" circle @click="editMember(props.row.id)" type="success"></el-button>
       <el-button  size="mini" icon="el-icon-delete" circle @click="deleteMember(props.row.id)" type="warning"></el-button>
   
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
        countloan:0,
        memberss:[]
       
      }
    },
    methods:{


      deleteMember(id){
        this.$swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          axios.post('/api/member/delete/'+id).then(res => {
            if (res.data.isDelete == true) {
              this.members.splice(
                this.members.findIndex(function(i) {
                  return i.id === id;
                }),
                1
              );
               this.$swal.fire("Deleted!", "Your file has been deleted.", "success");
            }
            else{
            this.$swal.fire("Not Delete!", "Node has children please attatch the children first", "error");
            }
            {

            }
          });
        }
      });

      console.log(id);


 
      },
      viewChart(member){
        this.$router.push('/member/chart/'+member)
      },
      editMember(member){
      this.$router.push('/member/edit/'+member)
      },
      printMembers(){
      let mems=this.memberss.sort((a, b) => a.hasMotor > b.hasMotor ? -1 : (a.hasMotor < b.hasMotor ? 1 : 0))
      let filterLoan=this.memberss.filter(el=>el.loan != null)
      console.log(mems)
          {
      var dd = {
        pageOrientation: "landscape",
        content: [
          {
            stack: [  
           "Visayan Riders Ministry Inc",
            {text: 'Registered Members', style: 'subheader'}
            ],
            style: "header"
          },

          {
            style: "tableExample",
            table: {
              widths: [20,"*", "*", 80, 60, 80,30,30,60,60,40],
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
                  { text: "Amortization", bold: true, style: "tableHeader",alignment: "right",color:"white", margin: [0, 5, 0, 5] },
                  { text: "Donation Free", bold: true, style: "tableHeader",alignment: "right",color:"white", margin: [0, 5, 0, 5] },
                  { text: "left", bold: true, style: "tableHeader",alignment: "right",color:"white", margin: [0, 5, 0, 5] },
                  { text: "right", bold: true, style: "tableHeader",alignment: "right",color:"white", margin: [0, 5, 0, 5] },
                  { text: "has Motor", bold: true, style: "tableHeader",alignment: "right",color:"white", margin: [0, 5, 0, 5] },
                  { text: "downlines", bold: true, style: "tableHeader",alignment: "right",color:"white", margin: [0, 5, 0, 5] },
                  { text: "is Loan", bold: true, style: "tableHeader",alignment: "right",color:"white", margin: [0, 5, 0, 5] },

          
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
      this.memberss.forEach((el,index) => {
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
      let hasLeft=""
      let hasRight=""
      if(el.childs.length >= 1){
        hasLeft="ok"
      }else{
        hasLeft="none"  
      }

      if(el.childs.length >= 2){
        hasRight="ok"
      }else{
        hasRight="none"
      }
        let isLoan=""
       if(el.loan != null){
         if(el.loan.is_paid == 1){
           isLoan="paid"
         }
         else{
           isLoan="yes"
         }
       }else{
         isLoan="no"
       }
        // ?"yes":"no"

        dd.content[1].table.body.push([
            { text:index+1 , fontSize: 11,},
          { text: `${el.last_name}, ${el.first_name}`, fontSize: 11, },
          { text: el.address, fontSize: 11,},
          { text: el.mobile_no,alignment: "right", fontSize: 11,},
          { text: (el.monthly_amortization).toFixed(2),alignment: "right", fontSize: 11,},
          { text: (el.registration).toFixed(2),alignment: "right", fontSize: 11,},
          { text: hasLeft,alignment: "right", fontSize: 11,},
          { text: hasRight,alignment: "right", fontSize: 11,},
          { text: el.motor_release != null ?"yes":"none",alignment: "right", fontSize: 11,},
          { text: el.downlines.length,alignment: "right", fontSize: 11,},
                            { text:isLoan,alignment: "right", fontSize: 11,},
        ]);
      });

      pdfMake.createPdf(dd).open();
      }
      }
    },
    created(){
     
      axios.get('/api/member/all').then(res=>{
      //console.log(res.data)
      this.members=res.data
      this.members.forEach(el=>{
        el.fullname=`${el.last_name}, ${el.first_name}`
      })
    })

      axios.get("/api/member/all/withtree").then(ress=>{
      this.memberss=ress.data
      this.memberss.forEach(el => {
        el.fullname=`${el.last_name}, ${el.first_name}`
        el.downlines=el.tree.filter(e=> e.depth <= el.tree[0].depth + 4 && e.depth != el.tree[0].depth)
        el.childs=el.tree.filter(ee=>ee.parent_id==el.tree[0].id)

        if( el.motor_release != null)
        {
          el.hasMotor="yes"
        }else{
           el.hasMotor="none"
        }

      });

      console.log(this.memberss)
    })

    }

  }
</script>