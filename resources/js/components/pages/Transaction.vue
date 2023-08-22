<template>
  <div>
      <div class="uk-container-expand ">
         <div class="uk-card uk-card-small uk-card-default uk-card-body uk-padding-remove-bottom wi-recharge-topnav">
            <a @click="$router.go(-1)" uk-icon="icon: arrow-left; ratio: 1.2" class="uk-align-left uk-margin-remove-adjacent wi-back-icon uk-icon"><svg width="24" height="24" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="arrow-left"><polyline fill="none" stroke="#000" points="10 14 5 9.5 10 5"></polyline><line fill="none" stroke="#000" x1="16" y1="9.5" x2="5" y2="9.52"></line></svg></a>
            <p class="wi-text-large uk-margin-large-right">Transaction</p>
         </div>
      </div>
      <div class="uk-container-expand uk-margin-medium-bottom">
         <div class="uk-card uk-card-small uk-card-default uk-card-body ">
            <div class="uk-position-relative uk-margin-medium wi-left-arrow" v-for="(transaction, i) in transactions" :key="i" v-if="transactions.length">
               <div class="wi-transaction"  v-if="transaction.status == 1">
                  <div>
                     <span class="wi-transaction-icon-red"><Icon type="md-trophy" /></span> 
                  </div>
                  <div class="wi-recharge-txt ">
                     <p class="uk-margin-remove-bottom uk-text-bold">{{ transaction.amount }} Failed</p>
                     <p>{{ transaction.created_at }}</p>
                  </div>
               </div>
               <div class="wi-transaction"  v-else>
                  <div>
                     <span class="wi-transaction-icon-green"><Icon type="md-trophy" /></span> 
                  </div>
                  <div class="wi-recharge-txt ">
                     <p class="uk-margin-remove-bottom uk-text-bold">{{ transaction.amount }} Success</p>
                     <p>{{ transaction.created_at }}</p>
                  </div>
               </div>
            </div>
            <hr>
         </div>
      </div>
  </div>
</template>

<script>
import store from '../../store';
import {mapGetters} from "vuex";
export default {
    computed: {
      ...mapGetters([
         'getWalletBal',
         'getMobileNo',
         'getId'
      ])
    },
    data() {
       return {
          transactions: []
       }
    },
    methods: {
       async getTransaction() {
         const userData = JSON.parse(localStorage.user);
         const token = userData.token;
         const config = {
            headers: { Authorization: `Bearer ${token}` }
         };
         return axios.get('api/user/transaction', config)
         .then(({data}) => {
            if(data.status == true){
               this.transactions = data.data;
            }else{
            if(data.data.errors == 422){

            }else{
               this.swr();
            }
         }
         });
       }
    },   
   created() {
      this.getTransaction();
   }
}
</script>

<style>

</style>