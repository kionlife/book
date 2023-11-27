<template>
    <div class="container mt-4">
        <div class="row shadow rounded p-4">
            <div class="col-12">

                <div v-if="loaded" class="book-detail">
                    <div class="book-image">
                        <img :src="book.image" alt="Book Image">
                    </div>

                    <div class="book-info">
                        <h1>{{ book.title }}</h1>
                        <p class="category-genre">{{ book.category.name }} / {{ book.genre.name }}</p>
                        <p class="author">
                            Автор: {{ book.author.name }} <br>
                            Рік: {{ book.year }} <br>
                            ISBN: {{ book.isbn }} <br>
                            Мова: {{ book.language }} <br>
                            Видавництво: {{ book.publisher }} <br>
                            Сторінок: {{ book.pages }}
                        </p>
                        <p class="description">{{ book.description }}</p>


                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h2 class="pageTitle">Примірники</h2>

            </div>
        </div>
        <div class="row shadow rounded p-4">
            <div class="col-12">
                <div class="exchange-offers">
                    <ul v-if="book.instance && book.instance.length">
                        <li v-for="instance in book.instance">
                            <button class="btn btn-outline-primary btn-sm" @click="makeExchangeOffer(instance.id)">Запропонувати обмін</button> <span>{{ instance.current.name }} (ID: {{ instance.id }})</span>
                        </li>
                    </ul>
                    <p v-else>
                        Примірників не знайдено
                    </p>
                </div>

            </div>
        </div>
        <div v-if="createOffer" class="row">
            <div class="col-12 col-md-12 border bg-white">
                <p>Оберіть книгу для обміну</p>
                <div v-for="item in myBooks">
                    <input type="radio" :id="item.id" :value="item.id" v-model="selectedBook">
                    <label :for="item.id">{{ item.book.title }}</label>
                </div>
                <button class="btn btn-primary my-2" @click="createExchangeOffer">Підтвердити</button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="pageTitle">Інші книги цього жанру</h2>
            </div>
        </div>
        <div class="row">
            <Book
                v-for="item in genreBooks"
                :key="item.id"
                :book="item" />
        </div>
    </div>
</template>

<script>
import Book from "../../Blocks/Book.vue";
import { useToast } from "vue-toastification";


export default {
    components: {Book},
    props: {
        id: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            book: [],
            genreBooks: [],
            myBooks: [],
            selectedBook: null,
            selectedInstanceToReceive: null,
            loaded: false,
            createOffer: false,
            toast: useToast(),
        };
    },
    created() {
        this.fetchBookDetails();
    },

    watch: {
        '$route.params.id': {
            immediate: true,
            handler(newId) {
                window.scrollTo(0, 0);
                this.fetchBookDetails();
            }
        }
    },
    methods: {
        fetchBookDetails() {
            axios.get(`/api/books/${this.id}`)
                .then(response => {
                    this.book = response.data;
                    this.fetchGenreBooks();
                    this.loaded = true;

                })
                .catch(error => {
                    console.error('Error fetching book details:', error);
                });
        },
        fetchMyBooks() {
            axios.get('/api/books/my')
                .then(response => {
                    this.myBooks = response.data;
                })
                .catch(error => {
                    console.error('Error fetching my books:', error);
                });
        },
        fetchGenreBooks() {
            axios.get(`/api/books/genre/${this.book.genre_id}`)
                .then(response => {
                    this.genreBooks = response.data;
                })
                .catch(error => {
                    console.error('Error fetching genre books:', error);
                });
        },
        makeExchangeOffer(selectedInstanceToReceive) {
            this.fetchMyBooks();
            this.selectedInstanceToReceive = selectedInstanceToReceive;
            this.createOffer = true;
        },
        createExchangeOffer() {
            axios.post('/api/exchange-offers', {
                give_book_instance_id: this.selectedBook,
                take_book_instance_id: this.selectedInstanceToReceive,
            })
                .then(response => {
                    this.createOffer = false;
                    this.toast.success('Пропозиція обміну надіслана');
                })
                .catch(error => {
                    console.error('Error creating exchange offer:', error);
                });
        },
    },
};
</script>

<style scoped>
.book-detail {
    display: flex;
}

.book-image img {
    max-width: 200px;
}

.book-info {
    margin-left: 20px;
}

.category-genre {
    color: #666;
    font-style: italic;
    /* Add more styling */
}

.description {
    margin-top: 10px;
    /* Add more styling */
}

.exchange-offers {
    margin-top: 20px;
    /* Add more styling */
}

/* Add more styling as needed */
</style>
