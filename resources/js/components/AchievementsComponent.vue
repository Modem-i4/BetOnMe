<template>
    <v-app>
        <help/>
        <v-btn @click="progressAchievement(1)" class="d-none">
            zbs
        </v-btn>
        <div :class="`position-fixed d-block w-100 h-100 help-box ${openInfo ? 'opacity-100' : 'opacity-0'}`" style="left:0;top:0;z-index: 1001;opacity: 0"
        @click="openInfo = false">
            <div class="position-absolute w-100 h-100 bg-dark" style="opacity: 70%"/>
            <v-card-title class="mx-auto w-50 d-table text-white" style="margin-top: 10%; z-index: 1005; position: relative;">

                <div class="rounded-circle overflow-hidden mx-auto achievement-img" :style="`
                    ${currentAchievement.progress > 0 ? 'border: 5px solid yellowgreen;' : ''}
                    cursor: pointer;`">
                    <v-img :src="`/images/achievements/${currentAchievement.image}`"

                /></div>
                <div class="text-center d-block w-100 h1 font-weight-bold">{{currentAchievement.title}}</div>
                <div class="text-center d-block w-100 h2">{{currentAchievement.description}}</div>
                <div class="text-center d-block w-100 h2" v-if="currentAchievement.progress > 0">
                    {{currentAchievement.congratulation}}
                </div>
            </v-card-title>
        </div>
        <div class="d-flex justify-space-around flex-wrap">
            <div class="mb-2" v-for="achievement in achievements"
                @click="openAchievement(achievement)">
                <div class="rounded-circle" :style="`height:200px;width:200px;
                ${achievement.progress > 0 ? 'border: 5px solid yellowgreen;' : ''}
                z-index: 1000; cursor: pointer; background-image: url(/images/achievements/${achievement.image});
                    background-position: center; background-size: cover;`" />
                <v-card-title style="width: 200px" class="text-center d-block">{{achievement.title}}</v-card-title>
            </div>
        </div>
    </v-app>
</template>

<script>

    import Achievements from "../mixins/Achievements";
    import DataTableCore from "../mixins/DataTableCore";

    export default {
        data () {
            return {
                achievements: [],
                userAchievements: [],
                openInfo: false,
                currentAchievement: {}
            }
        },
        mixins: [Achievements, DataTableCore],
        methods: {
            getAchievements () {
                axios.get('/api/achievements')
                    .then(result => {
                        let achievements = result.data
                        achievements.forEach(function (item) {
                            item.progress = 0
                        });
                        console.log(achievements)
                        this.userAchievements.forEach(function (achieved) {
                            achievements.forEach(function (item) {
                                if(item.id === achieved.id) {
                                    item.progress = achieved.progress
                                }
                            });
                        });
                        this.achievements = achievements;
                        console.log(achievements)
                    })
            },
            getUserAchievements () {
                axios.get('/api/user/achievements')
                    .then(result => {
                        this.userAchievements = result.data.achievements
                        this.getAchievements()
                    })
            },
            openAchievement(achievement) {
                this.openInfo = true
                this.currentAchievement = achievement
                console.log(achievement)
            }
        },
        mounted() {
            this.getUserAchievements()
        }
    }
</script>
<style>
.opacity-100 {
    opacity: 100% !important;
}
.opacity-0 {
    opacity: 0 !important;
    pointer-events: none;
}
.help-box {
    transition: 0.5s;
}

.achievement-img {
    width: 200px;
    height: 200px;
}

@media screen and (min-width: 800px) {
    .achievement-img {
        width: 350px;
        height: 350px;
    }
}
</style>
