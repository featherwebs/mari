!function(e){var t={};function n(i){if(t[i])return t[i].exports;var a=t[i]={i:i,l:!1,exports:{}};return e[i].call(a.exports,a,a.exports,n),a.l=!0,a.exports}n.m=e,n.c=t,n.d=function(e,t,i){n.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:i})},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=17)}([function(e,t){e.exports=function(e,t,n,i,a,s){var o,r=e=e||{},l=typeof e.default;"object"!==l&&"function"!==l||(o=e,r=e.default);var u,c="function"==typeof r?r.options:r;if(t&&(c.render=t.render,c.staticRenderFns=t.staticRenderFns,c._compiled=!0),n&&(c.functional=!0),a&&(c._scopeId=a),s?(u=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),i&&i.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(s)},c._ssrRegister=u):i&&(u=i),u){var p=c.functional,d=p?c.render:c.beforeCreate;p?(c._injectStyles=u,c.render=function(e,t){return u.call(t),d(e,t)}):c.beforeCreate=d?[].concat(d,u):[u]}return{esModule:o,exports:r,options:c}}},function(e,t,n){var i=n(0)(n(2),n(3),!1,null,null,null);e.exports=i.exports},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var i="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e};t.default={props:["name","value","type","hidevalue"],data:function(){return{id:Math.random().toString(36).substring(8),def:"http://via.placeholder.com/250x250?text=x"}},mounted:function(){"string"==typeof this.value?this.img=this.value:this.value&&"object"==i(this.value)&&this.value.path?this.img=this.value.url:"file"!=this.type&&(this.img=this.def),$("#btn-"+this.id).filemanager("image"),$("#btn-file-"+this.id).filemanager("file"),$("#holder-wrapper-"+this.id).filemanager("image"),$("#holder-file-wrapper-"+this.id).filemanager("file")},methods:{},watch:{value:function(e){this.$emit("input",e)}}}},function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",["file"!=e.type?n("div",{staticClass:"thumbnail",attrs:{id:"holder-wrapper-"+e.id,"data-input":"thumbnail-"+e.id,"data-preview":"holder-"+e.id}},[n("img",{attrs:{id:"holder-"+e.id,src:e.value}})]):e._e(),e._v(" "),n("div",{staticClass:"input-group"},[n("div",{staticClass:"input-group-btn"},["file"==e.type?n("a",{staticClass:"btn btn-primary",attrs:{id:"btn-file-"+e.id,"data-input":"thumbnail-"+e.id,"data-preview":"holder-"+e.id}},[n("i",{staticClass:"fa fa-file-o"}),e._v(" Choose\n\t\t\t")]):n("a",{staticClass:"btn btn-primary",attrs:{id:"btn-"+e.id,"data-input":"thumbnail-"+e.id,"data-preview":"holder-"+e.id}},[n("i",{staticClass:"fa fa-picture-o"}),e._v(" Choose\n\t\t\t")])]),e._v(" "),"checkbox"==(!1===e.hidevalue?"text":"hidden")?n("input",{directives:[{name:"model",rawName:"v-model",value:e.value,expression:"value"}],staticClass:"form-control",attrs:{id:"thumbnail-"+e.id,name:e.name,type:"checkbox"},domProps:{checked:Array.isArray(e.value)?e._i(e.value,null)>-1:e.value},on:{change:function(t){var n=e.value,i=t.target,a=!!i.checked;if(Array.isArray(n)){var s=e._i(n,null);i.checked?s<0&&(e.value=n.concat([null])):s>-1&&(e.value=n.slice(0,s).concat(n.slice(s+1)))}else e.value=a}}}):"radio"==(!1===e.hidevalue?"text":"hidden")?n("input",{directives:[{name:"model",rawName:"v-model",value:e.value,expression:"value"}],staticClass:"form-control",attrs:{id:"thumbnail-"+e.id,name:e.name,type:"radio"},domProps:{checked:e._q(e.value,null)},on:{change:function(t){e.value=null}}}):n("input",{directives:[{name:"model",rawName:"v-model",value:e.value,expression:"value"}],staticClass:"form-control",attrs:{id:"thumbnail-"+e.id,name:e.name,type:!1===e.hidevalue?"text":"hidden"},domProps:{value:e.value},on:{input:function(t){t.target.composing||(e.value=t.target.value)}}})])])},staticRenderFns:[]}},function(e,t){e.exports=function(e){var t=[];return t.toString=function(){return this.map(function(t){var n=function(e,t){var n=e[1]||"",i=e[3];if(!i)return n;if(t&&"function"==typeof btoa){var a=(o=i,"/*# sourceMappingURL=data:application/json;charset=utf-8;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(o))))+" */"),s=i.sources.map(function(e){return"/*# sourceURL="+i.sourceRoot+e+" */"});return[n].concat(s).concat([a]).join("\n")}var o;return[n].join("\n")}(t,e);return t[2]?"@media "+t[2]+"{"+n+"}":n}).join("")},t.i=function(e,n){"string"==typeof e&&(e=[[null,e,""]]);for(var i={},a=0;a<this.length;a++){var s=this[a][0];"number"==typeof s&&(i[s]=!0)}for(a=0;a<e.length;a++){var o=e[a];"number"==typeof o[0]&&i[o[0]]||(n&&!o[2]?o[2]=n:n&&(o[2]="("+o[2]+") and ("+n+")"),t.push(o))}},t}},function(e,t,n){var i="undefined"!=typeof document;if("undefined"!=typeof DEBUG&&DEBUG&&!i)throw new Error("vue-style-loader cannot be used in a non-browser environment. Use { target: 'node' } in your Webpack config to indicate a server-rendering environment.");var a=n(9),s={},o=i&&(document.head||document.getElementsByTagName("head")[0]),r=null,l=0,u=!1,c=function(){},p=null,d="data-vue-ssr-id",f="undefined"!=typeof navigator&&/msie [6-9]\b/.test(navigator.userAgent.toLowerCase());function g(e){for(var t=0;t<e.length;t++){var n=e[t],i=s[n.id];if(i){i.refs++;for(var a=0;a<i.parts.length;a++)i.parts[a](n.parts[a]);for(;a<n.parts.length;a++)i.parts.push(m(n.parts[a]));i.parts.length>n.parts.length&&(i.parts.length=n.parts.length)}else{var o=[];for(a=0;a<n.parts.length;a++)o.push(m(n.parts[a]));s[n.id]={id:n.id,refs:1,parts:o}}}}function h(){var e=document.createElement("style");return e.type="text/css",o.appendChild(e),e}function m(e){var t,n,i=document.querySelector("style["+d+'~="'+e.id+'"]');if(i){if(u)return c;i.parentNode.removeChild(i)}if(f){var a=l++;i=r||(r=h()),t=b.bind(null,i,a,!1),n=b.bind(null,i,a,!0)}else i=h(),t=function(e,t){var n=t.css,i=t.media,a=t.sourceMap;i&&e.setAttribute("media",i);p.ssrId&&e.setAttribute(d,t.id);a&&(n+="\n/*# sourceURL="+a.sources[0]+" */",n+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(a))))+" */");if(e.styleSheet)e.styleSheet.cssText=n;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(n))}}.bind(null,i),n=function(){i.parentNode.removeChild(i)};return t(e),function(i){if(i){if(i.css===e.css&&i.media===e.media&&i.sourceMap===e.sourceMap)return;t(e=i)}else n()}}e.exports=function(e,t,n,i){u=n,p=i||{};var o=a(e,t);return g(o),function(t){for(var n=[],i=0;i<o.length;i++){var r=o[i];(l=s[r.id]).refs--,n.push(l)}t?g(o=a(e,t)):o=[];for(i=0;i<n.length;i++){var l;if(0===(l=n[i]).refs){for(var u=0;u<l.parts.length;u++)l.parts[u]();delete s[l.id]}}}};var v,y=(v=[],function(e,t){return v[e]=t,v.filter(Boolean).join("\n")});function b(e,t,n,i){var a=n?"":i.css;if(e.styleSheet)e.styleSheet.cssText=y(t,a);else{var s=document.createTextNode(a),o=e.childNodes;o[t]&&e.removeChild(o[t]),o.length?e.insertBefore(s,o[t]):e.appendChild(s)}}},function(e,t,n){var i=n(0)(n(10),n(11),!1,function(e){n(7)},null,null);e.exports=i.exports},function(e,t,n){var i=n(8);"string"==typeof i&&(i=[[e.i,i,""]]),i.locals&&(e.exports=i.locals);n(5)("d7462650",i,!0,{})},function(e,t,n){(e.exports=n(4)(!1)).push([e.i,'.ckeditor:after{content:"";display:table;clear:both}',""])},function(e,t){e.exports=function(e,t){for(var n=[],i={},a=0;a<t.length;a++){var s=t[a],o=s[0],r={id:e+":"+a,css:s[1],media:s[2],sourceMap:s[3]};i[o]?i[o].parts.push(r):n.push(i[o]={id:o,parts:[r]})}return n}},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var i=(new Date).getTime();t.default={name:"vue-ckeditor",props:{name:{type:String,default:function(){return"editor-"+ ++i}},value:{type:String},id:{type:String,default:function(){return"editor-"+i}},types:{type:String,default:function(){return"classic"}},config:{type:Object,default:function(){}}},data:function(){return{destroyed:!1}},computed:{instance:function(){return CKEDITOR.instances[this.id]}},watch:{value:function(e){this.instance&&this.update(e)}},mounted:function(){var e=this;setTimeout(function(){e.create()},100)},beforeDestroy:function(){this.destroy()},methods:{create:function(){"undefined"==typeof CKEDITOR?console.log("CKEDITOR is missing (http://ckeditor.com/)"):("inline"===this.types?CKEDITOR.inline(this.id,this.config):CKEDITOR.replace(this.id,this.config),this.instance.setData(this.value),this.instance.on("change",this.onChange),this.instance.on("blur",this.onBlur),this.instance.on("focus",this.onFocus))},update:function(e){this.instance.getData()!==e&&this.instance.setData(e)},destroy:function(){this.destroyed||(this.instance.focusManager.blur(!0),this.instance.removeAllListeners(),this.instance.destroy(),this.destroyed=!0)},onChange:function(){var e=this.instance.getData();e!==this.value&&this.$emit("input",e)},onBlur:function(){this.$emit("blur",this.instance)},onFocus:function(){this.$emit("focus",this.instance)}}}},function(e,t){e.exports={render:function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticClass:"ckeditor"},[t("textarea",{attrs:{name:this.name,id:this.id,types:this.types,config:this.config},domProps:{value:this.value}})])},staticRenderFns:[]}},function(e,t,n){var i=n(0)(n(15),n(16),!1,function(e){n(13)},null,null);e.exports=i.exports},function(e,t,n){var i=n(14);"string"==typeof i&&(i=[[e.i,i,""]]),i.locals&&(e.exports=i.locals);n(5)("5b8f2d6c",i,!0,{})},function(e,t,n){(e.exports=n(4)(!1)).push([e.i,".controls{margin-top:13px;max-width:400px}",""])},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={props:{lnglat:{type:String,default:""}},data:function(){return{lat:null,lng:null}},mounted:function(){var e=[];this.lnglat&&(e=this.lnglat.split(",")),e.length>0?(this.lng=Number(e[1]),this.lat=Number(e[0])):(this.lat=27.686884587085057,this.lng=85.34427752591353);var t=new google.maps.LatLng(this.lng,this.lat),n={zoom:16,center:t},i=new google.maps.Map(this.$el,n),a=new google.maps.Marker({position:t,map:i});a.setMap(i);var s=this;google.maps.event.addListener(i,"center_changed",function(){var e={lat:i.getCenter().lat(),lng:i.getCenter().lng()};a.setPosition(e),s.$emit("locationupdated",e)});var o=this.$refs.searchbox,r=new google.maps.places.SearchBox(o);i.controls[google.maps.ControlPosition.TOP_LEFT].push(o),i.addListener("bounds_changed",function(){r.setBounds(i.getBounds())});var l=[];r.addListener("places_changed",function(){var e=r.getPlaces();if(0!=e.length){l.forEach(function(e){e.setMap(null)}),l=[];var t=new google.maps.LatLngBounds;e.forEach(function(e){if(e.geometry){var n={url:e.icon,size:new google.maps.Size(71,71),origin:new google.maps.Point(0,0),anchor:new google.maps.Point(17,34),scaledSize:new google.maps.Size(25,25)};l.push(new google.maps.Marker({map:i,icon:n,title:e.name,position:e.geometry.location})),e.geometry.viewport?t.union(e.geometry.viewport):t.extend(e.geometry.location)}else console.log("Returned place contains no geometry")}),i.fitBounds(t)}})}}},function(e,t){e.exports={render:function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticStyle:{height:"350px"}},[t("input",{ref:"searchbox",staticClass:"controls form-control",attrs:{id:"pac-input",type:"text",placeholder:"Search Box"}}),this._v(" "),t("div",{staticClass:"map-container"})])},staticRenderFns:[]}},function(e,t,n){e.exports=n(18)},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var i=n(6),a=n.n(i),s=n(1),o=n.n(s),r=n(12),l=n.n(r),u=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var i in n)Object.prototype.hasOwnProperty.call(n,i)&&(e[i]=n[i])}return e};function c(e){if(Array.isArray(e)){for(var t=0,n=Array(e.length);t<e.length;t++)n[t]=e[t];return n}return Array.from(e)}var p={title:"",sub_title:"",slug:"",content:"",meta_title:"",meta_description:"",meta_keywords:"",page_id:"",is_published:!1,view:"",images:[],formatted:!1,page_type:null,custom:[],posts:[]},d="undefined"==typeof page;window.pageapp=new Vue({el:"#page-app",data:{page:d?p:Object.assign({},p,page),page_types:[u({},{id:null,title:"Default",slug:"default",custom:[{pivot:{slug:"photo"},slug:"photo",type:"image",title:"Image",default:null}],alias:[{visible:"true",alias:"Title",slug:"title",title:"Title",required:"true",default:null},{visible:"false",alias:"Slug",slug:"slug",title:"Slug",required:"false",default:null},{visible:"true",alias:"Sub Title",slug:"sub_title",title:"Sub Title",required:"false",default:null},{visible:"true",alias:"Content",slug:"content",title:"Content",required:"false",default:null},{visible:"true",alias:"Is Published",slug:"is_published",title:"Is Published",required:"false",default:"true"},{visible:"false",alias:"Is Featured",slug:"is_featured",title:"Is Featured",required:"false",default:null},{visible:"true",alias:"Meta",slug:"meta",title:"Meta",required:"false",default:null}]})].concat(c(page_types)),posts:posts,new_image:{pivot:{slug:""},title:"",thumbnail:""},new_custom:{slug:"",value:""},deleted_image_ids:[],editor:{allowedContent:!0,height:500}},mounted:function(){!this.page.page_type&&this.page_types.length&&(this.page.page_type=this.page_types[0]),this.fillCustomFields()},watch:{"page.title":function(e){d&&(this.page.slug=this.slugify(e))},"page.slug":function(e){this.page.slug=this.slugify(e)},"page.view":function(e){this.page.page_type=this.page_types.find(function(t){return t.id==e})},"page.page_type":function(e){this.page.view=e.id,this.fillCustomFields(),this.updateSelect2()}},computed:{page_type_images:function(){return this.page.page_type?this.page.page_type.custom.filter(function(e){return"image"==e.type||"multiple-images"==e.type}):[]},page_type_non_images:function(){return this.page.page_type?this.page.page_type.custom.filter(function(e){return"image"!=e.type&&"multiple-images"!=e.type}):[]}},methods:{addCustomField:function(){this.page.custom.push(Object.assign({},this.new_custom))},removeCustomField:function(e){this.page.custom.splice(e,1)},slugify:function(e){return e.toString().toLowerCase().replace(/\s+/g,"-").replace(/&/g,"").replace(/[^\w\-]+/g,"").replace(/\-\-+/g,"-").replace(/^-+/,"").replace(/-+$/,"").replace(/-$/,"")},alias:function(e){var t=null;return this.page.page_type&&this.page.page_type.alias&&(t=this.page.page_type.alias.find(function(t){return t.slug==e})),t?t.alias:""},alias_visible:function(e){var t=null;return this.page.page_type&&this.page.page_type.alias&&(t=this.page.page_type.alias.find(function(t){return t.slug==e})),!!t&&("true"===t.visible||!0===t.visible)},addImageField:function(e){this.page.images.push(Object.assign({},this.new_image,{pivot:{slug:e},slug:e,type:"multiple-images",id:Math.random().toString(36).substring(6)}))},removeImageField:function(e){this.page.images=this.page.images.filter(function(t){return t!==e})},fillCustomFields:function(){var e=this,t=[];this.page_type_non_images.map(function(n){if(e.page.custom.length){var i=e.page.custom.find(function(e){return n.slug==e.slug});t.push(u({},n,i,{id:n.id,title:n.title}))}else"map"==n.slug?t.push(u({},n,{value:","})):t.push(u({},n,{value:""}))}),this.page.custom=t,this.page_type_images.map(function(t){e.page.images.filter(function(e){return e.slug==t.slug||e.pivot&&e.pivot.slug==t.slug}).length||(t.thumbnail=null,t.url=PLACEHOLDER,e.page.images.push(Object.assign({},t)))})},locationupdated:function(e,t,n){var i=e.lng+","+e.lat;this.page.custom.find(function(e){return e.slug==t}).value=i,$('[name="'+n+'"]').val(i)},addPostsRelation:function(e,t,n){var i=this.posts.find(function(e){return e.id==t});this.page.posts=[].concat(c(n?this.page.posts:this.page.posts.filter(function(t){return t.pivot.slug!=e})),[u({},i,{pivot:{slug:e}})])},removePostsRelation:function(e,t){this.page.posts=this.page.posts.filter(function(n){return n.pivot.slug==e&&n.id!=t})},updateSelect2:function(){var e=this;setTimeout(function(){$(".select2").each(function(){var t=this,n=void 0!==$(t).attr("multiple");$(t).select2().on("select2:select",function(i){e.addPostsRelation($(t).data("slug"),i.params.data.id,n)}).on("select2:unselect",function(n){e.removePostsRelation($(t).data("slug"),n.params.data.id)})})},500)},getCustomValue:function(e,t){void 0===t&&(t=null);var n=this.page.custom.find(function(t){return t.slug==e});if(n)return n.value;var i=this.page.posts.filter(function(t){return t.pivot.slug==e});return i.length?i.map(function(e){return e.id}):t}},components:{Ckeditor:a.a,ImageSelector:o.a,MapLocationSelector:l.a}})}]);