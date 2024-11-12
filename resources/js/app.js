import './bootstrap';
import { createApp } from 'vue';
import AppComponent from "./components/AppComponent.vue";
import {createMemoryHistory, createRouter} from 'vue-router'
import DealsComponent from "@/components/DealsComponent.vue";
import LinkContactComponent from "@/components/LinkContactComponent.vue";
import HistoryComponent from "@/components/HistoryComponent.vue";

const app = createApp({});

app.component('AppComponent', AppComponent);

const routes = [
    {path: '/', component: DealsComponent},
    {path: '/link-contact/:id', component: LinkContactComponent},
    {path: '/history', component: HistoryComponent},
]
const router = createRouter({
    history: createMemoryHistory(),
    routes
});
app.use(router);

app.mount("#app")
