<template>
  <div>
      <div class="">
         <div class="uk-container-expand uk-margin">
            <div class="uk-card uk-card-small uk-card-body uk-padding-remove-bottom wi-recharge-page-topnav">
               <div class="uk-position-relative uk-margin-medium">
                  <a @click="$router.go(-1)" class="uk-align-left uk-margin uk-margin-remove-adjacent">
                     <img src="img/back-arrow.png" style="margin-top:5px;">
                  </a>
                  <p class="wi-text-large uk-margin-large-right">Recharge</p>
                  <div class="uk-position-top-right wi-left-arrow">
                     <router-link to="transaction"><img src="img/database.png" style="margin-top:5px;"></router-link>
                  </div>
               </div>
            </div>
         </div>
      <div class="uk-section uk-section-default uk-padding-remove">
         <div class="uk-container">
            <div class="uk-width-xlarge uk-margin-auto uk-text-center uk-margin-small-bottom ">
               <p class="wi-recharge-available-blnce">Balance: ₹ {{ walletBal }}</p>
            </div>
            <form>
               <fieldset class="uk-fieldset">
                  <div class="uk-margin">
                     <!-- <span class="uk-form-icon wi-form-icon" uk-icon="icon: copy"></span> -->
                     <Input class="wi-input-recharge" prefix="md-cash" size="large" v-model="data.rechargeAmount" placeholder="Please select Recharge Amount" readonly style="width: 100%" />
                  </div>
                     <p uk-margin class="uk-text-center wi-recharge-btn">
                     <button type="button" @click="addAmount(50)" class="uk-button  uk-box-shadow-medium "> ₹ 50</button>
                     <button type="button" @click="addAmount(100)" class="uk-button  uk-box-shadow-medium "> ₹ 100</button>
                     <button type="button" @click="addAmount(300)" class="uk-button  uk-box-shadow-medium ">₹300</button>
                     <button type="button"  @click="addAmount(500)" class="uk-button  uk-box-shadow-medium ">₹500</button>
                     <button type="button" @click="addAmount(1000)" class="uk-button  uk-box-shadow-medium ">₹1000</button>
                     <button type="button" @click="addAmount(2000)" class="uk-button  uk-box-shadow-medium "> ₹ 2000</button>
                     <button type="button" @click="addAmount(5000)" class="uk-button  uk-box-shadow-medium ">₹5000</button>
                     <button type="button"  @click="addAmount(10000)" class="uk-button  uk-box-shadow-medium ">₹10000</button>
                     <button type="button" @click="addAmount(50000)" class="uk-button  uk-box-shadow-medium ">₹50000</button>
                  </p>
               </fieldset>
            </form>
         </div>
      </div>
      <div class="uk-section uk-section-default uk-margin-medium-bottom ">
         <div class="uk-container">
            <div class="uk-margin-auto ">
               <p>Tips:Please contact hintshoper321@gmail.com if you have any questions about the order or payment failure
               </p>
               <p uk-margin class="uk-text-center uk-margin-small-top">
                  <Button type="info" size="large" :disabled="isClicked" :loading="isClicked" @click="addRecharge">{{isClicked ? 'Please wait...' : 'Recharge'}}</Button>
               </p>
            </div>
         </div>
      </div>
  </div>
   <Modal
        v-model="confirmRecharge"
        title="Confirm Amount" >
         <p><input type="number" class="form-control" v-model="data.confirmAmount" placeholder="Confirm Recharge Amount"></p>
        <div slot="footer">
            <Button type="success" size="large" :disabled="isClicked" :loading="isClicked" @click="addConfirm">{{isClicked ? 'Please wait...' : 'Confirm'}}</Button>
        </div>
    </Modal>
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
          data: {
            rechargeAmount: '',
            confirmAmount: ''
          },
          isClicked: false,
          confirmRecharge: false
       }
    },   
    methods: {
      addAmount (money){
         this.data.rechargeAmount = parseFloat(money).toFixed(2);
      },
      addRecharge(){
         if (this.data.rechargeAmount == "")
            return this.e("Amount is required!");
         this.confirmRecharge = true;
      },
      async fetchUser() {
            store.dispatch('fetchUser')
      },
      async addConfirm() {
         if (this.data.confirmAmount == "")
            return this.e("Confirm Amount is required!");
         if(parseFloat(this.data.rechargeAmount).toFixed(2) != parseFloat(this.data.confirmAmount).toFixed(2))
            return this.e("Confirm isn't matched!");
         this.isClicked = true;
         const userData = JSON.parse(localStorage.user);
         const token = userData.token;
         const config = {
            headers: { Authorization: `Bearer ${token}` }
         };
         return axios.post('api/user/recharge',{"rechargeAmount": parseFloat(this.data.rechargeAmount).toFixed(2), "confirmAmount": parseFloat(this.data.confirmAmount).toFixed(2)}, config)
         .then(({data}) => {
               if(data.msg.status == 'Pending'){
                  const longurl = data.msg.longurl;
                     Instamojo.open(longurl);
                     Instamojo.configure({
                     handlers: {
                        onOpen: function() {},
                        onClose: function() {},
                        onSuccess: function(response) {
                           console.log("Success"+response);
                        },
                        onFailure: function(response) {
                           console.log("Failurre"+response);
                        }
                     }
                  });
               }else{
               if (data.status == 422) {
                  this.e(data.data.errors.amount[0]);
               } else {
                  this.swr();
               }
            }
         this.isClicked = false;
         });
      }
    },
    created() {
       this.fetchUser();
    },
}
</script>