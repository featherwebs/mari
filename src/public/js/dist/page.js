!function(e){var t={};function n(i){if(t[i])return t[i].exports;var r=t[i]={i:i,l:!1,exports:{}};return e[i].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=e,n.c=t,n.d=function(e,t,i){n.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:i})},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=12)}([function(e,t){e.exports=function(e,t,n,i,r,a){var s,o=e=e||{},u=typeof e.default;"object"!==u&&"function"!==u||(s=e,o=e.default);var l,d="function"==typeof o?o.options:o;if(t&&(d.render=t.render,d.staticRenderFns=t.staticRenderFns,d._compiled=!0),n&&(d.functional=!0),r&&(d._scopeId=r),a?(l=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),i&&i.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(a)},d._ssrRegister=l):i&&(l=i),l){var c=d.functional,p=c?d.render:d.beforeCreate;c?(d._injectStyles=l,d.render=function(e,t){return l.call(t),p(e,t)}):d.beforeCreate=p?[].concat(p,l):[l]}return{esModule:s,exports:o,options:d}}},function(e,t,n){var i=n(0)(n(2),n(3),!1,null,null,null);e.exports=i.exports},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var i="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e};t.default={props:["name","value","type","hidevalue"],data:function(){return{id:Math.random().toString(36).substring(8),def:"http://via.placeholder.com/250x250?text=x",img:""}},mounted:function(){"string"==typeof this.value?this.img=this.value:this.value&&"object"==i(this.value)&&this.value.path?this.img=this.value.url:"file"!=this.type&&(this.img=this.def),$("#btn-"+this.id).filemanager("image"),$("#btn-file-"+this.id).filemanager("file"),$("#holder-wrapper-"+this.id).filemanager("image"),$("#holder-file-wrapper-"+this.id).filemanager("file")},methods:{}}},function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",["file"==e.type?n("div",{staticClass:"thumbnail",attrs:{id:"holder-file-wrapper-"+e.id,"data-input":"thumbnail-"+e.id,"data-preview":"holder-"+e.id}},["file"==e.type?n("i",{staticClass:"fa fa-file-o fa-5x",attrs:{id:"holder-file-"+e.id}}):e._e()]):n("div",{staticClass:"thumbnail",attrs:{id:"holder-wrapper-"+e.id,"data-input":"thumbnail-"+e.id,"data-preview":"holder-"+e.id}},[n("img",{attrs:{id:"holder-"+e.id,src:e.img}})]),e._v(" "),n("div",{staticClass:"input-group"},[n("div",{staticClass:"input-group-btn"},["file"==e.type?n("a",{staticClass:"btn btn-primary",attrs:{id:"btn-file-"+e.id,"data-input":"thumbnail-"+e.id,"data-preview":"holder-"+e.id}},[n("i",{staticClass:"fa fa-file-o"}),e._v(" Choose\n\t\t\t")]):n("a",{staticClass:"btn btn-primary",attrs:{id:"btn-"+e.id,"data-input":"thumbnail-"+e.id,"data-preview":"holder-"+e.id}},[n("i",{staticClass:"fa fa-picture-o"}),e._v(" Choose\n\t\t\t")])]),e._v(" "),n("input",{staticClass:"form-control",attrs:{id:"thumbnail-"+e.id,type:!1===e.hidevalue?"text":"hidden",name:e.name},domProps:{value:e.img}})])])},staticRenderFns:[]}},function(e,t){e.exports=function(e){var t=[];return t.toString=function(){return this.map(function(t){var n=function(e,t){var n=e[1]||"",i=e[3];if(!i)return n;if(t&&"function"==typeof btoa){var r=(s=i,"/*# sourceMappingURL=data:application/json;charset=utf-8;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(s))))+" */"),a=i.sources.map(function(e){return"/*# sourceURL="+i.sourceRoot+e+" */"});return[n].concat(a).concat([r]).join("\n")}var s;return[n].join("\n")}(t,e);return t[2]?"@media "+t[2]+"{"+n+"}":n}).join("")},t.i=function(e,n){"string"==typeof e&&(e=[[null,e,""]]);for(var i={},r=0;r<this.length;r++){var a=this[r][0];"number"==typeof a&&(i[a]=!0)}for(r=0;r<e.length;r++){var s=e[r];"number"==typeof s[0]&&i[s[0]]||(n&&!s[2]?s[2]=n:n&&(s[2]="("+s[2]+") and ("+n+")"),t.push(s))}},t}},function(e,t,n){var i="undefined"!=typeof document;if("undefined"!=typeof DEBUG&&DEBUG&&!i)throw new Error("vue-style-loader cannot be used in a non-browser environment. Use { target: 'node' } in your Webpack config to indicate a server-rendering environment.");var r=n(9),a={},s=i&&(document.head||document.getElementsByTagName("head")[0]),o=null,u=0,l=!1,d=function(){},c=null,p="data-vue-ssr-id",f="undefined"!=typeof navigator&&/msie [6-9]\b/.test(navigator.userAgent.toLowerCase());function h(e){for(var t=0;t<e.length;t++){var n=e[t],i=a[n.id];if(i){i.refs++;for(var r=0;r<i.parts.length;r++)i.parts[r](n.parts[r]);for(;r<n.parts.length;r++)i.parts.push(g(n.parts[r]));i.parts.length>n.parts.length&&(i.parts.length=n.parts.length)}else{var s=[];for(r=0;r<n.parts.length;r++)s.push(g(n.parts[r]));a[n.id]={id:n.id,refs:1,parts:s}}}}function m(){var e=document.createElement("style");return e.type="text/css",s.appendChild(e),e}function g(e){var t,n,i=document.querySelector("style["+p+'~="'+e.id+'"]');if(i){if(l)return d;i.parentNode.removeChild(i)}if(f){var r=u++;i=o||(o=m()),t=b.bind(null,i,r,!1),n=b.bind(null,i,r,!0)}else i=m(),t=function(e,t){var n=t.css,i=t.media,r=t.sourceMap;i&&e.setAttribute("media",i);c.ssrId&&e.setAttribute(p,t.id);r&&(n+="\n/*# sourceURL="+r.sources[0]+" */",n+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(r))))+" */");if(e.styleSheet)e.styleSheet.cssText=n;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(n))}}.bind(null,i),n=function(){i.parentNode.removeChild(i)};return t(e),function(i){if(i){if(i.css===e.css&&i.media===e.media&&i.sourceMap===e.sourceMap)return;t(e=i)}else n()}}e.exports=function(e,t,n,i){l=n,c=i||{};var s=r(e,t);return h(s),function(t){for(var n=[],i=0;i<s.length;i++){var o=s[i];(u=a[o.id]).refs--,n.push(u)}t?h(s=r(e,t)):s=[];for(i=0;i<n.length;i++){var u;if(0===(u=n[i]).refs){for(var l=0;l<u.parts.length;l++)u.parts[l]();delete a[u.id]}}}};var v,y=(v=[],function(e,t){return v[e]=t,v.filter(Boolean).join("\n")});function b(e,t,n,i){var r=n?"":i.css;if(e.styleSheet)e.styleSheet.cssText=y(t,r);else{var a=document.createTextNode(r),s=e.childNodes;s[t]&&e.removeChild(s[t]),s.length?e.insertBefore(a,s[t]):e.appendChild(a)}}},function(e,t,n){var i=n(0)(n(10),n(11),!1,function(e){n(7)},null,null);e.exports=i.exports},function(e,t,n){var i=n(8);"string"==typeof i&&(i=[[e.i,i,""]]),i.locals&&(e.exports=i.locals);n(5)("ef984dbe",i,!0,{})},function(e,t,n){(e.exports=n(4)(!1)).push([e.i,'.ckeditor:after{content:"";display:table;clear:both}',""])},function(e,t){e.exports=function(e,t){for(var n=[],i={},r=0;r<t.length;r++){var a=t[r],s=a[0],o={id:e+":"+r,css:a[1],media:a[2],sourceMap:a[3]};i[s]?i[s].parts.push(o):n.push(i[s]={id:s,parts:[o]})}return n}},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var i=(new Date).getTime();t.default={name:"vue-ckeditor",props:{name:{type:String,default:function(){return"editor-"+ ++i}},value:{type:String},id:{type:String,default:function(){return"editor-"+i}},types:{type:String,default:function(){return"classic"}},config:{type:Object,default:function(){}}},data:function(){return{destroyed:!1}},computed:{instance:function(){return CKEDITOR.instances[this.id]}},watch:{value:function(e){this.instance&&this.update(e)}},mounted:function(){this.create()},beforeDestroy:function(){this.destroy()},methods:{create:function(){"undefined"==typeof CKEDITOR?console.log("CKEDITOR is missing (http://ckeditor.com/)"):("inline"===this.types?CKEDITOR.inline(this.id,this.config):CKEDITOR.replace(this.id,this.config),this.instance.setData(this.value),this.instance.on("change",this.onChange),this.instance.on("blur",this.onBlur),this.instance.on("focus",this.onFocus))},update:function(e){this.instance.getData()!==e&&this.instance.setData(e)},destroy:function(){this.destroyed||(this.instance.focusManager.blur(!0),this.instance.removeAllListeners(),this.instance.destroy(),this.destroyed=!0)},onChange:function(){var e=this.instance.getData();e!==this.value&&this.$emit("input",e)},onBlur:function(){this.$emit("blur",this.instance)},onFocus:function(){this.$emit("focus",this.instance)}}}},function(e,t){e.exports={render:function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticClass:"ckeditor"},[t("textarea",{attrs:{name:this.name,id:this.id,types:this.types,config:this.config},domProps:{value:this.value}})])},staticRenderFns:[]}},function(e,t,n){e.exports=n(13)},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var i=n(6),r=n.n(i),a=n(1),s=n.n(a),o={title:"",sub_title:"",slug:"",content:"",meta_title:"",meta_description:"",meta_keywords:"",page_id:"",is_published:!1,view:"default",images:[],formatted:!1,custom:[]},u="undefined"==typeof page;new Vue({el:"#page-app",data:{pages:"undefined"==typeof pages?[]:pages,templates:"undefined"==typeof templates?[]:templates,page:u?o:Object.assign({},o,page),new_image:{pivot:{slug:""},title:"",thumbnail:""},new_custom:{slug:"",value:""},deleted_image_ids:[],editor:{mini:{toolbarGroups:[{name:"basicstyles",groups:["basicstyles"]},{name:"links",groups:["links"]},{name:"paragraph",groups:["list","blocks"]},{name:"document",groups:["mode"]},{name:"insert",groups:["insert"]},{name:"styles",groups:["styles"]},{name:"about",groups:["about"]}],allowedContent:!0,removeButtons:"Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar",height:250,extraPlugins:"divarea,oembed,image2",filebrowserImageBrowseUrl:"/mari-filemanager?type=Images",filebrowserImageUploadUrl:"/mari-filemanager/upload?type=Images&_token=",filebrowserBrowseUrl:"/mari-filemanager?type=Files",filebrowserUploadUrl:"/mari-filemanager/upload?type=Files&_token="},full:{allowedContent:!0,height:500,extraPlugins:"divarea,oembed,image2,justify,templates",filebrowserImageBrowseUrl:"/mari-filemanager?type=Images",filebrowserImageUploadUrl:"/mari-filemanager/upload?type=Images&_token=",filebrowserBrowseUrl:"/mari-filemanager?type=Files",filebrowserUploadUrl:"/mari-filemanager/upload?type=Files&_token="}}},mounted:function(){},watch:{"page.title":function(e){u&&(this.page.slug=this.slugify(e))},"page.slug":function(e){this.page.slug=this.slugify(e)}},methods:{addCustomField:function(){this.page.custom.push(Object.assign({},this.new_custom))},addImageField:function(){this.page.images.push(Object.assign({},this.new_image))},removeImage:function(e){var t=this.page.images[e];t&&t.id&&this.deleted_image_ids.push(t.id),this.page.images.splice(e,1)},removeCustomField:function(e){this.page.custom.splice(e,1)},slugify:function(e){return e.toString().toLowerCase().replace(/\s+/g,"-").replace(/&/g,"").replace(/[^\w\-]+/g,"").replace(/\-\-+/g,"-").replace(/^-+/,"").replace(/-+$/,"").replace(/-$/,"")}},components:{Ckeditor:r.a,ImageSelector:s.a}})}]);