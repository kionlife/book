<template>
    <div class="banner">
        <div class="bgDark"></div>
        <div class="container h-100 z-2 position-relative">
            <div class="bg-dark-gray h-100 color-white d-flex flex-column justify-content-center align-items-center">
                <h1 class="text-center">Ласкаво просимо до BookSharing</h1>
                <p class="lead text-center mt-4">
                    BookSharing – книжкове джерело, що об'єднує книголюбів! Це простір для обміну літературними шедеврами, досвідом та думками. З нами кожен читач має можливість відкривати нові горизонти та ділитися своїм літературними враженнями та читацьким досвідом.
                </p>
<!--                <p class="text-center mt-1">
                    Ми віримо, що кожна книга має свою історію, але часом найцікавіші історії виникають, коли книга міняє свого читача.
                </p>-->
                <router-link to="/books" class="btn btn-outline-light">Перейти до списку книг</router-link>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-12 text-center mx-4 my-4">
                <h2 class="pageTitle">Останні книги</h2>
            </div>
        </div>
        <div class="row">
            <Book
                v-for="book in books"
                :key="book.id"
                :book="book" />
        </div>
    </div>
</template>

<script>
import Book from "../Blocks/Book.vue";

export default {
    name: "Home",
    components: {Book},
    data() {
        return {
            books: [],
        };
    },
    created() {
        this.fetchBooks();
    },
    methods: {
        fetchBooks() {
            axios.get('/api/books/last')
                .then(response => {
                    this.books = response.data;
                })
                .catch(error => {
                    console.error('There was an error fetching the books:', error);
                });
        },
    }
};
</script>

<style>
    .banner {
        background: url('/images/banner.jpg') no-repeat center center;
        background-size: cover;
        height: 700px;
        position: relative;
    }

    .bgDark {
        background: rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .color-white {
        color: white;
    }
</style>
