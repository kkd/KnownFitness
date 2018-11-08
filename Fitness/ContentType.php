<?php
    namespace IdnoPlugins\Fitness {
        class ContentType extends \Idno\Common\ContentType {
            public $title = 'Fitness';
            public $category_title = 'Fitness';
            public $entity_class = 'IdnoPlugins\\Fitness\\Fitness';
            public $logo = '<i class="icon-medkit"></i>';
            public $indieWebContentType = array('exercise');
        }
    }
