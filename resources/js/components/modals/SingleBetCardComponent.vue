<template>
    <v-card @click="expanded = openable" :style="`transition: 1s;`">
        <div :style="`${expanded ? '' : 'display: none;'}`" class="row overflow-hidden bet-headers mx-0">
            <div class="col-5"></div>
            <div class="col-2 text-center">Ставка</div>
            <div class="col-1"></div>
            <div class="col-2">Коефіцієнт</div>
            <div class="col-2">Виграш</div>
            <v-icon class="position-absolute" style="right: 1%; top:5%;"
            @click.stop="expanded = false; betSum=0; setWinSum()"
            >mdi-close</v-icon>
        </div>
        <div class="d-flex single-bet-card">
            <div class="w-50">{{ item.title }}</div>
            <div :style="`width: ${expanded ? '25' : '0'}% !important`" class='w-0'>
                <v-text-field
                    v-if="expanded"
                    v-model="betSum"
                    hide-details
                    single-line
                    type="number"
                    title="Ставка"
                    class="mt-0 pt-0 ml-3 bet-sum-text-field"
                    min="0"
                    @input="setWinSum"
                />
            </div>
            <div class="text-right w-50" :style="`width: ${expanded ? '25' : '50'}% !important`"><span v-if="expanded">x</span>{{ item.coef }}</div>
            <div v-if="expanded" class="completeSum" :style="`width: ${expanded ? '25' : '0'}%`">
                {{Math.round(item.coef*betSum * 100) / 100}}
            </div>
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
        item: {},
        openable: true
    },
    methods: {
        setWinSum() {
            this.$emit('setWinSum', {value: Math.round((this.item.coef*this.betSum * 100) / 100), id: this.item.id, betSum: this.betSum})
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
