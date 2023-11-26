<template>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h2 class="pageTitle">Мої книги</h2>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12">
                <button @click="openAddBookInstanceForm" class="btn btn-outline-primary">Додати примірник</button>
                <button @click="openAddBookForm" class="btn btn-outline-primary mx-2">Додати книгу в каталог</button>
            </div>
        </div>
        <BookList
            v-for="book in books"
            :key="book.id"
            :book="book"/>
    </div>

    <div class="container" v-if="addBook">
        <div class="row">
            <div class="col-12">
                <h2>Додати книгу в каталог</h2>
            </div>
        </div>
        <div class="row">
            <!-- Add book form -->
            <div class="col-12">
                <div class="form-group">
                    <label for="title">Назва</label>
                    <input type="text" class="form-control" id="title" placeholder="Назва">
                </div>
                <div class="form-group">
                    <label for="author">Автор</label>
                    <input type="text" class="form-control" id="author" placeholder="Автор">
                </div>
                <div class="form-group">
                    <label for="year">Рік</label>
                    <input type="text" class="form-control" id="year" placeholder="Рік">
                </div>
                <div class="form-group">
                    <label for="genre">Жанр</label>
                    <input type="text" class="form-control" id="genre" placeholder="Жанр">
                </div>
                <div class="form-group">
                    <label for="category">Категорія</label>
                    <input type="text" class="form-control" id="category" placeholder="Категорія">
                </div>
                <div class="form-group">
                    <label for="description">Опис</label>
                    <textarea class="form-control" id="description" rows="3"></textarea>
                </div>

                <button type="button" class="btn btn-primary">Додати</button>
            </div>
        </div>
    </div>

    <div class="container" v-if="addBookInstance">
        <div class="row">
            <div class="col-12">
                <h3>Додати примірник</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="title">Назва</label>
                    <input type="text" class="form-control" id="title" placeholder="Назва"
                           v-model="addBookInstanceForm.searchTerm">
                </div>
                <div class="form-group">
                    <ul>
                        <li class="mt-2" v-for="book in foundedBooks" :key="book.id">
                            <button @click="createBookInstance(book.id)" type="button" class="btn btn-primary btn-sm">Обрати</button> {{ book.title }} - {{ book.author.name }} - {{ book.year }} - {{ book.isbn }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import BookList from "../../../Blocks/BookList";

export default {
    name: "MyBooks",
    components: {BookList},
    data() {
        return {
            books: {
                data: [],
                current_page: null,
                last_page: null,
                next_page_url: null,
                prev_page_url: null
            },
            foundedBooks: [],
            addBook: false,
            addBookForm: [{
                title: '',
            }],
            addBookInstance: false,
            addBookInstanceForm: {
                searchTerm: '',
            }
        };
    },
    created() {
        this.fetchBooks();
    },
    methods: {
        fetchBooks() {
            axios.get('/api/books/my')
                .then(response => {
                    this.books = response.data;
                    console.log(this.books);
                })
                .catch(error => {
                    console.error('There was an error fetching the books:', error);
                });
        },
        openAddBookForm() {
            this.addBook = !this.addBook;
        },
        openAddBookInstanceForm() {
            this.addBookInstance = !this.addBookInstance;
        },
        searchBook(term) {
            axios.get('/api/books/search', {
                params: {
                    term: term
                }
            }).then(response => {
                this.foundedBooks = response.data;
            })
                .catch(error => {
                    console.error('There was an error fetching the books:', error);
                });
        },
        createBookInstance(bookId) {
            axios.post('/api/books/instance', {
                book_id: bookId
            }).then(response => {
                this.addBookInstance = false;
                this.fetchBooks();
            })
                .catch(error => {
                    console.error('There was an error fetching the books:', error);
                });

        },
    },
    watch: {
        'addBookInstanceForm.searchTerm': function(newVal, oldVal) {
            this.searchBook(newVal);
        }
    }


};
</script>
