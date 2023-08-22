<template>
   <div>
      <div class="uk-container-expand">
         <div class="uk-card uk-card-small uk-card-body uk-padding-remove-bottom wi-login-topNav">
            <div class="uk-position-relative uk-margin-medium">
               <a @click="$router.go(-1)" class="uk-align-left uk-margin uk-margin-remove-adjacent"><img src="img/back-arrow.png" style="margin-top:5px;"></a>
               <p class="wi-text-large uk-margin-large-right">Login</p>
            </div>
         </div>
      </div>
      <div class="uk-flex" >
         <div class="uk-width-1-1">
            <div class="uk-container">
               <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
                  <div class="uk-width-1-1@m">
                     <div class="uk-margin uk-width-large uk-margin-auto uk-padding-small uk-card uk-card-body">
                        <form :rules="ruleInline">
                           <div class="uk-margin">
                              <div class="uk-inline uk-width-1-1">
                                 <span class="uk-form-icon" uk-icon="icon: phone; ratio: 1.2" style="color: #525252;"></span>
                                 <input class="uk-input wi-login-input" type="text" v-model="formInline.mobile" placeholder="please enter your mobile no">
                              </div>
                           </div>
                           <div class="uk-margin">
                              <div class="uk-inline uk-width-1-1">
                                 <span class="uk-form-icon" uk-icon="icon: lock; ratio: 1.2" style="color: rgb(56 55 55);"></span>
                                 <input class="uk-input wi-login-input" type="password" v-model="formInline.password" placeholder="please enter your password">	
                              </div>
                           </div>
                           <p class="uk-text-center uk-margin">
                              <a class="uk-button uk-button-primary uk-width-1-2 wi-login-btn" @click.prevent="handleSubmit('formInline')" :disabled="isLoggin" :loading="isLoggin">{{isLoggin ? 'Loging...' : 'Login'}}</a>
                           </p>
                           <p class="uk-text-center wi-register-forgot-btn">
                              <router-link to="/register" class="uk-button uk-button-default uk-modal-close" type="button">Register</router-link>
                              <router-link to="/forget_pass" class="uk-button uk-button-primary" type="button">Forgot Password?</router-link>
                           </p>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>
<script>
   import store from "../../store";
   export default {
      data() {
         return {
            authenticated: false,
            formInline : {
               mobile : '', 
               password: ''
            }, 
            ruleInline: {
               mobile: [
                  { required: true, message: 'Please enter Mobile No', trigger: 'blur' }
               ],
               password: [
                  { required: true, message: 'Please enter the Password.', trigger: 'blur' },
                  { type: 'string', min: 6, message: 'The password length cannot be less than 6 characters', trigger: 'blur' }
               ]
            },
            buttonSize: 'large',
            isLoggin: false
         }
      },
      methods: {
         async handleSubmit() {
               if(this.formInline.mobile.trim() == '') return this.e('Mobile No is required!');
               if(this.formInline.password.trim() == '') return this.e('Password is required!');
               if(this.formInline.password.length < 6) return this.e('Incorrect login details');
                  this.isLoggin = true;
                  const secure = await this.callApi('get', '/sanctum/csrf-cookie');
                  if(secure){
                     await store.dispatch('login', this.formInline)
                     .then(() => {
                        this.$router.push({ name: 'mine' })
                        this.isLoggin = false; 
                     })
                     .catch(err => {
                        this.swr();
                        this.isLoggin = false; 
                     })
                  }
         }
      },
   }
</script>