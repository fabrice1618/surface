<style>
    .meteo {
        margin: 0rem;
        padding: 0rem;
    }

    body {
        overflow: hidden; /* Hide scrollbars */
    }
</style>
<div class="row">
    <div class="column col-sm-12 col-lg-9 droptrue">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h2>Planing</h2>
            </div>
            <div class="card-body">
                <img src="../img/emptps.png" alt="emploi">
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h2>Messages</h2>
            </div>
            <div class="card-body">
                <div class="slider">
                    <div class="slide-track">
                        <div class="slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/1.png" height="100"
                                 width="250" alt=""/>
                        </div>
                        <div class="slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/2.png" height="100"
                                 width="250" alt=""/>
                        </div>
                        <div class="slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/3.png" height="100"
                                 width="250" alt=""/>
                        </div>
                        <div class="slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/4.png" height="100"
                                 width="250" alt=""/>
                        </div>
                        <div class="slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/5.png" height="100"
                                 width="250" alt=""/>
                        </div>
                        <div class="slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/6.png" height="100"
                                 width="250" alt=""/>
                        </div>
                        <div class="slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/7.png" height="100"
                                 width="250" alt=""/>
                        </div>
                        <div class="slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/1.png" height="100"
                                 width="250" alt=""/>
                        </div>
                        <div class="slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/2.png" height="100"
                                 width="250" alt=""/>
                        </div>
                        <div class="slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/3.png" height="100"
                                 width="250" alt=""/>
                        </div>
                        <div class="slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/4.png" height="100"
                                 width="250" alt=""/>
                        </div>
                        <div class="slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/5.png" height="100"
                                 width="250" alt=""/>
                        </div>
                        <div class="slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/6.png" height="100"
                                 width="250" alt=""/>
                        </div>
                        <div class="slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/7.png" height="100"
                                 width="250" alt=""/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="column col-sm-12 col-lg-3 d-flex align-items-center flex-column">
        <div class="row" style="text-align:center;padding:1em 0;">
            <div class="clock">
                <div class="hand hour" data-hour-hand></div>
                <div class="hand minute" data-minute-hand></div>
                <div class="hand second" data-second-hand></div>
                <div class="number number1">1</div>
                <div class="number number2">2</div>
                <div class="number number3">3</div>
                <div class="number number4">4</div>
                <div class="number number5">5</div>
                <div class="number number6">6</div>
                <div class="number number7">7</div>
                <div class="number number8">8</div>
                <div class="number number9">9</div>
                <div class="number number10">10</div>
                <div class="number number11">11</div>
                <div class="number number12">12</div>
            </div>
        </div>
        <div class="row">
            <div class="card weather">
                <div class="weather card-body">
                    <h1 id="location" class="info-text"></h1>
                    <!-- <div class="button"><span class="unit">C</span><span id="exchange"><i class="fa fa-exchange" aria-hidden="true"></i></span><span class="unit">F</span></div> -->
                    <div class="top">
                        <div class="canvas-description">
                            <canvas id="skycon" width="100" height="100"></canvas>
                            <p id="description" class="info-text"></p>
                        </div>
                        <!-- <div class="faces">
                        <p class="face"><i style="color:#fe5d5d" class="fa fa-frown-o" aria-hidden="true"></i></p>
                        <p class="face"><i style="color:#feae5d" class="fa fa-meh-o" aria-hidden="true"></i></p>
                        <p class="face"><i style="color:#5dfeae" class="fa fa-smile-o" aria-hidden="true"></i></p>
                        <p class="face"><i style="color:#5daefe" class="fa fa-frown-o" aria-hidden="true"></i></p>
                        </div> -->
                        <div class="scale-container">
                            <div class="scale">
                                <div id="fill"></div>
                            </div>
                            <span class="temp"><i class="fa fa-caret-left" aria-hidden="true"></i>
                                <p id="temp"></p>
                            </span>
                        </div>
                    </div>

                    <div class="info-row">
                        <canvas id="rain-canvas" width="40" height="40" title="Risque de pluie"></canvas>
                        <span id="rain"
                              class="small-info-text"></span>
                        <canvas id="wind-canvas" width="40" height="40" title="Vitesse du vent"></canvas>
                        <span id="wind"
                              class="small-info-text"></span>
                        <p id="app-temp" class="small-info-text"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../public/js/weather.js"></script>
<script src="../public/lib/skycons/skycons.js"></script>
<script src="../public/js/clock.js"></script>
