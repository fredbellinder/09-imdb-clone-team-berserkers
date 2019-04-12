<template>
    <i class="fa fa-minus-circle float-right rmf"
        v-on:click="removeFriend()"></i>
</template>

<script>
    export default {
        props: ['myid', 'friendid'],
        data() {
            return {}
        },
        methods: {
            removeFriend: function() {
                var data = {
                    friend_id: this.friendid,
                    user_id: this.myid
                }
                console.log(this.friendid)
                        axios.delete('/friend', data).then((response) => {
                        console.log(response.data);
                    })
                            .catch(err => res.json(err))
                }
        }
    }
</script>

<style>
    .rmf {
        cursor: pointer;
        color: red
    }
</style>
