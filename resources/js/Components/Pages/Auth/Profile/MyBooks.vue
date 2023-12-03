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

        <div class="container mb-4" v-if="addBook">
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
                        <input type="text" class="form-control" id="title" placeholder="Назва" v-model="addBookForm.title">

                    </div>
                    <div class="form-group">
                        <label for="author">Автор</label>
                        <input type="text" class="form-control" id="author" placeholder="Автор" @keyup="getAuthors($event.target.value)" v-model="bookInfo.author.name">
                        <ul v-if="authors.length > 0" class="list-unstyled">
                            <li class="mt-2" v-for="author in authors" :key="author.id">
                                <button
                                    @click="addBookForm.author_id = author.id; authors = []; bookInfo.author.name = author.name"
                                    type="button" class="btn btn-primary btn-sm">Обрати</button> {{ author.name }}
                            </li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="year">Рік</label>
                        <input type="text" class="form-control" id="year" placeholder="Рік">
                    </div>
                    <div class="form-group">
                        <label for="genre">Жанр</label>
                        <input type="text" class="form-control" id="genre" placeholder="Жанр" v-model="bookInfo.genre.name" @click="getGenres">
                        <ul v-if="genres.length > 0" class="list-unstyled">
                            <li class="mt-2" v-for="genre in genres" :key="genre.id">
                                <button
                                    @click="addBookForm.genre_id = genre.id; genres = []; bookInfo.genre.name = genre.name"
                                    type="button" class="btn btn-primary btn-sm">Обрати</button> {{ genre.name }}
                            </li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="category">Категорія</label>
                        <input type="text" class="form-control" id="category" placeholder="Категорія" v-model="bookInfo.category.name" @click="getCategories">
                        <ul v-if="categories.length > 0" class="list-unstyled">
                            <li class="mt-2" v-for="category in categories" :key="category.id">
                                <button
                                    @click="addBookForm.category_id = category.id; categories = []; bookInfo.category.name = category.name"
                                    type="button" class="btn btn-primary btn-sm">Обрати</button> {{ category.name }}
                            </li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input type="text" class="form-control" id="isbn" placeholder="ISBN" v-model="addBookForm.isbn">
                    </div>

                    <div class="form-group">
                        <label for="pages">Кількість сторінок</label>
                        <input type="text" class="form-control" id="pages" placeholder="Кількість сторінок" v-model="addBookForm.pages">
                    </div>

                    <div class="form-group">
                        <label for="image">Зображення</label>
                        <input type="file" class="form-control" id="image" @change="onImageChange">
                    </div>

                    <div class="form-group">
                        <label for="publisher">Видавництво</label>
                        <input type="text" class="form-control" id="publisher" placeholder="Видавництво" v-model="addBookForm.publisher">
                    </div>

                    <div class="form-group">
                        <label for="language">Мова</label>
                        <input type="text" class="form-control" id="language" placeholder="Мова" v-model="addBookForm.language">
                    </div>

                    <div class="form-group">
                        <label for="description">Опис</label>
                        <textarea class="form-control" id="description" rows="3" v-model="addBookForm.description"></textarea>
                    </div>

                    <button type="button" class="btn btn-primary" @click="createBook">Додати</button>
                </div>
            </div>
        </div>

        <div class="container bg-white mb-4 p-4 shadow rounded" v-if="addBookInstance">
            <div class="row">
                <div class="col-12">
                    <h4>Додати примірник</h4>
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

        <BookList
            v-for="book in books"
            :key="book.id"
            :book="book"/>
    </div>



</template>

<script>
import BookList from "../../../Blocks/BookList";
import {useToast} from "vue-toastification";

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
                author_id: '',
                year: '',
                genre_id: '',
                category_id: '',
                description: '',
            }],
            addBookInstance: false,
            addBookInstanceForm: {
                searchTerm: '',
            },
            searchAuthor: '',
            genres: [],
            categories: [],
            authors: [],
            bookInfo: {
                author: {
                    name: ''
                },
                genre: {
                    name: ''
                },
                category: {
                    name: ''
                }
            },
            toast: useToast()
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
        getGenres() {
            axios.get('/api/genres')
                .then(response => {
                    this.genres = response.data;
                })
                .catch(error => {
                    console.error('There was an error fetching the genres:', error);
                });
        },
        getCategories() {
            axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data;
                })
                .catch(error => {
                    console.error('There was an error fetching the categories:', error);
                });
        },
        getAuthors(term) {
            axios.get('/api/authors', {
                params: {
                    name: term
                }
            }).then(response => {
                    this.authors = response.data;
                })
                .catch(error => {
                    console.error('There was an error fetching the authors:', error);
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
        onImageChange(event) {
            const file = event.target.files[0];
            console.log(file);
            if (file) {
                this.addBookForm.image = file;
            }
        },
        createBook() {
            axios.post('/api/books', {
                title: this.addBookForm.title,
                author_id: this.addBookForm.author_id,
                year: this.addBookForm.year,
                genre_id: this.addBookForm.genre_id,
                category_id: this.addBookForm.category_id,
                description: this.addBookForm.description,
                isbn: this.addBookForm.isbn,
                pages: this.addBookForm.pages,
                image: this.addBookForm.image,
                publisher: this.addBookForm.publisher,
                language: this.addBookForm.language,
            },{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                this.addBook = false;
                this.toast.success('Книгу додано!');
                this.fetchBooks();
            }).catch(error => {

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
