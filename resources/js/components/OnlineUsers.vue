<template>
    <div class="float-right">
        <i class="fa fa-male green" v-if="checkUser()"></i>
        <i class="fa fa-bed red" v-else></i>

    </div>
</template>

<script>
    export default {
        props: ['friend', 'onlineusers'],
        methods: {
            checkUser: function () {
                return _.find(this.onlineusers, {id: this.friend.id});
            }
        }
    }
</script>

<style>
    .red {
        color: red;
    }
    .green {
        color: green;
    }
</style>
