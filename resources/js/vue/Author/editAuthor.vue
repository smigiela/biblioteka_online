<template>
        <span title="Edytuj element">
            <button class="btn p-2" @click="editComponentAuthor()">

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
                        @submit.prevent="editAuthor(formValues)"
                        class="text-center needs-validation"
                        novalidate
                    >

                        <div v-if="errors.length" class="scroll-bar errorsAlerts">

                            <div class="alert alert-danger" role="alert" v-for="(error, index) in errors" :key="index" >{{ error }}</div>

                        </div>

                        <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Imię</span>
                              <input v-model="formValues.fname" id="fname" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Nazwisko</span>
                              <input v-model="formValues.lname" id="lname" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Narodowość</span>
                              <input v-model="formValues.nationality" id="nationality" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Miejsce urodzenia</span>
                              <input v-model="formValues.placeOfBirth" id="placeOfBirth" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Data urodzenia</span>
                              <input v-model="formValues.dateOfBirth" id="dateOfBirth" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Data śmierci</span>
                              <input v-model="formValues.dateOfDeath" id="dateOfDeath" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
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
    name: "editAuthor",
    props: ["author"],
    data() {
        return {
            showModal: false,
            formValues: {
                fname: "",
                lname: "",
                nationality: "",
                placeOfBirth: "",
                dateOfBirth: "",
                dateOfDeath: "",
            },
            errors: [],
        };
    },
    methods: {
        editAuthor(formValues) {
            axios.put(`/api/author/${this.author.id}`, formValues)
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
        editComponentAuthor(){
            this.showModal=true;
            this.formValues.fname=this.author.fname;
            this.formValues.lname=this.author.lname;
            this.formValues.nationality=this.author.nationality;
            this.formValues.placeOfBirth=this.author.placeOfBirth;
            this.formValues.dateOfBirth=this.author.dateOfBirth;
            this.formValues.dateOfDeath=this.author.dateOfDeath;
        }
    },
};
</script>
