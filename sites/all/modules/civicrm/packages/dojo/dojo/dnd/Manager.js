/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojo.dnd.Manager"]){
dojo._hasResource["dojo.dnd.Manager"]=true;
dojo.provide("dojo.dnd.Manager");
dojo.require("dojo.dnd.common");
dojo.require("dojo.dnd.autoscroll");
dojo.require("dojo.dnd.Avatar");
dojo.declare("dojo.dnd.Manager",null,{constructor:function(){
this.avatar=null;
this.source=null;
this.nodes=[];
this.copy=true;
this.target=null;
this.canDropFlag=false;
this.events=[];
},OFFSET_X:16,OFFSET_Y:16,overSource:function(_1){
if(this.avatar){
this.target=(_1&&_1.targetState!="Disabled")?_1:null;
this.avatar.update();
}
dojo.publish("/dnd/source/over",[_1]);
},outSource:function(_2){
if(this.avatar){
if(this.target==_2){
this.target=null;
this.canDropFlag=false;
this.avatar.update();
dojo.publish("/dnd/source/over",[null]);
}
}else{
dojo.publish("/dnd/source/over",[null]);
}
},startDrag:function(_3,_4,_5){
this.source=_3;
this.nodes=_4;
this.copy=Boolean(_5);
this.avatar=this.makeAvatar();
dojo.body().appendChild(this.avatar.node);
dojo.publish("/dnd/start",[_3,_4,this.copy]);
this.events=[dojo.connect(dojo.doc,"onmousemove",this,"onMouseMove"),dojo.connect(dojo.doc,"onmouseup",this,"onMouseUp"),dojo.connect(dojo.doc,"onkeydown",this,"onKeyDown"),dojo.connect(dojo.doc,"onkeyup",this,"onKeyUp")];
var c="dojoDnd"+(_5?"Copy":"Move");
dojo.addClass(dojo.body(),c);
},canDrop:function(_7){
var _8=Boolean(this.target&&_7);
if(this.canDropFlag!=_8){
this.canDropFlag=_8;
this.avatar.update();
}
},stopDrag:function(){
dojo.removeClass(dojo.body(),"dojoDndCopy");
dojo.removeClass(dojo.body(),"dojoDndMove");
dojo.forEach(this.events,dojo.disconnect);
this.events=[];
this.avatar.destroy();
this.avatar=null;
this.source=null;
this.nodes=[];
},makeAvatar:function(){
return new dojo.dnd.Avatar(this);
},updateAvatar:function(){
this.avatar.update();
},onMouseMove:function(e){
var a=this.avatar;
if(a){
dojo.dnd.autoScroll(e);
var s=a.node.style;
s.left=(e.pageX+this.OFFSET_X)+"px";
s.top=(e.pageY+this.OFFSET_Y)+"px";
var _c=Boolean(this.source.copyState(dojo.dnd.getCopyKeyState(e)));
if(this.copy!=_c){
this._setCopyStatus(_c);
}
}
},onMouseUp:function(e){
if(this.avatar&&(!("mouseButton" in this.source)||this.source.mouseButton==e.button)){
if(this.target&&this.canDropFlag){
var _e=[this.source,this.nodes,Boolean(this.source.copyState(dojo.dnd.getCopyKeyState(e))),this.target];
dojo.publish("/dnd/drop/before",_e);
dojo.publish("/dnd/drop",_e);
}else{
dojo.publish("/dnd/cancel");
}
this.stopDrag();
}
},onKeyDown:function(e){
if(this.avatar){
switch(e.keyCode){
case dojo.keys.CTRL:
var _10=Boolean(this.source.copyState(true));
if(this.copy!=_10){
this._setCopyStatus(_10);
}
break;
case dojo.keys.ESCAPE:
dojo.publish("/dnd/cancel");
this.stopDrag();
break;
}
}
},onKeyUp:function(e){
if(this.avatar&&e.keyCode==dojo.keys.CTRL){
var _12=Boolean(this.source.copyState(false));
if(this.copy!=_12){
this._setCopyStatus(_12);
}
}
},_setCopyStatus:function(_13){
this.copy=_13;
this.source._markDndStatus(this.copy);
this.updateAvatar();
dojo.removeClass(dojo.body(),"dojoDnd"+(this.copy?"Move":"Copy"));
dojo.addClass(dojo.body(),"dojoDnd"+(this.copy?"Copy":"Move"));
}});
dojo.dnd._manager=null;
dojo.dnd.manager=function(){
if(!dojo.dnd._manager){
dojo.dnd._manager=new dojo.dnd.Manager();
}
return dojo.dnd._manager;
};
}
