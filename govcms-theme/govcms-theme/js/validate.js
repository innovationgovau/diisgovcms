!function(e,t,a){var n={required:"The %s field is required.",matches:"The %s field does not match the %s field.",default:"The %s field is still set to default, please change.",valid_email:"The %s field must contain a valid email address.",valid_emails:"The %s field must contain all valid email addresses.",min_length:"The %s field must be at least %s characters in length.",max_length:"The %s field must not exceed %s characters in length.",exact_length:"The %s field must be exactly %s characters in length.",greater_than:"The %s field must contain a number greater than %s.",less_than:"The %s field must contain a number less than %s.",alpha:"The %s field must only contain alphabetical characters.",alpha_numeric:"The %s field must only contain alpha-numeric characters.",alpha_dash:"The %s field must only contain alpha-numeric characters, underscores, and dashes.",numeric:"The %s field must contain only numbers.",integer:"The %s field must contain an integer.",decimal:"The %s field must contain a decimal number.",is_natural:"The %s field must contain only positive numbers.",is_natural_no_zero:"The %s field must contain a number greater than zero.",valid_ip:"The %s field must contain a valid IP.",valid_base64:"The %s field must contain a base64 string.",valid_credit_card:"The %s field must contain a valid credit card number.",is_file_type:"The %s field must contain only %s files.",valid_url:"The %s field must contain a valid URL.",greater_than_date:"The %s field must contain a more recent date than %s.",less_than_date:"The %s field must contain an older date than %s.",greater_than_or_equal_date:"The %s field must contain a date that's at least as recent as %s.",less_than_or_equal_date:"The %s field must contain a date that's %s or older."},s=function(e){},i=/^(.+?)\[(.+)\]$/,r=/^[0-9]+$/,l=/^\-?[0-9]+$/,u=/^\-?[0-9]*\.?[0-9]+$/,o=/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,d=/^[a-z]+$/i,h=/^[a-z0-9]+$/i,c=/^[a-z0-9_\-]+$/i,f=/^[0-9]+$/i,p=/^[1-9][0-9]*$/i,m=/^((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){3}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})$/i,_=/[^a-zA-Z0-9\/\+=]/i,v=/^[\d\-\s]+$/,g=/^((http|https):\/\/(\w+:{0,1}\w*@)?(\S+)|)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?$/,y=/\d{4}-\d{1,2}-\d{1,2}/,b=function(e,t,n){for(this.callback=n||s,this.errors=[],this.fields={},this.form=this._formByNameOrNode(e)||{},this.messages={},this.handlers={},this.conditionals={},e=0,n=t.length;e<n;e++){var i=t[e];if((i.name||i.names)&&i.rules)if(i.names)for(var r=0,l=i.names.length;r<l;r++)this._addField(i,i.names[r]);else this._addField(i,i.name);else console.warn("validate.js: The following field is being skipped due to a misconfiguration:"),console.warn(i),console.warn("Check to ensure you have properly configured a name and rules for this field")}var u=this.form.onsubmit;this.form.onsubmit=function(e){return function(t){try{return e._validateForm(t)&&(u===a||u())}catch(e){}}}(this)},T=function(e,t){var a;if(!(0<e.length)||"radio"!==e[0].type&&"checkbox"!==e[0].type)return e[t];for(a=0,elementLength=e.length;a<elementLength;a++)if(e[a].checked)return e[a][t]};b.prototype.setMessage=function(e,t){return this.messages[e]=t,this},b.prototype.registerCallback=function(e,t){return e&&"string"==typeof e&&t&&"function"==typeof t&&(this.handlers[e]=t),this},b.prototype.registerConditional=function(e,t){return e&&"string"==typeof e&&t&&"function"==typeof t&&(this.conditionals[e]=t),this},b.prototype._formByNameOrNode=function(e){return"object"==typeof e?e:t.forms[e]},b.prototype._addField=function(e,t){this.fields[t]={name:t,display:e.display||t,rules:e.rules,depends:e.depends,id:null,element:null,type:null,value:null,checked:null}},b.prototype._validateForm=function(e){this.errors=[];for(var t in this.fields)if(this.fields.hasOwnProperty(t)){var n=this.fields[t]||{},s=this.form[n.name];s&&s!==a&&(n.id=T(s,"id"),n.element=s,n.type=0<s.length?s[0].type:s.type,n.value=T(s,"value"),n.checked=T(s,"checked"),n.depends&&"function"==typeof n.depends?n.depends.call(this,n)&&this._validateField(n):n.depends&&"string"==typeof n.depends&&this.conditionals[n.depends]?this.conditionals[n.depends].call(this,n)&&this._validateField(n):this._validateField(n))}return"function"==typeof this.callback&&this.callback(this.errors,e),0<this.errors.length&&(e&&e.preventDefault?e.preventDefault():event&&(event.returnValue=!1)),!0},b.prototype._validateField=function(e){var t,s,r=e.rules.split("|"),l=e.rules.indexOf("required"),u=!e.value||""===e.value||e.value===a;for(t=0,ruleLength=r.length;t<ruleLength;t++){var o=r[t];s=null;var d=!1,h=i.exec(o);if((-1!==l||-1!==o.indexOf("!callback_")||!u)&&(h&&(o=h[1],s=h[2]),"!"===o.charAt(0)&&(o=o.substring(1,o.length)),"function"==typeof this._hooks[o]?this._hooks[o].apply(this,[e,s])||(d=!0):"callback_"===o.substring(0,9)&&(o=o.substring(9,o.length),"function"==typeof this.handlers[o]&&!1===this.handlers[o].apply(this,[e.value,s,e])&&(d=!0)),d)){h=this.messages[e.name+"."+o]||this.messages[o]||n[o],d="An error has occurred with the "+e.display+" field.",h&&(d=h.replace("%s",e.display),s&&(d=d.replace("%s",this.fields[s]?this.fields[s].display:s)));var c;for(s=0;s<this.errors.length;s+=1)e.id===this.errors[s].id&&(c=this.errors[s]);(o=c||{id:e.id,display:e.display,element:e.element,name:e.name,message:d,messages:[],rule:o}).messages.push(d),c||this.errors.push(o)}}},b.prototype._getValidDate=function(e){if(!e.match("today")&&!e.match(y))return!1;var t=new Date;return e.match("today")||(e=e.split("-"),t.setFullYear(e[0]),t.setMonth(e[1]-1),t.setDate(e[2])),t},b.prototype._hooks={required:function(e){var t=e.value;return"checkbox"===e.type||"radio"===e.type?!0===e.checked:null!==t&&""!==t},default:function(e,t){return e.value!==t},matches:function(e,t){var a=this.form[t];return!!a&&e.value===a.value},valid_email:function(e){return o.test(e.value)},valid_emails:function(e){for(var t=0,a=(e=e.value.split(/\s*,\s*/g)).length;t<a;t++)if(!o.test(e[t]))return!1;return!0},min_length:function(e,t){return!!r.test(t)&&e.value.length>=parseInt(t,10)},max_length:function(e,t){return!!r.test(t)&&e.value.length<=parseInt(t,10)},exact_length:function(e,t){return!!r.test(t)&&e.value.length===parseInt(t,10)},greater_than:function(e,t){return!!u.test(e.value)&&parseFloat(e.value)>parseFloat(t)},less_than:function(e,t){return!!u.test(e.value)&&parseFloat(e.value)<parseFloat(t)},alpha:function(e){return d.test(e.value)},alpha_numeric:function(e){return h.test(e.value)},alpha_dash:function(e){return c.test(e.value)},numeric:function(e){return r.test(e.value)},integer:function(e){return l.test(e.value)},decimal:function(e){return u.test(e.value)},is_natural:function(e){return f.test(e.value)},is_natural_no_zero:function(e){return p.test(e.value)},valid_ip:function(e){return m.test(e.value)},valid_base64:function(e){return _.test(e.value)},valid_url:function(e){return g.test(e.value)},valid_credit_card:function(e){if(!v.test(e.value))return!1;for(var t=0,a=0,n=!1,s=(e=e.value.replace(/\D/g,"")).length-1;0<=s;s--)a=e.charAt(s),a=parseInt(a,10),n&&9<(a*=2)&&(a-=9),t+=a,n=!n;return 0==t%10},is_file_type:function(e,t){if("file"!==e.type)return!0;var a=e.value.substr(e.value.lastIndexOf(".")+1),n=t.split(","),s=!1,i=0,r=n.length;for(i;i<r;i++)a.toUpperCase()==n[i].toUpperCase()&&(s=!0);return s},greater_than_date:function(e,t){var a=this._getValidDate(e.value),n=this._getValidDate(t);return!(!n||!a)&&a>n},less_than_date:function(e,t){var a=this._getValidDate(e.value),n=this._getValidDate(t);return!(!n||!a)&&a<n},greater_than_or_equal_date:function(e,t){var a=this._getValidDate(e.value),n=this._getValidDate(t);return!(!n||!a)&&a>=n},less_than_or_equal_date:function(e,t){var a=this._getValidDate(e.value),n=this._getValidDate(t);return!(!n||!a)&&a<=n}},e.FormValidator=b}(window,document),"undefined"!=typeof module&&module.exports&&(module.exports=FormValidator);