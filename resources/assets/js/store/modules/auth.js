import {getLocalUser} from "../../helper/auth.js";
const user = getLocalUser();
//console.log(user)

export default{
    state:{
        messageHome:'Welcome To my Homepage',
        currentUser: user,
        isLoggedIn:!!user,
        loading:false,
        auth_error:null,
        customers:[]


    },
    
    mutations:{
        login:state=>{
            state.loading = true;
            state.auth_error= null;
         


        },
        loginSuccess:(state,payload)=>{
            state.auth_error=null;
            state.isLoggedIn=true;
            state.loading=false;
            console.log(payload)
            state.currentUser= Object.assign({},payload.user,{"token":payload.access_token});
            localStorage.setItem("user",JSON.stringify(state.currentUser));
            console.log('nka abot dri')



        },
        loginFailed:(state,payload)=>{
            state.auth_error=payload.error;
            state.loading=false;

        },
        logout:state=>{
            localStorage.removeItem("user");
            state.isLoggedIn=false;
            state.currentUser=null;
        }

    },
    actions:{
        login:context=>{
            
            context.commit("login")
        }
    },

}