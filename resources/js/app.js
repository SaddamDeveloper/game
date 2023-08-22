require('./bootstrap');

window.Vue = require('vue');
import router from './router'
import common from './common'
import store from './store'
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
Vue.use(ViewUI);
Vue.mixin(common);
Vue.component('mainapp', require('./components/Main.vue').default);
function loggedIn(){
  return localStorage.getItem('user');
}
function isLoggedIn(){
  return localStorage.getItem('user');
}
router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!isLoggedIn()) {
      next({
        name: 'login',
      })
    } else {
      next()
    }
  } else if (to.matched.some(record => record.meta.requiresVisitor)) {
    if (isLoggedIn()) {
      next({
        name: 'mine',
      })
    } else {
      next()
    }
  } else {
    next() // make sure to always call next()!
  }
})
const app = new Vue({
    el: '#app',
    router,
    created() {
      const userInfo = localStorage.getItem('user')
      if (userInfo) {
        const userData = JSON.parse(userInfo)
        this.$store.commit('setUserData', userData)
      }
      axios.interceptors.response.use(
        response => response,
        error => {
          if (error.response.status === 401) {
            this.$store.dispatch('logout')
          }
          return Promise.reject(error)
        }
      )
    },
});
