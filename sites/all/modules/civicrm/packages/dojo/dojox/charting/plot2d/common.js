/*
	Copyright (c) 2004-2008, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/


if(!dojo._hasResource["dojox.charting.plot2d.common"]){
dojo._hasResource["dojox.charting.plot2d.common"]=true;
dojo.provide("dojox.charting.plot2d.common");
dojo.require("dojo.colors");
dojo.require("dojox.gfx");
dojo.require("dojox.lang.functional");
(function(){
var df=dojox.lang.functional,dc=dojox.charting.plot2d.common;
dojo.mixin(dojox.charting.plot2d.common,{makeStroke:function(_3){
if(!_3){
return _3;
}
if(typeof _3=="string"||_3 instanceof dojo.Color){
_3={color:_3};
}
return dojox.gfx.makeParameters(dojox.gfx.defaultStroke,_3);
},augmentColor:function(_4,_5){
var t=new dojo.Color(_4),c=new dojo.Color(_5);
c.a=t.a;
return c;
},augmentStroke:function(_8,_9){
var s=dc.makeStroke(_8);
if(s){
s.color=dc.augmentColor(s.color,_9);
}
return s;
},augmentFill:function(_b,_c){
var fc,c=new dojo.Color(_c);
if(typeof _b=="string"||_b instanceof dojo.Color){
return dc.augmentColor(_b,_c);
}
return _b;
},defaultStats:{hmin:Number.POSITIVE_INFINITY,hmax:Number.NEGATIVE_INFINITY,vmin:Number.POSITIVE_INFINITY,vmax:Number.NEGATIVE_INFINITY},collectSimpleStats:function(_f){
var _10=dojo.clone(dc.defaultStats);
for(var i=0;i<_f.length;++i){
var run=_f[i];
if(!run.data.length){
continue;
}
if(typeof run.data[0]=="number"){
var _13=_10.vmin,_14=_10.vmax;
if(!("ymin" in run)||!("ymax" in run)){
dojo.forEach(run.data,function(val,i){
var x=i+1,y=val;
if(isNaN(y)){
y=0;
}
_10.hmin=Math.min(_10.hmin,x);
_10.hmax=Math.max(_10.hmax,x);
_10.vmin=Math.min(_10.vmin,y);
_10.vmax=Math.max(_10.vmax,y);
});
}
if("ymin" in run){
_10.vmin=Math.min(_13,run.ymin);
}
if("ymax" in run){
_10.vmax=Math.max(_14,run.ymax);
}
}else{
var _19=_10.hmin,_1a=_10.hmax,_13=_10.vmin,_14=_10.vmax;
if(!("xmin" in run)||!("xmax" in run)||!("ymin" in run)||!("ymax" in run)){
dojo.forEach(run.data,function(val,i){
var x=val.x,y=val.y;
if(isNaN(x)){
x=0;
}
if(isNaN(y)){
y=0;
}
_10.hmin=Math.min(_10.hmin,x);
_10.hmax=Math.max(_10.hmax,x);
_10.vmin=Math.min(_10.vmin,y);
_10.vmax=Math.max(_10.vmax,y);
});
}
if("xmin" in run){
_10.hmin=Math.min(_19,run.xmin);
}
if("xmax" in run){
_10.hmax=Math.max(_1a,run.xmax);
}
if("ymin" in run){
_10.vmin=Math.min(_13,run.ymin);
}
if("ymax" in run){
_10.vmax=Math.max(_14,run.ymax);
}
}
}
return _10;
},collectStackedStats:function(_1f){
var _20=dojo.clone(dc.defaultStats);
if(_1f.length){
_20.hmin=Math.min(_20.hmin,1);
_20.hmax=df.foldl(_1f,"seed, run -> Math.max(seed, run.data.length)",_20.hmax);
for(var i=0;i<_20.hmax;++i){
var v=_1f[0].data[i];
if(isNaN(v)){
v=0;
}
_20.vmin=Math.min(_20.vmin,v);
for(var j=1;j<_1f.length;++j){
var t=_1f[j].data[i];
if(isNaN(t)){
t=0;
}
v+=t;
}
_20.vmax=Math.max(_20.vmax,v);
}
}
return _20;
}});
})();
}
