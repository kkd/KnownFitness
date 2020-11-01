<?php

namespace IdnoPlugins\Fitness {

    class Fitness extends \Idno\Common\Entity {

        function getTitle() {
            if (empty($this->title)) {
                return 'Untitled Fitness Activity';
            } else {
                return $this->title;
            }
        }

        function getDescription() {
            return $this->body;
        }

        function getMapdata() {
            return $this->mapdata;
        }

        /**
         * Fitness objects have type 'exercise'
         * @see <https://indieweb.org/exercise>
         * @return 'exercise'
         */
        function getActivityStreamsObjectType() {
            return 'exercise';
        }

        /**
         * Saves changes to this object based on user input
         * @return bool
         */
        function saveDataFromInput() {
            if (empty($this->_id)) {
                $new = true;
            } else {
                $new = false;
            }

            if ($new) {
                if (!\Idno\Core\site()->triggerEvent("file/upload", [], true)) {
                    return false;
                }
            }

            // MicroPub endpoint will map:

            // 'name'
            $this->title      = \Idno\Core\site()->currentPage()->getInput('title');
            // 'content'
            $this->body       = \Idno\Core\site()->currentPage()->getInput('body');
            // 'visibility' == 'private'
            $this->access     = \Idno\Core\site()->currentPage()->getInput('access');

            // TODO: add this to micropub
            $this->type       = \Idno\Core\site()->currentPage()->getInput('type');
            // TODO: add this to micropub
            $this->stationary = \Idno\Core\site()->currentPage()->getInput('stationary');
            // TODO: add this to micropub
            $this->distance   = \Idno\Core\site()->currentPage()->getInput('distance');
            // TODO: add 'track' to micropub for track uploading - see https://github.com/idno/known/blob/master/IdnoPlugins/IndiePub/Pages/MicroPub/Endpoint.php

            $this->setAccess($this->access);

            if ($time = \Idno\Core\site()->currentPage()->getInput('created')) {
                if ($time = strtotime($time)) {
                    $this->created = $time;
                }
            }

            // This flag will tell us if it's safe to save the object later on
            if ($new) {
                $ok = false;
            } else {
                $ok = true;
            }

            // Get attached files
            if ($new) {
                // This is awful, but unfortunately, browsers can't be trusted to send the right mimetype.
                $ext = pathinfo($_FILES['track']['name'], PATHINFO_EXTENSION);
                if (empty($ext)) {
                    \Idno\Core\site()->session()->addErrorMessage('We couldn\'t access your track. Please try again.');
                    return false;
                }

                if (in_array($ext, array('gpx', 'tcx'))) {
                    $track_file = $_FILES['track'];

                    // FIXME: improve the file-type detection - ($track_file['type'] == 'application/gpx+xml')
                    switch ($ext) {
                        case 'tcx':
                            $track_file['type'] = 'tcx';
                            break;
                        case 'gpx':
                            $track_file['type'] = 'gpx';
                            break;
                    }
                    $this->track_type = $track_file['type'];
                    
                    if ($track = \Idno\Entities\File::createFromFile($track_file['tmp_name'], $track_file['name'], $track_file['type'], true)) {
                        $this->attachFile($track);
                        $ok = true;
                    } else {
                        \Idno\Core\site()->session()->addErrorMessage('Track wasn\'t attached.');
                    }
                } else {
                    \Idno\Core\site()->session()->addErrorMessage('This doesn\'t seem to be an track file .. ' . $_FILES['track']['type']);
                }
            }

            // If a track file wasn't attached, don't save the file.
            if (!$ok) {
                return false;
            }

    	    if ($this->publish($new)) {
                if ($this->getAccess() == 'PUBLIC') {
                    \Idno\Core\Webmention::pingMentions($this->getURL(), \Idno\Core\site()->template()->parseURLs($this->getTitle() . ' ' . $this->getDescription()));
                }

                return true;
            } else {
                return false;
            }
        }

        /**
         * Get Leaflet Map data
         * 
         * @param $mapdata
         * @return string
         */
        function getLMapdata($mapdata) {
            if (empty($mapdata)) {
                $mapdata = \Idno\Core\site()->config()->fitness['mapdata'];
            }

            switch ($mapdata) {

                case 'mapquest':
                    $map = "L.tileLayer('http://otile{s}.mqcdn.com/tiles/1.0.0/map/{z}/{x}/{y}.jpeg', {
                        subdomains:\"1234\",
          attribution: 'Map data &copy; <a href=\"http://openstreetmap.org\">OpenStreetMap</a>. Tiles Courtesy of <a href=\"http://www.mapquest.com/\" target=\"_blank\">MapQuest</a>'
        }).addTo(map);";

                    break;

                case 'thunderforest':

                    $map = "L.tileLayer('http://{s}.tile.thunderforest.com/outdoors/{z}/{x}/{y}.png', {
          attribution: 'Map &copy; <a href=\"http://www.thunderforest.com\" target=\"_blank\">Thunderforest</a>, Data &copy; <a href=\"http://openstreetmap.org\" target=\"_blank\">OpenStreetMap</a>'
        }).addTo(map);";

                    break;

                case 'osm':
                   $map = "L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: 'Map data &copy; <a href=\"http://www.osm.org\" target=\"_blank\">OpenStreetMap</a>'
        }).addTo(map);";
                    break;

                default:
                    $map = "L.tileLayer('https://cyberjapandata.gsi.go.jp/xyz/std/{z}/{x}/{y}.png', {
                        attribution: '<a href=\"https://maps.gsi.go.jp/development/ichiran.html\" target=\"_blank\">地理院タイル</a>>地理院タイル</a>'}).addTo(map);";
            }

            return $map;
        }

    }

}
