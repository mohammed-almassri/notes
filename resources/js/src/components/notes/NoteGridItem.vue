<template>
    <router-link
        class="note-grid-item"
        :to="{ name: 'view', params: { id: note.id } }"
    >
        {{ note.title }}
    </router-link>
</template>

<script>
export default {
    name: "NoteGridItem",
    props: {
        note: {
            required: true,
        },
    },
};
</script>
