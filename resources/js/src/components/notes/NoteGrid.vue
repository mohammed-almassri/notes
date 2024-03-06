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
                <span class="note-item-text">{{ item.title }}</span>
                <span class="note-item-description">
                    {{ item.description }}
                </span>
                <div v-if="item.image_url" class="note-item-image">
                    <img :src="item.image_url" />
                </div>
            </router-link>
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
            const colsPerRow = 2;
            //format notes
            const notes = this.notes.map((note, index) => {
                return {
                    i: note.id,
                    title: note.title,
                    description: note.description,
                    x: index % colsPerRow,
                    y: Math.floor(index / colsPerRow) * 2,
                    w: note.image_url ? 2 : 1,
                    h: note.image_url ? 4 : 2,
                    static: false,
                    image_url: note.image_url,
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
