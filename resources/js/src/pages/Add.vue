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
        <note-menu
            @addImage="onAddImage"
            @addList="onAddList"
            @pin-item="onPinItem"
            @delete-item="onDeleteItem"
            :note="note"
        ></note-menu>
    </div>
</template>

<script>
import store from "@/src/store/index.js";
import Note from "@/src/models/Note.js";
import NoteMenu from "../components/notes/NoteMenu.vue";
import TaskList from "../components/tasks/TaskList.vue";
import { v4 as uuid } from "uuid";
import moment from "moment";
export default {
    components: { NoteMenu, TaskList },
    name: "Add",
    mounted() {
        if (this.$route.params.id) {
            const note = this.$store.state.notes.notes.find(
                (note) => note.id === this.$route.params.id
            );
            this.noteSaved = true;
            console.log(note);
            if (note) {
                this.note = note;
                this.noteTitle = note.title;
                this.noteDescription = note.description;
                this.noteId = this.$route.params.id;
                this.noteImageURL = note.image_url;
                this.taskList = note.tasks;
            }
        }
    },
    data() {
        return {
            noteTitle: "",
            noteDescription: "",
            noteImageURL: "",
            noteId: null,
            notePinnedAt: null,
            requestSent: false,
            taskList: null,
            noteSaved: false,
            note: null,
        };
    },
    methods: {
        getNoteObject() {
            console.log("get object task list", this.taskList);
            return {
                id: this.noteId,
                title: this.noteTitle,
                description: this.noteDescription,
                image_url: this.noteImageURL,
                pinned_at: this.notePinnedAt,

                tasks: this.taskList ? this.taskList : [],
            };
        },
        onDeleteItem() {
            console;
            this.$store.dispatch("notes/deleteNote", this.noteId).then(() => {
                this.$router.replace("/");
            });
        },
        onPinItem() {
            this.$store.dispatch("notes/updateNote", {
                ...this.getNoteObject(),
                pinned_at: this.notePinnedAt
                    ? null
                    : moment().format("YYYY-MM-DD HH:mm:ss"),
            });
        },
        addOrUpdateNote() {
            if (this.requestSent) return;
            const data = this.getNoteObject();
            this.requestSent = true;
            console.log("add or update note", this.noteSaved);
            if (this.noteSaved) {
                data.id = this.noteId;
                store.dispatch("notes/updateNote", data).finally(() => {
                    this.requestSent = false;
                });
            } else {
                this.noteId = uuid();
                data.id = this.noteId;
                store
                    .dispatch("notes/addNote", data)
                    .then((res) => {
                        console.log("note added", res);
                        this.noteId = res.data.id;
                        this.noteSaved = true;
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
                    id: uuid(),
                    title: "",
                    done: false,
                    order: 0,
                },
            ];
        },
    },
    watch: {
        taskList: {
            handler() {
                console.log("tasks", this.taskList);

                this.addOrUpdateNote();
            },
            deep: true,
        },
    },
};
</script>
