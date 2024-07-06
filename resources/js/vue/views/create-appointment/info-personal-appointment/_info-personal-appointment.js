// @vue/component
import ButtonApp from "../../../components/shared/ButtonApp";

export default {
  name: "InfoPersonalAppointment",

  components: { ButtonApp },

  mixins: [],

  props: {},

  data() {
    return {
      num: 1,
      typeRequestIsOrdinal: false,
      formPersonalInfo: {
        name: "",
        dateOfBirth: "",
        region: "",
        type: "",
        gender: "H",
        typeRequest: "o",
        motifRequest: "newAppointement",
      },
      pickerOptions: {
        disabledDate(time) {
          return time.getTime() > Date.now();
        },
      },
    };
  },

  computed: {},

  watch: {},

  created() {
    this.typeRequestIsOrdinal = JSON.parse(localStorage.getItem("typeRequest"))?.id === "1"
  },
  updated() {
  },
  methods: {
    nextFormInfo() {
      // @Todo control
      this.$router.push({name: "appointment-step-foor"});
    },

    prevStep() {
      window.history.go(-1)
    },
  },
};
