(function (a, b) {
    'object' == typeof exports && 'undefined' != typeof module ? b(exports) : 'function' == typeof define && define.amd ? define(['exports'], b) : b(a.bulmaToast = {})
})(this, function (a) {
    'use strict';

    function b() {
        g = {
            noticesTopLeft: i.createElement('div'),
            noticesTopRight: i.createElement('div'),
            noticesBottomLeft: i.createElement('div'),
            noticesBottomRight: i.createElement('div'),
            noticesTopCenter: i.createElement('div'),
            noticesBottomCenter: i.createElement('div'),
            noticesCenter: i.createElement('div')
        };
        for (let a in g.noticesTopLeft.setAttribute('style', `${'width:100%;z-index:99999;position:fixed;pointer-events:none;display:flex;flex-direction:column;padding:15px;'}left:0;top:0;text-align:left;align-items:flex-start;`), g.noticesTopRight.setAttribute('style', `${'width:100%;z-index:99999;position:fixed;pointer-events:none;display:flex;flex-direction:column;padding:15px;'}right:0;top:0;text-align:right;align-items:flex-end;`), g.noticesBottomLeft.setAttribute('style', `${'width:100%;z-index:99999;position:fixed;pointer-events:none;display:flex;flex-direction:column;padding:15px;'}left:0;bottom:0;text-align:left;align-items:flex-start;`), g.noticesBottomRight.setAttribute('style', `${'width:100%;z-index:99999;position:fixed;pointer-events:none;display:flex;flex-direction:column;padding:15px;'}right:0;bottom:0;text-align:right;align-items:flex-end;`), g.noticesTopCenter.setAttribute('style', `${'width:100%;z-index:99999;position:fixed;pointer-events:none;display:flex;flex-direction:column;padding:15px;'}top:0;left:0;right:0;text-align:center;align-items:center;`), g.noticesBottomCenter.setAttribute('style', `${'width:100%;z-index:99999;position:fixed;pointer-events:none;display:flex;flex-direction:column;padding:15px;'}bottom:0;left:0;right:0;text-align:center;align-items:center;`), g.noticesCenter.setAttribute('style', `${'width:100%;z-index:99999;position:fixed;pointer-events:none;display:flex;flex-direction:column;padding:15px;'}top:0;left:0;right:0;bottom:0;flex-flow:column;justify-content:center;align-items:center;`), g) i.body.appendChild(g[a]);
        h = {
            "top-left": g.noticesTopLeft,
            "top-right": g.noticesTopRight,
            "top-center": g.noticesTopCenter,
            "bottom-left": g.noticesBottomLeft,
            "bottom-right": g.noticesBottomRight,
            "bottom-center": g.noticesBottomCenter,
            center: g.noticesCenter
        }, f = !0
    }

    function c(a) {
        f || b();
        let c = Object.assign({}, e, a);
        const d = new j(c),
            g = h[c.position] || h[e.position];
        g.appendChild(d.element)
    }

    function d(a) {
        for (let b in g) {
            let a = g[b];
            a.parentNode.removeChild(a)
        }
        i = a, b()
    }
    const e = {
        message: 'Your message here',
        duration: 2e3,
        position: 'top-right',
        closeOnClick: !0,
        opacity: 1
    };
    let f = !1,
        g = {},
        h = {},
        i = document;
    class j {
        constructor(a) {
            this.element = i.createElement('div'), this.opacity = a.opacity, this.type = a.type, this.animate = a.animate, this.dismissible = a.dismissible, this.closeOnClick = a.closeOnClick, this.message = a.message, this.duration = a.duration, this.pauseOnHover = a.pauseOnHover;
            let b = `width:auto;pointer-events:auto;display:inline-flex;opacity:${this.opacity};`,
                c = ['notification'];
            if (this.type && c.push(this.type), this.animate && this.animate.in && (c.push(`animated ${this.animate.in}`), this.onAnimationEnd(() => this.element.classList.remove(this.animate.in))), this.element.className = c.join(' '), this.dismissible) {
                let a = i.createElement('button');
                a.className = 'delete', a.addEventListener('click', () => {
                    this.destroy()
                }), this.element.insertAdjacentElement('afterbegin', a)
            } else b += 'padding: 1.25rem 1.5rem';
            this.closeOnClick && this.element.addEventListener('click', () => {
                this.destroy()
            }), this.element.setAttribute('style', b), 'string' == typeof this.message ? this.element.insertAdjacentHTML('beforeend', this.message) : this.element.appendChild(this.message);
            const d = new k(() => {
                this.destroy()
            }, this.duration);
            this.pauseOnHover && (this.element.addEventListener('mouseover', () => {
                d.pause()
            }), this.element.addEventListener('mouseout', () => {
                d.resume()
            }))
        }
        destroy() {
            this.animate && this.animate.out ? (this.element.classList.add(this.animate.out), this.onAnimationEnd(() => this.removeChild(this.element))) : this.removeChild(this.element)
        }
        removeChild(a) {
            a.parentNode && a.parentNode.removeChild(a)
        }
        onAnimationEnd(a = () => {}) {
            const b = {
                animation: 'animationend',
                OAnimation: 'oAnimationEnd',
                MozAnimation: 'mozAnimationEnd',
                WebkitAnimation: 'webkitAnimationEnd'
            };
            for (const c in b)
                if (this.element.style[c] !== void 0) {
                    this.element.addEventListener(b[c], () => a());
                    break
                }
        }
    }
    class k {
        constructor(a, b) {
            this.timer, this.start, this.remaining = b, this.callback = a, this.resume()
        }
        pause() {
            window.clearTimeout(this.timer), this.remaining -= new Date - this.start
        }
        resume() {
            this.start = new Date, window.clearTimeout(this.timer), this.timer = window.setTimeout(this.callback, this.remaining)
        }
    }
    a.toast = c, a.setDoc = d, Object.defineProperty(a, '__esModule', {
        value: !0
    })
});