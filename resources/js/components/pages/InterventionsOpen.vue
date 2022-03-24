<template>
    <div class="interventions-open">
        <div class="table_container">
            <h1 class="mb-3">Lista interventi aperti</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titolo</th>
                        <th>Tecnico</th>
                        <th>Categoria</th>
                        <th>Officina</th>
                        <th>Prezzo</th>
                        <th>Descrizione</th>
                        <th>Durata prevista</th>
                        <th>Data inizio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="intervention in interventions"
                        :key="intervention.id"
                    >
                        <th>{{ intervention.id }}</th>
                        <td>{{ intervention.name }}</td>
                        <td>
                            {{ intervention.user.name }}
                            {{ intervention.user.surname }}
                        </td>
                        <td>{{ intervention.category.name }}</td>
                        <td>{{ intervention.workshop.name }}</td>
                        <td>{{ intervention.price }}€</td>
                        <td>{{ intervention.description }}</td>
                        <td>{{ intervention.estimated_duration }} giorni</td>
                        <td>{{ intervention.start_date }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="buttons d-flex justify-content-end">
                <a href="/interventions/open/export/json" class="btn btn-success btn-sm">Export JSON</a>
                <a href="/interventions/open/export/csv" class="btn btn-info text-white btn-sm ml-1">Export CSV</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "InterventionsOpen",
    data() {
        return {
            interventions: [],
        };
    },
    created() {
        axios
            .get("/api/interventions/open")
            .then((response) => {
                this.interventions = [...response.data.interventions];
            })
            .catch(function (error) {});
    },
};
</script>

<style></style>
