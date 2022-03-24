<template>
    <div class="interventions-open">
        <div class="dynamic_container">
            <h1 class="mb-3">Componente dinamico</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th v-for="(key, i) in keys" :key="i">{{ key }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(element, i) in interventions" :key="i">
                        <td v-for="(key, j) in keys" :key="j">{{ element[key] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "Dynamic",
    data() {
        return {
            interventions: [],
            keys: [],
        };
    },
    methods: {
        getKeys() {
            for (let x in this.interventions[0]) {
                this.keys.push(x);
            }
        },
    },
    created() {
        axios
            .get("/api/interventions/open")
            .then((response) => {
                this.interventions = [...response.data.interventions];
                this.getKeys();
            })
            .catch(function (error) {});
    },
};
</script>

<style lang="scss" scoped>

.dynamic_container {
    padding: 50px 80px;
}

</style>
