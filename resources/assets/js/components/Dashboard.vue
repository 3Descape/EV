<template lang="html">
<div>
    <div class="form-inline">
        <div class="form-group">
          <select ref="type" class="form-control" @change="update">
            <option value="year">Jahre</option>
            <option value="month">Monate</option>
            <option value="week">Wochen</option>
            <option selected value="day">Tage</option>
            <option value="hour">Stunden</option>
          </select>
        </div>
        <div class="form-group">
            <input class="form-control" ref="range" type="number" value="7" @change="update">
        </div>
    </div>
    <chart :chartData="data" :options="options"></chart>
</div>
</template>

<script>
import Chart from './Chart.vue';
export default{
    components:{
        'chart': Chart,
    },
    data (){
        return{
            data: {},
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            callback: function(value) {
                                if (value % 1 === 0) {return value;}
                            },
                            suggestedMax: 10,
                        }
                    }]
                }
            },

            counter: 0,
        }
    },
    methods:{
        setData(data, labels){
            this.data = {
                labels: labels,
                datasets: [
                    {
                        label: 'Seitenaufrufe',
                        backgroundColor: '#f87979',
                        data: this.data,
                        borderWidth: 1,
                        lineTension: 0,
                        data: data
                    },
                ]
            }
        },
        update() {
            var vue = this;
            axios.post('admin/getAnalythics',{
                type: this.$refs.type.value,
                range: this.$refs.range.value,
            }).then(function(r){
                vue.setData(r.data.values, r.data.keys)
            });
        }
    },
    mounted(){
        var vue = this
        axios.post('admin/getAnalythics',{
            type: 'day',
            range: 7,
        }).then(function(r){
            vue.setData(r.data.values, r.data.keys)
        });
    }
}

</script>

<style lang="css">
</style>
