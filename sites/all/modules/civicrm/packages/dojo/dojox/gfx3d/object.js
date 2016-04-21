/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.gfx3d.object"]){
dojo._hasResource["dojox.gfx3d.object"]=true;
dojo.provide("dojox.gfx3d.object");
dojo.require("dojox.gfx");
dojo.require("dojox.gfx3d.lighting");
dojo.require("dojox.gfx3d.scheduler");
dojo.require("dojox.gfx3d.vector");
dojo.require("dojox.gfx3d.gradient");
var out=function(o,x){
if(arguments.length>1){
o=x;
}
var e={};
for(var i in o){
if(i in e){
continue;
}
}
};
dojo.declare("dojox.gfx3d.Object",null,{constructor:function(){
this.object=null;
this.matrix=null;
this.cache=null;
this.renderer=null;
this.parent=null;
this.strokeStyle=null;
this.fillStyle=null;
this.shape=null;
},setObject:function(_5){
this.object=dojox.gfx.makeParameters(this.object,_5);
return this;
},setTransform:function(_6){
this.matrix=dojox.gfx3d.matrix.clone(_6?dojox.gfx3d.matrix.normalize(_6):dojox.gfx3d.identity,true);
return this;
},applyRightTransform:function(_7){
return _7?this.setTransform([this.matrix,_7]):this;
},applyLeftTransform:function(_8){
return _8?this.setTransform([_8,this.matrix]):this;
},applyTransform:function(_9){
return _9?this.setTransform([this.matrix,_9]):this;
},setFill:function(_a){
this.fillStyle=_a;
return this;
},setStroke:function(_b){
this.strokeStyle=_b;
return this;
},toStdFill:function(_c,_d){
return (this.fillStyle&&typeof this.fillStyle["type"]!="undefined")?_c[this.fillStyle.type](_d,this.fillStyle.finish,this.fillStyle.color):this.fillStyle;
},invalidate:function(){
this.renderer.addTodo(this);
},destroy:function(){
if(this.shape){
var p=this.shape.getParent();
if(p){
p.remove(this.shape);
}
this.shape=null;
}
},render:function(_f){
throw "Pure virtual function, not implemented";
},draw:function(_10){
throw "Pure virtual function, not implemented";
},getZOrder:function(){
return 0;
},getOutline:function(){
return null;
}});
dojo.declare("dojox.gfx3d.Scene",dojox.gfx3d.Object,{constructor:function(){
this.objects=[];
this.todos=[];
this.schedule=dojox.gfx3d.scheduler.zOrder;
this._draw=dojox.gfx3d.drawer.conservative;
},setFill:function(_11){
this.fillStyle=_11;
dojo.forEach(this.objects,function(_12){
_12.setFill(_11);
});
return this;
},setStroke:function(_13){
this.strokeStyle=_13;
dojo.forEach(this.objects,function(_14){
_14.setStroke(_13);
});
return this;
},render:function(_15,_16){
var m=dojox.gfx3d.matrix.multiply(_15,this.matrix);
if(_16){
this.todos=this.objects;
}
dojo.forEach(this.todos,function(_18){
_18.render(m,_16);
});
},draw:function(_19){
this.objects=this.schedule(this.objects);
this._draw(this.todos,this.objects,this.renderer);
},addTodo:function(_1a){
if(dojo.every(this.todos,function(_1b){
return _1b!=_1a;
})){
this.todos.push(_1a);
this.invalidate();
}
},invalidate:function(){
this.parent.addTodo(this);
},getZOrder:function(){
var _1c=0;
dojo.forEach(this.objects,function(_1d){
_1c+=_1d.getZOrder();
});
return (this.objects.length>1)?_1c/this.objects.length:0;
}});
dojo.declare("dojox.gfx3d.Edges",dojox.gfx3d.Object,{constructor:function(){
this.object=dojo.clone(dojox.gfx3d.defaultEdges);
},setObject:function(_1e,_1f){
this.object=dojox.gfx.makeParameters(this.object,(_1e instanceof Array)?{points:_1e,style:_1f}:_1e);
return this;
},getZOrder:function(){
var _20=0;
dojo.forEach(this.cache,function(_21){
_20+=_21.z;
});
return (this.cache.length>1)?_20/this.cache.length:0;
},render:function(_22){
var m=dojox.gfx3d.matrix.multiply(_22,this.matrix);
this.cache=dojo.map(this.object.points,function(_24){
return dojox.gfx3d.matrix.multiplyPoint(m,_24);
});
},draw:function(){
var c=this.cache;
if(this.shape){
this.shape.setShape("");
}else{
this.shape=this.renderer.createPath();
}
var p=this.shape.setAbsoluteMode("absolute");
if(this.object.style=="strip"||this.object.style=="loop"){
p.moveTo(c[0].x,c[0].y);
dojo.forEach(c.slice(1),function(_27){
p.lineTo(_27.x,_27.y);
});
if(this.object.style=="loop"){
p.closePath();
}
}else{
for(var i=0;i<this.cache.length;){
p.moveTo(c[i].x,c[i].y);
i++;
p.lineTo(c[i].x,c[i].y);
i++;
}
}
p.setStroke(this.strokeStyle);
}});
dojo.declare("dojox.gfx3d.Orbit",dojox.gfx3d.Object,{constructor:function(){
this.object=dojo.clone(dojox.gfx3d.defaultOrbit);
},render:function(_29){
var m=dojox.gfx3d.matrix.multiply(_29,this.matrix);
var _2b=[0,Math.PI/4,Math.PI/3];
var _2c=dojox.gfx3d.matrix.multiplyPoint(m,this.object.center);
var _2d=dojo.map(_2b,function(_2e){
return {x:this.center.x+this.radius*Math.cos(_2e),y:this.center.y+this.radius*Math.sin(_2e),z:this.center.z};
},this.object);
_2d=dojo.map(_2d,function(_2f){
return dojox.gfx3d.matrix.multiplyPoint(m,_2f);
});
var _30=dojox.gfx3d.vector.normalize(_2d);
_2d=dojo.map(_2d,function(_31){
return dojox.gfx3d.vector.substract(_31,_2c);
});
var A={xx:_2d[0].x*_2d[0].y,xy:_2d[0].y*_2d[0].y,xz:1,yx:_2d[1].x*_2d[1].y,yy:_2d[1].y*_2d[1].y,yz:1,zx:_2d[2].x*_2d[2].y,zy:_2d[2].y*_2d[2].y,zz:1,dx:0,dy:0,dz:0};
var b=dojo.map(_2d,function(_34){
return -Math.pow(_34.x,2);
});
var X=dojox.gfx3d.matrix.multiplyPoint(dojox.gfx3d.matrix.invert(A),b[0],b[1],b[2]);
var _36=Math.atan2(X.x,1-X.y)/2;
var _37=dojo.map(_2d,function(_38){
return dojox.gfx.matrix.multiplyPoint(dojox.gfx.matrix.rotate(-_36),_38.x,_38.y);
});
var a=Math.pow(_37[0].x,2);
var b=Math.pow(_37[0].y,2);
var c=Math.pow(_37[1].x,2);
var d=Math.pow(_37[1].y,2);
var rx=Math.sqrt((a*d-b*c)/(d-b));
var ry=Math.sqrt((a*d-b*c)/(a-c));
this.cache={cx:_2c.x,cy:_2c.y,rx:rx,ry:ry,theta:_36,normal:_30};
},draw:function(_3e){
if(this.shape){
this.shape.setShape(this.cache);
}else{
this.shape=this.renderer.createEllipse(this.cache);
}
this.shape.applyTransform(dojox.gfx.matrix.rotateAt(this.cache.theta,this.cache.cx,this.cache.cy)).setStroke(this.strokeStyle).setFill(this.toStdFill(_3e,this.cache.normal));
}});
dojo.declare("dojox.gfx3d.Path3d",dojox.gfx3d.Object,{constructor:function(){
this.object=dojo.clone(dojox.gfx3d.defaultPath3d);
this.segments=[];
this.absolute=true;
this.last={};
this.path="";
},_collectArgs:function(_3f,_40){
for(var i=0;i<_40.length;++i){
var t=_40[i];
if(typeof (t)=="boolean"){
_3f.push(t?1:0);
}else{
if(typeof (t)=="number"){
_3f.push(t);
}else{
if(t instanceof Array){
this._collectArgs(_3f,t);
}else{
if("x" in t&&"y" in t){
_3f.push(t.x);
_3f.push(t.y);
}
}
}
}
}
},_validSegments:{m:3,l:3,z:0},_pushSegment:function(_43,_44){
var _45=this._validSegments[_43.toLowerCase()];
if(typeof (_45)=="number"){
if(_45){
if(_44.length>=_45){
var _46={action:_43,args:_44.slice(0,_44.length-_44.length%_45)};
this.segments.push(_46);
}
}else{
var _46={action:_43,args:[]};
this.segments.push(_46);
}
}
},moveTo:function(){
var _47=[];
this._collectArgs(_47,arguments);
this._pushSegment(this.absolute?"M":"m",_47);
return this;
},lineTo:function(){
var _48=[];
this._collectArgs(_48,arguments);
this._pushSegment(this.absolute?"L":"l",_48);
return this;
},closePath:function(){
this._pushSegment("Z",[]);
return this;
},render:function(_49){
var m=dojox.gfx3d.matrix.multiply(_49,this.matrix);
var _4b="";
var _4c=this._validSegments;
dojo.forEach(this.segments,function(_4d){
_4b+=_4d.action;
for(var i=0;i<_4d.args.length;i+=_4c[_4d.action.toLowerCase()]){
var pt=dojox.gfx3d.matrix.multiplyPoint(m,_4d.args[i],_4d.args[i+1],_4d.args[i+2]);
_4b+=" "+pt.x+" "+pt.y;
}
});
this.cache=_4b;
},_draw:function(){
return this.parent.createPath(this.cache);
}});
dojo.declare("dojox.gfx3d.Triangles",dojox.gfx3d.Object,{constructor:function(){
this.object=dojo.clone(dojox.gfx3d.defaultTriangles);
},setObject:function(_50,_51){
if(_50 instanceof Array){
this.object=dojox.gfx.makeParameters(this.object,{points:_50,style:_51});
}else{
this.object=dojox.gfx.makeParameters(this.object,_50);
}
return this;
},render:function(_52){
var m=dojox.gfx3d.matrix.multiply(_52,this.matrix);
var c=dojo.map(this.object.points,function(_55){
return dojox.gfx3d.matrix.multiplyPoint(m,_55);
});
this.cache=[];
var _56=c.slice(0,2);
var _57=c[0];
if(this.object.style=="strip"){
dojo.forEach(c.slice(2),function(_58){
_56.push(_58);
_56.push(_56[0]);
this.cache.push(_56);
_56=_56.slice(1,3);
},this);
}else{
if(this.object.style=="fan"){
dojo.forEach(c.slice(2),function(_59){
_56.push(_59);
_56.push(_57);
this.cache.push(_56);
_56=[_57,_59];
},this);
}else{
for(var i=0;i<c.length;){
this.cache.push([c[i],c[i+1],c[i+2],c[i]]);
i+=3;
}
}
}
},draw:function(_5b){
this.cache=dojox.gfx3d.scheduler.bsp(this.cache,function(it){
return it;
});
if(this.shape){
this.shape.clear();
}else{
this.shape=this.renderer.createGroup();
}
dojo.forEach(this.cache,function(_5d){
this.shape.createPolyline(_5d).setStroke(this.strokeStyle).setFill(this.toStdFill(_5b,dojox.gfx3d.vector.normalize(_5d)));
},this);
},getZOrder:function(){
var _5e=0;
dojo.forEach(this.cache,function(_5f){
_5e+=(_5f[0].z+_5f[1].z+_5f[2].z)/3;
});
return (this.cache.length>1)?_5e/this.cache.length:0;
}});
dojo.declare("dojox.gfx3d.Quads",dojox.gfx3d.Object,{constructor:function(){
this.object=dojo.clone(dojox.gfx3d.defaultQuads);
},setObject:function(_60,_61){
this.object=dojox.gfx.makeParameters(this.object,(_60 instanceof Array)?{points:_60,style:_61}:_60);
return this;
},render:function(_62){
var m=dojox.gfx3d.matrix.multiply(_62,this.matrix);
var c=dojo.map(this.object.points,function(_65){
return dojox.gfx3d.matrix.multiplyPoint(m,_65);
});
this.cache=[];
if(this.object.style=="strip"){
var _66=c.slice(0,2);
for(var i=2;i<c.length;){
_66=_66.concat([c[i],c[i+1],_66[0]]);
this.cache.push(_66);
_66=_66.slice(2,4);
i+=2;
}
}else{
for(var i=0;i<c.length;){
this.cache.push([c[i],c[i+1],c[i+2],c[i+3],c[i]]);
i+=4;
}
}
},draw:function(_68){
this.cache=dojox.gfx3d.scheduler.bsp(this.cache,function(it){
return it;
});
if(this.shape){
this.shape.clear();
}else{
this.shape=this.renderer.createGroup();
}
for(var x=0;x<this.cache.length;x++){
this.shape.createPolyline(this.cache[x]).setStroke(this.strokeStyle).setFill(this.toStdFill(_68,dojox.gfx3d.vector.normalize(this.cache[x])));
}
},getZOrder:function(){
var _6b=0;
for(var x=0;x<this.cache.length;x++){
var i=this.cache[x];
_6b+=(i[0].z+i[1].z+i[2].z+i[3].z)/4;
}
return (this.cache.length>1)?_6b/this.cache.length:0;
}});
dojo.declare("dojox.gfx3d.Polygon",dojox.gfx3d.Object,{constructor:function(){
this.object=dojo.clone(dojox.gfx3d.defaultPolygon);
},setObject:function(_6e){
this.object=dojox.gfx.makeParameters(this.object,(_6e instanceof Array)?{path:_6e}:_6e);
return this;
},render:function(_6f){
var m=dojox.gfx3d.matrix.multiply(_6f,this.matrix);
this.cache=dojo.map(this.object.path,function(_71){
return dojox.gfx3d.matrix.multiplyPoint(m,_71);
});
this.cache.push(this.cache[0]);
},draw:function(_72){
if(this.shape){
this.shape.setShape({points:this.cache});
}else{
this.shape=this.renderer.createPolyline({points:this.cache});
}
this.shape.setStroke(this.strokeStyle).setFill(this.toStdFill(_72,dojox.gfx3d.matrix.normalize(this.cache)));
},getZOrder:function(){
var _73=0;
for(var x=0;x<this.cache.length;x++){
_73+=this.cache[x].z;
}
return (this.cache.length>1)?_73/this.cache.length:0;
},getOutline:function(){
return this.cache.slice(0,3);
}});
dojo.declare("dojox.gfx3d.Cube",dojox.gfx3d.Object,{constructor:function(){
this.object=dojo.clone(dojox.gfx3d.defaultCube);
this.polygons=[];
},setObject:function(_75){
this.object=dojox.gfx.makeParameters(this.object,_75);
},render:function(_76){
var a=this.object.top;
var g=this.object.bottom;
var b={x:g.x,y:a.y,z:a.z};
var c={x:g.x,y:g.y,z:a.z};
var d={x:a.x,y:g.y,z:a.z};
var e={x:a.x,y:a.y,z:g.z};
var f={x:g.x,y:a.y,z:g.z};
var h={x:a.x,y:g.y,z:g.z};
var _7f=[a,b,c,d,e,f,g,h];
var m=dojox.gfx3d.matrix.multiply(_76,this.matrix);
var p=dojo.map(_7f,function(_82){
return dojox.gfx3d.matrix.multiplyPoint(m,_82);
});
a=p[0];
b=p[1];
c=p[2];
d=p[3];
e=p[4];
f=p[5];
g=p[6];
h=p[7];
this.cache=[[a,b,c,d,a],[e,f,g,h,e],[a,d,h,e,a],[d,c,g,h,d],[c,b,f,g,c],[b,a,e,f,b]];
},draw:function(_83){
this.cache=dojox.gfx3d.scheduler.bsp(this.cache,function(it){
return it;
});
var _85=this.cache.slice(3);
if(this.shape){
this.shape.clear();
}else{
this.shape=this.renderer.createGroup();
}
for(var x=0;x<_85.length;x++){
this.shape.createPolyline(_85[x]).setStroke(this.strokeStyle).setFill(this.toStdFill(_83,dojox.gfx3d.vector.normalize(_85[x])));
}
},getZOrder:function(){
var top=this.cache[0][0];
var _88=this.cache[1][2];
return (top.z+_88.z)/2;
}});
dojo.declare("dojox.gfx3d.Cylinder",dojox.gfx3d.Object,{constructor:function(){
this.object=dojo.clone(dojox.gfx3d.defaultCylinder);
},render:function(_89){
var m=dojox.gfx3d.matrix.multiply(_89,this.matrix);
var _8b=[0,Math.PI/4,Math.PI/3];
var _8c=dojox.gfx3d.matrix.multiplyPoint(m,this.object.center);
var _8d=dojo.map(_8b,function(_8e){
return {x:this.center.x+this.radius*Math.cos(_8e),y:this.center.y+this.radius*Math.sin(_8e),z:this.center.z};
},this.object);
_8d=dojo.map(_8d,function(_8f){
return dojox.gfx3d.vector.substract(dojox.gfx3d.matrix.multiplyPoint(m,_8f),_8c);
});
var A={xx:_8d[0].x*_8d[0].y,xy:_8d[0].y*_8d[0].y,xz:1,yx:_8d[1].x*_8d[1].y,yy:_8d[1].y*_8d[1].y,yz:1,zx:_8d[2].x*_8d[2].y,zy:_8d[2].y*_8d[2].y,zz:1,dx:0,dy:0,dz:0};
var b=dojo.map(_8d,function(_92){
return -Math.pow(_92.x,2);
});
var X=dojox.gfx3d.matrix.multiplyPoint(dojox.gfx3d.matrix.invert(A),b[0],b[1],b[2]);
var _94=Math.atan2(X.x,1-X.y)/2;
var _95=dojo.map(_8d,function(_96){
return dojox.gfx.matrix.multiplyPoint(dojox.gfx.matrix.rotate(-_94),_96.x,_96.y);
});
var a=Math.pow(_95[0].x,2);
var b=Math.pow(_95[0].y,2);
var c=Math.pow(_95[1].x,2);
var d=Math.pow(_95[1].y,2);
var rx=Math.sqrt((a*d-b*c)/(d-b));
var ry=Math.sqrt((a*d-b*c)/(a-c));
if(rx<ry){
var t=rx;
rx=ry;
ry=t;
_94-=Math.PI/2;
}
var top=dojox.gfx3d.matrix.multiplyPoint(m,dojox.gfx3d.vector.sum(this.object.center,{x:0,y:0,z:this.object.height}));
var _9e=this.fillStyle.type=="constant"?this.fillStyle.color:dojox.gfx3d.gradient(this.renderer.lighting,this.fillStyle,this.object.center,this.object.radius,Math.PI,2*Math.PI,m);
if(isNaN(rx)||isNaN(ry)||isNaN(_94)){
rx=this.object.radius,ry=0,_94=0;
}
this.cache={center:_8c,top:top,rx:rx,ry:ry,theta:_94,gradient:_9e};
},draw:function(){
var c=this.cache,v=dojox.gfx3d.vector,m=dojox.gfx.matrix,_a2=[c.center,c.top],_a3=v.substract(c.top,c.center);
if(v.dotProduct(_a3,this.renderer.lighting.incident)>0){
_a2=[c.top,c.center];
_a3=v.substract(c.center,c.top);
}
var _a4=this.renderer.lighting[this.fillStyle.type](_a3,this.fillStyle.finish,this.fillStyle.color),d=Math.sqrt(Math.pow(c.center.x-c.top.x,2)+Math.pow(c.center.y-c.top.y,2));
if(this.shape){
this.shape.clear();
}else{
this.shape=this.renderer.createGroup();
}
this.shape.createPath("").moveTo(0,-c.rx).lineTo(d,-c.rx).lineTo(d,c.rx).lineTo(0,c.rx).arcTo(c.ry,c.rx,0,true,true,0,-c.rx).setFill(c.gradient).setStroke(this.strokeStyle).setTransform([m.translate(_a2[0]),m.rotate(Math.atan2(_a2[1].y-_a2[0].y,_a2[1].x-_a2[0].x))]);
if(c.rx>0&&c.ry>0){
this.shape.createEllipse({cx:_a2[1].x,cy:_a2[1].y,rx:c.rx,ry:c.ry}).setFill(_a4).setStroke(this.strokeStyle).applyTransform(m.rotateAt(c.theta,_a2[1]));
}
}});
dojo.declare("dojox.gfx3d.Viewport",dojox.gfx.Group,{constructor:function(){
this.dimension=null;
this.objects=[];
this.todos=[];
this.renderer=this;
this.schedule=dojox.gfx3d.scheduler.zOrder;
this.draw=dojox.gfx3d.drawer.conservative;
this.deep=false;
this.lights=[];
this.lighting=null;
},setCameraTransform:function(_a6){
this.camera=dojox.gfx3d.matrix.clone(_a6?dojox.gfx3d.matrix.normalize(_a6):dojox.gfx3d.identity,true);
this.invalidate();
return this;
},applyCameraRightTransform:function(_a7){
return _a7?this.setCameraTransform([this.camera,_a7]):this;
},applyCameraLeftTransform:function(_a8){
return _a8?this.setCameraTransform([_a8,this.camera]):this;
},applyCameraTransform:function(_a9){
return this.applyCameraRightTransform(_a9);
},setLights:function(_aa,_ab,_ac){
this.lights=(_aa instanceof Array)?{sources:_aa,ambient:_ab,specular:_ac}:_aa;
var _ad={x:0,y:0,z:1};
this.lighting=new dojox.gfx3d.lighting.Model(_ad,this.lights.sources,this.lights.ambient,this.lights.specular);
this.invalidate();
return this;
},addLights:function(_ae){
return this.setLights(this.lights.sources.concat(_ae));
},addTodo:function(_af){
if(dojo.every(this.todos,function(_b0){
return _b0!=_af;
})){
this.todos.push(_af);
}
},invalidate:function(){
this.deep=true;
this.todos=this.objects;
},setDimensions:function(dim){
if(dim){
this.dimension={width:dojo.isString(dim.width)?parseInt(dim.width):dim.width,height:dojo.isString(dim.height)?parseInt(dim.height):dim.height};
}else{
this.dimension=null;
}
},render:function(){
if(!this.todos.length){
return;
}
var m=dojox.gfx3d.matrix;
for(var x=0;x<this.todos.length;x++){
this.todos[x].render(dojox.gfx3d.matrix.normalize([m.cameraRotateXg(180),m.cameraTranslate(0,this.dimension.height,0),this.camera,]),this.deep);
}
this.objects=this.schedule(this.objects);
this.draw(this.todos,this.objects,this);
this.todos=[];
this.deep=false;
}});
dojox.gfx3d.Viewport.nodeType=dojox.gfx.Group.nodeType;
dojox.gfx3d._creators={createEdges:function(_b4,_b5){
return this.create3DObject(dojox.gfx3d.Edges,_b4,_b5);
},createTriangles:function(_b6,_b7){
return this.create3DObject(dojox.gfx3d.Triangles,_b6,_b7);
},createQuads:function(_b8,_b9){
return this.create3DObject(dojox.gfx3d.Quads,_b8,_b9);
},createPolygon:function(_ba){
return this.create3DObject(dojox.gfx3d.Polygon,_ba);
},createOrbit:function(_bb){
return this.create3DObject(dojox.gfx3d.Orbit,_bb);
},createCube:function(_bc){
return this.create3DObject(dojox.gfx3d.Cube,_bc);
},createCylinder:function(_bd){
return this.create3DObject(dojox.gfx3d.Cylinder,_bd);
},createPath3d:function(_be){
return this.create3DObject(dojox.gfx3d.Path3d,_be);
},createScene:function(){
return this.create3DObject(dojox.gfx3d.Scene);
},create3DObject:function(_bf,_c0,_c1){
var obj=new _bf();
this.adopt(obj);
if(_c0){
obj.setObject(_c0,_c1);
}
return obj;
},adopt:function(obj){
obj.renderer=this.renderer;
obj.parent=this;
this.objects.push(obj);
this.addTodo(obj);
return this;
},abandon:function(obj,_c5){
for(var i=0;i<this.objects.length;++i){
if(this.objects[i]==obj){
this.objects.splice(i,1);
}
}
obj.parent=null;
return this;
},setScheduler:function(_c7){
this.schedule=_c7;
},setDrawer:function(_c8){
this.draw=_c8;
}};
dojo.extend(dojox.gfx3d.Viewport,dojox.gfx3d._creators);
dojo.extend(dojox.gfx3d.Scene,dojox.gfx3d._creators);
delete dojox.gfx3d._creators;
dojo.extend(dojox.gfx.Surface,{createViewport:function(){
var _c9=this.createObject(dojox.gfx3d.Viewport,null,true);
_c9.setDimensions(this.getDimensions());
return _c9;
}});
}
