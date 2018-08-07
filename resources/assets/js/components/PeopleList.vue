<template>
    <div>

        <div class="row mt-3">
            <div class="col-lg-6 col-md-12 mb-2 px-md-0"
                 v-for="person in people"
                 :key="person.id">

                <div class="card mx-0 mx-lg-1 h-100">
                    <div class="card-body d-flex p-3">

                        <div class="mr-3"
                             v-if="person.image_path">
                            <img :src='"/storage/" + person.image_path'
                                 class="img-fluid"
                                 style="border-radius: 50%; max-width: 5em; height: auto;">
                        </div>
                        <div>
                            <h4 class="card-title mb-2"
                                style="font-weight: 500">{{person.name}}</h4>

                            <p class="card-text"
                               style="line-height: 1.4;"
                               v-if="person.description">{{person.description}}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
export default {
  props: {
    kategorie: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      category: this.kategorie,
      people: []
    };
  },
  mounted() {
    axios.post(`/people/${this.category}`).then(({ data: { people } }) => {
      this.people = people;
    });
  }
};
</script>
