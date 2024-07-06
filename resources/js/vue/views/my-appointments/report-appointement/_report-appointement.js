// @vue/component
import ButtonApp from "../../../components/shared/ButtonApp";
import CalendarApp from "../../../components/CalendarApp"

export default {
  name: "ReportAppointement",

  components: {
    ButtonApp,
    CalendarApp
  },

  mixins: [],

  props: {},

  data() {
    return {
      checkedNotify: true,
      isLoading: false,
      dateAppointment: "10/08/2020",
      resonReport: "",
    };
  },

  computed: {},

  watch: {},

  created() {},

  methods: {
    sendReport() {
      // console.log("sendReport");
      this.isLoading = true;
      setTimeout(() => {
        this.isLoading = false;
        this.$router.push({name: 'pay-appointment'})
      }, 2000);
    },
  },
};
