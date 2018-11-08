<?php

namespace IdnoPlugins\Fitness {

    class Main extends \Idno\Common\Plugin {

        function registerPages() {
            \Idno\Core\Idno::site()->addPageHandler('admin/fitness', '\IdnoPlugins\Fitness\Pages\Admin');

            \Idno\Core\Idno::site()->addPageHandler('/fitness/edit/?', '\IdnoPlugins\Fitness\Pages\Edit');
            \Idno\Core\Idno::site()->addPageHandler('/fitness/edit/([A-Za-z0-9]+)/?', '\IdnoPlugins\Fitness\Pages\Edit');
            \Idno\Core\Idno::site()->addPageHandler('/fitness/delete/([A-Za-z0-9]+)/?', '\IdnoPlugins\Fitness\Pages\Delete');

            \Idno\Core\Idno::site()->template()->extendTemplate('admin/menu/items', 'admin/fitness/menu');

            // Add the style and script blocks to show maps
            \Idno\Core\Idno::site()->template()->extendTemplate('shell/head', 'fitness/shell/head');
        }

        /**
         * Get the total file usage
         * @param bool $user
         * @return int
         */
        function getFileUsage($user = false) {
            $total = 0;
            if (!empty($user)) {
                $search = ['user' => $user];
            } else {
                $search = [];
            }
            if ($activities = Fitness::get($search,[],9999,0)) {
                foreach($activities as $fitness) {
                    /* @var food $food */
                    if ($fitness instanceof Fitness) {
                        if ($attachments = $fitness->getAttachments()) {
                            foreach($attachments as $attachment) {
                                $total += $attachment['length'];
                            }
                        }
                    }
                }
            }
            return $total;
        }

    }

}
