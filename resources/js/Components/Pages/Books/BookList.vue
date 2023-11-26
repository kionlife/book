<template>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h2 class="pageTitle">Книги</h2>
            </div>
        </div>
        <div class="row">
            <Book
                v-for="book in books.data"
                :key="book.id"
                :book="book" />
        </div>
        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item" v-if="books.prev_page_url">
                    <a class="page-link" href="#" aria-label="Previous" @click="fetchBooks(books.current_page - 1)">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item" v-for="page in books.last_page" :key="page" :class="{'active': page === books.current_page}">
                    <a class="page-link" href="#" @click="fetchBooks(page)">{{ page }}</a>
                </li>
                <li class="page-item" v-if="books.next_page_url">
                    <a class="page-link" href="#" aria-label="Next" @click="fetchBooks(books.current_page + 1)">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
import Book from "../../Blocks/Book.vue";

export default {
    name: "BookList",
    components: {Book},
    data() {
        return {
            books: {
                data: [],
                current_page: null,
                last_page: null,
                next_page_url: null,
                prev_page_url: null
            },
        };
    },
    created() {
        this.fetchBooks(1);
    },
    methods: {
        fetchBooks(page) {
            axios.get(`/api/books?page=${page}`)
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
