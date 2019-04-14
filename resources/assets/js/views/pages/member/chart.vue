<template>
  <div>
<el-row :gutter="5">
  <el-col :md="18">
    <el-card>
          <div id="tree"></div>
    </el-card>

  </el-col>
  <el-col :md="6">
    <el-card>
      <el-row>
        <el-col :md="22">
          <p>Number of Heads</p>
        </el-col>
        <el-col :md="2"><p style="color:blue;">{{children}}</p></el-col>
            <el-col :md="22">
           <p>Is Binary</p>
        </el-col>
        <el-col :md="2"><p style="color:blue;">{{isBinary}}</p></el-col>
        
      </el-row>
    </el-card>
    </el-col>
</el-row>

  </div>
</template>

<style scoped>

html, body {
    margin: 0px;
    padding: 0px;
    width: 100%;
    height: 100%;
    overflow: hidden;
    font-family: Helvetica;
}

#tree {
    width: 100%;
    height: 100%;
}

/*partial*/
.tree-layout line {
    stroke: #F57C00;
}

.node.Release rect {
    fill: #039BE5;
}

.node.NotRelease rect {
    fill: #FFCA28;
}
</style>


<script>



  export default {

    created(){
      
     axios.get('/api/member/get/treeFlat/'+this.$route.params.id).then(res=>{
       
      res.data.forEach(el => {
         el.pid=el.parent_id
       });
       this.ds=res.data
        this.childCounts(this.$route.params.id)
       window.onload = this.showChart(res.data)
       
     })




    
    },
    data() {
      return {
          children:0,
        ds:[]
      }
    },

       computed:{
   

    isBinary(){
              let id=this.$route.params.id
        let count = 0;
        for (var i = 0; i < this.ds.length; i++) {
            if (this.ds[i].pid == id) {
                count++;
            }
        }
        if(count==2){
          return true
        }
        else{
          return false
        }
       // this.children=count;
        return count;
    }
    },
 


    methods:{
         childCounts(id) {
           console.log('this is '+id)
        let count = 0;
           
       
        for (var i = 0; i < this.ds.length; i++) {
            if ( this.ds[i].pid == id) {
                count++;
               
                count += this.childCounts(this.ds[i].id);
            }
        }
       // this.children=count;
      this.children=count;
    },
       showChart(data) {

         for (var i = 0; i < data.length; i++) {
        var node = data[i];
        switch (node.title) {
            case "Not yet Release":
                node.tags = ["NotRelease"];
                break;
         
            case "Release":
                node.tags = ["Release"];
                break;
        }
    }

    for (var i = 0; i < data.length; i++) {
        data[i].field_number_children = childCount(data[i].id);
    }

    function childCount(id) {
        let count = 0;
        for (var i = 0; i < data.length; i++) {
            if (data[i].pid == id) {
                count++;
                count += childCount(data[i].id);
            }
        }
       // this.children=count;
        return count;
    }
    OrgChart.templates.isla.field_number_children = '<circle cx="60" cy="110" r="15" fill="#F57C00"></circle><text fill="#ffffff" x="60" y="115" text-anchor="middle">{val}</text>';

    var chart = new OrgChart(document.getElementById("tree"), {
          layout: BALKANGraph.mixed,
        mouseScrool: BALKANGraph.none,
        layout: BALKANGraph.tree,
        align: BALKANGraph.ORIENTATION,
        field_number_children: "field_number_children",
        toolbar:true,
        template:'isla',
             menu: {
            pdf: { text: "Export PDF" },
            png: { text: "Export PNG" },
            svg: { text: "Export SVG" },
            csv: { text: "Export CSV" }
        },
        nodeMenu: {
            pdf: { text: "Export PDF" },
            png: { text: "Export PNG" },
            svg: { text: "Export SVG" }
        },
        nodeBinding: {
            field_0: "name",
            field_1: "title",
            img_0:'image'
      
        },
        collapse: {
            level: 2
        },
        expand: {
            nodes: [2, 20],
            allChildren: true
        },
        nodes: data
    });

    chart.toolbarUI.showLayout();
}
    }
  }
</script>