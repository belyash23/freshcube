<template>
    <header>
        <nav>
            <RouterLink to="/">Выбор сделки</RouterLink>
            <RouterLink to="/history">История</RouterLink>
        </nav>
    </header>
</template>

<script>
export default {
    name: 'HeaderComponent',
    data: () => ({
        tab: null,
    }),
}
</script>

<style scoped>
header {
    height: 50px;
    border-bottom: 1px solid #cccccc;
}

nav {
    display: flex;
    margin-top: 20px;
    justify-content: center;
    font-size: 20px;
    gap: 20px;
}

a {
    position: relative;
}

a::before {
    content: "";
    position: absolute;
    display: block;
    width: 100%;
    height: 2px;
    bottom: 0;
    left: 0;
    background-color: #000;
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

a:hover::before {
    transform: scaleX(1);
}

.router-link-active {
    color: #3dd68c;
}
</style>
