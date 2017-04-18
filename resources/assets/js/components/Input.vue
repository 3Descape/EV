<template>
    <div>
      <input type="text" :value="msg" @input="changeMsg">
      <p>{{message}}</p>
    </div>
</template>

<script>
    export default {
        props:['msg'],
        mounted() {
            console.log('Component mounted.')
        },
        data(){
          return{
            message:''
          }
        },
        methods:{
          changeMsg(event){
            this.message = event.target.value;
            this.$emit('messageChanged', this.message);
          }
        }
    }
</script>
