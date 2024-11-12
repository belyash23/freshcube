<template>
    <HeaderComponent></HeaderComponent>
    <main>
        <RouterView></RouterView>
    </main>
</template>

<script>
import HeaderComponent from "./HeaderComponent.vue";

export default {
    name: 'AppComponent',
    components: {HeaderComponent},
    data: () => ({
        tab: null,
    }),

    component: [HeaderComponent]
}
</script>

<style scoped>
main {
    width: 600px;
    margin: 10px auto;

}
</style>
