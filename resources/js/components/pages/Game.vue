<template>
   <div>
      <div class="uk-card-small">
         <div
            class="uk-container-expand uk-margin uk-padding-remove-top uk-padding uk-margin-remove"
            >
            <div class="uk-card uk-card-body wi-recharge-topnav">
               <div class="uk-position-relative">
                  <p class="wi-recharge-blnce">
                     Available balance: ₹ {{ walletBal }}
                  </p>
               </div>
               <div class="uk-position-relative uk-margin">
                  <p uk-margin>
                     <button class="uk-button uk-border-rounded uk-margin-remove-top wi-win-read-btn" uk-toggle="target: #read-rule"> Read Rule</button>
                  </p>
                  <div class="uk-position-top-right">
                      <i class="ivu-icon ivu-icon-ios-refresh" @click="realoadPage()"></i>
                  </div>
               </div>
            </div>
         </div>
      </div>
        <router-view/>
   </div>
</template>
<script>
   import store from "../../store";
   import { mapGetters, mapMutations, mapActions } from "vuex";
   import Pagination from './Pagination';
   import TransactionVue from './Transaction.vue';
   import Win from './Win';
   export default {
      components: {
         Pagination
      },
      computed: {
          walletBal(){
            return store.state.users.wallet ? store.state.users.wallet.amount.toFixed(2) : '0.00'
         }
      },
       data() {
           return {
               myparity: [],
               dis: true,
               gameId: '',
               disabled: true,
               gameOver: false,
               games: [],
               tenResults: [],
               check: false,
               results: {
                   gameId: '',
                   colors: [],
                   number: '',
                   winningAmt: '',
                   gameResult: []
               },
               resultModal: false,
               readRuleModal: false,
               data: {
                  walletBal: '',
                  title: '',
                  isAdding: false,
                  modal: false,
                  balance: 0,
                  minutes: "",
                  seconds: "",
                  timer: "",
                  battingData: {
                     type: "",
                     amount: 10,
                     qty: 1,
                     contractMoney: 0
                  },
                  userData: {
                     id: "",
                     walletBal: "",
                     mobile: "",
                     memberID: "",
                  },
                  time: new Date(),
                  countDown: "",
                  loading: true, //when goes to server it should true
               },
               paginate: {
                  first_page_url: '',
                  last_page_url: '',
                  next_page_url: '',
                  prev_page_url: '',
                  current_page: '',
                  last_page: ''
               },
               paginationData: {},
               paginationData2: {}
           };
       },
       methods: {
         pagination(res){
            this.paginate.first_page_url = res.first_page_url;
            this.paginate.last_page_url = res.last_page_url;
            this.paginate.next_page_url = res.next_page_url;
            this.paginate.prev_page_url = res.prev_page_url;
            this.paginate.current_page = res.current_page;
            this.paginate.last_page = res.last_page;
            this.makePagination(res.meta, res.links);
         },
         makePagination(meta, links){
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev,
                per_page: meta.per_page
            }
            this.paginationData = pagination;
         },
         pagination2(res){
            this.paginate.first_page_url = res.first_page_url;
            this.paginate.last_page_url = res.last_page_url;
            this.paginate.next_page_url = res.next_page_url;
            this.paginate.prev_page_url = res.prev_page_url;
            this.paginate.current_page = res.current_page;
            this.paginate.last_page = res.last_page;
            this.makePagination2(res.meta, res.links);
         },
         makePagination2(meta, links){
            let pagination2 = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev,
                per_page: meta.per_page
            }
            this.paginationData2 = pagination2;
         },
         async addBatting() {
            if(this.check == false)
               return this.e("check terms and condtions first");
            if (this.data.battingData.contractMoney == "")
               return this.e("Amount is required!");
            if (store.state.users.wallet.amount <= 10 || store.state.users.wallet.amount < this.data.battingData.contractMoney)
               return this.e("Insufficient Balance!");
            if((store.state.users.wallet.amount - this.data.battingData.contractMoney) < 10)
               return this.e("Maintain minimum 10 rupees balance");
            this.data.isAdding = true;
            const res = await this.callApi( "post","game/user_play",this.data.battingData);
            if (res.status == 200) {
                  this.$store.dispatch('fetchNickName');
                  this.myParityRecord();
                  if(res.data.status == 'LOW_BAL'){
                     this.e(res.data.msg);
                  }
                  if(res.data.status == 'MAINTAIN_BAL'){
                     this.e(res.data.msg);
                  }
                  UIkit.modal("#color-model").hide();
            } else {
               if (res.status == 422) {
                  this.e(res.data.errors.qty[0]);
               } else {
                  this.swr();
               }
            }
            this.data.isAdding = false;
         },
         async addModal(props, title, color) {
            UIkit.modal("#color-model").show()
            $('#header').html(`<div class="${color}">
               <h2 class="uk-modal-title ">${ title }</h2>
            </div>`)
            this.data.title = title;
            this.data.battingData.type = props;
         },
         async gameResult() {
            const res = await this.callApi("get", "game/result/"+(this.gameId));
            if (res.status == 200) {
                  this.results.gameId = res.data.data.game_id;
                  this.results.colors = res.data.data.color;
                  this.results.number = res.data.data.number;
                  this.results.winningAmt = res.data.data.winning_amount;
                  this.results.gameResult = res.data.data.game_result;
                  this.resultModal = true;
                  var fiveSecond = setTimeout(() => {
                     this.resultModal = false;
                     clearTimeout(fiveSecond);
                  }, 5000);
            } else {
                  this.swr();
            }
         },
         async gameCall() {
            const response = await this.callApi("get", "game/play");
            if (response.status == 200) {
               this.gameId = response.data.data.id;
                  this.games = response.data;
                  console.log(response.data.game_status);
                  if(response.data.game_status === false){
                     window.location.reload();
                     this.gameOver = true;
                     this.disabled = true;
                     this.data.loading = true;
                  }else{
                     this.data.loading = false;
                     var timer = response.data.data.timer;
                  }
                  var gameTimer = setInterval(() => {
                     timer = timer-1;
                     let minutes = Math.floor((timer) / 60);
                     let seconds = Math.floor((timer) - minutes * 60);
                     $(".countdown").text(
                        minutes.toString().padStart(2, "0") +":" +seconds.toString().padStart(2, "0")
                     );
                     if (minutes === 0 && seconds <= 30) {
                        UIkit.modal("#color-model").hide();
                        this.data.modal = false;
                        this.disabled = true;
                        this.data.loading = true;
                     }
                     if (minutes === 0 && seconds === 0) {
                        this.gameResult();
                        clearInterval(gameTimer);
                        this.gameCall();
                     }
                  }, 1000);
               this.disabled = false;
               this.fetchTenResults();
               this.myParityRecord();
            }
         },
         async fetchTenResults(page_url){
            page_url = page_url || "game/full/result"
            const response = await this.callApi("get", page_url);
            if (response.status == 200) {
               this.tenResults = response.data.data;
               this.pagination2(response.data);
            }
         },
         async user() {
            const res = await this.callApi("get", "user/details");
            if(res.status == 200){
               store.commit('setUsers');
            }
         },
         async myParityRecord(page_url) {
            page_url = page_url || "user/my/parity/record";
            const response = await this.callApi("get", page_url);
            if(response.status == 200){
               this.$store.dispatch('fetchNickName');
               this.myparity = response.data.data;
               this.pagination(response.data);
            }
         },
         realoadPage(){
            window.location.reload();
         },
         async fetchUser() {
            await store.dispatch('fetchUser')
         }
       },
       async created() {
         //   const res = await this.callApi("get", "game/play");
         //   if (res.status == 200) {
         //      this.gameId = res.data.data.id;
         //      this.games = res.data;
         //      console.log(res.data.game_status);
         //       if(res.data.game_status === false){
         //             // window.location.reload();
         //             this.gameOver = true; //it will be true when goes live
         //             this.disabled = true; //it will be true when goes live
         //             this.data.loading = true; //it will be true when goes live
         //       }else{
         //           this.data.loading = false;
         //           this.disabled = false;
         //           var timer = res.data.data.timer;
         //       }
         //       var gameTimer = setInterval(() => {
         //           timer = timer-1;
         //           let minutes = Math.floor((timer) / 60);
         //           let seconds = Math.floor((timer) - minutes * 60);
         //           $(".countdown").text(minutes.toString().padStart(2, "0") +":" +seconds.toString().padStart(2, "0"));
         //           if (minutes === 0 && seconds <= 30) {
         //             UIkit.modal("#color-model").hide();
         //             this.disabled = true;
         //             this.data.loading = true;
         //             this.data.modal = false;
         //           }
         //           if (minutes === 0 && seconds === 0) {
         //              this.gameResult();
         //              clearInterval(gameTimer);
         //              this.gameCall();
         //          }
         //       }, 1000);
         //       this.fetchTenResults();
         //       this.myParityRecord();
         //   } else {
         //    this.swr();
         //   }
         this.fetchUser();
       }
   };
</script>
<style scoped>
   .demo-spin-icon-load {
   animation: ani-demo-spin 1s linear infinite;
   }
   .lost {
   text-align: center;
   overflow: hidden;
   letter-spacing: 2px;
   color: black;
   margin: 20px auto;
   width: 100%;
   font-size: 80px;
   font-family: "Cascadia Code";
   animation: bloody 4s ease infinite alternate;
   -webkit-animation: bloody 4s ease infinite alternate;
   -moz-animation: bloody 4s ease infinite alternate;
   -o-animation: bloody 4s ease infinite alternate;
   margin-bottom: 0;
   padding-bottom: 0;
   margin: auto;
   }
   .no-outline{
   outline: none;
   border: none;
   }
   button[disabled="disabled"] {
   opacity: .3;
   }
   .wi-badge-result-violet{
      background-color: #9c28b1;
   }
</style>
