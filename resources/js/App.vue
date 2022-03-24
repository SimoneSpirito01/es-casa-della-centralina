<template>
    <div>
        <Header />
        <div class="content">
            <Navbar />
            <Main />
        </div>
    </div>
</template>

<script>
import Header from "./components/macro/Header.vue";
import Main from "./components/macro/Main.vue";
import Navbar from "./components/macro/Navbar.vue";

export default {
    name: "App",
    components: {
        Header,
        Main,
        Navbar,
    },
};
</script>

<style lang="scss" scoped>
.content {
    display: flex;
    height: calc(100vh - 70px);
}
</style>
