<template>
    <div class="page page-settings">
        <router-link to="/">{{ $t("home.home") }}</router-link>

        <h1>{{ $t("settings.title") }}</h1>
        <div v-if="user">
            <span>
                {{ user.name }}
            </span>
            <span> ({{ user.email }}) </span>
        </div>
        <div>
            <button @click="changeLocale">
                {{ $t("settings.change_locale_to") }} {{ otherLocale }}
            </button>
        </div>
        <div>
            <button @click="logout">
                {{ $t("settings.logout") }}
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "Settings",
    mounted() {
        this.$store.dispatch("auth/user").then(() => {
            this.userLoaded = true;
        });
    },
    data() {
        return {
            userLoaded: false,
        };
    },
    computed: {
        user() {
            return this.$store.state.auth.user;
        },
        currentLocale() {
            return this.$store.state.settings.locale;
        },
        otherLocale() {
            return this.currentLocale === "en" ? "العربية" : "English";
        },
    },
    methods: {
        changeLocale() {
            const newLocale = this.currentLocale === "en" ? "ar" : "en";
            this.$store.dispatch("settings/setLocale", newLocale);
            this.$i18n.locale = newLocale;
        },
        logout() {
            this.$store.dispatch("auth/logout");
            this.$router.push("/login");
        },
    },
};
</script>

<style></style>
