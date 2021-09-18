<template>

    <div>
<!--        <input type="text" v-model="search" placeholder="szukaj"/>-->
        <add-category @added="getCategory"/>
        <div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Gatunek</th>
                    <th scope="col">Operacje</th>
                </tr>
                </thead>

                <tbody>
                <tr style="width: auto;" v-for="category in items" :key="category.id">
                    <td style="width: 10%;">{{ category.id }}</td>
                    <td style="width: 80%;">{{ category.nameOfCategory }}</td>
                    <td style="width: 10%;">

                        <delete-category :id="category.id" @deleted="getCategory"/>
                        <edit-category :category="category" @edited="getCategory"/>
                        <show-category :id="category.id"/>

                    </td>
                </tr>
                </tbody>

            </table>
        </div>

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
            items: null,
            search: '',
        };
    },
    mounted() {
        this.getCategory();
    },
    // computed: {
    //     filteredCategories: function (){
    //         return this.items.filter((category)=>{
    //            return category.nameOfCategory.match(this.search);
    //         });
    //     }
    // },
    methods: {
        getCategory() {
            this.axios.get("/api/category").then((response) => {
                this.items = response.data;
                console.log(this.items);
            });
        },
    }
}
</script>
