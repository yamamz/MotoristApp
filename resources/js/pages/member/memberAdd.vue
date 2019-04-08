<template>
  <v-container
    fill-height
    fluid
    grid-list-xl>
    <v-layout
      justify-center
      wrap
    >
      <v-flex
        xs12
        md12
      >
        <v-card
          title="Edit Profile"
          text="Complete your profile"

        >
        <v-card height="50"  color="success">
          <v-card-text>
 <h5 style="color:white !important">Membership form</h5>
          </v-card-text>
         
        </v-card>
          <v-form>
            <v-container py-0>
              <v-layout wrap>
                <v-flex
                  xs12
                  md4
                >
      

                  <v-text-field
                    v-model="form.first_name"
                    label="First Name"
                    class="purple-input"/>
                </v-flex>
                     <v-flex
                  xs12
                  md4
                >
                  <v-text-field
                   v-model="form.middle_name"
                    label="Middle Name"
                    class="purple-input"/>
                </v-flex>
                <v-flex
                  xs12
                  md4
                >
                  <v-text-field
                    label="Last Name"
                     v-model="form.last_name"
                    class="purple-input"/>
                </v-flex>
             
                <v-flex
                  xs12
                  md8
                >
                  <v-text-field
                    label="Adress"
                     v-model="form.address"
                    class="purple-input"/>
                </v-flex>
                <v-flex sm12 md4>
                  <v-text-field
                   v-model="form.registration"
                    type="number"
          label="Donation Fee"
        ></v-text-field>
                </v-flex>
                <v-flex
                  xs12
                  md4>
                  <v-text-field
                   v-model="form.mobile_no"
                    label="Mobile No."
                    class="purple-input"/>
                </v-flex>
                <v-flex
                  xs12
                  md4>
                  <v-text-field
                   v-model="form.age"
                    label="Age"
                    type="number"
                    class="purple-input"/>
                </v-flex>
                <v-flex
                  xs12
                  md4>
                  <v-text-field
                   v-model="form.birthdate"
                    class="purple-input"
                    label="Birth Date"
                    type="date"/>
                </v-flex>
                <v-flex sm12 md4>
                  <v-select
                   v-model="form.monthly_amortization"
          :items="monthly_amortization"
          label="Monthly Amortization"
        ></v-select>
                </v-flex>
                  <v-flex sm12 md4>
                  <v-select
          :items="members"
          v-model="form.parent_id"
          item-text="label"
          item-value="id"
          label="Parent"
        ></v-select>
                </v-flex>
                        <v-flex sm12 md4>
                  <v-select
                   v-model="form.matrix_position"
          :items="matrix_positions"
          item-text="label"
          item-value="value"
          label="Matrix Position"
        ></v-select>
                </v-flex>
            
                <v-flex
                  xs12
                  text-xs-right
                >
                  <v-btn
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="saveMember"
                  >
                    Add Member
                  </v-btn>
                </v-flex>
              </v-layout>
            </v-container>
          </v-form>
        </v-card>
      </v-flex>
      <!-- <v-flex
        xs12
        md4
      >
        <v-card class="v-card-profile">
          <v-avatar
            slot="offset"
            class="mx-auto d-block"
            size="130"
          >
            <img
              src="https://demos.creative-tim.com/vue-material-dashboard/img/marc.aba54d65.jpg"
            >
          </v-avatar>
          <v-card-text class="text-xs-center">
            <h6 class="category text-gray font-weight-thin mb-3">CEO / CO-FOUNDER</h6>
            <h4 class="card-title font-weight-light">Alec Thompson</h4>
            <p class="card-description font-weight-light">Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...</p>
            <v-btn
              color="success"
              round
              class="font-weight-light"
            >Follow</v-btn>
          </v-card-text>
        </v-card>
      </v-flex> -->
    </v-layout>
  </v-container>
</template>

<script>
export default {

  data(){
    return{
      matrix_positions:[{label:'left',value:0},{label:'right',value:1}],
      monthly_amortization:[2500,3000],
      form:{
        first_name:'',
        middle_name:'',
        last_name:'',
        mobile_no:'',
        age:'',
        address:'',
        birthdate:'',
        registration:'',
        monthly_amortization:'',
        matrix_position:'',
        parent_id:''
      },
      members:[{first_name:'',last_name:''}]
    }
  },
  mounted(){
    axios.get('/api/member/all').then(res=>{
      console.log(res.data)
      this.members=res.data
      this.members.forEach(el=>{
          el.label=`${el.id} - ${el.first_name} ${el.last_name}`
      })
    })
  },

  methods:{
    saveMember(){
      axios.post('/api/member/create',this.form).then(res=>{
        console.log(res.data)
      })
    }
  }
}
</script>
