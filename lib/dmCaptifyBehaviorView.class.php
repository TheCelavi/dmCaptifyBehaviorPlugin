<?php
/**
 * Description of dmCycleBehaviorView
 *
 * @author TheCelavi
 */
class dmCaptifyBehaviorView extends dmBehaviorBaseView {
    
    public function configure() {
        $this->addRequiredVar(array('source', 'theme', 'position', 'animation', 'easing', 'speedOver', 'speedOut', 'hideDelay'));
    }

    protected function filterBehaviorVars(array $vars = array()) {
        $vars = parent::filterBehaviorVars($vars);        
        return $vars;
    }
    
    public function getJavascripts() {
        return array_merge(
            parent::getJavascripts(),            
            array(
                'lib.easing',                
                'dmCaptifyBehaviorPlugin.captify',
                'dmCaptifyBehaviorPlugin.launch'
            )
        );
    } 
    
    public function getStylesheets() {
        return array_merge(
            parent::getStylesheets(),
            array(
                'dmCaptifyBehaviorPlugin.themes'
            )
        );
    }
    
}
