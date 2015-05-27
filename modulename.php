<?php
/**
 *
 */

/**
 * Class ModuleName
 */
class ModuleName extends Module
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->name = 'modulename';
        $this->tab = 'payments_gateways';
        $this->version = '1.0.0';
        $this->author = 'Happy Technologies';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Module Name');
        $this->description = $this->l('Module Name description in one sentence');

        $this->confirmUninstall = $this->l(
            'Are you sure you want to uninstall? You will lose all your settings.'
        );

        require_once('classes/ModuleNameEntity.php');
    }

    /**
     * Install the module.
     *
     * @return bool
     */
    public function install()
    {
        require_once(dirname(__FILE__) . '/sql/install.php');

        return parent::install() &&
               $this->installModuleTab(
                   'AdminModulename',
                   array(
                       1 => 'Module Name - Tab Title',
                   ),
                   10
               );
    }

    /**
     * Uninstall the module.
     *
     * @return mixed
     */
    public function uninstall()
    {
        require_once(dirname(__FILE__) . '/sql/uninstall.php');

        return parent::uninstall() &&
               $this->uninstallModuleTab('AdminModulename');
    }

    /**
     * Load the configuration form.
     *
     * @return string
     */
    public function getContent()
    {
        $oDb = Db::getInstance();

        // If the page is called by Ajax...
        if (Tools::getValue('ajax') == '1' && Tools::getValue('value') != 0) {
            // Process the data.
            die('OK');
        }

        // Process sent data.
        $this->postProcess();

        // Add CSS and JS (required for Ajax processing)
        $this->context->controller->addJS($this->_path . '/js/back.js');
        $this->context->controller->addCSS($this->_path . '/css/back.css');

        // Finally, send everything to smarty !
        $sOutput = $this->context->smarty->fetch(
            $this->local_path . 'views/templates/admin/configure.tpl',
            array(
                'id_shop' => Shop::getContextShopID(),
            )
        );

        return $sOutput;
    }

    /**
     * Save submitted data.
     */
    public function postProcess()
    {
        // Process the data.
    }

    /**
     * Install an admin tab.
     *
     * @param $sTabClass
     * @param $sTabName
     * @param $iIdTabParent
     * @return bool
     */
    private function installModuleTab($sTabClass, $sTabName, $iIdTabParent)
    {
        @copy(
            _PS_MODULE_DIR_ . $this->name . '/logo.png',
            _PS_IMG_DIR_ . 't/' . $sTabClass . '.png'
        );
        $oTab = new Tab();
        $oTab->name = $sTabName;
        $oTab->class_name = $sTabClass;
        $oTab->module = $this->name;
        $oTab->id_parent = $iIdTabParent;
        if (!$oTab->save()) {
            return false;
        }

        return true;
    }

    /**
     * Uninstall an admin tab.
     *
     * @param $sTabClass
     * @return bool
     */
    private function uninstallModuleTab($sTabClass)
    {
        $iIdTab = Tab::getIdFromClassName($sTabClass);
        if ($iIdTab != 0) {
            $oTab = new Tab($iIdTab);
            $oTab->delete();
            @unlink(_PS_IMG_DIR . "t/" . $sTabClass . ".png");

            return true;
        }

        return false;
    }
}
