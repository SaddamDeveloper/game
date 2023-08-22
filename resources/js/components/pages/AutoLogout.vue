<template>
  <div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            events: [ 'click', 'mousemove', 'mousedown', 'scroll', 'keypress', 'load'],
            warningTimer: null,
            logoutTimer: null,
        }
    },
    mounted() {
        this.events.forEach((event)=>{
            window.addEventListener(event, this.resetTimer);
        }, this);

        this.setTimers();
    },
    destroyed() {
         this.events.forEach((event)=>{
            window.removeEventListener(event, this.resetTimer);
        }, this);

        this.resetTimer();
    },
    methods: {
        setTimers(){
            this.warningTimer = setTimeout(this.warningMessage, 14 * 60 * 1000);
            this.logoutTimer = setTimeout(this.logoutUser, 15 * 60 * 1000);
        },
        warningMessage(){
            const title = 'Session Warning!';
            const content = '<p>Are you still with us?</p>';
            this.$Modal.warning({
                title: title,
                content: content,
                okText: 'Yes'
            });
        },
        logoutUser(){
            const origin = window.location.origin;
            window.location.replace(origin+"/user/logout/")
        },
        resetTimer(){
            clearTimeout(this.warningTimer);
            clearTimeout(this.logoutTimer);
            this.setTimers();
        }
    }
}
</script>