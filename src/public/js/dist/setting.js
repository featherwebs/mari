!function(t){var e={};function i(n){if(e[n])return e[n].exports;var r=e[n]={i:n,l:!1,exports:{}};return t[n].call(r.exports,r,r.exports,i),r.l=!0,r.exports}i.m=t,i.c=e,i.d=function(t,e,n){i.o(t,e)||Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:n})},i.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return i.d(e,"a",e),e},i.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},i.p="",i(i.s=29)}({0:function(t,e){t.exports=function(t,e,i,n,r,a){var o,s=t=t||{},l=typeof t.default;"object"!==l&&"function"!==l||(o=t,s=t.default);var d,u="function"==typeof s?s.options:s;if(e&&(u.render=e.render,u.staticRenderFns=e.staticRenderFns,u._compiled=!0),i&&(u.functional=!0),r&&(u._scopeId=r),a?(d=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),n&&n.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(a)},u._ssrRegister=d):n&&(d=n),d){var f=u.functional,p=f?u.render:u.beforeCreate;f?(u._injectStyles=d,u.render=function(t,e){return d.call(e),p(t,e)}):u.beforeCreate=p?[].concat(p,d):[d]}return{esModule:o,exports:s,options:u}}},1:function(t,e,i){var n=i(0)(i(2),i(3),!1,null,null,null);t.exports=n.exports},2:function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var n="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t};e.default={props:["name","value","type","hidevalue"],data:function(){return{id:Math.random().toString(36).substring(8),def:"http://via.placeholder.com/250x250?text=x",img:""}},mounted:function(){"string"==typeof this.value?this.img=this.value:this.value&&"object"==n(this.value)&&this.value.path?this.img=this.value.url:"file"!=this.type&&(this.img=this.def),$("#btn-"+this.id).filemanager("image"),$("#btn-file-"+this.id).filemanager("file"),$("#holder-wrapper-"+this.id).filemanager("image"),$("#holder-file-wrapper-"+this.id).filemanager("file")},methods:{}}},29:function(t,e,i){t.exports=i(30)},3:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",["file"==t.type?i("div",{staticClass:"thumbnail",attrs:{id:"holder-file-wrapper-"+t.id,"data-input":"thumbnail-"+t.id,"data-preview":"holder-"+t.id}},["file"==t.type?i("i",{staticClass:"fa fa-file-o fa-5x",attrs:{id:"holder-file-"+t.id}}):t._e()]):i("div",{staticClass:"thumbnail",attrs:{id:"holder-wrapper-"+t.id,"data-input":"thumbnail-"+t.id,"data-preview":"holder-"+t.id}},[i("img",{attrs:{id:"holder-"+t.id,src:t.img}})]),t._v(" "),i("div",{staticClass:"input-group"},[i("div",{staticClass:"input-group-btn"},["file"==t.type?i("a",{staticClass:"btn btn-primary",attrs:{id:"btn-file-"+t.id,"data-input":"thumbnail-"+t.id,"data-preview":"holder-"+t.id}},[i("i",{staticClass:"fa fa-file-o"}),t._v(" Choose\n\t\t\t")]):i("a",{staticClass:"btn btn-primary",attrs:{id:"btn-"+t.id,"data-input":"thumbnail-"+t.id,"data-preview":"holder-"+t.id}},[i("i",{staticClass:"fa fa-picture-o"}),t._v(" Choose\n\t\t\t")])]),t._v(" "),i("input",{staticClass:"form-control",attrs:{id:"thumbnail-"+t.id,type:!1===t.hidevalue?"text":"hidden",name:t.name},domProps:{value:t.img}})])])},staticRenderFns:[]}},30:function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var n=i(1),r=i.n(n);new Vue({el:"#setting-app",data:{logo:null},components:{ImageSelector:r.a}})}});