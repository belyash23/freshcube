<template>
    <table>
        <thead>
        <tr>
            <th>Дата и время</th>
            <th>Действие</th>
            <th>Результат</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="action in actions">
            <td>{{action.formattedData.datetime}}</td>
            <td>{{action.formattedData.action}}</td>
            <td>{{action.formattedData.success}}</td>
        </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: "HistoryComponent",
    data() {
        return {
            actions: [],
            actionsMap: {
                link: 'Привязка контакта',
            }
        }
    },
    methods: {
        getFormattedDatetime(timestamp) {
            const date = new Date(timestamp * 1000);

            return `${date.getDate()}.${date.getMonth()}.${date.getFullYear()} ${date.getHours()}:${date.getMinutes()}`;
        },
    },
    created() {
        axios('/api/history').then(result => {
            const actions = result.data.data;

            actions.forEach(action => {
                action.formattedData = {}

                action.formattedData.action = this.actionsMap[action.action];
                action.formattedData.success = action.success ? 'Успешно' : 'Ошибка';
                action.formattedData.datetime = this.getFormattedDatetime(action.created_at);
            })
            console.log(actions);
            this.actions = actions;
        });
    }
}
</script>

<style scoped>
table {
    width: 600px;
}

td {
    text-align: center;
}

.link-contact {
    margin: 0 auto;
}


.disabled-link {
    opacity: 0.5;
    pointer-events: none;
    cursor: auto;
}
</style>
