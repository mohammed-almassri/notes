<template>
    <div class="note-menu">
        <div class="note-menu-start">
            <button class="icon-button" title="add list" @click="addList">
                <img
                    src="@/src/assets/img/icons/view-list.svg"
                    alt="add list"
                />
            </button>
            <button
                class="icon-button"
                title="add image"
                @click="openFilePicker"
            >
                <img
                    src="@/src/assets/img/icons/photograph.svg"
                    alt="add image"
                />
            </button>
            <button class="icon-button" title="pin" @click="pinItem">
                <img src="@/src/assets/img/icons/pin.png" alt="pin" />
            </button>
            <button class="icon-button" title="delete" @click="deleteItem">
                <img src="@/src/assets/img/icons/trash.svg" alt="delete" />
            </button>
        </div>
        <div class="note-menu-end" :title="note ? note.updated_at : ''">
            {{
                note
                    ? $t("notes.last_updated", {
                          date: moment(note.updated_at).fromNow(),
                      })
                    : ""
            }}
        </div>
    </div>
</template>

<script>
import moment from "moment";
export default {
    emits: ["add-image", "add-list", "pin-item", "delete-item"],
    props: {
        note: {
            required: true,
            type: Object,
        },
    },
    methods: {
        addList() {
            this.$emit("add-list");
        },
        deleteItem() {
            this.$emit("delete-item");
        },
        pinItem() {
            this.$emit("pin-item");
        },
        openFilePicker() {
            const fileInput = document.createElement("input");
            fileInput.type = "file";
            fileInput.accept = "image/*";
            fileInput.style.display = "none"; // Hide the input element

            fileInput.addEventListener("change", (e) => {
                const file = e.target.files[0];
                const formData = new FormData();
                formData.append("file", file);
                this.imageIsUploading = true;
                this.$store
                    .dispatch("files/upload", formData)
                    .then((res) => {
                        console.log(res);
                        this.$emit("add-image", res.url);
                    })
                    .catch((err) => {
                        console.log(err);
                    })
                    .finally(() => {
                        document.body.removeChild(fileInput);
                    });
            });

            document.body.appendChild(fileInput);
            fileInput.click(); // Trigger the file input dialog
        },
    },
};
</script>

<style></style>
