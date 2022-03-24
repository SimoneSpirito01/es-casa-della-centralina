<template>
    <nav>
        <div class="interventions">
            <h3>Interventi</h3>
            <div>
                <router-link :to="{ name: 'home' }">
                    Nuovo intervento
                </router-link>
            </div>
            <div>
                <router-link :to="{ name: 'interventions-open' }">
                    Interventi aperti
                </router-link>
            </div>
            <div>
                <router-link :to="{ name: 'interventions-latests' }">
                    Interventi conclusi negli ultimi 30 giorni
                </router-link>
            </div>
            <div>
                <router-link :to="{ name: 'interventions-search' }">
                    Cerca interventi per data
                </router-link>
            </div>
        </div>
        <div class="technicians">
            <h3>Tecnici</h3>
            <div>
                <router-link :to="{ name: 'technician-free' }">
                    Tecnici liberi
                </router-link>
            </div>
        </div>
        <div class="plus">
            <h3>Plus</h3>
            <div>
                <router-link :to="{ name: 'dynamic' }">
                    Componente dinamico
                </router-link>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: "Navbar",
};
</script>

<style lang="scss" scoped>
nav {
    width: 25%;
    background-color: #4e4e4e;
    color: white;
    font-size: 18px;
    padding: 20px;
    user-select: none;

    > div {
        margin-bottom: 1.25rem;
    }

    h3 {
        font-size: 30px;
        color: #f15c29;
    }
}
</style>
