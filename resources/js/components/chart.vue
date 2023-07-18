<template>
    <div class="card">
      <div class="card-body position-relative">
        <div class="card-title">
          <p class="fw-bold fs-5">{{ this.name }} Station</p>
          <p class="my-auto text-sm">{{ latest_observation.date }}</p>
        </div>
        <button type="button" class="d-none d-md-block btn btn-lg p-0 position-absolute end-0 me-3 top-0 mt-3" v-on:click="expandChart"><i class="bx bx-fullscreen"></i></button>
        <div class="mb-4">
          <div class="d-block d-md-flex gap-2">
            <div class="d-flex my-auto gap-2">
              <img class="img-fluid my-auto" :src='image' style="max-height:4em;">
              <div class="d-flex my-auto gap-2">
                <p class="display-6">{{ latest_observation.temperature }}</p>
                <p><sup>o</sup>C</p>
              </div>
            </div>
            <div class="my-auto border-start ps-2 text-xs">
              <p class="my-1">Precipication: {{ latest_observation.rain }} mm</p>
              <p class="my-1">Humidity: {{ latest_observation.humidity }}%</p>
              <p class="my-1">Wind: {{ latest_observation.wind_speed }} m/s</p>
            </div>
          </div>
        </div>

        <div class="d-block d-md-flex gap-2 mb-2">
          <div>
            <label>Start Date:</label>
            <input type="date" class="form-control form-control-sm text-xs rounded-1" v-model="date_start">
          </div>
          <div>
            <label>End Date:</label>
            <input type="date" class="form-control form-control-sm text-xs rounded-1" v-model="date_end">
          </div>
          <div class="my-auto">
            <label>&nbsp;</label>
            <button type="button" title="Filter" class="w-100 btn btn-sm btn-success my-auto bg-success" v-on:click="getObservation">Filter</button>
          </div>
          <div class="my-auto">
            <label>&nbsp;</label>
            <button type="button" title="Export" class="w-100 btn btn-sm btn-primary my-auto bg-primary text-white" v-on:click="getObservation"><i class="bx bx-download"></i></button>
          </div>
        </div>
        <!-- Line Chart -->
        <canvas :id="'chart-observation-' + this.id" style="height: 1000px;"></canvas>
        <!-- End Line CHart -->                       
      </div>
    </div>
</template>
<script>
  export default {

      props: {
        id: {
          type: Number
        },
        name: {
          type: String
        },
        lat: {
          type: Number
        },
        lon: {
          type: Number
        },
        created_at: {
          type: String
        },
        updated_at: {
          type: String
        }
      },
    data() {
      return {
        observations: [],
        latest_observation: {
          rain:null,
          date:null,
          temperature:null,
          wind_speed:null,
          wind_direction:null,
          humidity:null,
          pressure:null
        },
        image:null,
        chart: null,
        date_start: moment().add(-2, 'days').format("YYYY-MM-DD"),
        date_end: moment().format("YYYY-MM-DD"),
      }
    },

    created() {
      axios.get('/api/observation',{ params:{ id:this.id } })
      .then(response => {
          this.observations = response.data.data;
          new Chart(document.querySelector('#chart-observation-' + this.id), {
            type: 'line',            
            data: {
              labels: this.observations.map(a => moment(a.date).format("DD MMM HH:mm")),
              datasets: [{
                label: 'Rain (mm/h)',
                data: this.observations.map(a => a.rain),
                fill: false,
                borderColor: 'rgb(100, 181, 246)',
                tension: 0.2,
                borderWidth:2,
                pointRadius:3
              }]
            },
            options: {
              plugins:{
                legend:{
                  display:false
                }
              },
              scales: {
                y: {
                  beginAtZero: true
                },
                x: {
                    ticks: {
                        
                      autoSkip: true,
                      maxTicksLimit: moment(this.date_end).diff(moment(this.date_start), 'days')
                    }
                }                              
              }
            }
          });        
      });
      axios.get('/api/latestObservation',{ params:{ id:this.id } })
      .then(response => {
          this.latest_observation = response.data.data;
          this.latest_observation.date = moment(this.latest_observation.date,"YYYY-MM-DD HH:mm:ss").format("DD MMMM YYYY HH:mm")
          if (moment(this.latest_observation.date).format("H") >17 && moment(this.latest_observation.date).format("H") < 6) {
            if (this.latest_observation.rain > 0) {
              this.image = "img/night-rain.png";
            }else{
              this.image = "img/night-clear.png";
            }
          }else{
            if (this.latest_observation.rain > 0) {
              this.image = "img/day-rain.png";
            }else{
              this.image = "img/day-clear.png";
            }
          }
      });            
    },
    methods: {
      getObservation: function (event) {
        axios.get('/api/observation', { params: { id: this.id,date_start:this.date_start,date_end:this.date_end } })
        .then(response => {
            this.observations = response.data.data;
            var chart = Chart.getChart('chart-observation-' + this.id);
            chart.data.labels = this.observations.map(a => moment(a.date).format("DD MMM HH:mm"));
            chart.data.datasets[0].data = this.observations.map(a => a.rain);
            chart.options.scales.x.ticks.maxTicksLimit = moment(this.date_end).diff(moment(this.date_start), 'days');
            chart.update();       
        });
      },
      expandChart: function (event) {
        event.currentTarget.parentElement.parentElement.parentElement.classList.toggle("col-md-12");
        event.currentTarget.parentElement.parentElement.parentElement.classList.toggle("col-md-6");
        event.currentTarget.children[0].classList.toggle("bx-fullscreen");
        event.currentTarget.children[0].classList.toggle("bx-exit-fullscreen");
      }      
    }    
  };  
</script>
