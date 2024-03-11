<template>
    <div class="task-list">
        <transition-group name="fade-slide">
            <div
                class="task-list-item"
                v-for="(item, index) in filteredContent"
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
        <static-task-list :tasks="doneTasks"></static-task-list>
    </div>
</template>

<script>
import { v4 as uuid } from "uuid";
import StaticTaskList from "./StaticTaskList.vue";

export default {
    props: {
        value: {
            required: true,
            type: Array,
        },
    },
    components: {
        StaticTaskList,
    },
    data() {
        return {
            content: [],
            titleInputs: [],
            focusedIndex: null,
        };
    },
    mounted() {
        this.focusItem();
        this.content = [...(this.value || [])];
    },
    computed: {
        filteredContent() {
            return this.content
                .filter((task) => !task.done)
                .sort((a, b) => a.order - b.order);
        },
        doneTasks() {
            return this.content.filter((task) => task.done);
        },
    },
    methods: {
        onEnterClicked(index) {
            const nextItem = this.$refs.titleInputs.find(
                (input) => input.dataset.order == index + 1
            );
            if (nextItem && nextItem.value.length === 0) {
                this.focusItem(index + 1);
            } else {
                this.addItem(index);
            }
        },
        onBackspaceClicked(item, index) {
            if (item.title.length === 0) {
                this.removeItem(item.id);
                this.$nextTick(() => {
                    this.focusItem(index - 1);
                });
            }
        },
        addItem(index = null) {
            if (index === null) {
                index = this.content.length - 1;
            }
            this.content.splice(index + 1, 0, {
                id: uuid(),
                title: "",
                done: false,
                order: index + 1,
            });
            this.$nextTick(() => {
                this.focusItem(index + 1);
            });
            this.$emit("update:value", this.content);
        },
        removeItem(id) {
            this.content = this.content.filter((item) => item.id !== id);
            this.$emit("update:value", this.content);
        },
        focusItem(index = null) {
            if (index === null) {
                index = this.content.length - 1;
            }
            this.focusedIndex = index;
            console.log(this.$refs.titleInputs);
            const lastItemInput =
                this.$refs.titleInputs &&
                this.$refs.titleInputs.find(
                    (input) => input.dataset.order == index
                );

            if (lastItemInput) {
                lastItemInput.focus();
            }
        },
    },
    watch: {
        value: {
            handler() {
                this.content = [...(this.value || [])];
            },
            deep: true,
        },
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
