!function(t){var e={};function i(n){if(e[n])return e[n].exports;var r=e[n]={i:n,l:!1,exports:{}};return t[n].call(r.exports,r,r.exports,i),r.l=!0,r.exports}i.m=t,i.c=e,i.d=function(t,e,n){i.o(t,e)||Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:n})},i.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return i.d(e,"a",e),e},i.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},i.p="",i(i.s=16)}([function(t,e){t.exports=function(t,e,i,n,r,s){var a,o=t=t||{},l=typeof t.default;"object"!==l&&"function"!==l||(a=t,o=t.default);var u,d="function"==typeof o?o.options:o;if(e&&(d.render=e.render,d.staticRenderFns=e.staticRenderFns,d._compiled=!0),i&&(d.functional=!0),r&&(d._scopeId=r),s?(u=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),n&&n.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(s)},d._ssrRegister=u):n&&(u=n),u){var h=d.functional,f=h?d.render:d.beforeCreate;h?(d._injectStyles=u,d.render=function(t,e){return u.call(e),f(t,e)}):d.beforeCreate=f?[].concat(f,u):[u]}return{esModule:a,exports:o,options:d}}},function(t,e,i){var n=i(0)(i(2),i(3),!1,null,null,null);t.exports=n.exports},function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var n="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t};e.default={props:["name","value","type","hidevalue"],data:function(){return{id:Math.random().toString(36).substring(8),def:"http://via.placeholder.com/250x250?text=x",img:""}},mounted:function(){"string"==typeof this.value?this.img=this.value:this.value&&"object"==n(this.value)&&this.value.path?this.img=this.value.url:"file"!=this.type&&(this.img=this.def),$("#btn-"+this.id).filemanager("image"),$("#btn-file-"+this.id).filemanager("file"),$("#holder-wrapper-"+this.id).filemanager("image"),$("#holder-file-wrapper-"+this.id).filemanager("file")},methods:{}}},function(t,e){t.exports={render:function(){var t=this.$createElement,e=this._self._c||t;return e("div",["file"==this.type?e("div",{staticClass:"thumbnail",attrs:{id:"holder-file-wrapper-"+this.id,"data-input":"thumbnail-"+this.id,"data-preview":"holder-"+this.id}},["file"==this.type?e("i",{staticClass:"fa fa-file-o fa-5x",attrs:{id:"holder-file-"+this.id}}):this._e()]):e("div",{staticClass:"thumbnail",attrs:{id:"holder-wrapper-"+this.id,"data-input":"thumbnail-"+this.id,"data-preview":"holder-"+this.id}},[e("img",{attrs:{id:"holder-"+this.id,src:this.img}})]),this._v(" "),e("div",{staticClass:"input-group"},[e("div",{staticClass:"input-group-btn"},["file"==this.type?e("a",{staticClass:"btn btn-primary",attrs:{id:"btn-file-"+this.id,"data-input":"thumbnail-"+this.id,"data-preview":"holder-"+this.id}},[e("i",{staticClass:"fa fa-file-o"}),this._v(" Choose\n\t\t\t")]):e("a",{staticClass:"btn btn-primary",attrs:{id:"btn-"+this.id,"data-input":"thumbnail-"+this.id,"data-preview":"holder-"+this.id}},[e("i",{staticClass:"fa fa-picture-o"}),this._v(" Choose\n\t\t\t")])]),this._v(" "),e("input",{staticClass:"form-control",attrs:{id:"thumbnail-"+this.id,type:!1===this.hidevalue?"text":"hidden",name:this.name},domProps:{value:this.img}})])])},staticRenderFns:[]}},,,,,,,,,,,,,function(t,e,i){t.exports=i(17)},function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var n=i(1),r=i.n(n),s={name:"",username:"",email:"",is_active:!1,role:null,roles:[],image:{thumbnail:null}};new Vue({el:"#user-app",data:{roles:"undefined"!=typeof rolesArr&&rolesArr,changePassword:!1,user:"undefined"==typeof user?s:Object.assign(s,user)},mounted:function(){this.roles.length&&(this.user.role=this.roles.find(function(t){return t.id==user.roles[0].id}).id)},watch:{"user.username":function(t){this.user.username=t.replace(/[^a-zA-Z0-9]/g,"")}},methods:{},components:{ImageSelector:r.a}})}]);