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
                            <UpdatePasswordForm
                                class="max-w-xl"
                                :user="user"
                            />
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
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import {useStore} from 'vuex';
import authService from '../../../../services/authService';
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";

export default {
    components: {UpdateProfileInformationForm, UpdatePasswordForm},
    data() {
        return {
            user: [
                {
                    name: '',
                    email: '',
                }
            ],
            avatarFile: null,
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
            let formData = new FormData();
            Object.keys(this.user).forEach(key => {
                formData.append(key, this.user[key]);
            });

            if (this.avatarFile) {
                formData.append('avatar', this.avatarFile);
            }

            Object.keys(this.user).forEach(key => {
                if (!(key === 'password' || key === 'current_password') || this.user[key]) {
                    formData.append(key, this.user[key]);
                }
            });

            axios.post('/api/user/update', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    this.user = response.data;
                    console.log('User data updated successfully');
                })
                .catch(error => {
                    console.error('There was an error updating the user data:', error);
                });
        }

    },
    created() {
        this.getUser();
    }
};
</script>
