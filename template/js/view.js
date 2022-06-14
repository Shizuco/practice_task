        let map;
        let marker;
        let geocoder;
        let responseDiv = HTMLDivElement;
        let response = HTMLPreElement;

        function initMap(){

        let pos = {"lat": Number(document.getElementById('lat').value), "lng": Number(document.getElementById('lon').value)}

        if(pos.lat == 0 || pos.lng == 0){
            pos.lat = 47.72869649940908
            pos.lng = 35.21815320339835 
        }

        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 10,
            center: { lat: pos.lat, lng: pos.lng }
        });    

        marker = new google.maps.Marker({
            map: map,
            position: pos,
        });

        geocoder = new google.maps.Geocoder();

        const inputText = document.createElement("input");

        inputText.type = "text";
        inputText.placeholder = "Enter a location";

        const submitButton = document.createElement("input");

        submitButton.type = "button";
        submitButton.value = "Geocode";
        submitButton.classList.add("button", "button-primary");

        const clearButton = document.createElement("input");

        clearButton.type = "button";
        clearButton.value = "Clear";
        clearButton.classList.add("button", "button-secondary");

        response = document.createElement("pre");
        response.id = "response";
        response.innerText = "";

        responseDiv = document.createElement("div");
        responseDiv.id = "response-container";
        responseDiv.appendChild(response);

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(inputText);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(submitButton);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(clearButton);
        map.controls[google.maps.ControlPosition.LEFT_TOP].push(responseDiv);

        map.addListener("click", (mapsMouseEvent) => {
            let result = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
            pos = {"lat" : JSON.parse(result).lat, "lng": JSON.parse(result).lng}
            document.getElementById("lat").value = Number(JSON.parse(result).lat)
            document.getElementById("lon").value = Number(JSON.parse(result).lng)
            marker.setPosition(pos);
            marker.setMap(map);
        });

        submitButton.addEventListener("click", () =>
            geocode({ address: inputText.value })
        );

        clearButton.addEventListener("click", () => {
            clear();
        });

        function geocode(request){
            clear();

            geocoder
                .geocode(request)
                .then((result) => {
                const { results } = result;

                map.setCenter(results[0].geometry.location);
                marker.setPosition(results[0].geometry.location);
                marker.setMap(map);
                responseDiv.style.display = "block";
                pos = JSON.stringify(results[0].geometry.location);
                document.getElementById("lat").value = JSON.parse(pos).lat
                document.getElementById("lon").value = JSON.parse(pos).lng;
                return results;
                })
                .catch((e) => {
                alert("Geocode was not successful for the following reason: " + e);
                });
        }
        //clear();
        }

        function clear() {
        marker.setMap(null);
        responseDiv.style.display = "none";
        }
        window.initMap = initMap;
export {};