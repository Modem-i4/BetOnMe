<template>
    <v-app>

        <v-card-title>
            <h2>Ставки</h2>
            <v-spacer></v-spacer>
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
                <BetCardComponent :item="item" @fetch="fetch"/>
            </template>
        </v-data-table>
    </v-app>
</template>

<script>
import DataTableCore from "../mixins/DataTableCore";
import BetCardComponent from "./modals/BetCardComponent";

export default {
    mixins: [DataTableCore],
    components: {BetCardComponent},
    data () {
        return {
            crudApiEndpoint: '/api/events'
        }
    },
    methods: {
    },
}
</script>

