<template>
  <div>
      <div class="uk-container-expand ">
         <div class="uk-card uk-card-small uk-card-default uk-card-body uk-padding-remove-bottom wi-recharge-topnav">
            <a @click="$router.go(-1)" uk-icon="icon: arrow-left; ratio: 1.2" class="uk-align-left uk-margin-remove-adjacent wi-back-icon uk-icon"><svg width="24" height="24" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="arrow-left"><polyline fill="none" stroke="#000" points="10 14 5 9.5 10 5"></polyline><line fill="none" stroke="#000" x1="16" y1="9.5" x2="5" y2="9.52"></line></svg></a>
            <p class="wi-text-large uk-margin-large-right">Withdrawal</p>
         </div>
      </div>
      <div class="uk-section uk-section-default uk-padding-small">
         <div class="uk-container">
            <div class="uk-width-xlarge uk-margin-auto uk-text-center uk-margin-small-bottom ">
               <p class="uk-text-large wi-recharge-blnce">Wallet Balance: ₹ {{ walletBal }}
            </p></div>
            <form class="uk-form-horizontal uk-margin-medium-top">
            <div class="uk-margin">
            <label class="uk-form-label wi-bankCard-text uk-margin-small-left" for="form-horizontal-text ">Select Account：</label>
             <div class="uk-form-controls">
                  <select class="uk-select" id="form-stacked-select" v-model="data.account">
                     <option selected disabled>--SELECT ACCOUNT--</option>
                     <option v-for="(bankcard, i) in bankcards" :key="i">{{ bankcard.account_no  }}</option>
                  </select>
               </div>
            </div>
               <div class="uk-margin">
                  <label class="uk-form-label wi-bankCard-text uk-margin-small-left" for="form-horizontal-text ">Withdrawal Amount</label>
                  <div class="uk-form-controls">
                     <input class="uk-input" v-model="data.amount" id="form-horizontal-text" type="text" placeholder="Please enter the Withdrawal Amount">
                  </div>
               </div>
                <p class="uk-text-center wi-bankCard-btn">
                  <button class="uk-button uk-button-default uk-modal-close" type="button" @click="$router.go(-1)">Cancel</button>
                  <button class="uk-button uk-button-primary" type="button" :disabled="isClicked" :loading="isClicked" @click="addSubmit">{{isClicked ? 'Submitting...' : 'Submit'}}</button>
               </p>
               <br><br>
               <p><strong>Note 1:</strong> 30 Rupees will be deducted per every withdrawal requests! eg. 70 rupees will get from 100 rupees requested.
               </p>
               <p><strong>Note 2:</strong> Minimum withdrawal amount is 100 rupees.
               </p>
            </form>
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
               account: '',
               amount: ''
           },
           bankcards: [],
       }
    },
    methods: {
       async fetchUser() {
            store.dispatch('fetchUser')
      },
        async addSubmit(){
            if (this.data.amount.trim() == "")
               return this.e("Amount is required!");
            if(this.data.account.trim() == "")
                return this.e("Account No is required!");
            if(parseFloat(store.getters.getWalletBal) < parseFloat(this.data.amount)) 
                return this.e("Wallet balance is low!")
            if(this.data.amount < 100)
               return this.e('Minimum withdrawal amount is 100');
            const userData = JSON.parse(localStorage.user);
            const token = userData.token;
            const config = {
               headers: { Authorization: `Bearer ${token}` }
            };
            return axios.post('api/user/withdrawal', this.data, config)
            .then(({data}) => {
               if(data.status == true){
                  this.fetchUser();
                  if(data.error_code == "LOW_BAL"){
                     return this.e(data.msg);
                  }
                  if(data.error_code == "MINIMUM"){
                     return this.e(data.msg);
                  }
                  if(data.data == "SUCCESS"){
                     this.data = {};
                     return this.s("Withdrawal is requested successfully!");
                  }
               }
            });
            const res = await this.callApi( "post","user/withdrawal",this.data);
            if (res.status == 200) {
               this.$store.dispatch('fetchNickName');
               if(res.data.error_code == "LOW_BAL"){
                  return this.e(res.data.msg);
               }
               if(res.data.error_code == "MINIMUM"){
                  return this.e(res.data.msg);
               }
               if(res.data.data == "SUCCESS"){
                  this.data = {};
                  return this.s("Withdrawal is requested successfully!");
               }
            }else{
                if (res.status == 422) {
                this.e(res.data.errors.amount[0]);
                } else {
                this.swr();
                }
            }
        },
        async bankCard(){
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
        })
      }
    },   
    created() {
       this.bankCard();
       this.fetchUser();
    }
}
</script>

<style>

</style>