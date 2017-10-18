<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * PDF Component to respond to PDF requests.
 *
 * Employs  App\View\PdfView to change output from HTML to PDF format.
 */
class PdfComponent extends Component {

    public $Controller;

    public $respondAsPdf = false;

    protected $_defaultConfig = [
        'viewClass' => 'Pdf',
        'autoDetect' => true
    ];

    /**
     * Constructor.
     *
     * @param ComponentRegistry $collection
     * @param array $config
     */
    public function __construct(ComponentRegistry $collection, $config = []) {
        $this->Controller = $collection->getController();
        $config += $this->_defaultConfig;
        parent::__construct($collection, $config);
    }

    /**
     * @inheritdoc
     */
    public function initialize(array $config = []) {
        if (!$this->_config['autoDetect']) {
            return;
        }
        $this->respondAsPdf = $this->Controller->request->is('pdf');
    }

    /**
     * Called before:
     * Controller::beforeRender()
     * the View class is loaded
     * Controller::render()
     *
     * @param Event $event
     * @return void
     */
    public function beforeRender(Event $event) {
        if (!$this->respondAsPdf) {
            return;
        }
        $this->_respondAsPdf();
    }

    /**
     * @return void
     */
    protected function _respondAsPdf() {
        $this->Controller
            ->viewBuilder()
            ->className($this->_config['viewClass']);
    }
}
