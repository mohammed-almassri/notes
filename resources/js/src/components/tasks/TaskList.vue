<template>
    <div class="task-list">
        <div
            class="task-list-item"
            v-for="(item, index) in content"
            :key="item.id"
        >
            <div class="task-list-item__content">
                <div class="task-list-item__content__title">
                    <input
                        type="checkbox"
                        v-model="item.checked"
                        tabindex="-1"
                    />
                    <input
                        ref="titleInputs"
                        type="text"
                        v-model="item.title"
                        :data-order="index"
                        @keyup.enter="onEnterClicked(index)"
                        @keyup.backspace="onBackspaceClicked(item, index)"
                        @keyup.up="focusItem(index - 1)"
                        @keyup.down="focusItem(index + 1)"
                    />
                </div>
            </div>
        </div>
        <button class="add-task-btn" @click="addItem">Add Task</button>
    </div>
</template>

<script>
import { ref, watch, onMounted, nextTick } from "vue";

export default {
    props: {
        value: {
            required: true,
            type: Array,
        },
    },
    emits: ["update:value"],
    setup(props, { emit }) {
        const content = ref([...(props.value || [])]);
        const titleInputs = ref([]);

        onMounted(() => {
            focusItem();
        });

        // Watch for changes in content and update titleInputs ref
        watch(content, () => {}, { deep: true });

        const onEnterClicked = (index) => {
            addItem(index);
        };

        const onBackspaceClicked = (item, index) => {
            if (item.title.length === 0) {
                removeItem(item.id);
                nextTick(() => {
                    focusItem(index - 1);
                });
            }
        };

        const addItem = (index = null) => {
            if (index === null) {
                index = content.value.length - 1;
            }
            // content.value.push({
            //     id: content.value.length + 1,
            //     title: "",
            //     checked: false,
            // });
            content.value.splice(index + 1, 0, {
                id: content.value.length + 1,
                title: "",
                checked: false,
            });
            nextTick(() => {
                focusItem(index + 1);
            });
            emit("update:value", content.value);
        };

        const removeItem = (id) => {
            content.value = content.value.filter((item) => item.id !== id);
        };

        const focusItem = (index = null) => {
            if (index === null) {
                index = content.value.length - 1;
            }

            const lastItemInput = titleInputs.value.find((input) => {
                console.log(input.dataset.order, index);
                return input.dataset.order == index;
            });

            if (lastItemInput) {
                lastItemInput.focus();
            }
        };

        return {
            content,
            addItem,
            removeItem,
            onEnterClicked,
            onBackspaceClicked,
            focusItem,
            titleInputs,
        };
    },
};
</script>

<style></style>
