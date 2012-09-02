/**
 * 
 * 
 * data-ajax-link
 *  the link (a, button, etc..) will be loaded with Ajax
 *  
 * data-ajax-submit
 *  the form will be submited with ajax
 * 
 * data-ajax-block
 *  selector of an element which will be blocked with blockUi plugin
 * 
 * 
 * 
 * data-ajax-target
 *  in an Ajax response indicate where to set the element in the page
 * 
 * data-ajax-method [empty-append,replace, append,prepend, ...]
 *  in an Ajax response indicate which method to apply to the selector target
 * 
 */


AjaxDomDispatcher={};

(function(self,$){

  self.prefix='data-ajax-';
  
  self.eventNamespace='.ajaxDomDispatcher';

  self.log=console.log;
  
  

  self.init=function(){

    $(document)
      .on('click','['+self.prefix+'link]',  self.onClickLink)
      .on('submit','form['+self.prefix+'submit]',  self.onFormSubmit)
      .ajaxComplete(function(evt,XMLHttpRequest,ajaxOptions){
        self.log('on ajaxComplete');
        self.dispatch(XMLHttpRequest.responseText);
      });


  }
  
  self.onClickLink=function(evt){
      evt.preventDefault();
      var $link=$(this),
          opts={},
          url=$link.attr(self.prefix+'link');
          
      url=(url=='#'||url=='href'||url=='true')?$link.attr('href'):url;
      if(!url){
        return self.log('no url found for link ',$link);
      }
      
      var selectorToBlock=$link.attr(self.prefix+'block');
      if(selectorToBlock){
        var $targetToBlock=$(selectorToBlock);
        if($targetToBlock.length){
          opts.complete=function(){
            $targetToBlock.unblock();
          }
          $targetToBlock.block();
        }else{
          self.log('target to block not found')
        }
      }     
      
      $.ajax(url,opts);
  };

  self.onFormSubmit=function(evt){    
      evt.preventDefault();
      var $form=$(this);
      self.log('onFormSubmit',$form);
      var opts={};
      
//      opts.iframe=true;
      opts.url=$form.attr(self.prefix+'submit');
      opts.url=(opts.url=='action'||opts.url=='true')?$form.attr('action'):opts.url;
      if(!opts.url){
        return self.log('no url found for form ',$form);
      }
      /*to do only if submited with iframe ??
       * !!! seem to work even if iframe submited*/
//      opts.success=function(data){
//          self.dispatch(data);
//      };
      var selectorToBlock=$form.attr(self.prefix+'block');
      if(selectorToBlock){
        var $targetToBlock=$(selectorToBlock);
        if($targetToBlock.length){
          opts.complete=function(){
            $targetToBlock.unblock();//stop block ui
          }
          $targetToBlock.block();//launch block ui
        }else{
          self.log('target to block not found')
        }
      }     
      
      $form.ajaxSubmit(opts);
  };

  self.dispatch=function(data){
    var $data=$(data);

    $data.filter('['+self.prefix+'target]').each(function(i,el){
      self.apply($(el))
    });
    $data.find('['+self.prefix+'target]').each(function(i,el){
      self.apply($(el))
    });
  }

  self.apply=function($element){
      self.log('apply to',$element)
      var targetSelector=$element.attr(self.prefix+'target');
      var $target=$(targetSelector);
      
      if(!$target.length){
        $(document).trigger('targetNotFound'+self.eventNamespace,targetSelector,$element);
        self.log('\tno target found for selector '+targetSelector)
      }
      
      self.log('\ttarget=',$target);
      var content=$element.html();
      var method=$element.attr(self.prefix+'method');
      method=(method)?method:'empty-append';
      self.log('\tmethod='+method);
      
      var eventBeforeLoad=$.Event('beforeLoad.ajaxDomDispatcher');
      $target.trigger('beforeLoad'+self.eventNamespace,$target,content,method,$element);
      
      switch(method){
        case 'empty-append':
            $target.empty().append(content);
            break;
        case 'replace':
            $target.replaceWith(content);
            break;
        case 'append':
            $target.append(content);
            break;
        case 'prepend':
            $target.prepend(content);
            break;
      }
      
      $target.trigger('afterLoad'+self.eventNamespace,$target,content,method,$element);
      
  }

}(AjaxDomDispatcher,jQuery));