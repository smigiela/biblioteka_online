<template>

    <div>
        <input class="search btn-outline-success" type="text" v-model="search" placeholder="Szukaj..."/>
        <add-author class="addPosition" @added="getAuthor"/>

        <div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Imię</th>
                    <th scope="col">Nazwisko</th>
                    <th scope="col">Narodowość</th>
                    <th scope="col">Operacje</th>
                </tr>
                </thead>

                <tbody>
                <tr style="width: auto;" v-for="author in filteredList()" :key="author.id">
                    <td style="min-width: 8px;">{{ author.id }}</td>

                    <td style="width: 26%;"><span v-if="author.fname">{{ author.fname }}</span><span v-else>Brak danych</span></td>
                    <td style="width: 26%;"><span v-if="author.lname">{{ author.lname }}</span><span v-else>Brak danych</span></td>
                    <td style="width: 26%;"><span v-if="author.nationality">{{ author.nationality }}</span><span v-else>Brak danych</span></td>

                    <td style="min-width: 135px">

                        <delete-author :id="author.id" @deleted="getAuthor"/>
                        <edit-author :author="author" @edited="getAuthor"/>
                        <show-author :id="author.id"/>

                    </td>
                </tr>
                </tbody>

            </table>
        </div>

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
            items: null,
            search: '',
        };
    },
    mounted() {
        this.getAuthor();
    },
    methods: {
        getAuthor() {
            this.axios.get("/api/author").then((response) => {
                this.items = response.data;
            });
        },
        filteredList() {
            return this.items.filter(obj => {
                let match = false;
                for (var prop in obj) {
                    if (Object.prototype.hasOwnProperty.call(obj, prop)) {
                        const value = obj[prop];

                        if(!value) continue;
                        if(typeof value !=='string') continue;

                        if(value.toLowerCase().includes(this.search.toLowerCase()))
                        {
                            match=true;
                        }
                    }
                }
                return match;

            });
        }
    }
}
</script>
