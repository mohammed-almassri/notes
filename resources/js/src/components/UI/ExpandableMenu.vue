<template>
    <div class="expandable-menu" :class="{ expanded }">
        <button @click="onExpandClicked" class="expandable-menu-expand-button">
            <img src="@/assets/img/icons/plus.svg" />
        </button>
        <div
            class="expandable-menu-menu"
            ref="menuRef"
            :style="{
                top: menuTopPosition,
            }"
        >
            <button
                class="expandable-menu-option"
                v-for="option in options"
                :key="option.value"
                @select="() => $emit('select', option.value)"
            >
                <img :src="option.image" />
                <span>{{ option.title }}</span>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        options: {
            required: true,
            type: Array,
        },
    },
    emits: ["select"],
    data() {
        return {
            expanded: false,
            menuTopPosition: 0,
        };
    },
    methods: {
        onExpandClicked() {
            this.expanded = !this.expanded;
            this.$nextTick(() => {
                //calculate the size of the menu and set the top position
                const menu = this.$refs.menuRef;
                const menuHeight = menu.clientHeight;
                console.log(menuHeight);
                this.menuTopPosition = `-${menuHeight + 10}px`;
            });
        },
    },
};
</script>

<style></style>
