<template>
    <div class="page page-add">
        <router-link to="/">Home</router-link>
        <div class="add-note">
            <input
                type="text"
                class="add-note-input-title"
                placeholder="Add your title here"
                @blur="addNote"
                v-model="noteTitle"
            />
            <textarea
                class="add-note-input-description"
                placeholder="additional info"
                @blur="addNote"
                v-model="noteDescription"
            ></textarea>
        </div>
        <div class="add-note-options"></div>
    </div>
</template>

<script>
import store from "@/src/store/index.js";
import Note from "@/src/models/Note.js";
export default {
    name: "Add",
    mounted() {
        if (this.$route.params.id) {
            const note = this.$store.state.notes.notes.find(
                (note) => note.id === this.$route.params.id
            );
            console.log(note);
            if (note) {
                this.noteTitle = note.title;
                this.noteDescription = note.description;
            }
        }
    },
    data() {
        return {
            noteTitle: "",
            noteDescription: "",
        };
    },
    methods: {
        addNote() {
            const data = {
                title: this.noteTitle,
                description: this.noteDescription,
            };
            store.dispatch("notes/addNote", data);
        },
    },
};
</script>
