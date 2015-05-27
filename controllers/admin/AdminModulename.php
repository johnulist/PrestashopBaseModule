<?php
/**
 *
 */

/**
 * Class AdminModulenameController
 */
class AdminModulenameController extends ModuleAdminController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bootstrap = true;

        parent::__construct();
    }

    // renderList, renderView, postProcess, initContent you can call the method(s) you need here.
}
