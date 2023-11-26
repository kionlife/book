<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Профіль користувача {{ user.name }}
                    ({{ user.id }})</h2>

                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <UpdatePasswordForm class="max-w-xl"/>
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

export default {
    components: {UpdatePasswordForm},
    data() {
        return {
            user: [
                {
                    name: '',
                    email: '',
                }
            ]
        }
    },
    setup() {
        const store = useStore();
        return {store};
    },
    methods: {
        setUser() {
            if (this.store.state.user) {
                this.user = this.store.state.user;
            } else {
                authService.getUser()
                    .then(response => {
                        this.user = response.data;
                    })
                    .catch(error => {
                        console.error('There was an error fetching the user:', error);
                    });
            }
        }
    },
    created() {
        this.setUser();
    }
};
</script>
