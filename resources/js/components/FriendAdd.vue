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
                    if (response.data === 'error.addedbefore') {
                        return alert('You have added before!')
                    }
                    if (response.data === 'error.1') {
                            return alert('You cant add yourself');
                    }
                        window.location.reload();
                        return response;
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
