<template>
  <div>
      <div class="uk-container-expand ">
         <div class="uk-card uk-card-small uk-card-default uk-card-body uk-padding-remove-bottom wi-recharge-topnav">
            <a @click="$router.go(-1)" uk-icon="icon: arrow-left; ratio: 1.2" class="uk-align-left uk-margin-remove-adjacent wi-back-icon uk-icon"><svg width="24" height="24" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="arrow-left"><polyline fill="none" stroke="#000" points="10 14 5 9.5 10 5"></polyline><line fill="none" stroke="#000" x1="16" y1="9.5" x2="5" y2="9.52"></line></svg></a>
            <p class="wi-text-large uk-margin-large-right">Address</p>
         </div>
      </div>
      <div class="uk-section uk-section-default uk-padding-small">
         <div class="uk-container">
            <div class="uk-width-xlarge uk-margin-auto uk-text-center uk-margin-small-bottom ">
               <p class="wi-text-large-child">Please update the harvest address</p>
            </div>
         </div>
      </div>
      <div class="uk-section uk-section-default uk-padding-remove-top uk-margin-medium-bottom">
         <div class="uk-container">
            <form class=" uk-margin-large">
                <div class="uk-form-horizontal">
               <div class="uk-margin">
                  <label class="uk-form-label wi-bankCard-text uk-margin-small-left" for="form-horizontal-text ">Full Number：</label>
                  <div class="uk-form-controls">
                     <input class="uk-input" id="form-horizontal-text" v-model="data.full_name" type="text" placeholder="Full Name">
                  </div>
               </div>
               <div class="uk-margin">
                  <label class="uk-form-label wi-bankCard-text uk-margin-small-left" for="form-horizontal-text ">Mobile Number：</label>
                  <div class="uk-form-controls">
                     <input class="uk-input" id="form-horizontal-text" type="number" v-model="data.mobile" placeholder="Mobile Number">
                  </div>
               </div>
               <div class="uk-margin">
                  <label class="uk-form-label wi-bankCard-text uk-margin-small-left" for="form-horizontal-text ">Pincode：</label>
                  <div class="uk-form-controls">
                     <input class="uk-input" id="form-horizontal-text" type="number" v-model="data.pin" placeholder="Pincode">
                  </div>
               </div>
                </div>
               <hr>
               <div class="uk-margin uk-margin-medium-top">
                  <label class="uk-form-label wi-bankCard-text uk-margin-small-left" for="form-horizontal-text ">Area,Colony.Street,Sector,Village</label>
                  <div class="uk-form-controls">
                  <textarea class="uk-textarea" rows="5" v-model="data.address" placeholder="Area,Colony.Street,Sector,Village"></textarea>
                  </div>
               </div>
               <div class="uk-margin">
                  <label class="uk-form-label wi-bankCard-text uk-margin-small-left" for="form-horizontal-text ">Town/City</label>
                  <div class="uk-form-controls">
                     <input class="uk-input" id="form-horizontal-text" v-model="data.city" type="text" placeholder="Town/City">
                  </div>
               </div>
               <div class="uk-margin">
                  <label class="uk-form-label wi-bankCard-text uk-margin-small-left" for="form-horizontal-text ">State</label>
                  <div class="uk-form-controls">
                     <input class="uk-input" id="form-horizontal-text" v-model="data.state" type="text" placeholder="State">
                  </div>
               </div>
               <p class="uk-text-center wi-bankCard-btn">
                  <button class="uk-button uk-button-default uk-modal-close" type="button" @click="$router.go(-1)">Cancel</button>
                  <button class="uk-button uk-button-primary" type="button" @click="handleSubmit" :disabled="isClicked" :loading="isClicked">{{isClicked ? 'Updating...' : 'Update'}}</button>
               </p>
            </form>
         </div>
      </div>
  </div>
</template>

<script>
export default {
    computed: {

    },
    data() {
        return {
            isClicked: false,
            data: {
               full_name: '',
               mobile: '',
               pin: '',
               address: '',
               city: '',
               state: ''
            }
        }
    },
   methods: {
      async handleSubmit() {
         if (this.data.full_name == "")
               return this.e("Full Name is required!");
         if (this.data.mobile == "")
               return this.e("Mobile No is required!");
         if (this.data.pin == "")
               return this.e("Pin Code is required!");
         if (this.data.state == "")
               return this.e("State is required!");
         if (this.data.city == "")
               return this.e("City is required!");
         this.isClicked = true;
         const userData = JSON.parse(localStorage.user);
         const token = userData.token;
         const config = {
            headers: { Authorization: `Bearer ${token}` }
         };
         return axios.post('api/user/address', this.data, config)
         .then(({data}) => {
            if(data.status == true){
               this.s('Address Updated successfully!');
               this.fetchAddress();
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
      }, 
      async fetchAddress() {
         const userData = JSON.parse(localStorage.user);
         const token = userData.token;
         const config = {
            headers: { Authorization: `Bearer ${token}` }
         };
         return axios.get('api/user/address', config)
         .then(({data}) => {
            if(data.status == true){
               this.data.full_name = data.data.name;
               this.data.mobile = data.data.mobile;
               this.data.pin = data.data.pin;
               this.data.address = data.data.address;
               this.data.city = data.data.city;
               this.data.state = data.data.state;
            }else{
               return this.swr();
            }
         });
      }
   },
   created() {
     this.fetchAddress();
   },
}
</script>