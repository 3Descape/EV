<template lang="html">
    <div>
        <div class="form-inline">
            <div class="form-group">
                <select ref="type" class="custom-select mr-2" @change="update">
                    <option value="year">Jahre</option>
                    <option value="month">Monate</option>
                    <option value="week">Wochen</option>
                    <option selected value="day">Tage</option>
                    <option value="hour">Stunden</option>
                </select>
            </div>
            <div class="form-group">
                <input class="form-control" ref="range" type="text" value="7" @change="update">
            </div>
        </div>
        <line-chart :chart-data="data" :options="options" class="chart"></line-chart>
    </div>
</template>

<script>
/* global axios */
import LineChart from "./LineChart.vue";
export default {
  components: {
    lineChart: LineChart
  },
  data() {
    return {
      data: {},
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          yAxes: [
            {
              ticks: {
                callback: function(value) {
                  if (value % 1 === 0) {
                    return value;
                  }
                },
                suggestedMax: 10
              }
            }
          ]
        }
      }
    };
  },
  mounted() {
    var vue = this;
    axios
      .post("admin/getAnalythics", {
        type: "day",
        range: 7
      })
      .then(function(r) {
        vue.setData(r.data.values, r.data.keys);
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
    update() {
      var vue = this;
      axios
        .post("admin/getAnalythics", {
          type: this.$refs.type.value,
          range: this.$refs.range.value
        })
        .then(r => {
          vue.setData(r.data.values, r.data.keys);
        });
    }
  }
};
</script>
<style scoped>
.chart {
  max-width: 100%;
}
</style>
