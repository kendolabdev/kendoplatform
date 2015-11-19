/*! jQuery v2.1.4 | (c) 2005, 2015 jQuery Foundation, Inc. | jquery.org/license */

//     Underscore.js 1.8.3
//     http://underscorejs.org
//     (c) 2009-2015 Jeremy Ashkenas, DocumentCloud and Investigative Reporters & Editors
//     Underscore may be freely distributed under the MIT license.

/* ========================================================================
 * Bootstrap: dropdown.js v3.3.4
 * http://getbootstrap.com/javascript/#dropdowns
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */

/**
*  @name							Elastic
*	@descripton						Elastic is jQuery plugin that grow and shrink your textareas automatically
*	@version						1.6.11
*	@requires						jQuery 1.2.6+
*
*	@author							Jan Jarfalk
*	@author-email					jan.jarfalk@unwrongest.com
*	@author-website					http://www.unwrongest.com
*
*	@licence						MIT License - http://www.opensource.org/licenses/mit-license.php
*/

/**
 * jquery.Jcrop.js v0.9.12
 * jQuery Image Cropping Plugin - released under MIT License 
 * Author: Kelly Hallman <khallman@gmail.com>
 * http://github.com/tapmodo/Jcrop
 * Copyright (c) 2008-2013 Tapmodo Interactive LLC {{{
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 *
 * }}}
 */

/*
    jQuery `input` special event v1.0

    http://whattheheadsaid.com/projects/input-special-event

    (c) 2010-2011 Andy Earnshaw
    MIT license
    www.opensource.org/licenses/mit-license.php

    Modified by Kenneth Auchenberg
    * Disabled usage of onPropertyChange event in IE, since its a bit delayed, if you type really fast.
*/

/*
 * Mentions Input
 * Version 1.0.2
 * Written by: Kenneth Auchenberg (Podio)
 *
 * Using underscore.js
 *
 * License: MIT License - http://www.opensource.org/licenses/mit-license.php
 */

/*!
 SerializeJSON jQuery plugin.
 https://github.com/marioizquierdo/jquery.serializeJSON
 version 2.6.0 (Apr, 2015)

 Copyright (c) 2012, 2015 Mario Izquierdo
 Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 */

/*! jQuery UI - v1.11.4 - 2015-05-09
* http://jqueryui.com
* Includes: core.js, widget.js, mouse.js, position.js, draggable.js, droppable.js, resizable.js, selectable.js, sortable.js
* Copyright 2015 jQuery Foundation and other contributors; Licensed MIT */

/* ========================================================================
 * Bootstrap: affix.js v3.3.4
 * http://getbootstrap.com/javascript/#affix
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */

/* ========================================================================
 * Bootstrap: alert.js v3.3.4
 * http://getbootstrap.com/javascript/#alerts
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */

/* ========================================================================
 * Bootstrap: button.js v3.3.4
 * http://getbootstrap.com/javascript/#buttons
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */

/* ========================================================================
 * Bootstrap: collapse.js v3.3.4
 * http://getbootstrap.com/javascript/#collapse
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */

/*!
 * Hyves 1.0.1
 * Copyright Nam Nguyen <namnv@younetco.com>
 */

/* ========================================================================
 * Bootstrap: scrollspy.js v3.3.4
 * http://getbootstrap.com/javascript/#scrollspy
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */

/* ========================================================================
 * Bootstrap: tab.js v3.3.4
 * http://getbootstrap.com/javascript/#tabs
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */

/* ========================================================================
 * Bootstrap: transition.js v3.3.4
 * http://getbootstrap.com/javascript/#transitions
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */

!function (e, t) {
    "object" == typeof module && "object" == typeof module.exports ? module.exports = e.document ? t(e, !0) : function (e) {
        if (!e.document)throw new Error("jQuery requires a window with a document");
        return t(e)
    } : t(e)
}("undefined" != typeof window ? window : this, function (a, b) {
    function s(e) {
        var t = "length" in e && e.length, r = n.type(e);
        return "function" === r || n.isWindow(e) ? !1 : 1 === e.nodeType && t ? !0 : "array" === r || 0 === t || "number" == typeof t && t > 0 && t - 1 in e
    }

    function x(e, t, r) {
        if (n.isFunction(t))return n.grep(e, function (e, n) {
            return !!t.call(e, n, e) !== r
        });
        if (t.nodeType)return n.grep(e, function (e) {
            return e === t !== r
        });
        if ("string" == typeof t) {
            if (w.test(t))return n.filter(t, e, r);
            t = n.filter(t, e)
        }
        return n.grep(e, function (e) {
            return g.call(t, e) >= 0 !== r
        })
    }

    function D(e, t) {
        while ((e = e[t]) && 1 !== e.nodeType);
        return e
    }

    function G(e) {
        var t = F[e] = {};
        return n.each(e.match(E) || [], function (e, n) {
            t[n] = !0
        }), t
    }

    function I() {
        l.removeEventListener("DOMContentLoaded", I, !1), a.removeEventListener("load", I, !1), n.ready()
    }

    function K() {
        Object.defineProperty(this.cache = {}, 0, {
            get: function () {
                return {}
            }
        }), this.expando = n.expando + K.uid++
    }

    function P(e, t, r) {
        var i;
        if (void 0 === r && 1 === e.nodeType)if (i = "data-" + t.replace(O, "-$1").toLowerCase(), r = e.getAttribute(i), "string" == typeof r) {
            try {
                r = "true" === r ? !0 : "false" === r ? !1 : "null" === r ? null : +r + "" === r ? +r : N.test(r) ? n.parseJSON(r) : r
            } catch (s) {
            }
            M.set(e, t, r)
        } else r = void 0;
        return r
    }

    function Z() {
        return !0
    }

    function $() {
        return !1
    }

    function _() {
        try {
            return l.activeElement
        } catch (e) {
        }
    }

    function ja(e, t) {
        return n.nodeName(e, "table") && n.nodeName(11 !== t.nodeType ? t : t.firstChild, "tr") ? e.getElementsByTagName("tbody")[0] || e.appendChild(e.ownerDocument.createElement("tbody")) : e
    }

    function ka(e) {
        return e.type = (null !== e.getAttribute("type")) + "/" + e.type, e
    }

    function la(e) {
        var t = ga.exec(e.type);
        return t ? e.type = t[1] : e.removeAttribute("type"), e
    }

    function ma(e, t) {
        for (var n = 0, r = e.length; r > n; n++)L.set(e[n], "globalEval", !t || L.get(t[n], "globalEval"))
    }

    function na(e, t) {
        var r, i, s, o, u, a, f, l;
        if (1 === t.nodeType) {
            if (L.hasData(e) && (o = L.access(e), u = L.set(t, o), l = o.events)) {
                delete u.handle, u.events = {};
                for (s in l)for (r = 0, i = l[s].length; i > r; r++)n.event.add(t, s, l[s][r])
            }
            M.hasData(e) && (a = M.access(e), f = n.extend({}, a), M.set(t, f))
        }
    }

    function oa(e, t) {
        var r = e.getElementsByTagName ? e.getElementsByTagName(t || "*") : e.querySelectorAll ? e.querySelectorAll(t || "*") : [];
        return void 0 === t || t && n.nodeName(e, t) ? n.merge([e], r) : r
    }

    function pa(e, t) {
        var n = t.nodeName.toLowerCase();
        "input" === n && T.test(e.type) ? t.checked = e.checked : ("input" === n || "textarea" === n) && (t.defaultValue = e.defaultValue)
    }

    function sa(e, t) {
        var r, i = n(t.createElement(e)).appendTo(t.body), s = a.getDefaultComputedStyle && (r = a.getDefaultComputedStyle(i[0])) ? r.display : n.css(i[0], "display");
        return i.detach(), s
    }

    function ta(e) {
        var t = l, r = ra[e];
        return r || (r = sa(e, t), "none" !== r && r || (qa = (qa || n("<iframe frameborder='0' width='0' height='0'/>")).appendTo(t.documentElement), t = qa[0].contentDocument, t.write(), t.close(), r = sa(e, t), qa.detach()), ra[e] = r), r
    }

    function xa(e, t, r) {
        var i, s, o, u, a = e.style;
        return r = r || wa(e), r && (u = r.getPropertyValue(t) || r[t]), r && ("" !== u || n.contains(e.ownerDocument, e) || (u = n.style(e, t)), va.test(u) && ua.test(t) && (i = a.width, s = a.minWidth, o = a.maxWidth, a.minWidth = a.maxWidth = a.width = u, u = r.width, a.width = i, a.minWidth = s, a.maxWidth = o)), void 0 !== u ? u + "" : u
    }

    function ya(e, t) {
        return {
            get: function () {
                return e() ? void delete this.get : (this.get = t).apply(this, arguments)
            }
        }
    }

    function Fa(e, t) {
        if (t in e)return t;
        var n = t[0].toUpperCase() + t.slice(1), r = t, i = Ea.length;
        while (i--)if (t = Ea[i] + n, t in e)return t;
        return r
    }

    function Ga(e, t, n) {
        var r = Aa.exec(t);
        return r ? Math.max(0, r[1] - (n || 0)) + (r[2] || "px") : t
    }

    function Ha(e, t, r, i, s) {
        for (var o = r === (i ? "border" : "content") ? 4 : "width" === t ? 1 : 0, u = 0; 4 > o; o += 2)"margin" === r && (u += n.css(e, r + R[o], !0, s)), i ? ("content" === r && (u -= n.css(e, "padding" + R[o], !0, s)), "margin" !== r && (u -= n.css(e, "border" + R[o] + "Width", !0, s))) : (u += n.css(e, "padding" + R[o], !0, s), "padding" !== r && (u += n.css(e, "border" + R[o] + "Width", !0, s)));
        return u
    }

    function Ia(e, t, r) {
        var i = !0, s = "width" === t ? e.offsetWidth : e.offsetHeight, o = wa(e), u = "border-box" === n.css(e, "boxSizing", !1, o);
        if (0 >= s || null == s) {
            if (s = xa(e, t, o), (0 > s || null == s) && (s = e.style[t]), va.test(s))return s;
            i = u && (k.boxSizingReliable() || s === e.style[t]), s = parseFloat(s) || 0
        }
        return s + Ha(e, t, r || (u ? "border" : "content"), i, o) + "px"
    }

    function Ja(e, t) {
        for (var r, i, s, o = [], u = 0, a = e.length; a > u; u++)i = e[u], i.style && (o[u] = L.get(i, "olddisplay"), r = i.style.display, t ? (o[u] || "none" !== r || (i.style.display = ""), "" === i.style.display && S(i) && (o[u] = L.access(i, "olddisplay", ta(i.nodeName)))) : (s = S(i), "none" === r && s || L.set(i, "olddisplay", s ? r : n.css(i, "display"))));
        for (u = 0; a > u; u++)i = e[u], i.style && (t && "none" !== i.style.display && "" !== i.style.display || (i.style.display = t ? o[u] || "" : "none"));
        return e
    }

    function Ka(e, t, n, r, i) {
        return new Ka.prototype.init(e, t, n, r, i)
    }

    function Sa() {
        return setTimeout(function () {
            La = void 0
        }), La = n.now()
    }

    function Ta(e, t) {
        var n, r = 0, i = {height: e};
        for (t = t ? 1 : 0; 4 > r; r += 2 - t)n = R[r], i["margin" + n] = i["padding" + n] = e;
        return t && (i.opacity = i.width = e), i
    }

    function Ua(e, t, n) {
        for (var r, i = (Ra[t] || []).concat(Ra["*"]), s = 0, o = i.length; o > s; s++)if (r = i[s].call(n, t, e))return r
    }

    function Va(e, t, r) {
        var i, s, o, u, a, f, l, c, h = this, p = {}, d = e.style, v = e.nodeType && S(e), m = L.get(e, "fxshow");
        r.queue || (a = n._queueHooks(e, "fx"), null == a.unqueued && (a.unqueued = 0, f = a.empty.fire, a.empty.fire = function () {
            a.unqueued || f()
        }), a.unqueued++, h.always(function () {
            h.always(function () {
                a.unqueued--, n.queue(e, "fx").length || a.empty.fire()
            })
        })), 1 === e.nodeType && ("height" in t || "width" in t) && (r.overflow = [d.overflow, d.overflowX, d.overflowY], l = n.css(e, "display"), c = "none" === l ? L.get(e, "olddisplay") || ta(e.nodeName) : l, "inline" === c && "none" === n.css(e, "float") && (d.display = "inline-block")), r.overflow && (d.overflow = "hidden", h.always(function () {
            d.overflow = r.overflow[0], d.overflowX = r.overflow[1], d.overflowY = r.overflow[2]
        }));
        for (i in t)if (s = t[i], Na.exec(s)) {
            if (delete t[i], o = o || "toggle" === s, s === (v ? "hide" : "show")) {
                if ("show" !== s || !m || void 0 === m[i])continue;
                v = !0
            }
            p[i] = m && m[i] || n.style(e, i)
        } else l = void 0;
        if (n.isEmptyObject(p))"inline" === ("none" === l ? ta(e.nodeName) : l) && (d.display = l); else {
            m ? "hidden" in m && (v = m.hidden) : m = L.access(e, "fxshow", {}), o && (m.hidden = !v), v ? n(e).show() : h.done(function () {
                n(e).hide()
            }), h.done(function () {
                var t;
                L.remove(e, "fxshow");
                for (t in p)n.style(e, t, p[t])
            });
            for (i in p)u = Ua(v ? m[i] : 0, i, h), i in m || (m[i] = u.start, v && (u.end = u.start, u.start = "width" === i || "height" === i ? 1 : 0))
        }
    }

    function Wa(e, t) {
        var r, i, s, o, u;
        for (r in e)if (i = n.camelCase(r), s = t[i], o = e[r], n.isArray(o) && (s = o[1], o = e[r] = o[0]), r !== i && (e[i] = o, delete e[r]), u = n.cssHooks[i], u && "expand" in u) {
            o = u.expand(o), delete e[i];
            for (r in o)r in e || (e[r] = o[r], t[r] = s)
        } else t[i] = s
    }

    function Xa(e, t, r) {
        var i, s, o = 0, u = Qa.length, a = n.Deferred().always(function () {
            delete f.elem
        }), f = function () {
            if (s)return !1;
            for (var t = La || Sa(), n = Math.max(0, l.startTime + l.duration - t), r = n / l.duration || 0, i = 1 - r, o = 0, u = l.tweens.length; u > o; o++)l.tweens[o].run(i);
            return a.notifyWith(e, [l, i, n]), 1 > i && u ? n : (a.resolveWith(e, [l]), !1)
        }, l = a.promise({
            elem: e,
            props: n.extend({}, t),
            opts: n.extend(!0, {specialEasing: {}}, r),
            originalProperties: t,
            originalOptions: r,
            startTime: La || Sa(),
            duration: r.duration,
            tweens: [],
            createTween: function (t, r) {
                var i = n.Tween(e, l.opts, t, r, l.opts.specialEasing[t] || l.opts.easing);
                return l.tweens.push(i), i
            },
            stop: function (t) {
                var n = 0, r = t ? l.tweens.length : 0;
                if (s)return this;
                for (s = !0; r > n; n++)l.tweens[n].run(1);
                return t ? a.resolveWith(e, [l, t]) : a.rejectWith(e, [l, t]), this
            }
        }), c = l.props;
        for (Wa(c, l.opts.specialEasing); u > o; o++)if (i = Qa[o].call(l, e, c, l.opts))return i;
        return n.map(c, Ua, l), n.isFunction(l.opts.start) && l.opts.start.call(e, l), n.fx.timer(n.extend(f, {
            elem: e,
            anim: l,
            queue: l.opts.queue
        })), l.progress(l.opts.progress).done(l.opts.done, l.opts.complete).fail(l.opts.fail).always(l.opts.always)
    }

    function qb(e) {
        return function (t, r) {
            "string" != typeof t && (r = t, t = "*");
            var i, s = 0, o = t.toLowerCase().match(E) || [];
            if (n.isFunction(r))while (i = o[s++])"+" === i[0] ? (i = i.slice(1) || "*", (e[i] = e[i] || []).unshift(r)) : (e[i] = e[i] || []).push(r)
        }
    }

    function rb(e, t, r, i) {
        function u(l) {
            var h;
            return s[l] = !0, n.each(e[l] || [], function (e, n) {
                var a = n(t, r, i);
                return "string" != typeof a || o || s[a] ? o ? !(h = a) : void 0 : (t.dataTypes.unshift(a), u(a), !1)
            }), h
        }

        var s = {}, o = e === mb;
        return u(t.dataTypes[0]) || !s["*"] && u("*")
    }

    function sb(e, t) {
        var r, i, s = n.ajaxSettings.flatOptions || {};
        for (r in t)void 0 !== t[r] && ((s[r] ? e : i || (i = {}))[r] = t[r]);
        return i && n.extend(!0, e, i), e
    }

    function tb(e, t, n) {
        var r, i, s, o, u = e.contents, a = e.dataTypes;
        while ("*" === a[0])a.shift(), void 0 === r && (r = e.mimeType || t.getResponseHeader("Content-Type"));
        if (r)for (i in u)if (u[i] && u[i].test(r)) {
            a.unshift(i);
            break
        }
        if (a[0] in n)s = a[0]; else {
            for (i in n) {
                if (!a[0] || e.converters[i + " " + a[0]]) {
                    s = i;
                    break
                }
                o || (o = i)
            }
            s = s || o
        }
        return s ? (s !== a[0] && a.unshift(s), n[s]) : void 0
    }

    function ub(e, t, n, r) {
        var i, s, o, u, a, f = {}, l = e.dataTypes.slice();
        if (l[1])for (o in e.converters)f[o.toLowerCase()] = e.converters[o];
        s = l.shift();
        while (s)if (e.responseFields[s] && (n[e.responseFields[s]] = t), !a && r && e.dataFilter && (t = e.dataFilter(t, e.dataType)), a = s, s = l.shift())if ("*" === s)s = a; else if ("*" !== a && a !== s) {
            if (o = f[a + " " + s] || f["* " + s], !o)for (i in f)if (u = i.split(" "), u[1] === s && (o = f[a + " " + u[0]] || f["* " + u[0]])) {
                o === !0 ? o = f[i] : f[i] !== !0 && (s = u[0], l.unshift(u[1]));
                break
            }
            if (o !== !0)if (o && e["throws"])t = o(t); else try {
                t = o(t)
            } catch (c) {
                return {state: "parsererror", error: o ? c : "No conversion from " + a + " to " + s}
            }
        }
        return {state: "success", data: t}
    }

    function Ab(e, t, r, i) {
        var s;
        if (n.isArray(t))n.each(t, function (t, n) {
            r || wb.test(e) ? i(e, n) : Ab(e + "[" + ("object" == typeof n ? t : "") + "]", n, r, i)
        }); else if (r || "object" !== n.type(t))i(e, t); else for (s in t)Ab(e + "[" + s + "]", t[s], r, i)
    }

    function Jb(e) {
        return n.isWindow(e) ? e : 9 === e.nodeType && e.defaultView
    }

    var c = [], d = c.slice, e = c.concat, f = c.push, g = c.indexOf, h = {}, i = h.toString, j = h.hasOwnProperty, k = {}, l = a.document, m = "2.1.4", n = function (e, t) {
        return new n.fn.init(e, t)
    }, o = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, p = /^-ms-/, q = /-([\da-z])/gi, r = function (e, t) {
        return t.toUpperCase()
    };
    n.fn = n.prototype = {
        jquery: m, constructor: n, selector: "", length: 0, toArray: function () {
            return d.call(this)
        }, get: function (e) {
            return null != e ? 0 > e ? this[e + this.length] : this[e] : d.call(this)
        }, pushStack: function (e) {
            var t = n.merge(this.constructor(), e);
            return t.prevObject = this, t.context = this.context, t
        }, each: function (e, t) {
            return n.each(this, e, t)
        }, map: function (e) {
            return this.pushStack(n.map(this, function (t, n) {
                return e.call(t, n, t)
            }))
        }, slice: function () {
            return this.pushStack(d.apply(this, arguments))
        }, first: function () {
            return this.eq(0)
        }, last: function () {
            return this.eq(-1)
        }, eq: function (e) {
            var t = this.length, n = +e + (0 > e ? t : 0);
            return this.pushStack(n >= 0 && t > n ? [this[n]] : [])
        }, end: function () {
            return this.prevObject || this.constructor(null)
        }, push: f, sort: c.sort, splice: c.splice
    }, n.extend = n.fn.extend = function () {
        var e, t, r, i, s, o, u = arguments[0] || {}, a = 1, f = arguments.length, l = !1;
        for ("boolean" == typeof u && (l = u, u = arguments[a] || {}, a++), "object" == typeof u || n.isFunction(u) || (u = {}), a === f && (u = this, a--); f > a; a++)if (null != (e = arguments[a]))for (t in e)r = u[t], i = e[t], u !== i && (l && i && (n.isPlainObject(i) || (s = n.isArray(i))) ? (s ? (s = !1, o = r && n.isArray(r) ? r : []) : o = r && n.isPlainObject(r) ? r : {}, u[t] = n.extend(l, o, i)) : void 0 !== i && (u[t] = i));
        return u
    }, n.extend({
        expando: "jQuery" + (m + Math.random()).replace(/\D/g, ""), isReady: !0, error: function (e) {
            throw new Error(e)
        }, noop: function () {
        }, isFunction: function (e) {
            return "function" === n.type(e)
        }, isArray: Array.isArray, isWindow: function (e) {
            return null != e && e === e.window
        }, isNumeric: function (e) {
            return !n.isArray(e) && e - parseFloat(e) + 1 >= 0
        }, isPlainObject: function (e) {
            return "object" !== n.type(e) || e.nodeType || n.isWindow(e) ? !1 : e.constructor && !j.call(e.constructor.prototype, "isPrototypeOf") ? !1 : !0
        }, isEmptyObject: function (e) {
            var t;
            for (t in e)return !1;
            return !0
        }, type: function (e) {
            return null == e ? e + "" : "object" == typeof e || "function" == typeof e ? h[i.call(e)] || "object" : typeof e
        }, globalEval: function (a) {
            var b, c = eval;
            a = n.trim(a), a && (1 === a.indexOf("use strict") ? (b = l.createElement("script"), b.text = a, l.head.appendChild(b).parentNode.removeChild(b)) : c(a))
        }, camelCase: function (e) {
            return e.replace(p, "ms-").replace(q, r)
        }, nodeName: function (e, t) {
            return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase()
        }, each: function (e, t, n) {
            var r, i = 0, o = e.length, u = s(e);
            if (n) {
                if (u) {
                    for (; o > i; i++)if (r = t.apply(e[i], n), r === !1)break
                } else for (i in e)if (r = t.apply(e[i], n), r === !1)break
            } else if (u) {
                for (; o > i; i++)if (r = t.call(e[i], i, e[i]), r === !1)break
            } else for (i in e)if (r = t.call(e[i], i, e[i]), r === !1)break;
            return e
        }, trim: function (e) {
            return null == e ? "" : (e + "").replace(o, "")
        }, makeArray: function (e, t) {
            var r = t || [];
            return null != e && (s(Object(e)) ? n.merge(r, "string" == typeof e ? [e] : e) : f.call(r, e)), r
        }, inArray: function (e, t, n) {
            return null == t ? -1 : g.call(t, e, n)
        }, merge: function (e, t) {
            for (var n = +t.length, r = 0, i = e.length; n > r; r++)e[i++] = t[r];
            return e.length = i, e
        }, grep: function (e, t, n) {
            for (var r, i = [], s = 0, o = e.length, u = !n; o > s; s++)r = !t(e[s], s), r !== u && i.push(e[s]);
            return i
        }, map: function (t, n, r) {
            var i, o = 0, u = t.length, a = s(t), f = [];
            if (a)for (; u > o; o++)i = n(t[o], o, r), null != i && f.push(i); else for (o in t)i = n(t[o], o, r), null != i && f.push(i);
            return e.apply([], f)
        }, guid: 1, proxy: function (e, t) {
            var r, i, s;
            return "string" == typeof t && (r = e[t], t = e, e = r), n.isFunction(e) ? (i = d.call(arguments, 2), s = function () {
                return e.apply(t || this, i.concat(d.call(arguments)))
            }, s.guid = e.guid = e.guid || n.guid++, s) : void 0
        }, now: Date.now, support: k
    }), n.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function (e, t) {
        h["[object " + t + "]"] = t.toLowerCase()
    });
    var t = function (e) {
        function ot(e, t, r, i) {
            var s, u, f, l, c, d, g, y, S, x;
            if ((t ? t.ownerDocument || t : E) !== p && h(t), t = t || p, r = r || [], l = t.nodeType, "string" != typeof e || !e || 1 !== l && 9 !== l && 11 !== l)return r;
            if (!i && v) {
                if (11 !== l && (s = Z.exec(e)))if (f = s[1]) {
                    if (9 === l) {
                        if (u = t.getElementById(f), !u || !u.parentNode)return r;
                        if (u.id === f)return r.push(u), r
                    } else if (t.ownerDocument && (u = t.ownerDocument.getElementById(f)) && b(t, u) && u.id === f)return r.push(u), r
                } else {
                    if (s[2])return D.apply(r, t.getElementsByTagName(e)), r;
                    if ((f = s[3]) && n.getElementsByClassName)return D.apply(r, t.getElementsByClassName(f)), r
                }
                if (n.qsa && (!m || !m.test(e))) {
                    if (y = g = w, S = t, x = 1 !== l && e, 1 === l && "object" !== t.nodeName.toLowerCase()) {
                        d = o(e), (g = t.getAttribute("id")) ? y = g.replace(tt, "\\$&") : t.setAttribute("id", y), y = "[id='" + y + "'] ", c = d.length;
                        while (c--)d[c] = y + gt(d[c]);
                        S = et.test(e) && vt(t.parentNode) || t, x = d.join(",")
                    }
                    if (x)try {
                        return D.apply(r, S.querySelectorAll(x)), r
                    } catch (T) {
                    } finally {
                        g || t.removeAttribute("id")
                    }
                }
            }
            return a(e.replace(z, "$1"), t, r, i)
        }

        function ut() {
            function t(n, i) {
                return e.push(n + " ") > r.cacheLength && delete t[e.shift()], t[n + " "] = i
            }

            var e = [];
            return t
        }

        function at(e) {
            return e[w] = !0, e
        }

        function ft(e) {
            var t = p.createElement("div");
            try {
                return !!e(t)
            } catch (n) {
                return !1
            } finally {
                t.parentNode && t.parentNode.removeChild(t), t = null
            }
        }

        function lt(e, t) {
            var n = e.split("|"), i = e.length;
            while (i--)r.attrHandle[n[i]] = t
        }

        function ct(e, t) {
            var n = t && e, r = n && 1 === e.nodeType && 1 === t.nodeType && (~t.sourceIndex || L) - (~e.sourceIndex || L);
            if (r)return r;
            if (n)while (n = n.nextSibling)if (n === t)return -1;
            return e ? 1 : -1
        }

        function ht(e) {
            return function (t) {
                var n = t.nodeName.toLowerCase();
                return "input" === n && t.type === e
            }
        }

        function pt(e) {
            return function (t) {
                var n = t.nodeName.toLowerCase();
                return ("input" === n || "button" === n) && t.type === e
            }
        }

        function dt(e) {
            return at(function (t) {
                return t = +t, at(function (n, r) {
                    var i, s = e([], n.length, t), o = s.length;
                    while (o--)n[i = s[o]] && (n[i] = !(r[i] = n[i]))
                })
            })
        }

        function vt(e) {
            return e && "undefined" != typeof e.getElementsByTagName && e
        }

        function mt() {
        }

        function gt(e) {
            for (var t = 0, n = e.length, r = ""; n > t; t++)r += e[t].value;
            return r
        }

        function yt(e, t, n) {
            var r = t.dir, i = n && "parentNode" === r, s = x++;
            return t.first ? function (t, n, s) {
                while (t = t[r])if (1 === t.nodeType || i)return e(t, n, s)
            } : function (t, n, o) {
                var u, a, f = [S, s];
                if (o) {
                    while (t = t[r])if ((1 === t.nodeType || i) && e(t, n, o))return !0
                } else while (t = t[r])if (1 === t.nodeType || i) {
                    if (a = t[w] || (t[w] = {}), (u = a[r]) && u[0] === S && u[1] === s)return f[2] = u[2];
                    if (a[r] = f, f[2] = e(t, n, o))return !0
                }
            }
        }

        function bt(e) {
            return e.length > 1 ? function (t, n, r) {
                var i = e.length;
                while (i--)if (!e[i](t, n, r))return !1;
                return !0
            } : e[0]
        }

        function wt(e, t, n) {
            for (var r = 0, i = t.length; i > r; r++)ot(e, t[r], n);
            return n
        }

        function Et(e, t, n, r, i) {
            for (var s, o = [], u = 0, a = e.length, f = null != t; a > u; u++)(s = e[u]) && (!n || n(s, r, i)) && (o.push(s), f && t.push(u));
            return o
        }

        function St(e, t, n, r, i, s) {
            return r && !r[w] && (r = St(r)), i && !i[w] && (i = St(i, s)), at(function (s, o, u, a) {
                var f, l, c, h = [], p = [], d = o.length, v = s || wt(t || "*", u.nodeType ? [u] : u, []), m = !e || !s && t ? v : Et(v, h, e, u, a), g = n ? i || (s ? e : d || r) ? [] : o : m;
                if (n && n(m, g, u, a), r) {
                    f = Et(g, p), r(f, [], u, a), l = f.length;
                    while (l--)(c = f[l]) && (g[p[l]] = !(m[p[l]] = c))
                }
                if (s) {
                    if (i || e) {
                        if (i) {
                            f = [], l = g.length;
                            while (l--)(c = g[l]) && f.push(m[l] = c);
                            i(null, g = [], f, a)
                        }
                        l = g.length;
                        while (l--)(c = g[l]) && (f = i ? H(s, c) : h[l]) > -1 && (s[f] = !(o[f] = c))
                    }
                } else g = Et(g === o ? g.splice(d, g.length) : g), i ? i(null, o, g, a) : D.apply(o, g)
            })
        }

        function xt(e) {
            for (var t, n, i, s = e.length, o = r.relative[e[0].type], u = o || r.relative[" "], a = o ? 1 : 0, l = yt(function (e) {
                return e === t
            }, u, !0), c = yt(function (e) {
                return H(t, e) > -1
            }, u, !0), h = [function (e, n, r) {
                var i = !o && (r || n !== f) || ((t = n).nodeType ? l(e, n, r) : c(e, n, r));
                return t = null, i
            }]; s > a; a++)if (n = r.relative[e[a].type])h = [yt(bt(h), n)]; else {
                if (n = r.filter[e[a].type].apply(null, e[a].matches), n[w]) {
                    for (i = ++a; s > i; i++)if (r.relative[e[i].type])break;
                    return St(a > 1 && bt(h), a > 1 && gt(e.slice(0, a - 1).concat({value: " " === e[a - 2].type ? "*" : ""})).replace(z, "$1"), n, i > a && xt(e.slice(a, i)), s > i && xt(e = e.slice(i)), s > i && gt(e))
                }
                h.push(n)
            }
            return bt(h)
        }

        function Tt(e, t) {
            var n = t.length > 0, i = e.length > 0, s = function (s, o, u, a, l) {
                var c, h, d, v = 0, m = "0", g = s && [], y = [], b = f, w = s || i && r.find.TAG("*", l), E = S += null == b ? 1 : Math.random() || .1, x = w.length;
                for (l && (f = o !== p && o); m !== x && null != (c = w[m]); m++) {
                    if (i && c) {
                        h = 0;
                        while (d = e[h++])if (d(c, o, u)) {
                            a.push(c);
                            break
                        }
                        l && (S = E)
                    }
                    n && ((c = !d && c) && v--, s && g.push(c))
                }
                if (v += m, n && m !== v) {
                    h = 0;
                    while (d = t[h++])d(g, y, o, u);
                    if (s) {
                        if (v > 0)while (m--)g[m] || y[m] || (y[m] = M.call(a));
                        y = Et(y)
                    }
                    D.apply(a, y), l && !s && y.length > 0 && v + t.length > 1 && ot.uniqueSort(a)
                }
                return l && (S = E, f = b), g
            };
            return n ? at(s) : s
        }

        var t, n, r, i, s, o, u, a, f, l, c, h, p, d, v, m, g, y, b, w = "sizzle" + 1 * new Date, E = e.document, S = 0, x = 0, T = ut(), N = ut(), C = ut(), k = function (e, t) {
            return e === t && (c = !0), 0
        }, L = 1 << 31, A = {}.hasOwnProperty, O = [], M = O.pop, _ = O.push, D = O.push, P = O.slice, H = function (e, t) {
            for (var n = 0, r = e.length; r > n; n++)if (e[n] === t)return n;
            return -1
        }, B = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped", j = "[\\x20\\t\\r\\n\\f]", F = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+", I = F.replace("w", "w#"), q = "\\[" + j + "*(" + F + ")(?:" + j + "*([*^$|!~]?=)" + j + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + I + "))|)" + j + "*\\]", R = ":(" + F + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + q + ")*)|.*)\\)|)", U = new RegExp(j + "+", "g"), z = new RegExp("^" + j + "+|((?:^|[^\\\\])(?:\\\\.)*)" + j + "+$", "g"), W = new RegExp("^" + j + "*," + j + "*"), X = new RegExp("^" + j + "*([>+~]|" + j + ")" + j + "*"), V = new RegExp("=" + j + "*([^\\]'\"]*?)" + j + "*\\]", "g"), $ = new RegExp(R), J = new RegExp("^" + I + "$"), K = {
            ID: new RegExp("^#(" + F + ")"),
            CLASS: new RegExp("^\\.(" + F + ")"),
            TAG: new RegExp("^(" + F.replace("w", "w*") + ")"),
            ATTR: new RegExp("^" + q),
            PSEUDO: new RegExp("^" + R),
            CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + j + "*(even|odd|(([+-]|)(\\d*)n|)" + j + "*(?:([+-]|)" + j + "*(\\d+)|))" + j + "*\\)|)", "i"),
            bool: new RegExp("^(?:" + B + ")$", "i"),
            needsContext: new RegExp("^" + j + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + j + "*((?:-\\d)?\\d*)" + j + "*\\)|)(?=[^-]|$)", "i")
        }, Q = /^(?:input|select|textarea|button)$/i, G = /^h\d$/i, Y = /^[^{]+\{\s*\[native \w/, Z = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/, et = /[+~]/, tt = /'|\\/g, nt = new RegExp("\\\\([\\da-f]{1,6}" + j + "?|(" + j + ")|.)", "ig"), rt = function (e, t, n) {
            var r = "0x" + t - 65536;
            return r !== r || n ? t : 0 > r ? String.fromCharCode(r + 65536) : String.fromCharCode(r >> 10 | 55296, 1023 & r | 56320)
        }, it = function () {
            h()
        };
        try {
            D.apply(O = P.call(E.childNodes), E.childNodes), O[E.childNodes.length].nodeType
        } catch (st) {
            D = {
                apply: O.length ? function (e, t) {
                    _.apply(e, P.call(t))
                } : function (e, t) {
                    var n = e.length, r = 0;
                    while (e[n++] = t[r++]);
                    e.length = n - 1
                }
            }
        }
        n = ot.support = {}, s = ot.isXML = function (e) {
            var t = e && (e.ownerDocument || e).documentElement;
            return t ? "HTML" !== t.nodeName : !1
        }, h = ot.setDocument = function (e) {
            var t, i, o = e ? e.ownerDocument || e : E;
            return o !== p && 9 === o.nodeType && o.documentElement ? (p = o, d = o.documentElement, i = o.defaultView, i && i !== i.top && (i.addEventListener ? i.addEventListener("unload", it, !1) : i.attachEvent && i.attachEvent("onunload", it)), v = !s(o), n.attributes = ft(function (e) {
                return e.className = "i", !e.getAttribute("className")
            }), n.getElementsByTagName = ft(function (e) {
                return e.appendChild(o.createComment("")), !e.getElementsByTagName("*").length
            }), n.getElementsByClassName = Y.test(o.getElementsByClassName), n.getById = ft(function (e) {
                return d.appendChild(e).id = w, !o.getElementsByName || !o.getElementsByName(w).length
            }), n.getById ? (r.find.ID = function (e, t) {
                if ("undefined" != typeof t.getElementById && v) {
                    var n = t.getElementById(e);
                    return n && n.parentNode ? [n] : []
                }
            }, r.filter.ID = function (e) {
                var t = e.replace(nt, rt);
                return function (e) {
                    return e.getAttribute("id") === t
                }
            }) : (delete r.find.ID, r.filter.ID = function (e) {
                var t = e.replace(nt, rt);
                return function (e) {
                    var n = "undefined" != typeof e.getAttributeNode && e.getAttributeNode("id");
                    return n && n.value === t
                }
            }), r.find.TAG = n.getElementsByTagName ? function (e, t) {
                return "undefined" != typeof t.getElementsByTagName ? t.getElementsByTagName(e) : n.qsa ? t.querySelectorAll(e) : void 0
            } : function (e, t) {
                var n, r = [], i = 0, s = t.getElementsByTagName(e);
                if ("*" === e) {
                    while (n = s[i++])1 === n.nodeType && r.push(n);
                    return r
                }
                return s
            }, r.find.CLASS = n.getElementsByClassName && function (e, t) {
                    return v ? t.getElementsByClassName(e) : void 0
                }, g = [], m = [], (n.qsa = Y.test(o.querySelectorAll)) && (ft(function (e) {
                d.appendChild(e).innerHTML = "<a id='" + w + "'></a><select id='" + w + "-\f]' msallowcapture=''><option selected=''></option></select>", e.querySelectorAll("[msallowcapture^='']").length && m.push("[*^$]=" + j + "*(?:''|\"\")"), e.querySelectorAll("[selected]").length || m.push("\\[" + j + "*(?:value|" + B + ")"), e.querySelectorAll("[id~=" + w + "-]").length || m.push("~="), e.querySelectorAll(":checked").length || m.push(":checked"), e.querySelectorAll("a#" + w + "+*").length || m.push(".#.+[+~]")
            }), ft(function (e) {
                var t = o.createElement("input");
                t.setAttribute("type", "hidden"), e.appendChild(t).setAttribute("name", "D"), e.querySelectorAll("[name=d]").length && m.push("name" + j + "*[*^$|!~]?="), e.querySelectorAll(":enabled").length || m.push(":enabled", ":disabled"), e.querySelectorAll("*,:x"), m.push(",.*:")
            })), (n.matchesSelector = Y.test(y = d.matches || d.webkitMatchesSelector || d.mozMatchesSelector || d.oMatchesSelector || d.msMatchesSelector)) && ft(function (e) {
                n.disconnectedMatch = y.call(e, "div"), y.call(e, "[s!='']:x"), g.push("!=", R)
            }), m = m.length && new RegExp(m.join("|")), g = g.length && new RegExp(g.join("|")), t = Y.test(d.compareDocumentPosition), b = t || Y.test(d.contains) ? function (e, t) {
                var n = 9 === e.nodeType ? e.documentElement : e, r = t && t.parentNode;
                return e === r || !!r && 1 === r.nodeType && !!(n.contains ? n.contains(r) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(r))
            } : function (e, t) {
                if (t)while (t = t.parentNode)if (t === e)return !0;
                return !1
            }, k = t ? function (e, t) {
                if (e === t)return c = !0, 0;
                var r = !e.compareDocumentPosition - !t.compareDocumentPosition;
                return r ? r : (r = (e.ownerDocument || e) === (t.ownerDocument || t) ? e.compareDocumentPosition(t) : 1, 1 & r || !n.sortDetached && t.compareDocumentPosition(e) === r ? e === o || e.ownerDocument === E && b(E, e) ? -1 : t === o || t.ownerDocument === E && b(E, t) ? 1 : l ? H(l, e) - H(l, t) : 0 : 4 & r ? -1 : 1)
            } : function (e, t) {
                if (e === t)return c = !0, 0;
                var n, r = 0, i = e.parentNode, s = t.parentNode, u = [e], a = [t];
                if (!i || !s)return e === o ? -1 : t === o ? 1 : i ? -1 : s ? 1 : l ? H(l, e) - H(l, t) : 0;
                if (i === s)return ct(e, t);
                n = e;
                while (n = n.parentNode)u.unshift(n);
                n = t;
                while (n = n.parentNode)a.unshift(n);
                while (u[r] === a[r])r++;
                return r ? ct(u[r], a[r]) : u[r] === E ? -1 : a[r] === E ? 1 : 0
            }, o) : p
        }, ot.matches = function (e, t) {
            return ot(e, null, null, t)
        }, ot.matchesSelector = function (e, t) {
            if ((e.ownerDocument || e) !== p && h(e), t = t.replace(V, "='$1']"), !(!n.matchesSelector || !v || g && g.test(t) || m && m.test(t)))try {
                var r = y.call(e, t);
                if (r || n.disconnectedMatch || e.document && 11 !== e.document.nodeType)return r
            } catch (i) {
            }
            return ot(t, p, null, [e]).length > 0
        }, ot.contains = function (e, t) {
            return (e.ownerDocument || e) !== p && h(e), b(e, t)
        }, ot.attr = function (e, t) {
            (e.ownerDocument || e) !== p && h(e);
            var i = r.attrHandle[t.toLowerCase()], s = i && A.call(r.attrHandle, t.toLowerCase()) ? i(e, t, !v) : void 0;
            return void 0 !== s ? s : n.attributes || !v ? e.getAttribute(t) : (s = e.getAttributeNode(t)) && s.specified ? s.value : null
        }, ot.error = function (e) {
            throw new Error("Syntax error, unrecognized expression: " + e)
        }, ot.uniqueSort = function (e) {
            var t, r = [], i = 0, s = 0;
            if (c = !n.detectDuplicates, l = !n.sortStable && e.slice(0), e.sort(k), c) {
                while (t = e[s++])t === e[s] && (i = r.push(s));
                while (i--)e.splice(r[i], 1)
            }
            return l = null, e
        }, i = ot.getText = function (e) {
            var t, n = "", r = 0, s = e.nodeType;
            if (s) {
                if (1 === s || 9 === s || 11 === s) {
                    if ("string" == typeof e.textContent)return e.textContent;
                    for (e = e.firstChild; e; e = e.nextSibling)n += i(e)
                } else if (3 === s || 4 === s)return e.nodeValue
            } else while (t = e[r++])n += i(t);
            return n
        }, r = ot.selectors = {
            cacheLength: 50,
            createPseudo: at,
            match: K,
            attrHandle: {},
            find: {},
            relative: {
                ">": {dir: "parentNode", first: !0},
                " ": {dir: "parentNode"},
                "+": {dir: "previousSibling", first: !0},
                "~": {dir: "previousSibling"}
            },
            preFilter: {
                ATTR: function (e) {
                    return e[1] = e[1].replace(nt, rt), e[3] = (e[3] || e[4] || e[5] || "").replace(nt, rt), "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4)
                }, CHILD: function (e) {
                    return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || ot.error(e[0]), e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && ot.error(e[0]), e
                }, PSEUDO: function (e) {
                    var t, n = !e[6] && e[2];
                    return K.CHILD.test(e[0]) ? null : (e[3] ? e[2] = e[4] || e[5] || "" : n && $.test(n) && (t = o(n, !0)) && (t = n.indexOf(")", n.length - t) - n.length) && (e[0] = e[0].slice(0, t), e[2] = n.slice(0, t)), e.slice(0, 3))
                }
            },
            filter: {
                TAG: function (e) {
                    var t = e.replace(nt, rt).toLowerCase();
                    return "*" === e ? function () {
                        return !0
                    } : function (e) {
                        return e.nodeName && e.nodeName.toLowerCase() === t
                    }
                }, CLASS: function (e) {
                    var t = T[e + " "];
                    return t || (t = new RegExp("(^|" + j + ")" + e + "(" + j + "|$)")) && T(e, function (e) {
                            return t.test("string" == typeof e.className && e.className || "undefined" != typeof e.getAttribute && e.getAttribute("class") || "")
                        })
                }, ATTR: function (e, t, n) {
                    return function (r) {
                        var i = ot.attr(r, e);
                        return null == i ? "!=" === t : t ? (i += "", "=" === t ? i === n : "!=" === t ? i !== n : "^=" === t ? n && 0 === i.indexOf(n) : "*=" === t ? n && i.indexOf(n) > -1 : "$=" === t ? n && i.slice(-n.length) === n : "~=" === t ? (" " + i.replace(U, " ") + " ").indexOf(n) > -1 : "|=" === t ? i === n || i.slice(0, n.length + 1) === n + "-" : !1) : !0
                    }
                }, CHILD: function (e, t, n, r, i) {
                    var s = "nth" !== e.slice(0, 3), o = "last" !== e.slice(-4), u = "of-type" === t;
                    return 1 === r && 0 === i ? function (e) {
                        return !!e.parentNode
                    } : function (t, n, a) {
                        var f, l, c, h, p, d, v = s !== o ? "nextSibling" : "previousSibling", m = t.parentNode, g = u && t.nodeName.toLowerCase(), y = !a && !u;
                        if (m) {
                            if (s) {
                                while (v) {
                                    c = t;
                                    while (c = c[v])if (u ? c.nodeName.toLowerCase() === g : 1 === c.nodeType)return !1;
                                    d = v = "only" === e && !d && "nextSibling"
                                }
                                return !0
                            }
                            if (d = [o ? m.firstChild : m.lastChild], o && y) {
                                l = m[w] || (m[w] = {}), f = l[e] || [], p = f[0] === S && f[1], h = f[0] === S && f[2], c = p && m.childNodes[p];
                                while (c = ++p && c && c[v] || (h = p = 0) || d.pop())if (1 === c.nodeType && ++h && c === t) {
                                    l[e] = [S, p, h];
                                    break
                                }
                            } else if (y && (f = (t[w] || (t[w] = {}))[e]) && f[0] === S)h = f[1]; else while (c = ++p && c && c[v] || (h = p = 0) || d.pop())if ((u ? c.nodeName.toLowerCase() === g : 1 === c.nodeType) && ++h && (y && ((c[w] || (c[w] = {}))[e] = [S, h]), c === t))break;
                            return h -= i, h === r || h % r === 0 && h / r >= 0
                        }
                    }
                }, PSEUDO: function (e, t) {
                    var n, i = r.pseudos[e] || r.setFilters[e.toLowerCase()] || ot.error("unsupported pseudo: " + e);
                    return i[w] ? i(t) : i.length > 1 ? (n = [e, e, "", t], r.setFilters.hasOwnProperty(e.toLowerCase()) ? at(function (e, n) {
                        var r, s = i(e, t), o = s.length;
                        while (o--)r = H(e, s[o]), e[r] = !(n[r] = s[o])
                    }) : function (e) {
                        return i(e, 0, n)
                    }) : i
                }
            },
            pseudos: {
                not: at(function (e) {
                    var t = [], n = [], r = u(e.replace(z, "$1"));
                    return r[w] ? at(function (e, t, n, i) {
                        var s, o = r(e, null, i, []), u = e.length;
                        while (u--)(s = o[u]) && (e[u] = !(t[u] = s))
                    }) : function (e, i, s) {
                        return t[0] = e, r(t, null, s, n), t[0] = null, !n.pop()
                    }
                }), has: at(function (e) {
                    return function (t) {
                        return ot(e, t).length > 0
                    }
                }), contains: at(function (e) {
                    return e = e.replace(nt, rt), function (t) {
                        return (t.textContent || t.innerText || i(t)).indexOf(e) > -1
                    }
                }), lang: at(function (e) {
                    return J.test(e || "") || ot.error("unsupported lang: " + e), e = e.replace(nt, rt).toLowerCase(), function (t) {
                        var n;
                        do if (n = v ? t.lang : t.getAttribute("xml:lang") || t.getAttribute("lang"))return n = n.toLowerCase(), n === e || 0 === n.indexOf(e + "-"); while ((t = t.parentNode) && 1 === t.nodeType);
                        return !1
                    }
                }), target: function (t) {
                    var n = e.location && e.location.hash;
                    return n && n.slice(1) === t.id
                }, root: function (e) {
                    return e === d
                }, focus: function (e) {
                    return e === p.activeElement && (!p.hasFocus || p.hasFocus()) && !!(e.type || e.href || ~e.tabIndex)
                }, enabled: function (e) {
                    return e.disabled === !1
                }, disabled: function (e) {
                    return e.disabled === !0
                }, checked: function (e) {
                    var t = e.nodeName.toLowerCase();
                    return "input" === t && !!e.checked || "option" === t && !!e.selected
                }, selected: function (e) {
                    return e.parentNode && e.parentNode.selectedIndex, e.selected === !0
                }, empty: function (e) {
                    for (e = e.firstChild; e; e = e.nextSibling)if (e.nodeType < 6)return !1;
                    return !0
                }, parent: function (e) {
                    return !r.pseudos.empty(e)
                }, header: function (e) {
                    return G.test(e.nodeName)
                }, input: function (e) {
                    return Q.test(e.nodeName)
                }, button: function (e) {
                    var t = e.nodeName.toLowerCase();
                    return "input" === t && "button" === e.type || "button" === t
                }, text: function (e) {
                    var t;
                    return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || "text" === t.toLowerCase())
                }, first: dt(function () {
                    return [0]
                }), last: dt(function (e, t) {
                    return [t - 1]
                }), eq: dt(function (e, t, n) {
                    return [0 > n ? n + t : n]
                }), even: dt(function (e, t) {
                    for (var n = 0; t > n; n += 2)e.push(n);
                    return e
                }), odd: dt(function (e, t) {
                    for (var n = 1; t > n; n += 2)e.push(n);
                    return e
                }), lt: dt(function (e, t, n) {
                    for (var r = 0 > n ? n + t : n; --r >= 0;)e.push(r);
                    return e
                }), gt: dt(function (e, t, n) {
                    for (var r = 0 > n ? n + t : n; ++r < t;)e.push(r);
                    return e
                })
            }
        }, r.pseudos.nth = r.pseudos.eq;
        for (t in{radio: !0, checkbox: !0, file: !0, password: !0, image: !0})r.pseudos[t] = ht(t);
        for (t in{submit: !0, reset: !0})r.pseudos[t] = pt(t);
        return mt.prototype = r.filters = r.pseudos, r.setFilters = new mt, o = ot.tokenize = function (e, t) {
            var n, i, s, o, u, a, f, l = N[e + " "];
            if (l)return t ? 0 : l.slice(0);
            u = e, a = [], f = r.preFilter;
            while (u) {
                (!n || (i = W.exec(u))) && (i && (u = u.slice(i[0].length) || u), a.push(s = [])), n = !1, (i = X.exec(u)) && (n = i.shift(), s.push({
                    value: n,
                    type: i[0].replace(z, " ")
                }), u = u.slice(n.length));
                for (o in r.filter)!(i = K[o].exec(u)) || f[o] && !(i = f[o](i)) || (n = i.shift(), s.push({
                    value: n,
                    type: o,
                    matches: i
                }), u = u.slice(n.length));
                if (!n)break
            }
            return t ? u.length : u ? ot.error(e) : N(e, a).slice(0)
        }, u = ot.compile = function (e, t) {
            var n, r = [], i = [], s = C[e + " "];
            if (!s) {
                t || (t = o(e)), n = t.length;
                while (n--)s = xt(t[n]), s[w] ? r.push(s) : i.push(s);
                s = C(e, Tt(i, r)), s.selector = e
            }
            return s
        }, a = ot.select = function (e, t, i, s) {
            var a, f, l, c, h, p = "function" == typeof e && e, d = !s && o(e = p.selector || e);
            if (i = i || [], 1 === d.length) {
                if (f = d[0] = d[0].slice(0), f.length > 2 && "ID" === (l = f[0]).type && n.getById && 9 === t.nodeType && v && r.relative[f[1].type]) {
                    if (t = (r.find.ID(l.matches[0].replace(nt, rt), t) || [])[0], !t)return i;
                    p && (t = t.parentNode), e = e.slice(f.shift().value.length)
                }
                a = K.needsContext.test(e) ? 0 : f.length;
                while (a--) {
                    if (l = f[a], r.relative[c = l.type])break;
                    if ((h = r.find[c]) && (s = h(l.matches[0].replace(nt, rt), et.test(f[0].type) && vt(t.parentNode) || t))) {
                        if (f.splice(a, 1), e = s.length && gt(f), !e)return D.apply(i, s), i;
                        break
                    }
                }
            }
            return (p || u(e, d))(s, t, !v, i, et.test(e) && vt(t.parentNode) || t), i
        }, n.sortStable = w.split("").sort(k).join("") === w, n.detectDuplicates = !!c, h(), n.sortDetached = ft(function (e) {
            return 1 & e.compareDocumentPosition(p.createElement("div"))
        }), ft(function (e) {
            return e.innerHTML = "<a href='#'></a>", "#" === e.firstChild.getAttribute("href")
        }) || lt("type|href|height|width", function (e, t, n) {
            return n ? void 0 : e.getAttribute(t, "type" === t.toLowerCase() ? 1 : 2)
        }), n.attributes && ft(function (e) {
            return e.innerHTML = "<input/>", e.firstChild.setAttribute("value", ""), "" === e.firstChild.getAttribute("value")
        }) || lt("value", function (e, t, n) {
            return n || "input" !== e.nodeName.toLowerCase() ? void 0 : e.defaultValue
        }), ft(function (e) {
            return null == e.getAttribute("disabled")
        }) || lt(B, function (e, t, n) {
            var r;
            return n ? void 0 : e[t] === !0 ? t.toLowerCase() : (r = e.getAttributeNode(t)) && r.specified ? r.value : null
        }), ot
    }(a);
    n.find = t, n.expr = t.selectors, n.expr[":"] = n.expr.pseudos, n.unique = t.uniqueSort, n.text = t.getText, n.isXMLDoc = t.isXML, n.contains = t.contains;
    var u = n.expr.match.needsContext, v = /^<(\w+)\s*\/?>(?:<\/\1>|)$/, w = /^.[^:#\[\.,]*$/;
    n.filter = function (e, t, r) {
        var i = t[0];
        return r && (e = ":not(" + e + ")"), 1 === t.length && 1 === i.nodeType ? n.find.matchesSelector(i, e) ? [i] : [] : n.find.matches(e, n.grep(t, function (e) {
            return 1 === e.nodeType
        }))
    }, n.fn.extend({
        find: function (e) {
            var t, r = this.length, i = [], s = this;
            if ("string" != typeof e)return this.pushStack(n(e).filter(function () {
                for (t = 0; r > t; t++)if (n.contains(s[t], this))return !0
            }));
            for (t = 0; r > t; t++)n.find(e, s[t], i);
            return i = this.pushStack(r > 1 ? n.unique(i) : i), i.selector = this.selector ? this.selector + " " + e : e, i
        }, filter: function (e) {
            return this.pushStack(x(this, e || [], !1))
        }, not: function (e) {
            return this.pushStack(x(this, e || [], !0))
        }, is: function (e) {
            return !!x(this, "string" == typeof e && u.test(e) ? n(e) : e || [], !1).length
        }
    });
    var y, z = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/, A = n.fn.init = function (e, t) {
        var r, i;
        if (!e)return this;
        if ("string" == typeof e) {
            if (r = "<" === e[0] && ">" === e[e.length - 1] && e.length >= 3 ? [null, e, null] : z.exec(e), !r || !r[1] && t)return !t || t.jquery ? (t || y).find(e) : this.constructor(t).find(e);
            if (r[1]) {
                if (t = t instanceof n ? t[0] : t, n.merge(this, n.parseHTML(r[1], t && t.nodeType ? t.ownerDocument || t : l, !0)), v.test(r[1]) && n.isPlainObject(t))for (r in t)n.isFunction(this[r]) ? this[r](t[r]) : this.attr(r, t[r]);
                return this
            }
            return i = l.getElementById(r[2]), i && i.parentNode && (this.length = 1, this[0] = i), this.context = l, this.selector = e, this
        }
        return e.nodeType ? (this.context = this[0] = e, this.length = 1, this) : n.isFunction(e) ? "undefined" != typeof y.ready ? y.ready(e) : e(n) : (void 0 !== e.selector && (this.selector = e.selector, this.context = e.context), n.makeArray(e, this))
    };
    A.prototype = n.fn, y = n(l);
    var B = /^(?:parents|prev(?:Until|All))/, C = {children: !0, contents: !0, next: !0, prev: !0};
    n.extend({
        dir: function (e, t, r) {
            var i = [], s = void 0 !== r;
            while ((e = e[t]) && 9 !== e.nodeType)if (1 === e.nodeType) {
                if (s && n(e).is(r))break;
                i.push(e)
            }
            return i
        }, sibling: function (e, t) {
            for (var n = []; e; e = e.nextSibling)1 === e.nodeType && e !== t && n.push(e);
            return n
        }
    }), n.fn.extend({
        has: function (e) {
            var t = n(e, this), r = t.length;
            return this.filter(function () {
                for (var e = 0; r > e; e++)if (n.contains(this, t[e]))return !0
            })
        }, closest: function (e, t) {
            for (var r, i = 0, s = this.length, o = [], a = u.test(e) || "string" != typeof e ? n(e, t || this.context) : 0; s > i; i++)for (r = this[i]; r && r !== t; r = r.parentNode)if (r.nodeType < 11 && (a ? a.index(r) > -1 : 1 === r.nodeType && n.find.matchesSelector(r, e))) {
                o.push(r);
                break
            }
            return this.pushStack(o.length > 1 ? n.unique(o) : o)
        }, index: function (e) {
            return e ? "string" == typeof e ? g.call(n(e), this[0]) : g.call(this, e.jquery ? e[0] : e) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
        }, add: function (e, t) {
            return this.pushStack(n.unique(n.merge(this.get(), n(e, t))))
        }, addBack: function (e) {
            return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
        }
    }), n.each({
        parent: function (e) {
            var t = e.parentNode;
            return t && 11 !== t.nodeType ? t : null
        }, parents: function (e) {
            return n.dir(e, "parentNode")
        }, parentsUntil: function (e, t, r) {
            return n.dir(e, "parentNode", r)
        }, next: function (e) {
            return D(e, "nextSibling")
        }, prev: function (e) {
            return D(e, "previousSibling")
        }, nextAll: function (e) {
            return n.dir(e, "nextSibling")
        }, prevAll: function (e) {
            return n.dir(e, "previousSibling")
        }, nextUntil: function (e, t, r) {
            return n.dir(e, "nextSibling", r)
        }, prevUntil: function (e, t, r) {
            return n.dir(e, "previousSibling", r)
        }, siblings: function (e) {
            return n.sibling((e.parentNode || {}).firstChild, e)
        }, children: function (e) {
            return n.sibling(e.firstChild)
        }, contents: function (e) {
            return e.contentDocument || n.merge([], e.childNodes)
        }
    }, function (e, t) {
        n.fn[e] = function (r, i) {
            var s = n.map(this, t, r);
            return "Until" !== e.slice(-5) && (i = r), i && "string" == typeof i && (s = n.filter(i, s)), this.length > 1 && (C[e] || n.unique(s), B.test(e) && s.reverse()), this.pushStack(s)
        }
    });
    var E = /\S+/g, F = {};
    n.Callbacks = function (e) {
        e = "string" == typeof e ? F[e] || G(e) : n.extend({}, e);
        var t, r, i, s, o, u, a = [], f = !e.once && [], l = function (n) {
            for (t = e.memory && n, r = !0, u = s || 0, s = 0, o = a.length, i = !0; a && o > u; u++)if (a[u].apply(n[0], n[1]) === !1 && e.stopOnFalse) {
                t = !1;
                break
            }
            i = !1, a && (f ? f.length && l(f.shift()) : t ? a = [] : c.disable())
        }, c = {
            add: function () {
                if (a) {
                    var r = a.length;
                    !function u(t) {
                        n.each(t, function (t, r) {
                            var i = n.type(r);
                            "function" === i ? e.unique && c.has(r) || a.push(r) : r && r.length && "string" !== i && u(r)
                        })
                    }(arguments), i ? o = a.length : t && (s = r, l(t))
                }
                return this
            }, remove: function () {
                return a && n.each(arguments, function (e, t) {
                    var r;
                    while ((r = n.inArray(t, a, r)) > -1)a.splice(r, 1), i && (o >= r && o--, u >= r && u--)
                }), this
            }, has: function (e) {
                return e ? n.inArray(e, a) > -1 : !!a && !!a.length
            }, empty: function () {
                return a = [], o = 0, this
            }, disable: function () {
                return a = f = t = void 0, this
            }, disabled: function () {
                return !a
            }, lock: function () {
                return f = void 0, t || c.disable(), this
            }, locked: function () {
                return !f
            }, fireWith: function (e, t) {
                return !a || r && !f || (t = t || [], t = [e, t.slice ? t.slice() : t], i ? f.push(t) : l(t)), this
            }, fire: function () {
                return c.fireWith(this, arguments), this
            }, fired: function () {
                return !!r
            }
        };
        return c
    }, n.extend({
        Deferred: function (e) {
            var t = [["resolve", "done", n.Callbacks("once memory"), "resolved"], ["reject", "fail", n.Callbacks("once memory"), "rejected"], ["notify", "progress", n.Callbacks("memory")]], r = "pending", i = {
                state: function () {
                    return r
                }, always: function () {
                    return s.done(arguments).fail(arguments), this
                }, then: function () {
                    var e = arguments;
                    return n.Deferred(function (r) {
                        n.each(t, function (t, o) {
                            var u = n.isFunction(e[t]) && e[t];
                            s[o[1]](function () {
                                var e = u && u.apply(this, arguments);
                                e && n.isFunction(e.promise) ? e.promise().done(r.resolve).fail(r.reject).progress(r.notify) : r[o[0] + "With"](this === i ? r.promise() : this, u ? [e] : arguments)
                            })
                        }), e = null
                    }).promise()
                }, promise: function (e) {
                    return null != e ? n.extend(e, i) : i
                }
            }, s = {};
            return i.pipe = i.then, n.each(t, function (e, n) {
                var o = n[2], u = n[3];
                i[n[1]] = o.add, u && o.add(function () {
                    r = u
                }, t[1 ^ e][2].disable, t[2][2].lock), s[n[0]] = function () {
                    return s[n[0] + "With"](this === s ? i : this, arguments), this
                }, s[n[0] + "With"] = o.fireWith
            }), i.promise(s), e && e.call(s, s), s
        }, when: function (e) {
            var t = 0, r = d.call(arguments), i = r.length, s = 1 !== i || e && n.isFunction(e.promise) ? i : 0, o = 1 === s ? e : n.Deferred(), u = function (e, t, n) {
                return function (r) {
                    t[e] = this, n[e] = arguments.length > 1 ? d.call(arguments) : r, n === a ? o.notifyWith(t, n) : --s || o.resolveWith(t, n)
                }
            }, a, f, l;
            if (i > 1)for (a = new Array(i), f = new Array(i), l = new Array(i); i > t; t++)r[t] && n.isFunction(r[t].promise) ? r[t].promise().done(u(t, l, r)).fail(o.reject).progress(u(t, f, a)) : --s;
            return s || o.resolveWith(l, r), o.promise()
        }
    });
    var H;
    n.fn.ready = function (e) {
        return n.ready.promise().done(e), this
    }, n.extend({
        isReady: !1, readyWait: 1, holdReady: function (e) {
            e ? n.readyWait++ : n.ready(!0)
        }, ready: function (e) {
            (e === !0 ? --n.readyWait : n.isReady) || (n.isReady = !0, e !== !0 && --n.readyWait > 0 || (H.resolveWith(l, [n]), n.fn.triggerHandler && (n(l).triggerHandler("ready"), n(l).off("ready"))))
        }
    }), n.ready.promise = function (e) {
        return H || (H = n.Deferred(), "complete" === l.readyState ? setTimeout(n.ready) : (l.addEventListener("DOMContentLoaded", I, !1), a.addEventListener("load", I, !1))), H.promise(e)
    }, n.ready.promise();
    var J = n.access = function (e, t, r, i, s, o, u) {
        var a = 0, f = e.length, l = null == r;
        if ("object" === n.type(r)) {
            s = !0;
            for (a in r)n.access(e, t, a, r[a], !0, o, u)
        } else if (void 0 !== i && (s = !0, n.isFunction(i) || (u = !0), l && (u ? (t.call(e, i), t = null) : (l = t, t = function (e, t, r) {
                return l.call(n(e), r)
            })), t))for (; f > a; a++)t(e[a], r, u ? i : i.call(e[a], a, t(e[a], r)));
        return s ? e : l ? t.call(e) : f ? t(e[0], r) : o
    };
    n.acceptData = function (e) {
        return 1 === e.nodeType || 9 === e.nodeType || !+e.nodeType
    }, K.uid = 1, K.accepts = n.acceptData, K.prototype = {
        key: function (e) {
            if (!K.accepts(e))return 0;
            var t = {}, r = e[this.expando];
            if (!r) {
                r = K.uid++;
                try {
                    t[this.expando] = {value: r}, Object.defineProperties(e, t)
                } catch (i) {
                    t[this.expando] = r, n.extend(e, t)
                }
            }
            return this.cache[r] || (this.cache[r] = {}), r
        }, set: function (e, t, r) {
            var i, s = this.key(e), o = this.cache[s];
            if ("string" == typeof t)o[t] = r; else if (n.isEmptyObject(o))n.extend(this.cache[s], t); else for (i in t)o[i] = t[i];
            return o
        }, get: function (e, t) {
            var n = this.cache[this.key(e)];
            return void 0 === t ? n : n[t]
        }, access: function (e, t, r) {
            var i;
            return void 0 === t || t && "string" == typeof t && void 0 === r ? (i = this.get(e, t), void 0 !== i ? i : this.get(e, n.camelCase(t))) : (this.set(e, t, r), void 0 !== r ? r : t)
        }, remove: function (e, t) {
            var r, i, s, o = this.key(e), u = this.cache[o];
            if (void 0 === t)this.cache[o] = {}; else {
                n.isArray(t) ? i = t.concat(t.map(n.camelCase)) : (s = n.camelCase(t), t in u ? i = [t, s] : (i = s, i = i in u ? [i] : i.match(E) || [])), r = i.length;
                while (r--)delete u[i[r]]
            }
        }, hasData: function (e) {
            return !n.isEmptyObject(this.cache[e[this.expando]] || {})
        }, discard: function (e) {
            e[this.expando] && delete this.cache[e[this.expando]]
        }
    };
    var L = new K, M = new K, N = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/, O = /([A-Z])/g;
    n.extend({
        hasData: function (e) {
            return M.hasData(e) || L.hasData(e)
        }, data: function (e, t, n) {
            return M.access(e, t, n)
        }, removeData: function (e, t) {
            M.remove(e, t)
        }, _data: function (e, t, n) {
            return L.access(e, t, n)
        }, _removeData: function (e, t) {
            L.remove(e, t)
        }
    }), n.fn.extend({
        data: function (e, t) {
            var r, i, s, o = this[0], u = o && o.attributes;
            if (void 0 === e) {
                if (this.length && (s = M.get(o), 1 === o.nodeType && !L.get(o, "hasDataAttrs"))) {
                    r = u.length;
                    while (r--)u[r] && (i = u[r].name, 0 === i.indexOf("data-") && (i = n.camelCase(i.slice(5)), P(o, i, s[i])));
                    L.set(o, "hasDataAttrs", !0)
                }
                return s
            }
            return "object" == typeof e ? this.each(function () {
                M.set(this, e)
            }) : J(this, function (t) {
                var r, i = n.camelCase(e);
                if (o && void 0 === t) {
                    if (r = M.get(o, e), void 0 !== r)return r;
                    if (r = M.get(o, i), void 0 !== r)return r;
                    if (r = P(o, i, void 0), void 0 !== r)return r
                } else this.each(function () {
                    var n = M.get(this, i);
                    M.set(this, i, t), -1 !== e.indexOf("-") && void 0 !== n && M.set(this, e, t)
                })
            }, null, t, arguments.length > 1, null, !0)
        }, removeData: function (e) {
            return this.each(function () {
                M.remove(this, e)
            })
        }
    }), n.extend({
        queue: function (e, t, r) {
            var i;
            return e ? (t = (t || "fx") + "queue", i = L.get(e, t), r && (!i || n.isArray(r) ? i = L.access(e, t, n.makeArray(r)) : i.push(r)), i || []) : void 0
        }, dequeue: function (e, t) {
            t = t || "fx";
            var r = n.queue(e, t), i = r.length, s = r.shift(), o = n._queueHooks(e, t), u = function () {
                n.dequeue(e, t)
            };
            "inprogress" === s && (s = r.shift(), i--), s && ("fx" === t && r.unshift("inprogress"), delete o.stop, s.call(e, u, o)), !i && o && o.empty.fire()
        }, _queueHooks: function (e, t) {
            var r = t + "queueHooks";
            return L.get(e, r) || L.access(e, r, {
                    empty: n.Callbacks("once memory").add(function () {
                        L.remove(e, [t + "queue", r])
                    })
                })
        }
    }), n.fn.extend({
        queue: function (e, t) {
            var r = 2;
            return "string" != typeof e && (t = e, e = "fx", r--), arguments.length < r ? n.queue(this[0], e) : void 0 === t ? this : this.each(function () {
                var r = n.queue(this, e, t);
                n._queueHooks(this, e), "fx" === e && "inprogress" !== r[0] && n.dequeue(this, e)
            })
        }, dequeue: function (e) {
            return this.each(function () {
                n.dequeue(this, e)
            })
        }, clearQueue: function (e) {
            return this.queue(e || "fx", [])
        }, promise: function (e, t) {
            var r, i = 1, s = n.Deferred(), o = this, u = this.length, a = function () {
                --i || s.resolveWith(o, [o])
            };
            "string" != typeof e && (t = e, e = void 0), e = e || "fx";
            while (u--)r = L.get(o[u], e + "queueHooks"), r && r.empty && (i++, r.empty.add(a));
            return a(), s.promise(t)
        }
    });
    var Q = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source, R = ["Top", "Right", "Bottom", "Left"], S = function (e, t) {
        return e = t || e, "none" === n.css(e, "display") || !n.contains(e.ownerDocument, e)
    }, T = /^(?:checkbox|radio)$/i;
    !function () {
        var e = l.createDocumentFragment(), t = e.appendChild(l.createElement("div")), n = l.createElement("input");
        n.setAttribute("type", "radio"), n.setAttribute("checked", "checked"), n.setAttribute("name", "t"), t.appendChild(n), k.checkClone = t.cloneNode(!0).cloneNode(!0).lastChild.checked, t.innerHTML = "<textarea>x</textarea>", k.noCloneChecked = !!t.cloneNode(!0).lastChild.defaultValue
    }();
    var U = "undefined";
    k.focusinBubbles = "onfocusin" in a;
    var V = /^key/, W = /^(?:mouse|pointer|contextmenu)|click/, X = /^(?:focusinfocus|focusoutblur)$/, Y = /^([^.]*)(?:\.(.+)|)$/;
    n.event = {
        global: {},
        add: function (e, t, r, i, s) {
            var o, u, a, f, l, c, h, p, d, v, m, g = L.get(e);
            if (g) {
                r.handler && (o = r, r = o.handler, s = o.selector), r.guid || (r.guid = n.guid++), (f = g.events) || (f = g.events = {}), (u = g.handle) || (u = g.handle = function (t) {
                    return typeof n !== U && n.event.triggered !== t.type ? n.event.dispatch.apply(e, arguments) : void 0
                }), t = (t || "").match(E) || [""], l = t.length;
                while (l--)a = Y.exec(t[l]) || [], d = m = a[1], v = (a[2] || "").split(".").sort(), d && (h = n.event.special[d] || {}, d = (s ? h.delegateType : h.bindType) || d, h = n.event.special[d] || {}, c = n.extend({
                    type: d,
                    origType: m,
                    data: i,
                    handler: r,
                    guid: r.guid,
                    selector: s,
                    needsContext: s && n.expr.match.needsContext.test(s),
                    namespace: v.join(".")
                }, o), (p = f[d]) || (p = f[d] = [], p.delegateCount = 0, h.setup && h.setup.call(e, i, v, u) !== !1 || e.addEventListener && e.addEventListener(d, u, !1)), h.add && (h.add.call(e, c), c.handler.guid || (c.handler.guid = r.guid)), s ? p.splice(p.delegateCount++, 0, c) : p.push(c), n.event.global[d] = !0)
            }
        },
        remove: function (e, t, r, i, s) {
            var o, u, a, f, l, c, h, p, d, v, m, g = L.hasData(e) && L.get(e);
            if (g && (f = g.events)) {
                t = (t || "").match(E) || [""], l = t.length;
                while (l--)if (a = Y.exec(t[l]) || [], d = m = a[1], v = (a[2] || "").split(".").sort(), d) {
                    h = n.event.special[d] || {}, d = (i ? h.delegateType : h.bindType) || d, p = f[d] || [], a = a[2] && new RegExp("(^|\\.)" + v.join("\\.(?:.*\\.|)") + "(\\.|$)"), u = o = p.length;
                    while (o--)c = p[o], !s && m !== c.origType || r && r.guid !== c.guid || a && !a.test(c.namespace) || i && i !== c.selector && ("**" !== i || !c.selector) || (p.splice(o, 1), c.selector && p.delegateCount--, h.remove && h.remove.call(e, c));
                    u && !p.length && (h.teardown && h.teardown.call(e, v, g.handle) !== !1 || n.removeEvent(e, d, g.handle), delete f[d])
                } else for (d in f)n.event.remove(e, d + t[l], r, i, !0);
                n.isEmptyObject(f) && (delete g.handle, L.remove(e, "events"))
            }
        },
        trigger: function (e, t, r, i) {
            var s, o, u, f, c, h, p, d = [r || l], v = j.call(e, "type") ? e.type : e, m = j.call(e, "namespace") ? e.namespace.split(".") : [];
            if (o = u = r = r || l, 3 !== r.nodeType && 8 !== r.nodeType && !X.test(v + n.event.triggered) && (v.indexOf(".") >= 0 && (m = v.split("."), v = m.shift(), m.sort()), c = v.indexOf(":") < 0 && "on" + v, e = e[n.expando] ? e : new n.Event(v, "object" == typeof e && e), e.isTrigger = i ? 2 : 3, e.namespace = m.join("."), e.namespace_re = e.namespace ? new RegExp("(^|\\.)" + m.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, e.result = void 0, e.target || (e.target = r), t = null == t ? [e] : n.makeArray(t, [e]), p = n.event.special[v] || {}, i || !p.trigger || p.trigger.apply(r, t) !== !1)) {
                if (!i && !p.noBubble && !n.isWindow(r)) {
                    for (f = p.delegateType || v, X.test(f + v) || (o = o.parentNode); o; o = o.parentNode)d.push(o), u = o;
                    u === (r.ownerDocument || l) && d.push(u.defaultView || u.parentWindow || a)
                }
                s = 0;
                while ((o = d[s++]) && !e.isPropagationStopped())e.type = s > 1 ? f : p.bindType || v, h = (L.get(o, "events") || {})[e.type] && L.get(o, "handle"), h && h.apply(o, t), h = c && o[c], h && h.apply && n.acceptData(o) && (e.result = h.apply(o, t), e.result === !1 && e.preventDefault());
                return e.type = v, i || e.isDefaultPrevented() || p._default && p._default.apply(d.pop(), t) !== !1 || !n.acceptData(r) || c && n.isFunction(r[v]) && !n.isWindow(r) && (u = r[c], u && (r[c] = null), n.event.triggered = v, r[v](), n.event.triggered = void 0, u && (r[c] = u)), e.result
            }
        },
        dispatch: function (e) {
            e = n.event.fix(e);
            var t, r, i, s, o, u = [], a = d.call(arguments), f = (L.get(this, "events") || {})[e.type] || [], l = n.event.special[e.type] || {};
            if (a[0] = e, e.delegateTarget = this, !l.preDispatch || l.preDispatch.call(this, e) !== !1) {
                u = n.event.handlers.call(this, e, f), t = 0;
                while ((s = u[t++]) && !e.isPropagationStopped()) {
                    e.currentTarget = s.elem, r = 0;
                    while ((o = s.handlers[r++]) && !e.isImmediatePropagationStopped())(!e.namespace_re || e.namespace_re.test(o.namespace)) && (e.handleObj = o, e.data = o.data, i = ((n.event.special[o.origType] || {}).handle || o.handler).apply(s.elem, a), void 0 !== i && (e.result = i) === !1 && (e.preventDefault(), e.stopPropagation()))
                }
                return l.postDispatch && l.postDispatch.call(this, e), e.result
            }
        },
        handlers: function (e, t) {
            var r, i, s, o, u = [], a = t.delegateCount, f = e.target;
            if (a && f.nodeType && (!e.button || "click" !== e.type))for (; f !== this; f = f.parentNode || this)if (f.disabled !== !0 || "click" !== e.type) {
                for (i = [], r = 0; a > r; r++)o = t[r], s = o.selector + " ", void 0 === i[s] && (i[s] = o.needsContext ? n(s, this).index(f) >= 0 : n.find(s, this, null, [f]).length), i[s] && i.push(o);
                i.length && u.push({elem: f, handlers: i})
            }
            return a < t.length && u.push({elem: this, handlers: t.slice(a)}), u
        },
        props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
        fixHooks: {},
        keyHooks: {
            props: "char charCode key keyCode".split(" "), filter: function (e, t) {
                return null == e.which && (e.which = null != t.charCode ? t.charCode : t.keyCode), e
            }
        },
        mouseHooks: {
            props: "button buttons clientX clientY offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
            filter: function (e, t) {
                var n, r, i, s = t.button;
                return null == e.pageX && null != t.clientX && (n = e.target.ownerDocument || l, r = n.documentElement, i = n.body, e.pageX = t.clientX + (r && r.scrollLeft || i && i.scrollLeft || 0) - (r && r.clientLeft || i && i.clientLeft || 0), e.pageY = t.clientY + (r && r.scrollTop || i && i.scrollTop || 0) - (r && r.clientTop || i && i.clientTop || 0)), e.which || void 0 === s || (e.which = 1 & s ? 1 : 2 & s ? 3 : 4 & s ? 2 : 0), e
            }
        },
        fix: function (e) {
            if (e[n.expando])return e;
            var t, r, i, s = e.type, o = e, u = this.fixHooks[s];
            u || (this.fixHooks[s] = u = W.test(s) ? this.mouseHooks : V.test(s) ? this.keyHooks : {}), i = u.props ? this.props.concat(u.props) : this.props, e = new n.Event(o), t = i.length;
            while (t--)r = i[t], e[r] = o[r];
            return e.target || (e.target = l), 3 === e.target.nodeType && (e.target = e.target.parentNode), u.filter ? u.filter(e, o) : e
        },
        special: {
            load: {noBubble: !0}, focus: {
                trigger: function () {
                    return this !== _() && this.focus ? (this.focus(), !1) : void 0
                }, delegateType: "focusin"
            }, blur: {
                trigger: function () {
                    return this === _() && this.blur ? (this.blur(), !1) : void 0
                }, delegateType: "focusout"
            }, click: {
                trigger: function () {
                    return "checkbox" === this.type && this.click && n.nodeName(this, "input") ? (this.click(), !1) : void 0
                }, _default: function (e) {
                    return n.nodeName(e.target, "a")
                }
            }, beforeunload: {
                postDispatch: function (e) {
                    void 0 !== e.result && e.originalEvent && (e.originalEvent.returnValue = e.result)
                }
            }
        },
        simulate: function (e, t, r, i) {
            var s = n.extend(new n.Event, r, {type: e, isSimulated: !0, originalEvent: {}});
            i ? n.event.trigger(s, null, t) : n.event.dispatch.call(t, s), s.isDefaultPrevented() && r.preventDefault()
        }
    }, n.removeEvent = function (e, t, n) {
        e.removeEventListener && e.removeEventListener(t, n, !1)
    }, n.Event = function (e, t) {
        return this instanceof n.Event ? (e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || void 0 === e.defaultPrevented && e.returnValue === !1 ? Z : $) : this.type = e, t && n.extend(this, t), this.timeStamp = e && e.timeStamp || n.now(), void (this[n.expando] = !0)) : new n.Event(e, t)
    }, n.Event.prototype = {
        isDefaultPrevented: $,
        isPropagationStopped: $,
        isImmediatePropagationStopped: $,
        preventDefault: function () {
            var e = this.originalEvent;
            this.isDefaultPrevented = Z, e && e.preventDefault && e.preventDefault()
        },
        stopPropagation: function () {
            var e = this.originalEvent;
            this.isPropagationStopped = Z, e && e.stopPropagation && e.stopPropagation()
        },
        stopImmediatePropagation: function () {
            var e = this.originalEvent;
            this.isImmediatePropagationStopped = Z, e && e.stopImmediatePropagation && e.stopImmediatePropagation(), this.stopPropagation()
        }
    }, n.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout",
        pointerenter: "pointerover",
        pointerleave: "pointerout"
    }, function (e, t) {
        n.event.special[e] = {
            delegateType: t, bindType: t, handle: function (e) {
                var r, i = this, s = e.relatedTarget, o = e.handleObj;
                return (!s || s !== i && !n.contains(i, s)) && (e.type = o.origType, r = o.handler.apply(this, arguments), e.type = t), r
            }
        }
    }), k.focusinBubbles || n.each({focus: "focusin", blur: "focusout"}, function (e, t) {
        var r = function (e) {
            n.event.simulate(t, e.target, n.event.fix(e), !0)
        };
        n.event.special[t] = {
            setup: function () {
                var n = this.ownerDocument || this, i = L.access(n, t);
                i || n.addEventListener(e, r, !0), L.access(n, t, (i || 0) + 1)
            }, teardown: function () {
                var n = this.ownerDocument || this, i = L.access(n, t) - 1;
                i ? L.access(n, t, i) : (n.removeEventListener(e, r, !0), L.remove(n, t))
            }
        }
    }), n.fn.extend({
        on: function (e, t, r, i, s) {
            var o, u;
            if ("object" == typeof e) {
                "string" != typeof t && (r = r || t, t = void 0);
                for (u in e)this.on(u, t, r, e[u], s);
                return this
            }
            if (null == r && null == i ? (i = t, r = t = void 0) : null == i && ("string" == typeof t ? (i = r, r = void 0) : (i = r, r = t, t = void 0)), i === !1)i = $; else if (!i)return this;
            return 1 === s && (o = i, i = function (e) {
                return n().off(e), o.apply(this, arguments)
            }, i.guid = o.guid || (o.guid = n.guid++)), this.each(function () {
                n.event.add(this, e, i, r, t)
            })
        }, one: function (e, t, n, r) {
            return this.on(e, t, n, r, 1)
        }, off: function (e, t, r) {
            var i, s;
            if (e && e.preventDefault && e.handleObj)return i = e.handleObj, n(e.delegateTarget).off(i.namespace ? i.origType + "." + i.namespace : i.origType, i.selector, i.handler), this;
            if ("object" == typeof e) {
                for (s in e)this.off(s, t, e[s]);
                return this
            }
            return (t === !1 || "function" == typeof t) && (r = t, t = void 0), r === !1 && (r = $), this.each(function () {
                n.event.remove(this, e, r, t)
            })
        }, trigger: function (e, t) {
            return this.each(function () {
                n.event.trigger(e, t, this)
            })
        }, triggerHandler: function (e, t) {
            var r = this[0];
            return r ? n.event.trigger(e, t, r, !0) : void 0
        }
    });
    var aa = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi, ba = /<([\w:]+)/, ca = /<|&#?\w+;/, da = /<(?:script|style|link)/i, ea = /checked\s*(?:[^=]|=\s*.checked.)/i, fa = /^$|\/(?:java|ecma)script/i, ga = /^true\/(.*)/, ha = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g, ia = {
        option: [1, "<select multiple='multiple'>", "</select>"],
        thead: [1, "<table>", "</table>"],
        col: [2, "<table><colgroup>", "</colgroup></table>"],
        tr: [2, "<table><tbody>", "</tbody></table>"],
        td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
        _default: [0, "", ""]
    };
    ia.optgroup = ia.option, ia.tbody = ia.tfoot = ia.colgroup = ia.caption = ia.thead, ia.th = ia.td, n.extend({
        clone: function (e, t, r) {
            var i, s, o, u, a = e.cloneNode(!0), f = n.contains(e.ownerDocument, e);
            if (!(k.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || n.isXMLDoc(e)))for (u = oa(a), o = oa(e), i = 0, s = o.length; s > i; i++)pa(o[i], u[i]);
            if (t)if (r)for (o = o || oa(e), u = u || oa(a), i = 0, s = o.length; s > i; i++)na(o[i], u[i]); else na(e, a);
            return u = oa(a, "script"), u.length > 0 && ma(u, !f && oa(e, "script")), a
        }, buildFragment: function (e, t, r, i) {
            for (var s, o, u, a, f, l, c = t.createDocumentFragment(), h = [], p = 0, d = e.length; d > p; p++)if (s = e[p], s || 0 === s)if ("object" === n.type(s))n.merge(h, s.nodeType ? [s] : s); else if (ca.test(s)) {
                o = o || c.appendChild(t.createElement("div")), u = (ba.exec(s) || ["", ""])[1].toLowerCase(), a = ia[u] || ia._default, o.innerHTML = a[1] + s.replace(aa, "<$1></$2>") + a[2], l = a[0];
                while (l--)o = o.lastChild;
                n.merge(h, o.childNodes), o = c.firstChild, o.textContent = ""
            } else h.push(t.createTextNode(s));
            c.textContent = "", p = 0;
            while (s = h[p++])if ((!i || -1 === n.inArray(s, i)) && (f = n.contains(s.ownerDocument, s), o = oa(c.appendChild(s), "script"), f && ma(o), r)) {
                l = 0;
                while (s = o[l++])fa.test(s.type || "") && r.push(s)
            }
            return c
        }, cleanData: function (e) {
            for (var t, r, i, s, o = n.event.special, u = 0; void 0 !== (r = e[u]); u++) {
                if (n.acceptData(r) && (s = r[L.expando], s && (t = L.cache[s]))) {
                    if (t.events)for (i in t.events)o[i] ? n.event.remove(r, i) : n.removeEvent(r, i, t.handle);
                    L.cache[s] && delete L.cache[s]
                }
                delete M.cache[r[M.expando]]
            }
        }
    }), n.fn.extend({
        text: function (e) {
            return J(this, function (e) {
                return void 0 === e ? n.text(this) : this.empty().each(function () {
                    (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) && (this.textContent = e)
                })
            }, null, e, arguments.length)
        }, append: function () {
            return this.domManip(arguments, function (e) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var t = ja(this, e);
                    t.appendChild(e)
                }
            })
        }, prepend: function () {
            return this.domManip(arguments, function (e) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var t = ja(this, e);
                    t.insertBefore(e, t.firstChild)
                }
            })
        }, before: function () {
            return this.domManip(arguments, function (e) {
                this.parentNode && this.parentNode.insertBefore(e, this)
            })
        }, after: function () {
            return this.domManip(arguments, function (e) {
                this.parentNode && this.parentNode.insertBefore(e, this.nextSibling)
            })
        }, remove: function (e, t) {
            for (var r, i = e ? n.filter(e, this) : this, s = 0; null != (r = i[s]); s++)t || 1 !== r.nodeType || n.cleanData(oa(r)), r.parentNode && (t && n.contains(r.ownerDocument, r) && ma(oa(r, "script")), r.parentNode.removeChild(r));
            return this
        }, empty: function () {
            for (var e, t = 0; null != (e = this[t]); t++)1 === e.nodeType && (n.cleanData(oa(e, !1)), e.textContent = "");
            return this
        }, clone: function (e, t) {
            return e = null == e ? !1 : e, t = null == t ? e : t, this.map(function () {
                return n.clone(this, e, t)
            })
        }, html: function (e) {
            return J(this, function (e) {
                var t = this[0] || {}, r = 0, i = this.length;
                if (void 0 === e && 1 === t.nodeType)return t.innerHTML;
                if ("string" == typeof e && !da.test(e) && !ia[(ba.exec(e) || ["", ""])[1].toLowerCase()]) {
                    e = e.replace(aa, "<$1></$2>");
                    try {
                        for (; i > r; r++)t = this[r] || {}, 1 === t.nodeType && (n.cleanData(oa(t, !1)), t.innerHTML = e);
                        t = 0
                    } catch (s) {
                    }
                }
                t && this.empty().append(e)
            }, null, e, arguments.length)
        }, replaceWith: function () {
            var e = arguments[0];
            return this.domManip(arguments, function (t) {
                e = this.parentNode, n.cleanData(oa(this)), e && e.replaceChild(t, this)
            }), e && (e.length || e.nodeType) ? this : this.remove()
        }, detach: function (e) {
            return this.remove(e, !0)
        }, domManip: function (t, r) {
            t = e.apply([], t);
            var i, s, o, u, a, f, l = 0, c = this.length, h = this, p = c - 1, d = t[0], v = n.isFunction(d);
            if (v || c > 1 && "string" == typeof d && !k.checkClone && ea.test(d))return this.each(function (e) {
                var n = h.eq(e);
                v && (t[0] = d.call(this, e, n.html())), n.domManip(t, r)
            });
            if (c && (i = n.buildFragment(t, this[0].ownerDocument, !1, this), s = i.firstChild, 1 === i.childNodes.length && (i = s), s)) {
                for (o = n.map(oa(i, "script"), ka), u = o.length; c > l; l++)a = i, l !== p && (a = n.clone(a, !0, !0), u && n.merge(o, oa(a, "script"))), r.call(this[l], a, l);
                if (u)for (f = o[o.length - 1].ownerDocument, n.map(o, la), l = 0; u > l; l++)a = o[l], fa.test(a.type || "") && !L.access(a, "globalEval") && n.contains(f, a) && (a.src ? n._evalUrl && n._evalUrl(a.src) : n.globalEval(a.textContent.replace(ha, "")))
            }
            return this
        }
    }), n.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function (e, t) {
        n.fn[e] = function (e) {
            for (var r, i = [], s = n(e), o = s.length - 1, u = 0; o >= u; u++)r = u === o ? this : this.clone(!0), n(s[u])[t](r), f.apply(i, r.get());
            return this.pushStack(i)
        }
    });
    var qa, ra = {}, ua = /^margin/, va = new RegExp("^(" + Q + ")(?!px)[a-z%]+$", "i"), wa = function (e) {
        return e.ownerDocument.defaultView.opener ? e.ownerDocument.defaultView.getComputedStyle(e, null) : a.getComputedStyle(e, null)
    };
    !function () {
        var e, t, r = l.documentElement, i = l.createElement("div"), s = l.createElement("div");
        if (s.style) {
            s.style.backgroundClip = "content-box", s.cloneNode(!0).style.backgroundClip = "", k.clearCloneStyle = "content-box" === s.style.backgroundClip, i.style.cssText = "border:0;width:0;height:0;top:0;left:-9999px;margin-top:1px;position:absolute", i.appendChild(s);
            function o() {
                s.style.cssText = "-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:block;margin-top:1%;top:1%;border:1px;padding:1px;width:4px;position:absolute", s.innerHTML = "", r.appendChild(i);
                var n = a.getComputedStyle(s, null);
                e = "1%" !== n.top, t = "4px" === n.width, r.removeChild(i)
            }

            a.getComputedStyle && n.extend(k, {
                pixelPosition: function () {
                    return o(), e
                }, boxSizingReliable: function () {
                    return null == t && o(), t
                }, reliableMarginRight: function () {
                    var e, t = s.appendChild(l.createElement("div"));
                    return t.style.cssText = s.style.cssText = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0", t.style.marginRight = t.style.width = "0", s.style.width = "1px", r.appendChild(i), e = !parseFloat(a.getComputedStyle(t, null).marginRight), r.removeChild(i), s.removeChild(t), e
                }
            })
        }
    }(), n.swap = function (e, t, n, r) {
        var i, s, o = {};
        for (s in t)o[s] = e.style[s], e.style[s] = t[s];
        i = n.apply(e, r || []);
        for (s in t)e.style[s] = o[s];
        return i
    };
    var za = /^(none|table(?!-c[ea]).+)/, Aa = new RegExp("^(" + Q + ")(.*)$", "i"), Ba = new RegExp("^([+-])=(" + Q + ")", "i"), Ca = {
        position: "absolute",
        visibility: "hidden",
        display: "block"
    }, Da = {letterSpacing: "0", fontWeight: "400"}, Ea = ["Webkit", "O", "Moz", "ms"];
    n.extend({
        cssHooks: {
            opacity: {
                get: function (e, t) {
                    if (t) {
                        var n = xa(e, "opacity");
                        return "" === n ? "1" : n
                    }
                }
            }
        },
        cssNumber: {
            columnCount: !0,
            fillOpacity: !0,
            flexGrow: !0,
            flexShrink: !0,
            fontWeight: !0,
            lineHeight: !0,
            opacity: !0,
            order: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0
        },
        cssProps: {"float": "cssFloat"},
        style: function (e, t, r, i) {
            if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
                var s, o, u, a = n.camelCase(t), f = e.style;
                return t = n.cssProps[a] || (n.cssProps[a] = Fa(f, a)), u = n.cssHooks[t] || n.cssHooks[a], void 0 === r ? u && "get" in u && void 0 !== (s = u.get(e, !1, i)) ? s : f[t] : (o = typeof r, "string" === o && (s = Ba.exec(r)) && (r = (s[1] + 1) * s[2] + parseFloat(n.css(e, t)), o = "number"), null != r && r === r && ("number" !== o || n.cssNumber[a] || (r += "px"), k.clearCloneStyle || "" !== r || 0 !== t.indexOf("background") || (f[t] = "inherit"), u && "set" in u && void 0 === (r = u.set(e, r, i)) || (f[t] = r)), void 0)
            }
        },
        css: function (e, t, r, i) {
            var s, o, u, a = n.camelCase(t);
            return t = n.cssProps[a] || (n.cssProps[a] = Fa(e.style, a)), u = n.cssHooks[t] || n.cssHooks[a], u && "get" in u && (s = u.get(e, !0, r)), void 0 === s && (s = xa(e, t, i)), "normal" === s && t in Da && (s = Da[t]), "" === r || r ? (o = parseFloat(s), r === !0 || n.isNumeric(o) ? o || 0 : s) : s
        }
    }), n.each(["height", "width"], function (e, t) {
        n.cssHooks[t] = {
            get: function (e, r, i) {
                return r ? za.test(n.css(e, "display")) && 0 === e.offsetWidth ? n.swap(e, Ca, function () {
                    return Ia(e, t, i)
                }) : Ia(e, t, i) : void 0
            }, set: function (e, r, i) {
                var s = i && wa(e);
                return Ga(e, r, i ? Ha(e, t, i, "border-box" === n.css(e, "boxSizing", !1, s), s) : 0)
            }
        }
    }), n.cssHooks.marginRight = ya(k.reliableMarginRight, function (e, t) {
        return t ? n.swap(e, {display: "inline-block"}, xa, [e, "marginRight"]) : void 0
    }), n.each({margin: "", padding: "", border: "Width"}, function (e, t) {
        n.cssHooks[e + t] = {
            expand: function (n) {
                for (var r = 0, i = {}, s = "string" == typeof n ? n.split(" ") : [n]; 4 > r; r++)i[e + R[r] + t] = s[r] || s[r - 2] || s[0];
                return i
            }
        }, ua.test(e) || (n.cssHooks[e + t].set = Ga)
    }), n.fn.extend({
        css: function (e, t) {
            return J(this, function (e, t, r) {
                var i, s, o = {}, u = 0;
                if (n.isArray(t)) {
                    for (i = wa(e), s = t.length; s > u; u++)o[t[u]] = n.css(e, t[u], !1, i);
                    return o
                }
                return void 0 !== r ? n.style(e, t, r) : n.css(e, t)
            }, e, t, arguments.length > 1)
        }, show: function () {
            return Ja(this, !0)
        }, hide: function () {
            return Ja(this)
        }, toggle: function (e) {
            return "boolean" == typeof e ? e ? this.show() : this.hide() : this.each(function () {
                S(this) ? n(this).show() : n(this).hide()
            })
        }
    }), n.Tween = Ka, Ka.prototype = {
        constructor: Ka, init: function (e, t, r, i, s, o) {
            this.elem = e, this.prop = r, this.easing = s || "swing", this.options = t, this.start = this.now = this.cur(), this.end = i, this.unit = o || (n.cssNumber[r] ? "" : "px")
        }, cur: function () {
            var e = Ka.propHooks[this.prop];
            return e && e.get ? e.get(this) : Ka.propHooks._default.get(this)
        }, run: function (e) {
            var t, r = Ka.propHooks[this.prop];
            return this.options.duration ? this.pos = t = n.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : this.pos = t = e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), r && r.set ? r.set(this) : Ka.propHooks._default.set(this), this
        }
    }, Ka.prototype.init.prototype = Ka.prototype, Ka.propHooks = {
        _default: {
            get: function (e) {
                var t;
                return null == e.elem[e.prop] || e.elem.style && null != e.elem.style[e.prop] ? (t = n.css(e.elem, e.prop, ""), t && "auto" !== t ? t : 0) : e.elem[e.prop]
            }, set: function (e) {
                n.fx.step[e.prop] ? n.fx.step[e.prop](e) : e.elem.style && (null != e.elem.style[n.cssProps[e.prop]] || n.cssHooks[e.prop]) ? n.style(e.elem, e.prop, e.now + e.unit) : e.elem[e.prop] = e.now
            }
        }
    }, Ka.propHooks.scrollTop = Ka.propHooks.scrollLeft = {
        set: function (e) {
            e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now)
        }
    }, n.easing = {
        linear: function (e) {
            return e
        }, swing: function (e) {
            return .5 - Math.cos(e * Math.PI) / 2
        }
    }, n.fx = Ka.prototype.init, n.fx.step = {};
    var La, Ma, Na = /^(?:toggle|show|hide)$/, Oa = new RegExp("^(?:([+-])=|)(" + Q + ")([a-z%]*)$", "i"), Pa = /queueHooks$/, Qa = [Va], Ra = {
        "*": [function (e, t) {
            var r = this.createTween(e, t), i = r.cur(), s = Oa.exec(t), o = s && s[3] || (n.cssNumber[e] ? "" : "px"), u = (n.cssNumber[e] || "px" !== o && +i) && Oa.exec(n.css(r.elem, e)), a = 1, f = 20;
            if (u && u[3] !== o) {
                o = o || u[3], s = s || [], u = +i || 1;
                do a = a || ".5", u /= a, n.style(r.elem, e, u + o); while (a !== (a = r.cur() / i) && 1 !== a && --f)
            }
            return s && (u = r.start = +u || +i || 0, r.unit = o, r.end = s[1] ? u + (s[1] + 1) * s[2] : +s[2]), r
        }]
    };
    n.Animation = n.extend(Xa, {
        tweener: function (e, t) {
            n.isFunction(e) ? (t = e, e = ["*"]) : e = e.split(" ");
            for (var r, i = 0, s = e.length; s > i; i++)r = e[i], Ra[r] = Ra[r] || [], Ra[r].unshift(t)
        }, prefilter: function (e, t) {
            t ? Qa.unshift(e) : Qa.push(e)
        }
    }), n.speed = function (e, t, r) {
        var i = e && "object" == typeof e ? n.extend({}, e) : {
            complete: r || !r && t || n.isFunction(e) && e,
            duration: e,
            easing: r && t || t && !n.isFunction(t) && t
        };
        return i.duration = n.fx.off ? 0 : "number" == typeof i.duration ? i.duration : i.duration in n.fx.speeds ? n.fx.speeds[i.duration] : n.fx.speeds._default, (null == i.queue || i.queue === !0) && (i.queue = "fx"), i.old = i.complete, i.complete = function () {
            n.isFunction(i.old) && i.old.call(this), i.queue && n.dequeue(this, i.queue)
        }, i
    }, n.fn.extend({
        fadeTo: function (e, t, n, r) {
            return this.filter(S).css("opacity", 0).show().end().animate({opacity: t}, e, n, r)
        }, animate: function (e, t, r, i) {
            var s = n.isEmptyObject(e), o = n.speed(t, r, i), u = function () {
                var t = Xa(this, n.extend({}, e), o);
                (s || L.get(this, "finish")) && t.stop(!0)
            };
            return u.finish = u, s || o.queue === !1 ? this.each(u) : this.queue(o.queue, u)
        }, stop: function (e, t, r) {
            var i = function (e) {
                var t = e.stop;
                delete e.stop, t(r)
            };
            return "string" != typeof e && (r = t, t = e, e = void 0), t && e !== !1 && this.queue(e || "fx", []), this.each(function () {
                var t = !0, s = null != e && e + "queueHooks", o = n.timers, u = L.get(this);
                if (s)u[s] && u[s].stop && i(u[s]); else for (s in u)u[s] && u[s].stop && Pa.test(s) && i(u[s]);
                for (s = o.length; s--;)o[s].elem !== this || null != e && o[s].queue !== e || (o[s].anim.stop(r), t = !1, o.splice(s, 1));
                (t || !r) && n.dequeue(this, e)
            })
        }, finish: function (e) {
            return e !== !1 && (e = e || "fx"), this.each(function () {
                var t, r = L.get(this), i = r[e + "queue"], s = r[e + "queueHooks"], o = n.timers, u = i ? i.length : 0;
                for (r.finish = !0, n.queue(this, e, []), s && s.stop && s.stop.call(this, !0), t = o.length; t--;)o[t].elem === this && o[t].queue === e && (o[t].anim.stop(!0), o.splice(t, 1));
                for (t = 0; u > t; t++)i[t] && i[t].finish && i[t].finish.call(this);
                delete r.finish
            })
        }
    }), n.each(["toggle", "show", "hide"], function (e, t) {
        var r = n.fn[t];
        n.fn[t] = function (e, n, i) {
            return null == e || "boolean" == typeof e ? r.apply(this, arguments) : this.animate(Ta(t, !0), e, n, i)
        }
    }), n.each({
        slideDown: Ta("show"),
        slideUp: Ta("hide"),
        slideToggle: Ta("toggle"),
        fadeIn: {opacity: "show"},
        fadeOut: {opacity: "hide"},
        fadeToggle: {opacity: "toggle"}
    }, function (e, t) {
        n.fn[e] = function (e, n, r) {
            return this.animate(t, e, n, r)
        }
    }), n.timers = [], n.fx.tick = function () {
        var e, t = 0, r = n.timers;
        for (La = n.now(); t < r.length; t++)e = r[t], e() || r[t] !== e || r.splice(t--, 1);
        r.length || n.fx.stop(), La = void 0
    }, n.fx.timer = function (e) {
        n.timers.push(e), e() ? n.fx.start() : n.timers.pop()
    }, n.fx.interval = 13, n.fx.start = function () {
        Ma || (Ma = setInterval(n.fx.tick, n.fx.interval))
    }, n.fx.stop = function () {
        clearInterval(Ma), Ma = null
    }, n.fx.speeds = {slow: 600, fast: 200, _default: 400}, n.fn.delay = function (e, t) {
        return e = n.fx ? n.fx.speeds[e] || e : e, t = t || "fx", this.queue(t, function (t, n) {
            var r = setTimeout(t, e);
            n.stop = function () {
                clearTimeout(r)
            }
        })
    }, function () {
        var e = l.createElement("input"), t = l.createElement("select"), n = t.appendChild(l.createElement("option"));
        e.type = "checkbox", k.checkOn = "" !== e.value, k.optSelected = n.selected, t.disabled = !0, k.optDisabled = !n.disabled, e = l.createElement("input"), e.value = "t", e.type = "radio", k.radioValue = "t" === e.value
    }();
    var Ya, Za, $a = n.expr.attrHandle;
    n.fn.extend({
        attr: function (e, t) {
            return J(this, n.attr, e, t, arguments.length > 1)
        }, removeAttr: function (e) {
            return this.each(function () {
                n.removeAttr(this, e)
            })
        }
    }), n.extend({
        attr: function (e, t, r) {
            var i, s, o = e.nodeType;
            if (e && 3 !== o && 8 !== o && 2 !== o)return typeof e.getAttribute === U ? n.prop(e, t, r) : (1 === o && n.isXMLDoc(e) || (t = t.toLowerCase(), i = n.attrHooks[t] || (n.expr.match.bool.test(t) ? Za : Ya)), void 0 === r ? i && "get" in i && null !== (s = i.get(e, t)) ? s : (s = n.find.attr(e, t), null == s ? void 0 : s) : null !== r ? i && "set" in i && void 0 !== (s = i.set(e, r, t)) ? s : (e.setAttribute(t, r + ""), r) : void n.removeAttr(e, t))
        }, removeAttr: function (e, t) {
            var r, i, s = 0, o = t && t.match(E);
            if (o && 1 === e.nodeType)while (r = o[s++])i = n.propFix[r] || r, n.expr.match.bool.test(r) && (e[i] = !1), e.removeAttribute(r)
        }, attrHooks: {
            type: {
                set: function (e, t) {
                    if (!k.radioValue && "radio" === t && n.nodeName(e, "input")) {
                        var r = e.value;
                        return e.setAttribute("type", t), r && (e.value = r), t
                    }
                }
            }
        }
    }), Za = {
        set: function (e, t, r) {
            return t === !1 ? n.removeAttr(e, r) : e.setAttribute(r, r), r
        }
    }, n.each(n.expr.match.bool.source.match(/\w+/g), function (e, t) {
        var r = $a[t] || n.find.attr;
        $a[t] = function (e, t, n) {
            var i, s;
            return n || (s = $a[t], $a[t] = i, i = null != r(e, t, n) ? t.toLowerCase() : null, $a[t] = s), i
        }
    });
    var _a = /^(?:input|select|textarea|button)$/i;
    n.fn.extend({
        prop: function (e, t) {
            return J(this, n.prop, e, t, arguments.length > 1)
        }, removeProp: function (e) {
            return this.each(function () {
                delete this[n.propFix[e] || e]
            })
        }
    }), n.extend({
        propFix: {"for": "htmlFor", "class": "className"}, prop: function (e, t, r) {
            var i, s, o, u = e.nodeType;
            if (e && 3 !== u && 8 !== u && 2 !== u)return o = 1 !== u || !n.isXMLDoc(e), o && (t = n.propFix[t] || t, s = n.propHooks[t]), void 0 !== r ? s && "set" in s && void 0 !== (i = s.set(e, r, t)) ? i : e[t] = r : s && "get" in s && null !== (i = s.get(e, t)) ? i : e[t]
        }, propHooks: {
            tabIndex: {
                get: function (e) {
                    return e.hasAttribute("tabindex") || _a.test(e.nodeName) || e.href ? e.tabIndex : -1
                }
            }
        }
    }), k.optSelected || (n.propHooks.selected = {
        get: function (e) {
            var t = e.parentNode;
            return t && t.parentNode && t.parentNode.selectedIndex, null
        }
    }), n.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function () {
        n.propFix[this.toLowerCase()] = this
    });
    var ab = /[\t\r\n\f]/g;
    n.fn.extend({
        addClass: function (e) {
            var t, r, i, s, o, u, a = "string" == typeof e && e, f = 0, l = this.length;
            if (n.isFunction(e))return this.each(function (t) {
                n(this).addClass(e.call(this, t, this.className))
            });
            if (a)for (t = (e || "").match(E) || []; l > f; f++)if (r = this[f], i = 1 === r.nodeType && (r.className ? (" " + r.className + " ").replace(ab, " ") : " ")) {
                o = 0;
                while (s = t[o++])i.indexOf(" " + s + " ") < 0 && (i += s + " ");
                u = n.trim(i), r.className !== u && (r.className = u)
            }
            return this
        }, removeClass: function (e) {
            var t, r, i, s, o, u, a = 0 === arguments.length || "string" == typeof e && e, f = 0, l = this.length;
            if (n.isFunction(e))return this.each(function (t) {
                n(this).removeClass(e.call(this, t, this.className))
            });
            if (a)for (t = (e || "").match(E) || []; l > f; f++)if (r = this[f], i = 1 === r.nodeType && (r.className ? (" " + r.className + " ").replace(ab, " ") : "")) {
                o = 0;
                while (s = t[o++])while (i.indexOf(" " + s + " ") >= 0)i = i.replace(" " + s + " ", " ");
                u = e ? n.trim(i) : "", r.className !== u && (r.className = u)
            }
            return this
        }, toggleClass: function (e, t) {
            var r = typeof e;
            return "boolean" == typeof t && "string" === r ? t ? this.addClass(e) : this.removeClass(e) : this.each(n.isFunction(e) ? function (r) {
                n(this).toggleClass(e.call(this, r, this.className, t), t)
            } : function () {
                if ("string" === r) {
                    var t, i = 0, s = n(this), o = e.match(E) || [];
                    while (t = o[i++])s.hasClass(t) ? s.removeClass(t) : s.addClass(t)
                } else(r === U || "boolean" === r) && (this.className && L.set(this, "__className__", this.className), this.className = this.className || e === !1 ? "" : L.get(this, "__className__") || "")
            })
        }, hasClass: function (e) {
            for (var t = " " + e + " ", n = 0, r = this.length; r > n; n++)if (1 === this[n].nodeType && (" " + this[n].className + " ").replace(ab, " ").indexOf(t) >= 0)return !0;
            return !1
        }
    });
    var bb = /\r/g;
    n.fn.extend({
        val: function (e) {
            var t, r, i, s = this[0];
            if (arguments.length)return i = n.isFunction(e), this.each(function (r) {
                var s;
                1 === this.nodeType && (s = i ? e.call(this, r, n(this).val()) : e, null == s ? s = "" : "number" == typeof s ? s += "" : n.isArray(s) && (s = n.map(s, function (e) {
                    return null == e ? "" : e + ""
                })), t = n.valHooks[this.type] || n.valHooks[this.nodeName.toLowerCase()], t && "set" in t && void 0 !== t.set(this, s, "value") || (this.value = s))
            });
            if (s)return t = n.valHooks[s.type] || n.valHooks[s.nodeName.toLowerCase()], t && "get" in t && void 0 !== (r = t.get(s, "value")) ? r : (r = s.value, "string" == typeof r ? r.replace(bb, "") : null == r ? "" : r)
        }
    }), n.extend({
        valHooks: {
            option: {
                get: function (e) {
                    var t = n.find.attr(e, "value");
                    return null != t ? t : n.trim(n.text(e))
                }
            }, select: {
                get: function (e) {
                    for (var t, r, i = e.options, s = e.selectedIndex, o = "select-one" === e.type || 0 > s, u = o ? null : [], a = o ? s + 1 : i.length, f = 0 > s ? a : o ? s : 0; a > f; f++)if (r = i[f], !(!r.selected && f !== s || (k.optDisabled ? r.disabled : null !== r.getAttribute("disabled")) || r.parentNode.disabled && n.nodeName(r.parentNode, "optgroup"))) {
                        if (t = n(r).val(), o)return t;
                        u.push(t)
                    }
                    return u
                }, set: function (e, t) {
                    var r, i, s = e.options, o = n.makeArray(t), u = s.length;
                    while (u--)i = s[u], (i.selected = n.inArray(i.value, o) >= 0) && (r = !0);
                    return r || (e.selectedIndex = -1), o
                }
            }
        }
    }), n.each(["radio", "checkbox"], function () {
        n.valHooks[this] = {
            set: function (e, t) {
                return n.isArray(t) ? e.checked = n.inArray(n(e).val(), t) >= 0 : void 0
            }
        }, k.checkOn || (n.valHooks[this].get = function (e) {
            return null === e.getAttribute("value") ? "on" : e.value
        })
    }), n.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function (e, t) {
        n.fn[t] = function (e, n) {
            return arguments.length > 0 ? this.on(t, null, e, n) : this.trigger(t)
        }
    }), n.fn.extend({
        hover: function (e, t) {
            return this.mouseenter(e).mouseleave(t || e)
        }, bind: function (e, t, n) {
            return this.on(e, null, t, n)
        }, unbind: function (e, t) {
            return this.off(e, null, t)
        }, delegate: function (e, t, n, r) {
            return this.on(t, e, n, r)
        }, undelegate: function (e, t, n) {
            return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n)
        }
    });
    var cb = n.now(), db = /\?/;
    n.parseJSON = function (e) {
        return JSON.parse(e + "")
    }, n.parseXML = function (e) {
        var t, r;
        if (!e || "string" != typeof e)return null;
        try {
            r = new DOMParser, t = r.parseFromString(e, "text/xml")
        } catch (i) {
            t = void 0
        }
        return (!t || t.getElementsByTagName("parsererror").length) && n.error("Invalid XML: " + e), t
    };
    var eb = /#.*$/, fb = /([?&])_=[^&]*/, gb = /^(.*?):[ \t]*([^\r\n]*)$/gm, hb = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/, ib = /^(?:GET|HEAD)$/, jb = /^\/\//, kb = /^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/, lb = {}, mb = {}, nb = "*/".concat("*"), ob = a.location.href, pb = kb.exec(ob.toLowerCase()) || [];
    n.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: ob,
            type: "GET",
            isLocal: hb.test(pb[1]),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": nb,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: {xml: /xml/, html: /html/, json: /json/},
            responseFields: {xml: "responseXML", text: "responseText", json: "responseJSON"},
            converters: {"* text": String, "text html": !0, "text json": n.parseJSON, "text xml": n.parseXML},
            flatOptions: {url: !0, context: !0}
        },
        ajaxSetup: function (e, t) {
            return t ? sb(sb(e, n.ajaxSettings), t) : sb(n.ajaxSettings, e)
        },
        ajaxPrefilter: qb(lb),
        ajaxTransport: qb(mb),
        ajax: function (e, t) {
            function T(e, t, o, a) {
                var l, g, y, w, E, x = t;
                2 !== b && (b = 2, u && clearTimeout(u), r = void 0, s = a || "", S.readyState = e > 0 ? 4 : 0, l = e >= 200 && 300 > e || 304 === e, o && (w = tb(c, S, o)), w = ub(c, w, S, l), l ? (c.ifModified && (E = S.getResponseHeader("Last-Modified"), E && (n.lastModified[i] = E), E = S.getResponseHeader("etag"), E && (n.etag[i] = E)), 204 === e || "HEAD" === c.type ? x = "nocontent" : 304 === e ? x = "notmodified" : (x = w.state, g = w.data, y = w.error, l = !y)) : (y = x, (e || !x) && (x = "error", 0 > e && (e = 0))), S.status = e, S.statusText = (t || x) + "", l ? d.resolveWith(h, [g, x, S]) : d.rejectWith(h, [S, x, y]), S.statusCode(m), m = void 0, f && p.trigger(l ? "ajaxSuccess" : "ajaxError", [S, c, l ? g : y]), v.fireWith(h, [S, x]), f && (p.trigger("ajaxComplete", [S, c]), --n.active || n.event.trigger("ajaxStop")))
            }

            "object" == typeof e && (t = e, e = void 0), t = t || {};
            var r, i, s, o, u, a, f, l, c = n.ajaxSetup({}, t), h = c.context || c, p = c.context && (h.nodeType || h.jquery) ? n(h) : n.event, d = n.Deferred(), v = n.Callbacks("once memory"), m = c.statusCode || {}, g = {}, y = {}, b = 0, w = "canceled", S = {
                readyState: 0,
                getResponseHeader: function (e) {
                    var t;
                    if (2 === b) {
                        if (!o) {
                            o = {};
                            while (t = gb.exec(s))o[t[1].toLowerCase()] = t[2]
                        }
                        t = o[e.toLowerCase()]
                    }
                    return null == t ? null : t
                },
                getAllResponseHeaders: function () {
                    return 2 === b ? s : null
                },
                setRequestHeader: function (e, t) {
                    var n = e.toLowerCase();
                    return b || (e = y[n] = y[n] || e, g[e] = t), this
                },
                overrideMimeType: function (e) {
                    return b || (c.mimeType = e), this
                },
                statusCode: function (e) {
                    var t;
                    if (e)if (2 > b)for (t in e)m[t] = [m[t], e[t]]; else S.always(e[S.status]);
                    return this
                },
                abort: function (e) {
                    var t = e || w;
                    return r && r.abort(t), T(0, t), this
                }
            };
            if (d.promise(S).complete = v.add, S.success = S.done, S.error = S.fail, c.url = ((e || c.url || ob) + "").replace(eb, "").replace(jb, pb[1] + "//"), c.type = t.method || t.type || c.method || c.type, c.dataTypes = n.trim(c.dataType || "*").toLowerCase().match(E) || [""], null == c.crossDomain && (a = kb.exec(c.url.toLowerCase()), c.crossDomain = !(!a || a[1] === pb[1] && a[2] === pb[2] && (a[3] || ("http:" === a[1] ? "80" : "443")) === (pb[3] || ("http:" === pb[1] ? "80" : "443")))), c.data && c.processData && "string" != typeof c.data && (c.data = n.param(c.data, c.traditional)), rb(lb, c, t, S), 2 === b)return S;
            f = n.event && c.global, f && 0 === n.active++ && n.event.trigger("ajaxStart"), c.type = c.type.toUpperCase(), c.hasContent = !ib.test(c.type), i = c.url, c.hasContent || (c.data && (i = c.url += (db.test(i) ? "&" : "?") + c.data, delete c.data), c.cache === !1 && (c.url = fb.test(i) ? i.replace(fb, "$1_=" + cb++) : i + (db.test(i) ? "&" : "?") + "_=" + cb++)), c.ifModified && (n.lastModified[i] && S.setRequestHeader("If-Modified-Since", n.lastModified[i]), n.etag[i] && S.setRequestHeader("If-None-Match", n.etag[i])), (c.data && c.hasContent && c.contentType !== !1 || t.contentType) && S.setRequestHeader("Content-Type", c.contentType), S.setRequestHeader("Accept", c.dataTypes[0] && c.accepts[c.dataTypes[0]] ? c.accepts[c.dataTypes[0]] + ("*" !== c.dataTypes[0] ? ", " + nb + "; q=0.01" : "") : c.accepts["*"]);
            for (l in c.headers)S.setRequestHeader(l, c.headers[l]);
            if (!c.beforeSend || c.beforeSend.call(h, S, c) !== !1 && 2 !== b) {
                w = "abort";
                for (l in{success: 1, error: 1, complete: 1})S[l](c[l]);
                if (r = rb(mb, c, t, S)) {
                    S.readyState = 1, f && p.trigger("ajaxSend", [S, c]), c.async && c.timeout > 0 && (u = setTimeout(function () {
                        S.abort("timeout")
                    }, c.timeout));
                    try {
                        b = 1, r.send(g, T)
                    } catch (x) {
                        if (!(2 > b))throw x;
                        T(-1, x)
                    }
                } else T(-1, "No Transport");
                return S
            }
            return S.abort()
        },
        getJSON: function (e, t, r) {
            return n.get(e, t, r, "json")
        },
        getScript: function (e, t) {
            return n.get(e, void 0, t, "script")
        }
    }), n.each(["get", "post"], function (e, t) {
        n[t] = function (e, r, i, s) {
            return n.isFunction(r) && (s = s || i, i = r, r = void 0), n.ajax({
                url: e,
                type: t,
                dataType: s,
                data: r,
                success: i
            })
        }
    }), n._evalUrl = function (e) {
        return n.ajax({url: e, type: "GET", dataType: "script", async: !1, global: !1, "throws": !0})
    }, n.fn.extend({
        wrapAll: function (e) {
            var t;
            return n.isFunction(e) ? this.each(function (t) {
                n(this).wrapAll(e.call(this, t))
            }) : (this[0] && (t = n(e, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && t.insertBefore(this[0]), t.map(function () {
                var e = this;
                while (e.firstElementChild)e = e.firstElementChild;
                return e
            }).append(this)), this)
        }, wrapInner: function (e) {
            return this.each(n.isFunction(e) ? function (t) {
                n(this).wrapInner(e.call(this, t))
            } : function () {
                var t = n(this), r = t.contents();
                r.length ? r.wrapAll(e) : t.append(e)
            })
        }, wrap: function (e) {
            var t = n.isFunction(e);
            return this.each(function (r) {
                n(this).wrapAll(t ? e.call(this, r) : e)
            })
        }, unwrap: function () {
            return this.parent().each(function () {
                n.nodeName(this, "body") || n(this).replaceWith(this.childNodes)
            }).end()
        }
    }), n.expr.filters.hidden = function (e) {
        return e.offsetWidth <= 0 && e.offsetHeight <= 0
    }, n.expr.filters.visible = function (e) {
        return !n.expr.filters.hidden(e)
    };
    var vb = /%20/g, wb = /\[\]$/, xb = /\r?\n/g, yb = /^(?:submit|button|image|reset|file)$/i, zb = /^(?:input|select|textarea|keygen)/i;
    n.param = function (e, t) {
        var r, i = [], s = function (e, t) {
            t = n.isFunction(t) ? t() : null == t ? "" : t, i[i.length] = encodeURIComponent(e) + "=" + encodeURIComponent(t)
        };
        if (void 0 === t && (t = n.ajaxSettings && n.ajaxSettings.traditional), n.isArray(e) || e.jquery && !n.isPlainObject(e))n.each(e, function () {
            s(this.name, this.value)
        }); else for (r in e)Ab(r, e[r], t, s);
        return i.join("&").replace(vb, "+")
    }, n.fn.extend({
        serialize: function () {
            return n.param(this.serializeArray())
        }, serializeArray: function () {
            return this.map(function () {
                var e = n.prop(this, "elements");
                return e ? n.makeArray(e) : this
            }).filter(function () {
                var e = this.type;
                return this.name && !n(this).is(":disabled") && zb.test(this.nodeName) && !yb.test(e) && (this.checked || !T.test(e))
            }).map(function (e, t) {
                var r = n(this).val();
                return null == r ? null : n.isArray(r) ? n.map(r, function (e) {
                    return {name: t.name, value: e.replace(xb, "\r\n")}
                }) : {name: t.name, value: r.replace(xb, "\r\n")}
            }).get()
        }
    }), n.ajaxSettings.xhr = function () {
        try {
            return new XMLHttpRequest
        } catch (e) {
        }
    };
    var Bb = 0, Cb = {}, Db = {0: 200, 1223: 204}, Eb = n.ajaxSettings.xhr();
    a.attachEvent && a.attachEvent("onunload", function () {
        for (var e in Cb)Cb[e]()
    }), k.cors = !!Eb && "withCredentials" in Eb, k.ajax = Eb = !!Eb, n.ajaxTransport(function (e) {
        var t;
        return k.cors || Eb && !e.crossDomain ? {
            send: function (n, r) {
                var i, s = e.xhr(), o = ++Bb;
                if (s.open(e.type, e.url, e.async, e.username, e.password), e.xhrFields)for (i in e.xhrFields)s[i] = e.xhrFields[i];
                e.mimeType && s.overrideMimeType && s.overrideMimeType(e.mimeType), e.crossDomain || n["X-Requested-With"] || (n["X-Requested-With"] = "XMLHttpRequest");
                for (i in n)s.setRequestHeader(i, n[i]);
                t = function (e) {
                    return function () {
                        t && (delete Cb[o], t = s.onload = s.onerror = null, "abort" === e ? s.abort() : "error" === e ? r(s.status, s.statusText) : r(Db[s.status] || s.status, s.statusText, "string" == typeof s.responseText ? {text: s.responseText} : void 0, s.getAllResponseHeaders()))
                    }
                }, s.onload = t(), s.onerror = t("error"), t = Cb[o] = t("abort");
                try {
                    s.send(e.hasContent && e.data || null)
                } catch (u) {
                    if (t)throw u
                }
            }, abort: function () {
                t && t()
            }
        } : void 0
    }), n.ajaxSetup({
        accepts: {script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},
        contents: {script: /(?:java|ecma)script/},
        converters: {
            "text script": function (e) {
                return n.globalEval(e), e
            }
        }
    }), n.ajaxPrefilter("script", function (e) {
        void 0 === e.cache && (e.cache = !1), e.crossDomain && (e.type = "GET")
    }), n.ajaxTransport("script", function (e) {
        if (e.crossDomain) {
            var t, r;
            return {
                send: function (i, s) {
                    t = n("<script>").prop({
                        async: !0,
                        charset: e.scriptCharset,
                        src: e.url
                    }).on("load error", r = function (e) {
                        t.remove(), r = null, e && s("error" === e.type ? 404 : 200, e.type)
                    }), l.head.appendChild(t[0])
                }, abort: function () {
                    r && r()
                }
            }
        }
    });
    var Fb = [], Gb = /(=)\?(?=&|$)|\?\?/;
    n.ajaxSetup({
        jsonp: "callback", jsonpCallback: function () {
            var e = Fb.pop() || n.expando + "_" + cb++;
            return this[e] = !0, e
        }
    }), n.ajaxPrefilter("json jsonp", function (e, t, r) {
        var i, s, o, u = e.jsonp !== !1 && (Gb.test(e.url) ? "url" : "string" == typeof e.data && !(e.contentType || "").indexOf("application/x-www-form-urlencoded") && Gb.test(e.data) && "data");
        return u || "jsonp" === e.dataTypes[0] ? (i = e.jsonpCallback = n.isFunction(e.jsonpCallback) ? e.jsonpCallback() : e.jsonpCallback, u ? e[u] = e[u].replace(Gb, "$1" + i) : e.jsonp !== !1 && (e.url += (db.test(e.url) ? "&" : "?") + e.jsonp + "=" + i), e.converters["script json"] = function () {
            return o || n.error(i + " was not called"), o[0]
        }, e.dataTypes[0] = "json", s = a[i], a[i] = function () {
            o = arguments
        }, r.always(function () {
            a[i] = s, e[i] && (e.jsonpCallback = t.jsonpCallback, Fb.push(i)), o && n.isFunction(s) && s(o[0]), o = s = void 0
        }), "script") : void 0
    }), n.parseHTML = function (e, t, r) {
        if (!e || "string" != typeof e)return null;
        "boolean" == typeof t && (r = t, t = !1), t = t || l;
        var i = v.exec(e), s = !r && [];
        return i ? [t.createElement(i[1])] : (i = n.buildFragment([e], t, s), s && s.length && n(s).remove(), n.merge([], i.childNodes))
    };
    var Hb = n.fn.load;
    n.fn.load = function (e, t, r) {
        if ("string" != typeof e && Hb)return Hb.apply(this, arguments);
        var i, s, o, u = this, a = e.indexOf(" ");
        return a >= 0 && (i = n.trim(e.slice(a)), e = e.slice(0, a)), n.isFunction(t) ? (r = t, t = void 0) : t && "object" == typeof t && (s = "POST"), u.length > 0 && n.ajax({
            url: e,
            type: s,
            dataType: "html",
            data: t
        }).done(function (e) {
            o = arguments, u.html(i ? n("<div>").append(n.parseHTML(e)).find(i) : e)
        }).complete(r && function (e, t) {
                u.each(r, o || [e.responseText, t, e])
            }), this
    }, n.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function (e, t) {
        n.fn[t] = function (e) {
            return this.on(t, e)
        }
    }), n.expr.filters.animated = function (e) {
        return n.grep(n.timers, function (t) {
            return e === t.elem
        }).length
    };
    var Ib = a.document.documentElement;
    n.offset = {
        setOffset: function (e, t, r) {
            var i, s, o, u, a, f, l, c = n.css(e, "position"), h = n(e), p = {};
            "static" === c && (e.style.position = "relative"), a = h.offset(), o = n.css(e, "top"), f = n.css(e, "left"), l = ("absolute" === c || "fixed" === c) && (o + f).indexOf("auto") > -1, l ? (i = h.position(), u = i.top, s = i.left) : (u = parseFloat(o) || 0, s = parseFloat(f) || 0), n.isFunction(t) && (t = t.call(e, r, a)), null != t.top && (p.top = t.top - a.top + u), null != t.left && (p.left = t.left - a.left + s), "using" in t ? t.using.call(e, p) : h.css(p)
        }
    }, n.fn.extend({
        offset: function (e) {
            if (arguments.length)return void 0 === e ? this : this.each(function (t) {
                n.offset.setOffset(this, e, t)
            });
            var t, r, i = this[0], s = {top: 0, left: 0}, o = i && i.ownerDocument;
            if (o)return t = o.documentElement, n.contains(t, i) ? (typeof i.getBoundingClientRect !== U && (s = i.getBoundingClientRect()), r = Jb(o), {
                top: s.top + r.pageYOffset - t.clientTop,
                left: s.left + r.pageXOffset - t.clientLeft
            }) : s
        }, position: function () {
            if (this[0]) {
                var e, t, r = this[0], i = {top: 0, left: 0};
                return "fixed" === n.css(r, "position") ? t = r.getBoundingClientRect() : (e = this.offsetParent(), t = this.offset(), n.nodeName(e[0], "html") || (i = e.offset()), i.top += n.css(e[0], "borderTopWidth", !0), i.left += n.css(e[0], "borderLeftWidth", !0)), {
                    top: t.top - i.top - n.css(r, "marginTop", !0),
                    left: t.left - i.left - n.css(r, "marginLeft", !0)
                }
            }
        }, offsetParent: function () {
            return this.map(function () {
                var e = this.offsetParent || Ib;
                while (e && !n.nodeName(e, "html") && "static" === n.css(e, "position"))e = e.offsetParent;
                return e || Ib
            })
        }
    }), n.each({scrollLeft: "pageXOffset", scrollTop: "pageYOffset"}, function (e, t) {
        var r = "pageYOffset" === t;
        n.fn[e] = function (n) {
            return J(this, function (e, n, i) {
                var s = Jb(e);
                return void 0 === i ? s ? s[t] : e[n] : void (s ? s.scrollTo(r ? a.pageXOffset : i, r ? i : a.pageYOffset) : e[n] = i)
            }, e, n, arguments.length, null)
        }
    }), n.each(["top", "left"], function (e, t) {
        n.cssHooks[t] = ya(k.pixelPosition, function (e, r) {
            return r ? (r = xa(e, t), va.test(r) ? n(e).position()[t] + "px" : r) : void 0
        })
    }), n.each({Height: "height", Width: "width"}, function (e, t) {
        n.each({padding: "inner" + e, content: t, "": "outer" + e}, function (r, i) {
            n.fn[i] = function (i, s) {
                var o = arguments.length && (r || "boolean" != typeof i), u = r || (i === !0 || s === !0 ? "margin" : "border");
                return J(this, function (t, r, i) {
                    var s;
                    return n.isWindow(t) ? t.document.documentElement["client" + e] : 9 === t.nodeType ? (s = t.documentElement, Math.max(t.body["scroll" + e], s["scroll" + e], t.body["offset" + e], s["offset" + e], s["client" + e])) : void 0 === i ? n.css(t, r, u) : n.style(t, r, i, u)
                }, t, o ? i : void 0, o, null)
            }
        })
    }), n.fn.size = function () {
        return this.length
    }, n.fn.andSelf = n.fn.addBack, "function" == typeof define && define.amd && define("jquery", [], function () {
        return n
    });
    var Kb = a.jQuery, Lb = a.$;
    return n.noConflict = function (e) {
        return a.$ === n && (a.$ = Lb), e && a.jQuery === n && (a.jQuery = Kb), n
    }, typeof b === U && (a.jQuery = a.$ = n), n
}), define("primary/jquery.min", function () {
}), function () {
    function e(e) {
        function t(t, n, r, i, s, o) {
            for (; s >= 0 && o > s; s += e) {
                var u = i ? i[s] : s;
                r = n(r, t[u], u, t)
            }
            return r
        }

        return function (n, r, i, s) {
            r = b(r, s, 4);
            var o = !C(n) && y.keys(n), u = (o || n).length, a = e > 0 ? 0 : u - 1;
            return arguments.length < 3 && (i = n[o ? o[a] : a], a += e), t(n, r, i, o, a, u)
        }
    }

    function t(e) {
        return function (t, n, r) {
            n = w(n, r);
            for (var i = N(t), s = e > 0 ? 0 : i - 1; s >= 0 && i > s; s += e)if (n(t[s], s, t))return s;
            return -1
        }
    }

    function n(e, t, n) {
        return function (r, i, s) {
            var o = 0, u = N(r);
            if ("number" == typeof s)e > 0 ? o = s >= 0 ? s : Math.max(s + u, o) : u = s >= 0 ? Math.min(s + 1, u) : s + u + 1; else if (n && s && u)return s = n(r, i), r[s] === i ? s : -1;
            if (i !== i)return s = t(l.call(r, o, u), y.isNaN), s >= 0 ? s + o : -1;
            for (s = e > 0 ? o : u - 1; s >= 0 && u > s; s += e)if (r[s] === i)return s;
            return -1
        }
    }

    function r(e, t) {
        var n = M.length, r = e.constructor, i = y.isFunction(r) && r.prototype || u, s = "constructor";
        for (y.has(e, s) && !y.contains(t, s) && t.push(s); n--;)s = M[n], s in e && e[s] !== i[s] && !y.contains(t, s) && t.push(s)
    }

    var i = this, s = i._, o = Array.prototype, u = Object.prototype, a = Function.prototype, f = o.push, l = o.slice, c = u.toString, h = u.hasOwnProperty, p = Array.isArray, d = Object.keys, v = a.bind, m = Object.create, g = function () {
    }, y = function (e) {
        return e instanceof y ? e : this instanceof y ? void (this._wrapped = e) : new y(e)
    };
    "undefined" != typeof exports ? ("undefined" != typeof module && module.exports && (exports = module.exports = y), exports._ = y) : i._ = y, y.VERSION = "1.8.3";
    var b = function (e, t, n) {
        if (t === void 0)return e;
        switch (null == n ? 3 : n) {
            case 1:
                return function (n) {
                    return e.call(t, n)
                };
            case 2:
                return function (n, r) {
                    return e.call(t, n, r)
                };
            case 3:
                return function (n, r, i) {
                    return e.call(t, n, r, i)
                };
            case 4:
                return function (n, r, i, s) {
                    return e.call(t, n, r, i, s)
                }
        }
        return function () {
            return e.apply(t, arguments)
        }
    }, w = function (e, t, n) {
        return null == e ? y.identity : y.isFunction(e) ? b(e, t, n) : y.isObject(e) ? y.matcher(e) : y.property(e)
    };
    y.iteratee = function (e, t) {
        return w(e, t, 1 / 0)
    };
    var E = function (e, t) {
        return function (n) {
            var r = arguments.length;
            if (2 > r || null == n)return n;
            for (var i = 1; r > i; i++)for (var s = arguments[i], o = e(s), u = o.length, a = 0; u > a; a++) {
                var f = o[a];
                t && n[f] !== void 0 || (n[f] = s[f])
            }
            return n
        }
    }, S = function (e) {
        if (!y.isObject(e))return {};
        if (m)return m(e);
        g.prototype = e;
        var t = new g;
        return g.prototype = null, t
    }, x = function (e) {
        return function (t) {
            return null == t ? void 0 : t[e]
        }
    }, T = Math.pow(2, 53) - 1, N = x("length"), C = function (e) {
        var t = N(e);
        return "number" == typeof t && t >= 0 && T >= t
    };
    y.each = y.forEach = function (e, t, n) {
        t = b(t, n);
        var r, i;
        if (C(e))for (r = 0, i = e.length; i > r; r++)t(e[r], r, e); else {
            var s = y.keys(e);
            for (r = 0, i = s.length; i > r; r++)t(e[s[r]], s[r], e)
        }
        return e
    }, y.map = y.collect = function (e, t, n) {
        t = w(t, n);
        for (var r = !C(e) && y.keys(e), i = (r || e).length, s = Array(i), o = 0; i > o; o++) {
            var u = r ? r[o] : o;
            s[o] = t(e[u], u, e)
        }
        return s
    }, y.reduce = y.foldl = y.inject = e(1), y.reduceRight = y.foldr = e(-1), y.find = y.detect = function (e, t, n) {
        var r;
        return r = C(e) ? y.findIndex(e, t, n) : y.findKey(e, t, n), r !== void 0 && r !== -1 ? e[r] : void 0
    }, y.filter = y.select = function (e, t, n) {
        var r = [];
        return t = w(t, n), y.each(e, function (e, n, i) {
            t(e, n, i) && r.push(e)
        }), r
    }, y.reject = function (e, t, n) {
        return y.filter(e, y.negate(w(t)), n)
    }, y.every = y.all = function (e, t, n) {
        t = w(t, n);
        for (var r = !C(e) && y.keys(e), i = (r || e).length, s = 0; i > s; s++) {
            var o = r ? r[s] : s;
            if (!t(e[o], o, e))return !1
        }
        return !0
    }, y.some = y.any = function (e, t, n) {
        t = w(t, n);
        for (var r = !C(e) && y.keys(e), i = (r || e).length, s = 0; i > s; s++) {
            var o = r ? r[s] : s;
            if (t(e[o], o, e))return !0
        }
        return !1
    }, y.contains = y.includes = y.include = function (e, t, n, r) {
        return C(e) || (e = y.values(e)), ("number" != typeof n || r) && (n = 0), y.indexOf(e, t, n) >= 0
    }, y.invoke = function (e, t) {
        var n = l.call(arguments, 2), r = y.isFunction(t);
        return y.map(e, function (e) {
            var i = r ? t : e[t];
            return null == i ? i : i.apply(e, n)
        })
    }, y.pluck = function (e, t) {
        return y.map(e, y.property(t))
    }, y.where = function (e, t) {
        return y.filter(e, y.matcher(t))
    }, y.findWhere = function (e, t) {
        return y.find(e, y.matcher(t))
    }, y.max = function (e, t, n) {
        var r, i, s = -1 / 0, o = -1 / 0;
        if (null == t && null != e) {
            e = C(e) ? e : y.values(e);
            for (var u = 0, a = e.length; a > u; u++)r = e[u], r > s && (s = r)
        } else t = w(t, n), y.each(e, function (e, n, r) {
            i = t(e, n, r), (i > o || i === -1 / 0 && s === -1 / 0) && (s = e, o = i)
        });
        return s
    }, y.min = function (e, t, n) {
        var r, i, s = 1 / 0, o = 1 / 0;
        if (null == t && null != e) {
            e = C(e) ? e : y.values(e);
            for (var u = 0, a = e.length; a > u; u++)r = e[u], s > r && (s = r)
        } else t = w(t, n), y.each(e, function (e, n, r) {
            i = t(e, n, r), (o > i || 1 / 0 === i && 1 / 0 === s) && (s = e, o = i)
        });
        return s
    }, y.shuffle = function (e) {
        for (var t, n = C(e) ? e : y.values(e), r = n.length, i = Array(r), s = 0; r > s; s++)t = y.random(0, s), t !== s && (i[s] = i[t]), i[t] = n[s];
        return i
    }, y.sample = function (e, t, n) {
        return null == t || n ? (C(e) || (e = y.values(e)), e[y.random(e.length - 1)]) : y.shuffle(e).slice(0, Math.max(0, t))
    }, y.sortBy = function (e, t, n) {
        return t = w(t, n), y.pluck(y.map(e, function (e, n, r) {
            return {value: e, index: n, criteria: t(e, n, r)}
        }).sort(function (e, t) {
            var n = e.criteria, r = t.criteria;
            if (n !== r) {
                if (n > r || n === void 0)return 1;
                if (r > n || r === void 0)return -1
            }
            return e.index - t.index
        }), "value")
    };
    var k = function (e) {
        return function (t, n, r) {
            var i = {};
            return n = w(n, r), y.each(t, function (r, s) {
                var o = n(r, s, t);
                e(i, r, o)
            }), i
        }
    };
    y.groupBy = k(function (e, t, n) {
        y.has(e, n) ? e[n].push(t) : e[n] = [t]
    }), y.indexBy = k(function (e, t, n) {
        e[n] = t
    }), y.countBy = k(function (e, t, n) {
        y.has(e, n) ? e[n]++ : e[n] = 1
    }), y.toArray = function (e) {
        return e ? y.isArray(e) ? l.call(e) : C(e) ? y.map(e, y.identity) : y.values(e) : []
    }, y.size = function (e) {
        return null == e ? 0 : C(e) ? e.length : y.keys(e).length
    }, y.partition = function (e, t, n) {
        t = w(t, n);
        var r = [], i = [];
        return y.each(e, function (e, n, s) {
            (t(e, n, s) ? r : i).push(e)
        }), [r, i]
    }, y.first = y.head = y.take = function (e, t, n) {
        return null == e ? void 0 : null == t || n ? e[0] : y.initial(e, e.length - t)
    }, y.initial = function (e, t, n) {
        return l.call(e, 0, Math.max(0, e.length - (null == t || n ? 1 : t)))
    }, y.last = function (e, t, n) {
        return null == e ? void 0 : null == t || n ? e[e.length - 1] : y.rest(e, Math.max(0, e.length - t))
    }, y.rest = y.tail = y.drop = function (e, t, n) {
        return l.call(e, null == t || n ? 1 : t)
    }, y.compact = function (e) {
        return y.filter(e, y.identity)
    };
    var L = function (e, t, n, r) {
        for (var i = [], s = 0, o = r || 0, u = N(e); u > o; o++) {
            var a = e[o];
            if (C(a) && (y.isArray(a) || y.isArguments(a))) {
                t || (a = L(a, t, n));
                var f = 0, l = a.length;
                for (i.length += l; l > f;)i[s++] = a[f++]
            } else n || (i[s++] = a)
        }
        return i
    };
    y.flatten = function (e, t) {
        return L(e, t, !1)
    }, y.without = function (e) {
        return y.difference(e, l.call(arguments, 1))
    }, y.uniq = y.unique = function (e, t, n, r) {
        y.isBoolean(t) || (r = n, n = t, t = !1), null != n && (n = w(n, r));
        for (var i = [], s = [], o = 0, u = N(e); u > o; o++) {
            var a = e[o], f = n ? n(a, o, e) : a;
            t ? (o && s === f || i.push(a), s = f) : n ? y.contains(s, f) || (s.push(f), i.push(a)) : y.contains(i, a) || i.push(a)
        }
        return i
    }, y.union = function () {
        return y.uniq(L(arguments, !0, !0))
    }, y.intersection = function (e) {
        for (var t = [], n = arguments.length, r = 0, i = N(e); i > r; r++) {
            var s = e[r];
            if (!y.contains(t, s)) {
                for (var o = 1; n > o && y.contains(arguments[o], s); o++);
                o === n && t.push(s)
            }
        }
        return t
    }, y.difference = function (e) {
        var t = L(arguments, !0, !0, 1);
        return y.filter(e, function (e) {
            return !y.contains(t, e)
        })
    }, y.zip = function () {
        return y.unzip(arguments)
    }, y.unzip = function (e) {
        for (var t = e && y.max(e, N).length || 0, n = Array(t), r = 0; t > r; r++)n[r] = y.pluck(e, r);
        return n
    }, y.object = function (e, t) {
        for (var n = {}, r = 0, i = N(e); i > r; r++)t ? n[e[r]] = t[r] : n[e[r][0]] = e[r][1];
        return n
    }, y.findIndex = t(1), y.findLastIndex = t(-1), y.sortedIndex = function (e, t, n, r) {
        n = w(n, r, 1);
        for (var i = n(t), s = 0, o = N(e); o > s;) {
            var u = Math.floor((s + o) / 2);
            n(e[u]) < i ? s = u + 1 : o = u
        }
        return s
    }, y.indexOf = n(1, y.findIndex, y.sortedIndex), y.lastIndexOf = n(-1, y.findLastIndex), y.range = function (e, t, n) {
        null == t && (t = e || 0, e = 0), n = n || 1;
        for (var r = Math.max(Math.ceil((t - e) / n), 0), i = Array(r), s = 0; r > s; s++, e += n)i[s] = e;
        return i
    };
    var A = function (e, t, n, r, i) {
        if (r instanceof t) {
            var s = S(e.prototype), o = e.apply(s, i);
            return y.isObject(o) ? o : s
        }
        return e.apply(n, i)
    };
    y.bind = function (e, t) {
        if (v && e.bind === v)return v.apply(e, l.call(arguments, 1));
        if (!y.isFunction(e))throw new TypeError("Bind must be called on a function");
        var n = l.call(arguments, 2), r = function () {
            return A(e, r, t, this, n.concat(l.call(arguments)))
        };
        return r
    }, y.partial = function (e) {
        var t = l.call(arguments, 1), n = function () {
            for (var r = 0, i = t.length, s = Array(i), o = 0; i > o; o++)s[o] = t[o] === y ? arguments[r++] : t[o];
            for (; r < arguments.length;)s.push(arguments[r++]);
            return A(e, n, this, this, s)
        };
        return n
    }, y.bindAll = function (e) {
        var t, n, r = arguments.length;
        if (1 >= r)throw new Error("bindAll must be passed function names");
        for (t = 1; r > t; t++)n = arguments[t], e[n] = y.bind(e[n], e);
        return e
    }, y.memoize = function (e, t) {
        var n = function (r) {
            var i = n.cache, s = "" + (t ? t.apply(this, arguments) : r);
            return y.has(i, s) || (i[s] = e.apply(this, arguments)), i[s]
        };
        return n.cache = {}, n
    }, y.delay = function (e, t) {
        var n = l.call(arguments, 2);
        return setTimeout(function () {
            return e.apply(null, n)
        }, t)
    }, y.defer = y.partial(y.delay, y, 1), y.throttle = function (e, t, n) {
        var r, i, s, o = null, u = 0;
        n || (n = {});
        var a = function () {
            u = n.leading === !1 ? 0 : y.now(), o = null, s = e.apply(r, i), o || (r = i = null)
        };
        return function () {
            var f = y.now();
            u || n.leading !== !1 || (u = f);
            var l = t - (f - u);
            return r = this, i = arguments, 0 >= l || l > t ? (o && (clearTimeout(o), o = null), u = f, s = e.apply(r, i), o || (r = i = null)) : o || n.trailing === !1 || (o = setTimeout(a, l)), s
        }
    }, y.debounce = function (e, t, n) {
        var r, i, s, o, u, a = function () {
            var f = y.now() - o;
            t > f && f >= 0 ? r = setTimeout(a, t - f) : (r = null, n || (u = e.apply(s, i), r || (s = i = null)))
        };
        return function () {
            s = this, i = arguments, o = y.now();
            var f = n && !r;
            return r || (r = setTimeout(a, t)), f && (u = e.apply(s, i), s = i = null), u
        }
    }, y.wrap = function (e, t) {
        return y.partial(t, e)
    }, y.negate = function (e) {
        return function () {
            return !e.apply(this, arguments)
        }
    }, y.compose = function () {
        var e = arguments, t = e.length - 1;
        return function () {
            for (var n = t, r = e[t].apply(this, arguments); n--;)r = e[n].call(this, r);
            return r
        }
    }, y.after = function (e, t) {
        return function () {
            return --e < 1 ? t.apply(this, arguments) : void 0
        }
    }, y.before = function (e, t) {
        var n;
        return function () {
            return --e > 0 && (n = t.apply(this, arguments)), 1 >= e && (t = null), n
        }
    }, y.once = y.partial(y.before, 2);
    var O = !{toString: null}.propertyIsEnumerable("toString"), M = ["valueOf", "isPrototypeOf", "toString", "propertyIsEnumerable", "hasOwnProperty", "toLocaleString"];
    y.keys = function (e) {
        if (!y.isObject(e))return [];
        if (d)return d(e);
        var t = [];
        for (var n in e)y.has(e, n) && t.push(n);
        return O && r(e, t), t
    }, y.allKeys = function (e) {
        if (!y.isObject(e))return [];
        var t = [];
        for (var n in e)t.push(n);
        return O && r(e, t), t
    }, y.values = function (e) {
        for (var t = y.keys(e), n = t.length, r = Array(n), i = 0; n > i; i++)r[i] = e[t[i]];
        return r
    }, y.mapObject = function (e, t, n) {
        t = w(t, n);
        for (var r, i = y.keys(e), s = i.length, o = {}, u = 0; s > u; u++)r = i[u], o[r] = t(e[r], r, e);
        return o
    }, y.pairs = function (e) {
        for (var t = y.keys(e), n = t.length, r = Array(n), i = 0; n > i; i++)r[i] = [t[i], e[t[i]]];
        return r
    }, y.invert = function (e) {
        for (var t = {}, n = y.keys(e), r = 0, i = n.length; i > r; r++)t[e[n[r]]] = n[r];
        return t
    }, y.functions = y.methods = function (e) {
        var t = [];
        for (var n in e)y.isFunction(e[n]) && t.push(n);
        return t.sort()
    }, y.extend = E(y.allKeys), y.extendOwn = y.assign = E(y.keys), y.findKey = function (e, t, n) {
        t = w(t, n);
        for (var r, i = y.keys(e), s = 0, o = i.length; o > s; s++)if (r = i[s], t(e[r], r, e))return r
    }, y.pick = function (e, t, n) {
        var r, i, s = {}, o = e;
        if (null == o)return s;
        y.isFunction(t) ? (i = y.allKeys(o), r = b(t, n)) : (i = L(arguments, !1, !1, 1), r = function (e, t, n) {
            return t in n
        }, o = Object(o));
        for (var u = 0, a = i.length; a > u; u++) {
            var f = i[u], l = o[f];
            r(l, f, o) && (s[f] = l)
        }
        return s
    }, y.omit = function (e, t, n) {
        if (y.isFunction(t))t = y.negate(t); else {
            var r = y.map(L(arguments, !1, !1, 1), String);
            t = function (e, t) {
                return !y.contains(r, t)
            }
        }
        return y.pick(e, t, n)
    }, y.defaults = E(y.allKeys, !0), y.create = function (e, t) {
        var n = S(e);
        return t && y.extendOwn(n, t), n
    }, y.clone = function (e) {
        return y.isObject(e) ? y.isArray(e) ? e.slice() : y.extend({}, e) : e
    }, y.tap = function (e, t) {
        return t(e), e
    }, y.isMatch = function (e, t) {
        var n = y.keys(t), r = n.length;
        if (null == e)return !r;
        for (var i = Object(e), s = 0; r > s; s++) {
            var o = n[s];
            if (t[o] !== i[o] || !(o in i))return !1
        }
        return !0
    };
    var _ = function (e, t, n, r) {
        if (e === t)return 0 !== e || 1 / e === 1 / t;
        if (null == e || null == t)return e === t;
        e instanceof y && (e = e._wrapped), t instanceof y && (t = t._wrapped);
        var i = c.call(e);
        if (i !== c.call(t))return !1;
        switch (i) {
            case"[object RegExp]":
            case"[object String]":
                return "" + e == "" + t;
            case"[object Number]":
                return +e !== +e ? +t !== +t : 0 === +e ? 1 / +e === 1 / t : +e === +t;
            case"[object Date]":
            case"[object Boolean]":
                return +e === +t
        }
        var s = "[object Array]" === i;
        if (!s) {
            if ("object" != typeof e || "object" != typeof t)return !1;
            var o = e.constructor, u = t.constructor;
            if (o !== u && !(y.isFunction(o) && o instanceof o && y.isFunction(u) && u instanceof u) && "constructor" in e && "constructor" in t)return !1
        }
        n = n || [], r = r || [];
        for (var a = n.length; a--;)if (n[a] === e)return r[a] === t;
        if (n.push(e), r.push(t), s) {
            if (a = e.length, a !== t.length)return !1;
            for (; a--;)if (!_(e[a], t[a], n, r))return !1
        } else {
            var f, l = y.keys(e);
            if (a = l.length, y.keys(t).length !== a)return !1;
            for (; a--;)if (f = l[a], !y.has(t, f) || !_(e[f], t[f], n, r))return !1
        }
        return n.pop(), r.pop(), !0
    };
    y.isEqual = function (e, t) {
        return _(e, t)
    }, y.isEmpty = function (e) {
        return null == e ? !0 : C(e) && (y.isArray(e) || y.isString(e) || y.isArguments(e)) ? 0 === e.length : 0 === y.keys(e).length
    }, y.isElement = function (e) {
        return !!e && 1 === e.nodeType
    }, y.isArray = p || function (e) {
            return "[object Array]" === c.call(e)
        }, y.isObject = function (e) {
        var t = typeof e;
        return "function" === t || "object" === t && !!e
    }, y.each(["Arguments", "Function", "String", "Number", "Date", "RegExp", "Error"], function (e) {
        y["is" + e] = function (t) {
            return c.call(t) === "[object " + e + "]"
        }
    }), y.isArguments(arguments) || (y.isArguments = function (e) {
        return y.has(e, "callee")
    }), "function" != typeof /./ && "object" != typeof Int8Array && (y.isFunction = function (e) {
        return "function" == typeof e || !1
    }), y.isFinite = function (e) {
        return isFinite(e) && !isNaN(parseFloat(e))
    }, y.isNaN = function (e) {
        return y.isNumber(e) && e !== +e
    }, y.isBoolean = function (e) {
        return e === !0 || e === !1 || "[object Boolean]" === c.call(e)
    }, y.isNull = function (e) {
        return null === e
    }, y.isUndefined = function (e) {
        return e === void 0
    }, y.has = function (e, t) {
        return null != e && h.call(e, t)
    }, y.noConflict = function () {
        return i._ = s, this
    }, y.identity = function (e) {
        return e
    }, y.constant = function (e) {
        return function () {
            return e
        }
    }, y.noop = function () {
    }, y.property = x, y.propertyOf = function (e) {
        return null == e ? function () {
        } : function (t) {
            return e[t]
        }
    }, y.matcher = y.matches = function (e) {
        return e = y.extendOwn({}, e), function (t) {
            return y.isMatch(t, e)
        }
    }, y.times = function (e, t, n) {
        var r = Array(Math.max(0, e));
        t = b(t, n, 1);
        for (var i = 0; e > i; i++)r[i] = t(i);
        return r
    }, y.random = function (e, t) {
        return null == t && (t = e, e = 0), e + Math.floor(Math.random() * (t - e + 1))
    }, y.now = Date.now || function () {
            return (new Date).getTime()
        };
    var D = {
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;",
        '"': "&quot;",
        "'": "&#x27;",
        "`": "&#x60;"
    }, P = y.invert(D), H = function (e) {
        var t = function (t) {
            return e[t]
        }, n = "(?:" + y.keys(e).join("|") + ")", r = RegExp(n), i = RegExp(n, "g");
        return function (e) {
            return e = null == e ? "" : "" + e, r.test(e) ? e.replace(i, t) : e
        }
    };
    y.escape = H(D), y.unescape = H(P), y.result = function (e, t, n) {
        var r = null == e ? void 0 : e[t];
        return r === void 0 && (r = n), y.isFunction(r) ? r.call(e) : r
    };
    var B = 0;
    y.uniqueId = function (e) {
        var t = ++B + "";
        return e ? e + t : t
    }, y.templateSettings = {evaluate: /<%([\s\S]+?)%>/g, interpolate: /<%=([\s\S]+?)%>/g, escape: /<%-([\s\S]+?)%>/g};
    var j = /(.)^/, F = {
        "'": "'",
        "\\": "\\",
        "\r": "r",
        "\n": "n",
        "\u2028": "u2028",
        "\u2029": "u2029"
    }, I = /\\|'|\r|\n|\u2028|\u2029/g, q = function (e) {
        return "\\" + F[e]
    };
    y.template = function (e, t, n) {
        !t && n && (t = n), t = y.defaults({}, t, y.templateSettings);
        var r = RegExp([(t.escape || j).source, (t.interpolate || j).source, (t.evaluate || j).source].join("|") + "|$", "g"), i = 0, s = "__p+='";
        e.replace(r, function (t, n, r, o, u) {
            return s += e.slice(i, u).replace(I, q), i = u + t.length, n ? s += "'+\n((__t=(" + n + "))==null?'':_.escape(__t))+\n'" : r ? s += "'+\n((__t=(" + r + "))==null?'':__t)+\n'" : o && (s += "';\n" + o + "\n__p+='"), t
        }), s += "';\n", t.variable || (s = "with(obj||{}){\n" + s + "}\n"), s = "var __t,__p='',__j=Array.prototype.join,print=function(){__p+=__j.call(arguments,'');};\n" + s + "return __p;\n";
        try {
            var o = new Function(t.variable || "obj", "_", s)
        } catch (u) {
            throw u.source = s, u
        }
        var a = function (e) {
            return o.call(this, e, y)
        }, f = t.variable || "obj";
        return a.source = "function(" + f + "){\n" + s + "}", a
    }, y.chain = function (e) {
        var t = y(e);
        return t._chain = !0, t
    };
    var R = function (e, t) {
        return e._chain ? y(t).chain() : t
    };
    y.mixin = function (e) {
        y.each(y.functions(e), function (t) {
            var n = y[t] = e[t];
            y.prototype[t] = function () {
                var e = [this._wrapped];
                return f.apply(e, arguments), R(this, n.apply(y, e))
            }
        })
    }, y.mixin(y), y.each(["pop", "push", "reverse", "shift", "sort", "splice", "unshift"], function (e) {
        var t = o[e];
        y.prototype[e] = function () {
            var n = this._wrapped;
            return t.apply(n, arguments), "shift" !== e && "splice" !== e || 0 !== n.length || delete n[0], R(this, n)
        }
    }), y.each(["concat", "join", "slice"], function (e) {
        var t = o[e];
        y.prototype[e] = function () {
            return R(this, t.apply(this._wrapped, arguments))
        }
    }), y.prototype.value = function () {
        return this._wrapped
    }, y.prototype.valueOf = y.prototype.toJSON = y.prototype.value, y.prototype.toString = function () {
        return "" + this._wrapped
    }, "function" == typeof define && define.amd && define("underscore", [], function () {
        return y
    })
}.call(this), define("primary/underscore.min", function () {
}), function (e) {
    e.fn.autoComplete = function (t) {
        var n = e.extend({}, e.fn.autoComplete.defaults, t);
        return typeof t == "string" ? (this.each(function () {
            var n = e(this);
            t == "destroy" && (e(window).off("resize.autocomplete", n.updateSC), n.off("blur.autocomplete focus.autocomplete keydown.autocomplete keyup.autocomplete"), n.data("autocomplete") ? n.attr("autocomplete", n.data("autocomplete")) : n.removeAttr("autocomplete"), e(n.data("sc")).remove(), n.removeData("sc").removeData("autocomplete"))
        }), this) : this.each(function () {
            function r(e) {
                var r = t.val();
                t.cache[r] = e;
                if (e.length && r.length >= n.minChars) {
                    var i = "";
                    for (var s = 0; s < e.length; s++)i += n.renderItem(e[s], r);
                    t.sc.html(i), t.updateSC(0)
                } else t.sc.hide()
            }

            var t = e(this);
            t.sc = e('<div class="autocomplete-suggestions ' + n.menuClass + '"></div>'), t.data("sc", t.sc).data("autocomplete", t.attr("autocomplete")), t.attr("autocomplete", "off"), t.cache = {}, t.lastVal = "", t.updateSC = function (n, r) {
                t.sc.css({top: t.offset().top + t.outerHeight(), left: t.offset().left, width: t.outerWidth()});
                if (!n) {
                    t.sc.show(), t.sc.maxHeight || (t.sc.maxHeight = parseInt(t.sc.css("max-height"))), t.sc.suggestionHeight || (t.sc.suggestionHeight = e(".autocomplete-suggestion", t.sc).first().outerHeight());
                    if (t.sc.suggestionHeight)if (!r)t.sc.scrollTop(0); else {
                        var i = t.sc.scrollTop(), s = r.offset().top - t.sc.offset().top;
                        s + t.sc.suggestionHeight - t.sc.maxHeight > 0 ? t.sc.scrollTop(s + t.sc.suggestionHeight + i - t.sc.maxHeight) : s < 0 && t.sc.scrollTop(s + i)
                    }
                }
            }, e(window).on("resize.autocomplete", t.updateSC), t.sc.appendTo("body"), t.sc.on("mouseleave", ".autocomplete-suggestion", function () {
                e(".autocomplete-suggestion.selected").removeClass("selected")
            }), t.sc.on("mouseenter", ".autocomplete-suggestion", function () {
                e(".autocomplete-suggestion.selected").removeClass("selected"), e(this).addClass("selected")
            }), t.sc.on("mouseup", ".autocomplete-suggestion", function (r) {
                var i = e(this), s = i.data("val");
                if (s || i.hasClass("autocomplete-suggestion"))t.val(s), n.onSelect(r, s, i), t.focus().sc.hide()
            }), t.on("blur.autocomplete", function () {
                try {
                    over_sb = e(".autocomplete-suggestions:hover").length
                } catch (n) {
                    over_sb = 0
                }
                over_sb ? t.focus() : (t.lastVal = t.val(), t.sc.hide())
            }), n.minChars || t.on("focus.autocomplete", function () {
                t.lastVal = "\n", t.trigger("keyup.autocomplete")
            }), t.on("keydown.autocomplete", function (r) {
                if (!(r.which != 40 && r.which != 38 || !t.sc.html())) {
                    var i, s = e(".autocomplete-suggestion.selected", t.sc);
                    return s.length ? (i = r.which == 40 ? s.next(".autocomplete-suggestion") : s.prev(".autocomplete-suggestion"), i.length ? (s.removeClass("selected"), t.val(i.addClass("selected").data("val"))) : (s.removeClass("selected"), t.val(t.lastVal), i = 0)) : (i = r.which == 40 ? e(".autocomplete-suggestion", t.sc).first() : e(".autocomplete-suggestion", t.sc).last(), t.val(i.addClass("selected").data("val"))), t.updateSC(0, i), !1
                }
                if (r.which == 27)t.val(t.lastVal).sc.hide(); else if (r.which == 13) {
                    var s = e(".autocomplete-suggestion.selected", t.sc);
                    s.length && (n.onSelect(r, s.data("val"), s), setTimeout(function () {
                        t.focus().sc.hide()
                    }, 10))
                }
            }), t.on("keyup.autocomplete", function (i) {
                if (!~e.inArray(i.which, [27, 38, 40, 37, 39])) {
                    var s = t.val();
                    if (s.length >= n.minChars) {
                        if (s != t.lastVal) {
                            t.lastVal = s, clearTimeout(t.timer);
                            if (n.cache) {
                                if (s in t.cache) {
                                    r(t.cache[s]);
                                    return
                                }
                                for (var u = 1; u < s.length - n.minChars; u++) {
                                    var a = s.slice(0, s.length - u);
                                    if (a in t.cache && !t.cache[a].length) {
                                        r([]);
                                        return
                                    }
                                }
                            }
                            t.timer = setTimeout(function () {
                                n.source(s, r)
                            }, n.delay)
                        }
                    } else t.lastVal = s, t.sc.hide()
                }
            })
        })
    }, e.fn.autoComplete.defaults = {
        source: 0,
        minChars: 3,
        delay: 150,
        cache: 1,
        menuClass: "",
        renderItem: function (e, t) {
            var n = new RegExp("(" + t.split(" ").join("|") + ")", "gi");
            return '<div class="autocomplete-suggestion" data-val="' + e + '">' + e.replace(n, "<b>$1</b>") + "</div>"
        },
        onSelect: function (e, t, n) {
        }
    }
}(jQuery), define("primary/jquery.ac", function () {
}), +function (e) {
    "use strict";
    function i(r) {
        if (r && r.which === 3)return;
        e(t).remove(), e(n).each(function () {
            var t = e(this), n = s(t), i = {relatedTarget: this};
            if (!n.hasClass("open"))return;
            n.trigger(r = e.Event("hide.bs.dropdown", i));
            if (r.isDefaultPrevented())return;
            t.attr("aria-expanded", "false"), n.removeClass("open").trigger("hidden.bs.dropdown", i)
        })
    }

    function s(t) {
        var n = t.attr("data-target");
        n || (n = t.attr("href"), n = n && /#[A-Za-z]/.test(n) && n.replace(/.*(?=#[^\s]*$)/, ""));
        var r = n && e(n);
        return r && r.length ? r : t.parent()
    }

    function o(t) {
        return this.each(function () {
            var n = e(this), i = n.data("bs.dropdown");
            i || n.data("bs.dropdown", i = new r(this)), typeof t == "string" && i[t].call(n)
        })
    }

    var t = ".dropdown-backdrop", n = '[data-toggle="btn-dropdown"]', r = function (t) {
        e(t).on("click.bs.dropdown", this.toggle)
    };
    r.VERSION = "3.3.4", r.prototype.toggle = function (t) {
        var n = e(this);
        if (n.is(".disabled, :disabled"))return;
        var r = s(n), o = r.hasClass("open"), u = n.data("remote");
        console.log(u), typeof u != "undefined" && u && (n.data("remote", !1), K.ajax(u, n.data("object")).done(function (e) {
            r.find("ul").html(e.html)
        })), i();
        if (!o) {
            "ontouchstart" in document.documentElement && !r.closest(".navbar-nav").length && e('<div class="dropdown-backdrop"/>').insertAfter(e(this)).on("click", i);
            var a = {relatedTarget: this};
            r.trigger(t = e.Event("show.bs.dropdown", a));
            if (t.isDefaultPrevented())return;
            n.trigger("focus").attr("aria-expanded", "true"), r.toggleClass("open").trigger("shown.bs.dropdown", a)
        }
        return !1
    }, r.prototype.keydown = function (t) {
        if (!/(38|40|27|32)/.test(t.which) || /input|textarea/i.test(t.target.tagName))return;
        var r = e(this);
        t.preventDefault(), t.stopPropagation();
        if (r.is(".disabled, :disabled"))return;
        var i = s(r), o = i.hasClass("open");
        if (!o && t.which != 27 || o && t.which == 27)return t.which == 27 && i.find(n).trigger("focus"), r.trigger("click");
        var u = " li:not(.disabled):visible a", a = i.find('[role="menu"]' + u + ', [role="listbox"]' + u);
        if (!a.length)return;
        var f = a.index(t.target);
        t.which == 38 && f > 0 && f--, t.which == 40 && f < a.length - 1 && f++, ~f || (f = 0), a.eq(f).trigger("focus")
    };
    var u = e.fn.dropdown;
    e.fn.dropdown = o, e.fn.dropdown.Constructor = r, e.fn.dropdown.noConflict = function () {
        return e.fn.dropdown = u, this
    }, e(document).on("click.bs.dropdown.data-api", i).on("click.bs.dropdown.data-api", ".dropdown form", function (e) {
        e.stopPropagation()
    }).on("click.bs.dropdown.data-api", n, r.prototype.toggle).on("keydown.bs.dropdown.data-api", n, r.prototype.keydown).on("keydown.bs.dropdown.data-api", '[role="menu"]', r.prototype.keydown).on("keydown.bs.dropdown.data-api", '[role="listbox"]', r.prototype.keydown)
}(jQuery), define("primary/jquery.dropdown", function () {
}), function (e) {
    jQuery.fn.extend({
        elastic: function () {
            var t = ["paddingTop", "paddingRight", "paddingBottom", "paddingLeft", "fontSize", "lineHeight", "fontFamily", "width", "fontWeight", "border-top-width", "border-right-width", "border-bottom-width", "border-left-width", "borderTopStyle", "borderTopColor", "borderRightStyle", "borderRightColor", "borderBottomStyle", "borderBottomColor", "borderLeftStyle", "borderLeftColor"];
            return this.each(function () {
                function f() {
                    var e = Math.floor(parseInt(n.width(), 10));
                    r.width() !== e && (r.css({width: e + "px"}), c(!0))
                }

                function l(e, t) {
                    var r = Math.floor(parseInt(e, 10));
                    n.height() !== r && n.css({height: r + "px", overflow: t})
                }

                function c(e) {
                    var t = n.val().replace(/&/g, "&amp;").replace(/ {2}/g, "&nbsp;").replace(/<|>/g, "&gt;").replace(/\n/g, "<br />"), u = r.html().replace(/<br>/ig, "<br />");
                    if (e || t + "&nbsp;" !== u) {
                        r.html(t + "&nbsp;");
                        if (Math.abs(r.height() + i - n.height()) > 3) {
                            var a = r.height() + i;
                            a >= o ? l(o, "auto") : a <= s ? l(s, "hidden") : l(a, "hidden")
                        }
                    }
                }

                if (this.type !== "textarea")return !1;
                var n = jQuery(this), r = jQuery("<div />").css({
                    position: "absolute",
                    display: "none",
                    "word-wrap": "break-word",
                    "white-space": "pre-wrap"
                }), i = parseInt(n.css("line-height"), 10) || parseInt(n.css("font-size"), "10"), s = parseInt(n.css("height"), 10) || i * 3, o = parseInt(n.css("max-height"), 10) || Number.MAX_VALUE, u = 0;
                o < 0 && (o = Number.MAX_VALUE), r.appendTo(n.parent());
                var a = t.length;
                while (a--)r.css(t[a].toString(), n.css(t[a].toString()));
                n.css({overflow: "hidden"}), n.bind("keyup change cut paste", function () {
                    c()
                }), e(window).bind("resize", f), n.bind("resize", f), n.bind("update", c), n.bind("blur", function () {
                    r.height() < o && (r.height() > s ? n.height(r.height()) : n.height(s))
                }), n.bind("input paste", function (e) {
                    setTimeout(c, 250)
                }), c()
            })
        }
    })
}(jQuery), define("primary/jquery.elastic", function () {
}), function (e) {
    e.Jcrop = function (t, n) {
        function a(e) {
            return Math.round(e) + "px"
        }

        function f(e) {
            return r.baseClass + "-" + e
        }

        function l() {
            return e.fx.step.hasOwnProperty("backgroundColor")
        }

        function c(t) {
            var n = e(t).offset();
            return [n.left, n.top]
        }

        function h(e) {
            return [e.pageX - i[0], e.pageY - i[1]]
        }

        function p(t) {
            typeof t != "object" && (t = {}), r = e.extend(r, t), e.each(["onChange", "onSelect", "onRelease", "onDblClick"], function (e, t) {
                typeof r[t] != "function" && (r[t] = function () {
                })
            })
        }

        function d(e, t, n) {
            i = c(A), nt.setCursor(e === "move" ? e : e + "-resize");
            if (e === "move")return nt.activateHandlers(m(t), E, n);
            var r = Z.getFixed(), s = g(e), o = Z.getCorner(g(s));
            Z.setPressed(Z.getCorner(s)), Z.setCurrent(o), nt.activateHandlers(v(e, r), E, n)
        }

        function v(e, t) {
            return function (n) {
                if (!r.aspectRatio)switch (e) {
                    case"e":
                        n[1] = t.y2;
                        break;
                    case"w":
                        n[1] = t.y2;
                        break;
                    case"n":
                        n[0] = t.x2;
                        break;
                    case"s":
                        n[0] = t.x2
                } else switch (e) {
                    case"e":
                        n[1] = t.y + 1;
                        break;
                    case"w":
                        n[1] = t.y + 1;
                        break;
                    case"n":
                        n[0] = t.x + 1;
                        break;
                    case"s":
                        n[0] = t.x + 1
                }
                Z.setCurrent(n), tt.update()
            }
        }

        function m(e) {
            var t = e;
            return rt.watchKeys(), function (e) {
                Z.moveOffset([e[0] - t[0], e[1] - t[1]]), t = e, tt.update()
            }
        }

        function g(e) {
            switch (e) {
                case"n":
                    return "sw";
                case"s":
                    return "nw";
                case"e":
                    return "nw";
                case"w":
                    return "ne";
                case"ne":
                    return "sw";
                case"nw":
                    return "se";
                case"se":
                    return "nw";
                case"sw":
                    return "ne"
            }
        }

        function y(e) {
            return function (t) {
                return r.disabled ? !1 : e === "move" && !r.allowMove ? !1 : (i = c(A), K = !0, d(e, h(t)), t.stopPropagation(), t.preventDefault(), !1)
            }
        }

        function b(e, t, n) {
            var r = e.width(), i = e.height();
            r > t && t > 0 && (r = t, i = t / e.width() * e.height()), i > n && n > 0 && (i = n, r = n / e.height() * e.width()), X = e.width() / r, V = e.height() / i, e.width(r).height(i)
        }

        function w(e) {
            return {x: e.x * X, y: e.y * V, x2: e.x2 * X, y2: e.y2 * V, w: e.w * X, h: e.h * V}
        }

        function E(e) {
            var t = Z.getFixed();
            t.w > r.minSelect[0] && t.h > r.minSelect[1] ? (tt.enableHandles(), tt.done()) : tt.release(), nt.setCursor(r.allowSelect ? "crosshair" : "default")
        }

        function S(e) {
            if (r.disabled)return !1;
            if (!r.allowSelect)return !1;
            K = !0, i = c(A), tt.disableHandles(), nt.setCursor("crosshair");
            var t = h(e);
            return Z.setPressed(t), tt.update(), nt.activateHandlers(x, E, e.type.substring(0, 5) === "touch"), rt.watchKeys(), e.stopPropagation(), e.preventDefault(), !1
        }

        function x(e) {
            Z.setCurrent(e), tt.update()
        }

        function T() {
            var t = e("<div></div>").addClass(f("tracker"));
            return o && t.css({opacity: 0, backgroundColor: "white"}), t
        }

        function it(e) {
            _.removeClass().addClass(f("holder")).addClass(e)
        }

        function st(e, t) {
            function b() {
                window.setTimeout(w, c)
            }

            var n = e[0] / X, i = e[1] / V, s = e[2] / X, o = e[3] / V;
            if (Q)return;
            var u = Z.flipCoords(n, i, s, o), a = Z.getFixed(), f = [a.x, a.y, a.x2, a.y2], l = f, c = r.animationDelay, h = u[0] - f[0], p = u[1] - f[1], d = u[2] - f[2], v = u[3] - f[3], m = 0, g = r.swingSpeed;
            n = l[0], i = l[1], s = l[2], o = l[3], tt.animMode(!0);
            var y, w = function () {
                return function () {
                    m += (100 - m) / g, l[0] = Math.round(n + m / 100 * h), l[1] = Math.round(i + m / 100 * p), l[2] = Math.round(s + m / 100 * d), l[3] = Math.round(o + m / 100 * v), m >= 99.8 && (m = 100), m < 100 ? (ut(l), b()) : (tt.done(), tt.animMode(!1), typeof t == "function" && t.call(yt))
                }
            }();
            b()
        }

        function ot(e) {
            ut([e[0] / X, e[1] / V, e[2] / X, e[3] / V]), r.onSelect.call(yt, w(Z.getFixed())), tt.enableHandles()
        }

        function ut(e) {
            Z.setPressed([e[0], e[1]]), Z.setCurrent([e[2], e[3]]), tt.update()
        }

        function at() {
            return w(Z.getFixed())
        }

        function ft() {
            return Z.getFixed()
        }

        function lt(e) {
            p(e), gt()
        }

        function ct() {
            r.disabled = !0, tt.disableHandles(), tt.setCursor("default"), nt.setCursor("default")
        }

        function ht() {
            r.disabled = !1, gt()
        }

        function pt() {
            tt.done(), nt.activateHandlers(null, null)
        }

        function dt() {
            _.remove(), C.show(), C.css("visibility", "visible"), e(t).removeData("Jcrop")
        }

        function vt(e, t) {
            tt.release(), ct();
            var n = new Image;
            n.onload = function () {
                var i = n.width, s = n.height, o = r.boxWidth, u = r.boxHeight;
                A.width(i).height(s), A.attr("src", e), D.attr("src", e), b(A, o, u), O = A.width(), M = A.height(), D.width(O).height(M), F.width(O + j * 2).height(M + j * 2), _.width(O).height(M), et.resize(O, M), ht(), typeof t == "function" && t.call(yt)
            }, n.src = e
        }

        function mt(e, t, n) {
            var i = t || r.bgColor;
            r.bgFade && l() && r.fadeTime && !n ? e.animate({backgroundColor: i}, {
                queue: !1,
                duration: r.fadeTime
            }) : e.css("backgroundColor", i)
        }

        function gt(e) {
            r.allowResize ? e ? tt.enableOnly() : tt.enableHandles() : tt.disableHandles(), nt.setCursor(r.allowSelect ? "crosshair" : "default"), tt.setCursor(r.allowMove ? "move" : "default"), r.hasOwnProperty("trueSize") && (X = r.trueSize[0] / O, V = r.trueSize[1] / M), r.hasOwnProperty("setSelect") && (ot(r.setSelect), tt.done(), delete r.setSelect), et.refresh(), r.bgColor != I && (mt(r.shade ? et.getShades() : _, r.shade ? r.shadeColor || r.bgColor : r.bgColor), I = r.bgColor), q != r.bgOpacity && (q = r.bgOpacity, r.shade ? et.refresh() : tt.setBgOpacity(q)), R = r.maxSize[0] || 0, U = r.maxSize[1] || 0, z = r.minSize[0] || 0, W = r.minSize[1] || 0, r.hasOwnProperty("outerImage") && (A.attr("src", r.outerImage), delete r.outerImage), tt.refresh()
        }

        var r = e.extend({}, e.Jcrop.defaults), i, s = navigator.userAgent.toLowerCase(), o = /msie/.test(s), u = /msie [1-6]\./.test(s);
        typeof t != "object" && (t = e(t)[0]), typeof n != "object" && (n = {}), p(n);
        var N = {
            border: "none",
            visibility: "visible",
            margin: 0,
            padding: 0,
            position: "absolute",
            top: 0,
            left: 0
        }, C = e(t), k = !0;
        if (t.tagName == "IMG") {
            if (C[0].width != 0 && C[0].height != 0)C.width(C[0].width), C.height(C[0].height); else {
                var L = new Image;
                L.src = C[0].src, C.width(L.width), C.height(L.height)
            }
            var A = C.clone().removeAttr("id").css(N).show();
            A.width(C.width()), A.height(C.height()), C.after(A).hide()
        } else A = C.css(N).show(), k = !1, r.shade === null && (r.shade = !0);
        b(A, r.boxWidth, r.boxHeight);
        var O = A.width(), M = A.height(), _ = e("<div />").width(O).height(M).addClass(f("holder")).css({
            position: "relative",
            backgroundColor: r.bgColor
        }).insertAfter(C).append(A);
        r.addClass && _.addClass(r.addClass);
        var D = e("<div />"), P = e("<div />").width("100%").height("100%").css({
            zIndex: 310,
            position: "absolute",
            overflow: "hidden"
        }), H = e("<div />").width("100%").height("100%").css("zIndex", 320), B = e("<div />").css({
            position: "absolute",
            zIndex: 600
        }).dblclick(function () {
            var e = Z.getFixed();
            r.onDblClick.call(yt, e)
        }).insertBefore(A).append(P, H);
        k && (D = e("<img />").attr("src", A.attr("src")).css(N).width(O).height(M), P.append(D)), u && B.css({overflowY: "hidden"});
        var j = r.boundary, F = T().width(O + j * 2).height(M + j * 2).css({
            position: "absolute",
            top: a(-j),
            left: a(-j),
            zIndex: 290
        }).mousedown(S), I = r.bgColor, q = r.bgOpacity, R, U, z, W, X, V, J = !0, K, Q, G;
        i = c(A);
        var Y = function () {
            function e() {
                var e = {}, t = ["touchstart", "touchmove", "touchend"], n = document.createElement("div"), r;
                try {
                    for (r = 0; r < t.length; r++) {
                        var i = t[r];
                        i = "on" + i;
                        var s = i in n;
                        s || (n.setAttribute(i, "return;"), s = typeof n[i] == "function"), e[t[r]] = s
                    }
                    return e.touchstart && e.touchend && e.touchmove
                } catch (o) {
                    return !1
                }
            }

            function t() {
                return r.touchSupport === !0 || r.touchSupport === !1 ? r.touchSupport : e()
            }

            return {
                createDragger: function (e) {
                    return function (t) {
                        return r.disabled ? !1 : e === "move" && !r.allowMove ? !1 : (i = c(A), K = !0, d(e, h(Y.cfilter(t)), !0), t.stopPropagation(), t.preventDefault(), !1)
                    }
                }, newSelection: function (e) {
                    return S(Y.cfilter(e))
                }, cfilter: function (e) {
                    return e.pageX = e.originalEvent.changedTouches[0].pageX, e.pageY = e.originalEvent.changedTouches[0].pageY, e
                }, isSupported: e, support: t()
            }
        }(), Z = function () {
            function u(r) {
                r = p(r), n = e = r[0], i = t = r[1]
            }

            function a(e) {
                e = p(e), s = e[0] - n, o = e[1] - i, n = e[0], i = e[1]
            }

            function f() {
                return [s, o]
            }

            function l(r) {
                var s = r[0], o = r[1];
                0 > e + s && (s -= s + e), 0 > t + o && (o -= o + t), M < i + o && (o += M - (i + o)), O < n + s && (s += O - (n + s)), e += s, n += s, t += o, i += o
            }

            function c(e) {
                var t = h();
                switch (e) {
                    case"ne":
                        return [t.x2, t.y];
                    case"nw":
                        return [t.x, t.y];
                    case"se":
                        return [t.x2, t.y2];
                    case"sw":
                        return [t.x, t.y2]
                }
            }

            function h() {
                if (!r.aspectRatio)return v();
                var s = r.aspectRatio, o = r.minSize[0] / X, u = r.maxSize[0] / X, a = r.maxSize[1] / V, f = n - e, l = i - t, c = Math.abs(f), h = Math.abs(l), p = c / h, g, y, b, w;
                return u === 0 && (u = O * 10), a === 0 && (a = M * 10), p < s ? (y = i, b = h * s, g = f < 0 ? e - b : b + e, g < 0 ? (g = 0, w = Math.abs((g - e) / s), y = l < 0 ? t - w : w + t) : g > O && (g = O, w = Math.abs((g - e) / s), y = l < 0 ? t - w : w + t)) : (g = n, w = c / s, y = l < 0 ? t - w : t + w, y < 0 ? (y = 0, b = Math.abs((y - t) * s), g = f < 0 ? e - b : b + e) : y > M && (y = M, b = Math.abs(y - t) * s, g = f < 0 ? e - b : b + e)), g > e ? (g - e < o ? g = e + o : g - e > u && (g = e + u), y > t ? y = t + (g - e) / s : y = t - (g - e) / s) : g < e && (e - g < o ? g = e - o : e - g > u && (g = e - u), y > t ? y = t + (e - g) / s : y = t - (e - g) / s), g < 0 ? (e -= g, g = 0) : g > O && (e -= g - O, g = O), y < 0 ? (t -= y, y = 0) : y > M && (t -= y - M, y = M), m(d(e, t, g, y))
            }

            function p(e) {
                return e[0] < 0 && (e[0] = 0), e[1] < 0 && (e[1] = 0), e[0] > O && (e[0] = O), e[1] > M && (e[1] = M), [Math.round(e[0]), Math.round(e[1])]
            }

            function d(e, t, n, r) {
                var i = e, s = n, o = t, u = r;
                return n < e && (i = n, s = e), r < t && (o = r, u = t), [i, o, s, u]
            }

            function v() {
                var r = n - e, s = i - t, o;
                return R && Math.abs(r) > R && (n = r > 0 ? e + R : e - R), U && Math.abs(s) > U && (i = s > 0 ? t + U : t - U), W / V && Math.abs(s) < W / V && (i = s > 0 ? t + W / V : t - W / V), z / X && Math.abs(r) < z / X && (n = r > 0 ? e + z / X : e - z / X), e < 0 && (n -= e, e -= e), t < 0 && (i -= t, t -= t), n < 0 && (e -= n, n -= n), i < 0 && (t -= i, i -= i), n > O && (o = n - O, e -= o, n -= o), i > M && (o = i - M, t -= o, i -= o), e > O && (o = e - M, i -= o, t -= o), t > M && (o = t - M, i -= o, t -= o), m(d(e, t, n, i))
            }

            function m(e) {
                return {x: e[0], y: e[1], x2: e[2], y2: e[3], w: e[2] - e[0], h: e[3] - e[1]}
            }

            var e = 0, t = 0, n = 0, i = 0, s, o;
            return {flipCoords: d, setPressed: u, setCurrent: a, getOffset: f, moveOffset: l, getCorner: c, getFixed: h}
        }(), et = function () {
            function s(e, t) {
                i.left.css({height: a(t)}), i.right.css({height: a(t)})
            }

            function o() {
                return u(Z.getFixed())
            }

            function u(e) {
                i.top.css({left: a(e.x), width: a(e.w), height: a(e.y)}), i.bottom.css({
                    top: a(e.y2),
                    left: a(e.x),
                    width: a(e.w),
                    height: a(M - e.y2)
                }), i.right.css({left: a(e.x2), width: a(O - e.x2)}), i.left.css({width: a(e.x)})
            }

            function f() {
                return e("<div />").css({position: "absolute", backgroundColor: r.shadeColor || r.bgColor}).appendTo(n)
            }

            function l() {
                t || (t = !0, n.insertBefore(A), o(), tt.setBgOpacity(1, 0, 1), D.hide(), c(r.shadeColor || r.bgColor, 1), tt.isAwake() ? p(r.bgOpacity, 1) : p(1, 1))
            }

            function c(e, t) {
                mt(v(), e, t)
            }

            function h() {
                t && (n.remove(), D.show(), t = !1, tt.isAwake() ? tt.setBgOpacity(r.bgOpacity, 1, 1) : (tt.setBgOpacity(1, 1, 1), tt.disableHandles()), mt(_, 0, 1))
            }

            function p(e, i) {
                t && (r.bgFade && !i ? n.animate({opacity: 1 - e}, {
                    queue: !1,
                    duration: r.fadeTime
                }) : n.css({opacity: 1 - e}))
            }

            function d() {
                r.shade ? l() : h(), tt.isAwake() && p(r.bgOpacity)
            }

            function v() {
                return n.children()
            }

            var t = !1, n = e("<div />").css({position: "absolute", zIndex: 240, opacity: 0}), i = {
                top: f(),
                left: f().height(M),
                right: f().height(M),
                bottom: f()
            };
            return {
                update: o,
                updateRaw: u,
                getShades: v,
                setBgColor: c,
                enable: l,
                disable: h,
                resize: s,
                refresh: d,
                opacity: p
            }
        }(), tt = function () {
            function l(t) {
                var n = e("<div />").css({position: "absolute", opacity: r.borderOpacity}).addClass(f(t));
                return P.append(n), n
            }

            function c(t, n) {
                var r = e("<div />").mousedown(y(t)).css({
                    cursor: t + "-resize",
                    position: "absolute",
                    zIndex: n
                }).addClass("ord-" + t);
                return Y.support && r.bind("touchstart.jcrop", Y.createDragger(t)), H.append(r), r
            }

            function h(e) {
                var t = r.handleSize, i = c(e, n++).css({opacity: r.handleOpacity}).addClass(f("handle"));
                return t && i.width(t).height(t), i
            }

            function p(e) {
                return c(e, n++).addClass("jcrop-dragbar")
            }

            function d(e) {
                var t;
                for (t = 0; t < e.length; t++)o[e[t]] = p(e[t])
            }

            function v(e) {
                var t, n;
                for (n = 0; n < e.length; n++) {
                    switch (e[n]) {
                        case"n":
                            t = "hline";
                            break;
                        case"s":
                            t = "hline bottom";
                            break;
                        case"e":
                            t = "vline right";
                            break;
                        case"w":
                            t = "vline"
                    }
                    i[e[n]] = l(t)
                }
            }

            function m(e) {
                var t;
                for (t = 0; t < e.length; t++)s[e[t]] = h(e[t])
            }

            function g(e, t) {
                r.shade || D.css({top: a(-t), left: a(-e)}), B.css({top: a(t), left: a(e)})
            }

            function b(e, t) {
                B.width(Math.round(e)).height(Math.round(t))
            }

            function E() {
                var e = Z.getFixed();
                Z.setPressed([e.x, e.y]), Z.setCurrent([e.x2, e.y2]), S()
            }

            function S(e) {
                if (t)return x(e)
            }

            function x(e) {
                var n = Z.getFixed();
                b(n.w, n.h), g(n.x, n.y), r.shade && et.updateRaw(n), t || C(), e ? r.onSelect.call(yt, w(n)) : r.onChange.call(yt, w(n))
            }

            function N(e, n, i) {
                if (!t && !n)return;
                r.bgFade && !i ? A.animate({opacity: e}, {queue: !1, duration: r.fadeTime}) : A.css("opacity", e)
            }

            function C() {
                B.show(), r.shade ? et.opacity(q) : N(q, !0), t = !0
            }

            function k() {
                M(), B.hide(), r.shade ? et.opacity(1) : N(1), t = !1, r.onRelease.call(yt)
            }

            function L() {
                u && H.show()
            }

            function O() {
                u = !0;
                if (r.allowResize)return H.show(), !0
            }

            function M() {
                u = !1, H.hide()
            }

            function _(e) {
                e ? (Q = !0, M()) : (Q = !1, O())
            }

            function j() {
                _(!1), E()
            }

            var t, n = 370, i = {}, s = {}, o = {}, u = !1;
            r.dragEdges && e.isArray(r.createDragbars) && d(r.createDragbars), e.isArray(r.createHandles) && m(r.createHandles), r.drawBorders && e.isArray(r.createBorders) && v(r.createBorders), e(document).bind("touchstart.jcrop-ios", function (t) {
                e(t.currentTarget).hasClass("jcrop-tracker") && t.stopPropagation()
            });
            var F = T().mousedown(y("move")).css({cursor: "move", position: "absolute", zIndex: 360});
            return Y.support && F.bind("touchstart.jcrop", Y.createDragger("move")), P.append(F), M(), {
                updateVisible: S,
                update: x,
                release: k,
                refresh: E,
                isAwake: function () {
                    return t
                },
                setCursor: function (e) {
                    F.css("cursor", e)
                },
                enableHandles: O,
                enableOnly: function () {
                    u = !0
                },
                showHandles: L,
                disableHandles: M,
                animMode: _,
                setBgOpacity: N,
                done: j
            }
        }(), nt = function () {
            function s(t) {
                F.css({zIndex: 450}), t ? e(document).bind("touchmove.jcrop", l).bind("touchend.jcrop", c) : i && e(document).bind("mousemove.jcrop", u).bind("mouseup.jcrop", a)
            }

            function o() {
                F.css({zIndex: 290}), e(document).unbind(".jcrop")
            }

            function u(e) {
                return t(h(e)), !1
            }

            function a(e) {
                return e.preventDefault(), e.stopPropagation(), K && (K = !1, n(h(e)), tt.isAwake() && r.onSelect.call(yt, w(Z.getFixed())), o(), t = function () {
                }, n = function () {
                }), !1
            }

            function f(e, r, i) {
                return K = !0, t = e, n = r, s(i), !1
            }

            function l(e) {
                return t(h(Y.cfilter(e))), !1
            }

            function c(e) {
                return a(Y.cfilter(e))
            }

            function p(e) {
                F.css("cursor", e)
            }

            var t = function () {
            }, n = function () {
            }, i = r.trackDocument;
            return i || F.mousemove(u).mouseup(a).mouseout(a), A.before(F), {activateHandlers: f, setCursor: p}
        }(), rt = function () {
            function i() {
                r.keySupport && (t.show(), t.focus())
            }

            function s(e) {
                t.hide()
            }

            function o(e, t, n) {
                r.allowMove && (Z.moveOffset([t, n]), tt.updateVisible(!0)), e.preventDefault(), e.stopPropagation()
            }

            function a(e) {
                if (e.ctrlKey || e.metaKey)return !0;
                G = e.shiftKey ? !0 : !1;
                var t = G ? 10 : 1;
                switch (e.keyCode) {
                    case 37:
                        o(e, -t, 0);
                        break;
                    case 39:
                        o(e, t, 0);
                        break;
                    case 38:
                        o(e, 0, -t);
                        break;
                    case 40:
                        o(e, 0, t);
                        break;
                    case 27:
                        r.allowSelect && tt.release();
                        break;
                    case 9:
                        return !0
                }
                return !1
            }

            var t = e('<input type="radio" />').css({
                position: "fixed",
                left: "-120px",
                width: "12px"
            }).addClass("jcrop-keymgr"), n = e("<div />").css({position: "absolute", overflow: "hidden"}).append(t);
            return r.keySupport && (t.keydown(a).blur(s), u || !r.fixedSupport ? (t.css({
                position: "absolute",
                left: "-20px"
            }), n.append(t).insertBefore(A)) : t.insertBefore(A)), {watchKeys: i}
        }();
        Y.support && F.bind("touchstart.jcrop", Y.newSelection), H.hide(), gt(!0);
        var yt = {
            setImage: vt,
            animateTo: st,
            setSelect: ot,
            setOptions: lt,
            tellSelect: at,
            tellScaled: ft,
            setClass: it,
            disable: ct,
            enable: ht,
            cancel: pt,
            release: tt.release,
            destroy: dt,
            focus: rt.watchKeys,
            getBounds: function () {
                return [O * X, M * V]
            },
            getWidgetSize: function () {
                return [O, M]
            },
            getScaleFactor: function () {
                return [X, V]
            },
            getOptions: function () {
                return r
            },
            ui: {holder: _, selection: B}
        };
        return o && _.bind("selectstart", function () {
            return !1
        }), C.data("Jcrop", yt), yt
    }, e.fn.Jcrop = function (t, n) {
        var r;
        return this.each(function () {
            if (e(this).data("Jcrop")) {
                if (t === "api")return e(this).data("Jcrop");
                e(this).data("Jcrop").setOptions(t)
            } else this.tagName == "IMG" ? e.Jcrop.Loader(this, function () {
                e(this).css({
                    display: "block",
                    visibility: "hidden"
                }), r = e.Jcrop(this, t), e.isFunction(n) && n.call(r)
            }) : (e(this).css({
                display: "block",
                visibility: "hidden"
            }), r = e.Jcrop(this, t), e.isFunction(n) && n.call(r))
        }), this
    }, e.Jcrop.Loader = function (t, n, r) {
        function o() {
            s.complete ? (i.unbind(".jcloader"), e.isFunction(n) && n.call(s)) : window.setTimeout(o, 50)
        }

        var i = e(t), s = i[0];
        i.bind("load.jcloader", o).bind("error.jcloader", function (t) {
            i.unbind(".jcloader"), e.isFunction(r) && r.call(s)
        }), s.complete && e.isFunction(n) && (i.unbind(".jcloader"), n.call(s))
    }, e.Jcrop.defaults = {
        allowSelect: !0,
        allowMove: !0,
        allowResize: !0,
        trackDocument: !0,
        baseClass: "jcrop",
        addClass: null,
        bgColor: "black",
        bgOpacity: .6,
        bgFade: !1,
        borderOpacity: .4,
        handleOpacity: .5,
        handleSize: null,
        aspectRatio: 0,
        keySupport: !0,
        createHandles: ["n", "s", "e", "w", "nw", "ne", "se", "sw"],
        createDragbars: ["n", "s", "e", "w"],
        createBorders: ["n", "s", "e", "w"],
        drawBorders: !0,
        dragEdges: !0,
        fixedSupport: !0,
        touchSupport: null,
        shade: null,
        boxWidth: 0,
        boxHeight: 0,
        boundary: 2,
        fadeTime: 400,
        animationDelay: 20,
        swingSpeed: 3,
        minSelect: [0, 0],
        maxSize: [0, 0],
        minSize: [0, 0],
        onChange: function () {
        },
        onSelect: function () {
        },
        onDblClick: function () {
        },
        onRelease: function () {
        }
    }
}(jQuery), define("primary/jquery.jcrop", function () {
}), function (e) {
    function t() {
        var t = e(this);
        window.event.propertyName == "value" && !t.data("triggering.inputEvent") && (t.data("triggering.inputEvent", !0).trigger("input"), window.setTimeout(function () {
            t.data("triggering.inputEvent", !1)
        }, 0))
    }

    function n(e) {
        e.setAttribute("oninput", "return");
        if (typeof e.oninput == "function")return !0;
        try {
            var t = document.createEvent("KeyboardEvent"), n = !1, r = function (e) {
                n = !0, e.preventDefault(), e.stopPropagation()
            };
            return document.body.appendChild(e), e.addEventListener("input", r, !1), e.removeEventListener("input", r, !1), document.body.removeChild(e), n
        } catch (i) {
        }
    }

    e.event.special.input = {
        setup: function (t, r) {
            function h() {
                var t = e(s);
                s.value != o && !t.data("triggering.inputEvent") && (o = s.value, t.data("triggering.inputEvent", !0).trigger("input"), window.setTimeout(function () {
                    t.data("triggering.inputEvent", !1)
                }, 0))
            }

            function p(e) {
                e.type == "focus" ? (h(), clearInterval(i), i = window.setInterval(h, 250)) : e.type == "blur" ? window.clearInterval(i) : window.setTimeout(h, 0)
            }

            var i, s = this, o = s.value, u = document.createElement(this.tagName), a = "oninput" in u || n(u), f = "onpropertychange" in u, l = "inputEventNS" + ~~(Math.random() * 1e7), c = ["focus", "blur", "paste", "cut", "keydown", "drop", ""].join("." + l + " ");
            if (a)return !1;
            e(this).find("input, textarea").andSelf().filter("input, textarea").bind(c, p), e(this).data("inputEventHandlerNS", l)
        }, teardown: function () {
            var t = e(this);
            t.find("input, textarea").unbind(t.data("inputEventHandlerNS")), t.data("inputEventHandlerNS", "")
        }
    }, e.fn.input = function (e) {
        return e ? this.bind("input", e) : this.trigger("input")
    }
}(jQuery), define("primary/jquery.events.input", function () {
}), function (e, t, n) {
    var r = {
        BACKSPACE: 8,
        TAB: 9,
        RETURN: 13,
        ESC: 27,
        LEFT: 37,
        UP: 38,
        RIGHT: 39,
        DOWN: 40,
        COMMA: 188,
        SPACE: 32,
        HOME: 36,
        END: 35
    }, i = {
        linkReg: /(https?:\/\/(?:www\.|(?!www))[^\s\.]+\.[^\s]{2,}|www\.[^\s]+\.[^\s]{2,})(\s)/gi,
        triggerChar: "@",
        onDataRequest: e.noop,
        minChars: 2,
        allowRepeat: !1,
        showAvatars: !0,
        elastic: !0,
        defaultValue: "",
        onCaret: !1,
        prefillMention: !1,
        classes: {autoCompleteItemActive: "active"},
        onDataRequest: function (e, n, r) {
            var i = {q: n, context: "tags"};
            K.ajax("ajax/core/suggest/list", i).done(function (e) {
                e = t.filter(e, function (e) {
                    return e.name.toLowerCase().indexOf(n.toLowerCase()) > -1
                }), r.call(this, e)
            })
        },
        templates: {
            wrapper: t.template('<div class="mentions-input-box"></div>'),
            autocompleteList: t.template('<div class="mentions-autocomplete-list"></div>'),
            autocompleteListItem: t.template('<li data-ref-id="<%= id %>" data-ref-type="<%= type %>" data-display="<%= display %>"><%= content %></li>'),
            autocompleteListItemAvatar: t.template('<img src="<%= avatar %>" />'),
            autocompleteListItemIcon: t.template('<div class="icon <%= icon %>"></div>'),
            mentionsOverlay: t.template('<div class="mentions"><div></div></div>'),
            mentionItemSyntax: t.template("@[<%= value %>](<%= type %>:<%= id %>)"),
            mentionItemHighlight: t.template("<strong><span><%= value %></span></strong>")
        }
    }, s = {
        htmlEncode: function (e) {
            return t.escape(e)
        }, regexpEncode: function (e) {
            return e.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1")
        }, highlightTerm: function (e, t) {
            return !t && !t.length ? e : e.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)(" + t + ")(?![^<>]*>)(?![^&;]+;)", "gi"), "<b>$1</b>")
        }, setCaratPosition: function (e, t) {
            if (e.createTextRange) {
                var n = e.createTextRange();
                n.move("character", t), n.select()
            } else e.selectionStart ? (e.focus(), e.setSelectionRange(t, t)) : e.focus()
        }, rtrim: function (e) {
            return e.replace(/\s+$/, "")
        }
    }, o = function (n) {
        function g() {
            u = e(o);
            if (u.attr("data-mentions-input") === "true")return;
            a = u.parent(), l = e(n.templates.wrapper()), u.wrapAll(l), l = a.find("> div.mentions-input-box"), u.attr("data-mentions-input", "true"), u.bind("keydown", P), u.bind("keypress", D), u.bind("click", A), u.bind("blur", O), navigator.userAgent.indexOf("MSIE 8") > -1 ? u.bind("propertychange", M) : u.bind("input", M), n.elastic && u.elastic()
        }

        function y() {
            f = e(n.templates.autocompleteList()), f.appendTo(l), f.delegate("li", "mousedown", L)
        }

        function b() {
            c = e(n.templates.mentionsOverlay()), c.prependTo(l)
        }

        function w() {
            var e = T();
            t.each(p, function (t) {
                var r = n.templates.mentionItemSyntax(t);
                e = e.replace(new RegExp(s.regexpEncode(t.value), "g"), r)
            });
            var r = s.htmlEncode(e);
            t.each(p, function (e) {
                var i = t.extend({}, e, {value: s.htmlEncode(e.value)}), o = n.templates.mentionItemSyntax(i), u = n.templates.mentionItemHighlight(i);
                r = r.replace(new RegExp(s.regexpEncode(o), "g"), u)
            }), r = r.replace(/\n/g, "<br />"), r = r.replace(/ {2}/g, "&nbsp; "), u.data("messageText", e), u.trigger("updated"), c.find("div").html(r)
        }

        function E() {
            v = []
        }

        function S() {
            var e = T();
            p = t.reject(p, function (t, n) {
                return !t.value || e.indexOf(t.value) == -1
            }), p = t.compact(p)
        }

        function x(e) {
            var r = T(), i = u[0].selectionStart, o = !1, a = !1, f = new RegExp("\\" + n.triggerChar + m, "gi"), l;
            while (l = f.exec(r))if (o === !1 || Math.abs(f.lastIndex - i) < o)o = Math.abs(f.lastIndex - i), a = f.lastIndex;
            var c = a - m.length - 1, h = a, d = r.substr(0, c), v = r.substr(h, r.length), g = (d + e.value).length + 1;
            t.find(p, function (t) {
                return t.id == e.id
            }) || p.push(e), E(), m = "", H();
            var y = d + e.value + " " + v;
            u.val(y), u.trigger("mention"), w(), u.focus(), s.setCaratPosition(u[0], g)
        }

        function T() {
            return e.trim(u.val())
        }

        function N(t) {
            var n, r, i, s, o, u, a, f, l, c, h;
            if (!(l = t[0]))return;
            if (!e(l).is("textarea"))return;
            if (l.selectionEnd == null)return;
            a = {
                position: "absolute",
                overflow: "auto",
                whiteSpace: "pre-wrap",
                wordWrap: "break-word",
                boxSizing: "content-box",
                top: 0,
                left: -9999
            }, f = ["boxSizing", "fontFamily", "fontSize", "fontStyle", "fontVariant", "fontWeight", "height", "letterSpacing", "lineHeight", "paddingBottom", "paddingLeft", "paddingRight", "paddingTop", "textDecoration", "textIndent", "textTransform", "width", "word-spacing"];
            for (c = 0, h = f.length; c < h; c++)o = f[c], a[o] = e(l).css(o);
            return i = document.createElement("div"), e(i).css(a), e(l).after(i), r = document.createTextNode(l.value.substring(0, l.selectionEnd)), n = document.createTextNode(l.value.substring(l.selectionEnd)), s = document.createElement("span"), s.innerHTML = "&nbsp;", i.appendChild(r), i.appendChild(s), i.appendChild(n), i.scrollTop = l.scrollTop, u = e(s).position(), e(i).remove(), u
        }

        function C(t) {
            var n, r, i, s, o, u, a, f, l, c, h;
            if (!(l = t[0]))return;
            if (!e(l).is("textarea"))return;
            if (l.selectionEnd == null)return;
            a = {
                position: "absolute",
                overflow: "auto",
                whiteSpace: "pre-wrap",
                wordWrap: "break-word",
                boxSizing: "content-box",
                top: 0,
                left: -9999
            }, f = ["boxSizing", "fontFamily", "fontSize", "fontStyle", "fontVariant", "fontWeight", "height", "letterSpacing", "lineHeight", "paddingBottom", "paddingLeft", "paddingRight", "paddingTop", "textDecoration", "textIndent", "textTransform", "width", "word-spacing"];
            for (c = 0, h = f.length; c < h; c++)o = f[c], a[o] = e(l).css(o);
            return i = document.createElement("div"), e(i).css(a), e(l).after(i), r = document.createTextNode(l.value.substring(0, l.selectionEnd)), n = document.createTextNode(l.value.substring(l.selectionEnd)), s = document.createElement("span"), s.innerHTML = "&nbsp;", i.appendChild(r), i.appendChild(s), i.appendChild(n), i.scrollTop = l.scrollTop, u = e(s).offset(), e(i).remove(), u
        }

        function k() {
            var t = e(u).offset().top, n = e("body").offset().top, r = e(window).scrollTop();
            r > t && e(window).scrollTop(t - n)
        }

        function L(t) {
            var n = e(this), r = d[n.attr("data-uid")];
            return x(r), k(), !1
        }

        function A(e) {
            E()
        }

        function O(e) {
            H()
        }

        function M(e) {
            w(), S();
            var r = u.val(), i = r.match(n.linkReg);
            i != null && u.closest("form").trigger("onLinkAttatch", {links: i});
            var o = t.lastIndexOf(v, n.triggerChar);
            o > -1 && (m = v.slice(o + 1).join(""), m = s.rtrim(m), t.defer(t.bind(F, this, m)))
        }

        function D(e) {
            if (e.keyCode !== r.BACKSPACE) {
                var t = String.fromCharCode(e.which || e.keyCode);
                v.push(t)
            }
        }

        function P(n) {
            if (n.keyCode === r.LEFT || n.keyCode === r.RIGHT || n.keyCode === r.HOME || n.keyCode === r.END) {
                t.defer(E), navigator.userAgent.indexOf("MSIE 9") > -1 && t.defer(w);
                return
            }
            if (n.keyCode === r.BACKSPACE) {
                v = v.slice(0, -1 + v.length);
                return
            }
            if (!f.is(":visible"))return !0;
            switch (n.keyCode) {
                case r.UP:
                case r.DOWN:
                    var i = null;
                    return n.keyCode === r.DOWN ? h && h.length ? i = h.next() : i = f.find("li").first() : i = e(h).prev(), i.length && B(i), !1;
                case r.RETURN:
                case r.TAB:
                    if (h && h.length)return h.trigger("mousedown"), !1
            }
            return !0
        }

        function H() {
            h = null, f.empty().hide()
        }

        function B(e) {
            e.addClass(n.classes.autoCompleteItemActive), e.siblings().removeClass(n.classes.autoCompleteItemActive), h = e
        }

        function j(r, i) {
            f.show();
            if (!n.allowRepeat) {
                var o = t.pluck(p, "value");
                i = t.reject(i, function (e) {
                    return t.include(o, e.name)
                })
            }
            if (!i.length) {
                H();
                return
            }
            f.empty();
            var a = e("<ul>").appendTo(f).hide();
            t.each(i, function (i, o) {
                var u = t.uniqueId("mention_");
                d[u] = t.extend({}, i, {value: i.name});
                var f = e(n.templates.autocompleteListItem({
                    id: s.htmlEncode(i.id),
                    display: s.htmlEncode(i.name),
                    type: s.htmlEncode(i.type),
                    content: s.highlightTerm(s.htmlEncode(i.display ? i.display : i.name), r)
                })).attr("data-uid", u);
                o === 0 && B(f);
                if (n.showAvatars) {
                    var l;
                    i.img ? l = e(n.templates.autocompleteListItemAvatar({avatar: i.img})) : l = e(n.templates.autocompleteListItemIcon({icon: i.icon})), l.prependTo(f)
                }
                f = f.appendTo(a)
            }), f.show(), n.onCaret && I(f, u), a.show()
        }

        function F(e) {
            e && e.length && e.length >= n.minChars ? n.onDataRequest.call(this, "search", e, function (t) {
                j(e, t)
            }) : H()
        }

        function I(e, t) {
            var n = e.css("position");
            if (n == "absolute") {
                var r = N(t), i = parseInt(t.css("line-height"), 10) || 18;
                e.css("width", "15em"), e.css("left", r.left), e.css("top", i + r.top);
                var s = t.offset().left + t.width(), o = e.offset().left + e.width();
                s <= o && e.css("left", Math.abs(e.position().left - (o - s)))
            } else if (n == "fixed") {
                var u = C(t), i = parseInt(t.css("line-height"), 10) || 18;
                e.css("width", "15em"), e.css("left", u.left + 1e4), e.css("top", i + u.top)
            }
        }

        function q(e) {
            p = [];
            var t = s.htmlEncode(e), r = new RegExp("(" + n.triggerChar + ")\\[(.*?)\\]\\((.*?):(.*?)\\)", "gi"), i, o = t;
            while ((i = r.exec(t)) != null)o = o.replace(i[0], i[1] + i[2]), p.push({
                id: i[4],
                type: i[3],
                value: i[2],
                trigger: i[1]
            });
            u.val(o), u.css({height: "auto"}), w()
        }

        var o, u, a, f, l, c, h, p = [], d = {}, v = [], m = "";
        return n = e.extend(!0, {}, i, n), {
            init: function (e) {
                o = e, g(), y(), b(), q(T()), n.prefillMention && x(n.prefillMention)
            }, val: function (e) {
                if (!t.isFunction(e))return;
                e.call(this, p.length ? u.data("messageText") : T())
            }, reset: function () {
                q()
            }, getMentions: function (e) {
                if (!t.isFunction(e))return;
                e.call(this, p)
            }
        }
    };
    e.fn.mentionsInput = function (n, r) {
        var i = arguments;
        if (typeof n == "object" || !n)r = n;
        return this.each(function () {
            var s = e.data(this, "mentionsInput") || e.data(this, "mentionsInput", new o(r));
            if (t.isFunction(s[n]))return s[n].apply(this, Array.prototype.slice.call(i, 1));
            if (typeof n == "object" || !n)return s.init.call(this, this);
            e.error("Method " + n + " does not exist")
        })
    }
}(jQuery, _), define("primary/jquery.mentions.input", function () {
}), function (t) {
    var n = "PhotosUpload", r = !0, i = {
        url: "",
        method: "POST",
        extraData: {},
        maxFileSize: 0,
        maxFiles: 0,
        allowedTypes: "*",
        extFilter: null,
        dataType: null,
        fileName: "fileUpload",
        onInit: function () {
        },
        onFallbackMode: function () {
        },
        onChange: function (e, t) {
        },
        onQueue: function (e) {
        },
        onNewFile: function (e, t, n) {
        },
        onBeforeUpload: function (e, t) {
        },
        onComplete: function () {
        },
        onUploadProgress: function (e, t, n) {
        },
        onUploadSuccess: function (e, t, n) {
        },
        onUploadError: function (e, t, n) {
        },
        onFileTypeError: function (e) {
        },
        onFileSizeError: function (e) {
        },
        onFileExtError: function (e) {
        },
        onFilesMaxError: function (e) {
        },
        element: function (e) {
            return e
        }
    }, s = function (e, n) {
        r && console.info("init PhotoUploads with options", n), this.input = t(e), this.settings = t.extend({}, i, n), !this.checkBrowser(), this.init()
    };
    s.prototype.checkBrowser = function () {
        return window.FormData === undefined ? (this.settings.onFallbackMode.call(this.input, "Browser doesn't support Form API"), !1) : this.input.find("input[type=file]").length > 0 ? !0 : !this.checkEvent("drop", this.input) || !this.checkEvent("dragstart", this.input) ? (this.settings.onFallbackMode.call(this.input, "Browser doesn't support Ajax Drag and Drop"), !1) : !0
    }, s.prototype.checkEvent = function (e, t) {
        t = t || document.createElement("div"), e = "on" + e;
        var n = e in t;
        return n || (t.setAttribute || (t = document.createElement("div")), t.setAttribute && t.removeAttribute && (t.setAttribute(e, ""), n = typeof t[e] == "function", typeof t[e] != "undefined" && (t[e] = undefined), t.removeAttribute(e))), t = null, n
    }, s.prototype.init = function () {
        var e = this;
        e.queue = [], e.queuePos = -1, e.queueRunning = !1, e.input.on("drop", function (t) {
            t.preventDefault();
            var n = t.originalEvent.dataTransfer.files;
            e.queueFiles(n), e.settings.onChange(n.length, e)
        }), this.input.on("change", function (t) {
            var n = t.target.files;
            e.queueFiles(n), e.settings.onChange(n.length, e)
        }), this.settings.onInit.call(this.input)
    }, s.prototype.queueFiles = function (e) {
        var n = this.queue.length;
        for (var r = 0; r < e.length; r++) {
            var i = e[r];
            if (this.settings.maxFileSize > 0 && i.size > this.settings.maxFileSize) {
                this.settings.onFileSizeError.call(this.input, i);
                continue
            }
            if (this.settings.allowedTypes != "*" && !i.type.match(this.settings.allowedTypes)) {
                this.settings.onFileTypeError.call(this.input, i);
                continue
            }
            if (this.settings.extFilter != null) {
                var s = this.settings.extFilter.toLowerCase().split(";"), o = i.name.toLowerCase().split(".").pop();
                if (t.inArray(o, s) < 0) {
                    this.settings.onFileExtError.call(this.input, i);
                    continue
                }
            }
            if (this.settings.maxFiles > 0 && this.queue.length >= this.settings.maxFiles) {
                this.settings.onFilesMaxError.call(this.input, i);
                continue
            }
            this.queue.push(i);
            var u = this.queue.length - 1, a = K.newId("e");
            i.eid = a, this.settings.onNewFile.call(this.input, a, u, i, this.input, this)
        }
        return this.queueRunning ? !1 : this.queue.length == n ? !1 : (this.settings.onQueue(this), !0)
    }, s.prototype.processQueue = function () {
        var n = this;
        n.queuePos++;
        if (n.queuePos >= n.queue.length) {
            n.settings.onComplete.call(n.input), n.queuePos = n.queue.length - 1, n.queueRunning = !1;
            return
        }
        var r = n.queue[n.queuePos], i = r.eid, s = new FormData;
        s.append(n.settings.fileName, r);
        var o = n.settings.onBeforeUpload.call(n.input, i, n.queuePos);
        if (!1 === o)return;
        t.each(n.settings.extraData, function (e, t) {
            s.append(e, t)
        }), n.queueRunning = !0, t.ajax({
            url: n.settings.url,
            type: n.settings.method,
            dataType: n.settings.dataType,
            data: s,
            cache: !1,
            contentType: !1,
            processData: !1,
            forceSync: !1,
            xhr: function () {
                var r = t.ajaxSettings.xhr();
                return r.upload && r.upload.addEventListener("progress", function (t) {
                    var r = 0, s = t.loaded || t.position, o = t.total || e.totalSize;
                    t.lengthComputable && (r = Math.ceil(s / o * 100)), n.settings.onUploadProgress.call(n.input, i, n.queuePos, r, this.input)
                }, !1), r
            },
            success: function (e, t, r) {
                n.settings.onUploadSuccess.call(n.input, i, n.queuePos, e, n.input)
            },
            error: function (e, t, r) {
                n.settings.onUploadError.call(n.input, i, n.queuePos, r, n.input)
            },
            complete: function (e, t) {
                n.processQueue()
            }
        })
    }, t(document).on("dragenter", function (e) {
        e.stopPropagation(), e.preventDefault()
    }), t(document).on("dragover", function (e) {
        e.stopPropagation(), e.preventDefault()
    }), t(document).on("drop", function (e) {
        e.stopPropagation(), e.preventDefault()
    }), window.PhotosUpload = s
}(window.jQuery), define("primary/jquery.photoupload", function () {
}), function (e) {
    var t;
    t = function (t) {
        function o() {
            s.html(""), n.val("").removeClass("disabled").prop("disabled", !1), i.find(".cleanup").addClass("hidden")
        }

        function u() {
            s.html(""), n.val("").removeClass("disabled").prop("disabled", !1), i.addClass("hidden").find(".cleanup").addClass("hidden")
        }

        function a(e) {
            return typeof e.A != "undefined" ? {lat: e.A, lng: e.F} : typeof e.G != "undefined" ? {
                lat: e.G,
                lng: e.K
            } : {lat: 0, lng: 0}
        }

        function f() {
            var t = r.getPlace(), o = a(t.geometry.location);
            console.log(t), e('<input type="hidden" name="place[address]">').val(n.val()).appendTo(s), e('<input type="hidden" name="place[google_place_id]">').val(t.place_id).appendTo(s), e('<input type="hidden" name="place[title]">').val(t.name).appendTo(s), e('<input type="hidden" name="place[lat]">').val(o.lat).appendTo(s), e('<input type="hidden" name="place[lng]">').val(o.lng).appendTo(s), e('<input type="hidden" name="place[url]">').val(t.url).appendTo(s), e('<input type="hidden" name="place[website]">').val(t.website).appendTo(s), n.prop("disabled", !0).addClass("disabled"), i.find(".cleanup").removeClass("hidden")
        }

        function l() {
            r = new google.maps.places.Autocomplete(n.get(0), {types: ["geocode"]}), google.maps.event.addListener(r, "place_changed", function () {
                f()
            })
        }

        var n, r, i, s;
        n = e(t), i = n.closest(".fc-att-location"), s = i.find(".token-ow"), n.closest("form").on("clean", u), i.on("click", '[data-toggle="btn-remove-token"]', function () {
            o()
        }), l()
    }, window.PlaceInput = t
}(window.jQuery), define("primary/jquery.placeinput", function () {
}), function (e) {
    var t = !0, n = {
        minChars: 1, delay: 150, cache: 1, menuClass: "", limit: 5, useCache: !1, duplicate: function () {
            return !1
        }, outer: function (e) {
            return e.closest("div")
        }, align: function (e) {
            return e.closest("div")
        }, renderItem: function (t, n, r) {
            return e('<div class="autocomplete-suggestion"></div>').data("val", n.name).data("item", n).data("search", r).html('<img src="' + n.img + '" />' + "<span>" + n.name + "</span>").appendTo(t)
        }, onSelect: function (e, t, n, r) {
            r.trigger("pushitem", n)
        }, source: function (e, t, n) {
            K.ajax("ajax/core/suggest/list", {q: e, context: t}).done(function (e) {
                n(e)
            })
        }
    }, r = function (r, i) {
        function l(n) {
            var r = s.val();
            s.cache[r] = n;
            if (n.length && r.length >= i.minChars) {
                var o = e('<div class="autocomplete-stages"></div>');
                for (var u = 0; u < n.length && u < i.limit; u++)i.renderItem(o, n[u], r);
                s.sc.html(o).show(), s.updateSC(0)
            } else s.sc.hide();
            t && console.info("update suggestions")
        }

        i = e.extend({}, n, i);
        var s = e(r), o = i.outer(s), u = i.align(s), a = s.data("multiple"), f = s.data("name");
        s.cache = {}, s.lastVal = "", s.tags = [], t && console.log("multiple", a), s.attr("autocomplete", "off"), s.sc = e("<div>", {"class": "autocomplete-suggestions"}).appendTo("body"), s.closest("form").on("clean", function () {
            o.addClass("hidden"), o.find(".token").remove()
        }), s.cleanup = function () {
            return o.find(".select-token").remove(), o.find(".cleanup").remove(), s.prop("disabled", !1).removeClass("bg-disabled"), s.val(""), s
        }, s.on("cleanup", function () {
            s.cleanup()
        }), o.on("click", ".cleanup", function (e) {
            s.cleanup().focus()
        }), s.updateSC = function () {
            s.sc.css({top: u.offset().top + u.outerHeight(), left: u.offset().left - 2, width: u.outerWidth() + 2})
        }, s.on("pushitem", function (t, n) {
            if (a) {
                var r = e('<span class="select-token"></span>').text(n.name + " ");
                e('<input type="hidden" />').prop("name", f + "[]").val(n.id + "@" + n.type).appendTo(r), e('<a class="cleanup ion-backspace" data-toggle="btn-remove-token"></a>').appendTo(r), r.insertBefore(s), s.val("")
            } else {
                s.prop("disabled", !0).addClass("bg-disabled"), e('<a class="absolute cleanup ion-backspace" data-toggle="btn-remove-token"></a>').insertAfter(s);
                var r = e('<span class="select-token hidden"></span>');
                e('<input type="hidden" />').prop("name", f).val(n.id + "@" + n.type).appendTo(r), r.appendTo(o), s.val(n.name)
            }
        }), s.sc.on("mouseleave", ".autocomplete-suggestion", function () {
            e(".autocomplete-suggestion.selected", s.sc).removeClass("selected")
        }), s.sc.on("mouseenter", ".autocomplete-suggestion", function () {
            e(".autocomplete-suggestion.selected", s.sc).removeClass("selected"), e(this).addClass("selected")
        }), s.sc.on("mousedown", ".autocomplete-suggestion", function (t) {
            var n = e(t.currentTarget), r = n.data("val"), o = n.data("item");
            if (r || n.hasClass("autocomplete-suggestion"))i.onSelect(t, r, o, s), s.focus(), s.sc.hide()
        }), s.on("blur.autocomplete", function () {
            var t;
            try {
                t = e(".autocomplete-suggestions:hover", s.sc).length
            } catch (n) {
                t = 0
            }
            t ? s.focus() : (s.lastVal = s.val(), s.sc.hide())
        }), i.minChars || s.on("focus.autocomplete", function () {
            s.lastVal = "\n", s.trigger("keyup.autocomplete")
        }), s.on("keydown.autocomplete", function (t) {
            if (!(t.which != 40 && t.which != 38 || !s.sc.html())) {
                var n, r = e(".autocomplete-suggestion.selected", s.sc);
                return r.length ? (n = t.which == 40 ? r.next(".autocomplete-suggestion") : r.prev(".autocomplete-suggestion"), n.length ? (r.removeClass("selected"), s.val(n.addClass("selected").data("val"))) : (r.removeClass("selected"), s.val(s.lastVal), n = 0)) : (n = t.which == 40 ? e(".autocomplete-suggestion", s.sc).first() : e(".autocomplete-suggestion", s.sc).last(), s.val(n.addClass("selected").data("val"))), s.updateSC(0, n), !1
            }
            if (t.which == 27)s.val(s.lastVal).sc.hide(); else if (t.which == 13) {
                var r = e(".autocomplete-suggestion.selected", s.sc);
                r.length && (i.onSelect(t, r.data("val"), r.data("item"), s), setTimeout(function () {
                    s.focus().sc.hide()
                }, 10))
            }
        }), s.on("keyup.autocomplete", function (t) {
            if (!~e.inArray(t.which, [27, 38, 40, 37, 39])) {
                var n = s.val();
                if (n.length >= i.minChars) {
                    if (n != s.lastVal) {
                        s.lastVal = n, clearTimeout(s.timer);
                        if (i.cache) {
                            if (n in s.cache) {
                                l(s.cache[n]);
                                return
                            }
                            for (var r = 1; r < n.length - i.minChars; r++) {
                                var o = n.slice(0, n.length - r);
                                if (o in s.cache && !s.cache[o].length) {
                                    l([]);
                                    return
                                }
                            }
                        }
                        s.timer = setTimeout(function () {
                            i.source(n, s.data("context"), l)
                        }, i.delay)
                    }
                } else s.lastVal = n, s.sc.hide()
            }
        }), e(window).on("resize.autocomplete", s.updateSC), t && console.info("init selection input")
    };
    window.SelectInput = r, e(document).on("focus", '[data-toggle="select"]', function (t) {
        var n = e(t.currentTarget);
        n.data("select") || n.data("select", new r(n))
    })
}(window.jQuery), define("primary/jquery.select", function () {
}), function (e) {
    "use strict";
    e.fn.serializeJSON = function (t) {
        var n, r, i, s, o, u, a, f;
        return a = e.serializeJSON, f = a.setupOpts(t), r = this.serializeArray(), a.readCheckboxUncheckedValues(r, this, f), n = {}, e.each(r, function (e, t) {
            i = a.splitInputNameIntoKeysArray(t.name, f), s = i.pop(), s !== "skip" && (o = a.parseValue(t.value, s, f), f.parseWithFunction && s === "_" && (o = f.parseWithFunction(o, t.name)), a.deepSet(n, i, o, f))
        }), n
    }, e.serializeJSON = {
        defaultOptions: {
            checkboxUncheckedValue: undefined,
            parseNumbers: !1,
            parseBooleans: !1,
            parseNulls: !1,
            parseAll: !1,
            parseWithFunction: null,
            customTypes: {},
            defaultTypes: {
                string: function (e) {
                    return String(e)
                }, number: function (e) {
                    return Number(e)
                }, "boolean": function (e) {
                    return ["false", "null", "undefined", "", "0"].indexOf(e) === -1
                }, "null": function (e) {
                    return ["false", "null", "undefined", "", "0"].indexOf(e) !== -1 ? null : e
                }, array: function (e) {
                    return JSON.parse(e)
                }, object: function (e) {
                    return JSON.parse(e)
                }, auto: function (t) {
                    return e.serializeJSON.parseValue(t, null, {parseNumbers: !0, parseBooleans: !0, parseNulls: !0})
                }
            },
            useIntKeysAsArrayIndex: !1
        }, setupOpts: function (t) {
            var n, r, i, s, o, u;
            u = e.serializeJSON, t == null && (t = {}), i = u.defaultOptions || {}, r = ["checkboxUncheckedValue", "parseNumbers", "parseBooleans", "parseNulls", "parseAll", "parseWithFunction", "customTypes", "defaultTypes", "useIntKeysAsArrayIndex"];
            for (n in t)if (r.indexOf(n) === -1)throw new Error("serializeJSON ERROR: invalid option '" + n + "'. Please use one of " + r.join(", "));
            return s = function (e) {
                return t[e] !== !1 && t[e] !== "" && (t[e] || i[e])
            }, o = s("parseAll"), {
                checkboxUncheckedValue: s("checkboxUncheckedValue"),
                parseNumbers: o || s("parseNumbers"),
                parseBooleans: o || s("parseBooleans"),
                parseNulls: o || s("parseNulls"),
                parseWithFunction: s("parseWithFunction"),
                typeFunctions: e.extend({}, s("defaultTypes"), s("customTypes")),
                useIntKeysAsArrayIndex: s("useIntKeysAsArrayIndex")
            }
        }, parseValue: function (t, n, r) {
            var i, s;
            return s = e.serializeJSON, i = r.typeFunctions && r.typeFunctions[n], i ? i(t) : r.parseNumbers && s.isNumeric(t) ? Number(t) : !r.parseBooleans || t !== "true" && t !== "false" ? r.parseNulls && t == "null" ? null : t : t === "true"
        }, isObject: function (e) {
            return e === Object(e)
        }, isUndefined: function (e) {
            return e === void 0
        }, isValidArrayIndex: function (e) {
            return /^[0-9]+$/.test(String(e))
        }, isNumeric: function (e) {
            return e - parseFloat(e) >= 0
        }, optionKeys: function (e) {
            if (Object.keys)return Object.keys(e);
            var t = [];
            for (var n in e)t.push(n);
            return t
        }, splitInputNameIntoKeysArray: function (t, n) {
            var r, i, s, o, u;
            return u = e.serializeJSON, o = u.extractTypeFromInputName(t, n), i = o[0], s = o[1], r = i.split("["), r = e.map(r, function (e) {
                return e.replace(/]/g, "")
            }), r[0] === "" && r.shift(), r.push(s), r
        }, extractTypeFromInputName: function (t, n) {
            var r, i, s;
            if (r = t.match(/(.*):([^:]+)$/)) {
                s = e.serializeJSON, i = s.optionKeys(n ? n.typeFunctions : s.defaultOptions.defaultTypes), i.push("skip");
                if (i.indexOf(r[2]) !== -1)return [r[1], r[2]];
                throw new Error("serializeJSON ERROR: Invalid type " + r[2] + " found in input name '" + t + "', please use one of " + i.join(", "))
            }
            return [t, "_"]
        }, deepSet: function (t, n, r, i) {
            var s, o, u, a, f, l;
            i == null && (i = {}), l = e.serializeJSON;
            if (l.isUndefined(t))throw new Error("ArgumentError: param 'o' expected to be an object or array, found undefined");
            if (!n || n.length === 0)throw new Error("ArgumentError: param 'keys' expected to be an array with least one element");
            s = n[0];
            if (n.length === 1)s === "" ? t.push(r) : t[s] = r; else {
                o = n[1], s === "" && (a = t.length - 1, f = t[a], l.isObject(f) && (l.isUndefined(f[o]) || n.length > 2) ? s = a : s = a + 1);
                if (o === "") {
                    if (l.isUndefined(t[s]) || !e.isArray(t[s]))t[s] = []
                } else if (i.useIntKeysAsArrayIndex && l.isValidArrayIndex(o)) {
                    if (l.isUndefined(t[s]) || !e.isArray(t[s]))t[s] = []
                } else if (l.isUndefined(t[s]) || !l.isObject(t[s]))t[s] = {};
                u = n.slice(1), l.deepSet(t[s], u, r, i)
            }
        }, readCheckboxUncheckedValues: function (t, n, r) {
            var i, s, o, u, a;
            r == null && (r = {}), a = e.serializeJSON, i = "input[type=checkbox][name]:not(:checked):not([disabled])", s = n.find(i).add(n.filter(i)), s.each(function (n, i) {
                o = e(i), u = o.attr("data-unchecked-value"), u ? t.push({
                    name: i.name,
                    value: u
                }) : a.isUndefined(r.checkboxUncheckedValue) || t.push({name: i.name, value: r.checkboxUncheckedValue})
            })
        }
    }
}(window.jQuery || window.Zepto || window.$), define("primary/jquery.serialize", function () {
}), define("primary/main", ["primary/jquery.min", "primary/underscore.min", "primary/jquery.ac", "primary/jquery.dropdown", "primary/jquery.elastic", "primary/jquery.jcrop", "primary/jquery.events.input", "primary/jquery.mentions.input", "primary/jquery.photoupload", "primary/jquery.placeinput", "primary/jquery.select", "primary/jquery.serialize"], function () {
}), function (e) {
    "function" == typeof define && define.amd ? define("primary/jqueryui", ["jquery"], e) : e(jQuery)
}(function (e) {
    function t(t, r) {
        var i, s, o, u = t.nodeName.toLowerCase();
        return "area" === u ? (i = t.parentNode, s = i.name, t.href && s && "map" === i.nodeName.toLowerCase() ? (o = e("img[usemap='#" + s + "']")[0], !!o && n(o)) : !1) : (/^(input|select|textarea|button|object)$/.test(u) ? !t.disabled : "a" === u ? t.href || r : r) && n(t)
    }

    function n(t) {
        return e.expr.filters.visible(t) && !e(t).parents().addBack().filter(function () {
                return "hidden" === e.css(this, "visibility")
            }).length
    }

    e.ui = e.ui || {}, e.extend(e.ui, {
        version: "1.11.4",
        keyCode: {
            BACKSPACE: 8,
            COMMA: 188,
            DELETE: 46,
            DOWN: 40,
            END: 35,
            ENTER: 13,
            ESCAPE: 27,
            HOME: 36,
            LEFT: 37,
            PAGE_DOWN: 34,
            PAGE_UP: 33,
            PERIOD: 190,
            RIGHT: 39,
            SPACE: 32,
            TAB: 9,
            UP: 38
        }
    }), e.fn.extend({
        scrollParent: function (t) {
            var n = this.css("position"), r = "absolute" === n, i = t ? /(auto|scroll|hidden)/ : /(auto|scroll)/, s = this.parents().filter(function () {
                var t = e(this);
                return r && "static" === t.css("position") ? !1 : i.test(t.css("overflow") + t.css("overflow-y") + t.css("overflow-x"))
            }).eq(0);
            return "fixed" !== n && s.length ? s : e(this[0].ownerDocument || document)
        }, uniqueId: function () {
            var e = 0;
            return function () {
                return this.each(function () {
                    this.id || (this.id = "ui-id-" + ++e)
                })
            }
        }(), removeUniqueId: function () {
            return this.each(function () {
                /^ui-id-\d+$/.test(this.id) && e(this).removeAttr("id")
            })
        }
    }), e.extend(e.expr[":"], {
        data: e.expr.createPseudo ? e.expr.createPseudo(function (t) {
            return function (n) {
                return !!e.data(n, t)
            }
        }) : function (t, n, r) {
            return !!e.data(t, r[3])
        }, focusable: function (n) {
            return t(n, !isNaN(e.attr(n, "tabindex")))
        }, tabbable: function (n) {
            var r = e.attr(n, "tabindex"), i = isNaN(r);
            return (i || r >= 0) && t(n, !i)
        }
    }), e("<a>").outerWidth(1).jquery || e.each(["Width", "Height"], function (t, n) {
        function r(t, n, r, s) {
            return e.each(i, function () {
                n -= parseFloat(e.css(t, "padding" + this)) || 0, r && (n -= parseFloat(e.css(t, "border" + this + "Width")) || 0), s && (n -= parseFloat(e.css(t, "margin" + this)) || 0)
            }), n
        }

        var i = "Width" === n ? ["Left", "Right"] : ["Top", "Bottom"], s = n.toLowerCase(), o = {
            innerWidth: e.fn.innerWidth,
            innerHeight: e.fn.innerHeight,
            outerWidth: e.fn.outerWidth,
            outerHeight: e.fn.outerHeight
        };
        e.fn["inner" + n] = function (t) {
            return void 0 === t ? o["inner" + n].call(this) : this.each(function () {
                e(this).css(s, r(this, t) + "px")
            })
        }, e.fn["outer" + n] = function (t, i) {
            return "number" != typeof t ? o["outer" + n].call(this, t) : this.each(function () {
                e(this).css(s, r(this, t, !0, i) + "px")
            })
        }
    }), e.fn.addBack || (e.fn.addBack = function (e) {
        return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
    }), e("<a>").data("a-b", "a").removeData("a-b").data("a-b") && (e.fn.removeData = function (t) {
        return function (n) {
            return arguments.length ? t.call(this, e.camelCase(n)) : t.call(this)
        }
    }(e.fn.removeData)), e.ui.ie = !!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase()), e.fn.extend({
        focus: function (t) {
            return function (n, r) {
                return "number" == typeof n ? this.each(function () {
                    var t = this;
                    setTimeout(function () {
                        e(t).focus(), r && r.call(t)
                    }, n)
                }) : t.apply(this, arguments)
            }
        }(e.fn.focus), disableSelection: function () {
            var e = "onselectstart" in document.createElement("div") ? "selectstart" : "mousedown";
            return function () {
                return this.bind(e + ".ui-disableSelection", function (e) {
                    e.preventDefault()
                })
            }
        }(), enableSelection: function () {
            return this.unbind(".ui-disableSelection")
        }, zIndex: function (t) {
            if (void 0 !== t)return this.css("zIndex", t);
            if (this.length)for (var n, r, i = e(this[0]); i.length && i[0] !== document;) {
                if (n = i.css("position"), ("absolute" === n || "relative" === n || "fixed" === n) && (r = parseInt(i.css("zIndex"), 10), !isNaN(r) && 0 !== r))return r;
                i = i.parent()
            }
            return 0
        }
    }), e.ui.plugin = {
        add: function (t, n, r) {
            var i, s = e.ui[t].prototype;
            for (i in r)s.plugins[i] = s.plugins[i] || [], s.plugins[i].push([n, r[i]])
        }, call: function (e, t, n, r) {
            var i, s = e.plugins[t];
            if (s && (r || e.element[0].parentNode && 11 !== e.element[0].parentNode.nodeType))for (i = 0; s.length > i; i++)e.options[s[i][0]] && s[i][1].apply(e.element, n)
        }
    };
    var r = 0, i = Array.prototype.slice;
    e.cleanData = function (t) {
        return function (n) {
            var r, i, s;
            for (s = 0; null != (i = n[s]); s++)try {
                r = e._data(i, "events"), r && r.remove && e(i).triggerHandler("remove")
            } catch (o) {
            }
            t(n)
        }
    }(e.cleanData), e.widget = function (t, n, r) {
        var i, s, o, u, a = {}, f = t.split(".")[0];
        return t = t.split(".")[1], i = f + "-" + t, r || (r = n, n = e.Widget), e.expr[":"][i.toLowerCase()] = function (t) {
            return !!e.data(t, i)
        }, e[f] = e[f] || {}, s = e[f][t], o = e[f][t] = function (e, t) {
            return this._createWidget ? (arguments.length && this._createWidget(e, t), void 0) : new o(e, t)
        }, e.extend(o, s, {
            version: r.version,
            _proto: e.extend({}, r),
            _childConstructors: []
        }), u = new n, u.options = e.widget.extend({}, u.options), e.each(r, function (t, r) {
            return e.isFunction(r) ? (a[t] = function () {
                var e = function () {
                    return n.prototype[t].apply(this, arguments)
                }, i = function (e) {
                    return n.prototype[t].apply(this, e)
                };
                return function () {
                    var t, n = this._super, s = this._superApply;
                    return this._super = e, this._superApply = i, t = r.apply(this, arguments), this._super = n, this._superApply = s, t
                }
            }(), void 0) : (a[t] = r, void 0)
        }), o.prototype = e.widget.extend(u, {widgetEventPrefix: s ? u.widgetEventPrefix || t : t}, a, {
            constructor: o,
            namespace: f,
            widgetName: t,
            widgetFullName: i
        }), s ? (e.each(s._childConstructors, function (t, n) {
            var r = n.prototype;
            e.widget(r.namespace + "." + r.widgetName, o, n._proto)
        }), delete s._childConstructors) : n._childConstructors.push(o), e.widget.bridge(t, o), o
    }, e.widget.extend = function (t) {
        for (var n, r, s = i.call(arguments, 1), o = 0, u = s.length; u > o; o++)for (n in s[o])r = s[o][n], s[o].hasOwnProperty(n) && void 0 !== r && (t[n] = e.isPlainObject(r) ? e.isPlainObject(t[n]) ? e.widget.extend({}, t[n], r) : e.widget.extend({}, r) : r);
        return t
    }, e.widget.bridge = function (t, n) {
        var r = n.prototype.widgetFullName || t;
        e.fn[t] = function (s) {
            var o = "string" == typeof s, u = i.call(arguments, 1), a = this;
            return o ? this.each(function () {
                var n, i = e.data(this, r);
                return "instance" === s ? (a = i, !1) : i ? e.isFunction(i[s]) && "_" !== s.charAt(0) ? (n = i[s].apply(i, u), n !== i && void 0 !== n ? (a = n && n.jquery ? a.pushStack(n.get()) : n, !1) : void 0) : e.error("no such method '" + s + "' for " + t + " widget instance") : e.error("cannot call methods on " + t + " prior to initialization; " + "attempted to call method '" + s + "'")
            }) : (u.length && (s = e.widget.extend.apply(null, [s].concat(u))), this.each(function () {
                var t = e.data(this, r);
                t ? (t.option(s || {}), t._init && t._init()) : e.data(this, r, new n(s, this))
            })), a
        }
    }, e.Widget = function () {
    }, e.Widget._childConstructors = [], e.Widget.prototype = {
        widgetName: "widget",
        widgetEventPrefix: "",
        defaultElement: "<div>",
        options: {disabled: !1, create: null},
        _createWidget: function (t, n) {
            n = e(n || this.defaultElement || this)[0], this.element = e(n), this.uuid = r++, this.eventNamespace = "." + this.widgetName + this.uuid, this.bindings = e(), this.hoverable = e(), this.focusable = e(), n !== this && (e.data(n, this.widgetFullName, this), this._on(!0, this.element, {
                remove: function (e) {
                    e.target === n && this.destroy()
                }
            }), this.document = e(n.style ? n.ownerDocument : n.document || n), this.window = e(this.document[0].defaultView || this.document[0].parentWindow)), this.options = e.widget.extend({}, this.options, this._getCreateOptions(), t), this._create(), this._trigger("create", null, this._getCreateEventData()), this._init()
        },
        _getCreateOptions: e.noop,
        _getCreateEventData: e.noop,
        _create: e.noop,
        _init: e.noop,
        destroy: function () {
            this._destroy(), this.element.unbind(this.eventNamespace).removeData(this.widgetFullName).removeData(e.camelCase(this.widgetFullName)), this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName + "-disabled " + "ui-state-disabled"), this.bindings.unbind(this.eventNamespace), this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus")
        },
        _destroy: e.noop,
        widget: function () {
            return this.element
        },
        option: function (t, n) {
            var r, i, s, o = t;
            if (0 === arguments.length)return e.widget.extend({}, this.options);
            if ("string" == typeof t)if (o = {}, r = t.split("."), t = r.shift(), r.length) {
                for (i = o[t] = e.widget.extend({}, this.options[t]), s = 0; r.length - 1 > s; s++)i[r[s]] = i[r[s]] || {}, i = i[r[s]];
                if (t = r.pop(), 1 === arguments.length)return void 0 === i[t] ? null : i[t];
                i[t] = n
            } else {
                if (1 === arguments.length)return void 0 === this.options[t] ? null : this.options[t];
                o[t] = n
            }
            return this._setOptions(o), this
        },
        _setOptions: function (e) {
            var t;
            for (t in e)this._setOption(t, e[t]);
            return this
        },
        _setOption: function (e, t) {
            return this.options[e] = t, "disabled" === e && (this.widget().toggleClass(this.widgetFullName + "-disabled", !!t), t && (this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus"))), this
        },
        enable: function () {
            return this._setOptions({disabled: !1})
        },
        disable: function () {
            return this._setOptions({disabled: !0})
        },
        _on: function (t, n, r) {
            var i, s = this;
            "boolean" != typeof t && (r = n, n = t, t = !1), r ? (n = i = e(n), this.bindings = this.bindings.add(n)) : (r = n, n = this.element, i = this.widget()), e.each(r, function (r, o) {
                function u() {
                    return t || s.options.disabled !== !0 && !e(this).hasClass("ui-state-disabled") ? ("string" == typeof o ? s[o] : o).apply(s, arguments) : void 0
                }

                "string" != typeof o && (u.guid = o.guid = o.guid || u.guid || e.guid++);
                var f = r.match(/^([\w:-]*)\s*(.*)$/), l = f[1] + s.eventNamespace, c = f[2];
                c ? i.delegate(c, l, u) : n.bind(l, u)
            })
        },
        _off: function (t, n) {
            n = (n || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace, t.unbind(n).undelegate(n), this.bindings = e(this.bindings.not(t).get()), this.focusable = e(this.focusable.not(t).get()), this.hoverable = e(this.hoverable.not(t).get())
        },
        _delay: function (e, t) {
            function n() {
                return ("string" == typeof e ? r[e] : e).apply(r, arguments)
            }

            var r = this;
            return setTimeout(n, t || 0)
        },
        _hoverable: function (t) {
            this.hoverable = this.hoverable.add(t), this._on(t, {
                mouseenter: function (t) {
                    e(t.currentTarget).addClass("ui-state-hover")
                }, mouseleave: function (t) {
                    e(t.currentTarget).removeClass("ui-state-hover")
                }
            })
        },
        _focusable: function (t) {
            this.focusable = this.focusable.add(t), this._on(t, {
                focusin: function (t) {
                    e(t.currentTarget).addClass("ui-state-focus")
                }, focusout: function (t) {
                    e(t.currentTarget).removeClass("ui-state-focus")
                }
            })
        },
        _trigger: function (t, n, r) {
            var i, s, o = this.options[t];
            if (r = r || {}, n = e.Event(n), n.type = (t === this.widgetEventPrefix ? t : this.widgetEventPrefix + t).toLowerCase(), n.target = this.element[0], s = n.originalEvent)for (i in s)i in n || (n[i] = s[i]);
            return this.element.trigger(n, r), !(e.isFunction(o) && o.apply(this.element[0], [n].concat(r)) === !1 || n.isDefaultPrevented())
        }
    }, e.each({show: "fadeIn", hide: "fadeOut"}, function (t, n) {
        e.Widget.prototype["_" + t] = function (r, i, s) {
            "string" == typeof i && (i = {effect: i});
            var o, u = i ? i === !0 || "number" == typeof i ? n : i.effect || n : t;
            i = i || {}, "number" == typeof i && (i = {duration: i}), o = !e.isEmptyObject(i), i.complete = s, i.delay && r.delay(i.delay), o && e.effects && e.effects.effect[u] ? r[t](i) : u !== t && r[u] ? r[u](i.duration, i.easing, s) : r.queue(function (n) {
                e(this)[t](), s && s.call(r[0]), n()
            })
        }
    }), e.widget;
    var s = !1;
    e(document).mouseup(function () {
        s = !1
    }), e.widget("ui.mouse", {
        version: "1.11.4",
        options: {cancel: "input,textarea,button,select,option", distance: 1, delay: 0},
        _mouseInit: function () {
            var t = this;
            this.element.bind("mousedown." + this.widgetName, function (e) {
                return t._mouseDown(e)
            }).bind("click." + this.widgetName, function (n) {
                return !0 === e.data(n.target, t.widgetName + ".preventClickEvent") ? (e.removeData(n.target, t.widgetName + ".preventClickEvent"), n.stopImmediatePropagation(), !1) : void 0
            }), this.started = !1
        },
        _mouseDestroy: function () {
            this.element.unbind("." + this.widgetName), this._mouseMoveDelegate && this.document.unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate)
        },
        _mouseDown: function (t) {
            if (!s) {
                this._mouseMoved = !1, this._mouseStarted && this._mouseUp(t), this._mouseDownEvent = t;
                var n = this, r = 1 === t.which, i = "string" == typeof this.options.cancel && t.target.nodeName ? e(t.target).closest(this.options.cancel).length : !1;
                return r && !i && this._mouseCapture(t) ? (this.mouseDelayMet = !this.options.delay, this.mouseDelayMet || (this._mouseDelayTimer = setTimeout(function () {
                    n.mouseDelayMet = !0
                }, this.options.delay)), this._mouseDistanceMet(t) && this._mouseDelayMet(t) && (this._mouseStarted = this._mouseStart(t) !== !1, !this._mouseStarted) ? (t.preventDefault(), !0) : (!0 === e.data(t.target, this.widgetName + ".preventClickEvent") && e.removeData(t.target, this.widgetName + ".preventClickEvent"), this._mouseMoveDelegate = function (e) {
                    return n._mouseMove(e)
                }, this._mouseUpDelegate = function (e) {
                    return n._mouseUp(e)
                }, this.document.bind("mousemove." + this.widgetName, this._mouseMoveDelegate).bind("mouseup." + this.widgetName, this._mouseUpDelegate), t.preventDefault(), s = !0, !0)) : !0
            }
        },
        _mouseMove: function (t) {
            if (this._mouseMoved) {
                if (e.ui.ie && (!document.documentMode || 9 > document.documentMode) && !t.button)return this._mouseUp(t);
                if (!t.which)return this._mouseUp(t)
            }
            return (t.which || t.button) && (this._mouseMoved = !0), this._mouseStarted ? (this._mouseDrag(t), t.preventDefault()) : (this._mouseDistanceMet(t) && this._mouseDelayMet(t) && (this._mouseStarted = this._mouseStart(this._mouseDownEvent, t) !== !1, this._mouseStarted ? this._mouseDrag(t) : this._mouseUp(t)), !this._mouseStarted)
        },
        _mouseUp: function (t) {
            return this.document.unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate), this._mouseStarted && (this._mouseStarted = !1, t.target === this._mouseDownEvent.target && e.data(t.target, this.widgetName + ".preventClickEvent", !0), this._mouseStop(t)), s = !1, !1
        },
        _mouseDistanceMet: function (e) {
            return Math.max(Math.abs(this._mouseDownEvent.pageX - e.pageX), Math.abs(this._mouseDownEvent.pageY - e.pageY)) >= this.options.distance
        },
        _mouseDelayMet: function () {
            return this.mouseDelayMet
        },
        _mouseStart: function () {
        },
        _mouseDrag: function () {
        },
        _mouseStop: function () {
        },
        _mouseCapture: function () {
            return !0
        }
    }), function () {
        function t(e, t, n) {
            return [parseFloat(e[0]) * (p.test(e[0]) ? t / 100 : 1), parseFloat(e[1]) * (p.test(e[1]) ? n / 100 : 1)]
        }

        function n(t, n) {
            return parseInt(e.css(t, n), 10) || 0
        }

        function r(t) {
            var n = t[0];
            return 9 === n.nodeType ? {
                width: t.width(),
                height: t.height(),
                offset: {top: 0, left: 0}
            } : e.isWindow(n) ? {
                width: t.width(),
                height: t.height(),
                offset: {top: t.scrollTop(), left: t.scrollLeft()}
            } : n.preventDefault ? {
                width: 0,
                height: 0,
                offset: {top: n.pageY, left: n.pageX}
            } : {width: t.outerWidth(), height: t.outerHeight(), offset: t.offset()}
        }

        e.ui = e.ui || {};
        var i, s, o = Math.max, u = Math.abs, a = Math.round, f = /left|center|right/, l = /top|center|bottom/, c = /[\+\-]\d+(\.[\d]+)?%?/, h = /^\w+/, p = /%$/, d = e.fn.position;
        e.position = {
            scrollbarWidth: function () {
                if (void 0 !== i)return i;
                var t, n, r = e("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"), s = r.children()[0];
                return e("body").append(r), t = s.offsetWidth, r.css("overflow", "scroll"), n = s.offsetWidth, t === n && (n = r[0].clientWidth), r.remove(), i = t - n
            }, getScrollInfo: function (t) {
                var n = t.isWindow || t.isDocument ? "" : t.element.css("overflow-x"), r = t.isWindow || t.isDocument ? "" : t.element.css("overflow-y"), i = "scroll" === n || "auto" === n && t.width < t.element[0].scrollWidth, s = "scroll" === r || "auto" === r && t.height < t.element[0].scrollHeight;
                return {width: s ? e.position.scrollbarWidth() : 0, height: i ? e.position.scrollbarWidth() : 0}
            }, getWithinInfo: function (t) {
                var n = e(t || window), r = e.isWindow(n[0]), i = !!n[0] && 9 === n[0].nodeType;
                return {
                    element: n,
                    isWindow: r,
                    isDocument: i,
                    offset: n.offset() || {left: 0, top: 0},
                    scrollLeft: n.scrollLeft(),
                    scrollTop: n.scrollTop(),
                    width: r || i ? n.width() : n.outerWidth(),
                    height: r || i ? n.height() : n.outerHeight()
                }
            }
        }, e.fn.position = function (i) {
            if (!i || !i.of)return d.apply(this, arguments);
            i = e.extend({}, i);
            var p, v, m, g, y, b, w = e(i.of), E = e.position.getWithinInfo(i.within), S = e.position.getScrollInfo(E), x = (i.collision || "flip").split(" "), T = {};
            return b = r(w), w[0].preventDefault && (i.at = "left top"), v = b.width, m = b.height, g = b.offset, y = e.extend({}, g), e.each(["my", "at"], function () {
                var e, t, n = (i[this] || "").split(" ");
                1 === n.length && (n = f.test(n[0]) ? n.concat(["center"]) : l.test(n[0]) ? ["center"].concat(n) : ["center", "center"]), n[0] = f.test(n[0]) ? n[0] : "center", n[1] = l.test(n[1]) ? n[1] : "center", e = c.exec(n[0]), t = c.exec(n[1]), T[this] = [e ? e[0] : 0, t ? t[0] : 0], i[this] = [h.exec(n[0])[0], h.exec(n[1])[0]]
            }), 1 === x.length && (x[1] = x[0]), "right" === i.at[0] ? y.left += v : "center" === i.at[0] && (y.left += v / 2), "bottom" === i.at[1] ? y.top += m : "center" === i.at[1] && (y.top += m / 2), p = t(T.at, v, m), y.left += p[0], y.top += p[1], this.each(function () {
                var r, f, l = e(this), c = l.outerWidth(), h = l.outerHeight(), d = n(this, "marginLeft"), b = n(this, "marginTop"), N = c + d + n(this, "marginRight") + S.width, C = h + b + n(this, "marginBottom") + S.height, L = e.extend({}, y), A = t(T.my, l.outerWidth(), l.outerHeight());
                "right" === i.my[0] ? L.left -= c : "center" === i.my[0] && (L.left -= c / 2), "bottom" === i.my[1] ? L.top -= h : "center" === i.my[1] && (L.top -= h / 2), L.left += A[0], L.top += A[1], s || (L.left = a(L.left), L.top = a(L.top)), r = {
                    marginLeft: d,
                    marginTop: b
                }, e.each(["left", "top"], function (t, n) {
                    e.ui.position[x[t]] && e.ui.position[x[t]][n](L, {
                        targetWidth: v,
                        targetHeight: m,
                        elemWidth: c,
                        elemHeight: h,
                        collisionPosition: r,
                        collisionWidth: N,
                        collisionHeight: C,
                        offset: [p[0] + A[0], p[1] + A[1]],
                        my: i.my,
                        at: i.at,
                        within: E,
                        elem: l
                    })
                }), i.using && (f = function (e) {
                    var t = g.left - L.left, n = t + v - c, r = g.top - L.top, s = r + m - h, a = {
                        target: {
                            element: w,
                            left: g.left,
                            top: g.top,
                            width: v,
                            height: m
                        },
                        element: {element: l, left: L.left, top: L.top, width: c, height: h},
                        horizontal: 0 > n ? "left" : t > 0 ? "right" : "center",
                        vertical: 0 > s ? "top" : r > 0 ? "bottom" : "middle"
                    };
                    c > v && v > u(t + n) && (a.horizontal = "center"), h > m && m > u(r + s) && (a.vertical = "middle"), a.important = o(u(t), u(n)) > o(u(r), u(s)) ? "horizontal" : "vertical", i.using.call(this, e, a)
                }), l.offset(e.extend(L, {using: f}))
            })
        }, e.ui.position = {
            fit: {
                left: function (e, t) {
                    var n, r = t.within, i = r.isWindow ? r.scrollLeft : r.offset.left, s = r.width, u = e.left - t.collisionPosition.marginLeft, a = i - u, f = u + t.collisionWidth - s - i;
                    t.collisionWidth > s ? a > 0 && 0 >= f ? (n = e.left + a + t.collisionWidth - s - i, e.left += a - n) : e.left = f > 0 && 0 >= a ? i : a > f ? i + s - t.collisionWidth : i : a > 0 ? e.left += a : f > 0 ? e.left -= f : e.left = o(e.left - u, e.left)
                }, top: function (e, t) {
                    var n, r = t.within, i = r.isWindow ? r.scrollTop : r.offset.top, s = t.within.height, u = e.top - t.collisionPosition.marginTop, a = i - u, f = u + t.collisionHeight - s - i;
                    t.collisionHeight > s ? a > 0 && 0 >= f ? (n = e.top + a + t.collisionHeight - s - i, e.top += a - n) : e.top = f > 0 && 0 >= a ? i : a > f ? i + s - t.collisionHeight : i : a > 0 ? e.top += a : f > 0 ? e.top -= f : e.top = o(e.top - u, e.top)
                }
            }, flip: {
                left: function (e, t) {
                    var n, r, i = t.within, s = i.offset.left + i.scrollLeft, o = i.width, a = i.isWindow ? i.scrollLeft : i.offset.left, f = e.left - t.collisionPosition.marginLeft, l = f - a, c = f + t.collisionWidth - o - a, h = "left" === t.my[0] ? -t.elemWidth : "right" === t.my[0] ? t.elemWidth : 0, p = "left" === t.at[0] ? t.targetWidth : "right" === t.at[0] ? -t.targetWidth : 0, d = -2 * t.offset[0];
                    0 > l ? (n = e.left + h + p + d + t.collisionWidth - o - s, (0 > n || u(l) > n) && (e.left += h + p + d)) : c > 0 && (r = e.left - t.collisionPosition.marginLeft + h + p + d - a, (r > 0 || c > u(r)) && (e.left += h + p + d))
                }, top: function (e, t) {
                    var n, r, i = t.within, s = i.offset.top + i.scrollTop, o = i.height, a = i.isWindow ? i.scrollTop : i.offset.top, f = e.top - t.collisionPosition.marginTop, l = f - a, c = f + t.collisionHeight - o - a, h = "top" === t.my[1], p = h ? -t.elemHeight : "bottom" === t.my[1] ? t.elemHeight : 0, d = "top" === t.at[1] ? t.targetHeight : "bottom" === t.at[1] ? -t.targetHeight : 0, v = -2 * t.offset[1];
                    0 > l ? (r = e.top + p + d + v + t.collisionHeight - o - s, (0 > r || u(l) > r) && (e.top += p + d + v)) : c > 0 && (n = e.top - t.collisionPosition.marginTop + p + d + v - a, (n > 0 || c > u(n)) && (e.top += p + d + v))
                }
            }, flipfit: {
                left: function () {
                    e.ui.position.flip.left.apply(this, arguments), e.ui.position.fit.left.apply(this, arguments)
                }, top: function () {
                    e.ui.position.flip.top.apply(this, arguments), e.ui.position.fit.top.apply(this, arguments)
                }
            }
        }, function () {
            var t, n, r, i, o, u = document.getElementsByTagName("body")[0], a = document.createElement("div");
            t = document.createElement(u ? "div" : "body"), r = {
                visibility: "hidden",
                width: 0,
                height: 0,
                border: 0,
                margin: 0,
                background: "none"
            }, u && e.extend(r, {position: "absolute", left: "-1000px", top: "-1000px"});
            for (o in r)t.style[o] = r[o];
            t.appendChild(a), n = u || document.documentElement, n.insertBefore(t, n.firstChild), a.style.cssText = "position: absolute; left: 10.7432222px;", i = e(a).offset().left, s = i > 10 && 11 > i, t.innerHTML = "", n.removeChild(t)
        }()
    }(), e.ui.position, e.widget("ui.draggable", e.ui.mouse, {
        version: "1.11.4",
        widgetEventPrefix: "drag",
        options: {
            addClasses: !0,
            appendTo: "parent",
            axis: !1,
            connectToSortable: !1,
            containment: !1,
            cursor: "auto",
            cursorAt: !1,
            grid: !1,
            handle: !1,
            helper: "original",
            iframeFix: !1,
            opacity: !1,
            refreshPositions: !1,
            revert: !1,
            revertDuration: 500,
            scope: "default",
            scroll: !0,
            scrollSensitivity: 20,
            scrollSpeed: 20,
            snap: !1,
            snapMode: "both",
            snapTolerance: 20,
            stack: !1,
            zIndex: !1,
            drag: null,
            start: null,
            stop: null
        },
        _create: function () {
            "original" === this.options.helper && this._setPositionRelative(), this.options.addClasses && this.element.addClass("ui-draggable"), this.options.disabled && this.element.addClass("ui-draggable-disabled"), this._setHandleClassName(), this._mouseInit()
        },
        _setOption: function (e, t) {
            this._super(e, t), "handle" === e && (this._removeHandleClassName(), this._setHandleClassName())
        },
        _destroy: function () {
            return (this.helper || this.element).is(".ui-draggable-dragging") ? (this.destroyOnClear = !0, void 0) : (this.element.removeClass("ui-draggable ui-draggable-dragging ui-draggable-disabled"), this._removeHandleClassName(), this._mouseDestroy(), void 0)
        },
        _mouseCapture: function (t) {
            var n = this.options;
            return this._blurActiveElement(t), this.helper || n.disabled || e(t.target).closest(".ui-resizable-handle").length > 0 ? !1 : (this.handle = this._getHandle(t), this.handle ? (this._blockFrames(n.iframeFix === !0 ? "iframe" : n.iframeFix), !0) : !1)
        },
        _blockFrames: function (t) {
            this.iframeBlocks = this.document.find(t).map(function () {
                var t = e(this);
                return e("<div>").css("position", "absolute").appendTo(t.parent()).outerWidth(t.outerWidth()).outerHeight(t.outerHeight()).offset(t.offset())[0]
            })
        },
        _unblockFrames: function () {
            this.iframeBlocks && (this.iframeBlocks.remove(), delete this.iframeBlocks)
        },
        _blurActiveElement: function (t) {
            var n = this.document[0];
            if (this.handleElement.is(t.target))try {
                n.activeElement && "body" !== n.activeElement.nodeName.toLowerCase() && e(n.activeElement).blur()
            } catch (r) {
            }
        },
        _mouseStart: function (t) {
            var n = this.options;
            return this.helper = this._createHelper(t), this.helper.addClass("ui-draggable-dragging"), this._cacheHelperProportions(), e.ui.ddmanager && (e.ui.ddmanager.current = this), this._cacheMargins(), this.cssPosition = this.helper.css("position"), this.scrollParent = this.helper.scrollParent(!0), this.offsetParent = this.helper.offsetParent(), this.hasFixedAncestor = this.helper.parents().filter(function () {
                    return "fixed" === e(this).css("position")
                }).length > 0, this.positionAbs = this.element.offset(), this._refreshOffsets(t), this.originalPosition = this.position = this._generatePosition(t, !1), this.originalPageX = t.pageX, this.originalPageY = t.pageY, n.cursorAt && this._adjustOffsetFromHelper(n.cursorAt), this._setContainment(), this._trigger("start", t) === !1 ? (this._clear(), !1) : (this._cacheHelperProportions(), e.ui.ddmanager && !n.dropBehaviour && e.ui.ddmanager.prepareOffsets(this, t), this._normalizeRightBottom(), this._mouseDrag(t, !0), e.ui.ddmanager && e.ui.ddmanager.dragStart(this, t), !0)
        },
        _refreshOffsets: function (e) {
            this.offset = {
                top: this.positionAbs.top - this.margins.top,
                left: this.positionAbs.left - this.margins.left,
                scroll: !1,
                parent: this._getParentOffset(),
                relative: this._getRelativeOffset()
            }, this.offset.click = {left: e.pageX - this.offset.left, top: e.pageY - this.offset.top}
        },
        _mouseDrag: function (t, n) {
            if (this.hasFixedAncestor && (this.offset.parent = this._getParentOffset()), this.position = this._generatePosition(t, !0), this.positionAbs = this._convertPositionTo("absolute"), !n) {
                var r = this._uiHash();
                if (this._trigger("drag", t, r) === !1)return this._mouseUp({}), !1;
                this.position = r.position
            }
            return this.helper[0].style.left = this.position.left + "px", this.helper[0].style.top = this.position.top + "px", e.ui.ddmanager && e.ui.ddmanager.drag(this, t), !1
        },
        _mouseStop: function (t) {
            var n = this, r = !1;
            return e.ui.ddmanager && !this.options.dropBehaviour && (r = e.ui.ddmanager.drop(this, t)), this.dropped && (r = this.dropped, this.dropped = !1), "invalid" === this.options.revert && !r || "valid" === this.options.revert && r || this.options.revert === !0 || e.isFunction(this.options.revert) && this.options.revert.call(this.element, r) ? e(this.helper).animate(this.originalPosition, parseInt(this.options.revertDuration, 10), function () {
                n._trigger("stop", t) !== !1 && n._clear()
            }) : this._trigger("stop", t) !== !1 && this._clear(), !1
        },
        _mouseUp: function (t) {
            return this._unblockFrames(), e.ui.ddmanager && e.ui.ddmanager.dragStop(this, t), this.handleElement.is(t.target) && this.element.focus(), e.ui.mouse.prototype._mouseUp.call(this, t)
        },
        cancel: function () {
            return this.helper.is(".ui-draggable-dragging") ? this._mouseUp({}) : this._clear(), this
        },
        _getHandle: function (t) {
            return this.options.handle ? !!e(t.target).closest(this.element.find(this.options.handle)).length : !0
        },
        _setHandleClassName: function () {
            this.handleElement = this.options.handle ? this.element.find(this.options.handle) : this.element, this.handleElement.addClass("ui-draggable-handle")
        },
        _removeHandleClassName: function () {
            this.handleElement.removeClass("ui-draggable-handle")
        },
        _createHelper: function (t) {
            var n = this.options, r = e.isFunction(n.helper), i = r ? e(n.helper.apply(this.element[0], [t])) : "clone" === n.helper ? this.element.clone().removeAttr("id") : this.element;
            return i.parents("body").length || i.appendTo("parent" === n.appendTo ? this.element[0].parentNode : n.appendTo), r && i[0] === this.element[0] && this._setPositionRelative(), i[0] === this.element[0] || /(fixed|absolute)/.test(i.css("position")) || i.css("position", "absolute"), i
        },
        _setPositionRelative: function () {
            /^(?:r|a|f)/.test(this.element.css("position")) || (this.element[0].style.position = "relative")
        },
        _adjustOffsetFromHelper: function (t) {
            "string" == typeof t && (t = t.split(" ")), e.isArray(t) && (t = {
                left: +t[0],
                top: +t[1] || 0
            }), "left" in t && (this.offset.click.left = t.left + this.margins.left), "right" in t && (this.offset.click.left = this.helperProportions.width - t.right + this.margins.left), "top" in t && (this.offset.click.top = t.top + this.margins.top), "bottom" in t && (this.offset.click.top = this.helperProportions.height - t.bottom + this.margins.top)
        },
        _isRootNode: function (e) {
            return /(html|body)/i.test(e.tagName) || e === this.document[0]
        },
        _getParentOffset: function () {
            var t = this.offsetParent.offset(), n = this.document[0];
            return "absolute" === this.cssPosition && this.scrollParent[0] !== n && e.contains(this.scrollParent[0], this.offsetParent[0]) && (t.left += this.scrollParent.scrollLeft(), t.top += this.scrollParent.scrollTop()), this._isRootNode(this.offsetParent[0]) && (t = {
                top: 0,
                left: 0
            }), {
                top: t.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
                left: t.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
            }
        },
        _getRelativeOffset: function () {
            if ("relative" !== this.cssPosition)return {top: 0, left: 0};
            var e = this.element.position(), t = this._isRootNode(this.scrollParent[0]);
            return {
                top: e.top - (parseInt(this.helper.css("top"), 10) || 0) + (t ? 0 : this.scrollParent.scrollTop()),
                left: e.left - (parseInt(this.helper.css("left"), 10) || 0) + (t ? 0 : this.scrollParent.scrollLeft())
            }
        },
        _cacheMargins: function () {
            this.margins = {
                left: parseInt(this.element.css("marginLeft"), 10) || 0,
                top: parseInt(this.element.css("marginTop"), 10) || 0,
                right: parseInt(this.element.css("marginRight"), 10) || 0,
                bottom: parseInt(this.element.css("marginBottom"), 10) || 0
            }
        },
        _cacheHelperProportions: function () {
            this.helperProportions = {width: this.helper.outerWidth(), height: this.helper.outerHeight()}
        },
        _setContainment: function () {
            var t, n, r, i = this.options, s = this.document[0];
            return this.relativeContainer = null, i.containment ? "window" === i.containment ? (this.containment = [e(window).scrollLeft() - this.offset.relative.left - this.offset.parent.left, e(window).scrollTop() - this.offset.relative.top - this.offset.parent.top, e(window).scrollLeft() + e(window).width() - this.helperProportions.width - this.margins.left, e(window).scrollTop() + (e(window).height() || s.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top], void 0) : "document" === i.containment ? (this.containment = [0, 0, e(s).width() - this.helperProportions.width - this.margins.left, (e(s).height() || s.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top], void 0) : i.containment.constructor === Array ? (this.containment = i.containment, void 0) : ("parent" === i.containment && (i.containment = this.helper[0].parentNode), n = e(i.containment), r = n[0], r && (t = /(scroll|auto)/.test(n.css("overflow")), this.containment = [(parseInt(n.css("borderLeftWidth"), 10) || 0) + (parseInt(n.css("paddingLeft"), 10) || 0), (parseInt(n.css("borderTopWidth"), 10) || 0) + (parseInt(n.css("paddingTop"), 10) || 0), (t ? Math.max(r.scrollWidth, r.offsetWidth) : r.offsetWidth) - (parseInt(n.css("borderRightWidth"), 10) || 0) - (parseInt(n.css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left - this.margins.right, (t ? Math.max(r.scrollHeight, r.offsetHeight) : r.offsetHeight) - (parseInt(n.css("borderBottomWidth"), 10) || 0) - (parseInt(n.css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top - this.margins.bottom], this.relativeContainer = n), void 0) : (this.containment = null, void 0)
        },
        _convertPositionTo: function (e, t) {
            t || (t = this.position);
            var n = "absolute" === e ? 1 : -1, r = this._isRootNode(this.scrollParent[0]);
            return {
                top: t.top + this.offset.relative.top * n + this.offset.parent.top * n - ("fixed" === this.cssPosition ? -this.offset.scroll.top : r ? 0 : this.offset.scroll.top) * n,
                left: t.left + this.offset.relative.left * n + this.offset.parent.left * n - ("fixed" === this.cssPosition ? -this.offset.scroll.left : r ? 0 : this.offset.scroll.left) * n
            }
        },
        _generatePosition: function (e, t) {
            var n, r, i, s, o = this.options, u = this._isRootNode(this.scrollParent[0]), a = e.pageX, f = e.pageY;
            return u && this.offset.scroll || (this.offset.scroll = {
                top: this.scrollParent.scrollTop(),
                left: this.scrollParent.scrollLeft()
            }), t && (this.containment && (this.relativeContainer ? (r = this.relativeContainer.offset(), n = [this.containment[0] + r.left, this.containment[1] + r.top, this.containment[2] + r.left, this.containment[3] + r.top]) : n = this.containment, e.pageX - this.offset.click.left < n[0] && (a = n[0] + this.offset.click.left), e.pageY - this.offset.click.top < n[1] && (f = n[1] + this.offset.click.top), e.pageX - this.offset.click.left > n[2] && (a = n[2] + this.offset.click.left), e.pageY - this.offset.click.top > n[3] && (f = n[3] + this.offset.click.top)), o.grid && (i = o.grid[1] ? this.originalPageY + Math.round((f - this.originalPageY) / o.grid[1]) * o.grid[1] : this.originalPageY, f = n ? i - this.offset.click.top >= n[1] || i - this.offset.click.top > n[3] ? i : i - this.offset.click.top >= n[1] ? i - o.grid[1] : i + o.grid[1] : i, s = o.grid[0] ? this.originalPageX + Math.round((a - this.originalPageX) / o.grid[0]) * o.grid[0] : this.originalPageX, a = n ? s - this.offset.click.left >= n[0] || s - this.offset.click.left > n[2] ? s : s - this.offset.click.left >= n[0] ? s - o.grid[0] : s + o.grid[0] : s), "y" === o.axis && (a = this.originalPageX), "x" === o.axis && (f = this.originalPageY)), {
                top: f - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.offset.scroll.top : u ? 0 : this.offset.scroll.top),
                left: a - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.offset.scroll.left : u ? 0 : this.offset.scroll.left)
            }
        },
        _clear: function () {
            this.helper.removeClass("ui-draggable-dragging"), this.helper[0] === this.element[0] || this.cancelHelperRemoval || this.helper.remove(), this.helper = null, this.cancelHelperRemoval = !1, this.destroyOnClear && this.destroy()
        },
        _normalizeRightBottom: function () {
            "y" !== this.options.axis && "auto" !== this.helper.css("right") && (this.helper.width(this.helper.width()), this.helper.css("right", "auto")), "x" !== this.options.axis && "auto" !== this.helper.css("bottom") && (this.helper.height(this.helper.height()), this.helper.css("bottom", "auto"))
        },
        _trigger: function (t, n, r) {
            return r = r || this._uiHash(), e.ui.plugin.call(this, t, [n, r, this], !0), /^(drag|start|stop)/.test(t) && (this.positionAbs = this._convertPositionTo("absolute"), r.offset = this.positionAbs), e.Widget.prototype._trigger.call(this, t, n, r)
        },
        plugins: {},
        _uiHash: function () {
            return {
                helper: this.helper,
                position: this.position,
                originalPosition: this.originalPosition,
                offset: this.positionAbs
            }
        }
    }), e.ui.plugin.add("draggable", "connectToSortable", {
        start: function (t, n, r) {
            var i = e.extend({}, n, {item: r.element});
            r.sortables = [], e(r.options.connectToSortable).each(function () {
                var n = e(this).sortable("instance");
                n && !n.options.disabled && (r.sortables.push(n), n.refreshPositions(), n._trigger("activate", t, i))
            })
        }, stop: function (t, n, r) {
            var i = e.extend({}, n, {item: r.element});
            r.cancelHelperRemoval = !1, e.each(r.sortables, function () {
                var e = this;
                e.isOver ? (e.isOver = 0, r.cancelHelperRemoval = !0, e.cancelHelperRemoval = !1, e._storedCSS = {
                    position: e.placeholder.css("position"),
                    top: e.placeholder.css("top"),
                    left: e.placeholder.css("left")
                }, e._mouseStop(t), e.options.helper = e.options._helper) : (e.cancelHelperRemoval = !0, e._trigger("deactivate", t, i))
            })
        }, drag: function (t, n, r) {
            e.each(r.sortables, function () {
                var i = !1, s = this;
                s.positionAbs = r.positionAbs, s.helperProportions = r.helperProportions, s.offset.click = r.offset.click, s._intersectsWith(s.containerCache) && (i = !0, e.each(r.sortables, function () {
                    return this.positionAbs = r.positionAbs, this.helperProportions = r.helperProportions, this.offset.click = r.offset.click, this !== s && this._intersectsWith(this.containerCache) && e.contains(s.element[0], this.element[0]) && (i = !1), i
                })), i ? (s.isOver || (s.isOver = 1, r._parent = n.helper.parent(), s.currentItem = n.helper.appendTo(s.element).data("ui-sortable-item", !0), s.options._helper = s.options.helper, s.options.helper = function () {
                    return n.helper[0]
                }, t.target = s.currentItem[0], s._mouseCapture(t, !0), s._mouseStart(t, !0, !0), s.offset.click.top = r.offset.click.top, s.offset.click.left = r.offset.click.left, s.offset.parent.left -= r.offset.parent.left - s.offset.parent.left, s.offset.parent.top -= r.offset.parent.top - s.offset.parent.top, r._trigger("toSortable", t), r.dropped = s.element, e.each(r.sortables, function () {
                    this.refreshPositions()
                }), r.currentItem = r.element, s.fromOutside = r), s.currentItem && (s._mouseDrag(t), n.position = s.position)) : s.isOver && (s.isOver = 0, s.cancelHelperRemoval = !0, s.options._revert = s.options.revert, s.options.revert = !1, s._trigger("out", t, s._uiHash(s)), s._mouseStop(t, !0), s.options.revert = s.options._revert, s.options.helper = s.options._helper, s.placeholder && s.placeholder.remove(), n.helper.appendTo(r._parent), r._refreshOffsets(t), n.position = r._generatePosition(t, !0), r._trigger("fromSortable", t), r.dropped = !1, e.each(r.sortables, function () {
                    this.refreshPositions()
                }))
            })
        }
    }), e.ui.plugin.add("draggable", "cursor", {
        start: function (t, n, r) {
            var i = e("body"), s = r.options;
            i.css("cursor") && (s._cursor = i.css("cursor")), i.css("cursor", s.cursor)
        }, stop: function (t, n, r) {
            var i = r.options;
            i._cursor && e("body").css("cursor", i._cursor)
        }
    }), e.ui.plugin.add("draggable", "opacity", {
        start: function (t, n, r) {
            var i = e(n.helper), s = r.options;
            i.css("opacity") && (s._opacity = i.css("opacity")), i.css("opacity", s.opacity)
        }, stop: function (t, n, r) {
            var i = r.options;
            i._opacity && e(n.helper).css("opacity", i._opacity)
        }
    }), e.ui.plugin.add("draggable", "scroll", {
        start: function (e, t, n) {
            n.scrollParentNotHidden || (n.scrollParentNotHidden = n.helper.scrollParent(!1)), n.scrollParentNotHidden[0] !== n.document[0] && "HTML" !== n.scrollParentNotHidden[0].tagName && (n.overflowOffset = n.scrollParentNotHidden.offset())
        }, drag: function (t, n, r) {
            var i = r.options, s = !1, o = r.scrollParentNotHidden[0], u = r.document[0];
            o !== u && "HTML" !== o.tagName ? (i.axis && "x" === i.axis || (r.overflowOffset.top + o.offsetHeight - t.pageY < i.scrollSensitivity ? o.scrollTop = s = o.scrollTop + i.scrollSpeed : t.pageY - r.overflowOffset.top < i.scrollSensitivity && (o.scrollTop = s = o.scrollTop - i.scrollSpeed)), i.axis && "y" === i.axis || (r.overflowOffset.left + o.offsetWidth - t.pageX < i.scrollSensitivity ? o.scrollLeft = s = o.scrollLeft + i.scrollSpeed : t.pageX - r.overflowOffset.left < i.scrollSensitivity && (o.scrollLeft = s = o.scrollLeft - i.scrollSpeed))) : (i.axis && "x" === i.axis || (t.pageY - e(u).scrollTop() < i.scrollSensitivity ? s = e(u).scrollTop(e(u).scrollTop() - i.scrollSpeed) : e(window).height() - (t.pageY - e(u).scrollTop()) < i.scrollSensitivity && (s = e(u).scrollTop(e(u).scrollTop() + i.scrollSpeed))), i.axis && "y" === i.axis || (t.pageX - e(u).scrollLeft() < i.scrollSensitivity ? s = e(u).scrollLeft(e(u).scrollLeft() - i.scrollSpeed) : e(window).width() - (t.pageX - e(u).scrollLeft()) < i.scrollSensitivity && (s = e(u).scrollLeft(e(u).scrollLeft() + i.scrollSpeed)))), s !== !1 && e.ui.ddmanager && !i.dropBehaviour && e.ui.ddmanager.prepareOffsets(r, t)
        }
    }), e.ui.plugin.add("draggable", "snap", {
        start: function (t, n, r) {
            var i = r.options;
            r.snapElements = [], e(i.snap.constructor !== String ? i.snap.items || ":data(ui-draggable)" : i.snap).each(function () {
                var t = e(this), n = t.offset();
                this !== r.element[0] && r.snapElements.push({
                    item: this,
                    width: t.outerWidth(),
                    height: t.outerHeight(),
                    top: n.top,
                    left: n.left
                })
            })
        }, drag: function (t, n, r) {
            var i, s, o, u, a, f, l, c, h, p, d = r.options, v = d.snapTolerance, m = n.offset.left, g = m + r.helperProportions.width, y = n.offset.top, b = y + r.helperProportions.height;
            for (h = r.snapElements.length - 1; h >= 0; h--)a = r.snapElements[h].left - r.margins.left, f = a + r.snapElements[h].width, l = r.snapElements[h].top - r.margins.top, c = l + r.snapElements[h].height, a - v > g || m > f + v || l - v > b || y > c + v || !e.contains(r.snapElements[h].item.ownerDocument, r.snapElements[h].item) ? (r.snapElements[h].snapping && r.options.snap.release && r.options.snap.release.call(r.element, t, e.extend(r._uiHash(), {snapItem: r.snapElements[h].item})), r.snapElements[h].snapping = !1) : ("inner" !== d.snapMode && (i = v >= Math.abs(l - b), s = v >= Math.abs(c - y), o = v >= Math.abs(a - g), u = v >= Math.abs(f - m), i && (n.position.top = r._convertPositionTo("relative", {
                top: l - r.helperProportions.height,
                left: 0
            }).top), s && (n.position.top = r._convertPositionTo("relative", {
                top: c,
                left: 0
            }).top), o && (n.position.left = r._convertPositionTo("relative", {
                top: 0,
                left: a - r.helperProportions.width
            }).left), u && (n.position.left = r._convertPositionTo("relative", {
                top: 0,
                left: f
            }).left)), p = i || s || o || u, "outer" !== d.snapMode && (i = v >= Math.abs(l - y), s = v >= Math.abs(c - b), o = v >= Math.abs(a - m), u = v >= Math.abs(f - g), i && (n.position.top = r._convertPositionTo("relative", {
                top: l,
                left: 0
            }).top), s && (n.position.top = r._convertPositionTo("relative", {
                top: c - r.helperProportions.height,
                left: 0
            }).top), o && (n.position.left = r._convertPositionTo("relative", {
                top: 0,
                left: a
            }).left), u && (n.position.left = r._convertPositionTo("relative", {
                top: 0,
                left: f - r.helperProportions.width
            }).left)), !r.snapElements[h].snapping && (i || s || o || u || p) && r.options.snap.snap && r.options.snap.snap.call(r.element, t, e.extend(r._uiHash(), {snapItem: r.snapElements[h].item})), r.snapElements[h].snapping = i || s || o || u || p)
        }
    }), e.ui.plugin.add("draggable", "stack", {
        start: function (t, n, r) {
            var i, s = r.options, o = e.makeArray(e(s.stack)).sort(function (t, n) {
                return (parseInt(e(t).css("zIndex"), 10) || 0) - (parseInt(e(n).css("zIndex"), 10) || 0)
            });
            o.length && (i = parseInt(e(o[0]).css("zIndex"), 10) || 0, e(o).each(function (t) {
                e(this).css("zIndex", i + t)
            }), this.css("zIndex", i + o.length))
        }
    }), e.ui.plugin.add("draggable", "zIndex", {
        start: function (t, n, r) {
            var i = e(n.helper), s = r.options;
            i.css("zIndex") && (s._zIndex = i.css("zIndex")), i.css("zIndex", s.zIndex)
        }, stop: function (t, n, r) {
            var i = r.options;
            i._zIndex && e(n.helper).css("zIndex", i._zIndex)
        }
    }), e.ui.draggable, e.widget("ui.droppable", {
        version: "1.11.4",
        widgetEventPrefix: "drop",
        options: {
            accept: "*",
            activeClass: !1,
            addClasses: !0,
            greedy: !1,
            hoverClass: !1,
            scope: "default",
            tolerance: "intersect",
            activate: null,
            deactivate: null,
            drop: null,
            out: null,
            over: null
        },
        _create: function () {
            var t, n = this.options, r = n.accept;
            this.isover = !1, this.isout = !0, this.accept = e.isFunction(r) ? r : function (e) {
                return e.is(r)
            }, this.proportions = function () {
                return arguments.length ? (t = arguments[0], void 0) : t ? t : t = {
                    width: this.element[0].offsetWidth,
                    height: this.element[0].offsetHeight
                }
            }, this._addToManager(n.scope), n.addClasses && this.element.addClass("ui-droppable")
        },
        _addToManager: function (t) {
            e.ui.ddmanager.droppables[t] = e.ui.ddmanager.droppables[t] || [], e.ui.ddmanager.droppables[t].push(this)
        },
        _splice: function (e) {
            for (var t = 0; e.length > t; t++)e[t] === this && e.splice(t, 1)
        },
        _destroy: function () {
            var t = e.ui.ddmanager.droppables[this.options.scope];
            this._splice(t), this.element.removeClass("ui-droppable ui-droppable-disabled")
        },
        _setOption: function (t, n) {
            if ("accept" === t)this.accept = e.isFunction(n) ? n : function (e) {
                return e.is(n)
            }; else if ("scope" === t) {
                var r = e.ui.ddmanager.droppables[this.options.scope];
                this._splice(r), this._addToManager(n)
            }
            this._super(t, n)
        },
        _activate: function (t) {
            var n = e.ui.ddmanager.current;
            this.options.activeClass && this.element.addClass(this.options.activeClass), n && this._trigger("activate", t, this.ui(n))
        },
        _deactivate: function (t) {
            var n = e.ui.ddmanager.current;
            this.options.activeClass && this.element.removeClass(this.options.activeClass), n && this._trigger("deactivate", t, this.ui(n))
        },
        _over: function (t) {
            var n = e.ui.ddmanager.current;
            n && (n.currentItem || n.element)[0] !== this.element[0] && this.accept.call(this.element[0], n.currentItem || n.element) && (this.options.hoverClass && this.element.addClass(this.options.hoverClass), this._trigger("over", t, this.ui(n)))
        },
        _out: function (t) {
            var n = e.ui.ddmanager.current;
            n && (n.currentItem || n.element)[0] !== this.element[0] && this.accept.call(this.element[0], n.currentItem || n.element) && (this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("out", t, this.ui(n)))
        },
        _drop: function (t, n) {
            var r = n || e.ui.ddmanager.current, i = !1;
            return r && (r.currentItem || r.element)[0] !== this.element[0] ? (this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each(function () {
                var n = e(this).droppable("instance");
                return n.options.greedy && !n.options.disabled && n.options.scope === r.options.scope && n.accept.call(n.element[0], r.currentItem || r.element) && e.ui.intersect(r, e.extend(n, {offset: n.element.offset()}), n.options.tolerance, t) ? (i = !0, !1) : void 0
            }), i ? !1 : this.accept.call(this.element[0], r.currentItem || r.element) ? (this.options.activeClass && this.element.removeClass(this.options.activeClass), this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("drop", t, this.ui(r)), this.element) : !1) : !1
        },
        ui: function (e) {
            return {
                draggable: e.currentItem || e.element,
                helper: e.helper,
                position: e.position,
                offset: e.positionAbs
            }
        }
    }), e.ui.intersect = function () {
        function e(e, t, n) {
            return e >= t && t + n > e
        }

        return function (t, n, r, i) {
            if (!n.offset)return !1;
            var s = (t.positionAbs || t.position.absolute).left + t.margins.left, o = (t.positionAbs || t.position.absolute).top + t.margins.top, u = s + t.helperProportions.width, a = o + t.helperProportions.height, f = n.offset.left, l = n.offset.top, c = f + n.proportions().width, h = l + n.proportions().height;
            switch (r) {
                case"fit":
                    return s >= f && c >= u && o >= l && h >= a;
                case"intersect":
                    return s + t.helperProportions.width / 2 > f && c > u - t.helperProportions.width / 2 && o + t.helperProportions.height / 2 > l && h > a - t.helperProportions.height / 2;
                case"pointer":
                    return e(i.pageY, l, n.proportions().height) && e(i.pageX, f, n.proportions().width);
                case"touch":
                    return (o >= l && h >= o || a >= l && h >= a || l > o && a > h) && (s >= f && c >= s || u >= f && c >= u || f > s && u > c);
                default:
                    return !1
            }
        }
    }(), e.ui.ddmanager = {
        current: null, droppables: {"default": []}, prepareOffsets: function (t, n) {
            var r, i, s = e.ui.ddmanager.droppables[t.options.scope] || [], o = n ? n.type : null, u = (t.currentItem || t.element).find(":data(ui-droppable)").addBack();
            e:for (r = 0; s.length > r; r++)if (!(s[r].options.disabled || t && !s[r].accept.call(s[r].element[0], t.currentItem || t.element))) {
                for (i = 0; u.length > i; i++)if (u[i] === s[r].element[0]) {
                    s[r].proportions().height = 0;
                    continue e
                }
                s[r].visible = "none" !== s[r].element.css("display"), s[r].visible && ("mousedown" === o && s[r]._activate.call(s[r], n), s[r].offset = s[r].element.offset(), s[r].proportions({
                    width: s[r].element[0].offsetWidth,
                    height: s[r].element[0].offsetHeight
                }))
            }
        }, drop: function (t, n) {
            var r = !1;
            return e.each((e.ui.ddmanager.droppables[t.options.scope] || []).slice(), function () {
                this.options && (!this.options.disabled && this.visible && e.ui.intersect(t, this, this.options.tolerance, n) && (r = this._drop.call(this, n) || r), !this.options.disabled && this.visible && this.accept.call(this.element[0], t.currentItem || t.element) && (this.isout = !0, this.isover = !1, this._deactivate.call(this, n)))
            }), r
        }, dragStart: function (t, n) {
            t.element.parentsUntil("body").bind("scroll.droppable", function () {
                t.options.refreshPositions || e.ui.ddmanager.prepareOffsets(t, n)
            })
        }, drag: function (t, n) {
            t.options.refreshPositions && e.ui.ddmanager.prepareOffsets(t, n), e.each(e.ui.ddmanager.droppables[t.options.scope] || [], function () {
                if (!this.options.disabled && !this.greedyChild && this.visible) {
                    var r, i, s, o = e.ui.intersect(t, this, this.options.tolerance, n), u = !o && this.isover ? "isout" : o && !this.isover ? "isover" : null;
                    u && (this.options.greedy && (i = this.options.scope, s = this.element.parents(":data(ui-droppable)").filter(function () {
                        return e(this).droppable("instance").options.scope === i
                    }), s.length && (r = e(s[0]).droppable("instance"), r.greedyChild = "isover" === u)), r && "isover" === u && (r.isover = !1, r.isout = !0, r._out.call(r, n)), this[u] = !0, this["isout" === u ? "isover" : "isout"] = !1, this["isover" === u ? "_over" : "_out"].call(this, n), r && "isout" === u && (r.isout = !1, r.isover = !0, r._over.call(r, n)))
                }
            })
        }, dragStop: function (t, n) {
            t.element.parentsUntil("body").unbind("scroll.droppable"), t.options.refreshPositions || e.ui.ddmanager.prepareOffsets(t, n)
        }
    }, e.ui.droppable, e.widget("ui.resizable", e.ui.mouse, {
        version: "1.11.4",
        widgetEventPrefix: "resize",
        options: {
            alsoResize: !1,
            animate: !1,
            animateDuration: "slow",
            animateEasing: "swing",
            aspectRatio: !1,
            autoHide: !1,
            containment: !1,
            ghost: !1,
            grid: !1,
            handles: "e,s,se",
            helper: !1,
            maxHeight: null,
            maxWidth: null,
            minHeight: 10,
            minWidth: 10,
            zIndex: 90,
            resize: null,
            start: null,
            stop: null
        },
        _num: function (e) {
            return parseInt(e, 10) || 0
        },
        _isNumber: function (e) {
            return !isNaN(parseInt(e, 10))
        },
        _hasScroll: function (t, n) {
            if ("hidden" === e(t).css("overflow"))return !1;
            var r = n && "left" === n ? "scrollLeft" : "scrollTop", i = !1;
            return t[r] > 0 ? !0 : (t[r] = 1, i = t[r] > 0, t[r] = 0, i)
        },
        _create: function () {
            var t, n, r, i, s, o = this, u = this.options;
            if (this.element.addClass("ui-resizable"), e.extend(this, {
                    _aspectRatio: !!u.aspectRatio,
                    aspectRatio: u.aspectRatio,
                    originalElement: this.element,
                    _proportionallyResizeElements: [],
                    _helper: u.helper || u.ghost || u.animate ? u.helper || "ui-resizable-helper" : null
                }), this.element[0].nodeName.match(/^(canvas|textarea|input|select|button|img)$/i) && (this.element.wrap(e("<div class='ui-wrapper' style='overflow: hidden;'></div>").css({
                    position: this.element.css("position"),
                    width: this.element.outerWidth(),
                    height: this.element.outerHeight(),
                    top: this.element.css("top"),
                    left: this.element.css("left")
                })), this.element = this.element.parent().data("ui-resizable", this.element.resizable("instance")), this.elementIsWrapper = !0, this.element.css({
                    marginLeft: this.originalElement.css("marginLeft"),
                    marginTop: this.originalElement.css("marginTop"),
                    marginRight: this.originalElement.css("marginRight"),
                    marginBottom: this.originalElement.css("marginBottom")
                }), this.originalElement.css({
                    marginLeft: 0,
                    marginTop: 0,
                    marginRight: 0,
                    marginBottom: 0
                }), this.originalResizeStyle = this.originalElement.css("resize"), this.originalElement.css("resize", "none"), this._proportionallyResizeElements.push(this.originalElement.css({
                    position: "static",
                    zoom: 1,
                    display: "block"
                })), this.originalElement.css({margin: this.originalElement.css("margin")}), this._proportionallyResize()), this.handles = u.handles || (e(".ui-resizable-handle", this.element).length ? {
                        n: ".ui-resizable-n",
                        e: ".ui-resizable-e",
                        s: ".ui-resizable-s",
                        w: ".ui-resizable-w",
                        se: ".ui-resizable-se",
                        sw: ".ui-resizable-sw",
                        ne: ".ui-resizable-ne",
                        nw: ".ui-resizable-nw"
                    } : "e,s,se"), this._handles = e(), this.handles.constructor === String)for ("all" === this.handles && (this.handles = "n,e,s,w,se,sw,ne,nw"), t = this.handles.split(","), this.handles = {}, n = 0; t.length > n; n++)r = e.trim(t[n]), s = "ui-resizable-" + r, i = e("<div class='ui-resizable-handle " + s + "'></div>"), i.css({zIndex: u.zIndex}), "se" === r && i.addClass("ui-icon ui-icon-gripsmall-diagonal-se"), this.handles[r] = ".ui-resizable-" + r, this.element.append(i);
            this._renderAxis = function (t) {
                var n, r, i, s;
                t = t || this.element;
                for (n in this.handles)this.handles[n].constructor === String ? this.handles[n] = this.element.children(this.handles[n]).first().show() : (this.handles[n].jquery || this.handles[n].nodeType) && (this.handles[n] = e(this.handles[n]), this._on(this.handles[n], {mousedown: o._mouseDown})), this.elementIsWrapper && this.originalElement[0].nodeName.match(/^(textarea|input|select|button)$/i) && (r = e(this.handles[n], this.element), s = /sw|ne|nw|se|n|s/.test(n) ? r.outerHeight() : r.outerWidth(), i = ["padding", /ne|nw|n/.test(n) ? "Top" : /se|sw|s/.test(n) ? "Bottom" : /^e$/.test(n) ? "Right" : "Left"].join(""), t.css(i, s), this._proportionallyResize()), this._handles = this._handles.add(this.handles[n])
            }, this._renderAxis(this.element), this._handles = this._handles.add(this.element.find(".ui-resizable-handle")), this._handles.disableSelection(), this._handles.mouseover(function () {
                o.resizing || (this.className && (i = this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i)), o.axis = i && i[1] ? i[1] : "se")
            }), u.autoHide && (this._handles.hide(), e(this.element).addClass("ui-resizable-autohide").mouseenter(function () {
                u.disabled || (e(this).removeClass("ui-resizable-autohide"), o._handles.show())
            }).mouseleave(function () {
                u.disabled || o.resizing || (e(this).addClass("ui-resizable-autohide"), o._handles.hide())
            })), this._mouseInit()
        },
        _destroy: function () {
            this._mouseDestroy();
            var t, n = function (t) {
                e(t).removeClass("ui-resizable ui-resizable-disabled ui-resizable-resizing").removeData("resizable").removeData("ui-resizable").unbind(".resizable").find(".ui-resizable-handle").remove()
            };
            return this.elementIsWrapper && (n(this.element), t = this.element, this.originalElement.css({
                position: t.css("position"),
                width: t.outerWidth(),
                height: t.outerHeight(),
                top: t.css("top"),
                left: t.css("left")
            }).insertAfter(t), t.remove()), this.originalElement.css("resize", this.originalResizeStyle), n(this.originalElement), this
        },
        _mouseCapture: function (t) {
            var n, r, i = !1;
            for (n in this.handles)r = e(this.handles[n])[0], (r === t.target || e.contains(r, t.target)) && (i = !0);
            return !this.options.disabled && i
        },
        _mouseStart: function (t) {
            var n, r, i, s = this.options, o = this.element;
            return this.resizing = !0, this._renderProxy(), n = this._num(this.helper.css("left")), r = this._num(this.helper.css("top")), s.containment && (n += e(s.containment).scrollLeft() || 0, r += e(s.containment).scrollTop() || 0), this.offset = this.helper.offset(), this.position = {
                left: n,
                top: r
            }, this.size = this._helper ? {
                width: this.helper.width(),
                height: this.helper.height()
            } : {width: o.width(), height: o.height()}, this.originalSize = this._helper ? {
                width: o.outerWidth(),
                height: o.outerHeight()
            } : {width: o.width(), height: o.height()}, this.sizeDiff = {
                width: o.outerWidth() - o.width(),
                height: o.outerHeight() - o.height()
            }, this.originalPosition = {left: n, top: r}, this.originalMousePosition = {
                left: t.pageX,
                top: t.pageY
            }, this.aspectRatio = "number" == typeof s.aspectRatio ? s.aspectRatio : this.originalSize.width / this.originalSize.height || 1, i = e(".ui-resizable-" + this.axis).css("cursor"), e("body").css("cursor", "auto" === i ? this.axis + "-resize" : i), o.addClass("ui-resizable-resizing"), this._propagate("start", t), !0
        },
        _mouseDrag: function (t) {
            var n, r, i = this.originalMousePosition, s = this.axis, o = t.pageX - i.left || 0, u = t.pageY - i.top || 0, a = this._change[s];
            return this._updatePrevProperties(), a ? (n = a.apply(this, [t, o, u]), this._updateVirtualBoundaries(t.shiftKey), (this._aspectRatio || t.shiftKey) && (n = this._updateRatio(n, t)), n = this._respectSize(n, t), this._updateCache(n), this._propagate("resize", t), r = this._applyChanges(), !this._helper && this._proportionallyResizeElements.length && this._proportionallyResize(), e.isEmptyObject(r) || (this._updatePrevProperties(), this._trigger("resize", t, this.ui()), this._applyChanges()), !1) : !1
        },
        _mouseStop: function (t) {
            this.resizing = !1;
            var n, r, i, s, o, u, a, f = this.options, l = this;
            return this._helper && (n = this._proportionallyResizeElements, r = n.length && /textarea/i.test(n[0].nodeName), i = r && this._hasScroll(n[0], "left") ? 0 : l.sizeDiff.height, s = r ? 0 : l.sizeDiff.width, o = {
                width: l.helper.width() - s,
                height: l.helper.height() - i
            }, u = parseInt(l.element.css("left"), 10) + (l.position.left - l.originalPosition.left) || null, a = parseInt(l.element.css("top"), 10) + (l.position.top - l.originalPosition.top) || null, f.animate || this.element.css(e.extend(o, {
                top: a,
                left: u
            })), l.helper.height(l.size.height), l.helper.width(l.size.width), this._helper && !f.animate && this._proportionallyResize()), e("body").css("cursor", "auto"), this.element.removeClass("ui-resizable-resizing"), this._propagate("stop", t), this._helper && this.helper.remove(), !1
        },
        _updatePrevProperties: function () {
            this.prevPosition = {
                top: this.position.top,
                left: this.position.left
            }, this.prevSize = {width: this.size.width, height: this.size.height}
        },
        _applyChanges: function () {
            var e = {};
            return this.position.top !== this.prevPosition.top && (e.top = this.position.top + "px"), this.position.left !== this.prevPosition.left && (e.left = this.position.left + "px"), this.size.width !== this.prevSize.width && (e.width = this.size.width + "px"), this.size.height !== this.prevSize.height && (e.height = this.size.height + "px"), this.helper.css(e), e
        },
        _updateVirtualBoundaries: function (e) {
            var t, n, r, i, s, o = this.options;
            s = {
                minWidth: this._isNumber(o.minWidth) ? o.minWidth : 0,
                maxWidth: this._isNumber(o.maxWidth) ? o.maxWidth : 1 / 0,
                minHeight: this._isNumber(o.minHeight) ? o.minHeight : 0,
                maxHeight: this._isNumber(o.maxHeight) ? o.maxHeight : 1 / 0
            }, (this._aspectRatio || e) && (t = s.minHeight * this.aspectRatio, r = s.minWidth / this.aspectRatio, n = s.maxHeight * this.aspectRatio, i = s.maxWidth / this.aspectRatio, t > s.minWidth && (s.minWidth = t), r > s.minHeight && (s.minHeight = r), s.maxWidth > n && (s.maxWidth = n), s.maxHeight > i && (s.maxHeight = i)), this._vBoundaries = s
        },
        _updateCache: function (e) {
            this.offset = this.helper.offset(), this._isNumber(e.left) && (this.position.left = e.left), this._isNumber(e.top) && (this.position.top = e.top), this._isNumber(e.height) && (this.size.height = e.height), this._isNumber(e.width) && (this.size.width = e.width)
        },
        _updateRatio: function (e) {
            var t = this.position, n = this.size, r = this.axis;
            return this._isNumber(e.height) ? e.width = e.height * this.aspectRatio : this._isNumber(e.width) && (e.height = e.width / this.aspectRatio), "sw" === r && (e.left = t.left + (n.width - e.width), e.top = null), "nw" === r && (e.top = t.top + (n.height - e.height), e.left = t.left + (n.width - e.width)), e
        },
        _respectSize: function (e) {
            var t = this._vBoundaries, n = this.axis, r = this._isNumber(e.width) && t.maxWidth && t.maxWidth < e.width, i = this._isNumber(e.height) && t.maxHeight && t.maxHeight < e.height, s = this._isNumber(e.width) && t.minWidth && t.minWidth > e.width, o = this._isNumber(e.height) && t.minHeight && t.minHeight > e.height, u = this.originalPosition.left + this.originalSize.width, a = this.position.top + this.size.height, f = /sw|nw|w/.test(n), l = /nw|ne|n/.test(n);
            return s && (e.width = t.minWidth), o && (e.height = t.minHeight), r && (e.width = t.maxWidth), i && (e.height = t.maxHeight), s && f && (e.left = u - t.minWidth), r && f && (e.left = u - t.maxWidth), o && l && (e.top = a - t.minHeight), i && l && (e.top = a - t.maxHeight), e.width || e.height || e.left || !e.top ? e.width || e.height || e.top || !e.left || (e.left = null) : e.top = null, e
        },
        _getPaddingPlusBorderDimensions: function (e) {
            for (var t = 0, n = [], r = [e.css("borderTopWidth"), e.css("borderRightWidth"), e.css("borderBottomWidth"), e.css("borderLeftWidth")], i = [e.css("paddingTop"), e.css("paddingRight"), e.css("paddingBottom"), e.css("paddingLeft")]; 4 > t; t++)n[t] = parseInt(r[t], 10) || 0, n[t] += parseInt(i[t], 10) || 0;
            return {height: n[0] + n[2], width: n[1] + n[3]}
        },
        _proportionallyResize: function () {
            if (this._proportionallyResizeElements.length)for (var e, t = 0, n = this.helper || this.element; this._proportionallyResizeElements.length > t; t++)e = this._proportionallyResizeElements[t], this.outerDimensions || (this.outerDimensions = this._getPaddingPlusBorderDimensions(e)), e.css({
                height: n.height() - this.outerDimensions.height || 0,
                width: n.width() - this.outerDimensions.width || 0
            })
        },
        _renderProxy: function () {
            var t = this.element, n = this.options;
            this.elementOffset = t.offset(), this._helper ? (this.helper = this.helper || e("<div style='overflow:hidden;'></div>"), this.helper.addClass(this._helper).css({
                width: this.element.outerWidth() - 1,
                height: this.element.outerHeight() - 1,
                position: "absolute",
                left: this.elementOffset.left + "px",
                top: this.elementOffset.top + "px",
                zIndex: ++n.zIndex
            }), this.helper.appendTo("body").disableSelection()) : this.helper = this.element
        },
        _change: {
            e: function (e, t) {
                return {width: this.originalSize.width + t}
            }, w: function (e, t) {
                var n = this.originalSize, r = this.originalPosition;
                return {left: r.left + t, width: n.width - t}
            }, n: function (e, t, n) {
                var r = this.originalSize, i = this.originalPosition;
                return {top: i.top + n, height: r.height - n}
            }, s: function (e, t, n) {
                return {height: this.originalSize.height + n}
            }, se: function (t, n, r) {
                return e.extend(this._change.s.apply(this, arguments), this._change.e.apply(this, [t, n, r]))
            }, sw: function (t, n, r) {
                return e.extend(this._change.s.apply(this, arguments), this._change.w.apply(this, [t, n, r]))
            }, ne: function (t, n, r) {
                return e.extend(this._change.n.apply(this, arguments), this._change.e.apply(this, [t, n, r]))
            }, nw: function (t, n, r) {
                return e.extend(this._change.n.apply(this, arguments), this._change.w.apply(this, [t, n, r]))
            }
        },
        _propagate: function (t, n) {
            e.ui.plugin.call(this, t, [n, this.ui()]), "resize" !== t && this._trigger(t, n, this.ui())
        },
        plugins: {},
        ui: function () {
            return {
                originalElement: this.originalElement,
                element: this.element,
                helper: this.helper,
                position: this.position,
                size: this.size,
                originalSize: this.originalSize,
                originalPosition: this.originalPosition
            }
        }
    }), e.ui.plugin.add("resizable", "animate", {
        stop: function (t) {
            var n = e(this).resizable("instance"), r = n.options, i = n._proportionallyResizeElements, s = i.length && /textarea/i.test(i[0].nodeName), o = s && n._hasScroll(i[0], "left") ? 0 : n.sizeDiff.height, u = s ? 0 : n.sizeDiff.width, a = {
                width: n.size.width - u,
                height: n.size.height - o
            }, f = parseInt(n.element.css("left"), 10) + (n.position.left - n.originalPosition.left) || null, l = parseInt(n.element.css("top"), 10) + (n.position.top - n.originalPosition.top) || null;
            n.element.animate(e.extend(a, l && f ? {top: l, left: f} : {}), {
                duration: r.animateDuration,
                easing: r.animateEasing,
                step: function () {
                    var r = {
                        width: parseInt(n.element.css("width"), 10),
                        height: parseInt(n.element.css("height"), 10),
                        top: parseInt(n.element.css("top"), 10),
                        left: parseInt(n.element.css("left"), 10)
                    };
                    i && i.length && e(i[0]).css({
                        width: r.width,
                        height: r.height
                    }), n._updateCache(r), n._propagate("resize", t)
                }
            })
        }
    }), e.ui.plugin.add("resizable", "containment", {
        start: function () {
            var t, n, r, i, s, o, u, a = e(this).resizable("instance"), f = a.options, l = a.element, c = f.containment, h = c instanceof e ? c.get(0) : /parent/.test(c) ? l.parent().get(0) : c;
            h && (a.containerElement = e(h), /document/.test(c) || c === document ? (a.containerOffset = {
                left: 0,
                top: 0
            }, a.containerPosition = {left: 0, top: 0}, a.parentData = {
                element: e(document),
                left: 0,
                top: 0,
                width: e(document).width(),
                height: e(document).height() || document.body.parentNode.scrollHeight
            }) : (t = e(h), n = [], e(["Top", "Right", "Left", "Bottom"]).each(function (e, r) {
                n[e] = a._num(t.css("padding" + r))
            }), a.containerOffset = t.offset(), a.containerPosition = t.position(), a.containerSize = {
                height: t.innerHeight() - n[3],
                width: t.innerWidth() - n[1]
            }, r = a.containerOffset, i = a.containerSize.height, s = a.containerSize.width, o = a._hasScroll(h, "left") ? h.scrollWidth : s, u = a._hasScroll(h) ? h.scrollHeight : i, a.parentData = {
                element: h,
                left: r.left,
                top: r.top,
                width: o,
                height: u
            }))
        }, resize: function (t) {
            var n, r, i, s, o = e(this).resizable("instance"), u = o.options, a = o.containerOffset, f = o.position, l = o._aspectRatio || t.shiftKey, c = {
                top: 0,
                left: 0
            }, h = o.containerElement, p = !0;
            h[0] !== document && /static/.test(h.css("position")) && (c = a), f.left < (o._helper ? a.left : 0) && (o.size.width = o.size.width + (o._helper ? o.position.left - a.left : o.position.left - c.left), l && (o.size.height = o.size.width / o.aspectRatio, p = !1), o.position.left = u.helper ? a.left : 0), f.top < (o._helper ? a.top : 0) && (o.size.height = o.size.height + (o._helper ? o.position.top - a.top : o.position.top), l && (o.size.width = o.size.height * o.aspectRatio, p = !1), o.position.top = o._helper ? a.top : 0), i = o.containerElement.get(0) === o.element.parent().get(0), s = /relative|absolute/.test(o.containerElement.css("position")), i && s ? (o.offset.left = o.parentData.left + o.position.left, o.offset.top = o.parentData.top + o.position.top) : (o.offset.left = o.element.offset().left, o.offset.top = o.element.offset().top), n = Math.abs(o.sizeDiff.width + (o._helper ? o.offset.left - c.left : o.offset.left - a.left)), r = Math.abs(o.sizeDiff.height + (o._helper ? o.offset.top - c.top : o.offset.top - a.top)), n + o.size.width >= o.parentData.width && (o.size.width = o.parentData.width - n, l && (o.size.height = o.size.width / o.aspectRatio, p = !1)), r + o.size.height >= o.parentData.height && (o.size.height = o.parentData.height - r, l && (o.size.width = o.size.height * o.aspectRatio, p = !1)), p || (o.position.left = o.prevPosition.left, o.position.top = o.prevPosition.top, o.size.width = o.prevSize.width, o.size.height = o.prevSize.height)
        }, stop: function () {
            var t = e(this).resizable("instance"), n = t.options, r = t.containerOffset, i = t.containerPosition, s = t.containerElement, o = e(t.helper), u = o.offset(), a = o.outerWidth() - t.sizeDiff.width, f = o.outerHeight() - t.sizeDiff.height;
            t._helper && !n.animate && /relative/.test(s.css("position")) && e(this).css({
                left: u.left - i.left - r.left,
                width: a,
                height: f
            }), t._helper && !n.animate && /static/.test(s.css("position")) && e(this).css({
                left: u.left - i.left - r.left,
                width: a,
                height: f
            })
        }
    }), e.ui.plugin.add("resizable", "alsoResize", {
        start: function () {
            var t = e(this).resizable("instance"), n = t.options;
            e(n.alsoResize).each(function () {
                var t = e(this);
                t.data("ui-resizable-alsoresize", {
                    width: parseInt(t.width(), 10),
                    height: parseInt(t.height(), 10),
                    left: parseInt(t.css("left"), 10),
                    top: parseInt(t.css("top"), 10)
                })
            })
        }, resize: function (t, n) {
            var r = e(this).resizable("instance"), i = r.options, s = r.originalSize, o = r.originalPosition, u = {
                height: r.size.height - s.height || 0,
                width: r.size.width - s.width || 0,
                top: r.position.top - o.top || 0,
                left: r.position.left - o.left || 0
            };
            e(i.alsoResize).each(function () {
                var t = e(this), r = e(this).data("ui-resizable-alsoresize"), i = {}, s = t.parents(n.originalElement[0]).length ? ["width", "height"] : ["width", "height", "top", "left"];
                e.each(s, function (e, t) {
                    var n = (r[t] || 0) + (u[t] || 0);
                    n && n >= 0 && (i[t] = n || null)
                }), t.css(i)
            })
        }, stop: function () {
            e(this).removeData("resizable-alsoresize")
        }
    }), e.ui.plugin.add("resizable", "ghost", {
        start: function () {
            var t = e(this).resizable("instance"), n = t.options, r = t.size;
            t.ghost = t.originalElement.clone(), t.ghost.css({
                opacity: .25,
                display: "block",
                position: "relative",
                height: r.height,
                width: r.width,
                margin: 0,
                left: 0,
                top: 0
            }).addClass("ui-resizable-ghost").addClass("string" == typeof n.ghost ? n.ghost : ""), t.ghost.appendTo(t.helper)
        }, resize: function () {
            var t = e(this).resizable("instance");
            t.ghost && t.ghost.css({position: "relative", height: t.size.height, width: t.size.width})
        }, stop: function () {
            var t = e(this).resizable("instance");
            t.ghost && t.helper && t.helper.get(0).removeChild(t.ghost.get(0))
        }
    }), e.ui.plugin.add("resizable", "grid", {
        resize: function () {
            var t, n = e(this).resizable("instance"), r = n.options, i = n.size, s = n.originalSize, o = n.originalPosition, u = n.axis, a = "number" == typeof r.grid ? [r.grid, r.grid] : r.grid, f = a[0] || 1, l = a[1] || 1, c = Math.round((i.width - s.width) / f) * f, h = Math.round((i.height - s.height) / l) * l, p = s.width + c, d = s.height + h, v = r.maxWidth && p > r.maxWidth, m = r.maxHeight && d > r.maxHeight, g = r.minWidth && r.minWidth > p, y = r.minHeight && r.minHeight > d;
            r.grid = a, g && (p += f), y && (d += l), v && (p -= f), m && (d -= l), /^(se|s|e)$/.test(u) ? (n.size.width = p, n.size.height = d) : /^(ne)$/.test(u) ? (n.size.width = p, n.size.height = d, n.position.top = o.top - h) : /^(sw)$/.test(u) ? (n.size.width = p, n.size.height = d, n.position.left = o.left - c) : ((0 >= d - l || 0 >= p - f) && (t = n._getPaddingPlusBorderDimensions(this)), d - l > 0 ? (n.size.height = d, n.position.top = o.top - h) : (d = l - t.height, n.size.height = d, n.position.top = o.top + s.height - d), p - f > 0 ? (n.size.width = p, n.position.left = o.left - c) : (p = f - t.width, n.size.width = p, n.position.left = o.left + s.width - p))
        }
    }), e.ui.resizable, e.widget("ui.selectable", e.ui.mouse, {
        version: "1.11.4",
        options: {
            appendTo: "body",
            autoRefresh: !0,
            distance: 0,
            filter: "*",
            tolerance: "touch",
            selected: null,
            selecting: null,
            start: null,
            stop: null,
            unselected: null,
            unselecting: null
        },
        _create: function () {
            var t, n = this;
            this.element.addClass("ui-selectable"), this.dragged = !1, this.refresh = function () {
                t = e(n.options.filter, n.element[0]), t.addClass("ui-selectee"), t.each(function () {
                    var t = e(this), n = t.offset();
                    e.data(this, "selectable-item", {
                        element: this,
                        $element: t,
                        left: n.left,
                        top: n.top,
                        right: n.left + t.outerWidth(),
                        bottom: n.top + t.outerHeight(),
                        startselected: !1,
                        selected: t.hasClass("ui-selected"),
                        selecting: t.hasClass("ui-selecting"),
                        unselecting: t.hasClass("ui-unselecting")
                    })
                })
            }, this.refresh(), this.selectees = t.addClass("ui-selectee"), this._mouseInit(), this.helper = e("<div class='ui-selectable-helper'></div>")
        },
        _destroy: function () {
            this.selectees.removeClass("ui-selectee").removeData("selectable-item"), this.element.removeClass("ui-selectable ui-selectable-disabled"), this._mouseDestroy()
        },
        _mouseStart: function (t) {
            var n = this, r = this.options;
            this.opos = [t.pageX, t.pageY], this.options.disabled || (this.selectees = e(r.filter, this.element[0]), this._trigger("start", t), e(r.appendTo).append(this.helper), this.helper.css({
                left: t.pageX,
                top: t.pageY,
                width: 0,
                height: 0
            }), r.autoRefresh && this.refresh(), this.selectees.filter(".ui-selected").each(function () {
                var r = e.data(this, "selectable-item");
                r.startselected = !0, t.metaKey || t.ctrlKey || (r.$element.removeClass("ui-selected"), r.selected = !1, r.$element.addClass("ui-unselecting"), r.unselecting = !0, n._trigger("unselecting", t, {unselecting: r.element}))
            }), e(t.target).parents().addBack().each(function () {
                var r, i = e.data(this, "selectable-item");
                return i ? (r = !t.metaKey && !t.ctrlKey || !i.$element.hasClass("ui-selected"), i.$element.removeClass(r ? "ui-unselecting" : "ui-selected").addClass(r ? "ui-selecting" : "ui-unselecting"), i.unselecting = !r, i.selecting = r, i.selected = r, r ? n._trigger("selecting", t, {selecting: i.element}) : n._trigger("unselecting", t, {unselecting: i.element}), !1) : void 0
            }))
        },
        _mouseDrag: function (t) {
            if (this.dragged = !0, !this.options.disabled) {
                var n, r = this, i = this.options, s = this.opos[0], o = this.opos[1], u = t.pageX, a = t.pageY;
                return s > u && (n = u, u = s, s = n), o > a && (n = a, a = o, o = n), this.helper.css({
                    left: s,
                    top: o,
                    width: u - s,
                    height: a - o
                }), this.selectees.each(function () {
                    var n = e.data(this, "selectable-item"), f = !1;
                    n && n.element !== r.element[0] && ("touch" === i.tolerance ? f = !(n.left > u || s > n.right || n.top > a || o > n.bottom) : "fit" === i.tolerance && (f = n.left > s && u > n.right && n.top > o && a > n.bottom), f ? (n.selected && (n.$element.removeClass("ui-selected"), n.selected = !1), n.unselecting && (n.$element.removeClass("ui-unselecting"), n.unselecting = !1), n.selecting || (n.$element.addClass("ui-selecting"), n.selecting = !0, r._trigger("selecting", t, {selecting: n.element}))) : (n.selecting && ((t.metaKey || t.ctrlKey) && n.startselected ? (n.$element.removeClass("ui-selecting"), n.selecting = !1, n.$element.addClass("ui-selected"), n.selected = !0) : (n.$element.removeClass("ui-selecting"), n.selecting = !1, n.startselected && (n.$element.addClass("ui-unselecting"), n.unselecting = !0), r._trigger("unselecting", t, {unselecting: n.element}))), n.selected && (t.metaKey || t.ctrlKey || n.startselected || (n.$element.removeClass("ui-selected"), n.selected = !1, n.$element.addClass("ui-unselecting"), n.unselecting = !0, r._trigger("unselecting", t, {unselecting: n.element})))))
                }), !1
            }
        },
        _mouseStop: function (t) {
            var n = this;
            return this.dragged = !1, e(".ui-unselecting", this.element[0]).each(function () {
                var r = e.data(this, "selectable-item");
                r.$element.removeClass("ui-unselecting"), r.unselecting = !1, r.startselected = !1, n._trigger("unselected", t, {unselected: r.element})
            }), e(".ui-selecting", this.element[0]).each(function () {
                var r = e.data(this, "selectable-item");
                r.$element.removeClass("ui-selecting").addClass("ui-selected"), r.selecting = !1, r.selected = !0, r.startselected = !0, n._trigger("selected", t, {selected: r.element})
            }), this._trigger("stop", t), this.helper.remove(), !1
        }
    }), e.widget("ui.sortable", e.ui.mouse, {
        version: "1.11.4",
        widgetEventPrefix: "sort",
        ready: !1,
        options: {
            appendTo: "parent",
            axis: !1,
            connectWith: !1,
            containment: !1,
            cursor: "auto",
            cursorAt: !1,
            dropOnEmpty: !0,
            forcePlaceholderSize: !1,
            forceHelperSize: !1,
            grid: !1,
            handle: !1,
            helper: "original",
            items: "> *",
            opacity: !1,
            placeholder: !1,
            revert: !1,
            scroll: !0,
            scrollSensitivity: 20,
            scrollSpeed: 20,
            scope: "default",
            tolerance: "intersect",
            zIndex: 1e3,
            activate: null,
            beforeStop: null,
            change: null,
            deactivate: null,
            out: null,
            over: null,
            receive: null,
            remove: null,
            sort: null,
            start: null,
            stop: null,
            update: null
        },
        _isOverAxis: function (e, t, n) {
            return e >= t && t + n > e
        },
        _isFloating: function (e) {
            return /left|right/.test(e.css("float")) || /inline|table-cell/.test(e.css("display"))
        },
        _create: function () {
            this.containerCache = {}, this.element.addClass("ui-sortable"), this.refresh(), this.offset = this.element.offset(), this._mouseInit(), this._setHandleClassName(), this.ready = !0
        },
        _setOption: function (e, t) {
            this._super(e, t), "handle" === e && this._setHandleClassName()
        },
        _setHandleClassName: function () {
            this.element.find(".ui-sortable-handle").removeClass("ui-sortable-handle"), e.each(this.items, function () {
                (this.instance.options.handle ? this.item.find(this.instance.options.handle) : this.item).addClass("ui-sortable-handle")
            })
        },
        _destroy: function () {
            this.element.removeClass("ui-sortable ui-sortable-disabled").find(".ui-sortable-handle").removeClass("ui-sortable-handle"), this._mouseDestroy();
            for (var e = this.items.length - 1; e >= 0; e--)this.items[e].item.removeData(this.widgetName + "-item");
            return this
        },
        _mouseCapture: function (t, n) {
            var r = null, i = !1, s = this;
            return this.reverting ? !1 : this.options.disabled || "static" === this.options.type ? !1 : (this._refreshItems(t), e(t.target).parents().each(function () {
                return e.data(this, s.widgetName + "-item") === s ? (r = e(this), !1) : void 0
            }), e.data(t.target, s.widgetName + "-item") === s && (r = e(t.target)), r ? !this.options.handle || n || (e(this.options.handle, r).find("*").addBack().each(function () {
                this === t.target && (i = !0)
            }), i) ? (this.currentItem = r, this._removeCurrentsFromItems(), !0) : !1 : !1)
        },
        _mouseStart: function (t, n, r) {
            var i, s, o = this.options;
            if (this.currentContainer = this, this.refreshPositions(), this.helper = this._createHelper(t), this._cacheHelperProportions(), this._cacheMargins(), this.scrollParent = this.helper.scrollParent(), this.offset = this.currentItem.offset(), this.offset = {
                    top: this.offset.top - this.margins.top,
                    left: this.offset.left - this.margins.left
                }, e.extend(this.offset, {
                    click: {left: t.pageX - this.offset.left, top: t.pageY - this.offset.top},
                    parent: this._getParentOffset(),
                    relative: this._getRelativeOffset()
                }), this.helper.css("position", "absolute"), this.cssPosition = this.helper.css("position"), this.originalPosition = this._generatePosition(t), this.originalPageX = t.pageX, this.originalPageY = t.pageY, o.cursorAt && this._adjustOffsetFromHelper(o.cursorAt), this.domPosition = {
                    prev: this.currentItem.prev()[0],
                    parent: this.currentItem.parent()[0]
                }, this.helper[0] !== this.currentItem[0] && this.currentItem.hide(), this._createPlaceholder(), o.containment && this._setContainment(), o.cursor && "auto" !== o.cursor && (s = this.document.find("body"), this.storedCursor = s.css("cursor"), s.css("cursor", o.cursor), this.storedStylesheet = e("<style>*{ cursor: " + o.cursor + " !important; }</style>").appendTo(s)), o.opacity && (this.helper.css("opacity") && (this._storedOpacity = this.helper.css("opacity")), this.helper.css("opacity", o.opacity)), o.zIndex && (this.helper.css("zIndex") && (this._storedZIndex = this.helper.css("zIndex")), this.helper.css("zIndex", o.zIndex)), this.scrollParent[0] !== this.document[0] && "HTML" !== this.scrollParent[0].tagName && (this.overflowOffset = this.scrollParent.offset()), this._trigger("start", t, this._uiHash()), this._preserveHelperProportions || this._cacheHelperProportions(), !r)for (i = this.containers.length - 1; i >= 0; i--)this.containers[i]._trigger("activate", t, this._uiHash(this));
            return e.ui.ddmanager && (e.ui.ddmanager.current = this), e.ui.ddmanager && !o.dropBehaviour && e.ui.ddmanager.prepareOffsets(this, t), this.dragging = !0, this.helper.addClass("ui-sortable-helper"), this._mouseDrag(t), !0
        },
        _mouseDrag: function (t) {
            var n, r, i, s, o = this.options, u = !1;
            for (this.position = this._generatePosition(t), this.positionAbs = this._convertPositionTo("absolute"), this.lastPositionAbs || (this.lastPositionAbs = this.positionAbs), this.options.scroll && (this.scrollParent[0] !== this.document[0] && "HTML" !== this.scrollParent[0].tagName ? (this.overflowOffset.top + this.scrollParent[0].offsetHeight - t.pageY < o.scrollSensitivity ? this.scrollParent[0].scrollTop = u = this.scrollParent[0].scrollTop + o.scrollSpeed : t.pageY - this.overflowOffset.top < o.scrollSensitivity && (this.scrollParent[0].scrollTop = u = this.scrollParent[0].scrollTop - o.scrollSpeed), this.overflowOffset.left + this.scrollParent[0].offsetWidth - t.pageX < o.scrollSensitivity ? this.scrollParent[0].scrollLeft = u = this.scrollParent[0].scrollLeft + o.scrollSpeed : t.pageX - this.overflowOffset.left < o.scrollSensitivity && (this.scrollParent[0].scrollLeft = u = this.scrollParent[0].scrollLeft - o.scrollSpeed)) : (t.pageY - this.document.scrollTop() < o.scrollSensitivity ? u = this.document.scrollTop(this.document.scrollTop() - o.scrollSpeed) : this.window.height() - (t.pageY - this.document.scrollTop()) < o.scrollSensitivity && (u = this.document.scrollTop(this.document.scrollTop() + o.scrollSpeed)), t.pageX - this.document.scrollLeft() < o.scrollSensitivity ? u = this.document.scrollLeft(this.document.scrollLeft() - o.scrollSpeed) : this.window.width() - (t.pageX - this.document.scrollLeft()) < o.scrollSensitivity && (u = this.document.scrollLeft(this.document.scrollLeft() + o.scrollSpeed))), u !== !1 && e.ui.ddmanager && !o.dropBehaviour && e.ui.ddmanager.prepareOffsets(this, t)), this.positionAbs = this._convertPositionTo("absolute"), this.options.axis && "y" === this.options.axis || (this.helper[0].style.left = this.position.left + "px"), this.options.axis && "x" === this.options.axis || (this.helper[0].style.top = this.position.top + "px"), n = this.items.length - 1; n >= 0; n--)if (r = this.items[n], i = r.item[0], s = this._intersectsWithPointer(r), s && r.instance === this.currentContainer && i !== this.currentItem[0] && this.placeholder[1 === s ? "next" : "prev"]()[0] !== i && !e.contains(this.placeholder[0], i) && ("semi-dynamic" === this.options.type ? !e.contains(this.element[0], i) : !0)) {
                if (this.direction = 1 === s ? "down" : "up", "pointer" !== this.options.tolerance && !this._intersectsWithSides(r))break;
                this._rearrange(t, r), this._trigger("change", t, this._uiHash());
                break
            }
            return this._contactContainers(t), e.ui.ddmanager && e.ui.ddmanager.drag(this, t), this._trigger("sort", t, this._uiHash()), this.lastPositionAbs = this.positionAbs, !1
        },
        _mouseStop: function (t, n) {
            if (t) {
                if (e.ui.ddmanager && !this.options.dropBehaviour && e.ui.ddmanager.drop(this, t), this.options.revert) {
                    var r = this, i = this.placeholder.offset(), s = this.options.axis, o = {};
                    s && "x" !== s || (o.left = i.left - this.offset.parent.left - this.margins.left + (this.offsetParent[0] === this.document[0].body ? 0 : this.offsetParent[0].scrollLeft)), s && "y" !== s || (o.top = i.top - this.offset.parent.top - this.margins.top + (this.offsetParent[0] === this.document[0].body ? 0 : this.offsetParent[0].scrollTop)), this.reverting = !0, e(this.helper).animate(o, parseInt(this.options.revert, 10) || 500, function () {
                        r._clear(t)
                    })
                } else this._clear(t, n);
                return !1
            }
        },
        cancel: function () {
            if (this.dragging) {
                this._mouseUp({target: null}), "original" === this.options.helper ? this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper") : this.currentItem.show();
                for (var t = this.containers.length - 1; t >= 0; t--)this.containers[t]._trigger("deactivate", null, this._uiHash(this)), this.containers[t].containerCache.over && (this.containers[t]._trigger("out", null, this._uiHash(this)), this.containers[t].containerCache.over = 0)
            }
            return this.placeholder && (this.placeholder[0].parentNode && this.placeholder[0].parentNode.removeChild(this.placeholder[0]), "original" !== this.options.helper && this.helper && this.helper[0].parentNode && this.helper.remove(), e.extend(this, {
                helper: null,
                dragging: !1,
                reverting: !1,
                _noFinalSort: null
            }), this.domPosition.prev ? e(this.domPosition.prev).after(this.currentItem) : e(this.domPosition.parent).prepend(this.currentItem)), this
        },
        serialize: function (t) {
            var n = this._getItemsAsjQuery(t && t.connected), r = [];
            return t = t || {}, e(n).each(function () {
                var n = (e(t.item || this).attr(t.attribute || "id") || "").match(t.expression || /(.+)[\-=_](.+)/);
                n && r.push((t.key || n[1] + "[]") + "=" + (t.key && t.expression ? n[1] : n[2]))
            }), !r.length && t.key && r.push(t.key + "="), r.join("&")
        },
        toArray: function (t) {
            var n = this._getItemsAsjQuery(t && t.connected), r = [];
            return t = t || {}, n.each(function () {
                r.push(e(t.item || this).attr(t.attribute || "id") || "")
            }), r
        },
        _intersectsWith: function (e) {
            var t = this.positionAbs.left, n = t + this.helperProportions.width, r = this.positionAbs.top, i = r + this.helperProportions.height, s = e.left, o = s + e.width, u = e.top, a = u + e.height, f = this.offset.click.top, l = this.offset.click.left, c = "x" === this.options.axis || r + f > u && a > r + f, h = "y" === this.options.axis || t + l > s && o > t + l, p = c && h;
            return "pointer" === this.options.tolerance || this.options.forcePointerForContainers || "pointer" !== this.options.tolerance && this.helperProportions[this.floating ? "width" : "height"] > e[this.floating ? "width" : "height"] ? p : t + this.helperProportions.width / 2 > s && o > n - this.helperProportions.width / 2 && r + this.helperProportions.height / 2 > u && a > i - this.helperProportions.height / 2
        },
        _intersectsWithPointer: function (e) {
            var t = "x" === this.options.axis || this._isOverAxis(this.positionAbs.top + this.offset.click.top, e.top, e.height), n = "y" === this.options.axis || this._isOverAxis(this.positionAbs.left + this.offset.click.left, e.left, e.width), r = t && n, i = this._getDragVerticalDirection(), s = this._getDragHorizontalDirection();
            return r ? this.floating ? s && "right" === s || "down" === i ? 2 : 1 : i && ("down" === i ? 2 : 1) : !1
        },
        _intersectsWithSides: function (e) {
            var t = this._isOverAxis(this.positionAbs.top + this.offset.click.top, e.top + e.height / 2, e.height), n = this._isOverAxis(this.positionAbs.left + this.offset.click.left, e.left + e.width / 2, e.width), r = this._getDragVerticalDirection(), i = this._getDragHorizontalDirection();
            return this.floating && i ? "right" === i && n || "left" === i && !n : r && ("down" === r && t || "up" === r && !t)
        },
        _getDragVerticalDirection: function () {
            var e = this.positionAbs.top - this.lastPositionAbs.top;
            return 0 !== e && (e > 0 ? "down" : "up")
        },
        _getDragHorizontalDirection: function () {
            var e = this.positionAbs.left - this.lastPositionAbs.left;
            return 0 !== e && (e > 0 ? "right" : "left")
        },
        refresh: function (e) {
            return this._refreshItems(e), this._setHandleClassName(), this.refreshPositions(), this
        },
        _connectWith: function () {
            var e = this.options;
            return e.connectWith.constructor === String ? [e.connectWith] : e.connectWith
        },
        _getItemsAsjQuery: function (t) {
            function n() {
                u.push(this)
            }

            var r, i, s, o, u = [], a = [], f = this._connectWith();
            if (f && t)for (r = f.length - 1; r >= 0; r--)for (s = e(f[r], this.document[0]), i = s.length - 1; i >= 0; i--)o = e.data(s[i], this.widgetFullName), o && o !== this && !o.options.disabled && a.push([e.isFunction(o.options.items) ? o.options.items.call(o.element) : e(o.options.items, o.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), o]);
            for (a.push([e.isFunction(this.options.items) ? this.options.items.call(this.element, null, {
                options: this.options,
                item: this.currentItem
            }) : e(this.options.items, this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), this]), r = a.length - 1; r >= 0; r--)a[r][0].each(n);
            return e(u)
        },
        _removeCurrentsFromItems: function () {
            var t = this.currentItem.find(":data(" + this.widgetName + "-item)");
            this.items = e.grep(this.items, function (e) {
                for (var n = 0; t.length > n; n++)if (t[n] === e.item[0])return !1;
                return !0
            })
        },
        _refreshItems: function (t) {
            this.items = [], this.containers = [this];
            var n, r, i, s, o, u, a, f, l = this.items, c = [[e.isFunction(this.options.items) ? this.options.items.call(this.element[0], t, {item: this.currentItem}) : e(this.options.items, this.element), this]], h = this._connectWith();
            if (h && this.ready)for (n = h.length - 1; n >= 0; n--)for (i = e(h[n], this.document[0]), r = i.length - 1; r >= 0; r--)s = e.data(i[r], this.widgetFullName), s && s !== this && !s.options.disabled && (c.push([e.isFunction(s.options.items) ? s.options.items.call(s.element[0], t, {item: this.currentItem}) : e(s.options.items, s.element), s]), this.containers.push(s));
            for (n = c.length - 1; n >= 0; n--)for (o = c[n][1], u = c[n][0], r = 0, f = u.length; f > r; r++)a = e(u[r]), a.data(this.widgetName + "-item", o), l.push({
                item: a,
                instance: o,
                width: 0,
                height: 0,
                left: 0,
                top: 0
            })
        },
        refreshPositions: function (t) {
            this.floating = this.items.length ? "x" === this.options.axis || this._isFloating(this.items[0].item) : !1, this.offsetParent && this.helper && (this.offset.parent = this._getParentOffset());
            var n, r, i, s;
            for (n = this.items.length - 1; n >= 0; n--)r = this.items[n], r.instance !== this.currentContainer && this.currentContainer && r.item[0] !== this.currentItem[0] || (i = this.options.toleranceElement ? e(this.options.toleranceElement, r.item) : r.item, t || (r.width = i.outerWidth(), r.height = i.outerHeight()), s = i.offset(), r.left = s.left, r.top = s.top);
            if (this.options.custom && this.options.custom.refreshContainers)this.options.custom.refreshContainers.call(this); else for (n = this.containers.length - 1; n >= 0; n--)s = this.containers[n].element.offset(), this.containers[n].containerCache.left = s.left, this.containers[n].containerCache.top = s.top, this.containers[n].containerCache.width = this.containers[n].element.outerWidth(), this.containers[n].containerCache.height = this.containers[n].element.outerHeight();
            return this
        },
        _createPlaceholder: function (t) {
            t = t || this;
            var n, r = t.options;
            r.placeholder && r.placeholder.constructor !== String || (n = r.placeholder, r.placeholder = {
                element: function () {
                    var r = t.currentItem[0].nodeName.toLowerCase(), i = e("<" + r + ">", t.document[0]).addClass(n || t.currentItem[0].className + " ui-sortable-placeholder").removeClass("ui-sortable-helper");
                    return "tbody" === r ? t._createTrPlaceholder(t.currentItem.find("tr").eq(0), e("<tr>", t.document[0]).appendTo(i)) : "tr" === r ? t._createTrPlaceholder(t.currentItem, i) : "img" === r && i.attr("src", t.currentItem.attr("src")), n || i.css("visibility", "hidden"), i
                }, update: function (e, i) {
                    (!n || r.forcePlaceholderSize) && (i.height() || i.height(t.currentItem.innerHeight() - parseInt(t.currentItem.css("paddingTop") || 0, 10) - parseInt(t.currentItem.css("paddingBottom") || 0, 10)), i.width() || i.width(t.currentItem.innerWidth() - parseInt(t.currentItem.css("paddingLeft") || 0, 10) - parseInt(t.currentItem.css("paddingRight") || 0, 10)))
                }
            }), t.placeholder = e(r.placeholder.element.call(t.element, t.currentItem)), t.currentItem.after(t.placeholder), r.placeholder.update(t, t.placeholder)
        },
        _createTrPlaceholder: function (t, n) {
            var r = this;
            t.children().each(function () {
                e("<td>&#160;</td>", r.document[0]).attr("colspan", e(this).attr("colspan") || 1).appendTo(n)
            })
        },
        _contactContainers: function (t) {
            var n, r, i, s, o, u, a, f, l, c, h = null, p = null;
            for (n = this.containers.length - 1; n >= 0; n--)if (!e.contains(this.currentItem[0], this.containers[n].element[0]))if (this._intersectsWith(this.containers[n].containerCache)) {
                if (h && e.contains(this.containers[n].element[0], h.element[0]))continue;
                h = this.containers[n], p = n
            } else this.containers[n].containerCache.over && (this.containers[n]._trigger("out", t, this._uiHash(this)), this.containers[n].containerCache.over = 0);
            if (h)if (1 === this.containers.length)this.containers[p].containerCache.over || (this.containers[p]._trigger("over", t, this._uiHash(this)), this.containers[p].containerCache.over = 1); else {
                for (i = 1e4, s = null, l = h.floating || this._isFloating(this.currentItem), o = l ? "left" : "top", u = l ? "width" : "height", c = l ? "clientX" : "clientY", r = this.items.length - 1; r >= 0; r--)e.contains(this.containers[p].element[0], this.items[r].item[0]) && this.items[r].item[0] !== this.currentItem[0] && (a = this.items[r].item.offset()[o], f = !1, t[c] - a > this.items[r][u] / 2 && (f = !0), i > Math.abs(t[c] - a) && (i = Math.abs(t[c] - a), s = this.items[r], this.direction = f ? "up" : "down"));
                if (!s && !this.options.dropOnEmpty)return;
                if (this.currentContainer === this.containers[p])return this.currentContainer.containerCache.over || (this.containers[p]._trigger("over", t, this._uiHash()), this.currentContainer.containerCache.over = 1), void 0;
                s ? this._rearrange(t, s, null, !0) : this._rearrange(t, null, this.containers[p].element, !0), this._trigger("change", t, this._uiHash()), this.containers[p]._trigger("change", t, this._uiHash(this)), this.currentContainer = this.containers[p], this.options.placeholder.update(this.currentContainer, this.placeholder), this.containers[p]._trigger("over", t, this._uiHash(this)), this.containers[p].containerCache.over = 1
            }
        },
        _createHelper: function (t) {
            var n = this.options, r = e.isFunction(n.helper) ? e(n.helper.apply(this.element[0], [t, this.currentItem])) : "clone" === n.helper ? this.currentItem.clone() : this.currentItem;
            return r.parents("body").length || e("parent" !== n.appendTo ? n.appendTo : this.currentItem[0].parentNode)[0].appendChild(r[0]), r[0] === this.currentItem[0] && (this._storedCSS = {
                width: this.currentItem[0].style.width,
                height: this.currentItem[0].style.height,
                position: this.currentItem.css("position"),
                top: this.currentItem.css("top"),
                left: this.currentItem.css("left")
            }), (!r[0].style.width || n.forceHelperSize) && r.width(this.currentItem.width()), (!r[0].style.height || n.forceHelperSize) && r.height(this.currentItem.height()), r
        },
        _adjustOffsetFromHelper: function (t) {
            "string" == typeof t && (t = t.split(" ")), e.isArray(t) && (t = {
                left: +t[0],
                top: +t[1] || 0
            }), "left" in t && (this.offset.click.left = t.left + this.margins.left), "right" in t && (this.offset.click.left = this.helperProportions.width - t.right + this.margins.left), "top" in t && (this.offset.click.top = t.top + this.margins.top), "bottom" in t && (this.offset.click.top = this.helperProportions.height - t.bottom + this.margins.top)
        },
        _getParentOffset: function () {
            this.offsetParent = this.helper.offsetParent();
            var t = this.offsetParent.offset();
            return "absolute" === this.cssPosition && this.scrollParent[0] !== this.document[0] && e.contains(this.scrollParent[0], this.offsetParent[0]) && (t.left += this.scrollParent.scrollLeft(), t.top += this.scrollParent.scrollTop()), (this.offsetParent[0] === this.document[0].body || this.offsetParent[0].tagName && "html" === this.offsetParent[0].tagName.toLowerCase() && e.ui.ie) && (t = {
                top: 0,
                left: 0
            }), {
                top: t.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
                left: t.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
            }
        },
        _getRelativeOffset: function () {
            if ("relative" === this.cssPosition) {
                var e = this.currentItem.position();
                return {
                    top: e.top - (parseInt(this.helper.css("top"), 10) || 0) + this.scrollParent.scrollTop(),
                    left: e.left - (parseInt(this.helper.css("left"), 10) || 0) + this.scrollParent.scrollLeft()
                }
            }
            return {top: 0, left: 0}
        },
        _cacheMargins: function () {
            this.margins = {
                left: parseInt(this.currentItem.css("marginLeft"), 10) || 0,
                top: parseInt(this.currentItem.css("marginTop"), 10) || 0
            }
        },
        _cacheHelperProportions: function () {
            this.helperProportions = {width: this.helper.outerWidth(), height: this.helper.outerHeight()}
        },
        _setContainment: function () {
            var t, n, r, i = this.options;
            "parent" === i.containment && (i.containment = this.helper[0].parentNode), ("document" === i.containment || "window" === i.containment) && (this.containment = [0 - this.offset.relative.left - this.offset.parent.left, 0 - this.offset.relative.top - this.offset.parent.top, "document" === i.containment ? this.document.width() : this.window.width() - this.helperProportions.width - this.margins.left, ("document" === i.containment ? this.document.width() : this.window.height() || this.document[0].body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]), /^(document|window|parent)$/.test(i.containment) || (t = e(i.containment)[0], n = e(i.containment).offset(), r = "hidden" !== e(t).css("overflow"), this.containment = [n.left + (parseInt(e(t).css("borderLeftWidth"), 10) || 0) + (parseInt(e(t).css("paddingLeft"), 10) || 0) - this.margins.left, n.top + (parseInt(e(t).css("borderTopWidth"), 10) || 0) + (parseInt(e(t).css("paddingTop"), 10) || 0) - this.margins.top, n.left + (r ? Math.max(t.scrollWidth, t.offsetWidth) : t.offsetWidth) - (parseInt(e(t).css("borderLeftWidth"), 10) || 0) - (parseInt(e(t).css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left, n.top + (r ? Math.max(t.scrollHeight, t.offsetHeight) : t.offsetHeight) - (parseInt(e(t).css("borderTopWidth"), 10) || 0) - (parseInt(e(t).css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top])
        },
        _convertPositionTo: function (t, n) {
            n || (n = this.position);
            var r = "absolute" === t ? 1 : -1, i = "absolute" !== this.cssPosition || this.scrollParent[0] !== this.document[0] && e.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent, s = /(html|body)/i.test(i[0].tagName);
            return {
                top: n.top + this.offset.relative.top * r + this.offset.parent.top * r - ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : s ? 0 : i.scrollTop()) * r,
                left: n.left + this.offset.relative.left * r + this.offset.parent.left * r - ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : s ? 0 : i.scrollLeft()) * r
            }
        },
        _generatePosition: function (t) {
            var n, r, i = this.options, s = t.pageX, o = t.pageY, u = "absolute" !== this.cssPosition || this.scrollParent[0] !== this.document[0] && e.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent, a = /(html|body)/i.test(u[0].tagName);
            return "relative" !== this.cssPosition || this.scrollParent[0] !== this.document[0] && this.scrollParent[0] !== this.offsetParent[0] || (this.offset.relative = this._getRelativeOffset()), this.originalPosition && (this.containment && (t.pageX - this.offset.click.left < this.containment[0] && (s = this.containment[0] + this.offset.click.left), t.pageY - this.offset.click.top < this.containment[1] && (o = this.containment[1] + this.offset.click.top), t.pageX - this.offset.click.left > this.containment[2] && (s = this.containment[2] + this.offset.click.left), t.pageY - this.offset.click.top > this.containment[3] && (o = this.containment[3] + this.offset.click.top)), i.grid && (n = this.originalPageY + Math.round((o - this.originalPageY) / i.grid[1]) * i.grid[1], o = this.containment ? n - this.offset.click.top >= this.containment[1] && n - this.offset.click.top <= this.containment[3] ? n : n - this.offset.click.top >= this.containment[1] ? n - i.grid[1] : n + i.grid[1] : n, r = this.originalPageX + Math.round((s - this.originalPageX) / i.grid[0]) * i.grid[0], s = this.containment ? r - this.offset.click.left >= this.containment[0] && r - this.offset.click.left <= this.containment[2] ? r : r - this.offset.click.left >= this.containment[0] ? r - i.grid[0] : r + i.grid[0] : r)), {
                top: o - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : a ? 0 : u.scrollTop()),
                left: s - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : a ? 0 : u.scrollLeft())
            }
        },
        _rearrange: function (e, t, n, r) {
            n ? n[0].appendChild(this.placeholder[0]) : t.item[0].parentNode.insertBefore(this.placeholder[0], "down" === this.direction ? t.item[0] : t.item[0].nextSibling), this.counter = this.counter ? ++this.counter : 1;
            var i = this.counter;
            this._delay(function () {
                i === this.counter && this.refreshPositions(!r)
            })
        },
        _clear: function (e, t) {
            function n(e, t, n) {
                return function (r) {
                    n._trigger(e, r, t._uiHash(t))
                }
            }

            this.reverting = !1;
            var r, i = [];
            if (!this._noFinalSort && this.currentItem.parent().length && this.placeholder.before(this.currentItem), this._noFinalSort = null, this.helper[0] === this.currentItem[0]) {
                for (r in this._storedCSS)("auto" === this._storedCSS[r] || "static" === this._storedCSS[r]) && (this._storedCSS[r] = "");
                this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper")
            } else this.currentItem.show();
            for (this.fromOutside && !t && i.push(function (e) {
                this._trigger("receive", e, this._uiHash(this.fromOutside))
            }), !this.fromOutside && this.domPosition.prev === this.currentItem.prev().not(".ui-sortable-helper")[0] && this.domPosition.parent === this.currentItem.parent()[0] || t || i.push(function (e) {
                this._trigger("update", e, this._uiHash())
            }), this !== this.currentContainer && (t || (i.push(function (e) {
                this._trigger("remove", e, this._uiHash())
            }), i.push(function (e) {
                return function (t) {
                    e._trigger("receive", t, this._uiHash(this))
                }
            }.call(this, this.currentContainer)), i.push(function (e) {
                return function (t) {
                    e._trigger("update", t, this._uiHash(this))
                }
            }.call(this, this.currentContainer)))), r = this.containers.length - 1; r >= 0; r--)t || i.push(n("deactivate", this, this.containers[r])), this.containers[r].containerCache.over && (i.push(n("out", this, this.containers[r])), this.containers[r].containerCache.over = 0);
            if (this.storedCursor && (this.document.find("body").css("cursor", this.storedCursor), this.storedStylesheet.remove()), this._storedOpacity && this.helper.css("opacity", this._storedOpacity), this._storedZIndex && this.helper.css("zIndex", "auto" === this._storedZIndex ? "" : this._storedZIndex), this.dragging = !1, t || this._trigger("beforeStop", e, this._uiHash()), this.placeholder[0].parentNode.removeChild(this.placeholder[0]), this.cancelHelperRemoval || (this.helper[0] !== this.currentItem[0] && this.helper.remove(), this.helper = null), !t) {
                for (r = 0; i.length > r; r++)i[r].call(this, e);
                this._trigger("stop", e, this._uiHash())
            }
            return this.fromOutside = !1, !this.cancelHelperRemoval
        },
        _trigger: function () {
            e.Widget.prototype._trigger.apply(this, arguments) === !1 && this.cancel()
        },
        _uiHash: function (t) {
            var n = t || this;
            return {
                helper: n.helper,
                placeholder: n.placeholder || e([]),
                position: n.position,
                originalPosition: n.originalPosition,
                offset: n.positionAbs,
                item: n.currentItem,
                sender: t ? t.element : null
            }
        }
    })
}), function (e) {
    var t;
    t = {
        options: {baseUrl: "/", logged: !1, isUser: !1}, setOptions: function (t) {
            this.options = e.extend({}, this.options, t)
        }, getOptions: function () {
            return this.options
        }, getBaseUrl: function () {
            return this.options.baseUrl
        }, getUrl: function (t, n) {
            var r = "";
            return typeof n == "string" ? r = "?" + n : typeof n == "object" && (r = "?" + e.param(n)), this.getBaseUrl() + t.replace(/^\/+/, "") + r
        }, modal: function (t, n) {
            return n = e.extend({isDialog: !0}, n), K.ajax(t, n).done(function (e) {
                Hyves.create(e.html).show()
            })
        }, closeModal: function () {
            Hyves.destroy()
        }, newId: function (e, t) {
            typeof t == "undefined" && (t = 10), typeof e == "undefined" && (e = "_"), e == "" && (e = "_");
            var n = e, r = "qwertyuiopasdfghjklzxcvbnm", i = r.length;
            for (var s = 0; s < t; ++s)n += r.charAt(Math.round(Math.random() * i));
            return n
        }, idIfNot: function (e, t) {
            return e.attr("id") || e.attr("id", this.newId(t)), e.attr("id")
        }, ajax: function (t, n) {
            return e.ajax({url: K.getUrl(t), data: arguments[1], method: "post", dataType: "json"})
        }, logged: function () {
            return this.options.logged
        }, isUser: function () {
            return this.options.isUser
        }, authRequired: function () {
            return this.logged() ? !0 : (this.modal("ajax/user/auth/login-dialog", {msg: "core.login_required"}), !1)
        }
    }, window.K = t
}(window.jQuery, window), function (e) {
    function r() {
        e(".user-tlh-ow").addClass("edit-mode")
    }

    function i() {
        e(".user-tlh-ow").removeClass("edit-mode")
    }

    function s(e) {
        r(), e.draggable({
            scroll: !1, axis: "y", cursor: "move", stop: function (t, n) {
                var r = 0, i = e.parent().height() - e.height(), s = n.position.top;
                s > r ? e.animate({top: r}, 300) : s < i && e.animate({top: i}, 300)
            }
        })
    }

    function o(e) {
        i(), e.draggable("destroy")
    }

    var t = !0, n = {
        save: '[data-toggle="tl-cover-save"]',
        upload: '[data-toggle="tl-cover-upload"]',
        cancel: '[data-toggle="tl-cover-cancel"]',
        reposition: '[data-toggle="tl-cover-reposition"]',
        remove: '[data-toggle="tl-cover-remove"]'
    };
    e(document).on("click", n.remove, function () {
        var t = e(this), n = t.closest(".user-cover-ow"), r = e(".user-cover-img");
        i();
        var s = {parent: t.data("object")};
        K.ajax("ajax/photo/cover/remove", s).success(function () {
            r.attr("src", ""), n.removeClass("has-cover")
        }).error()
    }), e(document).on("click", n.reposition, function () {
        var t = e(".user-cover-img");
        requirejs(["primary/jqueryui"], function () {
            s(t)
        })
    }), e(document).on("click", n.save, function () {
        var n = e(this), r = e(".user-cover-img"), s = {
            fileId: r.data("fid"),
            uploaded: r.data("uploaded"),
            parent: n.data("object"),
            top: r.position().top,
            size: {width: r.width(), height: r.height()}
        };
        t && console.log(s), K.ajax("ajax/photo/cover/save", s).success(function (e) {
            o(r), i(), e.message && Toast.success(e.message), e.url && fetchPage(e.url)
        }).error()
    }), e(document).on("click", n.cancel, function () {
        var t = e(".user-cover-img"), n = t.attr("reset");
        i();
        if (!n)return !1;
        t.prop("src", n).css({backgroundImage: "none"})
    }), e(document).on("click", n.upload, function () {
        var n = e(this), r = e(n.data("target")), i = K.getUrl("ajax/photo/upload/temp", {}), o = e(".user-cover-img");
        o.attr("reset") || o.attr("reset", o.attr("src")), r.data("upload") || r.data("upload", new PhotosUpload(r, {
            url: i,
            fileName: "fileUpload",
            onNewFile: function (e, t, n, r, i) {
                i.processQueue()
            },
            onUploadProgress: function (e, n, r, i) {
                t && console.log({eid: e, pos: n, percentage: r, input: i})
            },
            onUploadSuccess: function (e, n, r, i) {
                t && console.log(r), o.prop("src", r.url).data("fid", r.id).data("uploaded", "1"), s(o)
            }
        })), requirejs(["primary/jqueryui"], function () {
        }), r.trigger("click")
    }), window.startDraggableTimelineCoverImgForEdit = function () {
        requirejs(["primary/jqueryui"], function () {
            s(e(".user-cover-img"))
        })
    }
}(window.jQuery), function (e) {
    var t = {
        init: function () {
            var t = e(".field-preview-img"), n = e(".field-crop-img"), r = e("input.avatar-value"), i = r.val();
            if (!i)return;
            var s = i.split(";"), o = {
                x: s[2],
                y: s[3],
                w: s[6],
                h: s[7]
            }, u = 100 / o.w, a = 100 / o.h, f = t.get(0), l = s[10], c = s[11];
            t.css({
                width: Math.round(u * l) + "px",
                height: Math.round(a * c) + "px",
                marginLeft: "-" + Math.round(u * o.x) + "px",
                marginTop: "-" + Math.round(a * o.y) + "px"
            })
        }
    };
    window.AvatarField = t;
    var n = {upload: '[data-toggle="btn-avatar-upload"]'};
    e(document).on("click", n.upload, function (t) {
        function l(e, t, n, r) {
            var i = o.data("opts"), s = [i.type, i.id, e.x, e.y, e.x2, e.y2, e.w, e.h, r[0], r[1], t, n].join(";");
            o.val(s)
        }

        function c(e) {
            var t = 100 / e.w, n = 100 / e.h, r = a.get(0), i = r.naturalWidth, s = r.naturalHeight;
            l(e, i, s, f.getBounds()), a.css({
                width: Math.round(t * i) + "px",
                height: Math.round(n * s) + "px",
                marginLeft: "-" + Math.round(t * e.x) + "px",
                marginTop: "-" + Math.round(n * e.y) + "px"
            })
        }

        function h(e) {
            e.Jcrop({
                onSelect: c,
                onChange: c,
                aspectRatio: 1,
                allowSelect: !0,
                minSize: [120, 120],
                maxSize: [320, 320]
            }, function () {
                f = this, f.focus();
                var e = f.getBounds(), t = 220, n = Math.ceil((e[0] - t) / 2), r = Math.ceil((e[1] - t) / 2);
                f.setSelect([n, r, n + t, r + t])
            })
        }

        var n = e(t.currentTarget), r = e(n.data("target")), i = r.closest(".field-avatar-ow"), s = K.getUrl("ajax/photo/upload/temp", {}), o = e("input.avatar-value", i), u = e(".field-crop-img", i), a = e(".field-preview-img", i), f;
        u.attr("reset") || u.attr("reset", u.attr("src")), r.data("upload") || r.data("upload", new PhotosUpload(r, {
            url: s,
            fileName: "fileUpload",
            onNewFile: function (e, t, n, r, i) {
                i.processQueue()
            },
            onUploadProgress: function (e, t, n, r) {
                _debug && console.log({eid: e, pos: t, percentage: n, input: r})
            },
            onUploadSuccess: function (e, t, n, r) {
                _debug && console.log(n);
                var i = {type: "temp", id: n.id};
                o.data("opts", i), u.prop("src", n.url), a.prop("src", n.url), h(u)
            }
        })), r.trigger("click")
    })
}(window.jQuery), function (e) {
    var t = {
        request: '[data-toggle="btn-friend-request"]',
        accept: '[data-toggle="btn-friend-accept"]',
        deny: '[data-toggle="btn-friend-ignore"]',
        cancel: '[data-toggle="btn-friend-cancel"]',
        remove: '[data-toggle="btn-friend-remove"]'
    };
    e(document).on("click", t.request, function (t) {
        var n = e(t.currentTarget), r = n.data("friend");
        n.prop("disabled", !0), K.ajax("/ajax/user/friend/request", {friendId: r}).always(function () {
            n.prop("disabled", !1)
        }).done(function (e) {
            n.closest(".btn-membership").replaceWith(e.html)
        })
    }), e(document).on("click", t.deny, function (t) {
        var n = e(t.currentTarget), r = n.data("friend"), i = n.data("eid");
        n.prop("disabled", !0), K.ajax("/ajax/user/friend/ignore", {friendId: r}).always(function () {
            n.prop("disabled", !1)
        }).done(function (t) {
            e(i).replaceWith(t.html)
        })
    }), e(document).on("click", t.accept, function (t) {
        var n = e(t.currentTarget), r = n.data("friend"), i = n.data("eid");
        n.prop("disabled", !0), K.ajax("/ajax/user/friend/accept", {friendId: r}).always(function () {
            n.prop("disabled", !1)
        }).done(function (t) {
            e(i).replaceWith(t.html)
        })
    }), e(document).on("click", t.cancel, function (t) {
        var n = e(t.currentTarget), r = n.data("friend");
        n.prop("disabled", !0), K.ajax("/ajax/user/friend/cancel", {friendId: r}).always(function () {
            n.prop("disabled", !1)
        }).done(function (e) {
            n.closest(".btn-membership").replaceWith(e.html)
        })
    }), e(document).on("click", t.remove, function (t) {
        var n = e(t.currentTarget), r = n.data("friend"), i = n.data("eid");
        n.prop("disabled", !0), K.ajax("/ajax/user/friend/remove", {friendId: r}).done(function (t) {
            e(i).replaceWith(t.html)
        })
    })
}(window.jQuery), function (e) {
    var t = {add: '[data-toggle="btn-like-add"]', remove: '[data-toggle="btn-like-remove"]'};
    e(document).on("click", t.add, function () {
        var t = e(this), n = t.data("object");
        t.prop("disabled", !0), K.ajax("/ajax/like/like/add", {
            id: n.id,
            type: n.type,
            context: "btn"
        }).done(function (e) {
            t.closest(".btn-like-ow").html(e.html)
        }).error(function (e) {
            console.log(e)
        })
    }), e(document).on("click", t.remove, function () {
        var t = e(this), n = t.data("object");
        t.prop("disabled", !0), K.ajax("/ajax/like/like/remove", {
            id: n.id,
            type: n.type,
            context: "btn"
        }).done(function (e) {
            t.closest(".btn-like-ow").html(e.html)
        }).error(function (e) {
            console.log(e)
        })
    })
}(window.jQuery), function (e) {
    var t = {
        join: '[data-toggle="btn-group-join"]',
        leave: '[data-toggle="btn-group-leave"]',
        accept: '[data-toggle="btn-group-accept"]',
        ignore: '[data-toggle="btn-group-ignore"]',
        cancel: '[data-toggle="btn-group-cancel"]',
        remove: '[data-toggle="btn-group-remove"]'
    };
    e(document).on("click", t.join, function (t) {
        var n = e(this), r = n.data("object");
        K.ajax("/ajax/group/membership/join", {id: r.id, type: "group", context: "btn"}).done(function (t) {
            n.data("eid") ? e(n.data("eid")).replaceWith(t.html) : n.replaceWith(t.html)
        }).error(function (e) {
            console.log(e)
        })
    }), e(document).on("click", t.cancel, function (t) {
        var n = e(t.currentTarget), r = n.data("object");
        K.ajax("/ajax/group/membership/cancel", {id: r.id, type: "group", context: "btn"}).done(function (t) {
            n.data("eid") ? e(n.data("eid")).replaceWith(t.html) : n.replaceWith(t.html)
        }).error(function (e) {
            console.log(e)
        })
    }), e(document).on("click", t.ignore, function (t) {
        var n = e(this), r = n.data("object");
        r.context = "btn", K.ajax("/ajax/group/membership/ignore", r).done(function (t) {
            n.data("eid") ? e(n.data("eid")).replaceWith(t.html) : n.replaceWith(t.html)
        }).error(function (e) {
            console.log(e)
        })
    }), e(document).on("click", t.accept, function (t) {
        var n = e(t.currentTarget), r = n.data("object");
        r.context = "btn", K.ajax("/ajax/group/membership/accept", r).done(function (t) {
            n.data("eid") ? e(n.data("eid")).replaceWith(t.html) : n.replaceWith(t.html)
        }).error(function (e) {
            console.log(e)
        })
    }), e(document).on("click", t.remove, function (t) {
        var n = e(t.currentTarget), r = n.data("object");
        r.context = "btn", K.ajax("/ajax/group/membership/remove", r).done(function (t) {
            n.data("eid") ? e(n.data("eid")).replaceWith(t.html) : n.replaceWith(t.html)
        }).error(function (e) {
            console.log(e)
        })
    }), e(document).on("click", '[data-toggle="btn-invitation-cmd"]', function (t) {
        var n = e(t.currentTarget), r = e.extend({}, n.data("obj"), {ctx: n.data("ctx"), cmd: n.data("cmd")});
        t.preventDefault(), n.prop("disabled", !0), n.closest(".card-invitation").addClass("hidden"), K.ajax("ajax/invitation/invitation/cmd", r).always(function () {
            n.prop("disabled", !1)
        }).done(function (e) {
        }).error(function () {
        })
    }), e(document).on("click", '[data-toggle="modal"]', function (t) {
        var n = e(t.currentTarget), r = n.data("remote"), i = n.data("object");
        K.modal(r, i)
    })
}(jQuery), define("base/core/picaso", function () {
}), function (e) {
    e(document).on("click", '[data-control="select-option"]', function () {
        var t = e(this), n = t.closest(".dropdown-control"), r = n.find("input.hidden:first"), i = n.find("span.txt-label:first");
        console.log(t.attr("value"), t.attr("label")), r.val(t.attr("value")), i.text(t.attr("label"))
    })
}(jQuery), define("base/core/control", function () {
}), function (e) {
    var t = !1, n = "#dirty", r = "#main", i = "", s = !1, o = !1, u = 1e3;
    e.fn.bootInit = function () {
        e("[ride]", this).each(function () {
            var n = e(this), r = n.attr("ride");
            t && console.log("boot element " + r, n), r && typeof n[r] == "function" && n[r]({})
        })
    }, e.fn.clearBootInit = function () {
        t && console.log("Clear Boot Init"), e("[ride]", this).each(function () {
            e(this).trigger("clearBootInit")
        })
    }, window.BootInit = function () {
        i = document.location.href, s = !e(n).val(), e(n).val(1), s && (t && console.log("clear all boot init"), e(document).clearBootInit()), s || !o ? (t && console.log("boot init DOCUMENT"), e(document).bootInit()) : (t && console.log("boot init MAIN"), e(r).bootInit()), o = !0
    }, window.setInterval(function () {
        i != document.location.href && BootInit()
    }, u), e(document).ready(function () {
        var t = window.innerHeight - e("#header").outerHeight() - e("#footer").outerHeight() + 22;
        t > 0 && e("#main").css({minHeight: t})
    })
}(jQuery), define("base/core/boot", function () {
}), define("base/core/main", ["base/core/picaso", "base/core/control", "base/core/boot"], function () {
    $(document).on("click", '[data-toggle="ajax"]', function (e) {
        e.preventDefault();
        var t = $(this), n = t.data("url"), r = t.data("object");
        K.ajax(n, r).done(function (e) {
            switch (e.directive) {
                case"success":
                    Toast.success(e.message);
                    break;
                case"error":
                    Toast.error(e.message);
                    break;
                case"warning":
                    Toast.warning(e.message);
                    break;
                case"reload":
                    window.location.reload()
            }
        })
    }), $(document).on("click", '[data-toggle="expand"]', function () {
        var e = $(this), t = $(e.data("target"));
        t.toggleClass("collapse")
    }), $(document).on("click", '[data-toggle="dismiss"]', function () {
        var e = $(this), t = e.data("url"), n = e.data("eid"), r = e.data("closest") || ".card-wrap", i = e.data("object"), s = n ? $(n).closest(r) : e.closest(r);
        console.log(r), s.animate({opacity: 0}, 200, function () {
            s.addClass("hidden")
        }), t && K.ajax(t, i).done(function (e) {
            _.isEmpty(e.success) || Toast.success(e.success), _.isEmpty(e.error) || (Toast.error(e.error), s.removeClass("hidden"))
        })
    })
}), +function (e) {
    "use strict";
    function n(n) {
        return this.each(function () {
            var r = e(this), i = r.data("bs.affix"), s = typeof n == "object" && n;
            i || r.data("bs.affix", i = new t(this, s)), typeof n == "string" && i[n]()
        })
    }

    var t = function (n, r) {
        this.options = e.extend({}, t.DEFAULTS, r), this.$target = e(this.options.target).on("scroll.bs.affix.data-api", e.proxy(this.checkPosition, this)).on("click.bs.affix.data-api", e.proxy(this.checkPositionWithEventLoop, this)), this.$element = e(n), this.affixed = null, this.unpin = null, this.pinnedOffset = null, this.checkPosition()
    };
    t.VERSION = "3.3.4", t.RESET = "affix affix-top affix-bottom", t.DEFAULTS = {
        offset: 0,
        target: window
    }, t.prototype.getState = function (e, t, n, r) {
        var i = this.$target.scrollTop(), s = this.$element.offset(), o = this.$target.height();
        if (n != null && this.affixed == "top")return i < n ? "top" : !1;
        if (this.affixed == "bottom")return n != null ? i + this.unpin <= s.top ? !1 : "bottom" : i + o <= e - r ? !1 : "bottom";
        var u = this.affixed == null, a = u ? i : s.top, f = u ? o : t;
        return n != null && i <= n ? "top" : r != null && a + f >= e - r ? "bottom" : !1
    }, t.prototype.getPinnedOffset = function () {
        if (this.pinnedOffset)return this.pinnedOffset;
        this.$element.removeClass(t.RESET).addClass("affix");
        var e = this.$target.scrollTop(), n = this.$element.offset();
        return this.pinnedOffset = n.top - e
    }, t.prototype.checkPositionWithEventLoop = function () {
        setTimeout(e.proxy(this.checkPosition, this), 1)
    }, t.prototype.checkPosition = function () {
        if (!this.$element.is(":visible"))return;
        var n = this.$element.height(), r = this.options.offset, i = r.top, s = r.bottom, o = e(document.body).height();
        typeof r != "object" && (s = i = r), typeof i == "function" && (i = r.top(this.$element)), typeof s == "function" && (s = r.bottom(this.$element));
        var u = this.getState(o, n, i, s);
        if (this.affixed != u) {
            this.unpin != null && this.$element.css("top", "");
            var a = "affix" + (u ? "-" + u : ""), f = e.Event(a + ".bs.affix");
            this.$element.trigger(f);
            if (f.isDefaultPrevented())return;
            this.affixed = u, this.unpin = u == "bottom" ? this.getPinnedOffset() : null, this.$element.removeClass(t.RESET).addClass(a).trigger(a.replace("affix", "affixed") + ".bs.affix")
        }
        u == "bottom" && this.$element.offset({top: o - n - s})
    };
    var r = e.fn.affix;
    e.fn.affix = n, e.fn.affix.Constructor = t, e.fn.affix.noConflict = function () {
        return e.fn.affix = r, this
    }, e(window).on("load", function () {
        e('[data-spy="affix"]').each(function () {
            var t = e(this), r = t.data();
            r.offset = r.offset || {}, r.offsetBottom != null && (r.offset.bottom = r.offsetBottom), r.offsetTop != null && (r.offset.top = r.offsetTop), n.call(t, r)
        })
    })
}(jQuery), define("bootstrap/affix", function () {
}), +function (e) {
    "use strict";
    function r(t) {
        return this.each(function () {
            var r = e(this), i = r.data("bs.alert");
            i || r.data("bs.alert", i = new n(this)), typeof t == "string" && i[t].call(r)
        })
    }

    var t = '[data-dismiss="alert"]', n = function (n) {
        e(n).on("click", t, this.close)
    };
    n.VERSION = "3.3.4", n.TRANSITION_DURATION = 150, n.prototype.close = function (t) {
        function o() {
            s.detach().trigger("closed.bs.alert").remove()
        }

        var r = e(this), i = r.attr("data-target");
        i || (i = r.attr("href"), i = i && i.replace(/.*(?=#[^\s]*$)/, ""));
        var s = e(i);
        t && t.preventDefault(), s.length || (s = r.closest(".alert")), s.trigger(t = e.Event("close.bs.alert"));
        if (t.isDefaultPrevented())return;
        s.removeClass("in"), e.support.transition && s.hasClass("fade") ? s.one("bsTransitionEnd", o).emulateTransitionEnd(n.TRANSITION_DURATION) : o()
    };
    var i = e.fn.alert;
    e.fn.alert = r, e.fn.alert.Constructor = n, e.fn.alert.noConflict = function () {
        return e.fn.alert = i, this
    }, e(document).on("click.bs.alert.data-api", t, n.prototype.close)
}(jQuery), define("bootstrap/alert", function () {
}), +function (e) {
    "use strict";
    function n(n) {
        return this.each(function () {
            var r = e(this), i = r.data("bs.button"), s = typeof n == "object" && n;
            i || r.data("bs.button", i = new t(this, s)), n == "toggle" ? i.toggle() : n && i.setState(n)
        })
    }

    var t = function (n, r) {
        this.$element = e(n), this.options = e.extend({}, t.DEFAULTS, r), this.isLoading = !1
    };
    t.VERSION = "3.3.4", t.DEFAULTS = {loadingText: "loading..."}, t.prototype.setState = function (t) {
        var n = "disabled", r = this.$element, i = r.is("input") ? "val" : "html", s = r.data();
        t += "Text", s.resetText == null && r.data("resetText", r[i]()), setTimeout(e.proxy(function () {
            r[i](s[t] == null ? this.options[t] : s[t]), t == "loadingText" ? (this.isLoading = !0, r.addClass(n).attr(n, n)) : this.isLoading && (this.isLoading = !1, r.removeClass(n).removeAttr(n))
        }, this), 0)
    }, t.prototype.toggle = function () {
        var e = !0, t = this.$element.closest('[data-toggle="buttons"]');
        if (t.length) {
            var n = this.$element.find("input");
            n.prop("type") == "radio" && (n.prop("checked") && this.$element.hasClass("active") ? e = !1 : t.find(".active").removeClass("active")), e && n.prop("checked", !this.$element.hasClass("active")).trigger("change")
        } else this.$element.attr("aria-pressed", !this.$element.hasClass("active"));
        e && this.$element.toggleClass("active")
    };
    var r = e.fn.button;
    e.fn.button = n, e.fn.button.Constructor = t, e.fn.button.noConflict = function () {
        return e.fn.button = r, this
    }, e(document).on("click.bs.button.data-api", '[data-toggle^="button"]', function (t) {
        var r = e(t.target);
        r.hasClass("btn") || (r = r.closest(".btn")), n.call(r, "toggle"), t.preventDefault()
    }).on("focus.bs.button.data-api blur.bs.button.data-api", '[data-toggle^="button"]', function (t) {
        e(t.target).closest(".btn").toggleClass("focus", /^focus(in)?$/.test(t.type))
    })
}(jQuery), define("bootstrap/button", function () {
}), +function (e) {
    "use strict";
    function i(r) {
        if (r && r.which === 3)return;
        e(t).remove(), e(n).each(function () {
            var t = e(this), n = s(t), i = {relatedTarget: this};
            if (!n.hasClass("open"))return;
            n.trigger(r = e.Event("hide.bs.dropdown", i));
            if (r.isDefaultPrevented())return;
            t.attr("aria-expanded", "false"), n.removeClass("open").trigger("hidden.bs.dropdown", i)
        })
    }

    function s(t) {
        var n = t.attr("data-target");
        n || (n = t.attr("href"), n = n && /#[A-Za-z]/.test(n) && n.replace(/.*(?=#[^\s]*$)/, ""));
        var r = n && e(n);
        return r && r.length ? r : t.parent()
    }

    function o(t) {
        return this.each(function () {
            var n = e(this), i = n.data("bs.dropdown");
            i || n.data("bs.dropdown", i = new r(this)), typeof t == "string" && i[t].call(n)
        })
    }

    var t = ".dropdown-backdrop", n = '[data-toggle="dropdown"]', r = function (t) {
        e(t).on("click.bs.dropdown", this.toggle)
    };
    r.VERSION = "3.3.4", r.prototype.toggle = function (t) {
        var n = e(this);
        if (n.is(".disabled, :disabled"))return;
        var r = s(n), o = r.hasClass("open");
        i();
        if (!o) {
            "ontouchstart" in document.documentElement && !r.closest(".navbar-nav").length && e('<div class="dropdown-backdrop"/>').insertAfter(e(this)).on("click", i);
            var u = {relatedTarget: this};
            r.trigger(t = e.Event("show.bs.dropdown", u));
            if (t.isDefaultPrevented())return;
            n.trigger("focus").attr("aria-expanded", "true"), r.toggleClass("open").trigger("shown.bs.dropdown", u)
        }
        return !1
    }, r.prototype.keydown = function (t) {
        if (!/(38|40|27|32)/.test(t.which) || /input|textarea/i.test(t.target.tagName))return;
        var r = e(this);
        t.preventDefault(), t.stopPropagation();
        if (r.is(".disabled, :disabled"))return;
        var i = s(r), o = i.hasClass("open");
        if (!o && t.which != 27 || o && t.which == 27)return t.which == 27 && i.find(n).trigger("focus"), r.trigger("click");
        var u = " li:not(.disabled):visible a", a = i.find('[role="menu"]' + u + ', [role="listbox"]' + u);
        if (!a.length)return;
        var f = a.index(t.target);
        t.which == 38 && f > 0 && f--, t.which == 40 && f < a.length - 1 && f++, ~f || (f = 0), a.eq(f).trigger("focus")
    };
    var u = e.fn.dropdown;
    e.fn.dropdown = o, e.fn.dropdown.Constructor = r, e.fn.dropdown.noConflict = function () {
        return e.fn.dropdown = u, this
    }, e(document).on("click.bs.dropdown.data-api", i).on("click.bs.dropdown.data-api", ".dropdown form", function (e) {
        e.stopPropagation()
    }).on("click.bs.dropdown.data-api", n, r.prototype.toggle).on("keydown.bs.dropdown.data-api", n, r.prototype.keydown).on("keydown.bs.dropdown.data-api", '[role="menu"]', r.prototype.keydown).on("keydown.bs.dropdown.data-api", '[role="listbox"]', r.prototype.keydown)
}(jQuery), define("bootstrap/dropdown", function () {
}), +function (e) {
    "use strict";
    function n(t) {
        var n, r = t.attr("data-target") || (n = t.attr("href")) && n.replace(/.*(?=#[^\s]+$)/, "");
        return e(r)
    }

    function r(n) {
        return this.each(function () {
            var r = e(this), i = r.data("bs.collapse"), s = e.extend({}, t.DEFAULTS, r.data(), typeof n == "object" && n);
            !i && s.toggle && /show|hide/.test(n) && (s.toggle = !1), i || r.data("bs.collapse", i = new t(this, s)), typeof n == "string" && i[n]()
        })
    }

    var t = function (n, r) {
        this.$element = e(n), this.options = e.extend({}, t.DEFAULTS, r), this.$trigger = e('[data-toggle="collapse"][href="#' + n.id + '"],' + '[data-toggle="collapse"][data-target="#' + n.id + '"]'), this.transitioning = null, this.options.parent ? this.$parent = this.getParent() : this.addAriaAndCollapsedClass(this.$element, this.$trigger), this.options.toggle && this.toggle()
    };
    t.VERSION = "3.3.4", t.TRANSITION_DURATION = 350, t.DEFAULTS = {toggle: !0}, t.prototype.dimension = function () {
        var e = this.$element.hasClass("width");
        return e ? "width" : "height"
    }, t.prototype.show = function () {
        if (this.transitioning || this.$element.hasClass("in"))return;
        var n, i = this.$parent && this.$parent.children(".panel").children(".in, .collapsing");
        if (i && i.length) {
            n = i.data("bs.collapse");
            if (n && n.transitioning)return
        }
        var s = e.Event("show.bs.collapse");
        this.$element.trigger(s);
        if (s.isDefaultPrevented())return;
        i && i.length && (r.call(i, "hide"), n || i.data("bs.collapse", null));
        var o = this.dimension();
        this.$element.removeClass("collapse").addClass("collapsing")[o](0).attr("aria-expanded", !0), this.$trigger.removeClass("collapsed").attr("aria-expanded", !0), this.transitioning = 1;
        var u = function () {
            this.$element.removeClass("collapsing").addClass("collapse in")[o](""), this.transitioning = 0, this.$element.trigger("shown.bs.collapse")
        };
        if (!e.support.transition)return u.call(this);
        var a = e.camelCase(["scroll", o].join("-"));
        this.$element.one("bsTransitionEnd", e.proxy(u, this)).emulateTransitionEnd(t.TRANSITION_DURATION)[o](this.$element[0][a])
    }, t.prototype.hide = function () {
        if (this.transitioning || !this.$element.hasClass("in"))return;
        var n = e.Event("hide.bs.collapse");
        this.$element.trigger(n);
        if (n.isDefaultPrevented())return;
        var r = this.dimension();
        this.$element[r](this.$element[r]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded", !1), this.$trigger.addClass("collapsed").attr("aria-expanded", !1), this.transitioning = 1;
        var i = function () {
            this.transitioning = 0, this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")
        };
        if (!e.support.transition)return i.call(this);
        this.$element[r](0).one("bsTransitionEnd", e.proxy(i, this)).emulateTransitionEnd(t.TRANSITION_DURATION)
    }, t.prototype.toggle = function () {
        this[this.$element.hasClass("in") ? "hide" : "show"]()
    }, t.prototype.getParent = function () {
        return e(this.options.parent).find('[data-toggle="collapse"][data-parent="' + this.options.parent + '"]').each(e.proxy(function (t, r) {
            var i = e(r);
            this.addAriaAndCollapsedClass(n(i), i)
        }, this)).end()
    }, t.prototype.addAriaAndCollapsedClass = function (e, t) {
        var n = e.hasClass("in");
        e.attr("aria-expanded", n), t.toggleClass("collapsed", !n).attr("aria-expanded", n)
    };
    var i = e.fn.collapse;
    e.fn.collapse = r, e.fn.collapse.Constructor = t, e.fn.collapse.noConflict = function () {
        return e.fn.collapse = i, this
    }, e(document).on("click.bs.collapse.data-api", '[data-toggle="collapse"]', function (t) {
        var i = e(this);
        i.attr("data-target") || t.preventDefault();
        var s = n(i), o = s.data("bs.collapse"), u = o ? "toggle" : i.data();
        r.call(s, u)
    })
}(jQuery), define("bootstrap/collapse", function () {
}), function (e, t) {
    function f() {
        e(".options-dialog").trigger("hide"), n && console.log("clear menu drop downs")
    }

    var n = !1, r = '[data-toggle="options"]', i, s = 250, o = '<div class="options-dialog hidden"><div class="options-overlay"><div class="options-stageout"><div class="options-stagein"><div class="options-content"></div></div></div><div class="options-tailer"><div></div></div></div></div>', u = '<div class="options-content"><ul class="options-menu"><li class="options-loading">Loading...</li></ul></div>', a = "options";
    i = function (t, n, r) {
        this.element = e(t), this.dialog = !1, this.clientY = r, this.forItem = this.element.data("for") || "for-icon", this.forBeeber = /beeber/i.test(this.element.data("for")) ? !0 : !1, this.parent = this.element.parent(), this.inline = !1
    }, i.prototype.hideDialog = function () {
        if (!this.dialog || !this.dialog.length)return;
        this.dialog.addClass("hidden")
    }, i.prototype.showDialog = function () {
        this.dialog.removeClass("hidden")
    }, i.prototype.closeDialog = function () {
        this.dialog.addClass("hidden")
    }, i.prototype.updateDialogPositionForFlying = function () {
        n && console.log("_OptionsDialog updateDialogPosition");
        if (!this.element)return;
        var e = this.element.offset(), t = {}, r = /left/i.test(this.element.data("for")) ? !0 : !1, i = r ? "left" : "right", s = "down", o = e.left + Math.ceil(this.element.outerWidth() / 2), u = e.top + this.element.outerHeight();
        r ? (o = e.left - 12, t.left = Math.ceil(this.element.outerWidth() / 2 - 10 + 12)) : (o = e.left + this.element.outerWidth() + 12, t.right = Math.ceil(this.element.outerWidth() / 2 - 10 + 12)), n && (console.log("offset", e), console.log("element width", this.element.width()), console.log("element height", this.element.height())), this.forBeeber && window.innerWidth < 380 && (r ? (o = 0, this.dialog.find(".options-overlay").css({left: 0})) : (o = window.innerWidth, this.dialog.find(".options-overlay").css({right: 0}))), this.clientY > 280 && (u = e.top, s = "up"), this.dialog.addClass(i).addClass(s).css({
            left: o,
            top: u
        }), this.dialog.find(".options-tailer").css(t)
    }, i.prototype.updateDialogPositionForInline = function () {
        n && console.log("_OptionsDialog updateDialogPosition");
        if (!this.element)return;
        var e = this.element.offset(), t = {}, r = {}, i = /left/i.test(this.element.data("for")) ? !0 : !1, s = i ? "left" : "right", o = "down";
        i ? (t.left = -12, r.left = Math.ceil(this.element.outerWidth() / 2 - 10 + 12)) : (t.right = -12, r.right = Math.ceil(this.element.outerWidth() / 2 - 10 + 12)), n && (console.log("offset", e), console.log("element width", this.element.width()), console.log("element height", this.element.height())), this.clientY > 280 ? (t.bottom = this.element.outerHeight(), o = "up") : (t.top = this.element.outerHeight(), o = "down"), this.dialog.addClass(s).addClass(o).css(t), this.dialog.find(".options-tailer").css(r)
    }, i.prototype.createDialog = function () {
        n && console.log("_OptionsDialog createDialog");
        if (this.inline) {
            this.dialog = e(".options-dialog:first", this.parent);
            if (this.dialog.length)return
        }
        this.inline ? this.dialog = e(t.template(o)()).appendTo(this.parent) : this.dialog = e(t.template(o)()).appendTo("body"), this.dialog.addClass(this.element.data("for")), this.dialog.on("hide", e.proxy(this.hideDialog, this)), this.loadContent()
    }, i.prototype.loadContent = function () {
        function s(e) {
            t.dialog.find(".options-stagein").html(e.html), t.dialog.bootInit()
        }

        if (!this.dialog)return;
        var t = this, n = this.element.data("remote"), r = "#" + this.element.eid(), i = e.extend({eid: r}, this.element.data("object"));
        K.ajax(n, i).done(s)
    }, i.prototype.toggleDialog = function () {
        n && console.log("_OptionsDialog openDialog"), this.dialog || (this.createDialog(), e(".options-stagein", this.dialog).html(t.template(u)())), this.inline ? this.updateDialogPositionForInline() : this.updateDialogPositionForFlying();
        if (this.dialog.hasClass("hidden")) {
            var r = this;
            window.setTimeout(function () {
                r.showDialog()
            }, s)
        }
    }, e(document).on("click", ".pl-bear-state", function () {
        var t = e(this);
        t.find(">span.badge").html("").addClass("hidden"), K.ajax(t.data("bear"), {})
    }).on("click", function (e) {
        e.isDefaultPrevented() || f()
    }).on("pagechanged", function () {
        f()
    }).on("click", r, function (t) {
        var n = e(t.currentTarget), r = n.data(a);
        r || n.data(a, r = new i(t.currentTarget, t.clientX, t.clientY)), r.toggleDialog()
    })
}(jQuery, _), define("bootstrap/options", function () {
}), function (e) {
    var t, n = !1, r = "paging";
    t = function (t) {
        function v() {
            var t = e(".card-wrap:first", i);
            return t.length ? t.data("id") : 0
        }

        function m() {
            var t = e(".card-wrap:last", i);
            return t.length ? t.data("id") : 0
        }

        function g() {
            d = !0, i.find(".pager.more>a").toggleClass("hidden")
        }

        function y() {
            d = !1, i.find(".pager.more>a").toggleClass("hidden")
        }

        function b(t) {
            t.html && o.append(t.html), t.hasNext || e(".pager.more,.pager-more", i).addClass("hidden")
        }

        function w() {
        }

        function E() {
            if (d)return;
            g();
            var t = i.data("pager"), n = i.data("query"), r = i.data("lp"), s = i.data("url"), o = e.extend({}, {
                query: n,
                lp: r
            });
            if (f)e.extend(o, {mode: "more", minId: m(), maxId: v()}); else {
                if (t.page >= t.totalPage)return;
                t.page = t.page + 1, i.data("pager", t), e.extend(o, t)
            }
            K.ajax(s, o).always(y).success(b).error(w)
        }

        function S() {
            d = !0
        }

        function x() {
            d = !1
        }

        function T(e) {
            e.html && o.prepend(e.html)
        }

        function N() {
        }

        function C() {
            if (d)return;
            S();
            var t = i.data("pager"), n = i.data("query"), r = i.data("lp"), s = i.data("url"), o = e.extend({}, {
                query: n,
                lp: r
            });
            if (f)e.extend(o, {mode: "new", minId: m(), maxId: v()}); else {
                if (t.page < 1)return;
                t.page = t.page - 1, i.data("pager", t), e.extend(o, t)
            }
            K.ajax(s, o).always(x).success(T).error(N)
        }

        function k() {
            d = !0;
            var t = i.data("pager");
            t.page > 1 && e(".pager-prev", i).removeClass("disabled"), t.page >= t.totalPage && e(".pager-next", i).addClass("disabled")
        }

        function L() {
            d = !1
        }

        function A() {
            n && console.log("load next fail")
        }

        function O(e) {
            e.html && o.html(e.html)
        }

        function M() {
            if (d)return;
            n && console.log("load page");
            var t = i.data("pager"), r = i.data("query"), s = i.data("lp"), o = i.data("url");
            if (t.page >= t.totalPage)return;
            t.page = t.page + 1, i.data("pager", t), console.log(t), k(), K.ajax(o, e.extend({}, t, {
                query: r,
                lp: s
            })).always(L).success(O).error(A)
        }

        function _() {
            d = !0;
            var t = i.data("pager");
            t.page < 2 && e(".pager-prev", i).addClass("disabled"), t.page < t.totalPage && e(".pager-next", i).removeClass("disabled")
        }

        function D() {
            d = !1
        }

        function P(e) {
            e.html && o.html(e.html)
        }

        function H() {
        }

        function B() {
            a.off("scroll.endless").on("scroll.endless", function () {
                l = Math.ceil((u ? a.scrollTop() : i.offset().top) - s.offset().top + (u ? window.innerHeight : a.height()) - s.outerHeight() + c), n && console.log(h, l, u), l > 0 && E()
            })
        }

        function j() {
            if (d)return;
            n && console.log(h, "load page");
            var t = i.data("pager"), r = i.data("query"), s = i.data("url");
            if (t.page < 2)return;
            t.page = t.page - 1, i.data("pager", t), console.log(t), _(), K.ajax(s, e.extend({}, t, {query: r})).always(D).success(P).error(H)
        }

        var i = e(t), s = i.find(".paging-stage"), o = i.find(".paging-content"), u = i.css("overflow-y") === "visible", a = u ? e(window) : i, f = i.data("continue") ? 1 : 0, l = 0, c = 30, h = i.eid(), p = i.data("endless"), d = !1;
        p && B(), i.on("loadnew", function () {
            C()
        }).on("loadmore", function () {
            E()
        }).on("loadnext", function () {
            M()
        }).on("loadprev", function () {
            j()
        }).on("clearBootInit", function () {
            t.data(r, !1)
        })
    }, e(document).on("click", '[data-toggle="pager"]', function (t) {
        var n = e(t.currentTarget), r = n.closest(".paging");
        r.length && r.trigger("load" + n.data("pager"), n.data("page") || {}), t.preventDefault()
    }), e.fn.paging = function () {
        var n = e(this.get(0));
        return e.data(n, r) || n.data(r, new t(n)), e.data(n, r)
    }
}(jQuery), define("bootstrap/paging", function () {
}), function (e) {
    var t = !1, n = "#site-container", r = null, i = null, s = function () {
        e(document).trigger("pagechanged"), e(".navbar-collapse").removeClass("in")
    }, o = function () {
    }, u = function (t) {
        t.directive != "" && (e(r).html(t.html), document.title = t.title)
    }, a = function (o, u) {
        i && i.prop("src", "javascript:false;").remove(), /undefined/i.test(typeof u) && (u = n), r = u, t && console.log("load page ", o, r), o += (o.indexOf("?") == -1 ? "?" : "&") + "__ajax_load_page=1&t_" + e.now(), s(), i = e("<iframe />", {src: o}).css({display: "none"}).appendTo("body"), i.on("load", function () {
            i.prop("src", "javascript:false"), i.remove(), i = null
        })
    }, f = function (e) {
        window.history.pushState({}, "", e), a(e, n)
    }, l = function (e) {
        window.history.replaceState({}, "", e), a(e, n)
    };
    e(window).on("popstate", function (e) {
        e.originalEvent.state !== null && a(location.href, n)
    }), e(document).on("click", "a", function (r) {
        var i = e(r.currentTarget), s = i.attr("href"), o = i.prop("target"), u = i.data("toggle"), f = i.prop("onclick"), l = i.prop("container") || n;
        if (typeof s == "undefined")return;
        if (s.indexOf(document.domain) > -1)return;
        if (s.indexOf("javascript") > -1)return;
        if (s.trim() == "")return;
        if (u)return;
        if (o)return;
        if (f)return;
        t && console.log("load page ", s, l), r.preventDefault(), window.history.pushState({}, "", s), a(s, l)
    }), window.loadPage = a, window.fetchPage = f, window.replacePage = l, window.onFetchPageComplete = u
}(jQuery), define("bootstrap/pushstate", function () {
}), function (e) {
    var t = !1, n;
    n = function () {
        function l() {
            if (n)return;
            n = e('<div class="dialog-tooltip top"/>').appendTo("body"), i = e('<div class="tooltip-caret"/>').appendTo(n), r = e('<div class="tooltip-content"/>').appendTo(n)
        }

        function c() {
            n.removeClass("fade").removeClass("in")
        }

        function h() {
            var e = f.attr("title") || f.attr("label") || f.data("label"), t, i, s;
            e ? (t = f.offset(), r.html(e), i = Math.floor(t.left + f.outerWidth() / 2 - n.outerWidth() / 2), s = Math.floor(t.top - n.outerHeight()), n.css({
                left: i,
                top: s
            }).addClass("fade").addClass("in")) : c()
        }

        function p() {
            r.html("..."), n.removeClass("fade").removeClass("in").css({left: -1e3, top: -1e3})
        }

        function d() {
            if (o)try {
                window.clearTimeout(o)
            } catch (e) {
            }
            if (a)try {
                window.clearTimeout(a)
            } catch (e) {
            }
        }

        function v(e) {
            t && console.log("onOver"), d(), f = e, a = 0, o = window.setTimeout(h, s)
        }

        function m() {
            t && console.log("onLeave"), d(), o = 0, a = window.setTimeout(p, u)
        }

        var n, r, i, s = 400, o = 0, u = 100, a = 0, f;
        e(document).on("mouseover", '[data-hover="tooltip"]', function (t) {
            v(e(t.currentTarget))
        }).on("mouseleave", '[data-hover="tooltip"]', function () {
            m()
        }).on("pagechanged", function () {
            c()
        }), l()
    }, e(document).ready(function () {
        new n
    })
}(jQuery), define("bootstrap/my-tooltip", function () {
}), define("bootstrap/my-toast", ["jquery"], function () {
    function o(e, t, n) {
        return b({type: r.error, iconClass: w().iconClasses.error, message: e, optionsOverride: n, title: t})
    }

    function u(t, n) {
        return t || (t = w()), e = $("#" + t.containerId), e.length ? e : (n && (e = m(t)), e)
    }

    function a(e, t, n) {
        return b({type: r.info, iconClass: w().iconClasses.info, message: e, optionsOverride: n, title: t})
    }

    function f(e) {
        t = e
    }

    function l(e, t, n) {
        return b({type: r.success, iconClass: w().iconClasses.success, message: e, optionsOverride: n, title: t})
    }

    function c(e, t, n) {
        return b({type: r.warning, iconClass: w().iconClasses.warning, message: e, optionsOverride: n, title: t})
    }

    function h(t, n) {
        var r = w();
        e || u(r), v(t, r, n) || d(r)
    }

    function p(t) {
        var n = w();
        e || u(n);
        if (t && $(":focus", t).length === 0) {
            E(t);
            return
        }
        e.children().length && e.remove()
    }

    function d(t) {
        var n = e.children();
        for (var r = n.length - 1; r >= 0; r--)v($(n[r]), t)
    }

    function v(e, t, n) {
        var r = n && n.force ? n.force : !1;
        return e && (r || $(":focus", e).length === 0) ? (e[t.hideMethod]({
            duration: t.hideDuration,
            easing: t.hideEasing,
            complete: function () {
                E(e)
            }
        }), !0) : !1
    }

    function m(t) {
        return e = $("<div/>").attr("id", t.containerId).addClass(t.positionClass).attr("aria-live", "polite").attr("role", "alert"), e.appendTo($(t.target)), e
    }

    function g() {
        return {
            tapToDismiss: !0,
            toastClass: "toast",
            containerId: "toast-container",
            debug: !1,
            showMethod: "fadeIn",
            showDuration: 300,
            showEasing: "swing",
            onShown: undefined,
            hideMethod: "fadeOut",
            hideDuration: 1e3,
            hideEasing: "swing",
            onHidden: undefined,
            closeMethod: !1,
            closeDuration: !1,
            closeEasing: !1,
            extendedTimeOut: 1e3,
            iconClasses: {error: "toast-error", info: "toast-info", success: "toast-success", warning: "toast-warning"},
            iconClass: "toast-info",
            positionClass: "toast-top-right",
            timeOut: 5e3,
            titleClass: "toast-title",
            messageClass: "toast-message",
            escapeHtml: !1,
            target: "body",
            closeHtml: '<button type="button">&times;</button>',
            newestOnTop: !0,
            preventDuplicates: !1,
            progressBar: !1
        }
    }

    function y(e) {
        if (!t)return;
        t(e)
    }

    function b(t) {
        function v(e) {
            return e == null && (e = ""), (new String(e)).replace(/&/g, "&amp;").replace(/"/g, "&quot;").replace(/'/g, "&#39;").replace(/</g, "&lt;").replace(/>/g, "&gt;")
        }

        function m() {
            S(), T(), N(), C(), k(), x()
        }

        function g() {
            a.hover(M, O), !r.onclick && r.tapToDismiss && a.click(A), r.closeButton && h && h.click(function (e) {
                e.stopPropagation ? e.stopPropagation() : e.cancelBubble !== undefined && e.cancelBubble !== !0 && (e.cancelBubble = !0), A(!0)
            }), r.onclick && a.click(function (e) {
                r.onclick(e), A()
            })
        }

        function b() {
            a.hide(), a[r.showMethod]({
                duration: r.showDuration,
                easing: r.showEasing,
                complete: r.onShown
            }), r.timeOut > 0 && (o = setTimeout(A, r.timeOut), p.maxHideTime = parseFloat(r.timeOut), p.hideEta = (new Date).getTime() + p.maxHideTime, r.progressBar && (p.intervalId = setInterval(_, 10)))
        }

        function S() {
            t.iconClass && a.addClass(r.toastClass).addClass(i)
        }

        function x() {
            r.newestOnTop ? e.prepend(a) : e.append(a)
        }

        function T() {
            t.title && (f.append(r.escapeHtml ? v(t.title) : t.title).addClass(r.titleClass), a.append(f))
        }

        function N() {
            t.message && (l.append(r.escapeHtml ? v(t.message) : t.message).addClass(r.messageClass), a.append(l))
        }

        function C() {
            r.closeButton && (h.addClass("toast-close-button").attr("role", "button"), a.prepend(h))
        }

        function k() {
            r.progressBar && (c.addClass("toast-progress"), a.prepend(c))
        }

        function L(e, t) {
            if (e.preventDuplicates) {
                if (t.message === s)return !0;
                s = t.message
            }
            return !1
        }

        function A(e) {
            var t = e && r.closeMethod !== !1 ? r.closeMethod : r.hideMethod, n = e && r.closeDuration !== !1 ? r.closeDuration : r.hideDuration, i = e && r.closeEasing !== !1 ? r.closeEasing : r.hideEasing;
            if ($(":focus", a).length && !e)return;
            return clearTimeout(p.intervalId), a[t]({
                duration: n, easing: i, complete: function () {
                    E(a), r.onHidden && d.state !== "hidden" && r.onHidden(), d.state = "hidden", d.endTime = new Date, y(d)
                }
            })
        }

        function O() {
            if (r.timeOut > 0 || r.extendedTimeOut > 0)o = setTimeout(A, r.extendedTimeOut), p.maxHideTime = parseFloat(r.extendedTimeOut), p.hideEta = (new Date).getTime() + p.maxHideTime
        }

        function M() {
            clearTimeout(o), p.hideEta = 0, a.stop(!0, !0)[r.showMethod]({
                duration: r.showDuration,
                easing: r.showEasing
            })
        }

        function _() {
            var e = (p.hideEta - (new Date).getTime()) / p.maxHideTime * 100;
            c.width(e + "%")
        }

        var r = w(), i = t.iconClass || r.iconClass;
        typeof t.optionsOverride != "undefined" && (r = $.extend(r, t.optionsOverride), i = t.optionsOverride.iconClass || i);
        if (L(r, t))return;
        n++, e = u(r, !0);
        var o = null, a = $("<div/>"), f = $("<div/>"), l = $("<div/>"), c = $("<div/>"), h = $(r.closeHtml), p = {
            intervalId: null,
            hideEta: null,
            maxHideTime: null
        }, d = {toastId: n, state: "visible", startTime: new Date, options: r, map: t};
        return m(), b(), g(), y(d), r.debug && console && console.log(d), a
    }

    function w() {
        return $.extend({}, g(), i.options)
    }

    function E(t) {
        e || (e = u());
        if (t.is(":visible"))return;
        t.remove(), t = null, e.children().length === 0 && (e.remove(), s = undefined)
    }

    var e, t, n = 0, r = {error: "error", info: "info", success: "success", warning: "warning"}, i = {
        clear: h,
        remove: p,
        error: o,
        getContainer: u,
        info: a,
        options: {},
        subscribe: f,
        success: l,
        version: "2.1.2",
        warning: c
    }, s;
    window.Toast = i
}), function (e, t) {
    var n = !1, r = '[data-hover="card"]', i, s = {
        timeoutOpen: 1e3,
        timeoutClose: 250,
        enabledAdmin: !1
    }, o = '<div class="cardhover-dialog hidden"><div class="cardhover-overlay"><div class="cardhover-stageout"><div class="cardhover-stagein"><div class="cardhover-content"></div></div></div><div class="cardhover-tailer"><div></div></div></div></div>';
    i = function (i) {
        function w(e) {
            g = e;
            if (f)try {
                window.clearTimeout(f)
            } catch (t) {
            }
            if (a)try {
                window.clearTimeout(a)
            } catch (t) {
            }
            f = 0, a = 0, e == 0 && (h = "", f = window.setTimeout(S, l.timeoutClose))
        }

        function E() {
            var e = "cardhover/" + h.replace("@", "/");
            K.ajax(e, {cardInfo: h}).complete(N).done(k).error(C), T()
        }

        function S() {
            if (!y)return;
            y.addClass("hidden"), m = !1
        }

        function x() {
            if (a)try {
                window.clearTimeout(a)
            } catch (e) {
            }
            if (f)try {
                window.clearTimeout(f)
            } catch (e) {
            }
            a = 0, f = 0, y.addClass("hidden"), m = !1
        }

        function T() {
            if (f)try {
                window.clearTimeout(f)
            } catch (e) {
            }
            f = 0, b.html('<div class="cardhover-content">Loading...</div>'), A(1)
        }

        function N() {
        }

        function C() {
            x()
        }

        function k(e) {
            if (t.isEmpty(e) || t.isEmpty(e.cardInfo) || t.isEmpty(e.html) || e.cardInfo != h)return S(), !1;
            A(), b.html(e.html), y.removeClass("hidden")
        }

        function L(e, t, n) {
            c = t, h = n;
            if (a)try {
                window.clearTimeout(a)
            } catch (r) {
            }
            v = !1, p = e.clientX, d = e.clientY, a = window.setTimeout(E, l.timeoutOpen)
        }

        function A(t) {
            m = !0;
            if (!c)return;
            var n = c.offset(), r = {left: 0, top: 0}, i = {
                width: c.width(),
                height: c.height()
            }, s = e(window).width();
            d > 280 ? (r.top = n.top, y.removeClass("down").addClass("up")) : (r.top = n.top + i.height, y.removeClass("up").addClass("down")), document.dir == "ltr" ? s - p > 350 ? (y.removeClass("left").addClass("right"), r.left = i.width > 200 ? p : n.left) : (y.removeClass("right").addClass("left"), r.left = i.width > 200 ? p : n.left + i.width) : p < 310 ? (r.left = i.width > 200 ? p : n.left, y.removeClass("left").addClass("right")) : (r.left = i.width > 200 ? p : n.left + i.width, y.removeClass("right").addClass("left")), y.css(r), t && y.removeClass("hidden")
        }

        function O() {
            y = e(t.template(o)()).appendTo("body"), b = e(".cardhover-content", y), y.on("mouseover", function () {
                w(1)
            }).on("mouseout", function () {
                w(0)
            })
        }

        function M() {
            O()
        }

        var u = {}, a = 0, f = 0, l = e.extend(s, i), c = !1, h = "", p = 0, d = 0, v = !1, m = !1, g = !1, y, b;
        return n && console.log("Init cardhover"), this.clearCache = function (e) {
            u.hasOwnProperty(e) && delete u[e]
        }, e(document).on("mouseout", r, function () {
            w(0)
        }), e(document).on("pagechanged", function () {
            x()
        }), e(document).on("mouseover", r, function (t) {
            var n = e(t.currentTarget), r = n.data("card");
            if (!r)return;
            if (!/^\d+@\w+$/.test(r))return;
            L(t, n, r)
        }), e(document).ready(function () {
            M()
        }), this
    }, window.CardHover = new i({})
}(jQuery, _), define("bootstrap/cardhover", function () {
}), function (e, t) {
    var n, r = !1, i = '<div id="hyves-dialog" class="hyves-dialog"><div class="hyves-overlay" /><div class="hyves-stageout"><div class="hyves-stagein"></div></div></div>';
    n = function () {
        this.element = null
    }, n.prototype.make = function () {
        return this.element = e(t.template(i)()).appendTo("body"), this.element.find(".hyves-overlay").on("click", e.proxy(this.destroy, this)), this
    }, n.prototype.create = function (t) {
        return r && console.log("Destroy Hyves Dialog"), this.make(), this.element.find(".hyves-stagein:first").html(t), e(document).on("closehyves", e.proxy(this.destroy, this)).on("pagechanged", e.proxy(this.destroy, this)).on("click", '[data-toggle="btn-hyves-close"]', e.proxy(this.destroy, this)), this
    }, n.prototype.show = function () {
        return r && console.log("Show Hyves Dialog"), this.element.find(".hyves-body").not(".hyves-body-full").css({maxHeight: Math.ceil(e(window).height() - 200)}), this.element.find(".paging").not("paging-full").css({maxHeight: Math.ceil(e(window).height() - 200)}), this.element.bootInit(), e("body").addClass("hyves-open"), this
    }, n.prototype.hide = function () {
        return r && console.log("Hide Hyves Dialog"), e("body").removeClass("hyves-open"), this
    }, n.prototype.destroy = function () {
        return this.element ? (r && console.log("Destroy Hyves Dialog"), e("body").removeClass("hyves-open"), this.element.remove(), this.element = !1, this) : this
    }, e(document).on("click", '[data-toggle="hyves"]', function () {
        var t = e(this);
        K.modal(t.data("remote") || t.data("url"))
    }), window.Hyves = new n
}(jQuery, _), define("bootstrap/hyves", function () {
}), function (e) {
    var t = !1;
    e(document).on("submit", "[async]", function (n) {
        n.preventDefault();
        var r = e(this), i = r.serializeJSON(), s = r.data("action"), o = {directive: "close"}, u = {};
        t && console.log("post data url ", s, i), K.ajax(s, i).always(function () {
            t && console.log(arguments)
        }).done(function (t) {
            u = e.extend({}, o, t);
            switch (u.directive) {
                case"close":
                    K.closeModal();
                    break;
                case"update":
                    r.closest(".hyves-stagein").html(t.html).bootInit();
                    break;
                case"reload":
                    K.closeModal(), window.location.reload()
            }
        })
    })
}(jQuery), define("bootstrap/ajaxform", function () {
}), function (e) {
    e.fn.eid = function (t) {
        return /undefined/i.test(typeof t) && (t = "e"), e(this).prop("id") || e(this).prop("id", K.newId(t, 8)), e(this).prop("id")
    }
}(jQuery), function (e) {
    var t = !1, n = "scrollToTop", r = function (n) {
        var r = n, i = 300, s = 200;
        t && console.log("_ScrollToTop.construct"), r.on("click", function () {
            e("html, body").animate({scrollTop: 0}, s)
        }), e(window).on("scroll", function () {
            e(this).scrollTop() > i ? r.addClass("in") : r.removeClass("in")
        })
    };
    e.fn.scrollToTop = function () {
        var t = e(this), i;
        return i = t.data(n), i || t.data(n, i = new r(t)), i
    }
}(jQuery), define("bootstrap/utils", function () {
}), +function (e) {
    "use strict";
    function t(n, r) {
        this.$body = e(document.body), this.$scrollElement = e(n).is(document.body) ? e(window) : e(n), this.options = e.extend({}, t.DEFAULTS, r), this.selector = (this.options.target || "") + " .nav li > a", this.offsets = [], this.targets = [], this.activeTarget = null, this.scrollHeight = 0, this.$scrollElement.on("scroll.bs.scrollspy", e.proxy(this.process, this)), this.refresh(), this.process()
    }

    function n(n) {
        return this.each(function () {
            var r = e(this), i = r.data("bs.scrollspy"), s = typeof n == "object" && n;
            i || r.data("bs.scrollspy", i = new t(this, s)), typeof n == "string" && i[n]()
        })
    }

    t.VERSION = "3.3.4", t.DEFAULTS = {offset: 10}, t.prototype.getScrollHeight = function () {
        return this.$scrollElement[0].scrollHeight || Math.max(this.$body[0].scrollHeight, document.documentElement.scrollHeight)
    }, t.prototype.refresh = function () {
        var t = this, n = "offset", r = 0;
        this.offsets = [], this.targets = [], this.scrollHeight = this.getScrollHeight(), e.isWindow(this.$scrollElement[0]) || (n = "position", r = this.$scrollElement.scrollTop()), this.$body.find(this.selector).map(function () {
            var t = e(this), i = t.data("target") || t.attr("href"), s = /^#./.test(i) && e(i);
            return s && s.length && s.is(":visible") && [[s[n]().top + r, i]] || null
        }).sort(function (e, t) {
            return e[0] - t[0]
        }).each(function () {
            t.offsets.push(this[0]), t.targets.push(this[1])
        })
    }, t.prototype.process = function () {
        var e = this.$scrollElement.scrollTop() + this.options.offset, t = this.getScrollHeight(), n = this.options.offset + t - this.$scrollElement.height(), r = this.offsets, i = this.targets, s = this.activeTarget, o;
        this.scrollHeight != t && this.refresh();
        if (e >= n)return s != (o = i[i.length - 1]) && this.activate(o);
        if (s && e < r[0])return this.activeTarget = null, this.clear();
        for (o = r.length; o--;)s != i[o] && e >= r[o] && (r[o + 1] === undefined || e < r[o + 1]) && this.activate(i[o])
    }, t.prototype.activate = function (t) {
        this.activeTarget = t, this.clear();
        var n = this.selector + '[data-target="' + t + '"],' + this.selector + '[href="' + t + '"]', r = e(n).parents("li").addClass("active");
        r.parent(".dropdown-menu").length && (r = r.closest("li.dropdown").addClass("active")), r.trigger("activate.bs.scrollspy")
    }, t.prototype.clear = function () {
        e(this.selector).parentsUntil(this.options.target, ".active").removeClass("active")
    };
    var r = e.fn.scrollspy;
    e.fn.scrollspy = n, e.fn.scrollspy.Constructor = t, e.fn.scrollspy.noConflict = function () {
        return e.fn.scrollspy = r, this
    }, e(window).on("load.bs.scrollspy.data-api", function () {
        e('[data-spy="scroll"]').each(function () {
            var t = e(this);
            n.call(t, t.data())
        })
    })
}(jQuery), define("bootstrap/scrollspy", function () {
}), +function (e) {
    "use strict";
    function n(n) {
        return this.each(function () {
            var r = e(this), i = r.data("bs.tab");
            i || r.data("bs.tab", i = new t(this)), typeof n == "string" && i[n]()
        })
    }

    var t = function (t) {
        this.element = e(t)
    };
    t.VERSION = "3.3.4", t.TRANSITION_DURATION = 150, t.prototype.show = function () {
        var t = this.element, n = t.closest("ul:not(.dropdown-menu)"), r = t.data("target");
        r || (r = t.attr("href"), r = r && r.replace(/.*(?=#[^\s]*$)/, ""));
        if (t.parent("li").hasClass("active"))return;
        var i = n.find(".active:last a"), s = e.Event("hide.bs.tab", {relatedTarget: t[0]}), o = e.Event("show.bs.tab", {relatedTarget: i[0]});
        i.trigger(s), t.trigger(o);
        if (o.isDefaultPrevented() || s.isDefaultPrevented())return;
        var u = e(r);
        this.activate(t.closest("li"), n), this.activate(u, u.parent(), function () {
            i.trigger({type: "hidden.bs.tab", relatedTarget: t[0]}), t.trigger({
                type: "shown.bs.tab",
                relatedTarget: i[0]
            })
        })
    }, t.prototype.activate = function (n, r, i) {
        function u() {
            s.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !1), n.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded", !0), o ? (n[0].offsetWidth, n.addClass("in")) : n.removeClass("fade"), n.parent(".dropdown-menu").length && n.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !0), i && i()
        }

        var s = r.find("> .active"), o = i && e.support.transition && (s.length && s.hasClass("fade") || !!r.find("> .fade").length);
        s.length && o ? s.one("bsTransitionEnd", u).emulateTransitionEnd(t.TRANSITION_DURATION) : u(), s.removeClass("in")
    };
    var r = e.fn.tab;
    e.fn.tab = n, e.fn.tab.Constructor = t, e.fn.tab.noConflict = function () {
        return e.fn.tab = r, this
    };
    var i = function (t) {
        t.preventDefault(), n.call(e(this), "show")
    };
    e(document).on("click.bs.tab.data-api", '[data-toggle="tab"]', i).on("click.bs.tab.data-api", '[data-toggle="pill"]', i)
}(jQuery), define("bootstrap/tab", function () {
}), +function (e) {
    "use strict";
    function t() {
        var e = document.createElement("bootstrap"), t = {
            WebkitTransition: "webkitTransitionEnd",
            MozTransition: "transitionend",
            OTransition: "oTransitionEnd otransitionend",
            transition: "transitionend"
        };
        for (var n in t)if (e.style[n] !== undefined)return {end: t[n]};
        return !1
    }

    e.fn.emulateTransitionEnd = function (t) {
        var n = !1, r = this;
        e(this).one("bsTransitionEnd", function () {
            n = !0
        });
        var i = function () {
            n || e(r).trigger(e.support.transition.end)
        };
        return setTimeout(i, t), this
    }, e(function () {
        e.support.transition = t();
        if (!e.support.transition)return;
        e.event.special.bsTransitionEnd = {
            bindType: e.support.transition.end,
            delegateType: e.support.transition.end,
            handle: function (t) {
                if (e(t.target).is(this))return t.handleObj.handler.apply(this, arguments)
            }
        }
    })
}(jQuery), define("bootstrap/transition", function () {
}), require(["bootstrap/affix", "bootstrap/alert", "bootstrap/button", "bootstrap/dropdown", "bootstrap/collapse", "bootstrap/options", "bootstrap/paging", "bootstrap/pushstate", "bootstrap/my-tooltip", "bootstrap/my-toast", "bootstrap/cardhover", "bootstrap/hyves", "bootstrap/ajaxform", "bootstrap/utils", "bootstrap/scrollspy", "bootstrap/tab", "bootstrap/transition"], function () {
}), define("bootstrap/main", function () {
}), function (e) {
    var t = !0, n = "commentComposer", r = "textarea.mentions-input", i = "ajax/comment/comment/add", s, o = {};
    s = function (s, u) {
        function c(n) {
            t && (console.log("clean data of status form"), console.log("feed result", n)), e(f).length && e(f).trigger("loadnew"), typeof a != "undefined" && (e(n.html).insertBefore(a.closest(".fs-cmf-ow")), a.trigger("clean"), a.find("textarea").val(""), e("textarea.mentions-input", a).mentionsInput("reset"))
        }

        function h() {
            m()
        }

        function p() {
            alert("Sorry, your request could not be completed")
        }

        function d() {
            var t = e.extend({}, a.serializeJSON(), {fromComment: 1});
            e(r, a).mentionsInput("val", function (e) {
                t.commentTxt = e
            }), v(), K.ajax(i, t).always(h).done(c).fail(p)
        }

        function v() {
            e(".fc-header-ow .ajax-indicator", a).addClass("loading")
        }

        function m() {
            e(".fc-header-ow .ajax-indicator", a).removeClass("loading")
        }

        var a = e(s), f = a.data("target"), l = e.extend({}, o, u);
        e(r, a).mentionsInput({}), a.on("onLoading:start", function () {
            v()
        }).on("onLoading:done", function () {
            m()
        }).on("clean", function () {
            e(".fc-att-row", a).addClass("hidden")
        }).on("submit", function (e) {
            e.preventDefault(), d()
        }).on("clearBootInit", function () {
            a.data(n, !1)
        }), a.data("link") && a.linkComposer()
    }, e.fn.commentComposer = function () {
        return this.each(function () {
            return e.data(this, n) || e.data(this, n, new s(this, e.data(this, "composer")))
        })
    }, e(document).on("focus", '[data-toggle="comment-box"]', function (t) {
        e(t.currentTarget).closest("form").commentComposer({})
    })
}(jQuery), function (e) {
    e(document).on("click", '[data-toggle="comment-remove"]', function () {
        var t = e(this), n = t.data("object"), r = t.data("eid"), i = e(r).closest(".cmt-item");
        if (!K.authRequired())return;
        i.animate({opacity: 0}, 500, function () {
            i.addClass("hidden")
        }), t.prop("disabled"), K.ajax("ajax/comment/comment/remove", n).always(function () {
            t.prop("disabled", !1)
        }).done(function (e) {
            e.code != 200 && i.removeClass("hidden").animate({opacity: 1})
        })
    }), e(document).on("click", '[data-toggle="comment-edit"]', function () {
        var t = e(this), n = t.data(), r = t.data("eid");
        if (!K.authRequired())return;
        K.ajax("ajax/comment/comment/inline-edit", n).done(function () {
        })
    }), e(document).on("click", '[data-toggle="btn-comment"]', function (t) {
        var n = e(t.target), r = n.closest(".feed-item"), i = r.find(".fs-cmf-ow");
        if (!K.authRequired())return;
        i.removeClass("hidden"), i.find(".fc-mention-input").focus()
    }), e(document).on("click", '[data-toggle="comment-more"]', function (t) {
        function l(t) {
            if (t.html == "")n.closest("div").addClass("hidden"); else {
                e(t.html).insertBefore(e(".cmt-item:first", s));
                var r = t.commentCount, i = e(".cmt-item", s).length, o = e(t.cmds);
                e(".counter", o).text(i), r == i && n.closest("div").addClass("hidden"), u.html(o)
            }
        }

        function c() {
            n.data("loading", !1)
        }

        var n = e(this), r = n.data("loading"), i = n.data("object"), s = n.closest(".card-footer"), o = s.find(".cmt-item"), u = n.closest("div"), a = [];
        if (r)return;
        o.each(function (t, n) {
            var r = e(n).data("id");
            /undefined/.test(r) || a.push(r)
        });
        var f = e.extend({}, i, {excludes: a});
        n.data("loading", !0), K.ajax("ajax/comment/comment/view-more", f).done(l).complete(c).error()
    })
}(jQuery), define("base/comment/comment", function () {
}), require(["base/comment/comment"], function () {
}), define("base/comment/main", function () {
}), require([], function () {
}), define("base/layout/main", function () {
}), function (e) {
    var t = !1, n = "feedComposer", r = "textarea.mentions-input", i = "ajax/feed/feed/post", s, o = {};
    s = function (s) {
        function a(n) {
            t && (console.log("clean data of status form"), console.log("feed result", n)), e(u).length && e(u).trigger("loadnew"), typeof o != "undefined" && (o.trigger("clean"), e("textarea.mentions-input", o).mentionsInput("reset"))
        }

        function f() {
            p()
        }

        function l() {
            alert("Sorry, your request could not be completed")
        }

        function c() {
            var t = e.extend({}, o.serializeJSON(), {fromComposer: 1});
            e(r, o).mentionsInput("val", function (e) {
                t.statusTxt = e
            });
            if (_.isEmpty(t.statusTxt)) {
                alert("Add your status");
                return
            }
            h(), K.ajax(i, t).always(f).done(a).fail(l)
        }

        function h() {
            e(".fc-header-ow .ajax-indicator", o).addClass("loading")
        }

        function p() {
            e(".fc-header-ow .ajax-indicator", o).removeClass("loading")
        }

        var o = e(s), u = o.data("target");
        e(r, o).mentionsInput({}), o.on("onLoading:start", function () {
            h()
        }).on("onLoading:done", function () {
            p()
        }).on("clean", function () {
            e(".fc-att-row", o).addClass("hidden")
        }).on("submit", function (e) {
            e.preventDefault(), c()
        }).on("clearBootInit", function () {
            o.data(n, !1)
        }), o.data("link") && o.linkComposer()
    }, e.fn.feedComposer = function () {
        return this.each(function () {
            return e.data(this, n) || e.data(this, n, new s(this, e.data(this, "composer")))
        })
    }, e(document).on("click", '[data-toggle="fc-btn-submit"]', function () {
        e(this).closest("form").trigger("submit")
    })
}(jQuery), define("base/feed/composer.status", function () {
}), function (e) {
    var t = !1;
    e(document).on("click", '[data-toggle="btn-follow"]', function (t) {
        var n = e(this), r = n.data("object"), i = n.hasClass("btn") ? "btn" : "menu";
        if (n.prop("disabled"))return;
        n.prop("disabled", !0), r.ctx = i, K.ajax("ajax/follow/follow/toggle", r).done(function (e) {
            n.closest(".btn-follow").replaceWith(e.html)
        }).always(function () {
            n.prop("disabled", !1)
        })
    }), e(document).on("click", '[data-toggle="btn-block"]', function (t) {
        var n = e(this), r = e.extend({}, n.data("object"), {ctx: n.hasClass("btn") ? "btn" : "menu"});
        n.prop("disabled", !1), K.ajax("ajax/core/block/toggle", r).done(function (e) {
            n.closest(".btn-blocking").replaceWith(e.html)
        }).always(function () {
            n.prop("disabled", !1)
        })
    }), e(document).on("click", '[data-toggle="btn-remove-blocking"]', function (n) {
        var r = e(n.currentTarget), i = r.data("object");
        K.ajax("ajax/core/block/remove", i).done(function (e) {
            t && console.log(e)
        })
    })
}(window.jQuery), function (e) {
    var t = !0;
    e(document).on("click", '[data-toggle="fc-btn-location"]', function (t) {
        var n = e(t.currentTarget), r = n.closest("form");
        r.find(".fc-att-location").removeClass("hidden"), r.find(".fc-att-people").addClass("hidden"), r.find(".fc-att-location-input").focus()
    }), e(document).on("click", '[data-toggle="fc-btn-people"]', function (t) {
        var n = e(t.currentTarget), r = n.closest("form");
        r.find(".fc-att-people").removeClass("hidden"), r.find(".fc-att-location").addClass("hidden"), r.find(".fc-att-people-input").focus()
    }), e(document).on("click", '[data-toggle="fc-ph-people"]', function (t) {
        var n = e(t.currentTarget);
        n.find(".fc-att-people-input").focus()
    }), e(document).on("click", '[data-toggle="fc-btn-photo"]', function () {
        var n = e(this), r = n.closest("form"), i = n.data("target");
        t && console.log(i, e(i, r), this), r.find(".fc-att-row").addClass("hidden"), r.find(".fc-att-photo").removeClass("hidden"), e(i, r).trigger("click")
    }), e(document).on("focus", '[data-toggle="placeinput"]', function (t) {
        var n = e(t.currentTarget);
        n.data("placeinput") || n.data("placeinput", new PlaceInput(n))
    }), e(document).on("focus", '[data-toggle="tag-people"]', function (t) {
        var n = e(t.currentTarget);
        if (n.data("tagsinput", !1))return !1;
        n.data("tagsinput", new TagsInput(n, {}))
    }), e(document).on("click", '[data-toggle="btn-feed-loadmore"]', function (t) {
        e(t.currentTarget).closest(".feed-stream").trigger("loadmore")
    }), e(document).on("click", '[data-toggle="btn-remove-feed"]', function (t) {
        var n = e(t.currentTarget), r = n.closest(".fs-ow"), i = n.data("object");
        r.hide(), K.ajax("ajax/feed/feed/remove", i).done(function (e) {
        })
    }), e(document).on("click", '[data-toggle="feed-remove"]', function (n) {
        var r = e(n.currentTarget), i = r.data("object"), s = e(i.eid).closest(".card-feed");
        t && console.log(s), s.animate({opacity: 0}, 500, function () {
            s.hide()
        }), K.ajax("ajax/feed/feed/remove", i).done(function (e) {
        })
    }), e(document).on("click", '[data-toggle="feed-open-privacy"]', function (t) {
        var n = e(t.currentTarget), r = n.data("object"), i = e(r.eid).closest(".card-feed").find(".privacy-label:first");
        i.length && i.trigger("click")
    }), e(document).on("click", '[data-toggle="link-toggle-follow"]', function (n) {
        var r = e(n.currentTarget), i = r.data("object");
        n.preventDefault();
        if (r.prop("disabled"))return;
        r.prop("disabled", !0), K.ajax("ajax/follow/follow/link-toggle", i).always(function () {
            r.prop("disabled", !1)
        }).done(function (e) {
            t && console.log(e), r.html(e.html)
        })
    }), e(document).on("click", '[data-toggle="feed-hide"]', function (n) {
        var r = e(n.currentTarget), i = r.data("object"), s = e(i.eid).closest(".card-feed");
        s.animate({opacity: 0}, 500, function () {
            s.hide()
        });
        if (r.prop("disabled"))return;
        r.prop("disabled", !0), K.ajax("ajax/feed/feed/toggle-hidden", i).always(function () {
            r.prop("disabled", !1)
        }).done(function (e) {
            t && console.log(e), r.html(e.html)
        })
    }), e(document).on("click", '[data-toggle="feed-hide-timeline"]', function (n) {
        var r = e(n.currentTarget), i = r.data("object"), s = e(i.eid).closest(".card-feed");
        s.animate({opacity: 0}, 500, function () {
            s.hide()
        });
        if (r.prop("disabled"))return;
        r.prop("disabled", !0), K.ajax("ajax/feed/feed/toggle-hide-timeline", i).always(function () {
            r.prop("disabled", !1)
        }).done(function (e) {
            t && console.log(e), r.html(e.html)
        })
    }), e(document).on("click", '[data-toggle="feed-edit-submit"]', function (n) {
        var r = e(this), i = r.closest("form"), s = i.serializeJSON(), o = i.closest(".fs-story-ow");
        if (i.prop("disabled"))return;
        e(".mentions-input", i).mentionsInput("val", function (e) {
            s.statusTxt = e
        }), t && console.log(s), i.prop("disabled", !0), K.ajax("ajax/feed/feed/save-inline-edit", s).always(function () {
            i.prop("disabled", !1)
        }).done(function (e) {
            t && console.log(e), o.html(e.html)
        })
    }), e(document).on("click", '[data-toggle="feed-edit-cancel"]', function (n) {
        var r = e(this), i = r.closest("form"), s = i.serializeJSON(), o = i.closest(".fs-story-ow");
        t && console.log(s);
        if (i.prop("disabled"))return;
        i.prop("disabled", !0), K.ajax("ajax/feed/feed/cancel-inline-edit", s).always(function () {
            i.prop("disabled", !1)
        }).done(function (e) {
            t && console.log(e), o.html(e.html)
        })
    }), e(document).on("click", '[data-toggle="feed-subscribe"]', function (n) {
        var r = e(n.currentTarget), i = r.data("object");
        if (r.prop("disabled"))return;
        r.prop("disabled", !0), n.preventDefault(), K.ajax("ajax/feed/feed/toggle-subscribe", i).always(function () {
            r.prop("disabled", !1)
        }).done(function (e) {
            t && console.log(e), r.html(e.html)
        })
    }), e(document).on("click", '[data-toggle="feed-edit"]', function (t) {
        var n = e(t.currentTarget), r = n.data("object"), i = '[data-feedid="' + r.id + '"]', s = e(i).find(".fs-story-ow");
        s.length || (s = e('<div class="fs-story-ow">').insertAfter(e(i).find(".fs-headline-ow"))), K.ajax("ajax/feed/feed/edit-inline", r).done(function (e) {
            s.html(e.html).removeClass("hidden").find("textarea").mentionsInput({})
        })
    })
}(jQuery, _), define("base/feed/feed", function () {
}), define("base/feed/main", ["base/feed/composer.status", "base/feed/feed"], function () {
}), require([], function () {
}), define("base/group/main", function () {
}), function (e) {
    var t, n = !0, r = '[data-toggle="spotlight"]';
    t = function () {
        function p() {
            if (n)return;
            n = e('<div class="spotlight-dialog"/>', {"class": "spotlight-dialog"}).appendTo("body"), i = e('<div class="spotlight-overlay"/>').appendTo(n), s = e('<div class="spotlight-stageout" />').appendTo(n), o = e('<div class="spotlight-stagein" />').appendTo(s), u = e('<div class="spotlight-content" />').appendTo(o), i.on("click", function () {
                m()
            })
        }

        function d() {
            n.removeClass("hidden"), a = !0
        }

        function v() {
        }

        function m() {
            if (!n)return;
            n.addClass("hidden"), u.html(""), a = !1
        }

        function g(t) {
            var n = e(t.html);
            y(t.image, n), u.css({width: f.width, height: f.height}), u.html(n)
        }

        function y(t, n) {
            var r = e(window), i = {width: r.width(), height: r.height()}, s = {
                width: t.width,
                height: t.height
            }, o = {
                width: i.width - h * 2 - c,
                height: i.height - h * 2
            }, u = Math.min(o.width / s.width, o.height / s.height);
            f = {
                width: i.width - h * 2,
                height: i.height - h * 2
            }, console.log("ratio", u), s.width = Math.floor(u * s.width), s.height = Math.floor(u * s.height), console.log("imageSize", s), console.log("contentSize", f), n.find(".spotlight-left").css({
                width: f.width - c + "px",
                lineHeight: f.height + "px"
            }), n.find(".spotlight-stage-ow").css({}), n.find(".spotlight-photo").css({
                width: s.width - 2,
                height: s.height - 2
            }), n.css({width: f.width})
        }

        function b() {
        }

        function w() {
        }

        function E(t) {
            l = t, e.getJSON(t, {mode: "spotlight"}).done(g).complete(b).error(w)
        }

        function S(e) {
            p(), d(), E(e)
        }

        var t = {id: 0, parentType: "album", parentId: 0}, n = !1, i, s, o, u, a = !1, f = {
            width: 0,
            height: 0
        }, l, c = 360, h = 20;
        this.hideDialog = function () {
            v()
        }, this.closeDialog = function () {
            m()
        }, e(document).on("pagechanged", function () {
            m()
        }).on("click", '[data-toggle="spotlight-hide"]', function () {
            v()
        }).on("click", '[data-toggle="spotlight-close"]', function () {
            m()
        }).on("click", r, function (t) {
            var n = e(t.currentTarget), r = n.prop("href");
            t.preventDefault(), window.screen.width < 700 ? fetchPage(r) : S(r)
        })
    }, window.SpotLight = new t
}(jQuery), define("base/photo/spotlight", function () {
}), function (e) {
    var t, n = !1, r, i = "ajaxUploadHandler", s = '<div class="photo-upload-item-ow" id="<%= id %>"><div class="upload-preview-stage"><span class="preview"></span><div class="progress-bar"></div></div></div>', o = '<input type="hidden" name="photoTemp[]" class="hidden" value="<%= value %>"/>';
    _Submit = function (t) {
        var r = e(t), i = r.data("url"), s = r.serializeJSON();
        n && console.log(s), K.ajax(i, s).done(function (t) {
            r.trigger("postSuccess", t), Hyves.destroy(), /feed/i.test(t.context) && e(".feed-stream").trigger("loadnew")
        }).always(function () {
            r.trigger("postComplete")
        }).fail(function () {
            r.trigger("postError")
        })
    }, t = function (t) {
        var r = K.getUrl(t.data("url"), {}), u = t.data("modal"), a = t.data("more");
        t.on("clearBootInit", function () {
            t.data(i, !1)
        }), t.data("upload", new PhotosUpload(t, {
            url: r, fileName: "fileUpload", onQueue: function (e) {
                a ? e.processQueue() : K.modal(u, {}).done(function () {
                    window.setTimeout(function () {
                        e.processQueue()
                    }, 200)
                })
            }, onBeforeUpload: function (n) {
                e(_.template(s)({id: n}))[a ? "prependTo" : "appendTo"](t.data("preview"))
            }, onUploadProgress: function (t, n, r, i) {
                e(".progress-bar", "#" + t).css({width: r + "%"})
            }, onUploadSuccess: function (t, r, i, s) {
                var u = e("#" + t);
                e(".progress-bar", "#" + t).remove(), n && console.log(i), i.id && (u.find(".preview").css({"background-image": "url(" + i.url + ")"}), e(_.template(o)({value: i.id})).appendTo(u))
            }
        }))
    }, _AjaxUploadMoreHandler = function (t) {
        var r = K.getUrl(t.data("url"), {}), u = t.data("modal");
        t.on("clearBootInit", function () {
            t.data(i, !1)
        }), t.data("upload", new PhotosUpload(t, {
            url: r, fileName: "fileUpload", onQueue: function (e) {
                K.modal(u, {}).done(function () {
                    window.setTimeout(function () {
                        e.processQueue()
                    }, 1e3)
                })
            }, onBeforeUpload: function (n) {
                e(_.template(s)({id: n})).appendTo(t.data("preview"))
            }, onUploadProgress: function (e, t, r, i) {
                n && console.log({eid: e, pos: t, percentage: r, input: i})
            }, onUploadSuccess: function (t, r, i, s) {
                var u = e("#" + t);
                n && console.log(i), i.id && (u.find(".preview").css({"background-image": "url(" + i.url + ")"}), e(_.template(o)({value: i.id})).appendTo(u))
            }
        }))
    }, e.fn.ajaxUploadHandler = function () {
        this.each(function () {
            var n = e(this);
            return n.data(i) || n.data(i, new t(n))
        })
    }, e(document).on("click", '[data-toggle="btn-album-upload"]', function (t) {
        var n = e(t.currentTarget), r = e(n.data("target"));
        r.trigger("click")
    }).on("click", '[data-toggle="btn-album-switch-mode"]', function (t) {
        var n = e(t.currentTarget), r = e(".photo-album-switch-form"), i = e('[name="new_album"]', r);
        r.hasClass("mode1") ? (n.data("mode", "0").find(".text").text(n.data("label0")), r.removeClass("mode0").addClass("mode1"), i.val("0")) : (n.data("mode", "1").find(".text").text(n.data("label1")), r.removeClass("mode0").addClass("mode1"), i.val("1"))
    })
}(jQuery), define("base/photo/uploader", function () {
}), function (e, t) {
    var n, r = !0, i = "photoComposer", s = '<div class="fc-att-photo-item-ow" id="<%= id %>"><div class="upload-preview-stage"><span class="preview"></span><div class="progress-bar"></div></div></div>', o = '<input type="hidden" name="photoTemp[]" class="hidden" value="<%= value %>"/>';
    n = function (n) {
        var u = K.getUrl(n.data("url"), {}), a = n.closest("form").find(n.data("preview"));
        n.closest("form").on("clean", function () {
            a.find(".fc-att-photo-item-ow").remove()
        }), n.on("clearBootInit", function () {
            n.data(i, !1)
        }), n.data("upload", new PhotosUpload(n, {
            url: u, fileName: "fileUpload", onQueue: function (e) {
                e.processQueue()
            }, onBeforeUpload: function (n) {
                e(t.template(s)({id: n})).appendTo(a)
            }, onUploadProgress: function (t, n, r) {
                e(".progress-bar", "#" + t).css({width: r + "%"})
            }, onUploadSuccess: function (n, i, s, u) {
                var f = e("#" + n, a);
                e(".progress-bar", "#" + n).remove(), r && console.log(s), s.id && (f.find(".preview").css({"background-image": "url(" + s.url + ")"}), e(t.template(o)({value: s.id})).appendTo(f))
            }
        }))
    }, e.fn.photoComposer = function () {
        this.each(function () {
            var t = e(this);
            return t.data(i) || t.data(i, new n(t))
        })
    }
}(jQuery, _), define("base/photo/composer", function () {
}), function (e) {
    e(document).on("click", '[data-toggle="photo-make-album-cover"]', function () {
        var t = e(this), n = t.data("object");
        K.ajax("ajax/photo/photo/make-album-cover", n).done(function (e) {
            e.message && Toast.success(e.message)
        })
    }), e(document).on("click", '[data-toggle="photo-delete"]', function () {
        var t = e(this), n = t.data("object"), r = t.data("eid"), i = e(r).closest(".card-wrap");
        i.animate({opacity: 0}, 200, function () {
            i.remove()
        }), K.ajax("ajax/photo/photo/delete-photo", n).done(function (e) {
            e.message && Toast.success(e.message)
        })
    }), e(document).on("click", '[data-toggle="photo-make-profile-photo"]', function () {
        var t = e(this).data("object");
        K.modal("ajax/photo/avatar/edit-avatar-dialog", t)
    })
}(jQuery), define("base/photo/photo", function () {
}), define("base/photo/main", ["base/photo/spotlight", "base/photo/uploader", "base/photo/composer", "base/photo/photo"], function () {
    (function (e) {
        var t = !0;
        e(document).on("click", '[data-toggle="field-avatar-crop"]', function () {
            var n = e(this), r = n.closest("form"), i = r.serializeJSON().cropit, s = e(".field-preview-img"), o = e(".hidden.avatar-value"), u = r.closest(".hyves-dialog").length > 0, a = i.options.split(","), f = s.parent().width() * 1 / parseInt(a[2]);
            t && console.log(u, i), o.val(JSON.stringify(i)), s.attr({
                width: Math.floor(a[0] * f),
                height: Math.floor(a[1] * f),
                src: i.url
            }).css({
                left: Math.floor(a[4] * f * -1),
                top: Math.floor(a[5] * f * -1),
                position: "absolute"
            }), u && K.closeModal()
        }), e(document).on("click", '[data-toggle="field-avatar-upload"]', function () {
            var n = e(this), r = e(n.data("target")), i = K.getUrl("ajax/photo/upload/temp", {}), s = "ajax/photo/field-avatar/dialog", o = ".cropit-container";
            requirejs(["primary/jquery.cropit"], function () {
            }), r.data("upload") || r.data("upload", new PhotosUpload(r, {
                url: i,
                fileName: "fileUpload",
                onQueue: function (e) {
                    K.modal(s, {}).done(function () {
                        window.setTimeout(function () {
                            e.processQueue()
                        }, 200)
                    })
                },
                onUploadProgress: function (e, n, r, i) {
                    t && console.log({eid: e, pos: n, percentage: r, input: i})
                },
                onUploadSuccess: function (t, n, r) {
                    e(o).data("src", r.url), e(".cropit_temp_id", o).val(r.id), e(".cropit_url", o).val(r.url), new CropIt(o)
                }
            })), r.trigger("click")
        }), e(document).on("click", '[data-toggle="tl-avatar-upload"]', function () {
            var n = e(this), r = e(n.data("target")), i = K.getUrl("ajax/photo/upload/temp", {}), s = "ajax/photo/avatar/edit-avatar-dialog", o = ".cropit-container";
            requirejs(["primary/jquery.cropit"], function () {
            }), r.data("upload") || r.data("upload", new PhotosUpload(r, {
                url: i,
                fileName: "fileUpload",
                onQueue: function (e) {
                    K.modal(s, {}).done(function () {
                        window.setTimeout(function () {
                            e.processQueue()
                        }, 200)
                    })
                },
                onUploadProgress: function (e, n, r, i) {
                    t && console.log({eid: e, pos: n, percentage: r, input: i})
                },
                onUploadSuccess: function (t, n, r) {
                    e(o).data("src", r.url), e(".cropit_temp_id", o).val(r.id), e(".cropit_url", o).val(r.url), new CropIt(o)
                }
            })), r.trigger("click")
        })
    })(jQuery, _)
}), require([], function () {
}), define("base/event/main", function () {
}), require([], function () {
}),define("base/search/main", function () {
}),require(["base/share/main"], function () {
}),define("base/share/main", function () {
}),require(["base/share/main"], function () {
}),define("base/mail/main", function () {
}),require(["base/share/main"], function () {
}),define("base/help/main", function () {
}),function (e) {
    var t = !0;
    e(document).on("click", '[data-toggle="btn-option-privacy"]', function (n) {
        var r = e(n.currentTarget), i = e(r.data("eid")), s = r.data("privacy"), o = i.data("object"), u = e.extend({}, o, {
            privacy: {
                type: s.type,
                value: s.value
            }
        });
        if (!i.length)return;
        t && (console.log("update privacy value for button"), console.log(s)), i.length && (i.find("span.text").text(s.label), i.find("input.privacy-value").val(s.value), i.find("input.privacy-type").val(s.type)), K.ajax("ajax/relation/privacy/change-default", u).done(function (e) {
            console.log(e)
        })
    }), e(document).on("click", '[data-toggle="btn-edit-option-privacy"]', function (n) {
        var r = e(n.currentTarget), i = e(r.data("eid")), s = r.data("privacy"), o = i.data("object"), u = e.extend({}, o, {
            privacy: {
                type: s.type,
                value: s.value,
                eid: r.data("eid")
            }
        });
        if (!i.length)return;
        t && (console.log("update privacy value for button"), console.log(s)), i.prop("disabled", !0), K.ajax("ajax/relation/privacy/update-privacy", u).always(function () {
            i.prop("disabled", !1)
        }).done(function (e) {
            i.replaceWith(e.html)
        })
    })
}(window.jQuery),define("base/relation/privacy", function () {
}),require(["base/relation/privacy"], function () {
}),define("base/relation/main", function () {
}),function (e, t) {
    e(document).on("click", '[data-toggle="btn-report"]', function () {
        var n = e(this), r = n.data("object");
        t.isEmpty(r) ? K.modal("ajax/report/general-report/dialog", r) : K.modal("ajax/report/report/dialog", r)
    })
}(jQuery, _),define("base/report/report", function () {
}),require(["base/report/report"], function () {
}),define("base/report/main", function () {
}),function (e) {
    e(document).on("click", '[data-toggle="btn-like"]', function (t) {
        function s(e) {
            n.text(e.label), i.length && (e.hasSample ? i.find(".fs-like-sample").html(e.sample).removeClass("hidden") : i.find(".fs-like-sample").addClass("hidden"))
        }

        var n = e(t.currentTarget), r = n.data("object"), i = n.closest(".card-feed");
        if (!K.authRequired())return;
        K.ajax("ajax/like/like/toggle", r).done(s)
    }), e(document).on("click", '[data-toggle="like-comment-toggle"]', function () {
        function i(e) {
            t.text(e.label), r.length && (e.sample != "" ? (r.find(".cmt-like-samples-ow").removeClass("hidden"), r.find(".cmt-like-samples").html(e.sample)) : (r.find(".cmt-like-samples-ow").addClass("hidden"), r.find(".cmt-like-samples").html(e.sample)))
        }

        var t = e(this), n = t.data("object"), r = t.closest(".fs-cm-asset");
        if (!K.authRequired())return;
        K.ajax("ajax/like/like/toggle", n).done(i)
    }), e(document).on("click", '[data-toggle="membership-like-toggle"]', function (t) {
        function s(t) {
            i ? e(i).replaceWith(t.html) : n.replaceWith(t.html)
        }

        var n = e(t.currentTarget), r = n.data("object"), i = n.data("eid");
        if (!K.authRequired())return;
        K.ajax("ajax/like/like/membership-like-toggle", r).done(s)
    })
}(jQuery),define("base/like/like", function () {
}),require(["base/like/like"], function () {
}),define("base/like/main", function () {
}),require([], function () {
}),define("base/follow/main", function () {
}),require([], function () {
}),define("base/review/main", function () {
}),define("base/notification/main", [], function () {
}),require([], function () {
}),define("base/invitation/main", function () {
}),function (e, t) {
    var n, r = "linkComposer";
    n = function (n) {
        function a() {
            s = !1, o = !1, u = [], e(".composer-preview-link", i).remove()
        }

        function f(e) {
            if (o)return;
            e.code == 200 && (o = !0, i.find(".fc-att-ow").append(e.html))
        }

        function l() {
            console.log("Could not parse url ")
        }

        function c() {
            s = !1, i.trigger("onLoading:done")
        }

        function h(e) {
            if (s)return;
            s = !0, e = e.trim(), u.push(e), i.trigger("onLoading:start"), K.ajax("ajax/core/link/composer-preview", {url: e}).done(f).error().complete(c)
        }

        var i = e(n), s = !1, o = !1, u = [];
        i.on("onLinkAttatch", function (e, n) {
            if (s)return;
            if (o)return;
            var r = !1;
            for (var i in n.links) {
                var a = n.links[i].trim();
                if (0 == t.contains(u, a)) {
                    r = a;
                    break
                }
            }
            r && h(r)
        }), i.on("onRemoveAttachment", function () {
            a()
        }).on("clean", function () {
            a()
        }).on("clearBootInit", function () {
            i.data(r, !1)
        })
    }, e(document).on("click", '[data-toggle="fc-attatch-remove"]', function (t) {
        var n = e(t.currentTarget);
        n.closest("form").trigger("onRemoveAttachment")
    }), e(document).on("click", '[data-toggle="fc-attatch-as-link"]', function (t) {
        var n = e(t.currentTarget), r = n.closest(".composer-preview-link");
        r.hasClass("as-video") ? (r.removeClass("as-video").addClass("as-link"), e(".attachment-type", r).val("link"), n.text(n.data("label2"))) : (r.removeClass("as-link").addClass("as-video"), n.text(n.data("label1")), e(".attachment-type", r).val("video"))
    }), e.fn.linkComposer = function () {
        this.data(r) || this.data(r, new n(this))
    }
}(jQuery, _),define("base/link/composer", function () {
}),define("base/link/main", ["base/link/composer"], function () {
}),function (e) {
    var t, n;
    t = function () {
        this.chatList = []
    }, n = {
        open: '[data-toggle="btn-open-chat"]',
        close: '[data-toggle="btn-chat-conf-close"]'
    }, e(document).on("click", n.open, function (t) {
        var n = e(t.currentTarget), r = n.data("object");
        K.ajax("ajax/message/chat/open", r).complete().done(function (t) {
            e("#docklet-ow").prepend(t.html)
        }).error()
    }), e(document).on("click", n.close, function (t) {
        var n = e(t.currentTarget);
        n.closest(".chat-popup").remove()
    }), window.Chat = new t
}(jQuery),define("base/message/chat", function () {
}),define("base/message/main", ["base/message/chat"], function () {
}),requirejs(["primary/main", "base/core/main", "bootstrap/main", "base/comment/main", "base/layout/main", "base/feed/main", "base/group/main", "base/photo/main", "base/event/main", "base/search/main", "base/mail/main", "base/help/main", "base/relation/main", "base/report/main", "base/like/main", "base/share/main", "base/follow/main", "base/review/main", "base/notification/main", "base/invitation/main", "base/link/main", "base/message/main"], function () {
}),define("jsmain", function () {
});