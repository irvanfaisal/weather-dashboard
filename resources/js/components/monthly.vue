<template>
    <div class="card">
      <div class="card-body position-relative">
        <div class="card-title">
          <p class="fw-bold fs-5">{{ this.name }} Station</p>
        </div>
          <div class="d-flex gap-2">
              <div :id="`scrollLeft-${this.id}`" class="my-auto d-none" @click="scrollLeft">
                  <button type="button" class="btn p-0"><i class="fs-4 bx bx-caret-left"></i></button>
              </div>
              <div :id="`weather-bar-${this.id}`" class="d-flex gap-2 overflow-auto" @scroll="checkScroll">
                  <div class="children position-relative bg-success rounded text-white py-2 px-3" v-for="forecast in monthly_forecasts" style="cursor: grab;"  data-bs-toggle="modal" data-bs-target="#weather-modal" @click="getMonthlyForecast(forecast.datestring)">
                      <p class="fs-6 my-1 fw-bold text-center text-nowrap">{{ forecast.date }}</p>
                      <div class="my-auto">
                          <img class="img-fluid my-1 mx-auto d-block text-center" v-bind:src="forecast.img" style="width:auto;max-height:4em;">
                          <p class="my-auto text-xs text-nowrap mx-auto text-center">{{ forecast.weather }}</p>
                          <p class="my-auto text-nowrap mx-auto text-center" title="rain">{{ forecast.rain.toFixed(1) }} mm</p>
                      </div>
                  </div>
              </div>                            
              <div :id="`scrollRight-${this.id}`" class="my-auto" @click="scrollRight">
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
                                      <th class="align-middle">Date</th>
                                      <th class="text-center align-middle">Rainfall (mm)</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr v-for="row in modal">
                                      <td class="text-nowrap"> {{ row.date }}</td>
                                      <td class="text-center text-nowrap"> {{ row.rain }}</td>
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
        forecasts: [],
        monthly_forecasts: [],
        modal: null,
        current_modal: null,
      }
    },

    created() {
                axios.get('/api/longterm', { params: { id: this.id } })
                .then(response => {
                    this.forecasts = response.data.data;
                    this.monthly_forecasts = response.data.data_monthly;
                });            
    },
    methods: {
            checkScroll: function(e){
                if (e.target.scrollLeft > 0) {
                    document.getElementById("scrollLeft-" + this.id).classList.remove("d-none")
                }else{
                    document.getElementById("scrollLeft-" + this.id).classList.add("d-none")
                }
                if (parseInt(e.target.scrollLeft) == parseInt(e.target.scrollWidth - e.target.clientWidth)) {
                    document.getElementById("scrollRight-" + this.id).classList.add("d-none")
                }else{
                    document.getElementById("scrollRight-" + this.id).classList.remove("d-none")
                }
            },
            scrollLeft: function(){
                document.getElementById('weather-bar-' + this.id).scrollBy({
                    left: -100,
                    behavior: 'smooth'
                });
            },
            scrollRight: function(){
              console.log(this.id)
                document.getElementById('weather-bar-' + this.id).scrollBy({
                    left: 100,
                    behavior: 'smooth'
                });
            },
            getMonthlyForecast: function(date) {
                this.modal = this.forecasts.filter(function(obj) {
                    return moment(obj.date).format("YYYY-MM") ===  moment(date).format("YYYY-MM")
                });
                this.current_modal = moment(date).format("MMMM YYYY");
            },     
    }    
  };  
</script>
