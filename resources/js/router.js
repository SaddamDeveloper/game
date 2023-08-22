import Vue from 'vue';
import Router from 'vue-router';
import Index from './components/pages/Index';
import Login from './components/pages/Login';
import Game from './components/pages/Game';
import Win from './components/pages/Win';
import Mine from './components/pages/Mine';
import Transaction from './components/pages/Transaction';
import Quater from './components/pages/Quater';
import Register from './components/pages/Register';
// import Forget from './components/pages/forget_pass';
import Recharge from './components/pages/Recharge';
// import Withdrawal from './components/pages/Withdrawal';
import BankCard from './components/pages/BankCard';
import Address from './components/pages/Address';
import Withdrawal from './components/pages/Withdrawal';
import WithdrawalRequest from './components/pages/WithdrawalRequest';
import Privacy from './components/pages/Privacy';
import About from './components/pages/About';
import Complaint from './components/pages/Complaint';
import AddComplaint from './components/pages/AddComplaint';
import ChangePassword from './components/pages/ChangePassword';
import Promotions from './components/pages/Promotions';
// import Index from './components/pages/Index';
// import ProductDetails from './components/pages/ProductDetails';
// import productSearch from './components/pages/productSearch';

Vue.use(Router);

const routes = [
    {
        path: '/',
        component: Game,
        name: 'game',
        children: [
            {
                path: '/',
                component: Win
            },
            {
                path: '/quater',
                component: Quater
            }
        ],
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/login',
        component: Login,
        name: 'login',
        meta: { requiresVisitor : true }
    },
    {
        path: '/register',
        component: Register,
        name: 'register',
        meta: { requiresVisitor : true }
    },
    {
        path: '/mine',
        component: Mine,
        name: 'mine',
        meta: {
            requiresAuth: true
        },
    },
    {
        path: '/transaction',
        component: Transaction,
        name: 'transaction',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/win',
        component: Win,
        name: 'win',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/quater',
        component: Quater,
        name: 'quater',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/bankcard',
        component: BankCard,
        name: 'bankcard',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/address',
        component: Address,
        name: 'address',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/privacy',
        component: Privacy,
        name: 'privacy',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/about',
        component: About,
        name: 'about',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/recharge',
        component: Recharge,
        name: 'recharge',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/withdrawal',
        component: Withdrawal,
        name: 'withdrawal',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/request',
        component: WithdrawalRequest,
        name: 'request',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/promotions',
        component: Promotions,
        name: 'promotions',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/changepassword',
        component: ChangePassword,
        name: 'changepassword',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/complaint',
        component: Complaint,
        name: 'complaint',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/addcomplaint',
        component: AddComplaint,
        name: 'addcomplaint',
        meta: {
            requiresAuth: true,
        }
    },
]

export default new Router({
    mode: 'history',
    routes
})