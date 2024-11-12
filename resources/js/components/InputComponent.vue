<template>
    <slot></slot>
    <div class="error">{{this.error}}</div>
</template>

<script>
export default {
    name: "InputComponent",
    props: {
        error: String,
    }
}
</script>

<style scoped>
    .error {
        color: red;
        font-size: 14px;
    }
</style>
