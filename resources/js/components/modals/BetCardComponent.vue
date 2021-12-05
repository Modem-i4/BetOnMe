<template>
    <v-card
    :max-height="expanded ? '500px' : '150px'" class="bet-card overflow-hidden">
        <v-card class="d-flex flex-no-wrap justify-space-between"
                outlined color="transparent"
             @click="expanded = !expanded;">
            <v-avatar class="ma-3" size="125" tile >
                <!--:src="item.image"-->
                <v-img src="https://inlviv.in.ua/wp-content/uploads/2019/03/bf45bffcf7f060d0-640x336.jpg"></v-img>
            </v-avatar>
            <div class="mr-auto w-100">
                <v-card-title class="row py-0">
                    <div class="col-md-10">{{item.title}}</div>
                    <div class="col-md-2 h5 text-center d-md-flex d-none text-muted mb-0 pb-0 mt-3"
                         title="Ліміт івенту"
                    ><v-icon small>mdi-format-vertical-align-top</v-icon>{{item.sum_limit-win_sum}} грн.</div>
                </v-card-title>
                <v-card-subtitle class="row py-0">
                    <div class="col-md-10">{{item.description}}</div>
                    <div class="col-md-2 h5 text-center d-md-flex d-none"
                         title="Час до події"
                         style="max-height: 43px"
                    ><v-icon small>mdi-clock</v-icon>{{results_in}}</div>
                </v-card-subtitle>
            </div>
            <v-btn class="position-absolute" style="right:35px;top:100px" fab icon height="40px" right width="40px">
                <v-icon>mdi-arrow-down-drop-circle</v-icon>
            </v-btn>
        </v-card>
        <div class="h5 text-center d-md-none row text-muted">
            <div class="col-md-2 h5 text-center d-md-none d-flex col-6 mx-auto"
                 title="Ліміт івенту"
            ><div class="mx-auto"><v-icon small>mdi-format-vertical-align-top</v-icon>{{item.sum_limit-win_sum}} грн.</div></div>
            <div class="col-md-2 h5 text-center d-md-none d-flex col-6"
                 title="Час до події"
            ><div class="mx-auto"><v-icon small>mdi-clock</v-icon>{{results_in}}</div></div>
        </div>
        <div class="h-100" :style="`'height: ${expanded ? 100 : 0}%`">
            <div class="p-2 mx-5">
                <span>Назва</span>
                <span class="float-right">Коефіцієнт</span>
            </div>
            <SingleBetCardComponent v-for="case_ in item.cases" :item="case_" class="p-2 mx-5" key="id" openable="true"
            @setWinSum="setWinSum"/>
            <div><v-btn class="mx-auto d-block my-2" :disabled="win_sum === 0 || item.sum_limit-win_sum < 0"
            @click="send"
            >Ставимо!</v-btn></div>
        </div>
    </v-card>
</template>

<script>

import SingleBetCardComponent from "./SingleBetCardComponent";

export default {
    data () {
        return {
            expanded: false,
            user_bets: [],
            user_bets_deposits: [],
            win_sum: 0,
            bet_sum: 0,
            results_in: ''
        }
    },
    components: {
        SingleBetCardComponent
    },
    props: {
        item: {}
    },
    methods: {
        setWinSum(item) {
            this.user_bets[item.id] = item.value
            this.user_bets_deposits[item.id] = item.betSum
            let sum = 0
            let betSum = 0
            console.log(this.user_bets_deposits)
            this.user_bets.forEach(function (itm) {
                sum += +itm
            })
            this.user_bets_deposits.forEach(function (itm) {
                betSum += +itm
            })
            this.bet_sum = betSum
            this.win_sum = sum
        },
        send() {
            this.user_bets = this.user_bets.filter(n => n)
            axios.post("/api/bets", {
                event_id: this.item.id,
                cases: this.user_bets,
                new_limit: Math.ceil(this.item.sum_limit-this.win_sum),
                balance: -this.bet_sum
            })
                .then(response => {
                    window.location.reload();
                });
        }
    },
    mounted() {
        console.log(this.item)
        let time_in_ms = (new Date(`2021,${this.item.due_date}`) - new Date())
        let time_in_days = Math.floor(time_in_ms / (1000 * 60 * 60 * 24))
        this.results_in = time_in_days >= 1 ? time_in_days + " днів" :
            Math.floor(time_in_ms / (1000 * 60 * 60 )) + ":" + Math.floor(time_in_ms / (1000 * 60)%60)
        console.log(Math.floor(time_in_ms / (1000 * 60 * 60 )) + ":" + Math.floor(time_in_ms / (1000 * 60)%60))

        this.item.cases.forEach(function (itm, idx) {
            itm.id = idx
        })
    }
}
</script>

<style>
.bet-card {
    transition: 1s;
}
</style>
