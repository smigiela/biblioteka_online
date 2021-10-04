<template>

    <div>

        <add-book class="addPosition" @added="getBook"/>
        <br><br>
        <vue-good-table
            :columns="columns"
            :rows="this.rows"
            :search-options="{
                enabled: true,
                placeholder: 'Szukaj',
            }"
            :pagination-options="{
                enabled: true,
                perPage: 5,
                mode: 'pages',
                nextLabel: 'Następna',
                prevLabel: 'Poprzednia',
                rowsPerPageLabel: 'Rekordów na stronę',
                ofLabel: 'z',
                pageLabel: 'strona',
                allLabel: 'Wszystkie',
              }"
            theme="polar-bear"
            max-height="60vh"
            :fixed-header="true">
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'operations'">
                  <span>
                      <delete-book :id="props.row.id" @deleted="getBook"/>
                      <edit-book :book="props.row" @edited="getBook"/>
                      <show-book :id="props.row.id"/>
                  </span>
                </span>
            </template>
        </vue-good-table>

    </div>

</template>

<script>
import AddBook from "./addBook";
import DeleteBook from "./deleteBook";
import EditBook from "./editBook";
import ShowBook from "./showBook";

export default {
    name: "listOfBooks",
    components: {AddBook, DeleteBook, EditBook, ShowBook},
    data() {
        return {
            columns: [
                {
                    label: 'Id',
                    field: 'id',
                    type: 'number',
                },
                {
                    label: 'Tytuł',
                    field: 'title',
                },
                {
                    label: 'ISBN',
                    field: 'ISBN',
                },
                {
                    label: 'Autor',
                    field: 'author.lname',
                },
                {
                    label: 'Gatunek',
                    field: 'category.nameOfCategory',
                },
                {
                    label: 'Cena',
                    field: 'price',
                },
                {
                    label: 'Ilość',
                    field: 'amount',
                },
                {
                    label: 'Operacje',
                    field: 'operations',
                    sortable: false,
                },
            ],
            rows: [],
        };
    },
    mounted() {
        this.getBook();
    },
    methods: {
        getBook() {
            this.axios.get("/api/book").then((response) => {
                this.rows = response.data;
            });
        },
    }
}
</script>
