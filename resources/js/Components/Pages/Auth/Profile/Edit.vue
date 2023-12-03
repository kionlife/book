<template>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h2 class="pageTitle">Профіль користувача {{ user.name }}</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="py-12">
                    <div class="max-w-7xl mx-auto space-y-6">
                        <div class="p-4 row shadow rounded">
                            <div class="col-12 col-lg-4">
                                <div class="passwordBlock">
                                    <label for="current_password" class="block text-sm font-medium text-gray-700">
                                        Поточний пароль
                                    </label>

                                    <div class="mt-1">
                                        <input
                                            id="current_password"
                                            type="password"
                                            class="form-control w-100"
                                            v-model="user.current_password"
                                            autocomplete="current-password"
                                        />
                                    </div>

                                </div>

                                <!-- New Password -->
                                <div class="mt-6 passwordBlock">
                                    <label for="password" class="block text-sm font-medium text-gray-700">
                                        Новий пароль
                                    </label>

                                    <div class="mt-1">
                                        <input
                                            id="password"
                                            type="password"
                                            class="form-control"
                                            v-model="user.password"
                                            autocomplete="new-password"
                                        />
                                    </div>

                                </div>

                                <!-- Confirm New Password -->
                                <div class="mt-6 passwordBlock">
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                        Підтвердити новий пароль
                                    </label>

                                    <div class="mt-1">
                                        <input
                                            id="password_confirmation"
                                            type="password"
                                            class="form-control"
                                            v-model="user.password_confirmation"
                                            autocomplete="new-password"
                                        />
                                    </div>

                                </div>
                            </div>
                            <UpdateProfileInformationForm
                                class="max-w-xl"
                                :user="user"
                                @avatarChanged="handleAvatarChange"
                            />

                        </div>
                        <div class="row">
                        <div class="col-12 col-md-4">
                            <button type="button" class="btn btn-primary mt-4" @click="save">
                                <span>Зберегти</span>
                            </button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {useStore} from 'vuex';
import authService from '../../../../services/authService';
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import {useToast} from "vue-toastification";

export default {
    components: {UpdateProfileInformationForm},
    data() {
        return {
            user: [
                {
                    name: '',
                    email: '',
                }
            ],
            avatarFile: null,
            toast: useToast()
        }
    },
    setup() {
        const store = useStore();
        return {store};
    },
    methods: {
        getUser() {
            authService.getUser()
                .then(response => {
                    this.user = response;
                })
                .catch(error => {
                    console.error('There was an error fetching the user:', error);
                });
        },
        handleAvatarChange(file) {
            this.avatarFile = file;
        },
        save() {
            let formData = {
                bio: this.user.bio,
            }

            console.log(this.user);
            if (this.avatarFile) {
                formData.avatar = this.avatarFile;
            }

            if (this.user.current_password) {
                formData.current_password = this.user.current_password;
                formData.password = this.user.password;
                formData.password_confirmation = this.user.password_confirmation;
            }

            axios.post('/api/user/update', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    this.user = response.data;
                    this.toast.success('Профіль успішно оновлено!');
                })
                .catch(error => {
                    this.toast.error('There was an error updating the profile:', error);
                });
        }

    },
    created() {
        this.getUser();
    }
};
</script>
