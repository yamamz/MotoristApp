<template>
  <div>
    <el-card>
      <h5>Member Loan List</h5>
      <div slot="header" class="clearfix">
        <el-button
          type="primary"
          style="float:right; margin:2px;"
          icon="el-icon-printer"
          size="mini"
          @click="print"
        >Print</el-button>
      </div>
      <v-client-table :options="options" :data="loans" :columns="headers">
        <template slot="Actions" slot-scope="props">
          <div>
            <el-button
              size="mini"
              icon="el-icon-view"
              circle
              @click="viewDetails(props.row.id)"
              type="primary"
            ></el-button>
            <el-button
              size="mini"
              icon="el-icon-edit"
              circle
              @click="editLoan(props.row.id)"
              type="success"
            ></el-button>
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
  data() {
    return {
      headers: [
        "id",
        "member.title",
        "principal_amount",
        "total_amount_due",
        "interest_rate",
        "Actions"
      ],
      loans: [],
      options: {
        headings: {
          "member.title": "Member"
        }
      }
    };
  },
  mounted() {
    axios
      .get("/api/memberloan/all")
      .then(res => {
        this.loans = res.data;
        console.log(res.data);
      })
      .catch(err => console.log(err));
  },
  methods: {
    print() {
       let loanss=this.loans.sort((a, b) => a.date_release < b.date_release ? -1 : (a.date_release > b.date_release ? 1 : 0))
     
      var dd = {
        pageOrientation: "landscape",
        content: [
          {
            stack: [
              "Visayan Riders Ministry Inc",

              { text: "List Of Loans", style: "subheader" }
            ],
            style: "header"
          },

          {
            style: "tableExample",
            table: {
              widths: [18, 120, 150, 70, "*", "*", "*", "*", "*", "*"],
              body: [
                [
                  {
                    text: "#",
                    bold: true,
                    style: "tableHeader",
                    color: "white",
                    margin: [0, 5, 0, 5]
                  },
                  {
                    text: "Full Name",
                    bold: true,
                    style: "tableHeader",
                    color: "white",
                    margin: [0, 5, 0, 5]
                  },
                  {
                    text: "Address",
                    bold: true,
                    style: "tableHeader",
                    color: "white",
                    margin: [0, 5, 0, 5]
                  },
                  {
                    text: "Contact#",
                    bold: true,
                    style: "tableHeader",
                    alignment: "right",
                    color: "white",
                    margin: [0, 5, 0, 5]
                  },
                  {
                    text: "Release",
                    bold: true,
                    style: "tableHeader",
                    color: "white",
                    margin: [0, 5, 0, 5]
                  },

                  {
                    text: "Principal",
                    bold: true,
                    style: "tableHeader",
                    alignment: "right",
                    color: "white",
                    margin: [0, 5, 0, 5]
                  },

                  {
                    text: "Term",
                    bold: true,
                    style: "tableHeader",
                    alignment: "right",
                    color: "white",
                    margin: [0, 5, 0, 5]
                  },
                  {
                    text: "Interest",
                    bold: true,
                    style: "tableHeader",
                    alignment: "right",
                    color: "white",
                    margin: [0, 5, 0, 5]
                  },
                  {
                    text: "Total Amount Due",
                    bold: true,
                    style: "tableHeader",
                    alignment: "right",
                    color: "white",
                    margin: [0, 5, 0, 5]
                  },
                  {
                    text: "Balance",
                    bold: true,
                    style: "tableHeader",
                    alignment: "right",
                    color: "white",
                    margin: [0, 5, 0, 5]
                  }
                ]
              ]
            },
            layout: {
              hLineWidth: function(i, node) {
                return i === 0 || i === node.table.body.length ? 1 : 0.5;
              },
              vLineWidth: function(i, node) {
                return i === 0 || i === node.table.widths.length ? 1 : 0.5;
              },
              hLineColor: function(i, node) {
                return i === 0 || i === node.table.body.length
                  ? "black"
                  : "gray";
              },
              vLineColor: function(i, node) {
                return i === 0 || i === node.table.widths.length
                  ? "black"
                  : "gray";
              },
              fillColor: function(rowIndex, node, columnIndex) {
                return rowIndex == 0 ? "#2196f3" : null;
              }
            }
          }
          // {
          //   text:"Total Members: "+this.members.length,
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
            fontSize: 16
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
      loanss.forEach((el, index) => {
        console.log("nka abot");
        let paid_interest = el.loan_payments.reduce(
          (a, b) => +a + +b.paid_interest,
          0
        );
        let paid_principal = el.loan_payments.reduce(
          (a, b) => +a + +b.paid_principal,
          0
        );
        console.log("total " + paid_interest);
        dd.content[1].table.body.push([
          { text: index + 1, fontSize: 11 },
          {
            text: `${el.member.last_name}, ${el.member.first_name}`,
            fontSize: 11
          },
          { text: el.member.address, fontSize: 11 },
          { text: el.member.mobile_no, alignment: "right", fontSize: 11 },
          { text: el.date_release, alignment: "right", fontSize: 11 },
          { text: el.principal_amount, alignment: "right", fontSize: 11 },
          { text: `${el.term_id} Month/s`, alignment: "right", fontSize: 11 },
          {
            text: `${el.interest_rate * 100} %`,
            alignment: "right",
            fontSize: 11
          },
          {
            text: el.total_amount_due.toFixed(2),
            alignment: "right",
            fontSize: 11
          },
          {
            text: (
              el.total_amount_due -
              (paid_interest + paid_principal)
            ).toFixed(2),
            alignment: "right",
            fontSize: 11
          }
        ]);
      });

      pdfMake.createPdf(dd).open();
    },

    viewDetails(id) {
      this.$router.push("/accounting/loan/" + id);
    },
    editLoan(id) {
      this.$router.push("/accounting/editloan/" + id);
    }
  }
};
</script>

<style>
</style>
