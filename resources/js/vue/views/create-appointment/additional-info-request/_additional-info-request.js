// @vue/component
import ButtonApp from "../../../components/shared/ButtonApp";

export default {
  name: "AdditionalInfoRequest",

  components: { ButtonApp },

  mixins: [],

  props: {},

  data() {
    return {
      formPersonalInfo: {
        name: "",
        region: "",
        type: "",
        dateOfBirth: "",
        gender: "H",
      },
      objectAppointmentIsPassport: true,
      objectTypeRequestAppointmentIsOrdinal: false,
      pickerOptions: {
        disabledDate(time) {
          return time.getTime() > Date.now();
        },
      },
      options: [
        {
          value: "Noire",
          label: "Noire",
        },
        {
          value: "Peau blanche",
          label: "Peau blanche",
        },
        {
          value: "Bronzé",
          label: "Bronzé",
        },
        {
          value: "Autre",
          label: "Autre",
        },
      ],
      fileList: [
        {
          name: "food.jpeg",
          url: "https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100",
        },
      ],
    };
  },

  computed: {},

  watch: {},

  created() {
    this.objectAppointmentIsPassport = JSON.parse(localStorage.getItem("objectAppointment"))?.id === "1"
    this.objectTypeRequestAppointmentIsOrdinal = JSON.parse(localStorage.getItem("typeRequest"))?.id === "1"
  },

  methods: {
    handleRemove(file, fileList) {
      console.log(file, fileList);
    },
    handlePreview(file) {
      console.log(file);
    },
    prevStep() {
      window.history.go(-1)
    },

    nextPage() {
      const objectAppointment = JSON.parse(localStorage.getItem("objectAppointment"))
      if (objectAppointment && objectAppointment.id === "2") {
        // 2 ==> visa
        this.$router.push({name: "appointment-step-five"});
      } else {
        // 1, 3..., other
        this.$router.push({name: "appointment-step-site"});
      }
    },
  },
};
