<?php include ROOT.'/views/layouts/header.php';?>
    <div class="card-body">
        <p><?php $js_out = json_encode($conferenceItem);?></p>
        <h1 class="display-5"><?php echo $conferenceItem['title'];?></h1>
        <h6><p>Время проведения конференции: <?php echo $conferenceItem['date'];?> <?php echo $conferenceItem['time'];?></p></h6>
    </div>
    <script>
        let conferenceItem = <?php echo $js_out; ?>;
        let pos = {lat: Number(conferenceItem['address_lat']), lng: Number(conferenceItem['address_lon'])}
        function initMap() {
            var mapProp= {
                center: pos,
                zoom:17,
            };
            var map = new google.maps.Map(document.getElementById("map"),mapProp);
            let marker = new google.maps.Marker({
                map: map,
                position: pos,
            })
        }
    </script>
    <div id="map" style="width:100%;height:400px;"></div>
    <br>
    <a href="/conference/<?php echo $conferenceItem['id'];?>/delete"><button type="button" class="btn btn-outline-danger">Удалить</button></a>
    <a href="/conference/<?php echo $conferenceItem['id'];?>/edit"><button type="button" class="btn btn-outline-warning">Изменить</button></a>
    <a href="/conference"><button type="button" class="btn btn-outline-dark">Назад</button></a> 
    <br>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADFcoScfphWuAx3ClT8PdJL3w_iQ9Q5gU&callback=initMap&v=weekly"
      defer
    ></script>
    <?php include ROOT.'/views/layouts/footer.php';?>