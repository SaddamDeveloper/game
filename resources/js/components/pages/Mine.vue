<template>
   <div>
      <div class="uk-card-small uk-card wi-mine-topbox">
         <div class="uk-container-expand uk-margin uk-padding-small uk-margin-remove">
            <div class="uk-card uk-card-body wi-mine-recharge-topnav">
               <article class="uk-comment">
                  <header class="uk-comment-header">
                     <div class="uk-grid-medium uk-flex-middle" uk-grid>
                        <div class="uk-width-auto">
                           <img class="uk-comment-avatar" src="img/avatar.png"  alt="">
                        </div>
                        <div class="wi-avatar-txt uk-width-expand">
                           <p class="uk-margin-remove wi-recharge-blnce">Nick Name : {{ name }}</p>
                           <p class="uk-margin-remove wi-recharge-blnce">ID : {{ userId }}</p>
                        </div>
                     </div>
                  </header>
                  <div class="uk-position-top-right uk-padding-small">
                     <img src="img/notification.png" style="margin-top:5px;">
                  </div>
               </article>
               <div class="uk-position-relative">
                  <p class="wi-recharge-blnce">
                     Mobile : +91 {{ mobile }}
                  </p>
                  <p class="wi-recharge-blnce">
                     Available balance : ₹ {{ walletBal }}
                  </p>
               </div>
               <div class="uk-position-relative uk-margin">
                  <p uk-margin>
                     <router-link to="/recharge" class="uk-button uk-border-rounded  wi-win-recharge-btn"> Recharge</router-link>
                     <button @click="modal=true" type="button" class="uk-button uk-border-rounded uk-margin-remove-top wi-win-read-btn"> Change Nick Name
                     </button>
                  </p>
               </div>
            </div>
         </div>
      </div>
         <div class="accordion-section ">
         <div class="wi-accordion-mt">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
               <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingOne">
                     <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <i class="more-less fa fa-angle-down"></i>
                        <i class="fa fa-minus-square accordion-list-icon" aria-hidden="false"></i>Wallet
                        </a>
                     </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                     <div class="panel-body">
                        <ul class="accordion-list">
                           <li>
                              <router-link to="/recharge">Recharge</router-link>
                           </li>
                           <li>
                              <router-link to="/withdrawal">Withdrawal</router-link>
                           </li>
                           <li>
                              <router-link to="/request">Withdrawal Request</router-link>
                           </li>
                           <li>
                              <router-link to="/transaction">Transactions</router-link>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="panel panel-default">
                  <div class="panel-heading" role="tab">
                     <h4 class="panel-title">
                        <router-link class="collapsed" to="/promotions"><i class="fa fa-bullhorn accordion-list-icon"></i>Promotions</router-link>
                     </h4>
                  </div>
               </div>
               <div class="panel panel-default">
                  <div class="panel-heading" role="tab">
                     <h4 class="panel-title">
                        <router-link class="collapsed" to="/bankcard"><i class="fa fa-credit-card accordion-list-icon"></i>Bank Card</router-link>
                     </h4>
                  </div>
               </div>
               <div class="panel panel-default">
                  <div class="panel-heading" role="tab">
                     <h4 class="panel-title">
                        <router-link class="collapsed" to="/address" >
                           <i class="fa fa-building-o accordion-list-icon"></i>Address
                        </router-link>
                     </h4>
                  </div>
               </div>
               <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingTwo">
                     <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                       <i class="more-less fa fa-angle-down"></i>
                        <i class="fa fa-diamond accordion-list-icon" aria-hidden="true"></i>Account Security
                        </a>
                     </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                     <div class="panel-body">
                        <ul class="accordion-list">
                           <li>
                              <router-link to="/changepassword">Modify Password</router-link>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="panel panel-default">
                  <div class="panel-heading" role="tab">
                     <h4 class="panel-title">
                        <router-link class="collapsed" role="button"  to="/complaint" aria-expanded="false" >
                           <i class="fa fa-commenting-o accordion-list-icon"></i>Complaints & Suggestions
                        </router-link>
                     </h4>
                  </div>
               </div>
               <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingThree">
                     <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                       <i class="more-less fa fa-angle-down"></i>
                        <i class="fa fa-bookmark accordion-list-icon" aria-hidden="false"></i>About
                        </a>
                     </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                     <div class="panel-body">
                        <ul class="accordion-list">
                           <li>
                              <router-link to="/privacy">Privacy Policy</router-link>
                           </li>
                           <li>
                              <router-link to="/about">About Us</router-link>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   <div class="uk-container">
    <p uk-margin class="uk-margin-xlarge-bottom uk-text-center">
      <button @click.prevent="logout()" class="uk-button uk-margin-remove-top wi-mine-logout" :disabled="isLogout" :loading="isLogout">{{isLogout ? 'Please wait...' : 'Logout'}}</button>
      </p>
      </div>
       <Modal
        v-model="modal"
        title="Set Nick Name"
        >
        <Input v-model="data.nickName" placeholder="Set Nick Name"/>
         <div slot="footer">
            <Button
               type="primary"
               @click.prevent="btnnickName()"
               :disabled="data.isAdding"
               :loading="data.isAdding"
               >{{ data.isAdding ? "Please wait..." : "Submit" }}</Button>
         </div>
    </Modal>
   </div>
</template>
<script>
   import store from "../../store";
   import { mapGetters, mapMutations } from 'vuex';
   export default {
      computed: {
         mobile () {
            return store.state.users ? store.state.users.mobile : '+91-XXXXXX'
         },
         walletBal(){
            return store.state.users.wallet ? store.state.users.wallet.amount.toFixed(2) : '0.00'
         },
         userId(){
            return store.state.users ? store.state.users.username : '0'
         },
         name(){
            return store.state.users ? store.state.users.name : 'John Doe'
         }
      },
      data() {
         return {
            modal: false,
            data: {
               isAdding: false,
               nickName: ''
            },
            isLogout: false
         }
      },
      methods: {
         ...mapMutations([
            'setNickName'
         ]),
         async fetchUser() {
            store.dispatch('fetchUser')
         },
         async btnnickName() {
            // this.setNickName(this.data.nickName)
            await store.dispatch('setNName');
            this.modal = false;
         },
         async logout(){
            this.isLogout = true;
            const secure = await this.callApi('get', '/sanctum/csrf-cookie');
            if(secure){
               await store.dispatch('logout')
               .then(() => {
                  this.$router.push({ name: 'login' })
                  this.isLoggin = false; 
               })
               .catch(err => {
                  this.isLoggin = false; 
               });
            }
         }
      },
      created() {
         this.fetchUser();
      },
   }
</script>