<template>
  <div class="container-calendar-app">
    <div class="head-calendar">
      <el-button type="primary"  @click="prevDate" circle>
        <el-icon><ArrowLeft /></el-icon>
      </el-button>

      <div class="current-date-calendar">
        <span class="">{{ currentMonthCalendar }}</span>
        <span class="app-ml-1">{{ currentYearCalendar }}</span>
      </div>
      <el-button type="primary"  @click="nextDate" circle>
        <el-icon><ArrowRight /></el-icon>
      </el-button>

    </div>

    <div class="days-of-the-week">
      <div v-for="(week, index) in weeks" :key="index" class="week">
        <span>{{ week.fullName }}</span>
      </div>
    </div>

    <div class="month-days">
      <div v-for="(day, index) in getDaysOfMonths" :key="index" class="day">
        <span :class="{ currentDay: day === today.getDate() }">{{ day }}</span>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: "CalendarApp",


  data() {

    const weeksName = [
      "Lun",
      "Mar",
      "Mer",
      "Jeu",
      "Ven",
      "Sam",
      "Dim",
    ];
    const monthNames = [
      "Janvier",
      "Février",
      "Mars",
      "Avril",
      "Mai",
      "Juin",
      "Juillet",
      "Août",
      "Septembre",
      "Octobre",
      "Nombre",
      "Décembre",
    ];
    return {
      currentDate: String,
      currentYearCalendar: String,
      today: new Date(),
      currentMonthCalendar: String,
      weekdayName: weeksName,
      monthNames: monthNames,
      weeks: [],
      monthsYear: [],
      dayOfMonths: [],
    };
  },

  mounted() {
    const now = new Date();
    this.currentYearCalendar = now.getFullYear();
    // this.currentDate = formatDate(now, "yyyy");

    this.monthsYear = this.monthNames.map((month, index) => {
      return {
        fullName: month,
        shortName: month.substring(0, 3),
        number: index,
      };
    });
    this.weeks = this.weekdayName.map((week, index) => {
      return {
        fullName: week,
        shortName: week.substring(0, 3),
        number: index,
      };
    });

    this.currentMonthCalendar = this.monthsYear[now.getMonth()].fullName;
    // this.dayOfMonths = this.getDaysOfMonths;
    // console.log("this.dayOfMonths", this.dayOfMonths);
  },

  methods: {
    numberDayInMonthByYear(mois, annee) {
      return new Date(annee, mois, 0).getDate();
    },
    prevDate() {
    },
    nextDate() {
    },
  },
  filters: {
    customFormatDate: (date, format) => {
      const langUse = undefined;
      const formatUse = format ?? {
        weekday: "long",
        day: "numeric",
        month: "long",
        year: "numeric",
      };
      if (date === undefined || date === null) {
        return "";
      } else if (date instanceof Date) {
        return date.toLocaleDateString(langUse, formatUse);
      } else {
        return new Date(date).toLocaleDateString(langUse, formatUse);
      }
    },
  },

  computed: {
    getDaysOfMonths() {
      let today = new Date(); // Sat Sep 03 2022 13:16:13 GMT+0000 (heure moyenne de Greenwich)

      const numeroDuMoisEncours = today.getMonth() + 1; // 9e mois
      const anneeEncours = today.getFullYear(); // 2022

      let tableDesJoursDuMoisEncours = Array(42); // length 42

      const nombreDeJourDuMoisEncours = this.numberDayInMonthByYear(
          numeroDuMoisEncours,
          anneeEncours
      ); // 30

      let nombreDeJourDuMoisPrecedent = this.numberDayInMonthByYear(
          numeroDuMoisEncours - 1,
          anneeEncours - 1
      ); // 31

      let jourDuMoisProchain = 1; // les mois debutent tjrs le 1er
      let indexJoursDuMoisEnCours = today.getDay() === 0 ? 6 : today.getDay(); // samedi 6; dimanche:0,
      let jourDuMoisEnCours = today.getDate(); // le 3 sept
      indexJoursDuMoisEnCours = indexJoursDuMoisEnCours - 1; // les tableaux commencent à l'index zero

      for (
          let index = indexJoursDuMoisEnCours;
          index < tableDesJoursDuMoisEncours.length;
          index++
      ) {
        if (jourDuMoisEnCours > nombreDeJourDuMoisEncours) {
          tableDesJoursDuMoisEncours[index] = jourDuMoisProchain;
          jourDuMoisProchain++;
        } else {
          tableDesJoursDuMoisEncours[index] = jourDuMoisEnCours;
          jourDuMoisEnCours++;
        }
      }

      jourDuMoisEnCours = today.getDate();

      for (let index = indexJoursDuMoisEnCours; index >= 0; index--) {
        if (jourDuMoisEnCours === 0) {
          tableDesJoursDuMoisEncours[index] = nombreDeJourDuMoisPrecedent;
          nombreDeJourDuMoisPrecedent--;
        } else {
          tableDesJoursDuMoisEncours[index] = jourDuMoisEnCours;
          jourDuMoisEnCours--;
        }
        // console.log("jourDuMoisEnCours => ", jourDuMoisEnCours);
      }
      return tableDesJoursDuMoisEncours;
    },
  },
};
</script>

<style lang="less" scoped>
.container-calendar-app {
  .head-calendar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-direction: row;
    margin-bottom: 1rem;
    font-weight: 700;

    .current-date-calendar {
    }

    .icon {
      cursor: pointer;
    }
  }

  .days-of-the-week {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    justify-content: space-around;
    align-items: center;
    flex-direction: row;
    opacity: 0.5;
    font-size: 13px;

    .week {
      width: 100%;
    }
  }

  .month-days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    align-items: center;

    .day {
      padding: 0.5rem;
      font-size: 19px;
      font-weight: 500;
      color: #0000009c;

      .free-day {
        border-bottom: 4px solid var(--primaryColor);
      }

      .currentDay {
        color: var(--primaryColor);
        font-size: 1.4rem;
      }
    }
  }
}
</style>
