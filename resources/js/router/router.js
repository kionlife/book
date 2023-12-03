
import { createRouter, createWebHistory } from 'vue-router';
import BookList from '../Components/Pages/Books/BookList.vue';
import BookDetail from '../Components/Pages/Books/BookDetail.vue';
import Home from '../Components/Pages/Home.vue';
import Login from '../Components/Pages/Auth/Login.vue';
import Register from '../Components/Pages/Auth/Register.vue';
import ProfileEdit from "../Components/Pages/Auth/Profile/Edit.vue";
import MyBooks from "../Components/Pages/Auth/Profile/MyBooks.vue";
import MyOffers from "../Components/Pages/Auth/Profile/MyOffers.vue";
import Chats from "../Components/Pages/Auth/Profile/Chats.vue";

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/books',
        name: 'BookList',
        component: BookList
    },
    {
        path: '/books/:id',
        name: 'BookDetail',
        component: BookDetail,
        props: true
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
        meta: {
            guest: true
        }
    },
    {
        path: '/register',
        name: 'Register',
        component: Register,
        meta: {
            guest: true
        }
    },
    {
        path: '/profile',
        name: 'Profile',
        component: ProfileEdit,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/my-books',
        name: 'MyBooks',
        component: MyBooks,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/my-offers',
        name: 'MyOffers',
        component: MyOffers,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/messages',
        name: 'Messages',
        component: Chats,
        meta: {
            requiresAuth: true
        }
    }

];

const index = createRouter({
    history: createWebHistory(),
    routes,
    linkActiveClass: "active"
});

index.beforeEach((to, from, next) => {
    const isLoggedIn = !!localStorage.getItem('access_token');

    if (to.meta.requiresAuth && !isLoggedIn) {
        next({ path: '/login' });
    } else if (to.meta.guest && isLoggedIn) {
        next({ path: '/login' });
    } else {
        next();
    }
});

export default index;
