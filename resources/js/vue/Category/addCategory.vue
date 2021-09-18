<template>
    <div>

        <span>
            <div class="text-center"><button style="width: 100%;" class="mb-1 mx-auto btn btn-outline-success" @click="enterCategory()">Dodaj gatunek</button></div>
            <transition name="fade" appear>
                <div
                    class="modal-overlay"
                    v-if="showModal"
                    @click="showModal = false"
                ></div>
            </transition>
            <transition name="slide" appear>
                <div class="modal2" v-if="showModal">
                    <h1>Dodaj gatunek</h1>
                    <form
                        @submit.prevent="addCategory(formValues)"
                        class="text-center needs-validation"
                        novalidate
                    >
                        <div v-if="errors.length" class="scroll-bar errorsAlerts">

                            <div class="alert alert-danger" role="alert" v-for="(error, index) in errors" :key="index" >{{ error }}</div>

                        </div>

                        <div class="input-group mb-3">
                              <span class="input-group-text widthForm alert-success">Gatunek</span>
                              <input v-model="formValues.nameOfCategory" id="category_name" type="text" class="form-control"
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
    name: "addCategory",
    data() {
        return {
            showModal: false,
            formValues: {
                nameOfCategory: "",
            },
            errors: [],
        };
    },
    methods: {
        addCategory(formValues) {
            axios.post(`/api/category`, formValues)
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
        enterCategory(){
            this.showModal = true;
            this.formValues = {};
        }
    },
}
</script>
