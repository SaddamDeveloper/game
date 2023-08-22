<template>
  <div>
      <div class="uk-container-expand ">
         <div class="uk-card uk-card-small uk-card-default uk-card-body uk-padding-remove-bottom wi-recharge-topnav">
            <a @click="$router.go(-1)" uk-icon="icon: arrow-left; ratio: 1.2" class="uk-align-left uk-margin-remove-adjacent wi-back-icon uk-icon"><svg width="24" height="24" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="arrow-left"><polyline fill="none" stroke="#000" points="10 14 5 9.5 10 5"></polyline><line fill="none" stroke="#000" x1="16" y1="9.5" x2="5" y2="9.52"></line></svg></a>
            <p class="wi-text-large uk-margin-large-right">Bank Card</p>
         </div>
      </div>
      <div class="uk-section uk-section-default uk-padding-small">
         <div class="uk-container">
            <div class="uk-width-xlarge uk-margin-auto uk-text-center uk-margin-small-bottom ">
               <p class="wi-text-large">My Bank Card</p>
            </div>
         </div>
      </div>
      <div class="uk-section uk-section-default uk-padding-remove-top">
         <div class="uk-container">
            <form class="uk-form-horizontal uk-margin-large">
               <div class="uk-margin">
                  <label class="uk-form-label wi-bankCard-text uk-margin-small-left" for="form-horizontal-text ">Actual name：</label>
                  <div class="uk-form-controls">
                     <input class="uk-input" v-model="data.name" id="form-horizontal-text" type="text" placeholder="Please enter the actual name">
                  </div>
               </div>
               <div class="uk-margin">
                  <label class="uk-form-label wi-bankCard-text uk-margin-small-left" for="form-horizontal-text ">IFSC code：</label>
                  <div class="uk-form-controls">
                     <input class="uk-input" v-model="data.ifsc" id="form-horizontal-text" type="text" placeholder="Please enter the IFSC code">
                  </div>
               </div>
               <div class="uk-margin">
                  <label class="uk-form-label wi-bankCard-text uk-margin-small-left" for="form-horizontal-text ">Account number：</label>
                  <div class="uk-form-controls">
                     <input class="uk-input" v-model="data.account_no" id="form-horizontal-text" type="number" placeholder="Please enter your bank account number">
                  </div>
               </div>
               <div class="uk-margin">
                  <label class="uk-form-label wi-bankCard-text uk-margin-small-left" for="form-horizontal-text ">Confirm number：</label>
                  <div class="uk-form-controls">
                     <input class="uk-input" id="form-horizontal-text" v-model="data.confirm_account" type="number" placeholder="Please enter your bank account number">
                  </div>
               </div>
               <div class="uk-margin">
                  <label class="uk-form-label wi-bankCard-text uk-margin-small-left" for="form-horizontal-text ">State：</label>
                  <div class="uk-form-controls">
                     <input class="uk-input" id="form-horizontal-text" type="text" v-model="data.state" placeholder="Please enter the State">
                  </div>
               </div>
               <div class="uk-margin">
                  <label class="uk-form-label wi-bankCard-text uk-margin-small-left" for="form-horizontal-text ">City：</label>
                  <div class="uk-form-controls">
                     <input class="uk-input" id="form-horizontal-text" v-model="data.city" type="text" placeholder="Please enter the city">
                  </div>
               </div>
               <div class="uk-margin">
                  <label class="uk-form-label wi-bankCard-text uk-margin-small-left" for="form-horizontal-text ">Address：</label>
                  <div class="uk-form-controls">
                     <input class="uk-input" id="form-horizontal-text" v-model="data.address" type="text" placeholder="Please enter the address">
                  </div>
               </div>
               <div class="uk-margin">
                  <label class="uk-form-label wi-bankCard-text uk-margin-small-left" for="form-horizontal-text ">Mobile Number:</label>
                  <div class="uk-form-controls">
                     <input class="uk-input" v-model="data.mobile" id="form-horizontal-text" type="number" placeholder="Please enter the mobile number">
                  </div>
               </div>
               <div class="uk-margin">
                  <label class="uk-form-label wi-bankCard-text uk-margin-small-left" for="form-horizontal-text ">Email:</label>
                  <div class="uk-form-controls">
                     <input class="uk-input" v-model="data.email" id="form-horizontal-text" type="email" placeholder="Please enter the email">
                  </div>
               </div>
               <p class="uk-text-center wi-bankCard-btn">
                  <button class="uk-button uk-button-default uk-modal-close" type="button" @click="$router.go(-1)">Cancel</button>
                  <button class="uk-button uk-button-primary" type="button" :disabled="isClicked" :loading="isClicked" @click="addBankCard">{{isClicked ? 'Submitting...' : 'Submit'}}</button>
               </p>
            </form>
         </div>
      </div>
      <div class="uk-section uk-section-default uk-padding-remove-top uk-margin-bottom">
         <div class="uk-container">
            <div class="uk-child-width-1-3@m uk-grid-match uk-grid uk-grid-stack" uk-grid="">
               <div class="uk-first-column" v-for="(bankcard, i) in bankcards" :key="i" >
                  <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                     <p><span class="wi-bankCard-text">Actual name：</span> {{ bankcard.name }}</p>
                     <p><span class="wi-bankCard-text">IFSC code：</span>{{ bankcard.ifsc }}</p>
                     <p><span class="wi-bankCard-text">Account number：</span>{{ bankcard.account_no}}</p>
                     <p><span class="wi-bankCard-text">State：</span>{{ bankcard.state }}</p>
                     <p><span class="wi-bankCard-text">City：</span>{{ bankcard.city }}</p>
                     <p><span class="wi-bankCard-text">Address：</span>{{ bankcard.address }}</p>
                     <p><span class="wi-bankCard-text">Mobile Number:</span>{{bankcard.mobile}}</p>
                     <p><span class="wi-bankCard-text">Email:</span>{{ bankcard.email }}</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
  </div>
</template>

<script>
import store from '../../store';
export default {
    computed: {
       walletBal(){
         return store.state.users.wallet ? store.state.users.wallet.amount.toFixed(2) : '0.00'
      },
    },
    data() {
        return {
            isClicked: false,
            data: {
                name: '',
                ifsc: '',
                account_no: '',
                confirm_account: '',
                state: '',
                city: '',
                address: '',
                mobile: '',
                email: ''
            },
            bankcards: [],
        }
    },
   methods: {
      async addBankCard(){
      if (this.data.name.trim() == "")
            return this.e("Name is required!");
      if (this.data.ifsc.trim() == "")
            return this.e("IFSC code is required!");
      if (this.data.account_no.trim() == "")
            return this.e("Account No is required!");
      if (this.data.confirm_account.trim() == "")
            return this.e("Confirm Account No is required!");
      if (this.data.state.trim() == "")
            return this.e("State is required!");
      if (this.data.city.trim() == "")
            return this.e("City is required!");
      if (this.data.mobile.trim() == "")
            return this.e("Mobile No is required!");
      if (this.data.email.trim() == "")
            return this.e("Email No is required!");
      this.isClicked = true;
      const userData = JSON.parse(localStorage.user);
      const token = userData.token;
      const config = {
         headers: { Authorization: `Bearer ${token}` }
      };
       return axios.post('api/user/addbankcard',this.data, config)
         .then(({data}) => {
            if(data.status == true){
               return this.s("Bank card addedd successfully!");
               this.data = {};
               this.bankCard();
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
      async bankCard() {
      const userData = JSON.parse(localStorage.user);
      const token = userData.token;
      const config = {
         headers: { Authorization: `Bearer ${token}` }
      };
      return axios.get('api/user/bankcards', config)
         .then(({data}) => {
            if(data.status == true){
               this.bankcards = data.data;
            }
         });
      }
   },
   created() {
      this.bankCard();
   },
}
</script>