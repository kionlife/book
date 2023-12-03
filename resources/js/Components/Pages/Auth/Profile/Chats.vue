<template>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <ul class="list-unstyled">
                    <li class="p-2 mb-2" v-for="user in users" :key="user.id">
                        <button class="btn btn-outline-primary w-100 text-center" @click="openChat(user.id)">{{ user.name }}</button>
                    </li>
                </ul>
            </div>
            <div class="col-md-8" v-if="toUserId">
                <ul class="list-unstyled" style="height: 500px; overflow-y: scroll;">
                    <li v-for="message in messages" :key="message.id">
                        <b>{{ message.user.name }}</b> {{ message.message }}
                    </li>
                </ul>
                <div class="d-flex justify-content-center">
                <input type="text" v-model="newMessage" @keyup.enter="sendMessage" class="form-control">
                <button
                    class="btn btn-primary" @click="sendMessage">Надіслати</button>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
import authService from "@/services/authService";

export default {
    data() {
        return {
            user: null,
            messages: [],
            newMessage: '',
            toUserId: null,
            users: []
        }
    },
    methods: {
        fetchMessages(toUserId) {
            axios.get('/api/messages', {
                params: {
                    userId: this.user.id,
                    toUserId: toUserId
                }
            }).then(response => {
                this.messages = response.data;
            });
        },
        sendMessage() {
            axios.post('/api/messages', {
                message: this.newMessage,
                toUserId: this.toUserId
            }).then(response => {
                console.log(response);
                this.messages.push(response.data.message);
                this.newMessage = '';
            });
        },
        getUsers() {
            axios.get('/api/messages/users').then(response => {
                this.users = response.data;
            });
        },
        openChat(toUserId) {
            this.fetchMessages(toUserId);
            this.toUserId = toUserId;
        }
    },
    async created() {
        this.user = await authService.getUser();
        this.getUsers();
        Echo.private('private-chat.' + this.user.id)
        .listen('MessageSent', (e) => {
            this.messages.push(e.message);
        });
    }
}
</script>

<style scoped>
    button {
        margin-left: 10px;
    }
</style>
