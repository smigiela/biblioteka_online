<template>
    <div class="mainDiv">
        <div class="leftDiv">

            <button class="btn btn-outline-success buttonMenu" type="button">Ksiązka</button>
            <button class="btn btn-outline-success buttonMenu" type="button" @click="showHideAuthor()">Autor</button>
            <button class="btn btn-outline-success buttonMenu" type="button" @click="showHideCategory()">Gatunek</button>

        </div>
        <div class="rightDiv">

            <div v-if="showComponentCategory">
                <categories></categories>
            </div>

            <div v-if="showComponentAuthors">
                <authors></authors>
            </div>

        </div>

    </div>
</template>

<script>
import Categories from "./Category/Categories"
import Authors from "./Author/Authors"

export default {
    components: {Categories, Authors},
    data() {
        return {
            showComponentCategory: false,
            showComponentAuthors: false,
            showComponentBooks: false
        };
    },
    mounted() {
    },
    methods: {
        showHideCategory() {
            this.showComponentAuthors = false;
            this.showComponentBooks = false;
            this.showComponentCategory = !this.showComponentCategory;
        },
        showHideAuthor() {
            this.showComponentCategory = false;
            this.showComponentBooks = false;
            this.showComponentAuthors = !this.showComponentAuthors;
        },
    }
}
</script>
