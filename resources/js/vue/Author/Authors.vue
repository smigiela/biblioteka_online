<template>

    <div>

        <add-author class="addPosition" @added="getAuthor"/>
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
                      <delete-author :id="props.row.id" @deleted="getAuthor"/>
                      <edit-author :author="props.row" @edited="getAuthor"/>
                      <show-author :id="props.row.id"/>
                  </span>
                </span>
            </template>
        </vue-good-table>

    </div>

</template>

<script>
import AddAuthor from "./addAuthor";
import DeleteAuthor from "./deleteAuthor";
import EditAuthor from "./editAuthor";
import ShowAuthor from "./showAuthor";

export default {
    name: "listOfAuthors",
    components: {DeleteAuthor, AddAuthor, EditAuthor, ShowAuthor},
    data() {
        return {
            columns: [
                {
                    label: 'Id',
                    field: 'id',
                    type: 'number',
                },
                {
                    label: 'Imię',
                    field: 'fname',
                },
                {
                    label: 'Nazwisko',
                    field: 'lname',
                },
                {
                    label: 'Narodowość',
                    field: 'nationality',
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
        this.getAuthor();
    },
    methods: {
        getAuthor() {
            this.axios.get("/api/author").then((response) => {
                this.rows = response.data;
            });
        },
    }
}
</script>
