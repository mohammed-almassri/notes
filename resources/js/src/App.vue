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
        this.$store.dispatch("settings/initLocale");
        if (this.$store.state.auth.token) {
            this.$store.dispatch("auth/user");
        }

        const locale = this.$store.state.settings.locale;
        this.$i18n.locale = locale;
    },
};
</script>
