<template>
    <div class="col-lg-12">
        <div class="form-inline">
            <div class="row mb-3 flex-grow-1 flex-md-grow-0">
                <div class="input-group">
                    <select ref="type" class="form-select text-center" v-model="type" @change="getData">
                        <option value="year">Jahre</option>
                        <option value="month">Monate</option>
                        <option value="week">Wochen</option>
                        <option selected value="day">Tage</option>
                        <option value="hour">Stunden</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3 mt-2 flex-grow-1 flex-md-grow-0">
                 <number-input @number-input="updateRange" :default="range" :min="2" />
            </div>
        </div>
        <div class="chart">
            <canvas id="dashboard-chart" ref="chart"></canvas>
        </div>
    </div>
</template>

<script>
/* global axios */
import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);

import NumberInput from "./NumberInput.vue";
export default {
  components: {
    "number-input": NumberInput
  },
  data() {
    return {
      range: 7,
      type: "day",
      data: {},
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            ticks: {
                callback: function(value) {
                    if (value % 1 === 0) {
                    return value;
                    }
                }
            },
            suggestedMax: 10
        }
        }
      }
    };
  },
  mounted() {
    this.getData();
    let ctx = this.$refs.chart.getContext("2d");
    let vue = this;
    window.chart = new Chart(ctx, {
      type: "line",
      data: vue.data,
      options: vue.options
    });
  },
  methods: {
    setData(data, labels) {
      this.data = {
        labels: labels,
        datasets: [
          {
            label: "Seitenaufrufe",
            data: data,
            lineTension: 0
          }
        ]
      };
    },
    getData() {
      axios
        .post("admin/getAnalytics", {
          type: this.$refs.type.value,
          range: this.range
        })
        .then(r => {
          this.setData(r.data.values, r.data.keys);
          window.chart.data = this.data;
          window.chart.update();
        });
    },
    updateRange(value) {
      this.range = value;
      this.getData();
    }
  }
};
</script>

<style scoped>
.chart {
  height: 50vh;
  min-height: 300px;
}
</style>
