<template>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h2 class="pageTitle">Мої пропозиції</h2>
            </div>
        </div>
    </div>

    <div class="container">
        <div v-for="offer in offers" class="row border rounded shadow mb-2">
            <div class="col-12 col-md-8 p-4">
                Пропозиція від {{ offer.from_user.name }}. <br>
                Я пропоную <b>{{ offer.give_book.book.title }} (ID: {{ offer.give_book.id }})</b> <br>
                Ви даєте мені <b>{{ offer.take_book.book.title }} (ID: {{ offer.take_book.id }})</b> <br>
            </div>
            <div class="col-12 col-md-4 p-4 d-flex justify-content-end">
                <button @click="acceptOffer(offer.id)" class="btn btn-primary btn-sm mx-2">Прийняти</button>
                <button @click="rejectOffer" class="btn btn-danger btn-sm">Відхилити</button>
            </div>
        </div>
    </div>
</template>

<script>

import authService from "../../../../services/authService";

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
        acceptOffer(id) {
            axios.post(`/api/exchange-offers/${id}/accept`)
                .then(response => {
                    this.offers = response.data;
                })
                .catch(error => {
                    console.error('There was an error fetching the offers:', error);
                });
        },
        rejectOffer() {

        }
    }
};
</script>
