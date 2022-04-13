<template>
    <div class="input-group"
         style="max-width: 100%">
        <div @click="decrement" class="input-group-text">
            <i class="fa fa-minus"></i>
        </div>

        <input class="form-control"
               v-model="tempValue"
               :name="fieldName"
               :min="min"
               :max="max"
               :step="step"
               @change="setValue"
               @keydown.esc="tempValue = currentValue"
               @keydown.up.prevent="increment"
               @keydown.down.prevent="decrement"
               type="number">

        <div @click="increment" class="input-group-text">
            <i class="fa fa-plus"></i>
        </div>
    </div>
</template>

<script>
export default {
  props: {
    default: {
      type: Number,
      default: 0,
      required: false
    },
    min: {
      type: Number,
      default: -Infinity,
      required: false
    },
    max: {
      type: Number,
      default: Infinity,
      required: false
    },
    step: {
      type: Number,
      default: 1,
      required: false
    },
    fieldName: {
      type: String,
      required: false
    }
  },
  data() {
    return {
      currentValue: this.default,
      tempValue: this.default,
      timeOut: null
    };
  },
  methods: {
    setValue(val) {
      this._updateValue(val.target.value);
    },
    increment() {
      let newVal = this.currentValue + 1 * this.step;
      this._updateValue(newVal);
    },
    decrement() {
      let newVal = this.currentValue + -1 * this.step;
      this._updateValue(newVal);
    },
    _updateValue(newVal) {
      const oldVal = this.currentValue;
      if (typeof newVal === "string") {
        newVal = Number(newVal);
      }
      if (oldVal === newVal) {
        console.log("same");
        return;
      }
      if (newVal <= this.min) {
        newVal = this.min;
      }
      if (newVal >= this.max) {
        newVal = this.max;
      }
      if (newVal !== this.currentValue) {
        clearTimeout(this.timeOut);
        this.timeOut = setTimeout(
          function() {
            this.$emit("number-input", newVal);
          }.bind(this),
          300
        );
      }
      this.tempValue = newVal;
      this.currentValue = newVal;
    }
  }
};
</script>
<style scoped>
input[type="number"] {
  text-align: center;
  -moz-appearance: textfield;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  /* display: none; <- Crashes Chrome on hover */
  -webkit-appearance: none;
  margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
}
</style>
