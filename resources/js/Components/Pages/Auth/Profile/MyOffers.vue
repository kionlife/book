<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Мої пропозиції</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div v-for="offer in offers" class="row border rounded shadow mb-2">
            <div class="col-12 col-md-8 p-4">
                Пропозиція від {{ offer.from_user.name }} на книгу {{ offer.instance.book.title }}
            </div>
            <div class="col-12 col-md-4 p-4 d-flex justify-content-end">
                <button @click="" class="btn btn-primary btn-sm mx-2">Прийняти</button>
                <button class="btn btn-danger btn-sm">Відхилити</button>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "MyOffers",
    data() {
        return {
            offers: [],
        };
    },
    created() {
        this.fetchOffers();
    },
    methods: {
        fetchOffers() {
            axios.get('/api/exchange-offers/my')
                .then(response => {
                    this.offers = response.data;
                })
                .catch(error => {
                    console.error('There was an error fetching the offers:', error);
                });
        },
        acceptOffer() {

        },
        rejectOffer() {

        }
    }
};
</script>
