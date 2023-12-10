<template>
    <loading :active.sync="isLoading" color="#06f" :height="145" :width="165" loader="dots" :is-full-page="true"></loading>
</template>
<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
export default {
    name: "LoaderSpinner",
    props: {
        isLoading: Boolean,
    },
    components: {
        Loading,
    },
};
</script>
