<template>
    <form action="">
        <InputComponent :error="fieldsErrors?.name?.at(0)">
            <label for="name">Имя контакта</label>
            <input id="name" type="text" v-model="name" required>
        </InputComponent>
        <InputComponent :error="fieldsErrors?.phone?.at(0)">
            <label for="phone">Телефон контакта</label>
            <input id="phone" type="text" v-model="phone" required>
        </InputComponent>
        <InputComponent :error="fieldsErrors?.comment?.at(0)">
            <label for="comment"> Комментарий</label>
            <input id="comment" type="text" v-model="comment" required>
        </InputComponent>

        <button @click.prevent="save()">Привязать</button>

        <div class="message" v-if="message">{{ message }}</div>
        <div class="error" v-if="error">{{ error }}</div>
    </form>
</template>

<script>

import {useRoute} from "vue-router";
import InputComponent from "./InputComponent.vue";

export default {
    name: "LinkContactComponent",
    components: {InputComponent},
    data() {
        return {
            name: '',
            phone: '',
            comment: '',
            fieldsErrors: {},
            message: '',
            error: '',
        }
    },
    methods: {
        save() {
            this.fieldsErrors = [];
            this.message = '';
            this.error = '';

            axios.post('/api/link-contact', {
                dealId: +this.route.params.id,
                name: this.name,
                phone: this.phone,
                comment: this.comment,
            }).then(result => {
                this.message = 'Контакт успешно привязан';
            }).catch(result => {
                console.log(result.response);
                if (result.response.data.errors) {
                    this.fieldsErrors = result.response.data.errors;
                } else {
                    this.error = 'Непредвиденная ошибка';
                }
            });
        },
    },

    setup() {
        const route = useRoute();

        return {
            route
        }
    }
}
</script>

<style scoped>
form {
    width: 200px;
    margin: 0 auto;
}
input {
    width: 100%;
    display: block;
    border: 1px solid #cccccc;
    outline: none;
    margin-bottom: 10px;
    height: 30px;
}

button {
    width: 100%;
    margin: 10px auto;
    background: #3dd68c;
    height: 35px;
    border-radius: 5px;
    transition: .5s;
}

button:hover {
    background: #31b776;
}

.error {
    color: red;
    font-size: 14px;
}

.message {
    color: green;
    font-size: 14px;
}
</style>
