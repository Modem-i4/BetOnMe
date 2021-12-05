<template>
    <v-app>
        <div class="h2 text-center mt-5">Попередні ставки</div>
        <v-card-title>
            <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Пошук"
                single-line
                hide-details
                clearable
                autocomplete="nope"
            ></v-text-field>
        </v-card-title>
        <v-data-table
            :footer-props="footerOptions"
            :headers="headers"
            :items.sync="items"
            :options.sync="options"
            :server-items-length="pagination.total"
            :loading="loading"
            :search="search"
            item-key="id"
        >
            <template #item="{ item }">
                <EventCardComponent :item="item"/>
            </template>
        </v-data-table>
    </v-app>
</template>

<script>

import DataTableCore from "../../mixins/DataTableCore";
import EventCardComponent from "./EventCardComponent";

export default {
    mixins: [DataTableCore],
    components: {EventCardComponent},
    data () {
        return {
            crudApiEndpoint: '/api/events/own'
        }
    },
    methods: {
    },
}
</script>

