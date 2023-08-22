<template>
   <div>
      <div class="uk-container-expand">
         <div class="uk-card uk-card-small uk-card-body uk-padding-remove-bottom wi-login-topNav">
            <div class="uk-position-relative uk-margin-medium">
               <a @click="$router.go(-1)" class="uk-align-left uk-margin uk-margin-remove-adjacent"><img src="img/back-arrow.png" style="margin-top:5px;"></a>
               <p class="wi-text-large uk-margin-large-right">Register</p>
            </div>
         </div>
      </div>
      <div class=" uk-section-muted uk-flex  uk-animation-fade">
         <div class="uk-width-1-1">
            <div class="uk-container">
               <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
                  <div class="uk-width-1-1@m">
                     <form class="uk-margin uk-width-large uk-margin-auto uk-card uk-padding-small uk-card-body ">
                        <div class="uk-margin">
                           <div class="uk-inline uk-width-1-1">
                              <span class="uk-form-icon" uk-icon="icon: phone; ratio: 1.2" style="color: #525252;"></span>
                              <input class="uk-input wi-login-input" type="number" v-model="formInline.mobile" placeholder="please enter your mobile no">
                           </div>
                        </div>
                        <div class="uk-margin" uk-margin>
                           <div class="uk-inline">
                              <div uk-form-custom="target: true">
                                 <span class="uk-form-icon" uk-icon="icon: commenting"></span>
                                 <input v-model="formInline.otp" class="uk-input wi-frm-width-forget wi-login-input" type="number" placeholder="Enter OTP">
                              </div>
                           </div>
                           <div id="otpBtn">
                              <input type="button" v-model="this.otpstring" class="uk-button uk-button-primary wi-otp-btn-foget uk-margin-remove" @click="otp()" :disabled="isClicked" :loading="isClicked">
                           </div>
                        </div>
                        <div class="uk-margin">
                           <div class="uk-inline uk-width-1-1">
                              <span class="uk-form-icon" uk-icon="icon: lock"></span>
                              <input class="uk-input wi-login-input" v-model="formInline.password" type="password" placeholder="Password">
                           </div>
                        </div>
                        <div class="uk-margin">
                           <div class="uk-inline uk-width-1-1">
                              <span class="uk-form-icon" uk-icon="icon: lock"></span>
                              <input class="uk-input wi-login-input" v-model="formInline.confirm_password" type="password" placeholder="Confirm Password">
                           </div>
                        </div>
                        <div class="uk-margin">
                           <div class="uk-inline uk-width-1-1">
                              <span class="uk-form-icon" uk-icon="icon: album"></span>
                              <input class="uk-input wi-login-input" v-model="formInline.refferal" type="text" placeholder="Recommendation Code">	
                           </div>
                        </div>
                        <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                           <label><input required class="" type="checkbox"> I agree <a data-v-291c8e94="" href="#privacy-policy" uk-toggle="">Privacy Policy</a></label>
                        </div>
                        <p class="uk-text-center uk-margin">
                           <a href="#!" class="uk-button uk-button-primary uk-width-1-2 wi-login-btn" @click="handleSubmit('formInline')" :disabled="isRegister" :loading="isRegister">{{isRegister ? 'Registering...' : 'Register'}}</a>
                        </p>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- read Privacy Policy model-->
      <div id="privacy-policy" uk-modal>
         <div class="uk-modal-dialog">
            <div class="uk-modal-header">
               <h2 class="uk-modal-title">Privacy Policy</h2>
            </div>
            <div class="uk-modal-body" uk-overflow-auto>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <div class="uk-modal-footer uk-text-right">
               <button class="uk-button uk-button-default uk-modal-close" type="button">Close</button>
            </div>
         </div>
      </div>
   </div>
</template>
<script>
   export default {
      data() {
         return {
            isClicked: false,
            otpstring: 'OTP',
            time: 59,
            formInline : {
               type: 1,
               mobile : '', 
               otp: '',
               refferal: this.$route.query.r_id ? this.$route.query.r_id : '',
               password: '',
               confirm_password: '',
            }, 
            ruleInline: {
               mobile: [
                  { required: true, message: 'Please enter Mobile No', trigger: 'blur' }
               ],
               password: [
                  { required: true, message: 'Please enter the Password.', trigger: 'blur' },
                  { type: 'string', min: 6, message: 'The password length cannot be less than 6 characters', trigger: 'blur' }
               ],
               confirm_password: [
                  { required: true, message: 'Please enter the confirm Password.', trigger: 'blur' },
                  { type: 'string', min: 6, message: 'The password length cannot be less than 6 characters', trigger: 'blur' }
               ]
            },
            buttonSize: 'large',
            isRegister: false
         }
      },
      methods: {
         timeLapse(){
            if(this.time > 0) {
               var t = setInterval(() => {
                  this.time = this.time-1;
                  $("#otp").html(this.time);
                  this.isClicked = true;
                  this.otpstring = this.time;
                  if(this.time == 0){
                     clearInterval(t);
                     this.otpstring = 'OTP';
                      this.isClicked = false;
                  }
               }, 1000);
            }
         },
         async otp(){
            if(this.formInline.mobile.trim() == '')
               return this.e("Mobile No is required!")
               this.isClicked = true;
               const res = await this.callApi("post", "api/user/otp", this.formInline)
               if(res.status == 200){
                  if(res.data.msg == 'ALREADY_REGD'){
                     return this.e("Already Registered!");
                  }else{
                     this.timeLapse();
                  }
               }else{
                   if (res.status == 422) {
                     for (let i in res.data.errors) {
                        this.e(res.data.errors[i][0]);
                     }
                  } else {
                     this.swr();
                  }
               }
               this.isClicked = false;
         },
         async handleSubmit() {
               if(this.formInline.mobile.trim() == ''){
                  return this.e('Mobile No is required!');
               } 
               if(this.formInline.password.trim() == '') {
                  return this.e('Password is required!');
               }
               if(this.formInline.password.length < 6) {
                  return this.e('Password length must be 6 character long!');
               }
               this.isRegister = true;
               const res = await this.callApi('post', 'api/user/register', this.formInline)
               if(res.status == 200){
                  for (let i in res.data.error_message) {
                     this.e(res.data.error_message[i][0]);
                  }
                  if(res.data.status === true){
                    this.s(res.data.message);
                    this.$router.push('/login') ;
                  }
               }else{
                  if(res.status = 422){
                     this.i(res.data.msg)
                  }else{
                     this.swr();
                  }
               }
               this.isRegister = false;
         },
      },
      created() {
         // this.timeLapse();
      },
   }
</script>
<style>
</style>