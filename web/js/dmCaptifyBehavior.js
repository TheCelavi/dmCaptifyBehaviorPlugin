(function($) {    
    
    var methods = {        
        init: function(behavior) {                       
            var $this = $(this), data = $this.data('dmCaptifyBehavior');
            if (data && behavior.dm_behavior_id != data.dm_behavior_id) { // There is attached the same, so we must report it
                alert('You can not attach captify behavior to same content'); // TODO TheCelavi - adminsitration mechanizm for this? Reporting error
            };
            $this.data('dmCaptifyBehavior', behavior);
        },
        
        start: function(behavior) {  
            var $this = $(this);
            // Captify does not have a good destroy method :(            
            // This is memory mess, so it would be convinient to have view behavior and admin behavior
            var $copy = $this.clone(true, true);
            $this.after($copy);
            $copy.data('dmCaptifyBehaviorPreviousDOM', $this.detach());
            behavior.className = 'captify-' + behavior.position;
            $copy.captify(behavior);
        },
        stop: function(behavior) {
            var $this = $(this);
            $this.parent().replaceWith($this.data('dmCaptifyBehaviorPreviousDOM'));            
        },
        destroy: function(behavior) {            
            var $this = $(this);
            $this.data('dmCaptifyBehavior', null);
            $this.data('dmCaptifyBehaviorPreviousDOM', null)
        }
    };
    
    $.fn.dmCaptifyBehavior = function(method, behavior){
        
        return this.each(function() {
            if ( methods[method] ) {
                return methods[ method ].apply( this, [behavior]);
            } else if ( typeof method === 'object' || ! method ) {
                return methods.init.apply( this, [method] );
            } else {
                $.error( 'Method ' +  method + ' does not exist on jQuery.dmCaptifyBehavior' );
            }  
        });
    };

    $.extend($.dm.behaviors, {        
        dmCaptifyBehavior: {
            init: function(behavior) {
                $($.dm.behaviorsManager.getCssXPath(behavior) + ' ' + behavior.inner_target).dmCaptifyBehavior('init', behavior);
            },
            start: function(behavior) {
                $($.dm.behaviorsManager.getCssXPath(behavior) + ' ' + behavior.inner_target).dmCaptifyBehavior('start', behavior);
            },
            stop: function(behavior) {
                $($.dm.behaviorsManager.getCssXPath(behavior) + ' ' + behavior.inner_target).dmCaptifyBehavior('stop', behavior);
            },
            destroy: function(behavior) {
                $($.dm.behaviorsManager.getCssXPath(behavior) + ' ' + behavior.inner_target).dmCaptifyBehavior('destroy', behavior);
            }
        }
    });
    
})(jQuery);