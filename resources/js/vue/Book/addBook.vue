<template>
    <div>

        <span>
            <div class="text-center"><button style="width: 100%;" class="mb-1 mx-auto btn btn-outline-success" @click="enterBook()">Dodaj książkę</button></div>
            <transition name="fade" appear>
                <div
                    class="modal-overlay"
                    v-if="showModal"
                    @click="showModal = false"
                ></div>
            </transition>
            <transition name="slide" appear>
                <div class="modal2" v-if="showModal">
                    <h1>Dodaj książkę</h1>
                    <form
                        @submit.prevent="addBook(formValues)"
                        class="text-center needs-validation"
                        novalidate
                    >
                        <div v-if="errors.length" class="scroll-bar errorsAlerts">

                            <div class="alert alert-danger" role="alert" v-for="(error, index) in errors" :key="index" >{{ error }}</div>

                        </div>

                        <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Tytuł</span>
                              <input v-model="formValues.title" id="title" type="text" class="form-control"
                                     aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                            <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">ISBN</span>
                              <input v-model="formValues.ISBN" id="ISBN" type="text" class="form-control"
                                     aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                            <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Autor</span>
                              <select class="custom-select" v-model="formValues.author_id"
                                      aria-label="Default select example">
                                  <option selected value="" disabled>Wybierz z listy...</option>
                                  <option v-for="author in authors" :key="author.id"
                                          :value="author.id">{{ author.fname }} {{ author.lname }}</option>
                              </select>
                        </div>

                            <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Gatunek</span>
                              <select class="custom-select" v-model="formValues.category_id"
                                      aria-label="Default select example">
                                  <option selected value="" disabled>Wybierz z listy...</option>
                                  <option v-for="category in categories" :key="category.id"
                                          :value="category.id">{{ category.nameOfCategory }}</option>
                              </select>
                        </div>

                            <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Cena</span>
                              <input v-model="formValues.price" id="price" type="text" class="form-control"
                                     aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                            <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Ilość</span>
                              <input v-model="formValues.amount" id="amount" type="text" class="form-control"
                                     aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                            <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Wydawca</span>
                              <input v-model="formValues.publisher" id="publisher" type="text" class="form-control"
                                     aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Język</span>
                              <input v-model="formValues.language" id="language" type="text" class="form-control"
                                     aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Opis</span>
                              <input v-model="formValues.description" id="description" type="text" class="form-control"
                                     aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                        <br/><br/>

                        <div style="color: red;" class="d-flex justify-content-around">
                            <input class="btn btn-success p-2" type="submit" value="Zatwierdź"/>
                            <button class="btn btn-dark me-md-2 p-2" type="button" @click="showModal = false; errors = []">Zamknij</button>
                        </div>
                    </form>

                </div>
            </transition>
        </span>

    </div>
</template>

<script>
export default {
    name: "addBook",
    data() {
        return {
            showModal: false,
            formValues: {
                author_id: "",
                category_id: "",
                ISBN: "",
                title: "",
                amount: "",
                price: "",
                publisher: "",
                language: "",
                description: "",
            },
            errors: [],
            categories: null,
            authors: null,
        };
    },
    methods: {
        addBook(formValues) {
            axios.post(`/api/book`, formValues)
                .then((res) => {
                    this.showModal = false;
                    this.$emit("added");
                    this.errors = [];
                })
                .catch(error => {
                    if (error && error.response && error.response.data && error.response.data.errors){
                        this.errors = Object.values(error.response.data.errors).flat();
                    }
                })
        },
        getAutors() {
            this.axios.get("/api/author")
                .then((response) => {
                    this.authors = response.data;
                });
        },
        getCategory() {
            this.axios.get("/api/category").then((response) => {
                this.categories = response.data;
            });
        },
        enterBook(){
            this.showModal = true;
            this.formValues = {};
            this.getAutors();
            this.getCategory();
        }
    },
}
</script>
