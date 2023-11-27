<template>
    <div class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header justify-content-center">
                            <h3 class="font-weight-light my-4">Реєстрація</h3>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="register">
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Ім'я" v-model="name" required>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="email" class="form-control" placeholder="Email" v-model="email" required>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" class="form-control" placeholder="Пароль" v-model="password" required>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" class="form-control" placeholder="Підтвердження паролю" v-model="password_confirmation" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Реєстрація</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { useToast } from "vue-toastification";
import { useStore } from 'vuex';

export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            toast: useToast()
        };
    },
    methods: {
        async register() {
            try {
                const response = await axios.post('/api/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                });
                this.toast.success('Реєстрація успішна!');
                this.$router.push('/login');
            } catch (error) {
                this.toast.error('Registration failed: ' + error.response.data.message);
            }
        }
    }
}
</script>
