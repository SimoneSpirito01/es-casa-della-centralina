<template>
    <div class="technicians-free">
        <div class="table_container">
            <h1 class="mb-3">Lista tecnici liberi</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome e cognome</th>
                        <th>Officina</th>
                        <th>Permessi</th>
                        <th>Email</th>
                        <th>Data di assunzione</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="technician in technicians" :key="technician.id">
                        <th>{{ technician.id }}</th>
                        <td>
                            {{ technician.name }}
                            {{ technician.surname }}
                        </td>
                        <td>{{ technician.workshop.name }}</td>
                        <td>
                            <span class="category" v-for="category in getCategories(technician)" :key="category.id">{{category.name}}</span>
                        </td>
                        <td>{{ technician.email }}</td>
                        <td>{{ technician.hire_date }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="buttons d-flex justify-content-end">
                <a
                    href="/technicians/free/export/json"
                    class="btn btn-success btn-sm"
                    >Export JSON</a
                >
                <a
                    href="/technicians/free/export/csv"
                    class="btn btn-info text-white btn-sm ml-1"
                    >Export CSV</a
                >
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "TechnicianFree",
    data() {
        return {
            technicians: [],
        };
    },
    methods: {
        // metodo che restituisce le categorie associate al tecnico
        getCategories(technician) {

            let categories = [];

            //ciclo sui gruppi e sulle categorie associate ai gruppi
            technician.work_groups.forEach((workGroup) => {
                workGroup.categories.forEach((category) => {
                    let exist = categories.some((element) => {
                        return element.id == category.id;
                    });
                    if (!exist) categories.push(category);
                });
            });
            return categories;
        },
    },
    created() {
        axios
            .get("/api/technicians/free")
            .then((response) => {
                console.log(response.data);
                this.technicians = [...response.data.technicians];
            })
            .catch(function (error) {});
    },
};
</script>

<style lang="scss" scoped>

.category:not(:last-of-type):after {
    content: ', ';
}

</style>
