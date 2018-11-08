<?php

/**
 * Fitness administration
 */

namespace IdnoPlugins\Fitness\Pages {

    /**
     * Default class to serve Fitness settings in administration
     */
    class Admin extends \Idno\Common\Page {

        function getContent() {
            
            $this->adminGatekeeper(); // Admins only
            $t = \Idno\Core\Idno::site()->template();
            $body = $t->draw('admin/fitness');
            $t->__(array('title' => 'Fitness settings', 'body' => $body))->drawPage();
        }

        function postContent() {

            $this->adminGatekeeper(); // Admins only

            $metric = $this->getInput('metric');
            $mapdata = $this->getInput('mapdata');
            $weight = $this->getInput('weight');
            $height = $this->getInput('height');

            \Idno\Core\Idno::site()->config->config['fitness'] = array(
                'metric'=>$metric,
                'mapdata' => $mapdata,
                'weight' => $weight,
                'height' => $height
            );
            \Idno\Core\Idno::site()->config()->save();
            \Idno\Core\Idno::site()->session()->addMessage('Your Fitness settings were saved.');
            $this->forward(\Idno\Core\Idno::site()->config()->getDisplayURL() . 'admin/fitness/');
        }

    }

}