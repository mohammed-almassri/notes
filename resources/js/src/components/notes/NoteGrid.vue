<template>
    <div class="note-grid">
        <NoteGridItem v-for="note in notes" :key="note.id" :note="note">
        </NoteGridItem>
    </div>
</template>

<script>
import NoteGridItem from "./NoteGridItem.vue";
export default {
    components: { NoteGridItem },
    name: "NoteGrid",
    props: {
        notes: {
            required: true,
        },
    },
};
</script>
