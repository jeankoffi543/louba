// @vue/component
import ButtonApp from "../../../components/shared/ButtonApp";

export default {
  name: "PayAppointment",

  components: {
    ButtonApp,
  },

  mixins: [],

  props: {},

  data() {
    return {
      isLoading: false,
      indexMethodsPaimentActive: 0,
      numberAppointmentReserve: 0,
      labelRequest: "Centre Coléya",
      dateRequest: "Vendredi 23 Septembre 2022  de 10h - 11h",
      methodsPaiment: [
        {
          name: "Orange money",
          nameLogo: "orange-money.png",
          classNameLogo: "orange-monney",
          color: "#ffa500",
        },
        {
          name: "Mtn momo",
          nameLogo: "mtn-money.png",
          classNameLogo: "mtn-monney",
          color: "#fcc917",
        },
        {
          name: "Autres",
          nameLogo: "ecobank.jpg",
          classNameLogo: "eco-bank",
          color: "#015c88",
        },
      ],
    };
  },

  computed: {},

  watch: {},

  created() {},

  methods: {
    initPayAppointment() {
      console.log("initPayAppointment");
      this.isLoading = true;
      setTimeout(() => {
        this.isLoading = false;
      }, 2000);
    },
    redirectToAllDocument() {
      // console.log("initPayAppointment");
      this.isLoading = true;
      setTimeout(() => {
        this.isLoading = false;
        this.$router.push({name: "all-documents"});
      }, 2000);
    },

    payAppointmentAfter() {
      localStorage.setItem("numberAppointmentReserve", this.numberAppointmentReserve++)
    },
  },
};
