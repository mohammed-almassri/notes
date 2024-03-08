<template>
    <div class="page page-add">
        <router-link to="/">Home</router-link>
        <div class="add-note">
            <input
                type="text"
                class="add-note-input-title"
                placeholder="Add your title here"
                @blur="addOrUpdateNote"
                v-model="noteTitle"
            />
            <textarea
                class="add-note-input-description"
                placeholder="additional info"
                @blur="addOrUpdateNote"
                v-model="noteDescription"
            ></textarea>
            <img
                v-if="noteImageURL"
                :src="noteImageURL"
                alt="note image"
                class="add-note-image"
            />
            <task-list
                v-if="taskList !== null"
                v-model:value="taskList"
            ></task-list>
        </div>
        <note-menu @addImage="onAddImage" @addList="onAddList"></note-menu>
    </div>
</template>

<script>
import store from "@/src/store/index.js";
import Note from "@/src/models/Note.js";
import NoteMenu from "../components/notes/NoteMenu.vue";
import TaskList from "../components/tasks/TaskList.vue";
export default {
    components: { NoteMenu, TaskList },
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
            noteImageURL: "",
            noteId: null,
            requestSent: false,
            taskList: null,
        };
    },
    methods: {
        addOrUpdateNote() {
            if (this.requestSent) return;
            console.log("id", this.taskList);
            const data = {
                title: this.noteTitle,
                description: this.noteDescription,
                image_url: this.noteImageURL,
                tasks: this.taskList,
            };
            this.requestSent = true;
            if (this.noteId != null) {
                data.id = this.noteId;
                store.dispatch("notes/updateNote", data).finally(() => {
                    this.requestSent = false;
                });
            } else {
                store
                    .dispatch("notes/addNote", data)
                    .then((res) => {
                        this.noteId = res.id;
                    })
                    .finally(() => {
                        this.requestSent = false;
                    });
            }
        },
        onAddImage(url) {
            this.noteImageURL = url;
            this.addOrUpdateNote();
        },
        onAddList() {
            this.taskList = [
                {
                    id: 1,
                    title: "",
                    checked: false,
                },
            ];
        },
    },
};
</script>
