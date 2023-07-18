<template>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>API for PAMA Weather Services</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                </ol>
            </nav>
        </div>
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="py-3">
                                    <h5 class="fw-bold my-1">Short-Term Forecast</h5>
                                    <p class="my-1">Method: <span class="bg-warning text-white px-2 rounded">POST</span></p>
                                    <code class="p-1 my-1 d-block" style="background-color:#ddd;">
                                        /api/shortterm?username={Username}&apikey={apikey}&date={YYYY-mm-dd}
                                    </code>
                                    <p class="my-1"><span class="fw-bold">username (required)</span>: Your username for the API</p>
                                    <p class="my-1"><span class="fw-bold">apikey (required)</span>: Your apikey for the API</p>
                                    <p class="my-1"><span class="fw-bold">date (optional)</span>: Start date of forecast with format YYYY-mm-dd</p>
                                    <p class="my-1">Example:</p>
                                    <code class="p-1 my-1 d-block" style="background-color:#ddd;">
                                        /api/shortterm?username=pama&apikey=apikey&date=2022-08-08
                                    </code>
                                    <p class="my-1">Response:</p>
                                    <pre class="p-1 my-1 d-block" style="background-color:#ddd;">[
    {"station":"ASMI","date":"2022-08-14 00:00:00","value":0,"category":"Cerah","event":0,"duration_event":0,"acc_event":0,"duration_total":0,"acc_total":0,"event_total":0},
    {"station":"ASMI","date":"2022-08-14 01:00:00","value":1.64,"category":"Hujan Ringan","event":1,"duration_event":1,"acc_event":1.64,"duration_total":1,"acc_total":1.64,"event_total":1},
    {"station":"ASMI","date":"2022-08-14 02:00:00","value":2.5,"category":"Hujan Ringan","event":1,"duration_event":2,"acc_event":4.14,"duration_total":2,"acc_total":4.14,"event_total":1},
    {"station":"ASMI","date":"2022-08-14 03:00:00","value":0,"category":"Cerah","event":0,"duration_event":0,"acc_event":0,"duration_total":2,"acc_total":4.14,"event_total":1},
    {"station":"ASMI","date":"2022-08-14 04:00:00","value":0,"category":"Cerah","event":0,"duration_event":0,"acc_event":0,"duration_total":2,"acc_total":4.14,"event_total":1},
    {"station":"ASMI","date":"2022-08-14 05:00:00","value":3.36,"category":"Hujan Ringan","event":2,"duration_event":1,"acc_event":3.36,"duration_total":3,"acc_total":7.5,"event_total":2},
    {"station":"ASMI","date":"2022-08-14 06:00:00","value":2.97,"category":"Hujan Ringan","event":2,"duration_event":2,"acc_event":6.33,"duration_total":4,"acc_total":10.47,"event_total":2},
    {"station":"ASMI","date":"2022-08-14 07:00:00","value":2.22,"category":"Hujan Ringan","event":2,"duration_event":3,"acc_event":8.55,"duration_total":5,"acc_total":12.69,"event_total":2},
    {"station":"ASMI","date":"2022-08-14 08:00:00","value":2.72,"category":"Hujan Ringan","event":2,"duration_event":4,"acc_event":11.27,"duration_total":6,"acc_total":15.41,"event_total":2},
    {"station":"ASMI","date":"2022-08-14 09:00:00","value":3.12,"category":"Hujan Ringan","event":2,"duration_event":5,"acc_event":14.39,"duration_total":7,"acc_total":18.53,"event_total":2},
    {"station":"ASMI","date":"2022-08-14 10:00:00","value":2.2,"category":"Hujan Ringan","event":2,"duration_event":6,"acc_event":16.59,"duration_total":8,"acc_total":20.73,"event_total":2},
    {"station":"ASMI","date":"2022-08-14 11:00:00","value":0,"category":"Cerah","event":0,"duration_event":0,"acc_event":0,"duration_total":8,"acc_total":20.73,"event_total":2},
    {"station":"ASMI","date":"2022-08-14 12:00:00","value":0,"category":"Cerah","event":0,"duration_event":0,"acc_event":0,"duration_total":8,"acc_total":20.73,"event_total":2},
    {"station":"ASMI","date":"2022-08-14 13:00:00","value":0,"category":"Cerah","event":0,"duration_event":0,"acc_event":0,"duration_total":8,"acc_total":20.73,"event_total":2},
    {"station":"ASMI","date":"2022-08-14 14:00:00","value":0,"category":"Cerah","event":0,"duration_event":0,"acc_event":0,"duration_total":8,"acc_total":20.73,"event_total":2},
    {"station":"ASMI","date":"2022-08-14 15:00:00","value":0,"category":"Cerah","event":0,"duration_event":0,"acc_event":0,"duration_total":8,"acc_total":20.73,"event_total":2},
    {"station":"ASMI","date":"2022-08-14 16:00:00","value":0,"category":"Cerah","event":0,"duration_event":0,"acc_event":0,"duration_total":8,"acc_total":20.73,"event_total":2},
    {"station":"ASMI","date":"2022-08-14 17:00:00","value":0,"category":"Cerah","event":0,"duration_event":0,"acc_event":0,"duration_total":8,"acc_total":20.73,"event_total":2},
    {"station":"ASMI","date":"2022-08-14 18:00:00","value":0,"category":"Cerah","event":0,"duration_event":0,"acc_event":0,"duration_total":8,"acc_total":20.73,"event_total":2},
    {"station":"ASMI","date":"2022-08-14 19:00:00","value":0,"category":"Cerah","event":0,"duration_event":0,"acc_event":0,"duration_total":8,"acc_total":20.73,"event_total":2},
    {"station":"ASMI","date":"2022-08-14 20:00:00","value":0,"category":"Cerah","event":0,"duration_event":0,"acc_event":0,"duration_total":8,"acc_total":20.73,"event_total":2},
    {"station":"ASMI","date":"2022-08-14 21:00:00","value":0,"category":"Cerah","event":0,"duration_event":0,"acc_event":0,"duration_total":8,"acc_total":20.73,"event_total":2},
    {"station":"ASMI","date":"2022-08-14 22:00:00","value":0,"category":"Cerah","event":0,"duration_event":0,"acc_event":0,"duration_total":8,"acc_total":20.73,"event_total":2},
    {"station":"ASMI","date":"2022-08-14 23:00:00","value":0,"category":"Cerah","event":0,"duration_event":0,"acc_event":0,"duration_total":8,"acc_total":20.73,"event_total":2}
]</pre>

                                    <p class="my-1">Description:</p>
                                    <p class="my-1"><span class="fw-bold">station</span>: Name of the station</p>
                                    <p class="my-1"><span class="fw-bold">date</span>: Date of the forecast</p>
                                    <p class="my-1"><span class="fw-bold">value</span>: Value of rain (mm)</p>
                                    <p class="my-1"><span class="fw-bold">event</span>: Number of event</p>
                                    <p class="my-1"><span class="fw-bold">category</span>: rain category based on BMKG</p>
                                    <p class="my-1">
                                        - Light: 1-5 mm/hour <br>
                                        - Moderate: 5-10 mm/hour <br>
                                        - Heavy: 10-20 mm/hour <br>
                                        - Extreme: >20 mm/hour
                                    </p>
                                    <p class="my-1"><span class="fw-bold">duration_event</span>: Duration of rain in one event</p>
                                    <p class="my-1"><span class="fw-bold">acc_event</span>: Rain accumulation in one event</p>
                                    <p class="my-1"><span class="fw-bold">duration_total</span>: Total duration of rain in one day</p>
                                    <p class="my-1"><span class="fw-bold">acc_total</span>: Total rain accumulation in one day</p>
                                    <p class="my-1"><span class="fw-bold">event_total</span>: Total rain event in one day</p>

                                </div>                          
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="py-3">
                                    <h5 class="fw-bold my-1">Long-Term Forecast</h5>
                                    <p class="my-1">Method: <span class="bg-warning text-white px-2 rounded">POST</span></p>
                                    <code class="my-2 p-1" style="background-color:#ddd;">
                                        /api/longterm?username={Username}&apikey={apikey}&date={YYYY-mm}
                                    </code>
                                    <p class="my-1"><span class="fw-bold">username (required)</span>: Your username for the API</p>
                                    <p class="my-1"><span class="fw-bold">apikey (required)</span>: Your apikey for the API</p>
                                    <p class="my-1"><span class="fw-bold">date (optional)</span>: Start date of forecast with format YYYY-mm</p>
                                    <p class="my-1">Example:</p>
                                    <code class="p-1 my-1 d-block" style="background-color:#ddd;">
                                        /api/longterm?username=pama&apikey=apikey&date=2022-08
                                    </code>
                                    <p class="my-1">Response:</p>
                                    <pre class="p-1 my-1 d-block" style="background-color:#ddd;">[
    {"station":"ASMI","date":"2022-08-19","value":4.5,"duration":2,"category":"Cerah","event":1,"duration_total":2,"acc_total":4.5,"event_total":1},
    {"station":"ASMI","date":"2022-08-20","value":0,"duration":0,"category":"Cerah","event":0,"duration_total":2,"acc_total":4.5,"event_total":1},
    {"station":"ASMI","date":"2022-08-21","value":0,"duration":0,"category":"Cerah","event":0,"duration_total":2,"acc_total":4.5,"event_total":1},
    {"station":"ASMI","date":"2022-08-22","value":0,"duration":0,"category":"Cerah","event":0,"duration_total":2,"acc_total":4.5,"event_total":1},
    {"station":"ASMI","date":"2022-08-23","value":15.46,"duration":4,"category":"Hujan Ringan","event":1,"duration_total":6,"acc_total":19.96,"event_total":2},
    {"station":"ASMI","date":"2022-08-24","value":8.5,"duration":3,"category":"Hujan Ringan","event":1,"duration_total":9,"acc_total":28.46,"event_total":2},
    {"station":"ASMI","date":"2022-08-25","value":18.73,"duration":4,"category":"Hujan Ringan","event":1,"duration_total":13,"acc_total":47.19,"event_total":2},
    {"station":"ASMI","date":"2022-08-26","value":7.76,"duration":3,"category":"Hujan Ringan","event":1,"duration_total":16,"acc_total":54.95,"event_total":2},
    {"station":"ASMI","date":"2022-08-27","value":0,"duration":0,"category":"Cerah","event":0,"duration_total":16,"acc_total":54.95,"event_total":2},
    {"station":"ASMI","date":"2022-08-28","value":2.4,"duration":2,"category":"Cerah","event":1,"duration_total":18,"acc_total":57.35,"event_total":3},
    {"station":"ASMI","date":"2022-08-29","value":0,"duration":0,"category":"Cerah","event":0,"duration_total":18,"acc_total":57.35,"event_total":3},
    {"station":"ASMI","date":"2022-08-30","value":0,"duration":0,"category":"Cerah","event":0,"duration_total":18,"acc_total":57.35,"event_total":3},
    {"station":"ASMI","date":"2022-08-31","value":0,"duration":0,"category":"Cerah","event":0,"duration_total":18,"acc_total":57.35,"event_total":3}
]</pre>
                                    <p class="my-1">Description:</p>
                                    <p class="my-1"><span class="fw-bold">station</span>: Name of the station</p>
                                    <p class="my-1"><span class="fw-bold">date</span>: Date of the forecast</p>
                                    <p class="my-1"><span class="fw-bold">value</span>: Value of rain (mm)</p>
                                    <p class="my-1"><span class="fw-bold">category</span>: rain category based on BMKG</p>
                                    <p class="my-1">
                                        - Light: &lt; 1-20 mm/day <br>
                                        - moderate: 20-50 mm/day <br>
                                        - Heavy: 50-100 mm/day <br>
                                        - Severe: 100-150 mm/day <br>
                                        - Extreme: >150 mm/day
                                    </p>
                                    <p class="my-1"><span class="fw-bold">duration</span>: Duration of rain in one event</p>
                                    <p class="my-1"><span class="fw-bold">event</span>: Number of event</p>
                                    <p class="my-1"><span class="fw-bold">duration_total</span>: Total duration of rain in one month</p>
                                    <p class="my-1"><span class="fw-bold">acc_total</span>: Total rain accumulation in one month</p>
                                    <p class="my-1"><span class="fw-bold">event_total</span>: Total rain event in one month</p>                    
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
        created() {
            document.getElementById("nav-link-home").classList.remove("collapsed");
        }   
    };    
</script>