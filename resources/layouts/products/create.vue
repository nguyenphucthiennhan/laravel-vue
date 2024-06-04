<template>

    <TheHeader />
    <Create/>
    <router-view></router-view>
</template>
<script>
import TheHeader from "../../components/TheHeader.vue";
import Create from "../../components/admin/products/Create.vue";
import '../../css/admin-style.css';
export default {
    components: {
        TheHeader, Create
    }
}
</script>