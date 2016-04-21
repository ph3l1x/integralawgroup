/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dijit.form._FormWidget"]){
dojo._hasResource["dijit.form._FormWidget"]=true;
dojo.provide("dijit.form._FormWidget");
dojo.require("dijit._Widget");
dojo.require("dijit._Templated");
dojo.declare("dijit.form._FormWidget",[dijit._Widget,dijit._Templated],{baseClass:"",name:"",alt:"",value:"",type:"text",tabIndex:"0",disabled:false,readOnly:false,intermediateChanges:false,attributeMap:dojo.mixin(dojo.clone(dijit._Widget.prototype.attributeMap),{value:"focusNode",disabled:"focusNode",readOnly:"focusNode",id:"focusNode",tabIndex:"focusNode",alt:"focusNode"}),setAttribute:function(_1,_2){
this.inherited(arguments);
switch(_1){
case "disabled":
var _3=this[this.attributeMap["tabIndex"]||"domNode"];
if(_2){
this._hovering=false;
this._active=false;
_3.removeAttribute("tabIndex");
}else{
_3.setAttribute("tabIndex",this.tabIndex);
}
dijit.setWaiState(this[this.attributeMap["disabled"]||"domNode"],"disabled",_2);
this._setStateClass();
}
},setDisabled:function(_4){
dojo.deprecated("setDisabled("+_4+") is deprecated. Use setAttribute('disabled',"+_4+") instead.","","2.0");
this.setAttribute("disabled",_4);
},_onMouse:function(_5){
var _6=_5.currentTarget;
if(_6&&_6.getAttribute){
this.stateModifier=_6.getAttribute("stateModifier")||"";
}
if(!this.disabled){
switch(_5.type){
case "mouseenter":
case "mouseover":
this._hovering=true;
this._active=this._mouseDown;
break;
case "mouseout":
case "mouseleave":
this._hovering=false;
this._active=false;
break;
case "mousedown":
this._active=true;
this._mouseDown=true;
var _7=this.connect(dojo.body(),"onmouseup",function(){
this._active=false;
this._mouseDown=false;
this._setStateClass();
this.disconnect(_7);
});
if(this.isFocusable()){
this.focus();
}
break;
}
this._setStateClass();
}
},isFocusable:function(){
return !this.disabled&&!this.readOnly&&this.focusNode&&(dojo.style(this.domNode,"display")!="none");
},focus:function(){
setTimeout(dojo.hitch(this,dijit.focus,this.focusNode),0);
},_setStateClass:function(){
if(!("staticClass" in this)){
this.staticClass=(this.stateNode||this.domNode).className;
}
var _8=[this.baseClass];
function multiply(_9){
_8=_8.concat(dojo.map(_8,function(c){
return c+_9;
}),"dijit"+_9);
};
if(this.checked){
multiply("Checked");
}
if(this.state){
multiply(this.state);
}
if(this.selected){
multiply("Selected");
}
if(this.disabled){
multiply("Disabled");
}else{
if(this.readOnly){
multiply("ReadOnly");
}else{
if(this._active){
multiply(this.stateModifier+"Active");
}else{
if(this._focused){
multiply("Focused");
}
if(this._hovering){
multiply(this.stateModifier+"Hover");
}
}
}
}
(this.stateNode||this.domNode).className=this.staticClass+" "+_8.join(" ");
},onChange:function(_b){
},_onChangeMonitor:"value",_onChangeActive:false,_handleOnChange:function(_c,_d){
this._lastValue=_c;
if(this._lastValueReported==undefined&&(_d===null||!this._onChangeActive)){
this._resetValue=this._lastValueReported=_c;
}
if((this.intermediateChanges||_d||_d===undefined)&&((_c&&_c.toString)?_c.toString():_c)!==((this._lastValueReported&&this._lastValueReported.toString)?this._lastValueReported.toString():this._lastValueReported)){
this._lastValueReported=_c;
if(this._onChangeActive){
this.onChange(_c);
}
}
},reset:function(){
this._hasBeenBlurred=false;
if(this.setValue&&!this._getValueDeprecated){
this.setValue(this._resetValue,true);
}else{
if(this._onChangeMonitor){
this.setAttribute(this._onChangeMonitor,(this._resetValue!==undefined&&this._resetValue!==null)?this._resetValue:"");
}
}
},create:function(){
this.inherited(arguments);
this._onChangeActive=true;
this._setStateClass();
},destroy:function(){
if(this._layoutHackHandle){
clearTimeout(this._layoutHackHandle);
}
this.inherited(arguments);
},setValue:function(_e){
dojo.deprecated("dijit.form._FormWidget:setValue("+_e+") is deprecated.  Use setAttribute('value',"+_e+") instead.","","2.0");
this.setAttribute("value",_e);
},_getValueDeprecated:true,getValue:function(){
dojo.deprecated("dijit.form._FormWidget:getValue() is deprecated.  Use widget.value instead.","","2.0");
return this.value;
},_layoutHack:function(){
if(dojo.isFF==2){
var _f=this.domNode;
var old=_f.style.opacity;
_f.style.opacity="0.999";
this._layoutHackHandle=setTimeout(dojo.hitch(this,function(){
this._layoutHackHandle=null;
_f.style.opacity=old;
}),0);
}
}});
dojo.declare("dijit.form._FormValueWidget",dijit.form._FormWidget,{attributeMap:dojo.mixin(dojo.clone(dijit.form._FormWidget.prototype.attributeMap),{value:""}),postCreate:function(){
this.setValue(this.value,null);
},setValue:function(_11,_12){
this.value=_11;
this._handleOnChange(_11,_12);
},_getValueDeprecated:false,getValue:function(){
return this._lastValue;
},undo:function(){
this.setValue(this._lastValueReported,false);
},_valueChanged:function(){
var v=this.getValue();
var lv=this._lastValueReported;
return ((v!==null&&(v!==undefined)&&v.toString)?v.toString():"")!==((lv!==null&&(lv!==undefined)&&lv.toString)?lv.toString():"");
},_onKeyPress:function(e){
if(e.keyCode==dojo.keys.ESCAPE&&!e.shiftKey&&!e.ctrlKey&&!e.altKey){
if(this._valueChanged()){
this.undo();
dojo.stopEvent(e);
return false;
}
}
return true;
}});
}
