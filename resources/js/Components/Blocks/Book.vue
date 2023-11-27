<template>
    <div class="col-md-3 mb-3 d-flex align-items-stretch">
        <div class="card shadow">
            <router-link :to="{ name: 'BookDetail', params: { id: book.id } }">
                <img :src="book.image" class="card-img-top" :alt="book.title">
            </router-link>

            <div class="card-body">
                <h5 class="card-title">{{ book.title }}</h5>
                <p class="card-text"><i>{{ book.author.name }}</i></p>
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

<style scoped>
.card {
    display: flex;
    flex-direction: column;
}
.card-img-top {
    height: 450px; /* Adjust and add object-fit for images */
    object-fit: cover;
}
.card-body {
    flex-grow: 1;
}
</style>
