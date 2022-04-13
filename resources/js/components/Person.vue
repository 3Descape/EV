<template>
    <div class="card mb-1" v-if="person">
        <div class="card-body">
            <div class="d-flex">
                <div class="d-flex align-items-center justify-content-center me-3" v-if="person.category.has_image">
                    <img v-if="person.image_path" :src="'/storage/' + person.image_path" :alt="person.name" class="rounded-circle" style="height: 3rem; width: 3rem">
                    <!-- <img v-else :src="'/storage/' + person.image_path" class="rounded-circle" style="height: 2rem; width: 2rem"> -->
                    <div style="height: 3rem; width: 3rem" v-else>
                        <i class="fa fa-circle-user" style="font-size: 3rem"></i>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="row d-flex h-100 align-items-center">
                        <h5 class="col-md-4 mb-0">
                            {{person.name}}
                        </h5>

                        <p class="col-md-4 mb-0"><i class="fa fa-square-envelope fa-lg"></i> {{person.email}}</p>
                        <p class="col-md-4 mb-0"><i class="fa fa-square-phone fa-lg"></i> {{person.email}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        person: {
            required: true
        }
    },
}
</script>