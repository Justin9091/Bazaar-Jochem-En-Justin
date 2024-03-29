@extends('layouts.main')

@section('page-title', __('agenda.title'))

@section("main-content")
    <div>
        <link rel="dns-prefetch" href="//unpkg.com"/>
        <link rel="dns-prefetch" href="//cdn.jsdelivr.net"/>
        <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

        <div class="antialiased sans-serif bg-gray-700 h-max">
            <h1 class="text-xl font-semibold text-center">{{ __('agenda.title') }}</h1>
            <div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
                <div class="container mx-auto px-4 py-2 ">
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="flex items-center justify-between py-2 px-6">
                            <div>
                                <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                                <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                            </div>
                            <div class="border rounded-lg px-1" style="padding-top: 2px;">
                                <button
                                    type="button"
                                    class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center"
                                    :class="{'cursor-not-allowed opacity-25': month === 0 && year === minYear }"
                                    :disabled="month === 0 && year === minYear"
                                    @click="decrementMonth">
                                    <svg class="h-6 w-6 text-gray-500 inline-flex leading-none" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </button>
                                <div class="border-r inline-flex h-6"></div>
                                <button
                                    type="button"
                                    class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center"
                                    :class="{'cursor-not-allowed opacity-25': month === 11 && year === maxYear }"
                                    :disabled="month === 11 && year === maxYear"
                                    @click="incrementMonth">
                                    <svg class="h-6 w-6 text-gray-500 inline-flex leading-none" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="-mx-1 -mb-1">
                            <div class="flex flex-wrap" style="margin-bottom: -40px;">
                                <template x-for="(day, index) in days" :key="index">
                                    <div style="width: 14.26%" class="px-2 py-2">
                                        <div
                                            x-text="day"
                                            class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center">
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <div class="flex flex-wrap border-t border-l">
                                <template x-for="blankday in blankdays">
                                    <div
                                        style="width: 14.28%; height: 120px"
                                        class="text-center border-r border-b px-4 pt-2"
                                    ></div>
                                </template>
                                <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                                    <div style="width: 14.28%; height: 120px"
                                         class="px-4 pt-2 border-r border-b relative">
                                        <div
                                            x-text="date"
                                            class="inline-flex w-6 h-6 items-center justify-center text-center leading-none rounded-full transition ease-in-out duration-100"
                                            :class="{'bg-blue-500 text-white': isToday(date) == true, 'text-gray-700': isToday(date) == false }"
                                        ></div>
                                        <div style="height: 80px;" class="overflow-y-auto mt-1">
                                            <template x-for="event in events.filter(e => {
                                                const eventDate = new Date(e.event_date);
                                                return eventDate.getFullYear() === year && eventDate.getMonth() === month && eventDate.getDate() === parseInt(date);
                                                  })">
                                                <div
                                                    class="px-2 py-1 rounded-lg mt-1 overflow-hidden border border-blue-200 text-blue-800 bg-blue-100">
                                                    <p x-text="event.event_title"
                                                       class="text-sm truncate leading-tight">{{ __('agenda.event') }}</p>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <x-Utils.backbutton/>
                    </div>
                </div>
            </div>
            <script>
                const MONTH_NAMES = Object.values({!! json_encode(__('agenda.MONTH_NAMES')) !!});
                const DAYS = Object.values({!! json_encode(__('agenda.DAY_NAMES')) !!});
                const events = [];

                function app() {
                    return {
                        month: '',
                        year: '',
                        no_of_days: [],
                        blankdays: [],
                        days: DAYS,
                        events,

                        initDate() {
                            let today = new Date();
                            this.month = today.getMonth();
                            this.year = today.getFullYear();
                            this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
                        },

                        isToday(date) {
                            const today = new Date();
                            const d = new Date(this.year, this.month, date);
                            return today.toDateString() === d.toDateString();
                        },

                        getNoOfDays() {
                            let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
                            let dayOfWeek = new Date(this.year, this.month).getDay();
                            let blankdaysArray = [];
                            for (var i = 1; i <= dayOfWeek; i++) {
                                blankdaysArray.push(i);
                            }

                            let daysArray = [];
                            for (var i = 1; i <= daysInMonth; i++) {
                                daysArray.push(i);
                            }

                            this.blankdays = blankdaysArray;
                            this.no_of_days = daysArray;
                        },

                        decrementMonth() {
                            if (this.month === 0) {
                                this.month = 11;
                                this.year--;
                            } else {
                                this.month--;
                            }
                            this.getNoOfDays();
                        },

                        incrementMonth() {
                            if (this.month === 11) {
                                this.month = 0;
                                this.year++;
                            } else {
                                this.month++;
                            }
                            this.getNoOfDays();
                        }
                    };
                }

                @foreach ($rentingslist as $title => $date)
                app().events.push({
                    event_date: new Date("{{ $date }}"),
                    event_title: "{{ $title }}",
                });
                @endforeach
            </script>
        </div>
    </div>
@endsection

