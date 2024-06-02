<template>

<TheHeader/>

    <router-view></router-view>
</template>
<script>
import TheHeader from "../components/TheHeader.vue";
import '../css/admin-style.css';
export default {
    components: {
        TheHeader
    }
}
</script>