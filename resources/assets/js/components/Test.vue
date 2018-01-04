<template>
  <div class="text-center" v-cloak>
      <img v-if="state" :src="path" :class="[classes,'img-fluid']">
  </div>
</template>
<script>
export default {
  props:{
      url: {
          default: '',
          type: String
      }, 
      id: {
          default: -1,
      },
      classes: [String]
      },
  data: ()=>{
      return {
          image: {},
          state: false,
      }
  },
  computed: {
      path: function(){
          return "/storage/" + this.image.path;
      }
  },
  mounted: function(){
      if(this.url !== ''){
          this.image.path = this.url;
      }else{
        let vue = this;
        axios.post("/images/" + this.id)
        .then((data)=>{
            vue.image = data.data.image
            vue.state = true;
        });
      }


  }
}
</script>
