<template>
    <grid-layout
        :layout="layout"
        :col-num="2"
        :row-height="70"
        :is-draggable="true"
        :is-resizable="false"
        :vertical-compact="true"
        :use-css-transforms="true"
    >
        <!-- <NoteGridItem v-for="note in notes" :key="note.id" :note="note">
        </NoteGridItem> -->
        <grid-item
            v-for="item in layout"
            :key="item.i"
            :static="item.static"
            :x="item.x"
            :y="item.y"
            :w="item.w"
            :h="item.h"
            :i="item.i"
        >
            <router-link
                class="note-item-wrapper"
                :to="{ name: 'view', params: { id: item.i } }"
            >
                <div
                    v-if="item.image_url"
                    class="note-item-image"
                    :style="{ 'background-image': `url(${item.image_url})` }"
                ></div>
                <div
                    v-if="item.title || item.description"
                    class="note-item-details"
                >
                    <div v-if="item.title" class="note-item-text">
                        {{ item.title }}
                    </div>
                    <div v-if="item.description" class="note-item-description">
                        {{ item.description }}
                    </div>
                </div>
                <div class="note-item-tasks" v-if="item.tasks">
                    <static-task-list :tasks="item.tasks"></static-task-list>
                </div>
            </router-link>
        </grid-item>
    </grid-layout>
</template>

<script>
import NoteGridItem from "./NoteGridItem.vue";
import { GridLayout, GridItem } from "vue3-grid-layout-next";
import TaskList from "../tasks/TaskList.vue";
import StaticTaskList from "../tasks/StaticTaskList.vue";
export default {
    components: {
        NoteGridItem,
        GridLayout,
        GridItem,
        TaskList,
        StaticTaskList,
    },
    name: "NoteGrid",
    computed: {
        layout() {
            const gridColumns = 2;
            let currentRow = 0;
            let currentColumn = 0;
            const items = this.notes;
            for (let i = 0; i < items.length; i++) {
                const item = items[i];

                let rowspan, colspan;
                if (item.image_url) {
                    rowspan = 4;
                    colspan = 2;
                } else if (item.tasks) {
                    rowspan = 3;
                    colspan = 1;
                } else if (item.title && item.description) {
                    rowspan = 2;
                    colspan = 1;
                } else {
                    rowspan = 1;
                    colspan = 1;
                }

                const x = currentColumn;
                const y = currentRow;

                item.w = colspan;
                item.h = rowspan;
                item.x = x;
                item.y = y;
                item.i = item.id;
                console.log(currentColumn, currentRow, item.y, item.x);

                currentColumn += colspan;
                if (currentColumn >= gridColumns) {
                    currentRow += rowspan;
                    currentColumn = 0;
                }
            }

            return items;
        },
    },
    props: {
        notes: {
            required: true,
        },
    },
};
</script>
