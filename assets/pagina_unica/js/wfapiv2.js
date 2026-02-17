if (typeof Wildfire == 'undefined') {
	Wildfire= new Object();
	Wildfire.LinkedLoading = true;
	Wildfire._pixeIframeCreated = false;
	Wildfire._NextZIndex=1000;
} 


Wildfire.Flash={

isIE  : (navigator.appVersion.indexOf("MSIE") != -1) ? true : false,
isWin : (navigator.appVersion.toLowerCase().indexOf("win") != -1) ? true : false,
isOpera : (navigator.userAgent.indexOf("Opera") != -1) ? true : false,

getFlashVersion:function() {
    var version = -1;
    if (navigator.plugins != null && navigator.plugins.length > 0) {
	    if (navigator.plugins["Shockwave Flash"]) {
		    var flashDescription = navigator.plugins["Shockwave Flash"].description;
		    if (flashDescription!=null) {
		        version = flashDescription.split(" ")[2].split(".")[0];
		    }
	    }
    }
    else if ( this.isIE && this.isWin && !this.isOpera ) {
	    try {
		    var axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.7");
		    var flashDescription = axo.GetVariable("$version");
	    } catch (e) {}
	    if (flashDescription!=null) {
	        version = flashDescription.split(" ")[1].split(",")[0];
	    }
    }
    return version;
},

AC_Generateobj:function(objAttrs, params, embedAttrs) { 
    var str = '';
    if (this.isIE && this.isWin && !this.isOpera)	{
	    str += '<object ';
	    for (var i in objAttrs) {str += i + '="' + objAttrs[i] + '" ';}
	    str += '>';
	    for (var i in params) {str += '<param name="' + i + '" value="' + params[i] + '" /> ';}
	    str += '</object>';
    }
    else {
	    str += '<embed ';
	    for (var i in embedAttrs) {str += i + '="' + embedAttrs[i] + '" ';}
	    str += '> </embed>';
    }
    return str;
},

AC_FL_GetContent:function(){
	var ret = this.AC_GetArgs(arguments);
	return this.AC_Generateobj(ret.objAttrs, ret.params, ret.embedAttrs);
},

AC_GetArgs:function(args, classid, mimeType){
	var ret = {};
	ret.embedAttrs = {};
	ret.params = {};
	ret.objAttrs = {};
	for (var i=0; i < args.length; i=i+2){
		var currArg = args[i].toLowerCase();    
		switch (currArg){	
			case "movie":	
				ret.embedAttrs["src"] = args[i+1];
				ret.params["movie"] = args[i+1];
			break;
			case "id":  
			case "width":
			case "height":
			case "align":
			case "name":
				ret.embedAttrs[args[i]] = ret.objAttrs[args[i]] = args[i+1];
			break;
			default:
				ret.embedAttrs[args[i]] = ret.params[args[i]] = args[i+1];
		}
  }
  ret.objAttrs['codebase']='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0';
  ret.objAttrs["classid"] = "clsid:d27cdb6e-ae6d-11cf-96b8-444553540000";
  ret.embedAttrs["type"] ="application/x-shockwave-flash";
  ret.embedAttrs['pluginspage']='http://www.macromedia.com/go/getflashplayer';
  
  return ret;
}

} // Wildfire.Flash

// Event handlers
Wildfire.onClose = Wildfire.onPostProfile = Wildfire.onPostComment = Wildfire.onSend = Wildfire.onEmail = function(){};

Wildfire.modules = new Object();
Wildfire.modulesArray = new Array();


/*** PUBLIC METHODS ***/
	
Wildfire.initShare = function(partner, targetId, width, height, config)	{   
	return Wildfire._createJSModule("share",''+partner,targetId,width,height,config,
						'cssURL,cornerRoundness,initialMessageType,domainForCallback,partner,source,partnerData,width,height,emailTabHidden,customCheckboxVisible,customCheckboxChecked,customCheckboxText,' +
						'internalColor,frameColor,externalColor,tabTextColor,textColor,fontType,fontSize,' +
						'headerInternalColor,headerFrameColor'
						);
}

Wildfire.initPost = function(partner, targetId, width, height, config) {	
	return Wildfire._createFlashModule("post",''+partner,targetId,width,height,config);
}



//DEPRECATED, replaced by initShare */
Wildfire.init = Wildfire.initShare;

//DEPRECATED, replaced by module.applyConfig*/
Wildfire.applyConfig= function(config) {
	if (isnotnull(Wildfire.share)) Wildfire.share.applyConfig(config);
}

/*** Flash Interface ***/
//this is Called from the SWF
Wildfire._GetFlashModuleXMLConfig=function (targetId){
    document.getElementById(targetId).style.background = '';
	//hide the js progress indicator -- this is a mac issue fix.;
	var pdiv = document.getElementById(targetId+"_progress");
	if (pdiv!=null) {
		pdiv.innerHTML='&nbsp;';
		pdiv.style.display = "none";
		pdiv.style.visibility = "hidden";
	}
	
	xs= ['config',[], [
			'display',['width','height','showCodeBox','rememberMeVisible','emailImportProviders','networksToShow','networksToHide','bookmarksToShow','bookmarksToHide','bulletinChecked','showEmail','showPost','showBookmark','showDesktop', 'showCloseButton'],
			'body',['font=fontType','size=fontSize'],[
				'background',['frame-color=frameColor','background-color=internalColor','corner-roundness=cornerRoundness'],
				'controls',[], [
					'textboxes',[],	[
						'inputs',['color=textInputColor','background-color=textInputBackgroundColor','frame-color=textInputBorderColor']
						],
					'snbuttons',['color=tabTextColor|snButtonsTextColor','background-color=snButtonsBackgroundColor','frame-color=snButtonsFrameColor','over-color=tabTextColor|snButtonsOverTextColor','over-background-color=snButtonsOverBackgroundColor','over-frame-color=snButtonsOverFrameColor'],
					'buttons',['font=fontType|buttonFontType','color=buttonTextColor']
					],
				'texts background-color="transparent" ',['color=textColor'],[
					'messages',['color=messageTextColor'],
					'links',['font=linkFontType','color=linkTextColor'],
					'privacy',['color=privacyTextColor']
					]
				]
			]
		];

	var oConfig=Wildfire._GetFlashModuleConfig(targetId);
	var s=Wildfire._BuildXMLConfigFromJSON(oConfig,xs);
	
	return s;

}

Wildfire._GetFlashModuleConfigAttribute=function (targetId,configAttribute,canBeTextareaID,network){
    document.getElementById(targetId).style.background = '';
	//hide the js progress indicator -- this is a mac issue fix.;
	var pdiv = document.getElementById(targetId+"_progress");
	if (pdiv!=null) {
		pdiv.innerHTML='&nbsp;';
		pdiv.style.display = "none";
		pdiv.style.visibility = "hidden";
	}

	var module=Wildfire.modules[targetId];
	if (module!=null) {
		var AttribValue=module.config[configAttribute];
		if (typeof AttribValue=='undefined') return null;
		if (typeof AttribValue=='function') return AttribValue(configAttribute,network);
		if (canBeTextareaID==true) {
			if ( isnotnull(AttribValue) ) {
				try {
					var element=document.getElementById(AttribValue);
					
					if ( isnotnull(element) ) {
						return element.value;
					}
					else {
						return AttribValue;
					}
					
				} catch (e) {
					//GIGYAONLY:alert('Unable to get template for module:' + targetId + ', configAttribute :'+ configAttribute + '\n' + ex.description);
					return AttribValue;	
				}
			}
		}
		else {
			return AttribValue;
		}
	}
	else {
		return {error:'Modlue not found',MID:targetId};
	}
}

Wildfire._GetFlashModuleConfig=function (targetId){
	if (Wildfire.modules == null) {
		alert('Wildfire has no modules yet');
	}
	var module=Wildfire.modules[targetId];
	if (module!=null) {
	
		var res=module.config;
		return res;
	}
	else {
		return null;
	}
}
	

/*** PRIVATE METHODS ***/

Wildfire._BuildXMLConfigFromJSON=function (oConfig,xs) {

	var s=new Array();
	try{
	for(var i=0;i<xs.length;i+=2){

		s[s.length]='<'+xs[i]+' ';
		var atts=xs[i+1];

		for (var ia=0;ia<atts.length;ia++) {
		
			var attrAndKeys=atts[ia].split('=');
			var key=attrAndKeys[0];
			var valkeys;
			if (attrAndKeys.length>1) {
				valkeys=attrAndKeys[1]
			}
			else {
				valkeys=attrAndKeys[0];
			}
			
			var arrKeys=valkeys.split('|')
			for (var ikey=0;ikey<arrKeys.length;ikey++) {
				if (typeof oConfig[arrKeys[ikey]] != 'undefined') {
					s[s.length]=key+'="';
					s[s.length]=(''+oConfig[arrKeys[ikey]]).replace('&','&amp;').replace('"','&quot;').replace('<','&lt;').replace('>','&gt;') ;
					s[s.length]='" ';
					break;
				}
			}
		}
		if (i+2==xs.length) { // there are no more nodes
			s[s.length]='/>';						
		}
		else {
			if (typeof xs[i+2]!='string') {
			  s[s.length]='>';
			  s[s.length]=Wildfire._BuildXMLConfigFromJSON(oConfig,xs[i+2]);
			  s[s.length]='</'+xs[i].split(' ')[0]+'>';
			  i++; // skip the array node.
			}
			else {
				s[s.length]='/>';
			}
		}
		
	}
	}
	catch(e){
//			return ('***');
	}
	return s.join('');
}

Wildfire._createJSModule = function (moduleType, partner, targetId, width, height, config, getParams)	
{	
	try {
		config.location = document.location.href;
	} catch(err) {}
	
	config.partner = partner;
	config.width = width;
	config.height = height;

	// validate input params
	if ( undef(moduleType) || undef(partner) || undef(targetId) || undef(width) || undef(height)|| undef(config)) return;

	var module = this[targetId] = this.modules[targetId] = this.modulesArray[this.modulesArray.length] = new Wildfire._JSModule();
	module.copyConfig(config);
	module.ready = false;
	module.type = moduleType;
	module.id = targetId;
	module.partner = partner;
	module.width = width;
	module.height = height;
	module.container = document.getElementById(targetId);		  
	module.container.style.width  = width + "px";
	module.container.style.height = height + "px";

	module.qsParams = new Array();
	var getParamArray = getParams.split(',');
	for (var i=0; i<getParamArray.length ; i++)
		Wildfire._addQSParam(module,getParamArray[i]);
	
	module.init(true); // true means check ping for safe mode
	return module;
};

Wildfire._origOnLoad = null;
Wildfire._onLoad = function(evt)
{
	
	Wildfire.onLoad=Wildfire._origOnLoad; //restore
	
	if (Wildfire.LinkedLoading==false) {
		if (Wildfire._origOnLoad!=null) {
			Wildfire._origOnLoad(evt);
		}
		return;
	}
	Wildfire.LinkedLoading=false;
	// this can not be called before setting Wildfire.LinkedLoading to false
	// or it might trigger additional loads while in LinkedLoading 
	if (Wildfire._origOnLoad!=null) {
		Wildfire._origOnLoad(evt);
	}
	
	if ((evt.ModuleID == Wildfire.modulesArray[0].id))
	{
		for (var i=1;i<Wildfire.modulesArray.length; i++)
		{
			if (!Wildfire.modulesArray[i].ready) 
			{
				try {Wildfire.modulesArray[i].init(true);} catch(e) {}
			}
				
		}
	}
	
};

Wildfire._createTextareaModule = function(width, height, config, targetId) {
    var str = '';
    var defaultContent = config.defaultContent;
    if (document.getElementById(defaultContent) != null) {
        defaultContent = document.getElementById(defaultContent).value;
    }
    
    if (!(config.UIConfig && (config.UIConfig.indexOf('showCodeBox="false"')!=-1 || config.UIConfig.indexOf("showCodeBox='false'")!=-1))) {    
        str += '<textarea style="width: ' + width + 'px; height: ' + height + 'px">';
        str += defaultContent;
        str += '</textarea>';
	}
    var container = document.getElementById(targetId);
    container.style.width  = width + "px";
    container.style.height = height + "px";
    container.innerHTML = str;    
}

Wildfire._createFlashModule = function (moduleType, partner, targetId, width, height, config/*, getParams*/)	
{	
/*
    if (moduleType == 'post' && Wildfire.Flash.getFlashVersion()<8) {
        Wildfire._createTextareaModule(width, height, config, targetId);
        return;
    }*/

	// set bookmarkURL if not set
	
	try {
		if (typeof config['bookmarkURL'] == 'undefined')
			config['bookmarkURL'] = document.location.href;
	} catch (e) {}


	// hook onLoad 
	if (Wildfire.LinkedLoading) 
	{
		if (typeof Wildfire.onLoad != 'undefined' && Wildfire.onLoad!=Wildfire._onLoad) 
			Wildfire._origOnLoad = Wildfire.onLoad;
	
		Wildfire.onLoad = Wildfire._onLoad;
	}

	var blnRecreate=false;
	var idxInArray;
	if (this.modules[targetId] != null) {
		blnRecreate=true;
		document.getElementById(targetId).innerHTML='&nbsp;';
		idxInArray=this.modules[targetId].idxInArray;
	}
	else {
		idxInArray=this.modulesArray.length;
	}
	try {
		config.location = document.location.href;
	} catch(err) {}
	
	config.partner = partner;
	config.width = width;
	config.height = height;

	// validate input params
	if ( undef(moduleType) || undef(partner) || undef(targetId) || undef(width) || undef(height)|| undef(config)) return;
	
	
	var module = new Wildfire._FlashModule();
	this.modulesArray[idxInArray] = this[targetId] = this.modules[targetId] = module;
	
	module.idxInArray=idxInArray;
	module.copyConfig(config);
	module.queued = false;
	module.ready = false;
	module.type = moduleType;
	module.id = targetId;
	module.partner = partner;
	module.width = width;
	module.height = height;
	module.container = document.getElementById(targetId);		  
	module.container.style.width  = width + "px";
	module.container.style.height = height + "px";
	
	/*
	module.qsParams = new Array();
	var getParamArray = getParams.split(',');
	for (var i=0; i<getParamArray.length ; i++)
		Wildfire._addQSParam(module,getParamArray[i]);
	*/
	if (!Wildfire.LinkedLoading || this.modulesArray.length==1 || this.modulesArray[0].ready)
	{
		module.init(true); // true means check ping for safe mode
	} else {
		module.queued = true;
	}
	return module;
};


Wildfire._raiseModulesUpdate = function() 
{
	var moduleList = "";
	for(var key in this.modules) moduleList += key + ",";
			
	var eventData = {'type':'modulesUpdate','modules':moduleList};

	this._raiseSysEvent(eventData);
}

Wildfire._raiseSysSignoutEvent = function() {
	this._raiseSysEvent({'type':'signout'});
}

Wildfire._raiseSysEvent = function(eventData) 
{
	if (this.modulesArray.length<=1) return;
	
	for(var key in this.modules) {
		var rse=this.modules[key].raiseSysEvent;
		if (rse!=null) {
			rse(eventData);
		}
	}
}

Wildfire._onFrameLoaded = function(moduleId) 
{
	var ui = document.getElementById(moduleId+"_UIFrame");
	if (ui!=null) ui.style.visibility="visible";	

	var pdiv = document.getElementById(moduleId+"_progress");
	if (pdiv!=null) pdiv.style.display = "none";

	this.modules[moduleId].UIFrame.style.visibility="visible";	
	this.modules[moduleId].applyConfig();
	this.modules[moduleId].ready = true;
	
	setTimeout("Wildfire._raiseModulesUpdate()",1500);
};

Wildfire._addQSParam = function(module,pName) {
	if ( def(typeof module.config) && def(module.config[pName]) ) {
		module.qsParams[module.qsParams.length] = pName+'='+Wildfire._URLEncode(module.config[pName]);
	}
};

Wildfire._URLEncode=function (s){
	if (encodeURIComponent) {
		return encodeURIComponent(s);
	}
	else {
		es=escape(s);
		return es.replace(/\+/g,'%2b').replace(/%20/g,'+').replace(/[/]/g,'%2f').replace(/%3D/g,'%3d');
	}
};


Wildfire._eventHandlersMap={ 
	send:'onSend',
	postComment:'onPostComment',
	postProfile:'onPostProfile',
	close:'onClose',
	renderDone:'onRenderDone',
	networkButtonClicked:'onNetworkButtonClicked',
	load:'onLoad',
	copy:'onCopy',
	email:'onEmail'
};



Wildfire._onCallback=Wildfire._raiseEvent = function(WFEvent) {		
	try {
		var handlerName=Wildfire._eventHandlersMap[WFEvent.type];

		var a=[handlerName , '({'];
		var v;
		var delim;
		for (var p in WFEvent) {
			a.push(p);
			v=WFEvent[p]
			a.push(':');
			if (typeof p=='string') a.push('\'');
			a.push(v);
			if (typeof p=='string') a.push('\'');
			a.push(',');
		}					
		a.pop(); // remove last comma
		a.push('})');
		var HandlerCall=a.join('');

		if (isnotnull(Wildfire[handlerName]))
			window.setTimeout('Wildfire.'+HandlerCall,1); //Wildfire.onSend(WFEvent);
		
		if (isnotnull(Wildfire.modules[WFEvent.ModuleID].config[handlerName]))
			window.setTimeout('Wildfire.modules[\'' + WFEvent.ModuleID + '\'].config.'+HandlerCall,1); //wfModuleCfg.onSend(WFEvent);
				  				
	} 
	catch (err) {
		alert(err);
	}
}

Wildfire._Module=function() {
	// for common functionality of Flash and JS modules
}


Wildfire._JSModule= function () {
	this.formsContainer = null;
	this.pingTimeout = null;
}
Wildfire._JSModule.prototype=new Wildfire._Module();


Wildfire._FlashModule=function(){}
Wildfire._FlashModule.prototype=new Wildfire._Module();


Wildfire._JSModule.prototype.pingOK = function(ok) {
	window.clearTimeout(this.pingTimeout);
	this.config.safeMode = !ok;
	this.init(false);
}


Wildfire._FlashModule.prototype.init = function(checkPing){
	var html='';
		if ((''+this.config.isApply)!='true' && this.config.hideProgress != true) {
		    document.getElementById(this.id).style.background = 'url(' + this.config.progressImageSrc + ') no-repeat center center';
			//html += '<div style="position:relative;top:50%;text-align:center;font-size:12px;z-index:50;" id="'+this.id+'_progress"><center><img  src="'+this.config.progressImageSrc+'"></center></div>';
		}
		var swf='http://cdn.gigya.com/WildFire/swf/wildfire_en.swf';
		if (this.config.lang != null) {
			swf='http://cdn.gigya.com/WildFire/swf/wildfire_' + this.config.lang + '.swf';
		}
		var wmode = (this.config.nowmode?'':'transparent');
		if (this.config.wmodeType) wmode = this.config.wmodeType;
		html += Wildfire.Flash.AC_FL_GetContent(
		'id', 'wfmodule_'+this.id,
		'name', 'wfmodule_'+this.id,
		'width', this.config.width,
		'height', this.config.height,
		'movie', swf,
		'quality', 'high',  
		'align', 'middle',
		'play', 'true',
		'loop', 'true',
		'scale', 'showall',
		'wmode', wmode, 
		'devicefont', 'false',
		'bgcolor', ((this.config.nowmode && this.config.outsideColor)?this.config.outsideColor:'#ffffff'),
		'menu', 'true',
		'allowFullScreen', 'false',
		'allowScriptAccess','always',
		'salign', '',
		'flashvars','ModuleID='+ this.id+'&now='+(new Date()).getTime(),
		'swLiveConnect','true'
		)
	
	window['wfmodule_'+this.id] = null;
	//alert('html =' + html);
	if (!Wildfire._pixeIframeCreated) {
		html += "<iframe src='http://cdn.gigya.com/wildfire/do_not_delete.htm' style='width:0;height:0;visibility:hidden' />";
		Wildfire._pixeIframeCreated = true;
	}
		
	this._injectWFCode(html);
	//alert('Html Code  Injected');
	// ExternalInterface bug workaround - 
	window['wfmodule_'+this.id] = document.getElementById('wfmodule_'+this.id);
	//alert('window attribute set, invoking go()');
	//because the flash needs to do externalInterface calls as soon as it starts
	//we can not have it "autoExecute" or the line above this comment would not
	//be executed by the time it tries to call back.
	//window['wfmodule_'+this.id].SetVariable('_root.ready','1');
}

Wildfire._IsModuleReady=function(targetId) {
	return (window['wfmodule_'+targetId] != null)
}


Wildfire._JSModule.prototype.init = function(checkPing) 
{
	var wfroot='http://wildfire.gigya.com/wildfire';
	var id=this.id;
	var uifid=id+'_UIFrame';
	var cfg=this.config;
	
	if (!cfg.safeMode && checkPing && this.pingTimeout==null)
	{
		var script = document.createElement("script");
		script.src = wfroot+'/jsping.ashx?mid='+id + "&rand=" + Math.random() + Math.random();
		this.container.appendChild(script);
		this.pingTimeout = window.setTimeout("Wildfire.modules['"+id+"'].pingOK(false)",10000);
		return;
	}
	var qs = this.qsParams.join('&');
	qs += ("&mid="+id);
	
	var html = "";
	var formsHTML = "";
	var UIURL = wfroot+'/'+this.type + "Main.aspx?" + qs;
	if (cfg.safeMode){
		UIURL = this.getSafeModeURL();
		if (UIURL==null) {
			Wildfire[id] = Wildfire.modules[id] = Wildfire.modulesArray[Wildfire.modulesArray.length] = null;
			return null;
		}
		html += "<iframe allowtransparency='true' id="+uifid +" name="+uifid+" style='width:" + cfg.width + "px;height:" + cfg.height + "px;display:inherit;visibility:inherit' frameborder=0 scrolling=no></iframe>";
		formsHTML += "<form id='"+id+"_postForm' action='"+UIURL+"' method='POST' target="+uifid+" style='display:none'></form>";
	}
	else if (cfg.simple) {
		if (this.type=="share") UIURL = wfroot+'/shareSimple.aspx';
		if (UIURL==null) {
			Wildfire[id] = Wildfire.modules[id] = Wildfire.modulesArray[Wildfire.modulesArray.length] = null;
			return null;
		}
		html += "<iframe allowtransparency='true' id="+uifid +" name="+uifid+" style='width:" + cfg.width + "px;height:" + cfg.height + "px;display:inherit;visibility:inherit' frameborder=0 scrolling=no></iframe>";
		formsHTML += "<form id='"+id+"_postForm' action='"+UIURL+"' method='POST' target="+uifid+" style='display:none'></form>";
	} else {
		html += "<div style='position:relative;top:50%;text-align:center;font-size:12px;' id='"+id+"_progress'><center><img  src='"+cfg.progressImageSrc+"'></center></div>";
		html += "<iframe allowtransparency='true' onload='Wildfire._onFrameLoaded(\""+id+"\")' id="+uifid+" style='visibility:hidden;width:" + cfg.width + "px;height:" + cfg.height + "px;' src='"+ UIURL + "' frameborder=0 scrolling=no></iframe>";			
		html += '<iframe id="IFREndlessActivityBugFix" style="display:none;width:100px;height:10px"></iframe>';
		html += this._createCBFrame();

		formsHTML += "<form id='"+id+"_postForm' action='"+wfroot+"/WFHandler.ashx?cmd=config' method='POST' target='"+id+"_postTargetFrame' style='display:none'></form>";			
		formsHTML += "<form id='"+id+"_sysEventForm' action='"+wfroot+"/WFHandler.ashx?cmd=sysEvent' method='POST' target='"+id+"_sysEventFrame' style='display:none'></form>";
	}
	
	this._injectWFCode(html,formsHTML);	
	
	// if cant create callback frame, disable callbacks
	if (document.getElementById(id+"_wfCBFrame")==null)	{
		cfg.domainForCallback = null;
	}
		
	this.UIFrame = document.getElementById(id+"_UIFrame");
	this.postForm = document.getElementById(id+"_postForm");
	this.sysEventForm = document.getElementById(id+"_sysEventForm");
	
	if (cfg.simple || cfg.safeMode) this.applyConfig(); // normal modules get config on frame load
}

Wildfire._JSModule.prototype._createCBFrame = function() 
{
	if ( def(this.config.domainForCallback) && document.getElementById(this.id+'_wfCBDiv')==null ) 
	{
		try {
			document.domain = this.config.domainForCallback;	
			return "<iframe name='"+this.id+"_wfCBFrame' style='visibility:hidden;width:0px;height:0px;' src='http://wildfire."+this.config.domainForCallback+"/wildfire/WFHandler.ashx?domain="+escape(this.config.domainForCallback)+"'></iframe>";
			
		} catch(ex) {
			//GIGYAONLY:alert('Unable to create Iframe for callback: '+ex.description);
			return "";
		}
	} else {
		return "";
	}
}

Wildfire._FlashModule.prototype.copyConfig =  Wildfire._JSModule.prototype.copyConfig = function(config) 
{
	// clone config obj to module
	if (config!=null) {
		this.config = {};
		for(var key in config) this.config[key] = config[key];
	}

	// apply default values
	if ( undef(this.config.progressImageSrc) ) 	this.config.progressImageSrc = "http://cdn.gigya.com/WildFire/i/progress_ani.gif";
	//if ( undef(this.config.cornerRoundness) ) 	this.config.cornerRoundness=1;
	if ( undef(this.config.simple) ) this.config.simple = navigator.userAgent.toLowerCase().indexOf('safari')!=-1;
}

Wildfire._JSModule.prototype.getSafeModeURL = function(){
	if (this.type=="share") return "http://backup.gigya.com/WFSimple/share.aspx";
	return null;
}

// check if page already has 'form' tag, if yes, insert div to contain our forms, outside of it.
Wildfire._JSModule.prototype._injectWFCode= function(html,formsHTML){
	var el=this.container;
	for(;((el!=null) && ((''+el.tagName).toLowerCase() !='form'));el=el.parentNode);
	if (el!=null) { 
		this.container.innerHTML = html;
		this.formsContainer = document.createElement('div');
		this.formsContainer.style.display='none';
		el.parentNode.insertBefore(this.formsContainer,el);
		this.formsContainer.innerHTML = formsHTML;
		
	} else
	{
		this.container.innerHTML = html + formsHTML;
	}
};


Wildfire._FlashModule.prototype._injectWFCode= function(html){
	this.container.innerHTML = html;
};

Wildfire._JSModule.prototype.raiseSysEvent = function(eventData){
	if (this.sysEventForm==null || !this.ready)  return;
	
	var s = new Array(); var i=0;
	for(var key in eventData) {
		if (typeof key != 'function' && eventData[key]!=null) {
			s[i++] = "<input type=hidden name='"+key+"'/>"
		}
	}
	
	this.sysEventForm.innerHTML = s.join('');

	//set value (using foo.value handles escaping of strings better...)
	for (var i=0;i<this.sysEventForm.length; i++) {
		this.sysEventForm[i].value = eventData[this.sysEventForm[i].name];
	}
	this.sysEventForm.submit();
};

Wildfire._FlashModule.prototype.applyConfig = function(conf){
	conf.isApply="true";
	return Wildfire._createFlashModule(this.type, this.partner, this.id, this.width, this.height, conf);
};

Wildfire._JSModule.prototype.applyConfig = function(conf){
	if (conf!=null) this.copyConfig(conf);
	var cfg=this.config;
	if (cfg==null) return;
	if (cfg.location==null || cfg.location=="")	{
		try { cfg.location = document.location.href;} catch(err) {}
	}

	cfg.partner = this.partner;
	cfg.width	= this.width;
	cfg.height	= this.height;

	// check if templates are IDs or actual values
	// For Post
	postContent=['default','myspace','hi5','friendster','xanga','livejournal','freewebs','facebook','bebo','blogger','tagged','typepad','blackplanet'];
	for (var pci=0;pci<postContent.length;pci++){
		this._getTemplate(postContent[pci] + 'Content');
	}
	//For Share
	shareTemplates=['default','comment','email','myspace','hi5','friendster','xanga','freewebs'];
	for (var sti=0;sti<shareTemplates.length;sti++){
		this._getTemplate(shareTemplates[sti]+ 'Template');
	}

	// build config fields
	var s = new Array(); var i=0;
	for(var key in cfg) {
		if (typeof key != 'function' && cfg[key]!=null) {
			s[i++] = "<input type=hidden name='"+key+"'/>"
		}
	}

	this.postForm.innerHTML = s.join('');

	//set value (using formfield.value handles escaping of strings better...)
	for (var i=0;i<this.postForm.length; i++) {
		this.postForm[i].value = this.config[this.postForm[i].name];
	}
	this.postForm.submit();
	
	window.setTimeout('Wildfire._EndlessActivityBugFix();',1000);
};

Wildfire._EndlessActivityBugFix=function(){
	var ifr=document.getElementById('IFREndlessActivityBugFix');
	if (ifr!=null) {
		ifr.src='http://cdn.gigya.com/wildfire/i/n.gif';
	}
};

Wildfire._JSModule.prototype._getTemplate = function (key) {
	if ( isnotnull(this.config[key]) ) {
		try {
			if ( isnotnull(document.getElementById(this.config[key])) )
				this.config[key] = document.getElementById(this.config[key]).value;
		} catch (e) {
			//GIGYAONLY:alert('Unable to get template for key :'+ key + '\n' + ex.description);
		}
	}
};

Wildfire._CopyAtts=function(t,s,atts){ for(k in atts.split(',')){ t[atts[k]]=s[atts[k]]; }}
Wildfire._CopyAllAtts=function(t,s){for(k in s) {t[k]=s[k];}}

function undef(o) { return (typeof(o)=='undefined');}
function def(o) { return (typeof(o)!='undefined');}
function isnotnull(o) { return (def(o) && (o!=null));}

function WFQueue(){
  var queue=new Array();
  var queueSpace=0;
  this.count=function()
  {
	return queue.length;
  }
  this.enqueue=function(element){
    queue.push(element);
  }
  this.dequeue=function(){
    if (queue.length){
      var element=queue[queueSpace];
      if (++queueSpace*2 >= queue.length){
        for (var i=queueSpace;i<queue.length;i++) queue[i-queueSpace]=queue[i];
        queue.length-=queueSpace;
        queueSpace=0;
      }
      return element;
    }else{
      return undefined;
    }
  }
}

////////////////////////////
//  Wildfire Post Button
///////////////////////////
Wildfire._GetElementPos=function(obj) {
	var curleft = curtop = 0;
	if (obj.offsetParent) {
		do {
			curleft += obj.offsetLeft;
			curtop += obj.offsetTop;
		} while (obj = obj.offsetParent);
	};
	return {left:curleft,top:curtop};
}	

Wildfire._HandleEmbedAndObjectsBelow=function(container,w,h){
	//if (!Gigya.Flash.isFF)  return;
	var blnHide=true;
	
	var cpos=Wildfire._GetElementPos(container);
	var ctop=cpos.top;
	var cleft=cpos.left;
	var cright=cleft+w;
	var cbottom=ctop+h;
	var tags;
	if (Wildfire.Flash.isIE)  {
		tags=['iframe'];
	}
	else {
		tags=['embed','iframe']; //object seems to be unrequired.
	}
	for (var itag=0;itag<tags.length;itag++) {
		tagname=tags[itag];
		elements=document.getElementsByTagName(tagname);
		//alert ('There are ' + elements.length + ' of tag ' + tagname);
		for (var i=0;i<elements.length;i++){
			var el=elements[i];
			if (el.style.visibility!='hidden' && container.childNodes[0]!=el) {
				var epos=Wildfire._GetElementPos(el);
				var etop=epos.top;
				var eleft=epos.left;
				
				var elcs=(document.defaultView)?document.defaultView.getComputedStyle(el, ""):el.currentStyle;
				var eright=eleft+parseInt(elcs.getPropertyValue?elcs.getPropertyValue('width'):elcs.width);
				var ebottom=etop+parseInt(elcs.getPropertyValue?elcs.getPropertyValue('height'):elcs.height);
				
				if (!((etop>cbottom) || (ebottom<ctop) || (eleft >cright) || (eright<cleft))) {
					var isNonGigyaIframe=(tagname=='iframe') && ((el.id+'          ').substr(0,10)!='gigya_ifr_');
					if (
						  ( (tagname=='embed' ) && 
							( (el.getAttribute('wmode')==null) || 
							  (el.getAttribute('wmode')=='') || 
							  (el.getAttribute('wmode')=='window') 
							)
						   ) 
						|| isNonGigyaIframe)  {
						if (blnHide && (container.id != 'coreDiv')) {								
								el.style.visibility='hidden';
								if (container.elementsToShowOnClose == null) container.elementsToShowOnClose=[];
								container.elementsToShowOnClose.push(el);

						}
					}
				}
			}
		}
	}
}

Wildfire._CreateContainer=function(id, noIframe) {
	var ifrel;
	if (Wildfire.Flash.isIE && Wildfire.Flash.isWin && !noIframe) {
		ifrel = document.createElement('IFRAME');
		ifrel.id='gigya_ifr_'+id;
		ifrel.frameBorder="0";
		ifrel.style.border='0px';
		ifrel.style.position='absolute';
		ifrel.style.width='1px';
		ifrel.style.height='1px';
		if (ifrel.style.zIndex!=null) {
			ifrel.style.zIndex=Wildfire._NextZIndex++;
		}
	}

	var el = document.createElement('div');
	el.style.position='absolute';
	if (el.style.zIndex!=null) {
		el.style.zIndex=Wildfire._NextZIndex++;
	}
	var html='';
	el.innerHTML = html;
	el.id=id;
	el.swfLoaded = false;
	if (document.body) {
		if(document.body.insertBefore) {
			if (document.body.firstChild) {
				if (ifrel!=null) document.body.insertBefore(ifrel, document.body.firstChild);
				document.body.insertBefore(el, document.body.firstChild);
			}
		}
	}
	return el;
}

Wildfire._hideWildfirePopup = function(o) {
    var wildfireDiv = document.getElementById(o.ModuleID)
    var ifr=document.getElementById('gigya_ifr_'+o.ModuleID)
	if (ifr!=null) ifr.style.visibility='hidden';
	var elementsToShowOnClose=wildfireDiv.elementsToShowOnClose;
	if (elementsToShowOnClose!=null) {
		for (var i=0;i<elementsToShowOnClose.length;i++) {
			elementsToShowOnClose[i].style.visibility='';
		}
	}
	
	//wildfireDiv.innerHTML='&nbsp;';
	wildfireDiv.style.visibility='hidden';
	//wildfireDiv.parentNode.removeChild(wildfireDiv);
}

if (typeof Wildfire._popupConfigs == 'undefined') {
    Wildfire._popupConfigs = [];
}
Wildfire.drawWildfireButton = function(params) {
    if (typeof params.w=='undefined') params.w = 400;
    if (typeof params.h=='undefined') params.h = 300;
    if (params.b==null) {
        params.b = 'click';
    }
    var altText = '';
    if (typeof(params.btnurl)=='undefined') {
        switch(params.conf['module']) {
            case 'bookmarks': params.btnurl='http://cdn.gigya.com/wildfire/i/bookmark_button.gif'; break;
            case 'post': 
            default: params.btnurl='http://cdn.gigya.com/wildfire/i/post-to-button.gif';
        }
    }
    switch(params.conf['module']) {
        case 'bookmarks': 
            altText = 'Add to bookmarks';
            params.conf["showBookmark"] = "true";
            params.conf["showEmail"] = "false";
            params.conf["showPost"] = "false";
            break;
        case 'post': 
            params.conf["showEmail"] = "true";
            params.conf["showBookmark"] = "true";
        default:
            altText = 'Post to my social network or blog';
    }
    switch(params['theme']) {
        case '1': params.conf['UIConfig'] = '<config><display showEmail="true" useTransitions="true" showBookmark="true"></display><body corner-roundness="8"><background gradient-color-begin="#00006D" gradient-color-end="#28516D"></background><controls><snbuttons type="textUnder" background-color="#FFFFFF" over-background-color="#FFFFFF" color="DEE8EC" corner-roundness="0;10;0;10" size="11" bold="true" over-color="#FFFFC8"></snbuttons><textboxes><codeboxes color="#6A6A6A" frame-color="#0D1B6D" background-color="DEE8EC"></codeboxes><inputs gradient-color-begin="E9F0F3" gradient-color-end="E9F0F3"></inputs><dropdowns list-item-over-color="#1B0D6D" gradient-color-begin="E9F0F3" gradient-color-end="E9F0F3" list-item-over-gradient-color-end="#28516D"></dropdowns></textboxes><buttons gradient-color-begin="#0099FF" gradient-color-end="#223276" color="#FFFFFF" corner-roundness="0;8;0;8" font="arial" size="11" bold="true" over-gradient-color-begin="#0099FF" over-gradient-color-end="#0099FF"></buttons><servicemarker gradient-color-begin="Transparent" gradient-color-end="#0098FE"></servicemarker></controls><texts color="#FFFFFF" bold="true"><privacy color="#AAAAAA"></privacy><labels color="C1D7E5"></labels><messages color="#F4F4F4" background-color="#1B366D" bold="true"></messages><links color="E9F0F3" underline="false" over-color="#ADC8FF"></links></texts></body></config>'; break;
        case '2': params.conf['UIConfig'] = '<config><display showDesktop="false" showEmail="true" useTransitions="true" showBookmark="true" codeBoxHeight="auto" showCodeBox="true" showCloseButton="false" bulletinChecked="false" networksWithCodeBox=""></display><body corner-roundness="8"><background frame-color="Transparent" gradient-color-begin="#353535" gradient-color-end="#606060" corner-roundness="8;8;8;8"></background><controls size="11" bold="true"><snbuttons type="textUnder" frame-color="#6D0000" background-color="#FFFFFF" over-background-color="#FFFFFF" color="#CACACA" corner-roundness="0;8;8;8" gradient-color-begin="#8A8A8A" gradient-color-end="#000000" font="Arial" size="11" bold="false" over-gradient-color-begin="#AAAAAA" over-gradient-color-end="#000000" over-color="#F4F4F4" down-color="#000000"><more frame-color="Transparent"></more></snbuttons><textboxes frame-color="#000000" color="#AAAAAA" corner-roundness="0;0;0;0" gradient-color-begin="#202020" gradient-color-end="#0B0B0B" font="Arial" bold="false"><codeboxes color="#EAEAEA" frame-color="#8A8A8A" gradient-color-begin="#000000" font="Arial" bold="false"></codeboxes><inputs frame-color="#6D0000"></inputs><dropdowns frame-color="#6D0000" handle-gradient-color-begin="#B60000" handle-gradient-color-end="#6D0000" handle-over-gradient-color-begin="#FF0000" handle-over-gradient-color-end="#DA0000" handle-down-gradient-color-begin="#FF0000" handle-down-gradient-color-end="#6D0000" background-color="#6D0000" gradient-color-begin="#000000" font="Arial" bold="false"></dropdowns></textboxes><buttons frame-color="#FF0000" gradient-color-begin="#FF2424" gradient-color-end="#6D0000" color="#F4F4F4" corner-roundness="0;8;8;8" font="Arial" size="10" bold="false" down-frame-color="#000000" over-gradient-color-begin="#DA0000" down-gradient-color-begin="#910000" over-gradient-color-end="#DA0000" down-gradient-color-end="#FF0000" over-color="#F4F4F4"><post-buttons gradient-color-begin="#FF4949" gradient-color-end="#6D0000"></post-buttons></buttons><listboxes corner-roundness="5"></listboxes><checkboxes down-corner-roundness="0"></checkboxes><servicemarker gradient-color-begin="#DA0000" gradient-color-end="#DA0000"></servicemarker></controls><texts color="#FFFFFF" font="Arial" size="10"><privacy color="#959595" size="11"></privacy><headers size="11" bold="true"></headers><labels size="11" bold="true"></labels><messages color="#D5D5D5" frame-thickness="0" corner-roundness="0;0;0;0" gradient-color-begin="#B60000" gradient-color-end="#000000" size="11" bold="true"></messages><links color="#DFDFDF" underline="false" size="11" bold="true" over-color="#FFFFFF"></links></texts></body></config>'; break;
        case '3': params.conf['UIConfig'] = '<config><display showDesktop="false" showEmail="true" useTransitions="true" showBookmark="true" codeBoxHeight="auto" showCodeBox="true" showCloseButton="false" bulletinChecked="false" networksWithCodeBox=""></display><body corner-roundness="8"><background frame-color="Transparent" gradient-color-begin="#DA0000" gradient-color-end="#FFC8AD" corner-roundness="8;8;8;8"></background><controls size="11" bold="true"><snbuttons type="textUnder" frame-color="#DA0000" background-color="#FFFFFF" over-frame-color="#F4F4F4" over-background-color="#FFFFFF" color="#6D0000" corner-roundness="0;8;8;8" gradient-color-begin="#6D0000" gradient-color-end="#6D0000" font="Arial" size="11" bold="true" down-frame-color="#6D0000" over-gradient-color-begin="#FFAD9F" down-gradient-color-begin="#910000" over-gradient-color-end="#6D0D1B" down-gradient-color-end="#FFAD9F" over-color="#F4F4F4" down-color="#000000"><more frame-color="#AAAAAA" over-frame-color="#AAAAAA" gradient-color-begin="#DA0000" over-gradient-color-begin="#FF5B40"></more><previous frame-color="#AAAAAA" background-color="DBDBDB" over-frame-color="#6D0000" over-background-color="#6A6A6A" gradient-color-begin="#FF5B40" gradient-color-end="#6D0D1B" down-frame-color="6D0000" down-background-color="DBDBDB" over-gradient-color-begin="#910000" down-gradient-color-begin="FF5B40" over-gradient-color-end="#FFAD9F" down-gradient-color-end="6D0D1B"></previous></snbuttons><textboxes frame-color="#353535" color="#F4F4F4" corner-roundness="0;0;0;0" gradient-color-begin="#202020" gradient-color-end="#0B0B0B" font="Arial" bold="false"><codeboxes color="#1B366D" frame-color="#DA0000" gradient-color-begin="#EAEAEA" gradient-color-end="#F4F4F4" font="Arial" bold="false"></codeboxes><inputs frame-color="#B60000" color="#606060" gradient-color-begin="#DFDFDF" gradient-color-end="#DFDFDF"></inputs><dropdowns list-item-over-color="#FF2424" frame-color="#B60000" handle-gradient-color-begin="#AEC8F7" handle-gradient-color-end="#6D0000" handle-over-gradient-color-begin="#AEC8F7" handle-over-gradient-color-end="#AEC8F7" handle-down-gradient-color-begin="#FF0000" handle-down-gradient-color-end="#6D0000" background-color="#EAEAEA" color="#4A4A4A" gradient-color-begin="#EAEAEA" gradient-color-end="#EAEAEA" font="Arial" bold="false" list-item-over-gradient-color-end="#F4F4F4"></dropdowns></textboxes><buttons frame-color="#DA0000" gradient-color-begin="#FF0000" gradient-color-end="#910000" color="#F4F4F4" corner-roundness="0;8;8;8" font="Arial" size="10" bold="true" over-frame-color="#DA0000" down-frame-color="#F4F4F4" over-gradient-color-begin="#DA0000" down-gradient-color-begin="#910000" over-gradient-color-end="#910000" down-gradient-color-end="#0D1B6D" over-color="#F4F4F4"><post-buttons gradient-color-begin="#FF4949" gradient-color-end="#6D0000"></post-buttons></buttons><listboxes corner-roundness="5;5;5;5" bold="false"></listboxes><checkboxes down-corner-roundness="0"></checkboxes><servicemarker gradient-color-begin="#555555" gradient-color-end="#555555"></servicemarker></controls><texts color="#FFFFFF" font="Arial" size="10" bold="true"><privacy color="#910000" size="11" bold="false"></privacy><headers size="11" bold="true"></headers><labels color="#B60000" size="11" bold="true"></labels><messages color="#FFC8AD" background-color="#1B366D" frame-thickness="0" corner-roundness="3;3;3;3" gradient-color-begin="#912412" gradient-color-end="#6D1B0D" size="11" bold="true"></messages><links color="#F4F4F4" underline="false" size="11" bold="true" over-color="#FFFFFF"></links></texts></body></config>'; break;
        case '4': params.conf['UIConfig'] = '<config><display showDesktop="false" showEmail="true" useTransitions="true" showBookmark="true" codeBoxHeight="auto" showCodeBox="true" showCloseButton="false" bulletinChecked="false" networksWithCodeBox=""></display><body corner-roundness="8"><background frame-color="Transparent" gradient-color-begin="#A4DA52" gradient-color-end="#6D9136" corner-roundness="8"></background><controls size="11" bold="true"><snbuttons type="textUnder" frame-color="#6D9136" background-color="#FFFFFF" over-frame-color="#D5D5D5" over-background-color="#FFFFFF" color="#1B6D0D" corner-roundness="0;8;0;8" gradient-color-begin="#88B644" gradient-color-end="#000000" font="Arial" size="11" bold="true" over-gradient-color-begin="#88B644" down-gradient-color-begin="#DADA6D" over-gradient-color-end="#000000" down-gradient-color-end="#6D9136" over-color="#F4F4F4" down-color="#000000"><more frame-color="#BABABA" gradient-color-begin="#516D28" gradient-color-end="#516D28" bold="true"></more><previous frame-color="#BABABA" gradient-color-begin="#516D28" gradient-color-end="#516D28"></previous></snbuttons><textboxes frame-color="#000000" color="#AAAAAA" corner-roundness="0;8;0;8" gradient-color-begin="#6D5128" gradient-color-end="#6D5128" font="Verdana" corner-roundness-top="8" corner-roundness-bottom="8" bold="false"><codeboxes color="#EAEAEA" frame-color="6D1B0D" background-color="#B6B65B" gradient-color-begin="#919148" gradient-color-end="#919148" font="Arial" bold="false"></codeboxes><inputs frame-color="#6D1B0D" color="#FFFFC8" gradient-color-begin="#919148" gradient-color-end="#919148" font="Arial"></inputs><dropdowns list-item-over-color="6D1B0D" frame-color="#6D1B0D" handle-gradient-color-begin="#FFFFC8" handle-gradient-color-end="#DADA6D" handle-over-gradient-color-begin="#FFFFC8" handle-over-gradient-color-end="#FFFFB6" handle-down-gradient-color-begin="#DADA6D" handle-down-gradient-color-end="#DADA6D" background-color="#FFFFC8" color="#FFFFC8" gradient-color-begin="#919148" gradient-color-end="#919148" font="Arial" bold="false" list-item-over-gradient-color-end="#FFFFC8"></dropdowns></textboxes><buttons frame-color="6D1B0D" gradient-color-begin="#FFFFC8" gradient-color-end="#B6B65B" corner-roundness="0;8;8;8" font="Arial" size="11" bold="true" over-frame-color="#6D1B0D" down-frame-color="#F4F4F4" over-gradient-color-begin="#FFFFC8" down-gradient-color-begin="#F4F4F4" over-gradient-color-end="#DADA6D" down-gradient-color-end="#FFFF92" over-color="#28516D"><post-buttons frame-color="#6D1B0D" background-color="#FFFFC8" gradient-color-begin="#FFFFC8" gradient-color-end="B6B65B"></post-buttons></buttons><listboxes corner-roundness="5;5;5;5" bold="false"></listboxes><checkboxes down-corner-roundness="0"></checkboxes><servicemarker gradient-color-begin="#A4DA52" gradient-color-end="#516D28"></servicemarker></controls><texts color="#FFFFFF" font="Arial" size="11" bold="true"><privacy color="#6D361B" size="11" bold="true"></privacy><headers color="#EAEAEA" size="11" bold="true"></headers><labels color="#6D1B0D" size="11" bold="true"></labels><messages color="#6D6D36" background-color="#1B366D" frame-thickness="0" corner-roundness="0;0;0;0" gradient-color-begin="#FFFFC8" gradient-color-end="#FFFFC8" size="11" bold="true"></messages><links color="#FFFFFF" underline="false" size="11" bold="true" over-color="#6D1B0D" down-color="#366D1B"></links></texts></body></config>'; break;
        case '5': params.conf['UIConfig'] = '<config><display showEmail="true" useTransitions="true" showBookmark="true"></display><body corner-roundness="8"><background gradient-color-begin="#ADC8FF"></background><controls><snbuttons type="textUnder" background-color="#FFFFFF" over-background-color="#FFFFFF" color="#376DDA" corner-roundness="0;10;0;10" size="11" bold="false" over-color="#0D1B6D"></snbuttons><textboxes><codeboxes color="#6A6A6A" frame-color="#1B366D" background-color="#F4F4F4"></codeboxes></textboxes><buttons gradient-color-begin="#0099FF" gradient-color-end="#223276" color="#FFFFFF" corner-roundness="0;8;0;8" font="arial" size="11" bold="true" over-gradient-color-begin="#0099FF" over-gradient-color-end="#0099FF"></buttons><servicemarker gradient-color-begin="#F4F4F4" gradient-color-end="#F4F4F4"></servicemarker></controls><texts color="#FFFFFF" bold="true"><privacy color="#AAAAAA"></privacy><labels color="#1B366D"></labels><messages color="#F4F4F4" background-color="#1B366D" bold="true"></messages><links color="#376DDA" underline="false" over-color="#1B366D"></links></texts></body></config>'; break;
        case '6': params.conf['UIConfig'] = '<config><display showEmail="true" useTransitions="true" showBookmark="true" codeBoxHeight="auto" showCodeBox="true" showCloseButton="false" networksWithCodeBox=""></display><body><background frame-color="#BFBFBF" background-color="#FFFFFF" gradient-color-begin="#ffffff" gradient-color-end="#F4F4F4" corner-roundness="4;4;4;4"></background><controls color="#202020" corner-roundness="4;4;4;4" gradient-color-begin="#EAEAEA" gradient-color-end="#F4F4F4" bold="false"><snbuttons  type="textUnder" frame-color="#D5D5D5" over-frame-color="#60BFFF" color="#808080" gradient-color-begin="#FFFFFF" gradient-color-end="d4d6d7" size="10" bold="false" down-frame-color="#60BFFF" down-gradient-color-begin="#6DDADA" over-gradient-color-end="#6DDADA" down-gradient-color-end="#F4F4F4" over-color="#52A4DA" down-color="#52A4DA" over-bold="false"><more frame-color="#A4DBFF" over-frame-color="#A4DBFF" gradient-color-begin="#F4F4F4" gradient-color-end="#BBE4FF" over-gradient-color-begin="#A4DBFF" over-gradient-color-end="#F4F4F4"></more><previous frame-color="#BBE4FF" over-frame-color="#A4DBFF" gradient-color-begin="#FFFFFF" gradient-color-end="#A4DBFF" over-gradient-color-begin="#A4DBFF" over-gradient-color-end="#F4F4F4"></previous></snbuttons><textboxes frame-color="#CACACA" color="#757575" gradient-color-begin="#ffffff" bold="false"><codeboxes color="#757575" frame-color="#DFDFDF" background-color="#FFFFFF" gradient-color-begin="#ffffff" gradient-color-end="#FFFFFF" size="10"></codeboxes><inputs frame-color="#CACACA" color="#757575" gradient-color-begin="#F4F4F4" gradient-color-end="#ffffff"></inputs><dropdowns frame-color="#CACACA" list-item-over-color="#52A4DA" ></dropdowns></textboxes><buttons frame-color="#CACACA" gradient-color-begin="#F4F4F4" gradient-color-end="#CACACA" color="#000000" bold="false" over-frame-color="#60BFFF" down-frame-color="#60BFFF" over-gradient-color-begin="#A4DBFF" down-gradient-color-begin="#A4DBFF" over-gradient-color-end="#FFFFFF" down-gradient-color-end="#ffffff"><post-buttons frame-color="#CACACA" gradient-color-end="#CACACA"></post-buttons></buttons><listboxes frame-color="#CACACA" corner-roundness="4;4;4;4" gradient-color-begin="#F4F4F4" gradient-color-end="#FFFFFF"></listboxes><checkboxes checkmark-color="#00B600" frame-color="#D5D5D5" corner-roundness="3;3;3;3" gradient-color-begin="#F4F4F4" gradient-color-end="#FFFFFF"></checkboxes><servicemarker gradient-color-begin="#ffffff" gradient-color-end="#D5D5D5"></servicemarker><tooltips color="#6D5128" gradient-color-begin="#FFFFFF" gradient-color-end="#FFE4BB" size="10" frame-color="#FFDBA4"></tooltips></controls><texts color="#202020"><headers color="#202020"></headers><messages color="#202020"></messages><links color="#52A4DA" underline="false" over-color="#353535" down-color="#353535" down-bold="false"></links></texts></body></config>'; break;
    }
    params.conf.showCloseButton = true;
    //params.conf.nowmode = true;
    params.conf.wmodeType = 'opaque';
    params.conf.cornerRoundness = 0;

    params.conf.onClose = Wildfire._hideWildfirePopup;
    params.conf.onRenderDone = function(o) {
        var popDiv = document.getElementById(o.ModuleID);
        popDiv.style.visibility = "";
        Wildfire._GetContainer(o.ModuleID + 'Progress').style.visibility="hidden";
        //var ifrel = document.getElementById('gigya_ifr_'+divID);
	    //if (ifrel!=null) ifrel.style.visibility = "";
        popDiv.style.zIndex=Wildfire._NextZIndex++;
        //Wildfire.revealDiv(o.ModuleID, height);
    }
    Wildfire._popupConfigs.push(params.conf);
    
    var configID = Wildfire._popupConfigs.length - 1;
    var html = '<img id="Wildfire_Button' + configID + '" src="' + params.btnurl + '" style="cursor: pointer" border=0 alt="' + altText + '" title="' + altText + '" />';
    if (params.button_divID) {
        document.getElementById(params.button_divID).innerHTML = html
    } else {
        document.write(html);
    }
    var btn = document.getElementById('Wildfire_Button' + configID);
    btn.openWildfirePopup = function() {
        btn.mouseIsOut=true;
        Wildfire._showWildfirePopup(params.partner, params.w, params.h, configID);
    }
    btn.onmouseout = function() {
        btn.mouseIsOut = true;
    }
    if (typeof Wildfire.buttonsData == 'undefined') Wildfire.buttonsData = {};
    switch(params.b.toLowerCase()) {
        case 'mouseover': 
            btn.configID = configID;
            Wildfire.buttonsData[configID] = function() {
                if (!btn.mouseIsOut) btn.openWildfirePopup();
            }
            btn.onmouseover = function() {
                btn.mouseIsOut=false;
                setTimeout('Wildfire.buttonsData[' + btn.configID + ']()', 500);
            }
            break;
        case 'click': 
        default: btn.onclick = btn.openWildfirePopup;
    }   
    return 'wildfire_postDiv_' + configID;
}
Wildfire.disposeWildfireButton = function(id) {
    var wfDiv = document.getElementById(id);
    var progressDiv = document.getElementById(id + 'Progress');
    var ifrel = document.getElementById('gigya_ifr_'+id);
    if (wfDiv) {
        var elementsToShowOnClose=wfDiv.elementsToShowOnClose;
	    if (elementsToShowOnClose!=null) {
		    for (var i=0;i<elementsToShowOnClose.length;i++) {
			    elementsToShowOnClose[i].style.visibility='';
		    }
	    }
	}
    if (wfDiv) document.body.removeChild(wfDiv);
    if (progressDiv) document.body.removeChild(progressDiv);
    if (ifrel) document.body.removeChild(ifrel);
}

Wildfire.renderPostButton = function(partner, width, height, config, btnurl, eventType, divID) {
    var params = {
        partner: partner,
        w: width,
        h: height,
        conf: config,
        btnurl: btnurl,
        b: eventType,
        divID: divID
    }
    return Wildfire.drawWildfireButton(params);
}

Wildfire._lastID = 0;

Wildfire._getScrollXY=function() {
  var scrOfX = 0, scrOfY = 0;
  if( typeof( window.pageYOffset ) == 'number' ) {
    //Netscape compliant
    scrOfY = window.pageYOffset;
    scrOfX = window.pageXOffset;
  } else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {
    //DOM compliant
    scrOfY = document.body.scrollTop;
    scrOfX = document.body.scrollLeft;
  } else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) ) {
    //IE6 standards compliant mode
    scrOfY = document.documentElement.scrollTop;
    scrOfX = document.documentElement.scrollLeft;
  }
  return [ scrOfX, scrOfY ];
}

Wildfire._GetContainer=function(id){
	if (id=='') return null;
	var el=document.getElementById(id);
	if (typeof(el)=='Array') {
		return el[el.length];
	}
	return el;
}

Wildfire._preparePopup = function(w, h, id, btnDiv, progressImageSrc) {
	var wfDiv = Wildfire._CreateContainer(id);
	var progressDiv = Wildfire._CreateContainer(id + 'Progress', true);
	
	var dst;
    
    dst=wfDiv.style;
    
	var vph;
	var vpw;
	var de=document.documentElement;
	
	vph=de.clientHeight;
	vpw=de.clientWidth;
	if (typeof vph=='undefined' || vph==0) {
		vph=document.body.clientHeight;
		vpw=document.body.clientWidth;
	}
	if (typeof vph=='undefined' || vph==0) {
		vph=window.innerHeight;
		vpw=window.innerWidth;
	}
	
	scrl=Wildfire._getScrollXY();
	
	var vpt=scrl[1];
	var vpl=scrl[0];
	var middlePointTop = vpt + Math.floor(vph/2);
	var middlePointLeft = vpl + Math.floor(vpw/2);
	
	//dst.top=''+(vpt+Math.floor((vph-h)/2))+'px';
	//dst.left=''+(vpl+Math.floor((vpw-w)/2))+'px';
	var btnPos = Wildfire._GetElementPos(btnDiv);
	if (btnPos.top>middlePointTop) {
	    dst.top = '' + (btnPos.top - h) + 'px';
	} else {
	    dst.top = '' + (btnPos.top + btnDiv.height) + 'px';
	}
	if (btnPos.left>middlePointLeft) {
	    dst.left = '' + (btnPos.left + btnDiv.width - w) + 'px';
	} else {
	    dst.left = '' + btnPos.left + 'px';
	}
	
	dst.width=''+w+'px';
	dst.height=''+h+'px';
	progressDiv.style.position = 'absolute';
	progressDiv.style.background = 'url(' + progressImageSrc + ') no-repeat center center';
	progressDiv.style.width = dst.width;
	progressDiv.style.height = dst.height;
	progressDiv.style.top = dst.top;
	progressDiv.style.left = dst.left;
	
	var ifrel = document.getElementById('gigya_ifr_'+id);
	if (ifrel!=null) {
	    ifrel.style.top=dst.top;
	    ifrel.style.left=dst.left;
	    ifrel.style.width=dst.width;
	    ifrel.style.height=dst.height;	
	}
	Wildfire._HandleEmbedAndObjectsBelow(wfDiv,w,h);
}

Wildfire._showWildfirePopup = function(partner, width, height, configID) {
    var divID = 'wildfire_postDiv_' + configID;
    var btnDiv = document.getElementById('Wildfire_Button' + configID);
    var popDiv = Wildfire._GetContainer(divID);
    if (popDiv==null || popDiv.style.visibility=='hidden') {
        Wildfire._preparePopup(width, height, divID, btnDiv, 'http://cdn.gigya.com/WildFire/i/progress_ani.gif');
        Wildfire.initPost(partner, divID, width, height, Wildfire._popupConfigs[configID]);
        //popDiv = Wildfire._GetContainer(divID);
        //popDiv.style.overflow='hidden';
        //popDiv.style.height='1px';
        //popDiv.style.visibility = 'hidden';
        /*var ifrel = document.getElementById('gigya_ifr_'+divID);
        if (ifrel!=null) {
            ifrel.style.visibility = 'hidden';
        } */        
    }
}

Wildfire.revealDiv = function(divID, maxHeight) {
    var div = document.getElementById(divID);
    var nextHeight = parseInt(div.style.height.replace('px','')) + 20;
    if (nextHeight<maxHeight) {
	    var ifrel = document.getElementById('gigya_ifr_'+divID);
        div.style.height = nextHeight + 'px';
	    if (ifrel!=null) {
	        ifrel.style.height = nextHeight + 'px';
	    }        
        window.setTimeout('Wildfire.revealDiv("' + divID + '", ' + maxHeight + ')',10);
    } else {
        div.style.height=maxHeight + 'px';
    }
}

//inject CIMP
Wildfire._injectCIMP = function() {
    if (document.getElementById('wildfire_cimp') == null && document.body != null) {
        var cimp = document.createElement('div');
        cimp.id = 'wildfire_cimp';
        cimp.width = 1;
        cimp.height = 1;
        cimp.style.display = 'none';
        cimp.style.visibility = 'hidden';
        cimp.style.position = 'absolute';
        cimp.innerHTML = '<img src="http://cdn.gigya.com/wildfire/i/CIMP.gif?CXNID=2000002.0NXC" />';
        document.body.insertBefore(cimp,document.body.firstChild);
    }
}

if (typeof WildfireBtn!='undefined' && typeof WildfireBtn.pendingButtons!='undefined') {
    for (var i = 0; i < WildfireBtn.pendingButtons.length; i++) {
        Wildfire.drawWildfireButton(WildfireBtn.pendingButtons[i]);
    }
}

window.setTimeout("Wildfire._injectCIMP()",5000);