<template>
    <div class="bottom-menu">
        <router-link class="bottom-menu-item" to="/home">
            <img
                src="@/src/assets/img/icons/home.svg"
                class="bottom-menu-item-icon"
            />
            <span class="bottom-menu-item-title"> Home </span>
        </router-link>
        <router-link class="bottom-menu-item" to="/finished">
            <img
                src="@/src/assets/img/icons/clipboard-check.svg"
                class="bottom-menu-item-icon"
            />
            <span class="bottom-menu-item-title">Finished</span></router-link
        >
        <router-link class="bottom-menu-item bottom-menu-item-add" to="/add">
            +
        </router-link>
        <!-- this span only exists to take up space since the add item has absolute positioning-->
        <span></span>
        <router-link class="bottom-menu-item" to="/search">
            <img
                src="@/src/assets/img/icons/search.svg"
                class="bottom-menu-item-icon"
            />

            <span class="bottom-menu-item-title">Search</span>
        </router-link>
        <router-link class="bottom-menu-item" to="/settings">
            <img
                src="@/src/assets/img/icons/cog.svg"
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
