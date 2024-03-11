<template>
    <div class="bottom-menu">
        <router-link class="bottom-menu-item bottom-menu-item-add" to="/add">
            <img src="@/assets/img/icons/plus.svg" />
        </router-link>
        <!-- this span only exists to take up space since the add item has absolute positioning-->
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <router-link class="bottom-menu-item" to="/profile">
            <img
                src="@/assets/img/icons/cog.svg"
                class="bottom-menu-item-icon"
            />
            <span class="bottom-menu-item-title">Settings</span>
        </router-link>
    </div>
</template>

<script>
export default {
    name: "BottomMenu",
};
</script>
