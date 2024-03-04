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
                <input type="text" id="name" name="name" required />
            </div>
            <div class="form-group">
                <label for="email">{{ $t("auth.email") }}</label>
                <input type="email" id="email" name="email" required />
            </div>
            <div class="form-group">
                <label for="password">{{ $t("auth.password") }}</label>
                <input type="password" id="password" name="password" required />
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
    methods: {
        register() {},
    },
};
</script>
