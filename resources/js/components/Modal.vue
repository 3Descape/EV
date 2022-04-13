<template>
    <div class="modal fade" :id="id" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <slot />
            </div>
        </div>
    </div>
</template>

<script>
export default {
  props: {
    id: {
      type: String,
      required: true
    }
  }
};
</script>
