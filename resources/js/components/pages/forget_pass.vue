<template>
   <div>
      <div class="uk-container-expand">
         <div class="uk-card uk-card-small uk-card-body uk-padding-remove-bottom wi-login-topNav">
            <div class="uk-position-relative uk-margin-medium">
               <a @click="$router.go(-1)" class="uk-align-left uk-margin uk-margin-remove-adjacent"><img src="img/back-arrow.png" style="margin-top:5px;"></a>
               <p class="wi-text-large uk-margin-large-right">Reset Password</p>
            </div>
         </div>
      </div>
      <div class="uk-section-muted uk-flex uk-flex-middle ">
         <div class="uk-width-1-1">
            <div class="uk-container">
               <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
                  <div class="uk-width-1-1@m">
                     <form class="uk-margin uk-width-large uk-margin-auto uk-card uk-padding-small uk-card-body">
                        <div class="uk-margin">
                           <div class="uk-inline uk-width-1-1">
                              <span class="uk-form-icon" uk-icon="icon: phone; ratio: 1.2" style="color: #525252;"></span>
                              <input class="uk-input wi-login-input" v-model="data.mobile" type="text" placeholder="please enter your mobile no">
                           </div>
                        </div>
                        <div class="uk-margin" uk-margin>
                           <div class="uk-inline">
                              <div uk-form-custom="target: true">
                                 <span class="uk-form-icon" uk-icon="icon: commenting"></span>
                                 <input class="uk-input wi-frm-width-forget wi-login-input" v-model="data.otp" type="text" placeholder="Enter OTP">
                              </div>
                           </div>
                           <div id="otpBtn">
                              <button type="button" class="uk-button uk-button-primary wi-otp-btn-foget uk-margin-remove" @click="otp()" :disabled="isClicked" :loading="isClicked">{{isClicked ? data.time : 'OTP'}}</button>
                           </div>
                        </div>
                        <div class="uk-margin">
                           <div class="uk-inline uk-width-1-1">
                              <span class="uk-form-icon" uk-icon="icon: lock"></span>
                              <input class="uk-input wi-login-input" type="password" v-model="data.new_password" placeholder="New password">
                           </div>
                        </div>
                        <div class="uk-margin">
                           <div class="uk-inline uk-width-1-1">
                              <span class="uk-form-icon" uk-icon="icon: lock"></span>
                              <input class="uk-input wi-login-input" type="password" v-model="data.confirm_password" placeholder="Confirm password">
                           </div>
                        </div>
                        <p class="uk-text-center uk-margin">
                           <button type="button" class="uk-button uk-button-primary uk-width-1-2 wi-login-btn" :disabled="isContinoue" :loading="isContinoue" @click="handleSubmit()">{{isContinoue ? 'Confirming...' : 'Continue'}}</button>
                        </p>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>
<script>
export default {
   data() {
      return{
         data : {
            type: 2,
            time: 59,
            mobile: '',
            otp: '',
            new_password: '',
            confirm_password: ''
         },
         isContinoue: false,
         isClicked: false
      }
   },
   methods: {
      timeLapse(){
         if(this.time > 0) {
               var t = setInterval(() => {
                  this.time = this.time-1;
                  $("#otp").html(this.time);
                  this.isClicked = true;
                  if(this.time == 0){
                     clearInterval(t);
                      $("#otpBtn").html('<button type="button" id="otp" class="uk-button uk-button-primary wi-otp-btn-foget uk-margin-remove" @click="otp()" :disabled="isClicked" :loading="isClicked">OTP</button>');
                      this.isClicked = false;
                  }
               }, 1000);
            }
      },
      async otp(){
         if(this.data.mobile.trim() == '')
               return this.e("Mobile No is required!")
               this.isClicked = true;
               const res = await this.callApi("post", "user/otp", this.data)
               if(res.status == 200){
                  this.timeLapse();
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
         if(this.data.mobile.trim() == '') return this.e('Mobile No is required!');
         if(this.data.otp.trim() == '') return this.e('OTP is required!');
         if(this.data.new_password.length < 6) return this.e('Atleast 6 characters');
         if(this.data.new_password != this.data.confirm_password) return this.e('Password should match!');
         this.isContinoue = true;
         const res = await this.callApi('post', 'user/reset/password', this.data)
         if(res.status == 200){
            for(let i in res.data.error_message) {
                  this.e(res.data.error_message[i][0]);
               }
               if(res.data.status === true){
                  this.s(res.data.message);
                  window.location = '/login';
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
         this.isContinoue = false;
      }
   }
}
</script>