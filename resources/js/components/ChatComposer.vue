<template>
    <div class="panel-block field">
        <div class="control input-field">
            <input type="text" class="input" bg-light v-on:keyup.enter="sendChat" v-model="chat">
        </div>
        <div class="control auto-width">
            <input type="button" class="button bg-dark text-white" value="Send" v-on:click="sendChat">
        </div>
    <button class="bg-danger" v-on:click="clearChat">Clear</button>
    </div>
</template>

<script>
    export default {
        props: ['chats', 'userid', 'friendid'],
        data() {
            return {
                chat: ''
            }
        },
        methods: {
            sendChat: function(e) {
                if(this.chat != '') {
                    var data = {
                        chat: this.chat,
                        friend_id: this.friendid,
                        user_id: this.userid
                    }
                    this.chat = '';

                    axios.post('/chat/sendChat', data).then((response) => {
                            this.chats.push(data)
                        });
                }
            },
            clearChat: function() {
                axios.delete('/chat/'+ this.friendid)
                .then((response) => {
                    window.location.href = `/chat/${this.friendid}`;
                    return response.data;
                })
                .catch(err => console.log(err))
            }
        }
    }
</script>

<style scoped>
    .panel-block {
        display: flex;
        flex-direction: row;
        width: 100%;
        border: none;
        padding: 5px
    }
    .input-field {
        width: 100%;
    }
    input {
        border-radius: 0;
        width: 100%;
    }
    .auto-width {
        width: auto;
    }
</style>
