<template>
    <div>

        <span>
            <div class="text-center"><button style="width: 100%;" class="mb-1 mx-auto btn btn-outline-success" @click="enterAuthor()">Dodaj autora</button></div>
            <transition name="fade" appear>
                <div
                    class="modal-overlay"
                    v-if="showModal"
                    @click="showModal = false"
                ></div>
            </transition>
            <transition name="slide" appear>
                <div class="modal2" v-if="showModal">
                    <h1>Dodaj autora</h1>
                    <form
                        @submit.prevent="addAuthor(formValues)"
                        class="text-center needs-validation"
                        novalidate
                    >
                        <div v-if="errors.length" class="scroll-bar errorsAlerts">

                            <div class="alert alert-danger" role="alert" v-for="(error, index) in errors" :key="index" >{{ error }}</div>

                        </div>

                        <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Imię</span>
                              <input v-model="formValues.fname" id="fname" type="text" class="form-control"
                                     aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                            <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Nazwisko</span>
                              <input v-model="formValues.lname" id="lname" type="text" class="form-control"
                                     aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                            <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Narodowość</span>
                              <input v-model="formValues.nationality" id="nationality" type="text" class="form-control"
                                     aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                            <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Miejsce urodzenia</span>
                              <input v-model="formValues.placeOfBirth" id="placeOfBirth" type="text" class="form-control"
                                     aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                            <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Data urodzenia</span>
                              <input v-model="formValues.dateOfBirth" id="dateOfBirth" type="text" class="form-control"
                                     aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                            <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Data śmierci</span>
                              <input v-model="formValues.dateOfDeath" id="dateOfDeath" type="text" class="form-control"
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
    name: "addAuthor",
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
        addAuthor(formValues) {
            axios.post(`/api/author`, formValues)
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
        enterAuthor(){
            this.showModal = true;
            this.formValues = {};
        }
    },
}
</script>
