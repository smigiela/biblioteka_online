<template>

    <div>

        <add-category class="addPosition" @added="getCategory"/>
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
                      <delete-category :id="props.row.id" @deleted="getCategory"/>
                      <edit-category :category="props.row" @edited="getCategory"/>
                      <show-category :id="props.row.id"/>
                  </span>
                </span>
            </template>
        </vue-good-table>

    </div>

</template>

<script>
import AddCategory from "./addCategory";
import DeleteCategory from "./deleteCategory";
import EditCategory from "./editCategory";
import ShowCategory from "./showCategory";

export default {
    name: "listOfCategories",
    components: {AddCategory, DeleteCategory, EditCategory, ShowCategory},
    data() {
        return {
            columns: [
                {
                    label: 'Id',
                    field: 'id',
                    type: 'number',
                },
                {
                    label: 'Gatunek',
                    field: 'nameOfCategory',
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
        this.getCategory();
    },
    methods: {
        getCategory() {
            this.axios.get("/api/category").then((response) => {
                this.rows = response.data;
            });
        },
    }
}
</script>
