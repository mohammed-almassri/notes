<template>
    <div class="page page-home">
        <template v-if="notes.length == 0">
            <div class="page-illustration">
                <img src="@/src/assets/img/home.png" />
            </div>
            <h1 class="page-title">{{ $t("home.home_title") }}</h1>
            <p class="page-desc">
                {{ $t("home.home_description") }}
            </p>
        </template>
        <NoteGrid v-else :notes="notes"></NoteGrid>
        <bottom-menu></bottom-menu>
    </div>
</template>

<script>
import BottomMenu from "../components/layout/BottomMenu.vue";
import NoteGrid from "../components/notes/NoteGrid.vue";
import store from "../store/index.js";
export default {
    components: { NoteGrid, BottomMenu },
    name: "Home",
    mounted() {
        this.$store.dispatch("notes/getNotes");
    },
    computed: {
        notes() {
            return store.state.notes.notes;
        },
    },
    data() {
        return {};
    },
};
</script>
