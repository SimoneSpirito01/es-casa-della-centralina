<template>
    <div>
        <div class="my_container">
            <form @submit.prevent="newIntervention()">
                <h1 class="mb-3">Nuovo intervento</h1>
                <div class="form-group">
                    <label for="name">Titolo</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        placeholder="Inserisci il titolo"
                        v-model="intervention.name"
                        required
                    />
                </div>
                <div class="form-group">
                    <label for="technician">Tecnico</label>
                    <select
                        class="form-control"
                        id="technician"
                        v-model="intervention.technician"
                        @change="getCategories()"
                        required
                    >
                        <option value="" selected>Seleziona il tecnico</option>
                        <option
                            v-for="technician in technicians"
                            :key="technician.id"
                            :value="technician.id"
                        >
                            {{ technician.name }} {{ technician.surname }}
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category">Categoria</label>
                    <select
                        class="form-control"
                        id="category"
                        v-model="intervention.category"
                        required
                    >
                        <option value="" selected>
                            Seleziona la categoria
                        </option>
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                        >
                            {{ category.name }}
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Prezzo</label>
                    <input
                        type="number"
                        class="form-control"
                        id="price"
                        placeholder="Inserisci il prezzo"
                        v-model="intervention.price"
                        required
                    />
                </div>
                <div class="form-group">
                    <label for="description">Descrizione</label>
                    <textarea
                        class="form-control"
                        id="description"
                        rows="3"
                        v-model="intervention.description"
                        placeholder="Inserisci la descrizione"
                        required
                    ></textarea>
                </div>
                <div class="form-group">
                    <label for="estimated_duration"
                        >Giorni di lavoro previsti</label
                    >
                    <input
                        type="number"
                        class="form-control"
                        id="estimated_duration"
                        placeholder="Inserisci i giorni di lavoro previsti"
                        v-model="intervention.estimated_duration"
                        required
                    />
                </div>
                <div class="form-group">
                    <label class="d-block" for="start_date">Data inizio</label>
                    <input
                        type="date"
                        id="start_date"
                        v-model="intervention.start_date"
                        required
                    />
                </div>
                <div class="form-group">
                    <label class="d-block" for="end_date">Data fine</label>
                    <input
                        type="date"
                        id="end_date"
                        v-model="intervention.end_date"
                    />
                </div>
                <div
                    class="button d-flex flex-row-reverse justify-content-between align-items-center"
                >
                    <button
                        class="btn btn-info text-white mt-2"
                        type="submit"
                    >
                        Crea intervento
                    </button>
                    <div v-if="success" class="success text-success">
                        Intervento aggiunto con successo!
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "Home",
    data() {
        return {
            technicians: [],
            categories: [],
            intervention: {
                name: "",
                technician: "",
                category: "",
                price: "",
                description: "",
                estimated_duration: "",
                start_date: "",
                end_date: "",
            },
            success: false,
        };
    },
    methods: {
        newIntervention() {
            const self = this;
            axios
                .post("/api/interventions/store", self.intervention)
                .then((response) => {
                    for (let el in self.intervention) {
                        self.intervention[el] = "";
                        self.success = true;
                        setTimeout(() => {
                            self.success = false;
                        }, 5000);
                    }
                })
                .catch((error) => {});
        },
        // metodo che salva le categorie associate al tecnico selezionato
        getCategories() {

            // controllo se il tecnico selezionato esiste all'interno dell'array dei tecnici
            let index = this.technicians.findIndex((element) => {
                return element.id == this.intervention.technician
            });

            // se non esiste esco dalla funzione (es: se è selezionata l'option "Seleziona il tecnico" con value vuoto)
            if(index == -1) {
                return;
            }
            let categories = [];

            // se esiste ciclo sui gruppi e sulle categorie associate ai gruppi
            this.technicians[index].work_groups.forEach((workGroup) => {
                workGroup.categories.forEach((category) => {
                    let exist = categories.some((element) => {
                        return element.id == category.id;
                    });
                    if (!exist) categories.push(category);
                });
            });
            this.categories = categories;
        },
    },
    created() {
        axios
            .get("/api/technicians")
            .then((response) => {
                this.technicians = [...response.data];
                axios;
            })
            .catch(function (error) {});
    },
};
</script>

<style lang="scss" scoped></style>
