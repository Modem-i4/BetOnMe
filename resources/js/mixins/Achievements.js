
export default {
    data() {
        return {

        }
    },
    methods: {
        progressAchievement(id) {
            console.log("durnev")
            axios.patch('/api/user/achievement/progress', {id: id})
                .then(function (response) {
                    console.log(response)
                })
        }
    }
}
