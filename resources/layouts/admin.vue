<template>

<TheHeader/>
    <Chart/>
    <Chart1/>
    <router-view></router-view>
</template>
<script>
import TheHeader from "../components/TheHeader.vue";
import Chart from "../components/admin/home/Chart.vue";
import Chart1 from "../components/admin/home/Chart1.vue";
import '../css/admin-style.css';
export default {
    components: {
        TheHeader,Chart,Chart1
    }
}
</script>