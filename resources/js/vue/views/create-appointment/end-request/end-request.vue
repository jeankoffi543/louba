<template>
    <div class="container">
        <div class="row">

            <div class="col-12 col-md-10 order-1 order-md-0">
                <FullCalendar :options="calendarOptions" ref="fullCalendar" class="calendar-container" />
            </div>

            <div class="col-12 col-md-2 order-0 order-md-1">
                <div class="d-flex flex-column">
                    <div class="col-sm-12 col-md-12 mb-1">
                        <b>Légende</b>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-1">
                        <el-tag class="" style="width: auto; margin-right: 10px;" type="danger">
                            Jour indisponible
                        </el-tag>
                        <el-tag class="" style="width: auto;  margin-right: 10px;" type="info">
                            jour disponible
                        </el-tag>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-1" style="margin-top: 1.5rem;">
                        <b>Horaire</b>
                    </div>
                    <div class="col-sm-12 col-md-12 d-flex ">
                        <div class="item-time  text-center w-100 rounded-2 w-auto">
                            <span class="">Matin 8h30-12h30</span>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6  w-auto mr-1 ml-1"> / </div>
                        <div class="item-time  text-center w-100 rounded-2 w-auto">
                            <span class="">Soir 13h30-17h00</span>
                        </div>

                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <b>Point d'enrolement</b>
                            <span class="text-info">{{ pointEnrolement?.pointEnrolement?.nom_pe }} </span>
                            <span class="text-info" v-if="!pointEnrolement?.pointEnrolement?.nom_pe">chargement...
                            </span>

                            <b>Capacité journalière</b>
                            <div class="d-flex flex-row justify-content-start">
                                <span class="text-info"> {{ pointEnrolement?.countToday }} </span> /
                                <span class="text-info">{{ pointEnrolement?.pointEnrolement?.capacite_maximale_jour_pe
                                    }} </span>
                                <span class="text-info"
                                    v-if="!pointEnrolement?.pointEnrolement?.capacite_maximale_jour_pe">chargement...
                                </span>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row mt-2">
            <div class="col-6">
                <div class="d-flex flex-row justify-content-start gap-2">

                    <ButtonApp v-loading="isLoading" :primary-btn="false" button-title="Retour" class="space1"
                        @click="onReturn">
                    </ButtonApp>

                    <el-button v-if="disabledSave" type="primary" class="space buttonE" disabled="true">
                        Valider
                    </el-button>

                    <ButtonApp v-else v-loading="isLoadingSaveAppointment" button-title="Valider" class="space"
                        @click="onSaveAppointment">
                    </ButtonApp>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import axios from "axios";
import { ElCalendar } from "element-plus";
import { ref } from "vue";
import { mapActions, mapGetters } from "vuex";
import ButtonApp from "../../../components/shared/ButtonApp.vue";
import { KEY_FORM_JSON } from "../../../core/constants";
import utils from "../../../core/utils";
import { format } from "date-fns";
import { pointInsideRect } from '@fullcalendar/core/internal';

export default {
    components: {
        FullCalendar,
        ButtonApp
    },
    mixins: [],

    props: {},

    data() {
        return {
            today: new Date().toISOString().split('T')[0], // Obtient la date d'aujourd'hui en format YYYY-MM-DD
            date_rdv_demande: null,
            disabledSave: true,
            pointEnrolement: null,
            holidays: [],
            currentStartDate: null,
            currentEndDate: null,
            calendarOptions: {
                events: [],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth'
                },
                buttonText: {
                    today: 'Aujourd\'hui',
                    month: 'Mois',
                    week: 'Semaine',
                    day: 'Jour',
                    list: 'Liste'
                },
                locale: "fr",
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                dateClick: this.handleDateClick,
                datesSet: this.handleDatesSet,
                dayCellDidMount: this.handleDayCellDidMount,
                eventDidMount: this.handleEventDidMount,
                validRange: {
                    start: this.today // Désactive les dates avant aujourd'hui
                },
                selectOverlap: false
            },
            selectedCell: null,
            dateAppointment: new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate(), new Date().getHours() + 24),
            siteAppointmentId: "",
            isLoadingSaveAppointment: false,
            times: [
                {
                    label: "Matin 8h30-12h30",
                    id: 1,
                    checked: true
                },
                {
                    label: "Soir 13h30-17h00",
                    id: 2,
                    checked: false
                }
            ]
        }
    },
    computed: {
        ...mapActions(['FETCH_ENROLMENTS_POINTS', "FORM_DATA_REQUEST", 'FETCH_FERRY_DAY', 'SAVE_APPOINTMENT']),
        ...mapGetters({
            enrolmentsPoint: "GET_ENROLMENTS_POINTS",
            isLoading: "IS_LOADING_LOCATIONS_ENROLMENTS",
            ferry_days: "GET_FERRY_DAY",
            formDataRequest: "GET_FORM_DATA_REQUEST",
            statusResponse: "GET_STATUS_RESPONSE",
            statusMessage: "GET_MESSAGE_APPOINTMENT"
        })


    },
    watch: {

    },

    created() {
        this.$store.dispatch("FETCH_ENROLMENTS_POINTS");
        this.$store.dispatch("FETCH_FERRY_DAY");
        // this.fetchHolidays();

    },

    methods: {
        fetchData(today = null) {
            let url = "api/get-one-appointment-by-id/" + this.formDataRequest?.user?.siteAppointmentId
            if (today) {
                url = "api/get-one-appointment-by-id/" + this.formDataRequest?.user?.siteAppointmentId + "?today=" + today
            }
            axios.get(url).then((response) => {
                this.pointEnrolement = response.data
                if (response?.data.countToday == response?.data?.pointEnrolement?.capacite_maximale_jour_pe || !today) {
                    this.disabledSave = true
                } else {
                    this.disabledSave = false
                }
            })
        },
        async fetchHolidays(startDate, endDate) {
            try {
                const response = await axios.get('api/get-ferry-current-day', {
                    params: {
                        start: startDate,
                        end: endDate
                    }
                });
                console.log("Holidays response:", response.data);
                this.holidays = response.data.map(event => {
                    const date = new Date(event.start);
                    return {
                        start: date.toISOString().split('T')[0],
                        title: event.title,
                    };
                });
                console.log("Holidays dates:", this.holidays);
            } catch (error) {
                console.error('Error fetching events:', error);
            }
        },
        async handleDatesSet(fetchInfo) {
            this.addHoverEffectToColumns();
            const startDate = fetchInfo.startStr.split('T')[0];
            const endDate = fetchInfo.endStr.split('T')[0];
            this.currentStartDate = startDate;
            this.currentEndDate = endDate;
            await this.fetchHolidays(startDate, endDate);

            // Rafraîchissez les événements
            this.calendarOptions.events = this.holidays.map(event => ({
                start: event.start,
                title: event.title,
                display: 'background',
                backgroundColor: '#f0f0f0'
            }));
        },
        addHoverEffectToColumns() {
            this.$nextTick(() => {
                const calendarEl = this.$refs.fullCalendar.$el;
                const dayCells = calendarEl.querySelectorAll('.fc-daygrid-day');

                dayCells.forEach(cell => {
                    const date = cell.getAttribute('data-date');
                    const day = new Date(date).getDay();
                    if (day !== 0 && day !== 6) {
                        const frame = cell.querySelector('.fc-daygrid-day-frame');
                        frame.addEventListener('mouseenter', this.handleMouseEnter);
                        frame.addEventListener('mouseleave', this.handleMouseLeave);
                        frame.addEventListener('click', this.handleCellClick);
                    }
                });
            });
        },
        handleMouseEnter(event) {
            event.currentTarget.style.cursor = 'pointer';
        },
        handleMouseLeave(event) {
            event.currentTarget.style.cursor = '';
        },
        handleCellClick(event) {
            const date = event.currentTarget.closest('.fc-daygrid-day').getAttribute('data-date');
            const day = new Date(date).getDay();
            if (day === 0 || day === 6) {
                return;
            }

            // Deselect the previous cell
            if (this.selectedCell) {
                this.selectedCell.classList.remove('selected');
                const checkbox = this.selectedCell.querySelector('input[type="checkbox"]');
                if (checkbox) {
                    this.selectedCell.removeChild(checkbox);
                }
            }

            // Select the new cell
            this.selectedCell = event.currentTarget;
            this.selectedCell.classList.add('selected');
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.checked = true;
            checkbox.classList.add('custom-checkbox');
            this.selectedCell.appendChild(checkbox);
        },
        handleDateClick(info) {
            const day = new Date(info.dateStr).getDay();
            if (day === 0 || day === 6) {
                return;
            }
            this.fetchData(info.dateStr);
            this.date_rdv_demande = info.dateStr
            console.log('Date clicked: ' + info.dateStr);
        },
        // handleDayCellDidMount(args) {
        //     const day = new Date(args.date).getDay();
        //     const cellContent = args.el.querySelector('.fc-daygrid-day-frame');
        //     const eventCount = args.el.querySelectorAll('.fc-event').length;

        //     const cellText = document.createElement('div');
        //     cellText.className = 'cell-text';

        //     if (day === 0 || day === 6) {
        //         cellText.textContent = 'indisponible';
        //         cellText.style.color = 'red';
        //         args.el.classList.add('closed');
        //         args.el.style.pointerEvents = 'none';
        //     } else if (eventCount > 0) {
        //         cellText.textContent = args.el.querySelector('.fc-event-title').textContent;
        //     } else {
        //         cellText.textContent = 'disponible';
        //     }

        //     cellContent.appendChild(cellText);
        // },


        handleDayCellDidMount(args) {
            const day = new Date(args.date).getDay();
            const cellContent = args.el.querySelector('.fc-daygrid-day-frame');
            const cellText = document.createElement('div');
            cellText.className = 'cell-text';

            const formattedDate = new Date(args.date).toISOString().split('T')[0];



            // Obtenir la date actuelle en timestamp
            const today = new Date();
            today.setHours(0, 0, 0, 0); // Réinitialiser les heures, minutes, secondes et millisecondes
            const todayTimestamp = today.getTime(); // Timestamp pour aujourd'hui

            // Extraire et formater la date de la cellule
            const cellDateStr = args.date;
            const cellDate = new Date(cellDateStr);
            cellDate.setHours(0, 0, 0, 0); // Réinitialiser les heures, minutes, secondes et millisecondes
            const cellDateTimestamp = cellDate.getTime(); // Timestamp pour la date de la cellule


            if (this.holidays.includes(formattedDate)) {
                console.log("Holiday detected:", formattedDate);
                cellText.textContent = 'indisponible';
                cellText.style.color = 'white';
                args.el.classList.add('holiday');
                args.el.style.pointerEvents = 'none';
            } else if (day === 0 || day === 6 || cellDateTimestamp < todayTimestamp) {
                cellText.textContent = 'indisponible';
                cellText.style.color = 'red';
                cellText.style.textDecoration = 'none';
                args.el.classList.add('closed');
            } else {
                cellText.textContent = 'disponible';
            }

            cellContent.appendChild(cellText);
        },

        handleEventDidMount(args) {
            const eventDate = args.event.startStr;
            const cell = this.$refs.fullCalendar.$el.querySelector(`[data-date="${eventDate}"]`);
            if (cell) {

                // Vider le contenu actuel de la cellule
                const cellContent = cell.querySelector('.fc-daygrid-day-frame');
                if (cellContent) {
                    cellContent.innerHTML = ''; // Retire tout le texte existant
                }

                // Ajouter le titre de l'événement à la cellule
                const eventTitle = document.createElement('div');
                eventTitle.className = 'event-title';
                eventTitle.textContent = args.event.title;
                cellContent.appendChild(eventTitle);

                // Ajouter le texte "indisponible" en dessous du titre
                const closedText = document.createElement('div');
                closedText.className = 'closed-text';
                closedText.textContent = 'indisponible';
                cellContent.appendChild(closedText);

                // Ajouter des styles CSS
                cell.classList.add('holiday');
                cell.style.pointerEvents = 'none';
            }
        },
        onDateChange: (data) => {
            const payload = {
                key: [KEY_FORM_JSON.DATE_APPOINTMENT],
                data: this.dateAppointment
            };
            this.$store.dispatch('FORM_DATA_REQUEST', payload);
        },
        hasFerry: function (data) {
            return this.ferry_days.find(date => new Date(data.day).getTime() == new Date(date.date_jfpe).getTime()) != undefined;
        },
        onReturn: function () {
            this.$router.push({ name: "appointment-start", params: { documentId: this.formDataRequest?.user?.documentId } })
        },

        disabledDates(date) {
            console.log('date', date)
            const dayOfWeek = date.getDay();
            return dayOfWeek === 0 || dayOfWeek === 6; // 0 represents Sunday, 6 represents Saturday
        },

        onSaveAppointment: async function () {
            this.isLoadingSaveAppointment = true;
            console.log("this.formDataRequest =====", this.formDataRequest)
            console.log('date de rdv ', new Date(this.dateAppointment).getTime())
            // if (this.siteAppointmentId == "" || this.siteAppointmentId == null) {
            //     this.$swal({
            //         position: "center",
            //         icon: "warning",
            //         title: "Le site du rendez-vous est boligatoire",
            //         showConfirmButton: false,
            //         timer: 4500

            //     });
            //     return
            // }

            if (this.date_rdv_demande == null ||this.date_rdv_demande == "" || new Date(this.date_rdv_demande).getTime() <= new Date().getTime()) {
                this.$swal({
                    position: "center",
                    icon: "warning",
                    title: "La date de rendez-vous est invalid",
                    showConfirmButton: false,
                    timer: 4500

                });
                return
            }
            const payload = {
                key: [KEY_FORM_JSON.DATE_APPOINTMENT],
                data: this.dateAppointment
            };
            this.$store.dispatch('FORM_DATA_REQUEST', payload);
            const formData = new FormData();

            formData.append(
                "date_rdv_demande",
                format(new Date(this.date_rdv_demande), "yyyy-MM-dd")
            );

            formData.append(
                "numero_recu",
                this.formDataRequest?.user?.numero_recu
            );

            // formData.append(
            //     "id_type_document",
            //     this.formDataRequest?.product?.id
            // );

            formData.append(
                "id_demande",
                this.formDataRequest?.user?.documentId
            );

            formData.append("type_service_passport", null);
            formData.append(
                "id_type_service",
                this.formDataRequest?.user?.serviceId.id ?? null
            );
            formData.append("id_point_enrolement", this.formDataRequest?.user?.siteAppointmentId);

            // await this.$store.dispatch("SAVE_APPOINTMENT", formData)
            axios.post(`/api/save-appointment`, formData).then(responseAxios => {
                this.isLoadingSaveAppointment = false;
                console.log("responseAxios", responseAxios)
                if (!responseAxios.data.demande) {
                    this.$swal({
                        position: "center",
                        icon: "warning",
                        title: responseAxios.data?.message ?? "",
                        showConfirmButton: false,
                        timer: 4500

                    });
                    return;
                }

                if (responseAxios.data.status == 200) {
                    this.$swal({
                        position: "center",
                        icon: "success",
                        title: responseAxios.data?.message ?? "Demande enregistré",
                        showConfirmButton: true,
                        confirmButtonText: 'Ok',
                        timer: 4500
                    }).then((result) => {
                        this.$router.push({
                            name: "details-appointment", params: {
                                documentId: responseAxios.data.demande?.id
                            }
                        })
                    })

                }
            }).catch((err) => {
                this.$swal({
                    position: "center",
                    icon: "warning",
                    title: "Echèc de l'enregistrement",
                    showConfirmButton: false,
                    timer: 4500
                });
                console.log("err", err);
                this.isLoadingSaveAppointment = false;
            }).finally(() => {

            });
        },
        numberDay: function (data) {
            return data?.day?.split('-').slice(1).join('-').split('-').slice(1).join();
        },
        nextPage() {
            const payload = {
                key: [KEY_FORM_JSON.DATE_APPOINTMENT],
                data: {
                    date: this.dateAppointment,
                    time: this.times.find((it) => it.checked)
                }
            };
            this.$store.dispatch("FORM_DATA_REQUEST", payload);
        },
        chooseTime(item) {
            // console.log("this.value", this.value);
            this.times = this.times.map((it) => {
                return {
                    ...it,
                    checked: it.id == item.id
                };
            });
        }

    },
    mounted() {
        this.addHoverEffectToColumns();
        this.fetchData();
        this.fetchHolidays(this.currentStartDate, this.currentEndDate);
    },
}
</script>

<style>
.selected {
    background-color: lightblue;
    position: relative;
}

.selected input[type="checkbox"] {
    position: absolute;
    top: 50%;
    left: 50;
}

.cell-text {
    text-align: center;
    height: 100%;
    font-size: 0.9rem;
    color: black;
    text-decoration: underline;
}

.closed {
    background-color: #f0f0f0;
    pointer-events: none;
    user-select: none;
}

.padding-1 {
    padding: 1rem;
}

.w-auto {
    width: auto;
}

.is-selected {
    color: #1989fa;
}

.el-tag {
    margin-right: 5px;
}


.cell {
    flex-direction: column;
    display: flex;
    margin: 0;
    height: 100%;
    justify-content: space-between;
}

.content-info-personal-appointment {
    margin-top: 2rem;
}

.space1 {
    width: fit-content;
}

.space {
    width: fit-content;

}

/*.center {
    margin-left: 10%;
    margin-top: 25%;
    margin-bottom: 0;
    position: relative;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
}
*/

.calendar-container {
    width: 100%;
    margin-bottom: 0;
}

.buttonE {
    padding: 1.6em 21px;
    height: 40px;
    width: 50%;
}

.holiday {
    background-color: #f0f0f0 !important;
    pointer-events: none;
    cursor: not-allowed;
}

.holiday .cell-text {
    color: white;
}

.fc-daygrid-day-frame {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
    /* Assure que le contenu prend toute la hauteur disponible */
    width: 100%;
    /* Assure que le contenu prend toute la largeur disponible */
}

.event-title {
    font-size: 1rem;
    /* Ajustez la taille de la police si nécessaire */
    color: black;
    /* Couleur du titre */
    margin-bottom: 0.2rem;
    /* Espace entre le titre et le texte "indisponible" */
    text-align: center;
    /* Centre le texte horizontalement */
}

.closed-text {
    font-size: 0.9rem;
    /* Ajustez la taille de la police pour le texte "indisponible" */
    color: red;
    /* Couleur rouge pour le texte "indisponible" */
    text-align: center;
    /* Centre le texte horizontalement */
}

.disabled-date {
    background-color: #e0e0e0;
    /* Couleur pour les cellules désactivées */
    color: #a0a0a0;
    /* Couleur du texte pour les cellules désactivées */
    pointer-events: none;
    /* Désactive les clics sur ces cellules */
    cursor: not-allowed;
    /* Change le curseur pour indiquer que l'interaction est interdite */
}
</style>