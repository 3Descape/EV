<script>
import myDatepicker from './vue-datepicker'
var date = new Date()
export default {
  props:{
    starttime: {
        default: function () {
          return { time: String(date.getFullYear())+'-'+String(date.getMonth())+'-'+String(date.getDate()) }
        }
    },

  },
  data () {
    return {
      endtime: {
        time: ''
      },
      option: {
        type: 'day',
        week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
        month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        format: 'YYYY-MM-DD',
        placeholder: 'YYYY-MM-DD',
        inputStyle: {
          'display': 'block',
          'width': '100%',
          'padding': '0.5rem 0.75rem',
          'font-size': '1rem',
          'line-height': '1.25',
          'color': '#464a4c',
          'background-color': '#fff',
          'background-image': 'none',
          'background-clip': 'padding-box',
          'border': '1px solid rgba(0, 0, 0, 0.15)',
          'border-radius': '0.25rem',
          'transition': 'border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s',
        },
        color: {
          header: '#ccc',
          headerText: '#f00'
        },
        buttons: {
          ok: 'Ok',
          cancel: 'Cancel'
        },
        overlayOpacity: 0.5, // 0.5 as default
        dismissible: true // as true as default
      },
      timeoption: {
        type: 'min',
        week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
        month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        format: 'YYYY-MM-DD HH:mm'
      },
      multiOption: {
        type: 'multi-day',
        week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
        month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        format:"YYYY-MM-DD HH:mm"
      },
      limit: [{
        type: 'weekday',
        available: [1, 2, 3, 4, 5]
      },
      {
        type: 'fromto',
        from: '2016-02-01',
        to: '2016-02-20'
      }]
    }
  },
  components: {
    'date-picker': myDatepicker
  }
}
</script>
<template>
  <div class="">
    <date-picker :date="starttime" :option="option"></date-picker>
  </div>

</template>
