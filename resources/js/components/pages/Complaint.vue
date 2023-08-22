<template>
  <div>
      <div class="uk-container-expand ">
         <div class="uk-card uk-card-small uk-card-default uk-card-body uk-padding-remove-bottom wi-recharge-topnav">
            <div class="uk-position-relative uk-margin-medium">
               <router-link to="/" uk-icon="icon: arrow-left; ratio: 1.2" class="uk-align-left uk-margin-remove-adjacent wi-back-icon uk-icon"><svg width="24" height="24" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="arrow-left"><polyline fill="none" stroke="#000" points="10 14 5 9.5 10 5"></polyline><line fill="none" stroke="#000" x1="16" y1="9.5" x2="5" y2="9.52"></line></svg></router-link>
               <p class="uk-text-center wi-text-large uk-margin-large-right">Complaints &amp; Suggestions</p>
               <div class="uk-position-top-right">
                  <router-link to="/addcomplaint" class="uk-button uk-border-rounded uk-box-shadow-medium wi-add-btn-complain">Add New</router-link>
               </div>
            </div>
         </div>
      </div>
      <div class="uk-section uk-section-default uk-padding-remove uk-margin-large-bottom ">
         <div class=" uk-margin-auto  uk-margin-small-bottom ">
            <div class="uk-card uk-card-body uk-width-1-1">
               <ol class="uk-list">
                  <li v-for="(complaint, i) in complaints" :key="i">
                     <strong>Type:</strong><p>{{ complaint.type }}</p> <br>
                     <strong>Description:</strong><p>{{ complaint.description }}</p> <br>
                     <strong>Whatsapp No:</strong><p>{{ complaint.mobile }}</p> <br>
                  <hr>
                  </li>
               </ol>
            </div>
         </div>
      </div>
  </div>
</template>

<script>
export default {
    data() {
       return {
          complaints: []
       }
    },
    methods: {
      async fetchComplaints(){
         const userData = JSON.parse(localStorage.user);
         const token = userData.token;
         const config = {
            headers: { Authorization: `Bearer ${token}` }
         };
         return axios.get('api/user/complaints', config)
         .then(({data}) => {
            if(data.status == true){
               this.complaints = data.data;
            }else{
               return this.swr();
            }
         });
      }
    },   
   created() {
      this.fetchComplaints();
   }
}
</script>