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
    </div>
</template>

<script>
import store from "@/src/store/index.js";
import Note from "@/src/models/Note.js";
export default {
    name: "Add",
    data() {
        return {
            noteTitle: "",
            noteDescription: "",
            note: new Note(),
        };
    },
    methods: {
        addNote() {
            this.note = {
                title: this.noteTitle,
                description: this.noteDescription,
            };
            store.dispatch("notes/addNote", this.note);
        },
    },
};
</script>
