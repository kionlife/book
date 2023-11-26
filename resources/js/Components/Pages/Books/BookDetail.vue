<template>
    <div class="container mx">
        <div class="row">
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
                            Рік: {{ book.year }}</p>
                        <p class="description">{{ book.description }}</p>


                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="exchange-offers">
                    <h3>Примірники</h3>
                    <ul>
                        <li v-for="instance in book.instance">
                            <button class="btn btn-outline-primary btn-sm" @click="makeExchangeOffer">Запропонувати обмін</button> <span>{{ instance.current.name }}</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <div v-if="createOffer" class="row">
            <div class="col-12 col-md-6 border">
                <h3>Оберіть книгу для обміну</h3>
                <div v-for="item in myBooks">
                    <input type="radio" :id="item.id" :value="item.id" v-model="selectedBook">
                    <label :for="item.id">{{ item.book.title }}</label>
                </div>
                <button class="btn btn-primary" @click="createExchangeOffer">Підтвердити</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        id: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            book: [],
            myBooks: [],
            selectedBook: null,
            loaded: false,
            createOffer: false,
        };
    },
    created() {
        this.fetchBookDetails();
    },
    methods: {
        fetchBookDetails() {
            axios.get(`/api/books/${this.id}`)
                .then(response => {
                    this.book = response.data;
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
        makeExchangeOffer() {
            this.fetchMyBooks();
            this.createOffer = true;
        },
        createExchangeOffer() {
            axios.post('/api/exchange-offers', {
                book_instance_id: this.selectedBook,
                book_id: this.id,
            })
                .then(response => {
                    console.log(response);
                    this.createOffer = false;
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
