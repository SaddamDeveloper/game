<template>
  <div>
      <div class="uk-container-expand ">
         <div class="uk-card uk-card-small uk-card-default uk-card-body uk-padding-remove-bottom wi-recharge-topnav">
            <div class="uk-position-relative uk-margin-medium">
               <router-link to="/complaint" uk-icon="icon: arrow-left; ratio: 1.2" class="uk-align-left uk-margin-remove-adjacent wi-back-icon uk-icon"><svg width="24" height="24" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="arrow-left"><polyline fill="none" stroke="#000" points="10 14 5 9.5 10 5"></polyline><line fill="none" stroke="#000" x1="16" y1="9.5" x2="5" y2="9.52"></line></svg></router-link>
               <p class="uk-text-center wi-text-large uk-margin-large-right">Complaint & Suggestions</p>
            </div>
         </div>
      </div>
      <div class="uk-section uk-section-default uk-padding-small">
         <div class="uk-container">
            <div class="uk-width-xlarge uk-margin-auto uk-text-center uk-margin-small-bottom ">
               <p class="wi-text-large-child">Add New</p>
            </div>
         </div>
      </div>
      <div class="uk-section uk-section-default uk-padding-remove-top uk-margin-small-bottom">
         <div class="uk-container">
            <form class=" uk-margin-large">
               <div class="uk-form-horizontal">
                  <div class="uk-margin">
                     <label class="uk-form-label wi-bankCard-text uk-margin-small-left" for="form-horizontal-text ">Type：</label>
                     <div class="uk-form-controls">
                        <select class="uk-select" v-model="data.type">
                           <option selected="" disabled="">Select Type</option>
                           <option>Suggestion</option>
                           <option>Consult</option>
                           <option>Recharge Problem</option>
                        </select>
                     </div>
                  </div>
                  <div class="uk-margin">
                     <label class="uk-form-label wi-bankCard-text uk-margin-small-left" for="form-horizontal-text ">Description：</label>
                     <div class="uk-form-controls">
                        <textarea class="uk-textarea" rows="5" placeholder="Textarea" v-model="data.description"></textarea>
                     </div>
                  </div>
                  <div class="uk-margin">
                     <label class="uk-form-label wi-bankCard-text uk-margin-small-left" for="form-horizontal-text ">Whatsapp number：</label>
                     <div class="uk-form-controls">
                        <input class="uk-input" id="form-horizontal-text" v-model="data.mobile" type="text" placeholder="Whatsapp number">
                     </div>
                  </div>
               </div>
               <p class="uk-text-center wi-bankCard-btn">
                <button class="uk-button uk-button-default uk-modal-close" type="button" @click="$router.go(-1)">Cancel</button>
                <button class="uk-button uk-button-primary" type="button" @click="handleSubmit" :disabled="isClicked" :loading="isClicked">{{isClicked ? 'Submitting...' : 'Submit'}}</button>
               </p>
            </form>
            <div class="wi-bankCard-text uk-margin-bottom">Service: 10:00-17:00, Monday - Friday about 1-5 business days.
            </div>
         </div>
      </div>
  </div>
</template>

<script>
import store from '../../store';
import {mapGetters} from "vuex";
export default {
    computed: {
     
    },
    data() {
       return {
          data:{
              type: '',
              description: '',
              mobile: ''
          },
          isClicked: false
       }
    },
    methods: {
        async handleSubmit() {
            if(this.data.type.trim() == "")
               return this.e("Type is required!");
            if(this.data.description.trim() == "")
               return this.e("Description is required!");
            if(this.data.mobile.trim() == "")
               return this.e("Mobile is required!");
            this.isClicked = true;
            const userData = JSON.parse(localStorage.user);
            const token = userData.token;
            const config = {
                headers: { Authorization: `Bearer ${token}` }
            };
            return axios.post('api/user/complaints',this.data, config)
            .then(({data}) => {
               console.log(data);
               if(data.status == true){
                  this.$router.push('/complaint');
               }else{
                  if (data.status == 422) {
                  for (let i in data.data.errors) {
                     this.e(data.data.errors[i][0]);
                  }
                  } else {
                     this.swr();
                  }
               }
               this.isClicked = false;
            });
        }
    },   
   created() {
     
   }
}
</script>