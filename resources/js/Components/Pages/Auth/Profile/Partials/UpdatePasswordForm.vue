<template>
    <form class="col-12 col-lg-4">
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
    </form>



</template>

<script>
import { defineComponent } from 'vue';

export default {
    data() {
        return {
            user: {
                current_password: '',
                password: '',
                password_confirmation: ''
            },
        };
    },
}

</script>

<style scoped>
    .justify-content-space-between {
        justify-content: space-between;
    }

    .passwordBlock {
        width: 100%;
    }
</style>
