<template>
    <div class="timeWorkConteer">
        <div v-if="open_close_firm" class="h6 text-primary fw-300">{{$t('open_firm')}}</div>
        <div v-if="!open_close_firm" class="h6 text-primary fw-300">
            {{$t('close_firm')}}
            <svg
                @click="timeWorkShowHidden=!timeWorkShowHidden"
                class="icon icon-arrow-alt-circle-down close_firm"
                :class="{active:timeWorkShowHidden}"
            >
                <use xlink:href="/img/svg/sprite.svg#arrow-alt-circle-down"/>
            </svg>
        </div>
        <div v-if="open_close_firm" class="time-block">
            <img src="/img/svg/clock.svg" alt/>
            {{text_open_close}}
            <svg
                @click="timeWorkShowHidden=!timeWorkShowHidden"
                class="icon icon-arrow-alt-circle-down"
                :class="{active:timeWorkShowHidden}"
            >
                <use xlink:href="/img/svg/sprite.svg#arrow-alt-circle-down"/>
            </svg>
        </div>
        <div v-show-slide:400:ease="timeWorkShowHidden" class="timeWorkShowHidden">
            <div v-if="!time_work.dayMo.notwork" class="h6 text-primary fw-300">
                <span>{{$t('dayMo')}}</span>
                {{time_work.dayMo.start}} - {{time_work.dayMo.end}}
            </div>
            <div v-if="!time_work.dayTu.notwork" class="h6 text-primary fw-300">
                <span>{{$t('dayTu')}}</span>
                {{time_work.dayTu.start}} - {{time_work.dayTu.end}}
            </div>
            <div v-if="!time_work.dayWE.notwork" class="h6 text-primary fw-300">
                <span>{{$t('dayWE')}}</span>
                {{time_work.dayWE.start}} - {{time_work.dayWE.end}}
            </div>
            <div v-if="!time_work.dayTH.notwork" class="h6 text-primary fw-300">
                <span>{{$t('dayTH')}}</span>
                {{time_work.dayTH.start}} - {{time_work.dayTH.end}}
            </div>

            <div v-if="!time_work.dayFR.notwork" class="h6 text-primary fw-300">
                <span>{{$t('dayFR')}}</span>
                {{time_work.dayFR.start}} - {{time_work.dayFR.end}}
            </div>

            <div v-if="!time_work.daySA.notwork" class="h6 text-primary fw-300">
                <span>{{$t('daySA')}}</span>
                {{time_work.daySA.start}} - {{time_work.daySA.end}}
            </div>
            <div v-if="!time_work.daySU.notwork" class="h6 text-primary fw-300">
                <span>{{$t('daySU')}}</span>
                {{time_work.daySU.start}} - {{time_work.daySU.end}}
            </div>
            <div class="border-bottom border-light mb-3"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "TimeWork",
        data() {
            return {
                timeWorkShowHidden: false,
                open_close_firm: false,
                text_open_close: ""
            };
        },
        props: ["time_value"],
        computed: {
            time_work() {
                if (typeof this.time_value == "string") {
                    return JSON.parse(this.time_value);
                }
                return this.time_value;
            }
        },
        watch: {
            time_value: {
                immediate: true,
                handler(to, from) {
                    this.timeWorkShowHidden = false;
                    this.open_close_firm = false;
                    this.text_open_close = "";
                    this.isWork();
                }
            }
        },
        methods: {
            isWork() {
                let r = false;
                let d = new Date();
                let day = d.getDay();
                let hours = d.getHours();
                // hours=15;
                // day = 5;
                switch (day) {
                    case 1:
                        if (!this.time_work.dayMo.notwork) {
                            let start = this.time_work.dayMo.start;
                            let end = this.time_work.dayMo.end;
                            if (start !== null && end !== null) {
                                let start_hours = start.split(":");
                                let end_hours = end.split(":");
                                if (
                                    parseInt(start_hours[0]) <= hours &&
                                    hours <= parseInt(end_hours[0])
                                ) {
                                    this.text_open_close = start + " - " + end;
                                    r = true;
                                }
                            }
                        }
                        break;
                    case 2:
                        if (!this.time_work.dayTu.notwork) {
                            let start = this.time_work.dayTu.start;
                            let end = this.time_work.dayTu.end;
                            if (start !== null && end !== null) {
                                let start_hours = start.split(":");
                                let end_hours = end.split(":");
                                if (
                                    parseInt(start_hours[0]) <= hours &&
                                    hours <= parseInt(end_hours[0])
                                ) {
                                    this.text_open_close = start + " - " + end;
                                    r = true;
                                }
                            }
                        }
                        break;

                    case 3:
                        if (!this.time_work.dayWE.notwork) {
                            let start = this.time_work.dayWE.start;
                            let end = this.time_work.dayWE.end;
                            if (start !== null && end !== null) {
                                let start_hours = start.split(":");
                                let end_hours = end.split(":");
                                if (
                                    parseInt(start_hours[0]) <= hours &&
                                    hours <= parseInt(end_hours[0])
                                ) {
                                    this.text_open_close = start + " - " + end;
                                    r = true;
                                }
                            }
                        }
                        break;

                    case 4:
                        if (!this.time_work.dayTH.notwork) {
                            let start = this.time_work.dayTH.start;
                            let end = this.time_work.dayTH.end;
                            if (start !== null && end !== null) {
                                let start_hours = start.split(":");
                                let end_hours = end.split(":");
                                if (
                                    parseInt(start_hours[0]) <= hours &&
                                    hours <= parseInt(end_hours[0])
                                ) {
                                    this.text_open_close = start + " - " + end;
                                    r = true;
                                }
                            }
                        }
                        break;

                    case 5:
                        if (!this.time_work.dayFR.notwork) {
                            let start = this.time_work.dayFR.start;
                            let end = this.time_work.dayFR.end;
                            if (start !== null && end !== null) {
                                let start_hours = start.split(":");
                                let end_hours = end.split(":");
                                if (
                                    parseInt(start_hours[0]) <= hours &&
                                    hours <= parseInt(end_hours[0])
                                ) {
                                    this.text_open_close = start + " - " + end;
                                    r = true;
                                }
                            }
                        }
                        break;

                    case 5:
                        if (!this.time_work.daySA.notwork) {
                            let start = this.time_work.daySA.start;
                            let end = this.time_work.daySA.end;
                            if (start !== null && end !== null) {
                                let start_hours = start.split(":");
                                let end_hours = end.split(":");
                                if (
                                    parseInt(start_hours[0]) <= hours &&
                                    hours <= parseInt(end_hours[0])
                                ) {
                                    this.text_open_close = start + " - " + end;
                                    r = true;
                                }
                            }
                        }
                        break;
                    case 0:
                        if (!this.time_work.daySU.notwork) {
                            let start = this.time_work.daySU.start;
                            let end = this.time_work.daySU.end;
                            if (start !== null && end !== null) {
                                let start_hours = start.split(":");
                                let end_hours = end.split(":");
                                if (
                                    parseInt(start_hours[0]) <= hours &&
                                    hours <= parseInt(end_hours[0])
                                ) {
                                    this.text_open_close = start + " - " + end;
                                    r = true;
                                }
                            }
                        }
                        break;
                }
                this.open_close_firm = r;
            }
        }
    };
</script>

