// @vue/component
import ItemDocument from "../../components/shared/ItemDocument";

export default {
  name: "DashboardView",
  components: { ItemDocument },

  mixins: [],

  props: {},

  data() {
    const item = {
      date: "2016-05-02",
      name: "Visa",
      userName: "Koffi ange",
      phone: "662215050",
      status: "En cours",
      receipt: "RDV 30-10-2022",
    };
    const item1 = {
      date: "2016-05-02",
      name: "Demande de passeport",
      userName: "Toure Junior",
      phone: "628748484",
      status: "En cours",
      receipt: "RDV 30-10-2022",
    };
    const item2 = {
      date: "2016-05-02",
      name: "Titre de sejour",
      userName: "Koffi ange",
      phone: "000 0000 000",
      status: "En cours",
      receipt: "RDV 30-10-2022",
    };
    return {
      documentsAppointment: Array(5).fill(item),
      documentsAppointmentPassport: Array(7).fill(item1),
      documentsAppointmentResidencePermit: Array(3).fill(item2),
    };
  },
  computed: {},

  watch: {},

  created() {},

  methods: {},
};
