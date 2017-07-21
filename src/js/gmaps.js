var mapObj;
var _currentMapName;

function initMap() {
    mapObj = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 0, lng: 0},
        zoom: 1,
        streetViewControl: false,
        mapTypeControlOptions: {
            mapTypeIds: ['dungeonmap']
        }
    });

    var customMapType = new google.maps.ImageMapType({
        getTileUrl: function (coord, zoom) {
            var normalizedCoord = getNormalizedCoord(coord, zoom);
            if (!normalizedCoord) {
                return null;
            }

            var result = 'img/Maps/Tiles/' + _currentMapName + '/1/' + zoom + '/' + normalizedCoord.x + '_' + normalizedCoord.y + '.png';
            console.log(normalizedCoord, result);
            return result;
        },
        tileSize: new google.maps.Size(384, 256),
        maxZoom: 4,
        minZoom: 1,
        radius: 1738000,
        name: 'dungeonmap'
    });

    mapObj.mapTypes.set('dungeonmap', customMapType);
    mapObj.setMapTypeId('dungeonmap');
}

// Normalizes the coords that tiles repeat across the x axis (horizontally)
// like the standard Google map tiles.
function getNormalizedCoord(coord, zoom) {
    var y = coord.y;
    var x = coord.x;

    // tile range in one direction range is dependent on zoom level
    // 0 = 1 tile, 1 = 2 tiles, 2 = 4 tiles, 3 = 8 tiles, etc
    var tileRange = 1 << zoom;

    // don't repeat across y-axis (vertically)
    if (y < 0 || y >= tileRange) {
        return null;
    }

    // repeat across x-axis
    if (x < 0 || x >= tileRange) {
        // x = (x % tileRange + tileRange) % tileRange;
        return null;
    }

    return {x: x, y: y};
}

function setCurrentMapName(name){
    _currentMapName = name;
    if( typeof mapObj !== "undefined" ) {
        console.log("refresh");
        google.maps.event.trigger(mapObj, 'resize');
    }
}