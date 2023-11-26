<template>
    <div class="banner">
        <div class="container h-100">
            <div class="bg-dark-gray h-100 color-white d-flex flex-column justify-content-center align-items-center">
                <h1>Обмін книгамиі</h1>
                <h4>Відкрийте для себе нові книги</h4>
                <router-link to="/books" class="btn btn-primary">Перейти до списку книг</router-link>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center mx-4 my-4">
                <h2>Останні книги</h2>
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
        height: 600px;
    }

    .color-white {
        color: white;
    }
</style>
