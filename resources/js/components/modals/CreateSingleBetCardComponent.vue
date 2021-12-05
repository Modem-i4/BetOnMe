<template>
    <v-card>
        <div class="d-flex single-bet-card">
            <div class="w-75 d-flex">
                <v-icon @click="$emit('delete',case_)">mdi-close</v-icon>
                <v-text-field
                    v-model="case_.title"
                    hide-details
                    single-line
                    title="Ставка"
                    class="mt-0 pt-0 ml-3 bet-sum-text-field"
                    @input="loadBet"
                /></div>
            <div class="w-25">

                <v-text-field
                    v-model="case_.coef"
                    hide-details
                    single-line
                    type="number"
                    title="Коефіцієнт"
                    class="mt-0 pt-0 ml-3 bet-sum-text-field"
                    min="1"
                    @input="loadBet"
                /></div>

        </div>
    </v-card>
</template>

<script>

export default {
    data () {
        return {
            expanded: false,
            betSum: 0,
        }
    },
    props: {
        case_: {}
    },
    methods: {
        loadBet() {
            this.$emit('setWinSum', {title: this.case_.title, coef: this.case_.coef})
        }
    }
}
</script>

<style>
.single-bet-card > div{
    transition: 1s;
}
.completeSum {
    width: 0;
    text-align: center;
}
.w-33 {
    width: 33%
}
.bet-headers {
    transition: 1s;
}
.bet-sum-text-field input {
    text-align: center;
}
</style>
