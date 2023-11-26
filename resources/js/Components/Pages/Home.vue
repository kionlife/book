<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Book Exchange banner</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-6">
                <h2>Книги</h2>
            </div>
            <div class="col-6">
                <router-link to="/books" class="btn btn-primary">Перейти до списку книг</router-link>
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

</style>
