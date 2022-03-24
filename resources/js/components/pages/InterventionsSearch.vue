<template>
    <div class="interventions-search">
        <div v-if="interventions.length" class="table_container">
            <h1 class="mb-3">
                Lista interventi aperti o conclusi il "{{ date }}"
            </h1>
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
                        <th>Data fine</th>
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
                        <td v-if="intervention.start_date">
                            {{ intervention.start_date }}
                        </td>
                        <td v-if="intervention.end_date">
                            {{ intervention.end_date }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="buttons">
                <button
                    @click="clear()"
                    class="btn btn-info text-white mt-2"
                    type="button"
                >
                    Nuova ricerca
                </button>
                <div class="buttons d-flex justify-content-end">
                <a :href="`/interventions/${date}/export/json`" class="btn btn-success btn-sm">Export JSON</a>
                <a :href="`/interventions/${date}/export/csv`" class="btn btn-info text-white btn-sm ml-1">Export CSV</a>
            </div>
            </div>
        </div>
        <div v-else-if="noResults" class="table_container">
            <h1 class="mb_3">
                Nessun intervento aperto o concluso il
                <span class="text-wrap">"{{ date }}"</span>
            </h1>
            <button
                @click="clear()"
                class="btn btn-info text-white mt-2"
                type="button"
            >
                Nuova ricerca
            </button>
        </div>
        <div v-else class="table_container">
            <h1 class="mb-3">
                Cerca interventi aperti o conclusi in una data specifica
            </h1>
            <div class="form-group">
                <label class="d-block" for="date">Scegli data</label>
                <input type="date" id="date" v-model="date" />
            </div>
            <button
                @click="searchInterventions()"
                class="btn btn-info text-white mt-2"
                type="button"
                :disabled="date == ''"
            >
                Cerca
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "InterventionsSearch",
    data() {
        return {
            interventions: [],
            date: "",
            noResults: null,
        };
    },
    methods: {
        searchInterventions() {
            axios
                .get(`/api/interventions/${this.date}`)
                .then((response) => {
                    this.interventions = [...response.data.interventions];
                })
                .catch((error) => {
                    this.noResults = true;
                });
        },
        clear() {
            this.interventions = [];
            this.date = "";
            this.noResults = null;
        },
    },
    created() {},
};
</script>

<style>
button {
    border: 0 !important;
}
</style>
