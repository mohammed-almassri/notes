<template>
    <div class="page page-add">
        <router-link to="/">Home</router-link>
        <add-page-loader v-if="!notesLoaded"></add-page-loader>
        <div v-else class="add-note">
            <input
                type="text"
                class="add-note-input-title"
                placeholder="Add your title here"
                @blur="addOrUpdateNote"
                v-model="noteTitle"
            />
            <textarea
                v-if="noteDescription || !taskList || taskList.length === 0"
                class="add-note-input-description"
                placeholder="additional info"
                @blur="addOrUpdateNote"
                v-model="noteDescription"
                ref="textarea"
                @input="resizeTextarea"
                rows="1"
            ></textarea>
            <div class="add-note-image-wrapper" v-if="noteImageURL">
                <img
                    v-if="noteImageURL"
                    :src="noteImageURL"
                    alt="note image"
                    class="add-note-image"
                    width="200px"
                    height="auto"
                />
                <button
                    class="remove-btn"
                    title="remove image"
                    @click="onAddImage(null)"
                >
                    <img
                        src="@/src/assets/img/icons/x.svg"
                        alt="remove image"
                    />
                </button>
            </div>
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
import AddPageLoader from "../components/loaders/AddPageLoader.vue";
export default {
    components: { NoteMenu, TaskList, AddPageLoader },
    name: "Add",
    mounted() {
        const onMounted = () => {
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
        };

        if (this.$store.state.notes.notes.length === 0) {
            this.$store.dispatch("notes/getNotes").then(() => {
                this.notesLoaded = true;
                onMounted();
            });
        } else {
            this.notesLoaded = true;
            onMounted();
        }
    },
    data() {
        return {
            notesLoaded: false,
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
        resizeTextarea() {
            const textarea = this.$refs.textarea;
            textarea.style.height = "auto"; // Reset height to auto
            textarea.style.height = `${textarea.scrollHeight}px`; // Set height to scrollHeight
        },
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
                pinned_at: this.note.pinned_at
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
