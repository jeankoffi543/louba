// @vue/component
import ButtonApp from "../../../components/shared/ButtonApp";
import { mapActions, mapGetters } from "vuex";
import { KEY_FORM_JSON } from "../../../core/constants";

export default {
  name: "ObjectAppointment",

  components: {
    ButtonApp,
  },

  mixins: [],

  props: {},
  mounted() {},
  data() {
    return {};
  },

  computed: {
    ...mapActions([
      "TYPE_APPOINTMENT_SELECTED",
      "OBJECT_APPOINTMENT_SELECTED",
      "FORM_DATA_REQUEST",
    ]),
    ...mapGetters({
      loading: "IS_LOADING_APPOINTMENT",
      objectsAppointment: "GET_TYPES_APPOINTMENTS",
      typeAppointmentSelected: "GET_TYPE_APPOINTMENT_SELECTED",
      objectAppointmentSelected: "GET_OBJECT_APPOINTMENT_SELECTED",
    }),
  },

  watch: {},

  created() {},

  methods: {
    initUploadFile($event, index) {
      this.$refs.fileInput[index].click();
    },
    onUploadFile($event, item) {
      if (item.hasFile) {
        item.file = $event;
      }
      this.radioAppointmentChange(item);
      //console.log($event, item);
    },
    radioAppointmentChange(item) {
      this.$store.dispatch("TYPE_APPOINTMENT_SELECTED", item);
      this.$store.dispatch("FORM_DATA_REQUEST", {
        key: [KEY_FORM_JSON.TYPE_REQUEST],
        data: item,
      });
      // localStorage.setItem("typeRequest", JSON.stringify(item));
    },

    prevStep() {
      window.history.go(-1);
    },
    nextFormInfo() {
      // @Todo control
      this.$router.push({ name: "appointment-step-three" });
    },
  },
};
