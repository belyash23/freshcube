<template>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Дата создания</th>
                <th>Есть контакт</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="deal in deals">
                <td>{{deal.formattedData.id}}</td>
                <td>{{deal.formattedData.name}}</td>
                <td>{{deal.formattedData.created_at}}</td>
                <td>{{deal.formattedData.has_contact}}</td>
                <td>
                    <RouterLink :to="`/link-contact/${deal.id}`" :class="{'disabled-link': deal.has_contact}">
                        <img src="../../images/link.png" alt="" :class="{'link-contact': true, 'link-contact_disabled': deal.has_contact}">
                    </RouterLink>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: "DealsComponent",
    data() {
        return {
            deals: [],
        }
    },
    methods: {
        getFormattedDate(timestamp) {
            const date = new Date(timestamp * 1000);

            return `${date.getDate()}.${date.getMonth()}.${date.getFullYear()}`;
        },
    },
    created() {
        axios('/api/deals').then(result => {
            const deals = result.data.data;

            deals.forEach(deal => {
                deal.formattedData = {}

                deal.formattedData.id = deal.id
                deal.formattedData.name = deal.name
                deal.formattedData.created_at = this.getFormattedDate(deal.created_at);
                deal.formattedData.has_contact = deal.has_contact ? 'Да' : 'Нет';
            })
            console.log(deals);
            this.deals = deals;
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
