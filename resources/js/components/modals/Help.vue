<template>
    <div
    @click="checkHelp">
        <div class="position-fixed w-100 h-100 help-bg " ref="help_bg" style="top: 0; left: 0; background-color: #1a202c; z-index:1000; opacity: 0;"
             v-if="help_text !=''"/>
        <div class="position-fixed " ref="help_box" style="bottom: -30px; right: 0; z-index: 9999;">
            <v-autocomplete
                v-model="current_help"
                :items="help_articles"
                filled
                color="blue-grey lighten-2"
                label="Допомога"
                item-text="name"
                item-value="name"
                class="help-help-bar"
                style="width: 400px;"
                @change="tryhelp"
                @focus="help_step = 2; help(2)"
            >
                <template v-slot:item="data">
                    <template v-if="typeof data.item !== 'object'">
                        <v-list-item-content v-text="data.item"></v-list-item-content>
                    </template>
                    <template v-else>
                        <v-list-item-avatar>
                            <img :src="data.item.avatar">
                        </v-list-item-avatar>
                        <v-list-item-content>
                            <v-list-item-title v-html="data.item.name"></v-list-item-title>
                            <v-list-item-subtitle v-html="data.item.description"></v-list-item-subtitle>
                        </v-list-item-content>
                    </template>
                </template>
            </v-autocomplete>
            <v-card :class="`position-fixed rounded pa-2 bg-dark tooltip-card ${hide_tooltip ? '' : 'visible'}`"
                    @click="hide_tooltip = true"
                    v-if="current_help ==='Базове'"
                    ref="help_tooltip" style=" z-index:1002; color:white;right: 450px; bottom: 0; max-width: 400px; opacity: 0">
                <v-card-title v-html="help_text">{{help_text}}</v-card-title>
            </v-card>
        </div>

    </div>
</template>

<script>

export default {
    data () {
        return {
            current_help: 0,
            help_step: 0,
            ls: window.localStorage,
            help_text: '',
            hide_tooltip: false,
            help_articles: [
                { header: 'Ставки' },
                { name: 'Перша ставка', description: 'Вітаємо у світі бетінгу!', group: 'Ставки', avatar: 'https://eitrawmaterials.eu/wp-content/uploads/2016/09/person-icon.png'},
                { name: 'Базове', description: 'А що тут до чого?', group: 'Ставки', avatar: 'https://eitrawmaterials.eu/wp-content/uploads/2016/09/person-icon.png'},
                { divider: true },
                { header: 'Події' },
                { name: 'Власна подія!', description: 'Тепер ти – не просто гравець', group: 'Події', avatar: 'https://eitrawmaterials.eu/wp-content/uploads/2016/09/person-icon.png' },
            ]
        }
    },
    methods: {
        load() {
            let help = 0
            console.log(this.current_help)
            if(help != 1) {
                this.current_help = 'Базове'
                this.help_step = 1
                this.help();
            }
        },
        help() {
            console.log('dick')
            switch (this.current_help) {
                case 'Базове':
                    switch(this.help_step) {

                        case 1:
                            this.highlight('help_box')
                            this.help_text = "Вітаємо з реєстрацією на платформі!<br>Тепер запрошуємо тебе скористатися нашою зручною допомогою, що введе тебе в курс справ"
                            break

                        case 2:
                            this.help_text = "Ось приблизно так і працюватиме допомога. У рамках MVP це все, але далі буде більше ;)"
                            break
                    }
                    break
                case 'Перша ставка':
                    if(!window.location.href.indexOf("/bets")) {
                        window.location.href = '/bets'
                    }
                    break
                case 'Власна подія!':
                    if(!window.location.href.indexOf("/events")) {
                        window.location.href = '/events'
                    }
                    break
            }
        },
        highlight(ref) {
            this.$refs[ref].style.zIndex = '1001'
            this.$refs[ref].style.backgroundColor = 'white'
            this.$refs['help_bg'].classList.add('visible')
        },
        checkHelp() {
            if(this.help_step === 2) {
                this.help_step = 0
                this.$refs.help_bg.classList.remove('visible')
            }
        },
    },
    mounted() {
        this.load()
        console.log('suka')
        this.highlight('help_box')
    }
}
</script>

<style>
    .help-bg {
        transition: 1s;
        pointer-events: none;
        background-color: #1a202c;
    }
    .help-bg.visible {
        opacity: 50% !important;
        z-index: 1000;
        pointer-events: all;
    }
    .theme--light.v-text-field--filled > .v-input__control > .v-input__slot {
        background: rgba(0, 0, 0, 0.14) !important;
    }
    .visible {
        opacity: 100% !important;
    }
    .tooltip-card {
        transition: 2s;
    }
</style>
