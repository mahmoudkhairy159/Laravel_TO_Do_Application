"use strict";
$((function() { const e = $(".select2"),
            t = $(".selectpicker");
        t.length && t.selectpicker(), e.length && e.each((function() { var e = $(this);
            e.wrap('<div class="position-relative"></div>'), e.select2({ placeholder: "Please select an item", dropdownParent: e.parent() }) })) })),
    function() { const e = document.querySelector(".wizard-icons-example"); if (void 0 !== typeof e && null !== e) { const t = [].slice.call(e.querySelectorAll(".btn-next")),
                l = [].slice.call(e.querySelectorAll(".btn-prev")),
                c = e.querySelector(".btn-submit"),
                r = new Stepper(e, { linear: !1 });
            t && t.forEach((e => { e.addEventListener("click", (e => { r.next() })) })), l && l.forEach((e => { e.addEventListener("click", (e => { r.previous() })) })), c && c.addEventListener("click", (e => { alert("Submitted..!!") })) } const t = document.querySelector(".wizard-vertical-icons-example"); if (void 0 !== typeof t && null !== t) { const e = [].slice.call(t.querySelectorAll(".btn-next")),
                l = [].slice.call(t.querySelectorAll(".btn-prev")),
                c = t.querySelector(".btn-submit"),
                r = new Stepper(t, { linear: !1 });
            e && e.forEach((e => { e.addEventListener("click", (e => { r.next() })) })), l && l.forEach((e => { e.addEventListener("click", (e => { r.previous() })) })), c && c.addEventListener("click", (e => { alert("Submitted..!!") })) } const l = document.querySelector(".wizard-modern-icons-example"); if (void 0 !== typeof l && null !== l) { const e = [].slice.call(l.querySelectorAll(".btn-next")),
                t = [].slice.call(l.querySelectorAll(".btn-prev")),
                c = l.querySelector(".btn-submit"),
                r = new Stepper(l, { linear: !1 });
            e && e.forEach((e => { e.addEventListener("click", (e => { r.next() })) })), t && t.forEach((e => { e.addEventListener("click", (e => { r.previous() })) })), c && c.addEventListener("click", (e => { alert("Submitted..!!") })) } const c = document.querySelector(".wizard-modern-vertical-icons-example"); if (void 0 !== typeof c && null !== c) { const e = [].slice.call(c.querySelectorAll(".btn-next")),
                t = [].slice.call(c.querySelectorAll(".btn-prev")),
                l = c.querySelector(".btn-submit"),
                r = new Stepper(c, { linear: !1 });
            e && e.forEach((e => { e.addEventListener("click", (e => { r.next() })) })), t && t.forEach((e => { e.addEventListener("click", (e => { r.previous() })) })), l && l.addEventListener("click", (e => { alert("Submitted..!!") })) } }();