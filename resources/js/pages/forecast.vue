<template>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Weather Forecast</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <div class="d-flex gap-2">
                                    <select class="w-auto form-select" @change="getForecast" v-model="selected_station">
                                        <option v-for="station in stations" :value="station.id">{{ station.name }}</option>
                                    </select>
                                    <p class="d-none d-md-block my-auto">Station</p>
                                </div>
                            </div>
                            <div class="px-2 d-block d-md-flex gap-5">
                                <div>
                                    <p class="mb-2 text-sm" v-if="forecasts">{{ current_forecast.date }}</p>
                                    <div class="d-flex my-auto gap-2">
                                        <img class="img-fluid mt-2" v-if="forecasts" :src='current_forecast.img' style="max-height:4em;">
                                        <div>
                                            <div class="d-flex my-auto gap-2" v-if="forecasts">
                                                <p class="my-auto display-6">{{ current_forecast.temperature }}</p>
                                                <p><sup>o</sup>C</p>
                                            </div>
                                            <p class="my-auto fw-bold text-xs">{{ current_forecast.weather }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-auto">
                                    <div class="d-block d-md-flex gap-2">
                                        <div class="my-auto border-start ps-2 text-xs">
                                            <p class="my-1">Rainfall: <span class="fw-bold" v-if="forecasts">{{ current_forecast.probability }}% | {{ current_forecast.rain }} mm</span></p>
                                            <p class="my-1">Humidity: <span class="fw-bold" v-if="forecasts">{{ current_forecast.humidity }}%</span></p>
                                            <p class="my-1">Wind: <span class="fw-bold" v-if="forecasts">{{ current_forecast.wind_speed }} m/s</span></p>
                                            <button type="button" class="btn btn-sm btn-warning" v-if="forecasts" data-bs-toggle="modal" data-bs-target="#weather-modal" @click="getDailyForecast(current_forecast.datestring)">Today's Weather</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4">
                            <p class="mb-2 fw-bold text-uppercase">7 Days Forecast</p>
                            <div class="d-flex gap-2">
                                <div id="scrollLeft" class="my-auto d-none" @click="scrollLeft">
                                    <button type="button" class="btn p-0"><i class="fs-4 bx bx-caret-left"></i></button>
                                </div>
                                <div id="weather-bar" class="d-flex gap-2 overflow-auto" @scroll="checkScroll">
                                    <div class="children position-relative bg-success rounded text-white py-2 px-3" v-for="forecast in daily_forecasts.slice(1)" style="cursor: grab;">
                                        <p class="fs-6 my-1 fw-bold text-nowrap">{{ forecast.date }}</p>
                                        <button type="button" class="d-none d-md-block text-white btn btn-lg p-0 position-absolute end-0 me-2 top-0 mt-2" data-bs-toggle="modal" data-bs-target="#weather-modal" @click="getDailyForecast(forecast.datestring)"><i class="bx bx-fullscreen"></i></button>
                                        <div class="d-flex gap-2">
                                            <div class="px-2">
                                                <div class="my-auto">
                                                    <img class="img-fluid my-1" v-bind:src="forecast.img" style="width:auto;max-height:4em;">
                                                    <p class="my-auto text-xs text-nowrap">{{ forecast.weather }}</p>
                                                </div>
                                            </div>

                                            <div class="my-auto border-start border-2 ps-3 text-xs">
                                                <div class="d-flex my-auto gap-1">
                                                    <p class="my-auto fs-4 fw-bold">{{ forecast.temperature.toFixed(1) }}</p>
                                                    <p><sup>o</sup>C</p>
                                                </div>
                                                <p class="my-auto text-nowrap" title="rain probability"><i class="bx bx-cloud-rain"></i> {{ forecast.probability }}%</p>
                                                <p class="my-auto text-nowrap" title="rain">{{ forecast.rain.toFixed(1) }} mm</p>
                                                <!-- <p class="my-1 text-nowrap"><span title="humidity"><i class="bx bx-tachometer"></i> {{ forecast.humidity.toFixed(0) }}%</span> | <span title="wind speed"><i class="bx bx-wind"></i> {{ forecast.wind_speed.toFixed(1) }} m/s</span></p> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>                            
                                <div id="scrollRight" class="my-auto" @click="scrollRight">
                                    <button type="button" class="btn p-0"><i class="fs-4 bx bx-caret-right"></i></button>
                                </div>
                            </div>
                            <div class="modal fade" id="weather-modal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel" v-if="current_modal">{{ current_modal }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-sm text-xs table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center align-middle">Time</th>
                                                        <th class="text-center align-middle">Rainfall<br>(mm)</th>
                                                        <th class="text-center align-middle">Temp<br>(<sup>o</sup>C)</th>
                                                        <th class="text-center align-middle">Humidity<br>(%)</th>
                                                        <th class="text-center align-middle">Wind<br>(m/s)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="row in modal">
                                                        <td class="text-center text-nowrap"> {{ row.date.slice(-5) }}</td>
                                                        <td class="text-center text-nowrap"> {{ row.rain }} <sub class="text-xxs">({{ row.probability }}%)</sub></td>
                                                        <td class="text-center text-nowrap"> {{ row.temperature }}</td>
                                                        <td class="text-center text-nowrap"> {{ row.humidity }}</td>
                                                        <td class="text-center text-nowrap"> {{ row.wind_speed }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
                                            <button class="btn btn-sm btn-success"><i class="bx bx-download"></i> Export</button>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>                    
                </div>
            </div>
        </section>
    </main><!-- End #main -->    
</template>

<script>  

    export default {
        data() {
            return {
                stations: null,
                current_forecast: {
                    weather: null,
                    humidity: null,
                    temperature: null,
                    img: null,
                    rain: null,
                    wind_speed: null,
                    probability: null,
                    date: null,
                    datestring: null
                },
                modal: null,
                current_modal: null,
                daily_forecasts: null,
                forecasts: null,
                selected_station: "",
                date_start: moment().format("YYYY-MM-DD"),
                date_end: moment().add(10, 'days').format("YYYY-MM-DD")
            }
        },
        methods: {
            getForecast: function() {
                axios.get('/api/forecast', { params: { id: this.selected_station,date_start:this.date_start,date_end:this.date_end } })
                .then(response => {
                    this.forecasts = response.data.data;
                    this.daily_forecasts = response.data.data_daily;
                    this.current_forecast = this.forecasts.filter(function(obj) {
                        return moment(obj.date).format("YYYY-MM-DD HH") ===  moment().format("YYYY-MM-DD HH")
                    })[0];
                });
            },
            getDailyForecast: function(date) {
                this.modal = this.forecasts.filter(function(obj) {
                    return moment(obj.date).format("YYYY-MM-DD") ===  moment(date).format("YYYY-MM-DD")
                });
                this.current_modal = moment(date).format("DD MMMM YYYY");
            },            
            checkScroll: function(e){
                if (e.target.scrollLeft > 0) {
                    document.getElementById("scrollLeft").classList.remove("d-none")
                }else{
                    document.getElementById("scrollLeft").classList.add("d-none")
                }
                if (parseInt(e.target.scrollLeft) == parseInt(e.target.scrollWidth - e.target.clientWidth)) {
                    document.getElementById("scrollRight").classList.add("d-none")
                }else{
                    document.getElementById("scrollRight").classList.remove("d-none")
                }
            },
            scrollLeft: function(){
                document.getElementById('weather-bar').scrollBy({
                    left: -100,
                    behavior: 'smooth'
                });
            },
            scrollRight: function(){
                document.getElementById('weather-bar').scrollBy({
                    left: 100,
                    behavior: 'smooth'
                });
            }
        },
        created() {
            document.getElementById("nav-link-forecast").classList.remove("collapsed");
            axios.get('/api/nearest-station')
            .then(response => {
                this.selected_station = response.data.data.id;
                this.getForecast();
            });
            axios.get('/api/station-list')
            .then(response => {
                this.stations = response.data.data;
            });
        }
    };
</script>