<template>
    <!-- Update Password Form -->
    <form>
        <!-- Current Password -->
        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                Current Password
            </label>

            <div class="mt-1">
                <input
                    id="current_password"
                    type="password"
                    class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    v-model="form.current_password"
                    autocomplete="current-password"
                />
            </div>

        </div>

        <!-- New Password -->
        <div class="mt-6">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                New Password
            </label>

            <div class="mt-1">
                <input
                    id="password"
                    type="password"
                    class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    v-model="form.password"
                    autocomplete="new-password"
                />
            </div>

        </div>

        <!-- Confirm New Password -->
        <div class="mt-6">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                Confirm New Password
            </label>

            <div class="mt-1">
                <input
                    id="password_confirmation"
                    type="password"
                    class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    v-model="form.password_confirmation"
                    autocomplete="new-password"
                />
            </div>

        </div>

        <div class="flex justify-end mt-6">
            <button
                type="submit"
                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800"
                :disabled="form.processing"
            >
                <span v-if="form.processing">
                    <Spinner class="w-4 h-4 mr-2" />
                    Updating
                </span>

                <span v-else>
                    Update
                </span>
            </button>
        </div>
    </form>
</template>

<script>
import { defineComponent } from 'vue';

export default {
    data() {
        return {
            form: {
                current_password: '',
                password: '',
                password_confirmation: '',
            },
        };
    },
}

</script>
