<template>
  <datepicker :language="ja" :format="DatePickerFormat" :name="target" :value="value" :disabled-dates="disabledDates" :input-class="'form-control bg-white'" :typeable=true></datepicker>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import {ja} from 'vuejs-datepicker/dist/locale'
export default {
  components: {
    Datepicker
  },

  props: {
    target: String,
    value: String,
  },

  data() {
    // 除外日処理(前の日の除外) -1で前日を選択できてしまうのは時差の問題
    let date = new Date();
    date.setDate(date.getDate());

    return {
      DatePickerFormat: 'yyyy-MM-dd',
      ja: ja,
      disabledDates: {
        to: date,
        // days: [3],
      },
    }
  },
}
</script>

<style lang="scss">
.vdp-datepicker {
  .vdp-datepicker__calendar {
    span.sat {
      color: #3490dc;
    }

    span.sun {
      color: #e3342f;
    }
  }
}
</style>