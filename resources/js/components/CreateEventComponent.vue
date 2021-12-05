<template>
    <v-app>
        <help/>
        <div class="h1 text-center">Створи свою ставку!</div>
        <v-card class="bet-card">
            <v-card class="d-flex flex-no-wrap justify-space-between"
                    outlined color="transparent">
                <v-avatar class="ma-3" size="125" tile >
                    <v-img src="https://inlviv.in.ua/wp-content/uploads/2019/03/bf45bffcf7f060d0-640x336.jpg"></v-img>
                </v-avatar>
                <div class="mr-auto w-100">
                    <v-card-title class="text-h5 py-0">
                        <div class="col-md-11">
                        <v-text-field
                            v-model="item.title"
                            hide-details
                            single-line
                            title="Заголовок"
                            placeholder="Заголовок"
                            class="mt-0 pt-0 ml-3 bet-sum-text-field font-weight-bold"
                        /></div>
                    </v-card-title>
                    <v-card-subtitle class="mt-3">
                        <v-textarea
                            v-model="item.description"
                            title="Опис"
                            placeholder="Опис"
                            class="mt-0 pt-0 ml-3 bet-sum-text-field"
                        />
                    </v-card-subtitle>
                </div>
            </v-card>
            <div class="text-center h5 d-block">Дата розіграшу: <br>
                <datepicker class="mt-3 text-center" placeholder="Оберіть дату розіграшу" v-model="item.due_date" :disabled-dates="{to: new Date()}"/>
            </div>
            <div class="h5 text-center d-block">Ліміт: <br>
                <v-text-field
                    v-model="item.limit"
                    hide-details
                    single-line
                    type="number"
                    title="Коефіцієнт"
                    placeholder="Коефіцієнт"
                    class="mt-0 pt-0 ml-3 bet-sum-text-field"
                    min="1.01"
                />
            </div>
            <div class="h-100">
                <div class="p-2 mx-5">
                    <span>Ставка</span>
                    <span class="float-right">Коефіцієнт</span>
                </div>
                <CreateSingleBetCardComponent v-for="case_ in item.cases" :case_="case_" class="p-2 mx-5" key="id"
                @delete="deleteCase"/>
                <v-btn class="btn-block" @click="addItem">+</v-btn>
                <div><v-btn class="mx-auto d-block my-2"
                            :disabled="item.cases.length < 2 || item.cases[0].title.length < 3 || item.cases[1].title.length < 3
                             || item.title < 5 || item.description < 5 || item.due_date === null"
                            @click="save"
                >Опублікувати</v-btn></div>
            </div>
        </v-card>
        <PrevEvents/>
    </v-app>
</template>

<script>

import CreateSingleBetCardComponent from "./modals/CreateSingleBetCardComponent";
import Datepicker from 'vuejs-datepicker';
import PrevEvents from "./modals/PrevEvents";

export default {
    components: {CreateSingleBetCardComponent, Datepicker, PrevEvents},
    data () {
        return {
            item: {
                title: '',
                description: '',
                limit: 0,
                due_date: null,
                cases: []},
        }
    },
    methods: {
        save() {
            axios.post("/api/events", {
                title: this.item.title,
                description: this.item.description,
                limit: this.item.limit,
                due_date: this.item.due_date,
                cases: this.item.cases,
                balance: -this.item.limit
            })
                .then(response => {
                    window.location.reload();
                });
        },
        addItem() {
            this.item.cases.push({title:'', coef: 1.01})
            console.log(this.item)
        },
        deleteCase(case_) {
            this.item.cases = this.item.cases.filter(val => val !== case_);
        }
    }
}
</script>

<style>
.vdp-datepicker input {
    text-align: center;
    font-size: large;
}
</style>

