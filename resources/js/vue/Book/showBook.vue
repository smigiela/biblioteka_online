<template>
        <span title="Pokaż element">
            <button class="btn p-2" @click="showBook()" >

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar-reverse" viewBox="0 0 16 16">
  <path d="M12.5 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5zm0 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5zm.5 3.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5zm-.5 2.5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5z"/>
  <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2zM4 1v14H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h2zm1 0h9a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5V1z"/>
</svg>

            </button>
            <transition name="fade" appear>
                <div
                    class="modal-overlay"
                    v-if="showModal"
                    @click="showModal = false"
                ></div>
            </transition>
            <transition name="slide" appear>
                <div class="modal2" v-if="showModal">
                    <h1>Szczegóły</h1>
                    <p>Tytuł: <span v-if="items.title">{{items.title}}</span><span v-else>Brak danych</span></p>
                    <p>ISBN: <span v-if="items.ISBN">{{items.ISBN}}</span><span v-else>Brak danych</span></p>
                    <p>Autor: <span v-if="items.author_id">{{ items.author.fname }} {{ items.author.lname }}</span><span v-else>Brak danych</span></p>
                    <p>Gatunek: <span v-if="items.category_id">{{items.category.nameOfCategory}}</span><span v-else>Brak danych</span></p>
                    <p>Cena: <span v-if="items.price">{{items.price}}</span><span v-else>Brak danych</span></p>
                    <p>Ilość: <span v-if="items.amount">{{items.amount}}</span><span v-else>Brak danych</span></p>
                    <p>Wydawca: <span v-if="items.publisher">{{items.publisher}}</span><span v-else>Brak danych</span></p>
                    <p>Język: <span v-if="items.language">{{items.language}}</span><span v-else>Brak danych</span></p>
                    <p>Opis: <span v-if="items.description">{{items.description}}</span><span v-else>Brak danych</span></p>

                    <div class="text-center">
                          <button class="text-center btn btn-dark me-md-2 p-2" type="button" @click="showModal = false; errors = []">Zamknij</button>
                    </div>
                </div>

            </transition>
        </span>
</template>

<script>
export default {
    name: "showBook",
    props: ["id"],
    data() {
        return {
            showModal: false,
            items: {},
        };
    },
    methods: {
        showBook() {
            this.showModal = true;
            this.axios.get(`/api/book/${this.id}`).then((response) => {
                this.items = response.data;
            });
        },
    },
};
</script>
