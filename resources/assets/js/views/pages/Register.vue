<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card mx-4">
            <div class="card-body p-4">
              <h1>Register</h1>
              <p class="text-muted">Create your account</p>
              <form @submit.prevent="register()">
              <div class="input-group mb-3">
                <span class="input-group-addon">
                  <i class="icon-user"></i>
                </span>
                <input type="text" name="name" v-validate="'required'" v-model="form.name" class="form-control" placeholder="name">
              </div>

              <div class="input-group mb-3">
                <span class="input-group-addon">@</span>
                <input name="email"  v-validate="'required|email'" type="text" v-model="form.email" class="form-control" placeholder="Email">
              </div>

              <div class="input-group mb-3">
                <span class="input-group-addon">
                  <i class="icon-lock"></i>
                </span>
                <input
                  v-validate="'required'"
                  ref="password"
                  type="password"
                  name="password"
                  v-model="form.password"
                  class="form-control"
                  placeholder="Password"
                >
              </div>

              <div class="input-group mb-4">
                <span class="input-group-addon">
                  <i class="icon-lock"></i>
                </span>
                <input
                  type="password"
                  name="password_confirmation"
                  v-validate="'required|confirmed:password'"
                  data-vv-as="password"
                  v-model="form.password1"
                  class="form-control"
                  placeholder="Repeat password"
                >
              </div>

              <input type="submit"  value="Register" class="btn btn-block btn-success">
  </form>
            </div>
          

            <div class="input-group mb-3">
              <template v-show="errors.any()">
                <div>
                  <el-alert
                    v-if="errors.has('password')"
                    :title="errors.first('password')"
                    type="warning"
                  ></el-alert>
                  <el-alert
                    v-if="errors.has('password_confirmation')"
                    :title="errors.first('password_confirmation') "
                    type="warning"
                  ></el-alert>
                        <el-alert
                    v-if="errors.has('email')"
                    :title="errors.first('email') "
                    type="warning"
                  ></el-alert>
                              <el-alert
                    v-if="errors.has('name')"
                    :title="errors.first('name') "
                    type="warning"
                  ></el-alert>
                </div>
              </template>
            </div>
        
            <div class="card-footer p-4">
              <div class="row">
                <div class="col-6">
                  <button class="btn btn-block btn-facebook" type="button">
                    <span>facebook</span>
                  </button>
                </div>
                <div class="col-6">
                  <button class="btn btn-block btn-twitter" type="button">
                    <span>twitter</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: "Register",
  data() {
    return {
      form: {
        email: "",
        password1: "",
        password: "",
        name: ""
      }
    };
  },
  methods: {
    register() {

      this.$validator
        .validateAll()
        .then(response=> {
             console.log(this.form)
          if(response==true){
            console.log(response)
           
            axios.post("/api/user/create", this.form).then(res => {
            console.log(res.data);
            if (res.data.ok == "success") {
              this.$swal({
                type: "success",
                title: "Register",
                text: "register  Successfully!"
              });
            } else {
              this.$swal({
                type: "error",
                title: "Error",
                text: "Error during registration!"
              });
            }
          });
          }

        })
        .catch(function(e) {
          // Catch errors
        });
    }
  }
};
</script>
