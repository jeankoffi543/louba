<style>
    .sr-only {
        position: absolute;
        top: -2000em;
        left: -3000em;
    }

    .datepicker {
        margin-top: 1em;
        position: relative;
    }

    .datepicker .group {
        display: inline-block;
        position: relative;
        width: 15em;
    }

    .datepicker label {
        display: block;
    }

    .datepicker input {
        padding: 0;
        margin: 0;
        height: 1.5em;
        background-color: white;
        color: black;
        border: 1px solid gray;
    }

    .datepicker button.icon {
        position: relative;
        top: 0.25em;
        margin: 0;
        padding: 4px;
        border: 0 solid #005a9c;
        background-color: white;
        border-radius: 0px;
    }

    .datepicker .desc {
        position: absolute;
        left: 0;
        top: 2em;
    }

    .datepicker .fa-calendar-alt {
        color: hsl(216deg 89% 51%);
    }

    .datepicker button.icon:focus {
        outline: none;
        padding: 2px;
        border-width: 2px;
        background-color: #def;
    }

    .datepicker input:focus {
        background-color: #def;
        outline: 2px solid #005a9c;
        outline-offset: 1px;
    }

    .datepicker-dialog {
        /*position: absolute;*/
        /*width: 320px;*/
        width: 100%;
        clear: both;
        border: 1px solid #008f5d;
        margin-top: 0.15em;
        border-radius: 5px;
        padding: 0;
        background-color: #fff;
    }

    .datepicker-dialog .header {
        cursor: default;
        background-color: #008f5d;
        padding: 7px;
        font-weight: bold;
        text-transform: uppercase;
        color: white;
        display: flex;
        justify-content: space-around;
    }

    .datepicker-dialog h2 {
        margin: 0;
        padding: 0;
        display: inline-block;
        font-size: 2em;
        color: white;
        text-transform: none;
        font-weight: bold;
    }

    .datepicker-dialog button {
        border-style: none;
        background: transparent;
    }

    .datepicker-dialog button::-moz-focus-inner {
        border: 0;
    }

    .datepicker-dialog .dates {
        width: 320px;
    }

    .datepicker-dialog .prev-year,
    .datepicker-dialog .prev-month,
    .datepicker-dialog .next-month,
    .datepicker-dialog .next-year {
        padding: 4px;
        width: 24px;
        height: 24px;
        color: white;
    }

    .datepicker-dialog .prev-year:focus,
    .datepicker-dialog .prev-month:focus,
    .datepicker-dialog .next-month:focus,
    .datepicker-dialog .next-year:focus {
        padding: 2px;
        border: 1px solid white;
        border-radius: 4px;
        outline: 0;
    }

    .datepicker-dialog .prev-year:hover,
    .datepicker-dialog .prev-month:hover,
    .datepicker-dialog .next-month:hover,
    .datepicker-dialog .next-year:hover {
        padding: 2px;
        border: 1px solid white;
        border-radius: 4px;
    }

    .datepicker-dialog .dialog-ok-cancel-group {
        text-align: right;
        margin-top: 1em;
        margin-bottom: 1em;
        margin-right: 1em;
    }

    .datepicker-dialog .dialog-ok-cancel-group button {
        padding: 6px;
        margin-left: 1em;
        width: 5em;
        background-color: hsl(216deg 80% 92%);
        font-size: 0.85em;
        color: black;
        outline: none;
        border-radius: 5px;
    }

    .datepicker-dialog .dialog-button:focus {
        padding: 2px;
        border: 1px solid black;
    }

    .datepicker-dialog .dialog-button:hover {
        padding: 5px;
        border: 1px solid black;
    }

    .datepicker-dialog .fa-calendar-alt {
        color: hsl(216deg 89% 51%);
    }

    .datepicker-dialog .month-year {
        display: inline-block;
        width: 12em;
        text-align: center;
    }

    .datepicker-dialog table.dates {
        padding-left: 1em;
        padding-right: 1em;
        padding-top: 1em;
    }

    .datepicker-dialog table.dates th,
    .datepicker-dialog table.dates td {
        text-align: center;
    }

    .datepicker-dialog table.dates tr {
        border: 1px solid black;
    }

    .datepicker-dialog table.dates td {
        padding: 2px;
        margin: 0;
        line-height: inherit;
        height: 40px;
        width: 17%;
        border-radius: 0px;
        font-size: 15px;
        background: #eee;
    }

    .datepicker-dialog table.dates td.disabled {
        padding: 2px;
        border: none;
        height: 41px;
        width: 14%;
    }

    .datepicker-dialog table.dates td:focus,
    .datepicker-dialog table.dates td:hover {
        padding: 2px;
        background-color: hsl(216deg 80% 92%);
    }

    .datepicker-dialog table.dates td:focus {
        padding: 2px;
        border: 1px solid rgb(100 100 100);
        outline: 0;
    }

    .datepicker-dialog table.dates td:not(.disabled):hover {
        padding: 2px;
        border: 1px solid rgb(100 100 100);
    }

    .datepicker-dialog table.dates td[aria-selected] {
        padding: 1px;
        border: 1px dotted rgb(100 100 100);
        /*background: #40d951;*/
        /*background-color: #008f5d;*/
        background: #008f5d;
        color: white;
    }

    /*hsl(216deg 80% 51%)*/
    .datepicker-dialog table.dates td[aria-selected]:focus {
        padding: 2px;
        border: 1px solid rgb(100 100 100);
    }

    /*
    .datepicker-dialog table.dates td[tabindex="0"] {
      background-color: #008f5d;
      color: white;
    }
    */

    .datepicker-dialog .dialog-message {
        padding-top: 0.25em;
        padding-left: 1em;
        height: 1.75em;
        background: #008f5d;
        color: white;
    }

    td {
        color: black
    }

    thead {
        color: #044016;
        font-weight: bold;
        padding: 2px;
    }

    th {
        padding: 4px
    }

</style>

<script>
    /*
     *   This content is licensed according to the W3C Software License at
     *   https://www.w3.org/Consortium/Legal/2015/copyright-software-and-document
     *
     *   File:   DatePickerDialog.js
     */

    'use strict';

    var DatePickerDialog = function (cdp) {
        this.buttonLabelChoose = 'Choose Date';
        this.buttonLabelChange = 'Change Date';
        this.dayLabels = [
            'Dimanche',
            'Lundi',
            'Mardi',
            'Mercredi',
            'Jeudi',
            'Vendredi',
            'Samedi'
        ];
        this.monthLabels = [
            'Janvier',
            'Fevrier',
            'Mars',
            'Avril',
            'Mai',
            'Juin',
            'Juillet',
            'Aout',
            'Septembre',
            'Octobre',
            'Novembre',
            'Decembre'
        ];

        this.messageCursorKeys = '';
        this.lastMessage = '';

        this.textboxNode = cdp.querySelector('input[type="text"');
        this.buttonNode = cdp.querySelector('.group button');
        this.dialogNode = cdp.querySelector('[role="dialog"]');
        this.messageNode = this.dialogNode.querySelector('.dialog-message');

        this.monthYearNode = this.dialogNode.querySelector('.month-year');

        this.prevYearNode = this.dialogNode.querySelector('.prev-year');
        this.prevMonthNode = this.dialogNode.querySelector('.prev-month');
        this.nextMonthNode = this.dialogNode.querySelector('.next-month');
        this.nextYearNode = this.dialogNode.querySelector('.next-year');

        this.okButtonNode = this.dialogNode.querySelector('button[value="ok"]');
        this.cancelButtonNode = this.dialogNode.querySelector(
            'button[value="cancel"]'
        );

        this.tbodyNode = this.dialogNode.querySelector('table.dates tbody');

        this.lastRowNode = null;

        this.days = [];

        this.focusDay = new Date();
        this.selectedDay = new Date(0, 0, 1);

        this.isMouseDownOnBackground = false;

        this.init();
    };

    DatePickerDialog.prototype.init = function () {
        this.textboxNode.addEventListener(
            'blur',
            this.setDateForButtonLabel.bind(this)
        );

        this.buttonNode.addEventListener(
            'keydown',
            this.handleButtonKeydown.bind(this)
        );
        this.buttonNode.addEventListener('click', this.handleButtonClick.bind(this));

        this.okButtonNode.addEventListener('click', this.handleOkButton.bind(this));
        this.okButtonNode.addEventListener('keydown', this.handleOkButton.bind(this));

        this.cancelButtonNode.addEventListener(
            'click',
            this.handleCancelButton.bind(this)
        );
        this.cancelButtonNode.addEventListener(
            'keydown',
            this.handleCancelButton.bind(this)
        );

        this.prevMonthNode.addEventListener(
            'click',
            this.handlePreviousMonthButton.bind(this)
        );
        this.nextMonthNode.addEventListener(
            'click',
            this.handleNextMonthButton.bind(this)
        );
        this.prevYearNode.addEventListener(
            'click',
            this.handlePreviousYearButton.bind(this)
        );
        this.nextYearNode.addEventListener(
            'click',
            this.handleNextYearButton.bind(this)
        );

        this.prevMonthNode.addEventListener(
            'keydown',
            this.handlePreviousMonthButton.bind(this)
        );
        this.nextMonthNode.addEventListener(
            'keydown',
            this.handleNextMonthButton.bind(this)
        );
        this.prevYearNode.addEventListener(
            'keydown',
            this.handlePreviousYearButton.bind(this)
        );
        this.nextYearNode.addEventListener(
            'keydown',
            this.handleNextYearButton.bind(this)
        );

        document.body.addEventListener(
            'mouseup',
            this.handleBackgroundMouseUp.bind(this),
            true
        );

        // Create Grid of Dates

        this.tbodyNode.innerHTML = '';
        for (var i = 0; i < 6; i++) {
            var row = this.tbodyNode.insertRow(i);
            this.lastRowNode = row;
            for (var j = 0; j < 7; j++) {
                var cell = document.createElement('td');

                cell.tabIndex = -1;
                cell.addEventListener('click', this.handleDayClick.bind(this));
                cell.addEventListener('keydown', this.handleDayKeyDown.bind(this));
                cell.addEventListener('focus', this.handleDayFocus.bind(this));

                cell.textContent = '-1';

                row.appendChild(cell);
                this.days.push(cell);
            }
        }

        this.updateGrid();
        this.close(false);
        this.setDateForButtonLabel();
    };

    DatePickerDialog.prototype.isSameDay = function (day1, day2) {
        return (
            day1.getFullYear() == day2.getFullYear() &&
            day1.getMonth() == day2.getMonth() &&
            day1.getDate() == day2.getDate()
        );
    };

    DatePickerDialog.prototype.isNotSameMonth = function (day1, day2) {
        return (
            day1.getFullYear() != day2.getFullYear() ||
            day1.getMonth() != day2.getMonth()
        );
    };

    DatePickerDialog.prototype.updateGrid = function () {
        var flag;
        var fd = this.focusDay;

        this.monthYearNode.textContent =
            this.monthLabels[fd.getMonth()] + ' ' + fd.getFullYear();

        var firstDayOfMonth = new Date(fd.getFullYear(), fd.getMonth(), 1);
        var dayOfWeek = firstDayOfMonth.getDay();

        firstDayOfMonth.setDate(firstDayOfMonth.getDate() - dayOfWeek);

        var d = new Date(firstDayOfMonth);

        for (var i = 0; i < this.days.length; i++) {
            flag = d.getMonth() != fd.getMonth();
            this.updateDate(this.days[i], flag, d, this.isSameDay(d, this.selectedDay));
            d.setDate(d.getDate() + 1);

            // Hide last row if all dates are disabled (e.g. in next month)
            if (i === 35) {
                if (flag) {
                    this.lastRowNode.style.visibility = 'hidden';
                } else {
                    this.lastRowNode.style.visibility = 'visible';
                }
            }
        }
    };

    DatePickerDialog.prototype.updateDate = function (
        domNode,
        disable,
        day,
        selected
    ) {
        var d = day.getDate().toString();
        if (day.getDate() <= 9) {
            d = '0' + d;
        }

        var m = day.getMonth() + 1;
        if (day.getMonth() < 9) {
            m = '0' + m;
        }

        domNode.tabIndex = -1;
        domNode.removeAttribute('aria-selected');
        domNode.setAttribute('data-date', day.getFullYear() + '-' + m + '-' + d);

        if (disable) {
            domNode.classList.add('disabled');
            domNode.textContent = '';
        } else {
            domNode.classList.remove('disabled');
            domNode.textContent = day.getDate();
            if (selected) {
                domNode.setAttribute('aria-selected', 'true');
                domNode.tabIndex = 0;
            }
        }
    };

    DatePickerDialog.prototype.moveFocusToDay = function (day) {
        var d = this.focusDay;

        this.focusDay = day;

        if (
            d.getMonth() != this.focusDay.getMonth() ||
            d.getFullYear() != this.focusDay.getFullYear()
        ) {
            this.updateGrid();
        }
        this.setFocusDay();
    };

    DatePickerDialog.prototype.setFocusDay = function (flag) {
        if (typeof flag !== 'boolean') {
            flag = true;
        }

        for (var i = 0; i < this.days.length; i++) {
            var dayNode = this.days[i];
            var day = this.getDayFromDataDateAttribute(dayNode);

            dayNode.tabIndex = -1;
            if (this.isSameDay(day, this.focusDay)) {
                dayNode.tabIndex = 0;
                if (flag) {
                    dayNode.focus();
                }
            }
        }
    };

    DatePickerDialog.prototype.open = function () {
        this.dialogNode.style.display = 'block';
        this.dialogNode.style.zIndex = 2;

        this.getDateFromTextbox();
        this.updateGrid();
    };

    DatePickerDialog.prototype.isOpen = function () {
        return window.getComputedStyle(this.dialogNode).display !== 'none';
    };

    DatePickerDialog.prototype.close = function (flag) {
        if (typeof flag !== 'boolean') {
            // Default is to move focus to combobox
            flag = true;
        }

        this.setMessage('');
        this.dialogNode.style.display = 'block';

        if (flag) {
            this.buttonNode.focus();
        }
    };

    DatePickerDialog.prototype.moveToNextYear = function () {
        this.focusDay.setFullYear(this.focusDay.getFullYear() + 1);
        this.updateGrid();
    };

    DatePickerDialog.prototype.moveToPreviousYear = function () {
        this.focusDay.setFullYear(this.focusDay.getFullYear() - 1);
        this.updateGrid();
    };

    DatePickerDialog.prototype.moveToNextMonth = function () {
        this.focusDay.setMonth(this.focusDay.getMonth() + 1);
        this.updateGrid();
    };

    DatePickerDialog.prototype.moveToPreviousMonth = function () {
        this.focusDay.setMonth(this.focusDay.getMonth() - 1);
        this.updateGrid();
    };

    DatePickerDialog.prototype.moveFocusToNextDay = function () {
        var d = new Date(this.focusDay);
        d.setDate(d.getDate() + 1);
        this.moveFocusToDay(d);
    };

    DatePickerDialog.prototype.moveFocusToNextWeek = function () {
        var d = new Date(this.focusDay);
        d.setDate(d.getDate() + 7);
        this.moveFocusToDay(d);
    };

    DatePickerDialog.prototype.moveFocusToPreviousDay = function () {
        var d = new Date(this.focusDay);
        d.setDate(d.getDate() - 1);
        this.moveFocusToDay(d);
    };

    DatePickerDialog.prototype.moveFocusToPreviousWeek = function () {
        var d = new Date(this.focusDay);
        d.setDate(d.getDate() - 7);
        this.moveFocusToDay(d);
    };

    DatePickerDialog.prototype.moveFocusToFirstDayOfWeek = function () {
        var d = new Date(this.focusDay);
        d.setDate(d.getDate() - d.getDay());
        this.moveFocusToDay(d);
    };

    DatePickerDialog.prototype.moveFocusToLastDayOfWeek = function () {
        var d = new Date(this.focusDay);
        d.setDate(d.getDate() + (6 - d.getDay()));
        this.moveFocusToDay(d);
    };

    // Day methods

    DatePickerDialog.prototype.isDayDisabled = function (domNode) {
        return domNode.classList.contains('disabled');
    };

    DatePickerDialog.prototype.getDayFromDataDateAttribute = function (domNode) {
        var parts = domNode.getAttribute('data-date').split('-');
        return new Date(parts[0], parseInt(parts[1]) - 1, parts[2]);
    };
    // Textbox methods

    DatePickerDialog.prototype.setTextboxDate = function (domNode) {
        var d = this.focusDay;

        if (domNode) {
            d = this.getDayFromDataDateAttribute(domNode);
            // updated aria-selected
            this.days.forEach((day) =>
                day === domNode
                    ? day.setAttribute('aria-selected', 'true')
                    : day.removeAttribute('aria-selected')
            );
        }

        this.textboxNode.value = d.getMonth() + 1 + '/' + d.getDate() + '/' + d.getFullYear();
        //this.textboxNode.value = d.getFullYear()  + '/' + d.getMonth()  + '/' + d.getDate();
        this.setDateForButtonLabel();
    };

    DatePickerDialog.prototype.getDateFromTextbox = function () {
        var parts = this.textboxNode.value.split('/');
        var month = parseInt(parts[0]);
        var day = parseInt(parts[1]);
        var year = parseInt(parts[2]);

        if (
            parts.length === 3 &&
            Number.isInteger(month) &&
            Number.isInteger(day) &&
            Number.isInteger(year)
        ) {
            if (year < 100) {
                year = 2000 + year;
            }
            this.focusDay = new Date(year, month - 1, day);
            this.selectedDay = new Date(this.focusDay);
        } else {
            // If not a valid date (MM/DD/YY) initialize with todays date
            this.focusDay = new Date();
            this.selectedDay = new Date(0, 0, 1);
        }
    };

    DatePickerDialog.prototype.setDateForButtonLabel = function () {
        var parts = this.textboxNode.value.split('/');

        if (
            parts.length === 3 &&
            Number.isInteger(parseInt(parts[0])) &&
            Number.isInteger(parseInt(parts[1])) &&
            Number.isInteger(parseInt(parts[2]))
        ) {
            var day = new Date(
                parseInt(parts[2]),
                parseInt(parts[0]) - 1,
                parseInt(parts[1])
            );

            var label = this.buttonLabelChange;
            label += ', ' + this.dayLabels[day.getDay()];
            label += ' ' + this.monthLabels[day.getMonth()];
            label += ' ' + day.getDate();
            label += ', ' + day.getFullYear();
            this.buttonNode.setAttribute('aria-label', label);
        } else {
            // If not a valid date, initialize with "Choose Date"
            this.buttonNode.setAttribute('aria-label', this.buttonLabelChoose);
        }
    };

    DatePickerDialog.prototype.setMessage = function (str) {
        function setMessageDelayed() {
            this.messageNode.textContent = str;
        }

        if (str !== this.lastMessage) {
            setTimeout(setMessageDelayed.bind(this), 200);
            this.lastMessage = str;
        }
    };

    // Event handlers

    DatePickerDialog.prototype.handleOkButton = function (event) {
        var flag = false;

        switch (event.type) {
            case 'keydown':
                switch (event.key) {
                    case 'Tab':
                        if (!event.shiftKey) {
                            this.prevYearNode.focus();
                            flag = true;
                        }
                        break;

                    case 'Esc':
                    case 'Escape':
                        this.close();
                        flag = true;
                        break;

                    default:
                        break;
                }
                break;

            case 'click':
                this.setTextboxDate();
                this.close();
                flag = true;
                break;

            default:
                break;
        }

        if (flag) {
            event.stopPropagation();
            event.preventDefault();
        }
    };

    DatePickerDialog.prototype.handleCancelButton = function (event) {
        var flag = false;

        switch (event.type) {
            case 'keydown':
                switch (event.key) {
                    case 'Esc':
                    case 'Escape':
                        this.close();
                        flag = true;
                        break;

                    default:
                        break;
                }
                break;

            case 'click':
                this.close();
                flag = true;
                break;

            default:
                break;
        }

        if (flag) {
            event.stopPropagation();
            event.preventDefault();
        }
    };

    DatePickerDialog.prototype.handleNextYearButton = function (event) {
        var flag = false;

        switch (event.type) {
            case 'keydown':
                switch (event.key) {
                    case 'Esc':
                    case 'Escape':
                        this.close();
                        flag = true;
                        break;

                    case 'Enter':
                        this.moveToNextYear();
                        this.setFocusDay(false);
                        flag = true;
                        break;
                }

                break;

            case 'click':
                this.moveToNextYear();
                this.setFocusDay(false);
                break;

            default:
                break;
        }

        if (flag) {
            event.stopPropagation();
            event.preventDefault();
        }
    };

    DatePickerDialog.prototype.handlePreviousYearButton = function (event) {
        var flag = false;

        switch (event.type) {
            case 'keydown':
                switch (event.key) {
                    case 'Enter':
                        this.moveToPreviousYear();
                        this.setFocusDay(false);
                        flag = true;
                        break;

                    case 'Tab':
                        if (event.shiftKey) {
                            this.okButtonNode.focus();
                            flag = true;
                        }
                        break;

                    case 'Esc':
                    case 'Escape':
                        this.close();
                        flag = true;
                        break;

                    default:
                        break;
                }

                break;

            case 'click':
                this.moveToPreviousYear();
                this.setFocusDay(false);
                break;

            default:
                break;
        }

        if (flag) {
            event.stopPropagation();
            event.preventDefault();
        }
    };

    DatePickerDialog.prototype.handleNextMonthButton = function (event) {
        var flag = false;

        switch (event.type) {
            case 'keydown':
                switch (event.key) {
                    case 'Esc':
                    case 'Escape':
                        this.close();
                        flag = true;
                        break;

                    case 'Enter':
                        this.moveToNextMonth();
                        this.setFocusDay(false);
                        flag = true;
                        break;
                }

                break;

            case 'click':
                this.moveToNextMonth();
                this.setFocusDay(false);
                break;

            default:
                break;
        }

        if (flag) {
            event.stopPropagation();
            event.preventDefault();
        }
    };

    DatePickerDialog.prototype.handlePreviousMonthButton = function (event) {
        var flag = false;

        switch (event.type) {
            case 'keydown':
                switch (event.key) {
                    case 'Esc':
                    case 'Escape':
                        this.close();
                        flag = true;
                        break;

                    case 'Enter':
                        this.moveToPreviousMonth();
                        this.setFocusDay(false);
                        flag = true;
                        break;
                }

                break;

            case 'click':
                this.moveToPreviousMonth();
                this.setFocusDay(false);
                flag = true;
                break;

            default:
                break;
        }

        if (flag) {
            event.stopPropagation();
            event.preventDefault();
        }
    };

    DatePickerDialog.prototype.handleDayKeyDown = function (event) {
        var flag = false;

        switch (event.key) {
            case 'Esc':
            case 'Escape':
                this.close();
                break;

            case ' ':
                this.setTextboxDate(event.currentTarget);
                flag = true;
                break;

            case 'Enter':
                this.setTextboxDate(event.currentTarget);
                this.close();
                flag = true;
                break;

            case 'Tab':
                this.cancelButtonNode.focus();
                if (event.shiftKey) {
                    this.nextYearNode.focus();
                }
                this.setMessage('');
                flag = true;
                break;

            case 'Right':
            case 'ArrowRight':
                this.moveFocusToNextDay();
                flag = true;
                break;

            case 'Left':
            case 'ArrowLeft':
                this.moveFocusToPreviousDay();
                flag = true;
                break;

            case 'Down':
            case 'ArrowDown':
                this.moveFocusToNextWeek();
                flag = true;
                break;

            case 'Up':
            case 'ArrowUp':
                this.moveFocusToPreviousWeek();
                flag = true;
                break;

            case 'PageUp':
                if (event.shiftKey) {
                    this.moveToPreviousYear();
                } else {
                    this.moveToPreviousMonth();
                }
                this.setFocusDay();
                flag = true;
                break;

            case 'PageDown':
                if (event.shiftKey) {
                    this.moveToNextYear();
                } else {
                    this.moveToNextMonth();
                }
                this.setFocusDay();
                flag = true;
                break;

            case 'Home':
                this.moveFocusToFirstDayOfWeek();
                flag = true;
                break;

            case 'End':
                this.moveFocusToLastDayOfWeek();
                flag = true;
                break;
        }

        if (flag) {
            event.stopPropagation();
            event.preventDefault();
        }
    };

    DatePickerDialog.prototype.handleDayClick = function (event) {
        if (!this.isDayDisabled(event.currentTarget) && event.which !== 3) {
            this.setTextboxDate(event.currentTarget);
            this.close();
        }

        event.stopPropagation();
        event.preventDefault();
    };

    DatePickerDialog.prototype.handleDayFocus = function () {
        this.setMessage(this.messageCursorKeys);
    };

    DatePickerDialog.prototype.handleButtonKeydown = function (event) {
        if (event.key === 'Enter' || event.key === ' ') {
            this.open();
            this.setFocusDay();

            event.stopPropagation();
            event.preventDefault();
        }
    };

    DatePickerDialog.prototype.handleButtonClick = function (event) {
        if (this.isOpen()) {
            this.close();
        } else {
            this.open();
            this.setFocusDay();
        }

        event.stopPropagation();
        event.preventDefault();
    };

    DatePickerDialog.prototype.handleBackgroundMouseUp = function (event) {
        if (
            !this.buttonNode.contains(event.target) &&
            !this.dialogNode.contains(event.target)
        ) {
            if (this.isOpen()) {
                this.close(false);
                event.stopPropagation();
                event.preventDefault();
            }
        }
    };

    // Initialize menu button date picker

    window.addEventListener('load', function () {
        var datePickers = document.querySelectorAll('.datepicker');

        datePickers.forEach(function (dp) {
            new DatePickerDialog(dp);
        });
    });


</script>


<style>

</style>


<div id="myDatepicker" class="datepicker">

    <div class="date">
        <label for="id-textbox-1" style="" display:none>Date</label>
        <h3>Jour de Rendez-vous</h3>

        legende : <span style="background:red;color:#fff">Jour Ferrier</span> <span style="background:#eee">Jour ouvrable</span>
        <br>
        horraire : Matin 8h a 13h - Soir 13h30 a 17h

        <div class="group">
            <input style="opacity:0" required name="date_rdv_demande" type="text" placeholder="mm/dd/yyyy"
                   id="id-textbox-1" aria-describedby="id-description-1">
            <button id="mondecl" type="button" class="icon" aria-label="Choose Date" style="display:none">
                calendrier
            </button>

        </div>

    </div>

    <div id="id-datepicker-1" class="datepicker-dialog" role="dialog" aria-modal="true" aria-label="Choose Date">

        <div class="header">

            <button type="button" class="prev-year" aria-label="previous year">
                < Annee
            </button>

            <button type="button" class="prev-month" aria-label="previous month">
                < Mois
            </button>

            <h2 id="id-grid-label" class="month-year" aria-live="polite">
                February 2020
            </h2>

            <button type="button" class="next-month" aria-label="next month">
                Mois >
            </button>

            <button type="button" class="next-year" aria-label="next year">
                Annee >
            </button>
        </div>

        <div style="display:block;width:100%" class="table-wrap">
            <table style="display:block;width:100%" class="dates" role="grid" aria-labelledby="id-grid-label">
                <thead>
                <tr>
                    <th scope="col" abbr="Dimanche">Dimanche</th>
                    <th scope="col" abbr="Lundi">Lundi</th>
                    <th scope="col" abbr="Mardi">Mardi</th>
                    <th scope="col" abbr="Mercredi">Mercredi</th>
                    <th scope="col" abbr="Jeudi">Jeudi</th>
                    <th scope="col" abbr="Vendredi">Vendredi</th>
                    <th scope="col" abbr="Samedi">Samedi</th>
                </tr>
                </thead>

                <tbody style='width:100%'>
                <tr>
                    <td class="disabled" tabindex="-1"></td>
                    <td class="disabled" tabindex="-1"></td>
                    <td class="disabled" tabindex="-1"></td>
                    <td class="disabled" tabindex="-1"></td>
                    <td class="disabled" tabindex="-1"></td>
                    <td class="disabled" tabindex="-1"></td>
                    <td id="pink" tabindex="-1" data-date="2020-02-01">1</td>
                </tr>
                <tr>
                    <td id="pinker" tabindex="-1" data-date="2020-02-02">2</td>
                    <td id="pinker" tabindex="-1" data-date="2020-02-03">3</td>
                    <td id="pinker" tabindex="-1" data-date="2020-02-04">4</td>
                    <td id="pinker" tabindex="-1" data-date="2020-02-05">5</td>
                    <td id="pinker" tabindex="-1" data-date="2020-02-06">6</td>
                    <td id="pinker" tabindex="-1" data-date="2020-02-07">7</td>
                    <td style="color:red" tabindex="-1" data-date="2020-02-08">8</td>
                </tr>
                <tr>
                    <td id="pinker" tabindex="-1" data-date="2020-02-09">9</td>
                    <td id="pinker" tabindex="-1" data-date="2020-02-10">10</td>
                    <td id="pinker" tabindex="-1" data-date="2020-02-11">11</td>
                    <td id="pinker" tabindex="-1" data-date="2020-02-12">12</td>
                    <td id="pinker" tabindex="-1" data-date="2020-02-13">13</td>
                    <td tabindex="0" data-date="2020-02-14" role="gridcell" aria-selected="true">14</td>
                    <td id="pink" tabindex="-1" data-date="2020-02-15">15</td>
                </tr>
                <tr>
                    <td id="pinker" tabindex="-1" data-date="2020-02-16">16</td>
                    <td id="pinker" tabindex="-1" data-date="2020-02-17">17</td>
                    <td id="pinker" tabindex="-1" data-date="2020-02-18">18</td>
                    <td id="pinker" tabindex="-1" data-date="2020-02-19">19</td>
                    <td id="pinker" tabindex="-1" data-date="2020-02-20">20</td>
                    <td id="pinker" tabindex="-1" data-date="2020-02-21">21</td>
                    <td id="pink" tabindex="-1" data-date="2020-02-22">22</td>
                </tr>
                <tr>
                    <td id="pinker" tabindex="-1" data-date="2020-02-23">23</td>
                    <td id="pinker" tabindex="-1" data-date="2020-02-24">24</td>
                    <td id="pinker" tabindex="-1" data-date="2020-02-25">25</td>
                    <td id="pinker" tabindex="-1" data-date="2020-02-26">26</td>
                    <td id="pinker" tabindex="-1" data-date="2020-02-27">27</td>
                    <td id="pinker" tabindex="-1" data-date="2020-02-28">28</td>
                    <td id="pink" tabindex="-1" data-date="2020-02-29">29</td>
                </tr>
                <tr>
                    <td id="pinker" tabindex="-1" data-date="2020-02-30">30</td>
                    <td id="pinker" tabindex="-1" data-date="2020-02-31">31</td>
                    <td class="disabled" tabindex="-1"></td>
                    <td class="disabled" tabindex="-1"></td>
                    <td class="disabled" tabindex="-1"></td>
                    <td class="disabled" tabindex="-1"></td>
                    <td class="disabled" tabindex="-1"></td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="dialog-ok-cancel-group">
            <button class="dialog-button" value="cancel" style="display:none">
                Annuler
            </button>
            <button class="dialog-button" value="ok" style="display:none">
                Choisir
            </button>
        </div>
        <div class="dialog-message" aria-live="polite"></div>

    </div>
</div>


<br><br><br>


<script>
    function simulateClick() {
        var cb = document.getElementById("mondecl");
        if (cb.dispatchEvent) {
            var evt = document.createEvent("MouseEvents");
            evt.initEvent("click", true, true);

            cb.dispatchEvent(evt);
        } else {
            cb.click();
        }
    }

    window.onload = (event) => {
        $("#mondecl").click();


        document.getElementById('mondecl').click();
        simulateClick();


        document.querySelector("[myAttribute='aValue']");

    };

    /*
    document.body.addEventListener('click', function(e) {

    //alert(1);
    document.querySelector("[data-date='2022-11-05']").style.background = "red";;

    });
    */

    @php
        $jf="";
        foreach( $jourferiers as $jourferier ){
            $jf .= "'$jourferier->date_jfpe', ";
        }
    @endphp

    setInterval(function () {

        var divs = document.querySelectorAll('[data-date]');

        for (i = 0; i < divs.length; ++i) {
            /*if( divs[i].getAttribute("data-date") == '2022-11-08' )*/
            if ([<?php echo $jf; ?>].includes(divs[i].getAttribute("data-date"))) {
                divs[i].style.background = "red";
            } else {
                divs[i].style.background = null;
            }

            // divs[i].style.background = "green";
        }

        //document.querySelector("[data-date='2022-11-08']").style.background = "red";
    }, 1000);

</script>

