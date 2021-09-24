<template>
        <span title="Edytuj element">
            <button class="btn p-2" @click="editComponentBook()">

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
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
                    <h1>Edycja</h1>
                    <form
                        @submit.prevent="editBook(formValues)"
                        class="text-center needs-validation"
                        novalidate
                    >

                        <div v-if="errors.length" class="scroll-bar errorsAlerts">

                            <div class="alert alert-danger" role="alert" v-for="(error, index) in errors" :key="index" >{{ error }}</div>

                        </div>

                        <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Tytuł</span>
                              <input v-model="formValues.title" id="title" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success" >ISBN</span>
                              <input v-model="formValues.ISBN" id="ISBN" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success" >Author</span>
                              <select class="custom-select" v-model="formValues.author_id" aria-label="Default select example">
                                  <option selected value="" disabled>Wybierz z listy...</option>
                                  <option v-for="author in authors" :key="author.id" :value="author.id">{{ author.fname }} {{ author.lname }}</option>
                              </select>
                        </div>

                        <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success" >Gatunek</span>
                              <select class="custom-select" v-model="formValues.category_id" aria-label="Default select example">
                                  <option selected value="" disabled>Wybierz z listy...</option>
                                  <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.nameOfCategory }}</option>
                              </select>
                        </div>

                        <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Cena</span>
                              <input v-model="formValues.price" id="price" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Wydawca</span>
                              <input v-model="formValues.publisher" id="publisher" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mb-3 ">
                              <span class="input-group-text widthForm alert-success">Język</span>
                              <input v-model="formValues.language" id="language" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Opis</span>
                              <input v-model="formValues.description" id="description" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
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
</template>

<script>
export default {
    name: "editBook",
    props: ["book"],
    data() {
        return {
            showModal: false,
            formValues: {
                author_id: "",
                category_id: "",
                ISBN: "",
                title: "",
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
        editBook(formValues) {
            axios.put(`/api/book/${this.book.id}`, formValues)
                .then((res) => {
                    this.$emit("edited");
                    this.showModal = false;
                    this.errors = [];
                })
                .catch(error => {
                    if (error && error.response && error.response.data && error.response.data.errors) {
                        this.errors = Object.values(error.response.data.errors).flat();
                    }
                });
        },
        editComponentBook(){
            this.showModal=true;
            this.formValues.title=this.book.title;
            this.formValues.ISBN=this.book.ISBN;
            this.formValues.author_id=this.book.author_id;
            this.formValues.category_id=this.book.category_id;
            this.formValues.price=this.book.price;
            this.formValues.publisher=this.book.publisher;
            this.formValues.language=this.book.language;
            this.formValues.description=this.book.description;
            this.getAutors();
            this.getCategory();
        },
        getAutors() {
            this.axios.get("/api/author").then((response) => {
                this.authors = response.data;
            });
        },
        getCategory() {
            this.axios.get("/api/category").then((response) => {
                this.categories = response.data;
            });
        }
    },
};
</script>
