<template>
    <div class="page page-add">
        <router-link to="/">{{ $t("home.home") }}</router-link>
        <add-page-loader v-if="!notesLoaded"></add-page-loader>
        <div v-else class="add-note">
            <input
                type="text"
                class="add-note-input-title"
                :placeholder="$t('add.add_title')"
                @blur="addOrUpdateNote"
                v-model="note.title"
            />
            <textarea
                v-if="
                    note.description || !note.tasks || note.tasks.length === 0
                "
                class="add-note-input-description"
                :placeholder="$t('add.add_description')"
                @blur="addOrUpdateNote"
                v-model="note.description"
                ref="textarea"
                @input="resizeTextarea"
                rows="1"
            ></textarea>
            <div class="add-note-image-wrapper" v-if="note.image_url">
                <img
                    v-if="note.image_url"
                    :src="note.image_url"
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
                    <img src="@/assets/img/icons/x.svg" alt="remove image" />
                </button>
            </div>
            <task-list
                v-if="note.tasks !== null"
                v-model:value="note.tasks"
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
import store from "@/store/index.js";
import Note from "@/models/Note.js";
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
                }
            } else {
                this.note = {};
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
            // noteTitle: "",
            // noteDescription: "",
            // noteImageURL: "",
            // noteId: null,
            // notePinnedAt: null,
            requestSent: false,
            // taskList: null,
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
        // getNoteObject() {
        //     console.log("get object task list", this.taskList);
        //     return {
        //         id: this.noteId,
        //         title: this.noteTitle,
        //         description: this.noteDescription,
        //         image_url: this.noteImageURL,
        //         pinned_at: this.notePinnedAt,

        //         tasks: this.taskList ? this.taskList : [],
        //     };
        // },
        onDeleteItem() {
            console;
            this.$store.dispatch("notes/deleteNote", this.note.id).then(() => {
                this.$router.replace("/");
            });
        },
        onPinItem() {
            this.$store.dispatch("notes/updateNote", {
                ...this.note,
                pinned_at: this.note.pinned_at
                    ? null
                    : moment().format("YYYY-MM-DD HH:mm:ss"),
            });
        },
        addOrUpdateNote() {
            if (this.requestSent) return;
            const data = this.note;
            this.requestSent = true;
            console.log("add or update note", this.noteSaved);
            if (this.noteSaved) {
                data.id = this.note.id;
                store.dispatch("notes/updateNote", data).finally(() => {
                    this.requestSent = false;
                });
            } else {
                this.note.id = uuid();
                data.id = this.note.id;
                store
                    .dispatch("notes/addNote", data)
                    .then((res) => {
                        console.log("note added", res);
                        this.note.id = res.data.id;
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
            this.note.tasks = [
                {
                    id: uuid(),
                    title: "",
                    done: false,
                    order: 0,
                },
            ];

            console.log("add list", this.note.tasks);
        },
    },
    watch: {
        "note.tasks": {
            handler() {
                console.log("tasks", this.note.tasks);

                this.addOrUpdateNote();
            },
            deep: true,
        },
    },
};
</script>
