<?php
/**
 * Description of dmCycleBehaviorForm
 *
 * @author TheCelavi
 */
class dmCaptifyBehaviorForm extends dmBehaviorBaseForm {
    
    protected $animation = array(
        'slide' => 'Slide',
        'fade' => 'Fade',        
        'always-on' => 'None'
    );
    
    protected $speed = array(
        'fast' => 'Fast',
        'slow' => 'Slow',
        'normal' => 'Normal'
    );

    protected $position = array(
        'bottom' => 'Bottom',
        'top' => 'Top'
    );
    /**
     * Add more attributes if you want
     * It would be convinient to have metadata support and metadata behavior where you can set metadata for some HTML element!!!
     * TODO - Add metadata support
     */
    protected $textSource = array(
        'alt' => 'Alt attribute',
        'title' => 'Title attribute',
        'rel' => 'Rel attribute'        
    );
    /**
     * Add more themes, do not forget to add proper css for this
     */
    protected $theme = array(
        'dark' => 'Dark',
        'light' => 'Light'
    );
    
    public function configure() {
        $this->widgetSchema['inner_target'] = new sfWidgetFormInputText();
        $this->validatorSchema['inner_target'] = new sfValidatorString(array(
            'required' => true
        ));
        
        $this->widgetSchema['source'] = new sfWidgetFormChoice(array(
            'choices'=>$this->getI18n()->translateArray($this->textSource)
        ));
        $this->validatorSchema['source'] = new sfValidatorChoice(array(
            'choices'=> array_keys($this->textSource)
        ));
        
        $this->widgetSchema['theme'] = new sfWidgetFormChoice(array(
            'choices'=>$this->getI18n()->translateArray($this->theme)
        ));
        $this->validatorSchema['theme'] = new sfValidatorChoice(array(
            'choices'=> array_keys($this->theme)
        ));
        
        $this->widgetSchema['position'] = new sfWidgetFormChoice(array(
            'choices'=>$this->getI18n()->translateArray($this->position)
        ));
        $this->validatorSchema['position'] = new sfValidatorChoice(array(
            'choices'=> array_keys($this->position)
        ));
        
        $this->widgetSchema['animation'] = new sfWidgetFormChoice(array(
            'choices'=>$this->getI18n()->translateArray($this->animation)
        ));
        $this->validatorSchema['animation'] = new sfValidatorChoice(array(
            'choices'=> array_keys($this->animation)
        ));
        
        $this->widgetSchema['easing'] = new dmWidgetFormChoiceEasing();
        $this->validatorSchema['easing'] = new dmValidatorChoiceEasing(array(
            'required' => true
        ));
        
        $this->widgetSchema['speedOver'] = new sfWidgetFormChoice(array(
            'choices'=>$this->getI18n()->translateArray($this->speed)
        ));
        $this->validatorSchema['speedOver'] = new sfValidatorChoice(array(
            'choices'=> array_keys($this->speed)
        ));
        
        $this->widgetSchema['speedOut'] = new sfWidgetFormChoice(array(
            'choices'=>$this->getI18n()->translateArray($this->speed)
        ));
        $this->validatorSchema['speedOut'] = new sfValidatorChoice(array(
            'choices'=> array_keys($this->speed)
        ));
        
        $this->widgetSchema['hideDelay'] = new sfWidgetFormInputText();
        $this->validatorSchema['hideDelay'] = new sfValidatorInteger(array(
            'min'=>0
        )); 
        
        $this->getWidgetSchema()->setLabels(array(
            'source'=>'Text source',
            'hideDelay' => 'Hide delay',
            'speedOver' => 'Speed over',
            'speedOut' => 'Speed out'
        ));
        
        $this->getWidgetSchema()->setHelps(array(
            'inner_target' => 'You can target all images via img or CSS selector, but only images',
            'textSource'=>'Read text from which source?',
            'hideDelay'=>'Hide captify on mouse out after specific number of ms'
        )); 
        
        if (!$this->getDefault('inner_target')) $this->setDefault ('inner_target', 'img');
        if (!$this->getDefault('source')) $this->setDefault ('source', 'alt');
        if (!$this->getDefault('theme')) $this->setDefault ('theme', 'dark');
        if (!$this->getDefault('position')) $this->setDefault ('position', 'bottom');
        if (!$this->getDefault('animation')) $this->setDefault ('animation', 'slide');
        if (!$this->getDefault('easing')) $this->setDefault ('easing', 'jswing');
        if (!$this->getDefault('speedOver')) $this->setDefault ('speedOver', 'fast');
        if (!$this->getDefault('speedOut')) $this->setDefault ('speedOut', 'normal');
        if (!$this->getDefault('hideDelay')) $this->setDefault ('hideDelay', 500);
        
        parent::configure();
    }
    
}
