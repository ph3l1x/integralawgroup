/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dijit._base.typematic"]){
dojo._hasResource["dijit._base.typematic"]=true;
dojo.provide("dijit._base.typematic");
dijit.typematic={_fireEventAndReload:function(){
this._timer=null;
this._callback(++this._count,this._node,this._evt);
this._currentTimeout=(this._currentTimeout<0)?this._initialDelay:((this._subsequentDelay>1)?this._subsequentDelay:Math.round(this._currentTimeout*this._subsequentDelay));
this._timer=setTimeout(dojo.hitch(this,"_fireEventAndReload"),this._currentTimeout);
},trigger:function(_1,_2,_3,_4,_5,_6,_7){
if(_5!=this._obj){
this.stop();
this._initialDelay=_7||500;
this._subsequentDelay=_6||0.9;
this._obj=_5;
this._evt=_1;
this._node=_3;
this._currentTimeout=-1;
this._count=-1;
this._callback=dojo.hitch(_2,_4);
this._fireEventAndReload();
}
},stop:function(){
if(this._timer){
clearTimeout(this._timer);
this._timer=null;
}
if(this._obj){
this._callback(-1,this._node,this._evt);
this._obj=null;
}
},addKeyListener:function(_8,_9,_a,_b,_c,_d){
return [dojo.connect(_8,"onkeypress",this,function(_e){
if(_e.keyCode==_9.keyCode&&(!_9.charCode||_9.charCode==_e.charCode)&&(_9.ctrlKey===undefined||_9.ctrlKey==_e.ctrlKey)&&(_9.altKey===undefined||_9.altKey==_e.ctrlKey)&&(_9.shiftKey===undefined||_9.shiftKey==_e.ctrlKey)){
dojo.stopEvent(_e);
dijit.typematic.trigger(_9,_a,_8,_b,_9,_c,_d);
}else{
if(dijit.typematic._obj==_9){
dijit.typematic.stop();
}
}
}),dojo.connect(_8,"onkeyup",this,function(_f){
if(dijit.typematic._obj==_9){
dijit.typematic.stop();
}
})];
},addMouseListener:function(_10,_11,_12,_13,_14){
var dc=dojo.connect;
return [dc(_10,"mousedown",this,function(evt){
dojo.stopEvent(evt);
dijit.typematic.trigger(evt,_11,_10,_12,_10,_13,_14);
}),dc(_10,"mouseup",this,function(evt){
dojo.stopEvent(evt);
dijit.typematic.stop();
}),dc(_10,"mouseout",this,function(evt){
dojo.stopEvent(evt);
dijit.typematic.stop();
}),dc(_10,"mousemove",this,function(evt){
dojo.stopEvent(evt);
}),dc(_10,"dblclick",this,function(evt){
dojo.stopEvent(evt);
if(dojo.isIE){
dijit.typematic.trigger(evt,_11,_10,_12,_10,_13,_14);
setTimeout(dojo.hitch(this,dijit.typematic.stop),50);
}
})];
},addListener:function(_1b,_1c,_1d,_1e,_1f,_20,_21){
return this.addKeyListener(_1c,_1d,_1e,_1f,_20,_21).concat(this.addMouseListener(_1b,_1e,_1f,_20,_21));
}};
}
