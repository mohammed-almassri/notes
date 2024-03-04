<template>
    <div class="page page-login form-width">
        <div class="form-width">
            <h1>{{ $t("auth.login") }}</h1>
            <p>
                {{ $t("auth.login_description") }}
            </p>
        </div>
        <form class="form login-form" @submit.prevent="login">
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
            <button type="submit">{{ $t("auth.login") }}</button>
        </form>
        <div class="form-width">
            <router-link to="/register">{{
                $t("auth.no_account")
            }}</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",
    data() {
        return {
            email: "",
            password: "",
        };
    },
    methods: {
        login() {
            const data = {
                email: this.email,
                password: this.password,
            };
            console.log(data);
            this.$store.dispatch("auth/login", data).then(() => {
                this.$router.push("/");
            });
        },
    },
};
</script>
