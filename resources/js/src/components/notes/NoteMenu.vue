<template>
    <div class="note-menu">
        <div class="note-menu-start">
            <button class="icon-button" title="add list" @click="addList">
                <img
                    src="@/src/assets/img/icons/view-list.svg"
                    alt="add list"
                />
            </button>
            <button class="icon-button" title="add image" @click="addImage">
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
        <!-- <div class="note-menu-end">
            <expandable-menu :options="menuOptions"></expandable-menu>
        </div> -->
    </div>
</template>

<script>
import ExpandableMenu from "../UI/ExpandableMenu.vue";
export default {
    components: { ExpandableMenu },
    emits: ["add-image", "add-list", "pin-item", "delete-item"],

    data() {
        return {
            imageIsUploading: false,
            // menuOptions: [
            //     {
            //         title: "test",
            //         value: "test1",
            //         image: "@/src/assets/img/icons/plus.svg",
            //     },
            //     {
            //         title: "test",
            //         value: "test2",
            //         image: "@/src/assets/img/icons/plus.svg",
            //     },
            //     {
            //         title: "test",
            //         value: "test3",
            //         image: "@/src/assets/img/icons/plus.svg",
            //     },
            // ],
        };
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
        addImage() {
            //open file picker
            const fileInput = document
                .querySelector("body")
                .appendChild(document.createElement("input"));

            fileInput.type = "file";
            fileInput.accept = "image/*";
            fileInput.click();

            fileInput.addEventListener("change", (e) => {
                const file = e.target.files[0];
                //create form data object
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
                        fileInput.remove();
                    });
            });
            fileInput.remove();
        },
    },
};
</script>
