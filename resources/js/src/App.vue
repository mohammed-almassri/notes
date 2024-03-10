<template>
    <div class="App">
        <router-view></router-view>
    </div>
</template>

<script>
import BottomMenu from "./components/layout/BottomMenu.vue";
export default {
    name: "App",
    components: {
        BottomMenu,
    },
    mounted() {
        this.$store.dispatch("auth/initAuth");
        this.$store.dispatch("auth/user");
    },
};
</script>
