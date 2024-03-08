<template>
    <div class="task-list task-list-static">
        <div class="task-list-item" v-for="item in tasks" :key="item.id">
            <div class="task-list-item-content">
                <div class="task-list-item-title">
                    <input
                        type="checkbox"
                        v-model="item.checked"
                        tabindex="-1"
                    />
                    <div>
                        {{ item.title }}
                    </div>
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
