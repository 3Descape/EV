<template>
    <div class="chart" >
        <canvas ref="canvas"></canvas>
    </div>
</template>

<script>
export default {
}
</script>

<style lang="css">
</style>

<script>
import { Line, mixins } from 'vue-chartjs'
const { reactiveProp } = mixins

export default Line.extend({
  mixins: [reactiveProp],
  props: ['options'],
  mounted () {
    // this.chartData is created in the mixin
    this.renderChart(this.chartData, this.options)
  }
})
</script>
<style media="screen">
    div{
        max-width: 100%;
    }
</style>
