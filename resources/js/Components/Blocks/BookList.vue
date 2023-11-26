<template>
    <div class="row mb-4">
        <div class="col-12 col-md-2">
            <img :src="book.book.image" class="card-img-top w-100" :alt="book.book.title">
        </div>

        <div class="col-12 col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ book.book.title }}</h5>
                <p class="card-text">{{ book.book.author.name }}</p>
                <p class="card-text">{{ book.book.category.name }} / {{ book.book.genre.name }}</p>
                <p class="card-text">{{ book.book.year }}</p>
                <p class="card-text">{{ book.description }}</p>
                <router-link :to="{ name: 'BookDetail', params: { id: book.book.id } }" class="btn btn-primary">Детальніше
                </router-link>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "BookList",
    props: {
        book: {
            type: Object,
            required: true
        }
    }
};
</script>
