<template>
    <div style="margin: 0; padding: 3px; margin-top: 1vh;">
        <div style="margin: 0; padding: 3px; width: 10%; height: 90vh; float: left;">

            <button style="width: 100%; margin-bottom: 10px;" class="btn btn-outline-success" type="button">Ksiązka</button>
            <button style="width: 100%; margin-bottom: 10px;" class="btn btn-outline-success" type="button">Autor</button>
            <button style="width: 100%; margin-bottom: 10px;" class="btn btn-outline-success" type="button" @click="showHideCategory()">Gatunek</button>

        </div>
        <div style="margin: 0; padding: 3px; padding-left: 1vw; padding-right: 1vw; width: 90%; height: 90vh; float: left;">

            <div v-if="showComponentCategory">
            <categories></categories>
            </div>

        </div>
    </div>
</template>

<script>
import Categories from "./Category/Categories"
export default {
    components: {Categories},
    data() {
        return {
            showComponentCategory: false,
            showComponentAuthors: false,
            showComponentBooks: false
        };
    },
    mounted() {
        console.log('Component mounted.')
    },
    methods: {
        showHideCategory() {
            this.showComponentAuthors = false;
            this.showComponentBooks = false;
            this.showComponentCategory=!this.showComponentCategory;
        },
    }
}
</script>
