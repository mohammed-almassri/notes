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
                <span class="invalid-feedback" v-if="errors.name">{{
                    errors.name
                }}</span>
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
                <span class="invalid-feedback" v-if="errors.email">{{
                    errors.email
                }}</span>
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
                <span class="invalid-feedback" v-if="errors.password">{{
                    errors.password
                }}</span>
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
                <span
                    class="invalid-feedback"
                    v-if="errors.password_confirmation"
                    >{{ errors.password_confirmation }}</span
                >
            </div>
            <button :disabled="requestLoading" type="submit">
                {{ $t("auth.register") }}
            </button>
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
            errors: {},
            requestLoading: false,
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
            this.requestLoading = true;
            this.$store
                .dispatch("auth/register", data)
                .then(() => {
                    this.$router.push("/");
                })
                .catch((error) => {
                    if (error.response) {
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors;
                            Object.keys(this.errors).map((key) => {
                                this.errors[key] = this.errors[key][0];
                            });
                        }
                    }
                })
                .finally(() => {
                    this.requestLoading = false;
                });
        },
    },
};
</script>
