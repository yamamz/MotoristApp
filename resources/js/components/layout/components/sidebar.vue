<template>
    <div>
        <el-menu

      default-active="2"
      class="el-menu-vertical-demo"
      @open="handleOpen"
      @close="handleClose"
      background-color="#545c64"
      text-color="#fff"
      active-text-color="#ffd04b"
      :collapse="isCollapse"
      :router="true"
>
      <el-submenu index="1">
        <template slot="title">
          <i class="el-icon-location"></i>
         <span>Member</span>
        </template>
   
          <el-menu-item index="/members"> <i class="el-icon-edit-outline"></i>Member List</el-menu-item>
          <el-menu-item index="/members/add"> <i class="el-icon-edit-outline"></i>Add Member</el-menu-item>
          <!-- <el-menu-item index="1-2">item one</el-menu-item>
          <el-menu-item index="1-3">item three</el-menu-item>
      -->

      </el-submenu>
      <el-menu-item index="2">
        <i class="el-icon-menu"></i>
        <span>Accounting</span>
      </el-menu-item>

      <el-menu-item index="4">
        <i class="el-icon-setting"></i>
        <span>Settings</span>
      </el-menu-item>
    </el-menu>
    </div>
</template>

<script>
export default {

 created() {
    window.addEventListener('resize', this.handleResize)
    this.handleResize();
  },
  destroyed() {
    window.removeEventListener('resize', this.handleResize)
  },
methods: {
   handleResize() {
      this.window.width = window.innerWidth;
      this.window.height = window.innerHeight;
       if(this.window.width >= 964){
        console.log(this.window.width)
        this.isCollapse=false
        return false
      }else{
         console.log(this.window.width)
          this.isCollapse=true
            return true
      }
   },
      handleOpen(key, keyPath) {
        console.log(key, keyPath);
      },
      handleClose(key, keyPath) {
        console.log(key, keyPath);
      }
    },
    data(){
      return{
        isCollapse:false,
        screenWidth:0,
        window: {
      width: 0,
      height: 0
    }
      }
    }
}
</script>

<style scope>
ul.el-menu-vertical-demo.el-menu{
height: 700px;
}

span{
  font-size: 20px;

}



</style>
