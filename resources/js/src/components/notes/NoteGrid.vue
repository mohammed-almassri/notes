<template>
    <grid-layout
        :layout="layout"
        :col-num="2"
        :row-height="30"
        :is-draggable="true"
        :is-resizable="false"
        :vertical-compact="true"
        :use-css-transforms="true"
    >
        <!-- <NoteGridItem v-for="note in notes" :key="note.id" :note="note">
        </NoteGridItem> -->
        <grid-item
            v-for="item in layout"
            :static="item.static"
            :x="item.x"
            :y="item.y"
            :w="item.w"
            :h="item.h"
            :i="item.i"
            :key="item.i"
        >
            <span class="text">{{ item.title }}</span>
            <span>
                {{ item.description }}
            </span>
        </grid-item>
    </grid-layout>
</template>

<script>
import NoteGridItem from "./NoteGridItem.vue";
import { GridLayout, GridItem } from "vue3-grid-layout-next";
export default {
    components: { NoteGridItem, GridLayout, GridItem },
    name: "NoteGrid",
    computed: {
        layout() {
            const colsPerRow = 3;
            //format notes
            const notes = this.notes.map((note, index) => {
                return {
                    i: note.id,
                    title: note.title,
                    description: note.description,
                    x: index % colsPerRow,
                    y: Math.floor(index / colsPerRow) * 3,
                    w: 1,
                    h: 3,
                    static: false,
                };
            });
            return notes;
        },
    },
    props: {
        notes: {
            required: true,
        },
    },
};
</script>
