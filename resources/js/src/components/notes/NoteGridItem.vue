<template>
    <div class="note-grid-item">
        {{ note.title }}
    </div>
</template>

<script>
import Note from "@/src/models/Note.js";
export default {
    name: "NoteGridItem",
    props: {
        note: {
            required: true,
            type: Note,
        },
    },
};
</script>
