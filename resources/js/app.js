import Achievements from "./mixins/Achievements";

require('./bootstrap');

window.Vue = require('vue');
import Vuetify from 'vuetify';
import { VApp } from "vuetify/lib";
import '@mdi/font/css/materialdesignicons.css'
import i18n from "./i18n";

Vue.component('achievements', require('./components/AchievementsComponent').default);
Vue.component('balance', require('./components/BalanceComponent').default);
Vue.component('events', require('./components/EventsComponent').default);
Vue.component('create-event', require('./components/CreateEventComponent').default);

Vue.component('help', require('./components/modals/Help').default);



Vue.use(Vuetify);
new Vue({
    mixins: [Achievements],
    i18n,
    vuetify : new Vuetify(),
    iconfont: 'mdi',
    components: {
        VApp
    },
}).$mount('#app');

