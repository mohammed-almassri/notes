<template>
    <div class="task-list">
        <transition-group name="fade-slide">
            <div
                class="task-list-item"
                v-for="(item, index) in content
                    .filter((task) => !task.done)
                    .sort((a, b) => a.order - b.order)"
                :key="item.id"
            >
                <div class="task-list-item-content">
                    <input type="checkbox" v-model="item.done" tabindex="-1" />
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
        </transition-group>
        <static-task-list :tasks="content.filter((task) => task.done)">
        </static-task-list>
    </div>
</template>

<script>
import { ref, watch, onMounted, nextTick } from "vue";
import { v4 as uuid } from "uuid";
import StaticTaskList from "./StaticTaskList.vue";

export default {
    props: {
        value: {
            required: true,
            type: Array,
        },
    },
    emits: ["update:value"],
    components: {
        StaticTaskList,
    },
    setup(props, { emit }) {
        const content = ref([...(props.value || [])]);
        const titleInputs = ref([]);
        const focusedIndex = ref(null);

        onMounted(() => {
            focusItem();
        });

        // Watch for changes in content and update titleInputs ref
        watch(
            content,
            () => {
                emit("update:value", content.value);
            },
            { deep: true }
        );

        const onEnterClicked = (index) => {
            const nextItem = titleInputs.value.find((input) => {
                return input.dataset.order == index + 1;
            });
            if (nextItem && nextItem.value.length === 0) {
                focusItem(index + 1);
            } else {
                addItem(index);
            }
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
            //     done: false,
            // });
            content.value.splice(index + 1, 0, {
                id: uuid(),
                title: "",
                done: false,
                order: index + 1,
            });
            nextTick(() => {
                focusItem(index + 1);
            });
            emit("update:value", content.value);
        };

        const removeItem = (id) => {
            content.value = content.value.filter((item) => item.id !== id);
            emit("update:value", content.value);
        };

        const focusItem = (index = null) => {
            if (index === null) {
                index = content.value.length - 1;
            }
            focusedIndex.value = index;

            const lastItemInput = titleInputs.value.find((input) => {
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
            focusedIndex,
        };
    },
};
</script>

<style>
.fade-slide-enter-active,
.fade-slide-leave-active {
    transition: opacity 0.5s, transform 0.5s;
}
.fade-slide-enter,
.fade-slide-leave-to {
    opacity: 0;
    transform: translateY(-20px);
}
.task-list-item {
    margin-bottom: 10px;
}
</style>
