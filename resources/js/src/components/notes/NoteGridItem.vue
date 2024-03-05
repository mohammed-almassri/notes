<template>
    <grid-item>
        <router-link
            class="note-grid-item"
            :to="{ name: 'view', params: { id: note.id } }"
        >
            {{ note.title }}
        </router-link>
    </grid-item>
</template>

<script>
import { GridItem } from "vue3-grid-layout-next";

export default {
    name: "NoteGridItem",
    components: { GridItem },
    props: {
        note: {
            required: true,
        },
    },
};
</script>
