<template>
    <i class="fa fa-user-plus float-right addf"
        v-on:click="addFriend()"></i>
</template>

<script>
    export default {
        props: ['myid', 'userid'],
        data() {
            return {}
        },
        methods: {
            addFriend: function() {
                var data = {
                    friend_id: this.userid,
                    user_id: this.myid
                }
                        axios.post('/friend', data).then((response) => {
                        return true;
                    })
                            .catch(err => res.json(err))
                }
        }
    }
</script>

<style>
    .addf {
        cursor: pointer;
        color: green
    }
</style>
