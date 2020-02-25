var gV = {
    toggled: true,
}


document.addEventListener("DOMContentLoaded", function () {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(success, error);
        console.log("nav available");
    } else {
        console.log("no nav");
        geoFail();
    }
});

function success(data) {
    $("section").show();
    console.log(data.coords.latitude);
    getWeather(data.coords.latitude, data.coords.longitude);
    getLocationInfo(null, data.coords.latitude, data.coords.longitude);
}

function error(err) {
    console.log("error", err);
    //allow user to input data
    geoFail();
}


//funtion to get lat and lon based on navigator geolocationName failure or denial
function geoFail() {
    var input;
    //append a zipcode based search to the page
    $("body").prepend('<div class="location-search"><h1>Find your local weather</h1><span><input type="text" name="input-field" autofocus placeholder="92554 or San Francisco, CA"><button type="button" name="search"><i class="fa fa-search" aria-hidden="true"></i> Search</button></span></div>');

    //if the search icon/button is clicked, or enter key is pressed...
    function proccessInput() {
        //get any zipcode in the users input and use that first
        input = document.getElementsByName("input-field")[0].value;
        var re = new RegExp(/\d{5}/, "gi") //searches for 5 consecutive numbers
        var matched = input.match(re) //returns an array of each instance of 5 consecutive numbers
        if (matched != null) {
            //the input is a zipcode
            getLocationInfo(matched[0]);
            console.log(matched[0]);
        } else {
            //get the city and state values
            var new_arr = input.split(",");
            console.log(new_arr);
            getLocationInfo(null, null, null, new_arr);
        }
    }

    $("button").click(function () {
        proccessInput();
    });
    $(window).keypress(function (event) {
        var code = event.which;
        if (code === 13) {
            proccessInput();
        }
    });
}


function getLocationInfo(zip, lat, lon, name) {
    var locationName;
    if (zip) {
        console.log("user searched by zip");
        //call to google geocoding using zip only
        $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?address=" + zip + "&key=AIzaSyCuugDMliUtuYZ1tT2PZbgB_LMvOYi0wFU", (loc) => {
            locationName = loc.results[0].formatted_address;
            processCityName(locationName);
            //get the weather
            getWeather(loc.results[0].geometry.location.lat, loc.results[0].geometry.location.lng);
        })
    } else if (zip === null && lat && lon) {
        console.log("user used nav");
        //get the city name based on geographic coords
        $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?latlng=" + lat + "," + lon + "&key=AIzaSyCuugDMliUtuYZ1tT2PZbgB_LMvOYi0wFU", (info) => {
            for (var i = 0; i < info.results.length; i++) {
                for (var j = 0; j < info.results[i].types.length; j++) {
                    if (info.results[i].types[j] == "locality") {
                        locationName = info.results[i].formatted_address;
                        processCityName(locationName);
                    }
                }
            }
        });
    }
    //call to google geocoding using city and state
    else if (zip === null && lat === null && lon === null && name) {
        console.log("user searched by name");
        $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?address=" + name[0] + "+" + name[1] + "&key=AIzaSyCuugDMliUtuYZ1tT2PZbgB_LMvOYi0wFU", (loc) => {
            locationName = loc.results[0].formatted_address;
            processCityName(locationName);
            getWeather(loc.results[0].geometry.location.lat, loc.results[0].geometry.location.lng);
        });
    }

    //search through the reverse geolocationName info to find the right info
    function processCityName(location) {
        //cut out the "USA" part
        location = location.split(",");
        for (var f = 0; f < location.length - 2; f++) {
            location.pop();
        }
        location = location.join(", ");
        //insert the formatted location
        var locP = document.getElementById('location');
        locP.innerText = location;
    }
}


function getWeather(lat, lon) {
    //this request has to be done as jsonp because of cross-domain policies on the browser
    //adding ?callback=? makes the server treat the request as jsonp, the other option would be
    //to use .ajax(dataType: "jsonp")
    $.getJSON("https://api.forecast.io/forecast/b59cb056ae86ddcff4531258c647bf0d/" + lat + "," + lon + "?callback=?",
        function (wData) {
            console.log(wData);
            $(".location-search").hide();

            //get main current icon (working!)
            var current_icon = wData.currently.icon.toUpperCase();

            //create icon objects for current weather
            var skycon = new Skycons({
                "color": "white"
            });
            var windIcon = new Skycons({
                "color": "white"
            });
            var rainIcon = new Skycons({
                "color": "white"
            });

            //add the skyccon icon types
            skycon.add("skycon", current_icon);
            rainIcon.add("rain-canvas", "rain");
            windIcon.add("wind-canvas", "wind");

            //play the icons
            skycon.play();
            windIcon.play();
            rainIcon.play();


            var rainProb = wData.currently.precipProbability * 100;
            var windSpeed = Math.round(wData.currently.windSpeed);
            var app_temp = Math.round(wData.currently.apparentTemperature);

            tempScale(wData.currently.temperature);
            tempToggle(wData.currently.temperature, app_temp, wData.daily.data);

            $("#description").html(wData.currently.summary);
            $("#rain").html(rainProb + "%");
            $("#wind").html((windSpeed * 1.61) + " Km/h");
            $("#app-temp").html("Ressentie : " + app_temp + "&deg;");
            populateForecast(wData.daily.data);

            $("section").show();

            setTempPosition();
        });
}

function populateForecast(forecast_arr) {
    var date;
    var day_arr = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    var forecast_days;
    var height;
    var temp;
    var color;

    //populating names of days
    date = new Date;
    date = date.getDay();

    //populate icons and temperature
    for (var i = 1; i <= 5; i++) {
        forecast_days = date + i;
        if (forecast_days > 6) {
            forecast_days -= 7;
        }
        $(".day-container" + i + " p").html(day_arr[forecast_days]);
        //end days
        var mini_icon = new Skycons({
            "color": "white"
        })
        mini_icon.add("canvas" + i, forecast_arr[i].icon);
        mini_icon.play();
        //temperature
        $(".day-container" + i + " span").html(Math.round(forecast_arr[i].temperatureMax) + "&deg;F");
        //make the color and fill heights for mini scale
        temp = Math.round(forecast_arr[i].temperatureMax);
        if (temp >= 0 && temp < 60) {
            color = "#5daefe";
        } else if (temp >= 60 && temp < 80) {
            color = "#5dfeae";
        } else if (temp >= 80 && temp < 90) {
            color = "#feae5d";
        } else {
            color = "#fe5d5d";
        }
        height = forecast_arr[i].temperatureMax;
        $(".day-container" + i + " .mini-fill").css({
            "height": height,
            "background-color": color
        });
    }
}


//working
function tempToggle(tempInF, app_temp, forecast_arr) {
    tempInF = Math.round(tempInF);
    var tempInC = Math.round((tempInF - 32) * (5 / 9));
    var app_tempInC = Math.round((app_temp - 32) * (5 / 9));
    var tempElement = document.getElementById('temp');
    tempElement.innerText = tempInC;
    tempElement.innerHTML += "&deg;C";
    //attach click handler to toggle to/from F/C
    $("#temp").click(function () {
        if (gV.toggled === true) {
            $("#app-temp").html("Ressentie : " + app_tempInC + "&deg;");

            tempElement.innerText = tempInC;
            tempElement.innerHTML += "&deg;C";
            for (var i = 1; i <= 5; i++) {
                tempC = Math.round((forecast_arr[i].temperatureMax - 32) * (5 / 9));
                $(".day-container" + i + " span").html(tempC + "&deg;C");
            }
            gV.toggled = false;
        } //end if statement
        else if (gV.toggled === false) {
            $("#app-temp").html("Ressentie : " + app_temp + "&deg;F");

            tempElement.innerText = tempInF;
            tempElement.innerHTML += "&deg;F";
            for (var j = 1; j <= 5; j++) {
                $(".day-container" + j + " span").html(Math.round(forecast_arr[j].temperatureMax) + "&deg;F");
            }
            gV.toggled = true;
        }
    });
}


//working
function tempScale(temp) {
    //convert temperature into a usable height
    var fill_height = Math.round(temp * 1.7);
    var color;
    temp = Math.round(temp);

    var applyCSS = () => {
        $("#fill").css({
            "background-color": color,
            "height": fill_height
        });
    }

    if (temp >= 0 && temp < 60) {
        color = "#5daefe";
        applyCSS();
    } else if (temp >= 60 && temp < 80) {
        color = "#5dfeae";
        applyCSS();
    } else if (temp >= 80 && temp < 90) {
        color = "#feae5d";
        applyCSS();
    } else {
        color = "#fe5d5d";
        applyCSS();
    }
}

function setTempPosition() {
    var arrowLoc = $("#fill").offset();
    var p_height = $("#temp").height();
    var scale_width = $(".scale").width();
    console.log(arrowLoc);
    $(".temp").offset({top: arrowLoc.top - p_height / 2, left: arrowLoc.left + scale_width});
    $("#temp").offset({top: arrowLoc.top - p_height / 2, left: arrowLoc.left + scale_width + 20})
}
