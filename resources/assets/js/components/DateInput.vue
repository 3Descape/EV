<template>
    <div class="w-100">
        <div class="d-flex">
            <div class="d-flex flex-column pr-1 flex-fill">
                <p>Tag:</p>
                <button @click="addDay()"
                        type="button"
                        tabindex="-1"
                        class="btn btn-add">
                    <i class="fa fa-plus"></i>
                </button>
                <input class="form-control text-center rounded-0"
                       type="text"
                       v-model="date.day"
                       @keydown.up="addDay()"
                       @keydown.down="subDay()"
                       @change="validateDate()">
                <button @click="subDay()"
                        type="button"
                        tabindex="-1"
                        class="btn btn-sub">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
            <div class="d-flex flex-column px-1 flex-fill">
                <p>Monat:</p>
                <button @click="addMonth()"
                        type="button"
                        tabindex="-1"
                        class="btn btn-add">
                    <i class="fa fa-plus"></i>
                </button>
                <input class="form-control text-center rounded-0"
                       type="text"
                       v-model="date.month"
                       @keydown.up="addMonth()"
                       @keydown.down="subMonth()"
                       @change="validateDate()">
                <button @click="subMonth()"
                        type="button"
                        tabindex="-1"
                        class="btn btn-sub">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
            <div class="d-flex flex-column px-1 flex-fill">
                <p>Jahr:</p>
                <button @click="addYear()"
                        type="button"
                        tabindex="-1"
                        class="btn btn-add">
                    <i class="fa fa-plus"></i>
                </button>
                <input class="form-control text-center rounded-0"
                       type="text"
                       v-model="date.year"
                       @keydown.up="addYear()"
                       @keydown.down="subYear()"
                       @change="validateDate()">
                <button @click="subYear()"
                        type="button"
                        tabindex="-1"
                        class="btn btn-sub">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
            <div class="d-flex flex-column px-1 flex-fill ml-4">
                <p>Stunde:</p>
                <button @click="addHour()"
                        type="button"
                        tabindex="-1"
                        class="btn btn-add">
                    <i class="fa fa-plus"></i>
                </button>
                <input class="form-control text-center rounded-0"
                       type="text"
                       v-model="date.hour"
                       @keydown.up="addHour()"
                       @keydown.down="subHour()"
                       @change="validateDate()">
                <button @click="subHour()"
                        type="button"
                        tabindex="-1"
                        class="btn btn-sub">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
            <div class="d-flex flex-column pl-1 flex-fill">
                <p>Minute:</p>
                <button @click="addMinute()"
                        type="button"
                        tabindex="-1"
                        class="btn btn-add">
                    <i class="fa fa-plus"></i>
                </button>
                <input class="form-control text-center rounded-0"
                       type="text"
                       v-model="date.minute"
                       @keydown.up="addMinute()"
                       @keydown.down="subMinute()"
                       @change="validateDate()">
                <button @click="subMinute()"
                        type="button"
                        tabindex="-1"
                        class="btn btn-sub">
                    <i class="fa fa-minus"></i>
                </button>
            </div>

            <input class="form-control"
                   type="text"
                   :value="result"
                   hidden
                   :name="name">
        </div>
        <transition name="show">
            <div class="alert alert-danger mt-2"
                 role="alert"
                 v-show="error">
                <strong>Kein gültiges Datum!</strong>
            </div>
        </transition>
    </div>
</template>
<script>
export default {
  props: ["name", "default"],
  data: () => {
    return {
      date: {
        day: "",
        month: "",
        year: "",
        hour: "",
        minute: ""
      },
      error: false
    };
  },
  computed: {
    result: function() {
      return `${this.formatDate(this.date.day)}.${this.formatDate(
        this.date.month
      )}.${this.date.year} ${this.formatDate(this.date.hour)}:${this.formatDate(
        this.date.minute
      )}`;
    }
  },
  methods: {
    addDay() {
      this.date.day++;
      this.validateDate();
    },
    subDay() {
      this.date.day--;
      this.validateDate();
    },
    addMonth() {
      this.date.month++;
      this.validateDate();
    },
    subMonth() {
      this.date.month--;
      this.validateDate();
    },
    addYear() {
      this.date.year++;
      this.validateDate();
    },
    subYear() {
      this.date.year--;
      this.validateDate();
    },
    addHour() {
      this.date.hour++;
      this.validateDate();
    },
    subHour() {
      this.date.hour--;
      this.validateDate();
    },
    addMinute() {
      this.date.minute++;
      this.validateDate();
    },
    subMinute() {
      this.date.minute--;
      this.validateDate();
    },
    formatDate: function(value) {
      return `0${value}`.slice(-2);
    },
    validateDate() {
      if (this.date.minute >= 60 || this.date.minute < 0) {
        if (this.date.minute >= 60) {
          this.date.minute = 0;
          this.date.hour++;
        } else {
          this.date.minute = 59;
          this.date.hour--;
        }
      }

      if (this.date.hour > 23 || this.date.hour < 0) {
        if (this.date.hour > 23) {
          this.date.hour = 0;
          this.date.day++;
        } else {
          this.date.hour = 23;
          this.date.day--;
        }
      }

      if (this.date.day > 31 || this.date.day < 1) {
        if (this.date.day > 31) {
          this.date.day = 1;
          this.date.month++;
        } else {
          this.date.day = 31;
          this.date.month--;
        }
      }

      if (this.date.month > 12 || this.date.month < 1) {
        if (this.date.month > 12) {
          this.date.month = 1;
          this.date.year++;
        } else {
          this.date.month = 12;
          this.date.year--;
        }
      }

      let d = Date.parse(
        `${this.date.year}-${this.date.month}-${this.date.day}`
      );

      if (!d) {
        this.error = true;
      } else {
        this.error = false;
      }

      this.$emit("date", this.result);
    },
    reverseString: function(str) {
      return str
        .split("")
        .reverse()
        .join("");
    }
  },
  mounted() {
    let datetime;
    if (this.default) {
      datetime = new Date(Date.parse(this.default));
    } else {
      datetime = new Date();
    }

    this.date = {
      day: datetime.getDate(),
      month: datetime.getMonth() + 1,
      year: datetime.getFullYear(),
      hour: datetime.getHours(),
      minute: datetime.getMinutes()
    };
  }
};
</script>

<style scoped>
.btn-add {
  border-bottom-left-radius: 0px;
  border-bottom-right-radius: 0px;
  border-bottom: none;
  border-color: #c3c3c3;
}
.btn-add:hover {
  background-color: #e4e4e4;
}
.btn-add:focus {
  box-shadow: none;
}
.btn-sub {
  border-top-left-radius: 0px;
  border-top-right-radius: 0px;
  border-top: none;
  border-color: #c3c3c3;
}
.btn-sub:hover {
  background-color: #e4e4e4;
}
.btn-sub:focus {
  box-shadow: none;
}
.form-control {
  border-radius: 10px;
}
.form-control:focus {
  box-shadow: none;
}

.show-enter-active,
.show-leave-active {
  transition: opacity 0.3s;
}
.show-enter,
.show-leave-to {
  opacity: 0;
}
</style>

