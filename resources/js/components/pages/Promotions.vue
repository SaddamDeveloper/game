<template>
  <div>
      <div class="uk-container-expand ">
         <div class="uk-card uk-card-small uk-card-default uk-card-body uk-padding-remove-bottom wi-recharge-topnav">
            <a @click="$router.go(-1)" uk-icon="icon: arrow-left; ratio: 1.2" class="uk-align-left uk-margin-remove-adjacent wi-back-icon uk-icon"><svg width="24" height="24" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="arrow-left"><polyline fill="none" stroke="#000" points="10 14 5 9.5 10 5"></polyline><line fill="none" stroke="#000" x1="16" y1="9.5" x2="5" y2="9.52"></line></svg></a>
            <p class="wi-text-large uk-margin-large-right">Promotions</p>
         </div>
      </div>
      <br>
      <br>
      <br>
      <br>
       <div class="uk-section uk-section-default uk-padding-remove">
         <div class="uk-container">
            <div class="uk-width-xlarge uk-margin-auto uk-text-center uk-margin-small-bottom ">
               <p class="uk-text-large wi-recharge-blnce">Balance: ₹ {{ walletBal }}</p>
            </div>
            <br>
            <br>
            <br>
            <br>
            <form>
               <fieldset class="uk-fieldset">
                  <div class="uk-margin">
                     <span class="uk-form-icon wi-form-icon" uk-icon="icon: copy"></span>
                     <Input prefix="ios-browsers-outline" size="large" v-model="username" style="width: 100%" />
                     <br>
                     <br>
                     <Input prefix="logo-buffer" size="large" v-model="link" style="width: 100%" />
                  </div>
               </fieldset>
            </form>
         </div>
      </div>
  </div>
</template>

<script>
import store from '../../store';
import {mapGetters} from "vuex";
export default {
    computed: {
       walletBal(){
         return store.state.users.wallet ? store.state.users.wallet.amount.toFixed(2) : '0.00'
      },
    },
    data() {
        return {
            isClicked: false,
            username: '',
            link: '',
            data: {
               full_name: '',
               mobile: store.getters.getMobileNo,
               pin: '',
               address: '',
               city: '',
               state: ''
            }
        }
    },
   methods: {
      async fetchUser() {
         store.dispatch('fetchUser')
      },
      async userDetails() {
         const userData = JSON.parse(localStorage.user);
         const token = userData.token;
         const config = {
            headers: { Authorization: `Bearer ${token}` }
         };
         return axios.get('api/user/details', config)
         .then(({data}) => {
            if(data.status == true){
               this.username = data.users.username;
               this.link = location.host+"/register?r_id="+data.users.username;
           }
         });
       }
   },
   created() {
     this.fetchUser();
     this.userDetails();
   },
}
</script>

<style>

</style>