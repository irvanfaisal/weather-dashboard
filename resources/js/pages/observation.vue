<template>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Weather Observation</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                    <div class="col-md-6" v-for="station in stations">
                        <ObservationChart v-bind="station" />
                    </div>
            </div>
        </section>

    </main><!-- End #main -->    
</template>

<script>
    import ObservationChart from "../components/chart.vue";
    export default {
        components: {
          ObservationChart
        },
        props: {
          station: Object
        },        
        data() {
                return {
                    stations: [],
                }
        },
        created() {
            document.getElementById("nav-link-observation").classList.remove("collapsed");
            axios.get('/api/station-list')
            .then(response => {
                this.stations = response.data.data;
            });
        }   
    };
</script>