// @vue/component
export default {
  name: "DownloadableDocuments",

  components: {},

  mixins: [],

  props: {},

  data() {
    return {
      downloadableDocuments: [],
      displayMode: 1,
    };
  },

  computed: {},

  watch: {},

  created() {
    this.downloadableDocuments = [
      {
        date: new Date().toLocaleString(),
        typeDocument: "Visa",
        documentName: "Ma carte visa",
      },
      {
        date: new Date().toLocaleString(),
        typeDocument: "Visa",
        documentName: "Carte consulaire",
      },
      {
        date: new Date().toLocaleString(),
        typeDocument: "Passport",
        documentName: "Passport sans titre",
      },
      {
        date: new Date().toLocaleString(),
        typeDocument: "Titre de sejour",
        documentName: "le visa long séjour valant titre de séjour",
      },
    ];
  },

  methods: {},
};
