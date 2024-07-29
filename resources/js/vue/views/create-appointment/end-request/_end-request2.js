import FullCalendar from '@fullcalendar/vue3'
  import dayGridPlugin from '@fullcalendar/daygrid'
  import interactionPlugin from '@fullcalendar/interaction'
  
  export default {
    components: {
      FullCalendar
    },
    data() {
      return {
        calendarEvents: [
          { title: 'Event 1', start: '2024-07-23' },
          { title: 'Event 2', start: '2024-07-24' }
        ],
        calendarOptions: {
          plugins: [dayGridPlugin, interactionPlugin],
          initialView: 'dayGridMonth',
          dateClick: this.handleDateClick,
          datesSet: this.handleDatesSet,
        },
        selectedCell: null
      }
    },
    methods: {
      handleDatesSet() {
        this.addHoverEffectToColumns();
      },
      addHoverEffectToColumns() {
        const calendarEl = this.$refs.fullCalendar.$el;
        const dayCells = calendarEl.querySelectorAll('.fc-daygrid-day-frame');
  
        dayCells.forEach(cell => {
          cell.addEventListener('mouseenter', this.handleMouseEnter);
          cell.addEventListener('mouseleave', this.handleMouseLeave);
          cell.addEventListener('click', this.handleCellClick);
        });
      },
      handleMouseEnter(event) {
        event.currentTarget.style.cursor = 'pointer';
      },
      handleMouseLeave(event) {
        event.currentTarget.style.cursor = '';
      },
      handleCellClick(event) {
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
        this.selectedCell.appendChild(checkbox);
      },
      handleDateClick(info) {
        console.log('Date clicked: ' + info.dateStr);
      }
    },
    mounted() {
      this.addHoverEffectToColumns();
    }
  }