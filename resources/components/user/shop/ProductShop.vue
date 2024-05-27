<template>
    <div class="section trending">
        <div class="container">
            <ul class="trending-filter">
                <li>
                    <a class="is_active" href="#!" data-filter="*">Show All</a>
                </li>
                <li>
                    <a href="#!" data-filter=".adv">Adventure</a>
                </li>
                <li>
                    <a href="#!" data-filter=".str">Strategy</a>
                </li>
                <li>
                    <a href="#!" data-filter=".rac">Racing</a>
                </li>
            </ul>
            <Product />
         
            <Page/>
        </div>
    </div>

</template>
<script>
import Product from "./ProductItem.vue";
import Page from "./Pagination.vue";
export default {
    components: {
        Product,Page
    }
};
</script>