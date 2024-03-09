<template>
    <div class="task-list task-list-static">
        <div
            class="task-list-item"
            v-for="item in tasks.sort((a, b) => a.order - b.order)"
            :key="item.id"
        >
            <div class="task-list-item-content">
                <input
                    type="checkbox"
                    v-model="item.done"
                    tabindex="-1"
                    disabled="disabled"
                />
                <div class="task-list-item-title" :class="{ done: item.done }">
                    {{ item.title }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        tasks: {
            required: true,
            type: Array,
        },
    },
};
</script>
