<template>
  <div>
      <div class="uk-container-expand ">
         <div class="uk-card uk-card-small uk-card-default uk-card-body uk-padding-remove-bottom wi-recharge-topnav">
            <div class="uk-position-relative uk-margin-medium">
               <router-link to="/" uk-icon="icon: arrow-left; ratio: 1.2" class="uk-align-left uk-margin-remove-adjacent wi-back-icon uk-icon"><svg width="24" height="24" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="arrow-left"><polyline fill="none" stroke="#000" points="10 14 5 9.5 10 5"></polyline><line fill="none" stroke="#000" x1="16" y1="9.5" x2="5" y2="9.52"></line></svg></router-link>
               <p class="uk-text-center wi-text-large uk-margin-large-right">Change Password</p>
               <div class="uk-position-top-right">
               </div>
            </div>
         </div>
      </div>
    
       <div class="uk-section uk-section-muted uk-flex uk-flex-middle uk-animation-fade">
            <div class="uk-width-1-1">
               <div class="uk-container">
                  <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid="">
                     <div class="uk-width-1-1@m uk-first-column">
                        <form class="uk-margin uk-width-large uk-margin-auto uk-card  uk-card-body uk-box-shadow-large">
                           <h3 class="uk-card-title uk-text-center">Modify the login password</h3>
                        
                           <div class="uk-margin">
                              <div class="uk-inline uk-width-1-1">
                                 <span class="uk-form-icon uk-icon" uk-icon="icon: lock"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="lock"><rect fill="none" stroke="#000" height="10" width="13" y="8.5" x="3.5"></rect><path fill="none" stroke="#000" d="M6.5,8 L6.5,4.88 C6.5,3.01 8.07,1.5 10,1.5 C11.93,1.5 13.5,3.01 13.5,4.88 L13.5,8"></path></svg></span>
                                 <input class="uk-input" type="password" v-model="data.login_password" placeholder="Please enter the login password">
                              </div>
                           </div>
                           <div class="uk-margin">
                              <div class="uk-inline uk-width-1-1">
                                 <span class="uk-form-icon uk-icon" uk-icon="icon: lock"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="lock"><rect fill="none" stroke="#000" height="10" width="13" y="8.5" x="3.5"></rect><path fill="none" stroke="#000" d="M6.5,8 L6.5,4.88 C6.5,3.01 8.07,1.5 10,1.5 C11.93,1.5 13.5,3.01 13.5,4.88 L13.5,8"></path></svg></span>
                                 <input class="uk-input" type="password" v-model="data.new_password" placeholder="Please enter the new password">
                              </div>
                           </div>
                           <div class="uk-margin">
                              <div class="uk-inline uk-width-1-1">
                                 <span class="uk-form-icon uk-icon" uk-icon="icon: lock"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="lock"><rect fill="none" stroke="#000" height="10" width="13" y="8.5" x="3.5"></rect><path fill="none" stroke="#000" d="M6.5,8 L6.5,4.88 C6.5,3.01 8.07,1.5 10,1.5 C11.93,1.5 13.5,3.01 13.5,4.88 L13.5,8"></path></svg></span>
                                 <input class="uk-input" type="password" v-model="data.confirm" placeholder="Please enter the Confirm password">	
                              </div>
                           </div>
                           <div class="uk-margin">
                               <Button type="success" size="large" class="uk-button uk-button-primary  uk-width-1-1" @click="handleSubmit" :disabled="isClicked" :loading="isClicked">{{isClicked ? 'Submit...' : 'Submit'}}</Button>
                           </div>
                        </form>
                        
                     </div>
                  </div>
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
      ...mapGetters([
         'getWalletBal',
         'getMobileNo',
         'getId'
      ])
    },
    data() {
       return {
          data :{
              login_password: '',
              new_password: '',
              confirm: ''
          },
          isClicked: false
       }
    },
    methods: {
        async handleSubmit() {
            if(this.data.login_password.trim() == "")
                return this.e("Login Password is required!")
            if(this.data.new_password.trim() == "")
                return this.e("New Password is required!")
            if(this.data.confirm.trim() == "")
                return this.e("Confirm password is required!")
            if(this.data.new_password != this.data.confirm)
                return this.e("Password doesn't matched")
            if(this.data.login_password === this.data.new_password && this.data.login_password === this.data.confirm)
                return this.e("New Password can't be same as old Password!")
            this.isClicked = true;
            const userData = JSON.parse(localStorage.user);
            const token = userData.token;
            const config = {
               headers: { Authorization: `Bearer ${token}` }
            };
            return axios.post('api/user/changepassword', this.data, config)
            .then(({data}) => {
               if(data.status == true){
                   if(data.err == 'SAME'){
                    return this.e("New Password can't be same as old Password!");
                }
                if(data.err == 'ERROR'){
                    return this.e("Old Password is wrong");
                }
                if(data.msg == 'SUCCESS'){
                    this.data = {};
                    this.isClicked = false;
                    return this.s("Password successfully changed!");
                }
               }else{
                   if (status == 422) {
                     for (let i in data.errors) {
                        this.e(data.errors[i][0]);
                     }
                  } else {
                     this.swr();
                  }
               }
            });
        }
    },   
   created() {
   }
}
</script>