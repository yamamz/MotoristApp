<template>
  <v-container
    fill-height
    fluid
    grid-list-xl>
<v-layout row wrap>
  <v-flex md12>
<v-card>
    <v-card-title>
      Nutrition
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="search"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="members"
      :search="search"
    >
      <template v-slot:items="props">
        <td>{{ props.item.first_name }}</td>
        <td class="text-xs-right">{{ props.item.last_name }}</td>
        <td class="text-xs-right">{{ props.item.age }}</td>
        <td class="text-xs-right">{{ props.item.address }}</td>
        <td class="text-xs-right">{{ props.item.mobile_no }}</td>
        <td class="text-xs-right">{{ props.item.monthly_amortization }}</td>
         <td class="justify-center layout px-0">
          <v-icon
          color="purple"
            class="mr-2"
            @click="viewChart(props.item)"
          >
           table_chart
          </v-icon>
              <v-icon
          color="success"
            class="mr-2"
            @click="editItem(props.item)"
          >
           edit
          </v-icon>
         
        </td>
      </template>
      <v-alert v-slot:no-results :value="true" color="error" icon="warning">
        Your search for "{{ search }}" found no results.
      </v-alert>
    </v-data-table>
  </v-card>
  </v-flex>
</v-layout>
  
  </v-container>
</template>

<script>
  export default {
    data () {
      return {
        search: '',
        members:[],
        headers: [
          {
            text: 'First Name',
            align: 'left',
            sortable: false,
            value: 'first_name'
          },
          { text: 'Last Name', value: 'last_name' },
          { text: 'Age', value: 'age' },
          { text: 'Address', value: 'address' },
          { text: 'Mobile No.', value: 'mobile_no' },
          { text: 'Monthly Amortization', value: 'monthly_amortization' },
            { text: 'Actions', value: 'id', sortable: false }
        
        ],
       
      }
    },
    methods:{
      viewChart(member){
        this.$router.push('/members/chart/'+member.id)
      },
      editItem(member){

      }
    },
    created(){
      axios.get('/api/member/all').then(res=>{
      console.log(res.data)
      this.members=res.data
    })
    // axios.get('/api/member/all/tree').then(res=>{
    //   console.log(res.data)

    // })
    }

  }
</script>yy