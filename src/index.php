<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once("php/dungeon/dungeon.class.php");
require_once("php/utils.php");

$tilesDir = "img" . DIRECTORY_SEPARATOR . "maps" . DIRECTORY_SEPARATOR . "tiles" . DIRECTORY_SEPARATOR;
$dungeons = array(
    new Dungeon(gettext("Arcway"), 1, $tilesDir . "arcway"),
    new Dungeon(gettext("Black Rook Hold"), 6, $tilesDir . "blackrookhold"),
    new Dungeon(gettext("Cathedral of Eternal Night"), 5, $tilesDir . "cathedralofeternalnight"),
    new Dungeon(gettext("Court of Stars"), 3, $tilesDir . "courtofstars"),
    new Dungeon(gettext("Darkheart Thicket"), 1, $tilesDir . "darkheartthicket"),
    new Dungeon(gettext("Eye of Aszhara"), 1, $tilesDir . "eyeofazshara"),
    new Dungeon(gettext("Halls of Valor"), 3, $tilesDir . "hallsofvalor"),
    new Dungeon(gettext("Lower Karazhan"), 6, $tilesDir . "lowerkarazhan"),
    new Dungeon(gettext("Maw of Souls"), 3, $tilesDir . "mawofsouls"),
    new Dungeon(gettext("Neltharion's Lair"), 1, $tilesDir . "neltharionslair"),
    new Dungeon(gettext("Upper Karazhan"), 8, $tilesDir . "upperkarazhan"),
    new Dungeon(gettext("Vault of the Wardens"), 3, $tilesDir . "vaultofthewardens"),
);

?>
<!DOCTYPE html>
<html>
<head>
    <script type="application/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1RgDqFr4RB_sOlC8EzfjBDCa8il_GYxs&callback=initMap"></script>
    <script type="application/javascript" src="js/gmaps.js"></script>
    <style>
        #map {
            height: 600px;
            width: 80%;
        }
    </style>
    <script>
        var _tilesDir = "<?php echo $tilesDir; ?>";
        var _switchDungeonSelect = "#switch_dungeon";
        var _switchDungeonFloorSelect = "#switch_dungeon_floor";

        $(function () {

            <?php
            // Transfer the dungeons from PHP to JS
            foreach ($dungeons as $dungeon) {
            /* @var $dungeon Dungeon */
            ?>
            $(_switchDungeonSelect).append($('<option>', {
                text: "<?php echo $dungeon->getName(); ?>",
                value: "<?php echo $dungeon->getKey(); ?>"
            }).data("floors", "<?php echo $dungeon->getFloorCount(); ?>"));
            <?php
            }
            ?>

            $(_switchDungeonSelect).change(_dungeonChanged);

            $(_switchDungeonFloorSelect).change(function() {
                _refreshMap();
            });

            // Init
            _dungeonChanged();
        });

        function _dungeonChanged(){
            // Change the amount of floors this map has
            var selected = $(_switchDungeonSelect).find('option:selected');
            var floors = selected.data('floors');
            _setFloorCount(floors);

            // Refresh now
            _refreshMap();
        }

        function _refreshMap() {
            setCurrentMapName(_tilesDir + $(_switchDungeonSelect).val(), $(_switchDungeonFloorSelect).val());
        }

        function _setFloorCount(floors){
            $(_switchDungeonFloorSelect).empty();
            for(var i = 1; i <= floors; i++ ){
                $(_switchDungeonFloorSelect).append($('<option>', {
                    text: i,
                    value: i
                }));
            }
        }
    </script>
</head>
<body>
<h3>My Google Maps Demo</h3>
<div>
    <select id="switch_dungeon"></select>
    <select id="switch_dungeon_floor"></select>
</div>
<div id="map"></div>
</body>
</html>
