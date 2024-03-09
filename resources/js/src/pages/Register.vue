<template>
    <div class="page page-register form-width">
        <div class="form-width">
            <h1>{{ $t("auth.register") }}</h1>
            <p>
                {{ $t("auth.register_description") }}
            </p>
        </div>
        <form class="form register-form" @submit.prevent="register">
            <div class="form-group">
                <label for="name">{{ $t("auth.name") }}</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    v-model="name"
                />
            </div>
            <div class="form-group">
                <label for="email">{{ $t("auth.email") }}</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    v-model="email"
                />
            </div>
            <div class="form-group">
                <label for="password">{{ $t("auth.password") }}</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    v-model="password"
                />
            </div>
            <div class="form-group">
                <label for="password_confirmation">{{
                    $t("auth.password_confirmation")
                }}</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    v-model="password_confirmation"
                />
            </div>
            <button type="submit">{{ $t("auth.register") }}</button>
        </form>
        <div class="form-width">
            <router-link to="/login">{{
                $t("auth.already_account")
            }}</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "Register",
    data() {
        return {
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
        };
    },
    methods: {
        register() {
            const data = {
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
                name: this.name,
            };
            this.$store.dispatch("auth/register", data).then(() => {
                this.$router.push("/");
            });
        },
    },
};
</script>
