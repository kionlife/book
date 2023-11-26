<template>
    <div class="col-md-4 mb-3">
        <div class="card">
            <img :src="book.image" class="card-img-top" :alt="book.title">
            <div class="card-body">
                <h5 class="card-title">{{ book.title }}</h5>
                <p class="card-text">{{ book.category.name }}</p>
                <p class="card-text">{{ book.genre.name }}</p>
                <router-link :to="{ name: 'BookDetail', params: { id: book.id } }" class="btn btn-primary">Детальніше</router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Book",
    props: {
        book: {
            type: Object,
            required: true
        }
    }
};
</script>
