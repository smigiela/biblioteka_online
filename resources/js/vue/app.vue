<template>
    <div class="mainDiv">
        <div class="leftDiv">

            <button class="btn btn-outline-success buttonMenu" type="button" @click="showHideBook()">Ksiązka</button>
            <button class="btn btn-outline-success buttonMenu" type="button" @click="showHideAuthor()">Autor</button>
            <button class="btn btn-outline-success buttonMenu" type="button" @click="showHideCategory()">Gatunek
            </button>

        </div>
        <div class="rightDiv">

            <div v-if="showComponentCategory">
                <categories></categories>
            </div>

            <div v-if="showComponentAuthors">
                <authors></authors>
            </div>

            <div v-if="showComponentBooks">
                <books></books>
            </div>

        </div>

    </div>
</template>

<script>
import Categories from "./Category/Categories"
import Authors from "./Author/Authors"
import Books from "./Book/Books"

export default {
    components: {Categories, Authors, Books},
    data() {
        return {
            showComponentCategory: false,
            showComponentAuthors: false,
            showComponentBooks: true
        };
    },
    mounted() {
    },
    methods: {
        showHideBook() {
            this.showComponentAuthors = false;
            this.showComponentCategory = false;
            this.showComponentBooks = !this.showComponentBooks;
        },
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
