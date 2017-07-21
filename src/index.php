<?php
$maps = array_slice(scandir("img/Maps/Tiles/"), 2);


?>
<!DOCTYPE html>
<html>
<head>
    <script type="application/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1RgDqFr4RB_sOlC8EzfjBDCa8il_GYxs&callback=initMap"></script>
    <script type="application/javascript" src="js/gmaps.js"></script>
    <style>
        #map {
            height: 800px;
            width: 100%;
        }
    </style>
    <script>
        var _maps = ["<?php echo implode("\", \"", $maps); ?>"];

        $(function () {
            var _switchDungeonSelect = $("#switch_dungeon");
            console.log("test");

            for (var i = 0; i < _maps.length; i++) {
                var map = _maps[i];

                _switchDungeonSelect.append($('<option>', {
                    text: map
                }));
            }

            _switchDungeonSelect.change(function(){
                console.log(_switchDungeonSelect.val());
                setCurrentMapName(_switchDungeonSelect.val());
            });
            setCurrentMapName(_maps[0]);
        });
    </script>
</head>
<body>
<h3>My Google Maps Demo</h3>
<div><select id="switch_dungeon"></select></div>
<div id="map"></div>
</body>
</html>
