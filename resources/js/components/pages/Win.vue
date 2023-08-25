<template>
    <div>
        <div class="uk-container-expand wi-win-parity-bg">
            <div class="uk-padding-small">
                <div class="uk-position-relative uk-margin-remove-top">
                    <div class="uk-position-relative wi-win-parity-period">
                        <p>
                            <span class="wi-nav-icon">
                                <Icon type="md-trophy" />
                            </span>
                            <span class="wi-win-parity-period">Period</span>
                        </p>
                    </div>
                    <div class="uk-position-relative">
                        <p class="wi-recharge-blnce" style="font-size: 20px">
                            {{ gameId }}
                        </p>
                    </div>
                    <div class="uk-position-top-right">
                        <div class="uk-position-relative wi-win-parity-period">
                            <p>Count Down</p>
                        </div>
                        <div class="uk-position-relative">
                            <div class="wi-recharge-blnce">
                                <span
                                    id="timer"
                                    class="countdownthree"
                                    style="font-size: 20px"
                                ></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="uk-container">
                    <p uk-margin class="uk-text-center wi-win-clr-btn">
                        <button
                            class="uk-button uk-border-rounded"
                            style="background: #ff0000"
                            @click="
                                addModal(11, 'Join Red', 'background:#FF0000')
                            "
                            size="large"
                            :loading="data.loading"
                            :disabled="disabled"
                        >
                            Join Red
                        </button>
                        <button
                            class="uk-button uk-border-rounded"
                            style="background: #ff5722"
                            @click="
                                addModal(
                                    12,
                                    'Join Orange',
                                    'background:#ff5722'
                                )
                            "
                            size="large"
                            :loading="data.loading"
                            :disabled="disabled"
                        >
                            Join Orange
                        </button>
                        <button
                            class="uk-button uk-border-rounded"
                            style="background: #0027ff"
                            @click="
                                addModal(13, 'Join Blue', 'background:#0027ff')
                            "
                            size="large"
                            :loading="data.loading"
                            :disabled="disabled"
                        >
                            Join Blue
                        </button>
                    </p>
                </div>
            </div>
            <div class="uk-margin">
                <div class="uk-container uk-text-center">
                    <div class="">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    1,
                                    'Number 0',
                                    'win-numberClr-model-header'
                                )
                            "
                        >
                            0
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    2,
                                    'Number 1',
                                    'win-numberClr-model-header'
                                )
                            "
                        >
                            1
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    3,
                                    'Number 2',
                                    'win-numberClr-model-header'
                                )
                            "
                        >
                            2
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    4,
                                    'Number 3',
                                    'win-numberClr-model-header'
                                )
                            "
                        >
                            3
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    5,
                                    'Number 4',
                                    'win-numberClr-model-header'
                                )
                            "
                        >
                            4
                        </button>
                    </div>
                    <div class="uk-margin">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    6,
                                    'Number 5',
                                    'win-numberClr-model-header'
                                )
                            "
                        >
                            5
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    7,
                                    'Number 6',
                                    'win-numberClr-model-header'
                                )
                            "
                        >
                            6
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    8,
                                    'Number 7',
                                    'win-numberClr-model-header'
                                )
                            "
                        >
                            7
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    9,
                                    'Number 8',
                                    'win-numberClr-model-header'
                                )
                            "
                        >
                            8
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    10,
                                    'Number 9',
                                    'win-numberClr-model-header'
                                )
                            "
                        >
                            9
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-margin-large-bottom">
            <div class="uk-container">
                <div class="uk-margin-auto uk-margin-small-bottom">
                    <div class="wi-Parity-underline">
                        <p class="wi-nav-icon uk-text-center">
                            <Icon type="md-trophy" />
                        </p>
                        <p class="wi-Parity-Record uk-text-center">
                            Parity Record
                        </p>
                    </div>
                    <table
                        class="uk-table wi-table uk-table-middle uk-table-divider"
                    >
                        <thead>
                            <tr>
                                <th class="uk-table-expand" scope="col">
                                    Period
                                </th>
                                <th scope="col">Number</th>
                                <th scope="col">Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(result, i) in tenResults"
                                :key="i"
                                v-if="tenResults.length"
                            >
                                <td data-label="Period">
                                    {{ result.game_play_id }}
                                </td>
                                <td
                                    class="wi-record-no-red"
                                    data-label="Number"
                                >
                                    {{ result.number_value }}
                                </td>
                                <td data-label="Result">
                                    <span>
                                        <span
                                            class="wi-badge-result"
                                            :style="{
                                                'background-color':
                                                    result.color_value,
                                            }"
                                        ></span>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="uk-position-relative">
                        <Pagination
                            :pagination="paginationData2"
                            @clickEmit="fetchTenResults"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="wi-Parity-border"></div>
        <div class="uk-padding-remove-top">
            <div class="uk-container">
                <div class="uk-margin-auto">
                    <div class="wi-myParity-underline">
                        <p class="wi-nav-icon uk-text-center">
                            <Icon type="md-trophy" />
                        </p>
                        <p class="wi-Parity-Record uk-text-center">
                            My Parity Record
                        </p>
                    </div>
                    <div class="uk-margin">
                        <table
                            class="uk-table wi-table uk-table-middle uk-table-divider"
                        >
                            <thead>
                                <tr>
                                    <th class="uk-table-expand" scope="col">
                                        Period
                                    </th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(parity, i) in myparity"
                                    :key="i"
                                    v-if="myparity.length"
                                >
                                    <td>{{ parity.game_play_id }}</td>
                                    <td>{{ parity.amount }}</td>
                                    <td>
                                        <span
                                            class="uk-label uk-label-warning"
                                            v-if="
                                                parity.is_win == '1' &&
                                                parity.status == '1'
                                            "
                                            >Pending</span
                                        >
                                        <span
                                            class="uk-label uk-label-danger"
                                            v-if="
                                                parity.is_win == '1' &&
                                                parity.status == '2'
                                            "
                                            >Fail</span
                                        >
                                        <span
                                            class="uk-label uk-label-success"
                                            v-if="
                                                parity.is_win == '2' &&
                                                parity.status == '2'
                                            "
                                            >Success</span
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr />
            <div class="uk-position-relative uk-padding">
                <Pagination
                    :pagination="paginationData"
                    @clickEmit="myParityRecord"
                />
            </div>
        </div>
        <div class="wi-MyParity-border"></div>

        <!-- color model -->
        <div id="color-model" class="uk-flex-top" uk-modal>
            <div class="uk-modal-dialog">
                <div id="header"></div>
                <div class="uk-modal-body">
                    <div class="">
                        <p class="wi-win-popup-text">Contract Money</p>
                        <div class="uk-container-expand">
                            <div>
                                <div
                                    class="wi-model-contract-money uk-button-group uk-margin-small uk-margin-small-top"
                                >
                                    <RadioGroup
                                        v-model="data.battingData.amount"
                                        type="button"
                                    >
                                        <Radio
                                            class="uk-button uk-button-secondary uk-active"
                                            label="10.00"
                                        ></Radio>
                                        <Radio label="100.00"></Radio>
                                        <Radio label="1000.00"></Radio>
                                    </RadioGroup>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-margin-small-top">
                        <p class="wi-win-popup-text">Contract Count</p>
                        <div class="uk-container-expand">
                            <div class="uk-margin-small uk-margin-small-top">
                                <button
                                    type="button"
                                    id="sub"
                                    :disabled="
                                        data.battingData.qty == 1
                                            ? dis == true
                                            : dis == false
                                    "
                                    @click="data.battingData.qty--"
                                    class="sub win-model-plus-minus"
                                >
                                    <i
                                        class="fa fa-minus"
                                        aria-hidden="true"
                                    ></i>
                                </button>
                                <input
                                    type="text"
                                    id="1"
                                    min="1"
                                    v-model="data.battingData.qty"
                                    class="wi-win-popup-qntity-input"
                                />
                                <button
                                    type="button"
                                    id="add"
                                    @click="data.battingData.qty++"
                                    class="add win-model-plus-minus"
                                >
                                    <i
                                        class="fa fa-plus"
                                        aria-hidden="true"
                                    ></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="uk-margin-medium-top">
                        <span class="wi-win-popup-text"
                            >Total contract money is
                            {{
                                (data.battingData.contractMoney = (
                                    data.battingData.amount *
                                    data.battingData.qty
                                ).toFixed(2))
                            }}</span
                        >
                        <div
                            class="uk-margin uk-grid-small uk-child-width-auto uk-grid"
                        >
                            <label></label
                            ><input
                                class="from-control"
                                type="checkbox"
                                v-model="check"
                                required
                                style="margin: 3px; width: 20px; height: 15px"
                            />
                            <span style="color: gray">I agree </span
                            ><a href="#read-rule" uk-toggle>Presale Rule </a>
                        </div>
                    </div>
                </div>
                <div class="uk-text-right wi-win-popup-btn">
                    <button
                        class="uk-button uk-button-default uk-modal-close wi-model-cancle-btn"
                        type="button"
                    >
                        Cancel
                    </button>
                    <button
                        class="uk-button uk-button-primary wi-model-confirm-btn"
                        type="button"
                        @click="addBatting"
                        :disabled="data.isAdding"
                        :loading="data.isAdding"
                    >
                        {{ data.isAdding ? "Confirming..." : "Confirm" }}
                    </button>
                </div>
            </div>
        </div>
        <!-- read rule model-->
        <div
            id="read-rule"
            class="uk-flex-top uk-margin-medium-bottom"
            uk-modal
        >
            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                <button
                    class="uk-modal-close-default"
                    type="button"
                    uk-close
                ></button>
                <strong>Rules of guess:</strong>
                <p>
                    3 minutes 1 issue, 2 minutes and 30 seconds to order, 30
                    seconds to show the lottery result. It opens all day. The
                    total number of trade is 480 issues.
                </p>
                <p>
                    If you spend 100 rupees to trade, your contract amount is
                    100 rupees:
                </p>
                <p>
                    1.JOIN GREEN: if the result shows 1,3,7,9, you will get
                    (100*2) 200 rupees;
                </p>
                <p>If the result shows 5, you will get (100*1.5) 150 rupees.</p>
                <ul class="uk-list">
                    <li>
                        2. JOIN RED: if the result shows 2,4,6,8, you will get
                        (100*2) 200 rupees; If the result shows 0, you will get
                        (100*1.5) 150 rupees.
                    </li>
                    <li>
                        3. JOIN VIOLET: if the result shows 0 or 5, you will get
                        (100*4.5) 450 rupees.
                    </li>
                    <li>
                        4. SELECT NUMBER: if the result is the same as the
                        number you selected, you will get (100*9) 900 rupees.
                    </li>
                </ul>
            </div>
        </div>
        <Modal v-model="resultModal" title="Result">
            <div class="modal-top" v-if="results.winningAmt != 0">
                <img
                    class="modal-icon u-imgResponsive"
                    src="img/trophy.png"
                    alt="Trophy"
                />
                <div class="modal-header">
                    Congratulations
                    <p class="modal-subheader">
                        You have Win {{ results.winningAmt }} rupees
                    </p>
                </div>
            </div>
            <div
                data-v-291c8e94=""
                class="uk-position-relative uk-margin-remove-top"
            >
                <p data-v-291c8e94="" uk-margin="">
                    <span
                        data-v-291c8e94=""
                        class="wi-model-result wi-model-result-number"
                        >{{ results.number }}</span
                    >
                </p>
                <p data-v-291c8e94="" uk-margin="">
                     <span>
                        <span
                            class="wi-badge-result"
                            :style="{
                                'background-color':
                                    results.colors,
                            }"
                        ></span>
                    </span>
                </p>
                <!-- <div
                    data-v-291c8e94=""
                    class="uk-position-top-right"
                    v-for="(color, i) in results.colors"
                    :key="i"
                >
                    <span
                        data-v-291c8e94=""
                        class="wi-model-result wi-model-result-green"
                        v-if="color.name == 'odd'"
                    ></span>
                    <span
                        data-v-291c8e94=""
                        class="wi-model-result wi-model-result-red"
                        v-if="color.name == 'even'"
                    ></span>
                    <span
                        data-v-291c8e94=""
                        class="wi-model-result wi-model-result-gray"
                        v-if="color.name == 'copper'"
                    ></span>
                </div> -->
            </div>
            <div slot="footer">
                <Button type="default" @click="resultModal = false"
                    >Close</Button
                >
            </div>
        </Modal>
        <!-- Game Over Modal -->
        <Modal v-model="gameOver">
            <h1 class="lost">GAME OVER</h1>
            <div slot="footer"></div>
        </Modal>
    </div>
</template>
<script>
import store from "../../store";
import { mapGetters, mapMutations, mapActions, mapState } from "vuex";
import Pagination from "./Pagination";
import TransactionVue from "./Transaction.vue";
export default {
    components: {
        Pagination,
    },
    computed: {
        getId(){
            return store.state.users ? store.state.users.id : ''
        }
    },
    data() {
        return {
            userId: this.getId,
            gameplay: [],
            myparity: [],
            dis: true,
            gameId: "",
            disabled: true,
            gameOver: false,
            games: [],
            tenResults: [],
            check: false,
            results: {
                gameId: "",
                colors: [],
                number: "",
                winningAmt: "",
                gameResult: [],
            },
            resultModal: false,
            readRuleModal: false,
            data: {
                walletBal: "",
                title: "",
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
                    contractMoney: 0,
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
                first_page_url: "",
                last_page_url: "",
                next_page_url: "",
                prev_page_url: "",
                current_page: "",
                last_page: "",
            },
            paginationData: {},
            paginationData2: {},
        };
    },
    methods: {
        async fetchUser() {
            store.dispatch("fetchUser");
        },
        pagination(res) {
            this.paginate.first_page_url = res.first_page_url;
            this.paginate.last_page_url = res.last_page_url;
            this.paginate.next_page_url = res.next_page_url;
            this.paginate.prev_page_url = res.prev_page_url;
            this.paginate.current_page = res.current_page;
            this.paginate.last_page = res.last_page;
            this.makePagination(res.meta, res.links);
        },
        makePagination(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev,
                per_page: meta.per_page,
            };
            this.paginationData = pagination;
        },
        pagination2(res) {
            this.paginate.first_page_url = res.first_page_url;
            this.paginate.last_page_url = res.last_page_url;
            this.paginate.next_page_url = res.next_page_url;
            this.paginate.prev_page_url = res.prev_page_url;
            this.paginate.current_page = res.current_page;
            this.paginate.last_page = res.last_page;
            this.makePagination2(res.meta, res.links);
        },
        makePagination2(meta, links) {
            let pagination2 = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev,
                per_page: meta.per_page,
            };
            this.paginationData2 = pagination2;
        },
        async addBatting() {
            if (this.check == false)
                return this.e("check terms and condtions first");
            if (this.data.battingData.contractMoney == "")
                return this.e("Amount is required!");
            if (
                store.state.users.wallet.amount <= 10 ||
                store.state.users.wallet.amount <
                    this.data.battingData.contractMoney
            )
                return this.e("Insufficient Balance!");
            if (
                store.state.users.wallet.amount -
                    this.data.battingData.contractMoney <
                10
            )
                return this.e("Maintain minimum 10 rupees balance");
            this.data.isAdding = true;
            const userData = JSON.parse(localStorage.user);
            const token = userData.token;
            const config = {
                headers: { Authorization: `Bearer ${token}` },
            };
            return axios
                .post("api/game/user/play", this.data.battingData, config)
                .then(({ data }) => {
                    if (data.status == true) {
                        this.fetchUser();
                        if (data.data.status == "LOW_BAL") {
                            this.e(data.data.msg);
                        }
                        if (data.data.status == "MAINTAIN_BAL") {
                            this.e(data.data.msg);
                        }
                        UIkit.modal("#color-model").hide();
                    } else {
                        if (data.status == 422) {
                            this.e(data.data.errors.qty[0]);
                        } else {
                            this.swr();
                        }
                    }
                    this.data.isAdding = false;
                });
        },
        async addModal(props, title, color) {
            UIkit.modal("#color-model").show();
            $("#header")
                .html(`<div class="win-all-model-header" style="${color}">
                  <h2 class="uk-modal-title" style="color:inherit">${title}</h2>
               </div>`);
            this.data.title = title;
            this.data.battingData.type = props;
        },
        async gameResult() {
            const userData = JSON.parse(localStorage.user);
            const userId = userData.user.id;
            const res = await this.callApi(
                "get",
                "api/game/result/" + this.gameId+"/"+userId
            );
            console.log('Game Result');
            console.log(res.data.data.result);
            if (res.status == 200) {
                console.log(res);
                this.results.gameId = res.data.data.game_id;
                this.results.colors = res.data.data.result.color_value;
                this.results.number = res.data.data.result.number_value;
                this.results.winningAmt = res.data.data.winning_amount;
                // this.results.gameResult = res.data.data.game_result;
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
            const response = await this.callApi("get", "api/game/play/three");
            if (response.status == 200) {
                this.gameId = response.data.data.id;
                this.games = response.data;
                if (response.data.game_status === false) {
                    window.location.reload();
                    this.gameOver = true;
                    this.disabled = true;
                    this.data.loading = true;
                } else {
                    this.data.loading = false;
                    var timer = response.data.data.timer;
                }
                var gameTimer = setInterval(() => {
                    timer = timer - 1;
                    let minutes = Math.floor(timer / 60);
                    let seconds = Math.floor(timer - minutes * 60);
                    $(".countdownthree").text(
                        minutes.toString().padStart(2, "0") +
                            ":" +
                            seconds.toString().padStart(2, "0")
                    );
                    if (minutes === 0 && seconds <= 10) {
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
        async fetchTenResults(page_url) {
            page_url = page_url || "api/game/full/three/result/";
            const response = await this.callApi("get", page_url);
            if (response.status == 200) {
                this.tenResults = response.data.data;
                this.pagination2(response.data);
            }
        },
        async user() {
            const res = await this.callApi("get", "api/user/details");
            if (res.status == 200) {
                store.commit("setUsers");
            }
        },
        async myParityRecord(page_url) {
            page_url = page_url || "api/user/my/record/";
            const userData = JSON.parse(localStorage.user);
            const token = userData.token;
            const config = {
                headers: { Authorization: `Bearer ${token}` },
            };
            return axios.get(page_url + 1, config).then(({ data }) => {
                if (data.status == true) {
                    this.myparity = data.data;
                    this.pagination = data.data;
                }
            });
        },
        realoadPage() {
            window.location.reload();
        },
    },
    async created() {
        const res = await this.callApi("get", "api/game/play/three");
        if (res.status == 200) {
            this.gameId = res.data.data.id;
            this.games = res.data;
            if (res.data.game_status === false) {
                // window.location.reload();
                this.gameOver = false; //it will be true when goes live
                this.disabled = false; //it will be true when goes live
                this.data.loading = false; //it will be true when goes live
            } else {
                this.data.loading = false;
                this.disabled = false;
                console.log(res.data.data);
                var timer = res.data.data.timer;
            }
            var gameTimer = setInterval(() => {
                timer = timer - 1;
                let minutes = Math.floor(timer / 60);
                let seconds = Math.floor(timer - minutes * 60);
                $(".countdownthree").text(
                    minutes.toString().padStart(2, "0") +
                        ":" +
                        seconds.toString().padStart(2, "0")
                );
                if (minutes === 0 && seconds <= 10) {
                    UIkit.modal("#color-model").hide();
                    this.disabled = true;
                    this.data.loading = true;
                    this.data.modal = false;
                }
                if (minutes === 0 && seconds === 0) {
                    this.gameResult();
                    clearInterval(gameTimer);
                    this.gameCall();
                }
            }, 1000);
            this.fetchTenResults();
            this.myParityRecord();
        } else {
            this.swr();
        }
    },
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
.no-outline {
    outline: none;
    border: none;
}
button[disabled="disabled"] {
    opacity: 0.3;
}
.wi-badge-result-violet {
    background-color: #9c28b1;
}
.wi-win-parity-bg {
    height: auto;
}
</style>
