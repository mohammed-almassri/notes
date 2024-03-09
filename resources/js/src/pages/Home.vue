<template>
    <div class="page page-home">
        <note-grid-loader v-if="!notesLoaded"> </note-grid-loader>
        <template v-else-if="notes.length == 0">
            <div class="page-illustration">
                <img src="@/src/assets/img/home.png" />
            </div>
            <h1 class="page-title">{{ $t("home.home_title") }}</h1>
            <p class="page-desc">
                {{ $t("home.home_description") }}
            </p>
        </template>
        <template v-else>
            <div
                class="pinned-notes"
                v-if="pinnedNotes && pinnedNotes.length > 0"
            >
                <h2>
                    {{ $t("home.pinned_notes") }}
                </h2>
                <NoteGrid :notes="pinnedNotes"></NoteGrid>
                <hr />
            </div>
            <NoteGrid :notes="notes"></NoteGrid>
        </template>
        <bottom-menu></bottom-menu>
    </div>
</template>

<script>
import BottomMenu from "../components/layout/BottomMenu.vue";
import NoteGridLoader from "../components/loaders/NoteGridLoader.vue";
import NoteGrid from "../components/notes/NoteGrid.vue";
import store from "../store/index.js";
export default {
    components: { NoteGrid, BottomMenu, NoteGridLoader },
    name: "Home",
    mounted() {
        this.$store.dispatch("notes/getNotes").then(() => {
            this.notesLoaded = true;
        });
    },
    computed: {
        notes() {
            return store.state.notes.notes.filter(
                (note) => note.pinned_at == null
            );
        },
        pinnedNotes() {
            return store.state.notes.notes.filter((note) => note.pinned_at);
        },
    },
    data() {
        return {
            notesLoaded: false,
        };
    },
};
</script>
