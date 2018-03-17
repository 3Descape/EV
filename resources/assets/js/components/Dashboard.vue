<template lang="html">
    <div>
        <div class="form-inline">
            <div class="form-group">
                <select ref="type" class="custom-select mr-2" v-model="type" @change="update">
                    <option value="year">Jahre</option>
                    <option value="month">Monate</option>
                    <option value="week">Wochen</option>
                    <option selected value="day">Tage</option>
                    <option value="hour">Stunden</option>
                    
                </select>
            </div>
            <div class="form-group">
                 <number-input @number-input="updateRange" :default="range" :min="2"/>
            </div>
        </div>
        <line-chart :chart-data="data" :options="options" class="chart"></line-chart>
    </div>
</template>

<script>
/* global axios */
import LineChart from "./LineChart.vue";
import NumberInput from "./NumberInput.vue";
export default {
  components: {
    "line-chart": LineChart,
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
    this.getData();
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
      var vue = this;
      axios
        .post("admin/getAnalythics", {
          type: this.$refs.type.value,
          range: this.range
        })
        .then(r => {
          vue.setData(r.data.values, r.data.keys);
        });
    },
    updateRange(value) {
      console.log(value);
      this.range = value;
      this.update();
    },
    update() {
      this.getData();
    }
  }
};
</script>
<style scoped>
.chart {
  max-width: 100%;
}
</style>
