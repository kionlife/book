<template>
    <div class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header justify-content-center">
                            <h3 class="font-weight-light my-4">Вхід</h3>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form mb-3">
                                    <input class="form-control mb-2" id="inputEmail" type="email" placeholder="Email" v-model="email" />

                                    <input class="form-control" id="inputPassword" type="password" placeholder="Пароль" v-model="password" />
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <router-link to="/register" class="small">Зареєструватися</router-link>
                                        <button type="button" class="btn btn-primary" @click="login">Вхід</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useToast } from "vue-toastification";
import { useStore } from 'vuex';
import authService from '../../../services/authService';

export default {
    data() {
        return {
            email: '',
            password: '',
            toast: useToast()
        };
    },

    setup() {
        const store = useStore();
        return { store };
    },
    methods: {
        async login() {
            try {
                const response = await authService.login(this.email, this.password);
                this.store.commit('setAccessToken', response.access_token);
                this.store.commit('setUser', response.user);
                this.$router.push('/');
            } catch (error) {
                this.toast.error('Неправильний логін або пароль!');
            }
        }
    }
}
</script>
