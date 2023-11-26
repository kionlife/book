// store.js
import { createStore } from 'vuex';

const store = createStore({
    state: {
        access_token: localStorage.getItem('access_token') || null,
        user: JSON.parse(localStorage.getItem('user')) || null,
    },
    mutations: {
        setAccessToken(state, token) {
            state.access_token = token;
            localStorage.setItem('access_token', token);
        },
        setUser(state, user) {
            state.user = user;
            localStorage.setItem('user', JSON.stringify(user));
        },
        logout(state) {
            state.access_token = null;
            state.user = null;
            localStorage.removeItem('access_token');
            localStorage.removeItem('user');
        }
    },
});

export default store;
