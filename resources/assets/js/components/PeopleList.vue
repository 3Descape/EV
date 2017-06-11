<template>

<div class="row" id="personen">

    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 py-2" v-for="person in people">
      <div class="card">
        <div class="card-block">
          <h4 class="card-title">{{person.name}}</h4>
          <p class="card-text">{{person.description}}</p>
        </div>
      </div>
    </div>
</div>
</template>

<script>
    export default {
        props:['id'],
        data () {
            return{
                people: {},
            }
        },
        mounted() {

            console.log('People list mounted')
        },
        created: function (){
          var vue = this;
          axios.get('/api/people/' + vue.id)
          .then(function (response) {
            vue.people = response.data;
          })
          .catch(function (error) {
            console.log(error);
          });
        }
    }
</script>
