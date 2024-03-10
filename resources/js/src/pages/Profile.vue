<template>
    <div class="page page-profile">
        <h1>Profile</h1>
        <div v-if="user">
            {{ user.name }}
        </div>
    </div>
</template>

<script>
export default {
    name: "Profile",
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
    },
};
</script>

<style></style>
