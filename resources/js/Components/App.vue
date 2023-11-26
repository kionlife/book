<template>
    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow mb-4">
            <!-- Container wrapper -->
            <div class="container-fluid">

                <!-- Navbar brand -->
                <a class="navbar-brand" href="#">Brand</a>

                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <router-link to="/" class="nav-item nav-link">Головна</router-link>
                        <router-link to="/books" class="nav-item nav-link">Книги</router-link>
                    </ul>

                    <!-- Profile -->
                    <div class="w-auto">
                        <ul class="navbar-nav d-flex flex-row" v-if="isLoggedIn">
                            <li>
                                <router-link class="nav-item nav-link" to="/profile">Мій профіль</router-link>
                            </li>
                            <li>
                                <router-link class="nav-item nav-link" to="/my-books">Мої книги</router-link>
                            </li>
                            <li>
                                <router-link class="nav-item nav-link" to="/my-offers">Мої пропозиції</router-link>
                            </li>
                            <li>
                                <a class="nav-item nav-link" href="#" @click="logout">Вихід</a>
                            </li>
                        </ul>

                        <ul v-else class="navbar-nav d-flex flex-row">
                            <li>
                                <router-link to="/login" class="nav-item nav-link">Вхід</router-link>
                            </li>
                            <li>
                                <router-link to="/register" class="nav-item nav-link">Реєстрація</router-link>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </nav>
    </header>

    <router-view></router-view>

    <footer>
        &copy; 2023

    </footer>
</template>

<script>
import { useRoute } from 'vue-router';
import {mapState} from "vuex";

export default {
    name: "App",

    data() {
        return {
            books: [],
        };
    },
    computed: {
        ...mapState(['access_token', 'user']),
        isLoggedIn() {
            return !!this.access_token;
        }
    },
    methods: {
        logout() {
            this.$store.commit('logout');
            // Redirect to home page or login page after logout
            this.$router.push({ name: 'home' });
        }
    }
};
</script>
