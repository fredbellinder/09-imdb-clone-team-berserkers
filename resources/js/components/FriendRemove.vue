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
                axios.delete('/friend/'+this.friendid)
                .then((response) => {
                    window.location.reload();
                    return response;
                })
                .catch(err => console.log(err))
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
