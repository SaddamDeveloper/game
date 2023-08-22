import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
export default new Vuex.Store({
    state : {
        user: null,
        users: [],
        nickname: '',
        walletBal: 0,
        gameplay : []
    }, 
    getters: {
        getName: state => {
            return state.user ? state.user.name : '' ;
        }, 
        getEmail: state => {
            return state.user ? state.user.email : 'mail@mail.com' ;
        }, 
        getId: state => {
            return state.users ? state.users.id : '';
        },
        isLogged: state => !!state.user,
    },
    actions: {
        login ({ commit }, credentials) {
            return axios.post('api/user/login', credentials)
              .then(({ data }) => {
                  if(data.status == true){
                    commit('setUserData', data)
                  }else{
                    if(data.status = 422){
                        alert(data.msg)
                    }else{
                        this.swr();
                    }
                  }
              })
        }, 
        logout ({ commit }) {
        const userData = JSON.parse(localStorage.user);
        const token = userData.token;
        const config = {
            headers: { Authorization: `Bearer ${token}` }
        };
        return axios.get('api/user/logout', config)
        .then(({data}) => {
            if(data.status == true){
                commit('clearUserData')
            }else{
                if(data.status == 422){
                    alert(data.msg);
                }else{
                    this.swr();
                }
            }
        });
        },     
        fetchUser (store) {
            const userData = JSON.parse(localStorage.user);
            const token = userData.token;
            const config = {
                headers: { Authorization: `Bearer ${token}` }
            };
            return fetch('api/user/details', config)
            .then(data => data.json())
            .then((data)=>{
                store.commit('setUsers', data.users)
            })
        },
        setNName(store){
            const userData = JSON.parse(localStorage.user);
            const token = userData.token;
            const config = {
                headers: { Authorization: `Bearer ${token}` }
            };
            return axios.post('api/user/nickname', {nickname: store.state.users.nick_name}, config)
              .then(function (response) {
                if(response.data == 1){
                    store.commit('setNickName', store.state.users.nick_name)
                }
            })
        },
    },
    mutations: {
        setUserData (state, userData) {
            state.user = userData
            localStorage.setItem('user', JSON.stringify(userData))
            axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`
        },
        updateUser(state, data){
            state.user = data;
        },
        setUsers(state, users) {
            state.users = users;
        },
        setNickName(state, data){
            state.users.nick_name = data;
        },
        clearUserData () {
            localStorage.removeItem('user')
        }
    }
});
