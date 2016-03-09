FSS = {
    FRONT: 0,
    BACK: 1,
    DOUBLE: 2,
    SVGNS: "http://www.w3.org/2000/svg"
};
FSS.Array = "function" === typeof Float32Array ? Float32Array : Array;
FSS.Utils = {
    isNumber: function(b) {
        return !isNaN(parseFloat(b)) && isFinite(b)
    }
};
(function() {
    for (var b = 0, c = ["ms", "moz", "webkit", "o"], l = 0; l < c.length && !window.requestAnimationFrame; ++l) window.requestAnimationFrame = window[c[l] + "RequestAnimationFrame"], window.cancelAnimationFrame = window[c[l] + "CancelAnimationFrame"] || window[c[l] + "CancelRequestAnimationFrame"];
    window.requestAnimationFrame || (window.requestAnimationFrame = function(c, l) {
        var n = (new Date).getTime(),
            t = Math.max(0, 16 - (n - b)),
            k = window.setTimeout(function() {
                c(n + t)
            }, t);
        b = n + t;
        return k
    });
    window.cancelAnimationFrame || (window.cancelAnimationFrame = function(b) {
        clearTimeout(b)
    })
})();
Math.PIM2 = 2 * Math.PI;
Math.PID2 = Math.PI / 2;
Math.randomInRange = function(b, c) {
    return b + (c - b) * Math.random()
};
Math.clamp = function(b, c, l) {
    b = Math.max(b, c);
    return b = Math.min(b, l)
};
FSS.Vector3 = {
    create: function(b, c, l) {
        var h = new FSS.Array(3);
        this.set(h, b, c, l);
        return h
    },
    clone: function(b) {
        var c = this.create();
        this.copy(c, b);
        return c
    },
    set: function(b, c, l, h) {
        b[0] = c || 0;
        b[1] = l || 0;
        b[2] = h || 0;
        return this
    },
    setX: function(b, c) {
        b[0] = c || 0;
        return this
    },
    setY: function(b, c) {
        b[1] = c || 0;
        return this
    },
    setZ: function(b, c) {
        b[2] = c || 0;
        return this
    },
    copy: function(b, c) {
        b[0] = c[0];
        b[1] = c[1];
        b[2] = c[2];
        return this
    },
    add: function(b, c) {
        b[0] += c[0];
        b[1] += c[1];
        b[2] += c[2];
        return this
    },
    addVectors: function(b, c, l) {
        b[0] = c[0] +
            l[0];
        b[1] = c[1] + l[1];
        b[2] = c[2] + l[2];
        return this
    },
    addScalar: function(b, c) {
        b[0] += c;
        b[1] += c;
        b[2] += c;
        return this
    },
    subtract: function(b, c) {
        b[0] -= c[0];
        b[1] -= c[1];
        b[2] -= c[2];
        return this
    },
    subtractVectors: function(b, c, l) {
        b[0] = c[0] - l[0];
        b[1] = c[1] - l[1];
        b[2] = c[2] - l[2];
        return this
    },
    subtractScalar: function(b, c) {
        b[0] -= c;
        b[1] -= c;
        b[2] -= c;
        return this
    },
    multiply: function(b, c) {
        b[0] *= c[0];
        b[1] *= c[1];
        b[2] *= c[2];
        return this
    },
    multiplyVectors: function(b, c, l) {
        b[0] = c[0] * l[0];
        b[1] = c[1] * l[1];
        b[2] = c[2] * l[2];
        return this
    },
    multiplyScalar: function(b, c) {
        b[0] *= c;
        b[1] *= c;
        b[2] *= c;
        return this
    },
    divide: function(b, c) {
        b[0] /= c[0];
        b[1] /= c[1];
        b[2] /= c[2];
        return this
    },
    divideVectors: function(b, c, l) {
        b[0] = c[0] / l[0];
        b[1] = c[1] / l[1];
        b[2] = c[2] / l[2];
        return this
    },
    divideScalar: function(b, c) {
        0 !== c ? (b[0] /= c, b[1] /= c, b[2] /= c) : (b[0] = 0, b[1] = 0, b[2] = 0);
        return this
    },
    cross: function(b, c) {
        var l = b[0],
            h = b[1],
            p = b[2];
        b[0] = h * c[2] - p * c[1];
        b[1] = p * c[0] - l * c[2];
        b[2] = l * c[1] - h * c[0];
        return this
    },
    crossVectors: function(b, c, l) {
        b[0] = c[1] * l[2] - c[2] * l[1];
        b[1] = c[2] * l[0] - c[0] * l[2];
        b[2] = c[0] * l[1] - c[1] * l[0];
        return this
    },
    min: function(b, c) {
        b[0] < c && (b[0] = c);
        b[1] < c && (b[1] = c);
        b[2] < c && (b[2] = c);
        return this
    },
    max: function(b, c) {
        b[0] > c && (b[0] = c);
        b[1] > c && (b[1] = c);
        b[2] > c && (b[2] = c);
        return this
    },
    clamp: function(b, c, l) {
        this.min(b, c);
        this.max(b, l);
        return this
    },
    limit: function(b, c, l) {
        var h = this.length(b);
        null !== c && h < c ? this.setLength(b, c) : null !== l && h > l && this.setLength(b, l);
        return this
    },
    dot: function(b, c) {
        return b[0] * c[0] + b[1] * c[1] + b[2] * c[2]
    },
    normalise: function(b) {
        return this.divideScalar(b, this.length(b))
    },
    negate: function(b) {
        return this.multiplyScalar(b, -1)
    },
    distanceSquared: function(b, c) {
        var l = b[0] - c[0],
            h = b[1] - c[1],
            p = b[2] - c[2];
        return l * l + h * h + p * p
    },
    distance: function(b, c) {
        return Math.sqrt(this.distanceSquared(b, c))
    },
    lengthSquared: function(b) {
        return b[0] * b[0] + b[1] * b[1] + b[2] * b[2]
    },
    length: function(b) {
        return Math.sqrt(this.lengthSquared(b))
    },
    setLength: function(b, c) {
        var l = this.length(b);
        0 !== l && c !== l && this.multiplyScalar(b, c / l);
        return this
    }
};
FSS.Vector4 = {
    create: function(b, c, l, h) {
        h = new FSS.Array(4);
        this.set(h, b, c, l);
        return h
    },
    set: function(b, c, l, h, p) {
        b[0] = c || 0;
        b[1] = l || 0;
        b[2] = h || 0;
        b[3] = p || 0;
        return this
    },
    setX: function(b, c) {
        b[0] = c || 0;
        return this
    },
    setY: function(b, c) {
        b[1] = c || 0;
        return this
    },
    setZ: function(b, c) {
        b[2] = c || 0;
        return this
    },
    setW: function(b, c) {
        b[3] = c || 0;
        return this
    },
    add: function(b, c) {
        b[0] += c[0];
        b[1] += c[1];
        b[2] += c[2];
        b[3] += c[3];
        return this
    },
    multiplyVectors: function(b, c, l) {
        b[0] = c[0] * l[0];
        b[1] = c[1] * l[1];
        b[2] = c[2] * l[2];
        b[3] = c[3] * l[3];
        return this
    },
    multiplyScalar: function(b, c) {
        b[0] *= c;
        b[1] *= c;
        b[2] *= c;
        b[3] *= c;
        return this
    },
    min: function(b, c) {
        b[0] < c && (b[0] = c);
        b[1] < c && (b[1] = c);
        b[2] < c && (b[2] = c);
        b[3] < c && (b[3] = c);
        return this
    },
    max: function(b, c) {
        b[0] > c && (b[0] = c);
        b[1] > c && (b[1] = c);
        b[2] > c && (b[2] = c);
        b[3] > c && (b[3] = c);
        return this
    },
    clamp: function(b, c, l) {
        this.min(b, c);
        this.max(b, l);
        return this
    }
};
FSS.Color = function(b, c) {
    this.rgba = FSS.Vector4.create();
    this.hex = b || "#000000";
    this.opacity = FSS.Utils.isNumber(c) ? c : 1;
    this.set(this.hex, this.opacity)
};
FSS.Color.prototype = {
    set: function(b, c) {
        b = b.replace("#", "");
        var l = b.length / 3;
        this.rgba[0] = parseInt(b.substring(0 * l, 1 * l), 16) / 255;
        this.rgba[1] = parseInt(b.substring(1 * l, 2 * l), 16) / 255;
        this.rgba[2] = parseInt(b.substring(2 * l, 3 * l), 16) / 255;
        this.rgba[3] = FSS.Utils.isNumber(c) ? c : this.rgba[3];
        return this
    },
    hexify: function(b) {
        b = Math.ceil(255 * b).toString(16);
        1 === b.length && (b = "0" + b);
        return b
    },
    format: function() {
        var b = this.hexify(this.rgba[0]),
            c = this.hexify(this.rgba[1]),
            l = this.hexify(this.rgba[2]);
        return this.hex = "#" +
            b + c + l
    }
};
FSS.Object = function() {
    this.position = FSS.Vector3.create()
};
FSS.Object.prototype = {
    setPosition: function(b, c, l) {
        FSS.Vector3.set(this.position, b, c, l);
        return this
    }
};
FSS.Light = function(b, c) {
    FSS.Object.call(this);
    this.ambient = new FSS.Color(b || "#FFFFFF");
    this.diffuse = new FSS.Color(c || "#FFFFFF");
    this.ray = FSS.Vector3.create()
};
FSS.Light.prototype = Object.create(FSS.Object.prototype);
FSS.Vertex = function(b, c, l) {
    this.position = FSS.Vector3.create(b, c, l)
};
FSS.Vertex.prototype = {
    setPosition: function(b, c, l) {
        FSS.Vector3.set(this.position, b, c, l);
        return this
    }
};
FSS.Triangle = function(b, c, l) {
    this.a = b || new FSS.Vertex;
    this.b = c || new FSS.Vertex;
    this.c = l || new FSS.Vertex;
    this.vertices = [this.a, this.b, this.c];
    this.u = FSS.Vector3.create();
    this.v = FSS.Vector3.create();
    this.centroid = FSS.Vector3.create();
    this.normal = FSS.Vector3.create();
    this.color = new FSS.Color;
    this.polygon = document.createElementNS(FSS.SVGNS, "polygon");
    this.polygon.setAttributeNS(null, "stroke-linejoin", "round");
    this.polygon.setAttributeNS(null, "stroke-miterlimit", "1");
    this.polygon.setAttributeNS(null, "stroke-width", "1");
    this.computeCentroid();
    this.computeNormal()
};
FSS.Triangle.prototype = {
    computeCentroid: function() {
        this.centroid[0] = this.a.position[0] + this.b.position[0] + this.c.position[0];
        this.centroid[1] = this.a.position[1] + this.b.position[1] + this.c.position[1];
        this.centroid[2] = this.a.position[2] + this.b.position[2] + this.c.position[2];
        FSS.Vector3.divideScalar(this.centroid, 3);
        return this
    },
    computeNormal: function() {
        FSS.Vector3.subtractVectors(this.u, this.b.position, this.a.position);
        FSS.Vector3.subtractVectors(this.v, this.c.position, this.a.position);
        FSS.Vector3.crossVectors(this.normal, this.u, this.v);
        FSS.Vector3.normalise(this.normal);
        return this
    }
};
FSS.Geometry = function() {
    this.vertices = [];
    this.triangles = [];
    this.dirty = !1
};
FSS.Geometry.prototype = {
    update: function() {
        if (this.dirty) {
            var b, c;
            for (b = this.triangles.length - 1; 0 <= b; b--) c = this.triangles[b], c.computeCentroid(), c.computeNormal();
            this.dirty = !1
        }
        return this
    }
};
FSS.Plane = function(b, c, l, h) {
    FSS.Geometry.call(this);
    this.width = b || 100;
    this.height = c || 100;
    this.segments = l || 4;
    this.slices = h || 4;
    this.segmentWidth = this.width / this.segments;
    this.sliceHeight = this.height / this.slices;
    var p, n, t;
    l = [];
    p = -.5 * this.width;
    n = .5 * this.height;
    for (b = 0; b <= this.segments; b++)
        for (l.push([]), c = 0; c <= this.slices; c++) h = new FSS.Vertex(p + b * this.segmentWidth, n - c * this.sliceHeight), l[b].push(h), this.vertices.push(h);
    for (b = 0; b < this.segments; b++)
        for (c = 0; c < this.slices; c++) h = l[b + 0][c + 0], p = l[b + 0][c + 1], n = l[b + 1][c + 0], t = l[b + 1][c + 1], t0 = new FSS.Triangle(h, p, n), t1 = new FSS.Triangle(n, p, t), this.triangles.push(t0, t1)
};
FSS.Plane.prototype = Object.create(FSS.Geometry.prototype);
FSS.Material = function(b, c) {
    this.ambient = new FSS.Color(b || "#444444");
    this.diffuse = new FSS.Color(c || "#FFFFFF");
    this.slave = new FSS.Color
};
FSS.Mesh = function(b, c) {
    FSS.Object.call(this);
    this.geometry = b || new FSS.Geometry;
    this.material = c || new FSS.Material;
    this.side = FSS.FRONT;
    this.visible = !0
};
FSS.Mesh.prototype = Object.create(FSS.Object.prototype);
FSS.Mesh.prototype.update = function(b, c) {
    var l, h, p, n, t;
    this.geometry.update();
    if (c)
        for (l = this.geometry.triangles.length - 1; 0 <= l; l--) {
            h = this.geometry.triangles[l];
            FSS.Vector4.set(h.color.rgba);
            for (p = b.length - 1; 0 <= p; p--) n = b[p], FSS.Vector3.subtractVectors(n.ray, n.position, h.centroid), FSS.Vector3.normalise(n.ray), t = FSS.Vector3.dot(h.normal, n.ray), this.side === FSS.FRONT ? t = Math.max(t, 0) : this.side === FSS.BACK ? t = Math.abs(Math.min(t, 0)) : this.side === FSS.DOUBLE && (t = Math.max(Math.abs(t), 0)), FSS.Vector4.multiplyVectors(this.material.slave.rgba, this.material.ambient.rgba, n.ambient.rgba), FSS.Vector4.add(h.color.rgba, this.material.slave.rgba), FSS.Vector4.multiplyVectors(this.material.slave.rgba, this.material.diffuse.rgba, n.diffuse.rgba), FSS.Vector4.multiplyScalar(this.material.slave.rgba, t), FSS.Vector4.add(h.color.rgba, this.material.slave.rgba);
            FSS.Vector4.clamp(h.color.rgba, 0, 1)
        }
    return this
};
FSS.Scene = function() {
    this.meshes = [];
    this.lights = []
};
FSS.Scene.prototype = {
    add: function(b) {
        b instanceof FSS.Mesh && !~this.meshes.indexOf(b) ? this.meshes.push(b) : b instanceof FSS.Light && !~this.lights.indexOf(b) && this.lights.push(b);
        return this
    },
    remove: function(b) {
        b instanceof FSS.Mesh && ~this.meshes.indexOf(b) ? this.meshes.splice(this.meshes.indexOf(b), 1) : b instanceof FSS.Light && ~this.lights.indexOf(b) && this.lights.splice(this.lights.indexOf(b), 1);
        return this
    }
};
FSS.Renderer = function() {
    this.halfHeight = this.halfWidth = this.height = this.width = 0
};
FSS.Renderer.prototype = {
    setSize: function(b, c) {
        if (this.width !== b || this.height !== c) return this.width = b, this.height = c, this.halfWidth = .5 * this.width, this.halfHeight = .5 * this.height, this
    },
    clear: function() {
        return this
    },
    render: function(b) {
        return this
    }
};
FSS.CanvasRenderer = function() {
    FSS.Renderer.call(this);
    this.element = document.createElement("canvas");
    this.element.style.display = "block";
    this.context = this.element.getContext("2d");
    this.setSize(this.element.width, this.element.height)
};
FSS.CanvasRenderer.prototype = Object.create(FSS.Renderer.prototype);
FSS.CanvasRenderer.prototype.setSize = function(b, c) {
    FSS.Renderer.prototype.setSize.call(this, b, c);
    this.element.width = b;
    this.element.height = c;
    this.context.setTransform(1, 0, 0, -1, this.halfWidth, this.halfHeight);
    return this
};
FSS.CanvasRenderer.prototype.clear = function() {
    FSS.Renderer.prototype.clear.call(this);
    this.context.clearRect(-this.halfWidth, -this.halfHeight, this.width, this.height);
    return this
};
FSS.CanvasRenderer.prototype.render = function(b) {
    FSS.Renderer.prototype.render.call(this, b);
    var c, l, h, p, n;
    this.clear();
    this.context.lineJoin = "round";
    this.context.lineWidth = 1;
    for (c = b.meshes.length - 1; 0 <= c; c--)
        if (l = b.meshes[c], l.visible)
            for (l.update(b.lights, !0), h = l.geometry.triangles.length - 1; 0 <= h; h--) p = l.geometry.triangles[h], n = p.color.format(), this.context.beginPath(), this.context.moveTo(p.a.position[0], p.a.position[1]), this.context.lineTo(p.b.position[0], p.b.position[1]), this.context.lineTo(p.c.position[0], p.c.position[1]), this.context.closePath(), this.context.strokeStyle = n, this.context.fillStyle = n, this.context.stroke(), this.context.fill();
    return this
};
FSS.WebGLRenderer = function() {
    FSS.Renderer.call(this);
    this.element = document.createElement("canvas");
    this.element.style.display = "block";
    this.lights = this.vertices = null;
    this.gl = this.getContext(this.element, {
        preserveDrawingBuffer: !1,
        premultipliedAlpha: !0,
        antialias: !0,
        stencil: !0,
        alpha: !0
    });
    if (this.unsupported = !this.gl) return "WebGL is not supported by your browser.";
    this.gl.clearColor(0, 0, 0, 0);
    this.gl.enable(this.gl.DEPTH_TEST);
    this.setSize(this.element.width, this.element.height)
};
FSS.WebGLRenderer.prototype = Object.create(FSS.Renderer.prototype);
FSS.WebGLRenderer.prototype.getContext = function(b, c) {
    var l = !1;
    try {
        if (!(l = b.getContext("experimental-webgl", c))) throw "Error creating WebGL context.";
    } catch (h) {
        console.error(h)
    }
    return l
};
FSS.WebGLRenderer.prototype.setSize = function(b, c) {
    FSS.Renderer.prototype.setSize.call(this, b, c);
    if (!this.unsupported) return this.element.width = b, this.element.height = c, this.gl.viewport(0, 0, b, c), this
};
FSS.WebGLRenderer.prototype.clear = function() {
    FSS.Renderer.prototype.clear.call(this);
    if (!this.unsupported) return this.gl.clear(this.gl.COLOR_BUFFER_BIT | this.gl.DEPTH_BUFFER_BIT), this
};
FSS.WebGLRenderer.prototype.render = function(b) {
    FSS.Renderer.prototype.render.call(this, b);
    if (!this.unsupported) {
        var c, l, h, p, n, t, k, m;
        t = !1;
        var r = b.lights.length,
            u, w, B, v = 0;
        this.clear();
        if (this.lights !== r)
            if (this.lights = r, 0 < this.lights) this.buildProgram(r);
            else return;
        if (this.program) {
            for (c = b.meshes.length - 1; 0 <= c; c--) l = b.meshes[c], l.geometry.dirty && (t = !0), l.update(b.lights, !1), v += 3 * l.geometry.triangles.length;
            if (t || this.vertices !== v)
                for (k in this.vertices = v, this.program.attributes) {
                    t = this.program.attributes[k];
                    t.data = new FSS.Array(v * t.size);
                    u = 0;
                    for (c = b.meshes.length - 1; 0 <= c; c--)
                        for (l = b.meshes[c], h = 0, p = l.geometry.triangles.length; h < p; h++)
                            for (n = l.geometry.triangles[h], w = 0, B = n.vertices.length; w < B; w++) {
                                vertex = n.vertices[w];
                                switch (k) {
                                    case "side":
                                        this.setBufferData(u, t, l.side);
                                        break;
                                    case "position":
                                        this.setBufferData(u, t, vertex.position);
                                        break;
                                    case "centroid":
                                        this.setBufferData(u, t, n.centroid);
                                        break;
                                    case "normal":
                                        this.setBufferData(u, t, n.normal);
                                        break;
                                    case "ambient":
                                        this.setBufferData(u, t, l.material.ambient.rgba);
                                        break;
                                    case "diffuse":
                                        this.setBufferData(u, t, l.material.diffuse.rgba)
                                }
                                u++
                            }
                    this.gl.bindBuffer(this.gl.ARRAY_BUFFER, t.buffer);
                    this.gl.bufferData(this.gl.ARRAY_BUFFER, t.data, this.gl.DYNAMIC_DRAW);
                    this.gl.enableVertexAttribArray(t.location);
                    this.gl.vertexAttribPointer(t.location, t.size, this.gl.FLOAT, !1, 0, 0)
                }
            this.setBufferData(0, this.program.uniforms.resolution, [this.width, this.height, this.width]);
            for (t = r - 1; 0 <= t; t--) c = b.lights[t], this.setBufferData(t, this.program.uniforms.lightPosition, c.position), this.setBufferData(t, this.program.uniforms.lightAmbient, c.ambient.rgba), this.setBufferData(t, this.program.uniforms.lightDiffuse, c.diffuse.rgba);
            for (m in this.program.uniforms) switch (t = this.program.uniforms[m], c = t.location, b = t.data, t.structure) {
                case "3f":
                    this.gl.uniform3f(c, b[0], b[1], b[2]);
                    break;
                case "3fv":
                    this.gl.uniform3fv(c, b);
                    break;
                case "4fv":
                    this.gl.uniform4fv(c, b)
            }
        }
        this.gl.drawArrays(this.gl.TRIANGLES, 0, this.vertices);
        return this
    }
};
FSS.WebGLRenderer.prototype.setBufferData = function(b, c, l) {
    if (FSS.Utils.isNumber(l)) c.data[b * c.size] = l;
    else
        for (var h = l.length - 1; 0 <= h; h--) c.data[b * c.size + h] = l[h]
};
FSS.WebGLRenderer.prototype.buildProgram = function(b) {
    if (!this.unsupported) {
        var c = FSS.WebGLRenderer.VS(b),
            l = FSS.WebGLRenderer.FS(b),
            h = c + l;
        if (!this.program || this.program.code !== h) {
            var p = this.gl.createProgram(),
                c = this.buildShader(this.gl.VERTEX_SHADER, c),
                l = this.buildShader(this.gl.FRAGMENT_SHADER, l);
            this.gl.attachShader(p, c);
            this.gl.attachShader(p, l);
            this.gl.linkProgram(p);
            if (!this.gl.getProgramParameter(p, this.gl.LINK_STATUS)) return b = this.gl.getError(), p = this.gl.getProgramParameter(p, this.gl.VALIDATE_STATUS), console.error("Could not initialise shader.\nVALIDATE_STATUS: " + p + "\nERROR: " + b), null;
            this.gl.deleteShader(l);
            this.gl.deleteShader(c);
            p.code = h;
            p.attributes = {
                side: this.buildBuffer(p, "attribute", "aSide", 1, "f"),
                position: this.buildBuffer(p, "attribute", "aPosition", 3, "v3"),
                centroid: this.buildBuffer(p, "attribute", "aCentroid", 3, "v3"),
                normal: this.buildBuffer(p, "attribute", "aNormal", 3, "v3"),
                ambient: this.buildBuffer(p, "attribute", "aAmbient", 4, "v4"),
                diffuse: this.buildBuffer(p, "attribute", "aDiffuse", 4, "v4")
            };
            p.uniforms = {
                resolution: this.buildBuffer(p, "uniform", "uResolution", 3, "3f", 1),
                lightPosition: this.buildBuffer(p, "uniform", "uLightPosition", 3, "3fv", b),
                lightAmbient: this.buildBuffer(p, "uniform", "uLightAmbient", 4, "4fv", b),
                lightDiffuse: this.buildBuffer(p, "uniform", "uLightDiffuse", 4, "4fv", b)
            };
            this.program = p;
            this.gl.useProgram(this.program);
            return p
        }
    }
};
FSS.WebGLRenderer.prototype.buildShader = function(b, c) {
    if (!this.unsupported) {
        var l = this.gl.createShader(b);
        this.gl.shaderSource(l, c);
        this.gl.compileShader(l);
        return this.gl.getShaderParameter(l, this.gl.COMPILE_STATUS) ? l : (console.error(this.gl.getShaderInfoLog(l)), null)
    }
};
FSS.WebGLRenderer.prototype.buildBuffer = function(b, c, l, h, p, n) {
    p = {
        buffer: this.gl.createBuffer(),
        size: h,
        structure: p,
        data: null
    };
    switch (c) {
        case "attribute":
            p.location = this.gl.getAttribLocation(b, l);
            break;
        case "uniform":
            p.location = this.gl.getUniformLocation(b, l)
    }
    n && (p.data = new FSS.Array(n * h));
    return p
};
FSS.WebGLRenderer.VS = function(b) {
    return ["precision mediump float;", "#define LIGHTS " + b, "attribute float aSide;\nattribute vec3 aPosition;\nattribute vec3 aCentroid;\nattribute vec3 aNormal;\nattribute vec4 aAmbient;\nattribute vec4 aDiffuse;\nuniform vec3 uResolution;\nuniform vec3 uLightPosition[LIGHTS];\nuniform vec4 uLightAmbient[LIGHTS];\nuniform vec4 uLightDiffuse[LIGHTS];\nvarying vec4 vColor;\nvoid main() {\nvColor = vec4(0.0);\nvec3 position = aPosition / uResolution * 2.0;\nfor (int i = 0; i < LIGHTS; i++) {\nvec3 lightPosition = uLightPosition[i];\nvec4 lightAmbient = uLightAmbient[i];\nvec4 lightDiffuse = uLightDiffuse[i];\nvec3 ray = normalize(lightPosition - aCentroid);\nfloat illuminance = dot(aNormal, ray);\nif (aSide == 0.0) {\nilluminance = max(illuminance, 0.0);\n} else if (aSide == 1.0) {\nilluminance = abs(min(illuminance, 0.0));\n} else if (aSide == 2.0) {\nilluminance = max(abs(illuminance), 0.0);\n}\nvColor += aAmbient * lightAmbient;\nvColor += aDiffuse * lightDiffuse * illuminance;\n}\nvColor = clamp(vColor, 0.0, 1.0);\ngl_Position = vec4(position, 1.0);\n}"].join("\n")
};
FSS.WebGLRenderer.FS = function(b) {
    return "precision mediump float;\nvarying vec4 vColor;\nvoid main() {\ngl_FragColor = vColor;\n}"
};
FSS.SVGRenderer = function() {
    FSS.Renderer.call(this);
    this.element = document.createElementNS(FSS.SVGNS, "svg");
    this.element.setAttribute("xmlns", FSS.SVGNS);
    this.element.setAttribute("version", "1.1");
    this.element.style.display = "block";
    this.setSize(300, 150)
};
FSS.SVGRenderer.prototype = Object.create(FSS.Renderer.prototype);
FSS.SVGRenderer.prototype.setSize = function(b, c) {
    FSS.Renderer.prototype.setSize.call(this, b, c);
    this.element.setAttribute("width", b);
    this.element.setAttribute("height", c);
    return this
};
FSS.SVGRenderer.prototype.clear = function() {
    FSS.Renderer.prototype.clear.call(this);
    for (var b = this.element.childNodes.length - 1; 0 <= b; b--) this.element.removeChild(this.element.childNodes[b]);
    return this
};
FSS.SVGRenderer.prototype.render = function(b) {
    FSS.Renderer.prototype.render.call(this, b);
    var c, l, h, p, n, t;
    for (c = b.meshes.length - 1; 0 <= c; c--)
        if (l = b.meshes[c], l.visible)
            for (l.update(b.lights, !0), h = l.geometry.triangles.length - 1; 0 <= h; h--) p = l.geometry.triangles[h], p.polygon.parentNode !== this.element && this.element.appendChild(p.polygon), n = this.formatPoint(p.a) + " ", n += this.formatPoint(p.b) + " ", n += this.formatPoint(p.c), t = this.formatStyle(p.color.format()), p.polygon.setAttributeNS(null, "points", n), p.polygon.setAttributeNS(null, "style", t);
    return this
};
FSS.SVGRenderer.prototype.formatPoint = function(b) {
    return this.halfWidth + b.position[0] + "," + (this.halfHeight - b.position[1])
};
FSS.SVGRenderer.prototype.formatStyle = function(b) {
    return b = "fill:" + b + ";" + ("stroke:" + b + ";")
};

/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || function() {
    function b() {
        J.remove(x);
        v.clear();
        E = new FSS.Plane(p.width * v.width, p.height * v.height, p.segments, p.slices);
        F = new FSS.Material(p.ambient, p.diffuse);
        x = new FSS.Mesh(E, F);
        J.add(x);
        var b, c;
        for (b = E.vertices.length - 1; 0 <= b; b--) c = E.vertices[b], c.anchor = FSS.Vector3.clone(c.position), c.step = FSS.Vector3.create(Math.randomInRange(.2, 1), Math.randomInRange(.2, 1), Math.randomInRange(.2, 1)), c.time = Math.randomInRange(0, Math.PIM2)
    }

    function c(c, h) {
        v.setSize(c, h);
        FSS.Vector3.set(r, v.halfWidth, v.halfHeight);
        b()
    }

    function l() {
        k = Date.now() - m;
        var b, c, t, v, w, x = p.depth / 2;
        FSS.Vector3.copy(n.bounds, r);
        FSS.Vector3.multiplyScalar(n.bounds, n.xyScalar);
        FSS.Vector3.setZ(u, n.zOffset);
        n.autopilot && (b = Math.sin(n.step[0] * k * n.speed), c = Math.cos(n.step[1] * k * n.speed), FSS.Vector3.set(u, n.bounds[0] * b, n.bounds[1] * c, n.zOffset));
        for (b = J.lights.length - 1; 0 <= b; b--) c = J.lights[b], FSS.Vector3.setZ(c.position, n.zOffset), t = Math.clamp(FSS.Vector3.distanceSquared(c.position, u), n.minDistance, n.maxDistance), t = n.gravity * c.mass / t, FSS.Vector3.subtractVectors(c.force, u, c.position), FSS.Vector3.normalise(c.force), FSS.Vector3.multiplyScalar(c.force, t), FSS.Vector3.set(c.acceleration), FSS.Vector3.add(c.acceleration, c.force), FSS.Vector3.add(c.velocity, c.acceleration), FSS.Vector3.multiplyScalar(c.velocity, n.dampening), FSS.Vector3.limit(c.velocity, n.minLimit, n.maxLimit), FSS.Vector3.add(c.position, c.velocity);
        for (v = E.vertices.length - 1; 0 <= v; v--) w = E.vertices[v], b = Math.sin(w.time + w.step[0] * k * p.speed), c = Math.cos(w.time + w.step[1] * k * p.speed), t = Math.sin(w.time + w.step[2] * k * p.speed), FSS.Vector3.set(w.position, p.xRange * E.segmentWidth * b, p.yRange * E.sliceHeight * c, p.zRange * x * t - x), FSS.Vector3.add(w.position, w.anchor);
        E.dirty = !0;
        h();
        requestAnimationFrame(l)
    }

    function h() {
        v.render(J);
        if (n.draw) {
            var b, c, h, k;
            for (b = J.lights.length - 1; 0 <= b; b--) switch (k = J.lights[b], c = k.position[0], h = k.position[1], t.renderer) {
                case "canvas":
                    v.context.lineWidth = .5;
                    v.context.beginPath();
                    v.context.arc(c, h, 10, 0, Math.PIM2);
                    v.context.strokeStyle = k.ambientHex;
                    v.context.stroke();
                    v.context.beginPath();
                    v.context.arc(c, h, 4, 0, Math.PIM2);
                    v.context.fillStyle = k.diffuseHex;
                    v.context.fill();
                    break;
                case "svg":
                    c += v.halfWidth, h = v.halfHeight - h, k.core.setAttributeNS(null, "fill", k.diffuseHex), k.core.setAttributeNS(null, "cx", c), k.core.setAttributeNS(null, "cy", h), v.element.appendChild(k.core), k.ring.setAttributeNS(null, "stroke", k.ambientHex), k.ring.setAttributeNS(null, "cx", c), k.ring.setAttributeNS(null, "cy", h), v.element.appendChild(k.ring)
            }
        }
    }
    var p = {
            width: 1.8,
            height: 1.8,
            depth: 10,
            segments: 16,
            slices: 8,
            xRange: .8,
            yRange: .1,
            zRange: 1,
            ambient: "#010101",
            diffuse: "#ffffff",
            speed: 6E-4,
            opacity: .5
        },
        n = {
            count: 2,
            xyScalar: 1,
            zOffset: 100,
            ambient: "#ffffff",
            diffuse: "#2d2d2d",
            speed: .001,
            gravity: 800,
            dampening: .95,
            minLimit: 10,
            maxLimit: null,
            minDistance: 20,
            maxDistance: 400,
            autopilot: !1,
            draw: !1,
            bounds: FSS.Vector3.create(),
            step: FSS.Vector3.create(Math.randomInRange(.2, 1), Math.randomInRange(.2, 1), Math.randomInRange(.2, 1))
        },
        t = {
            renderer: "canvas"
        },
        k, m = Date.now(),
        r = FSS.Vector3.create(),
        u = FSS.Vector3.create(),
        w = document.getElementById("container");
    document.getElementById("controls");
    var B = document.getElementById("output");
    document.getElementById("ui");
    var v, J, x, E, F, A, L, M;
    A = new FSS.WebGLRenderer;
    L = new FSS.CanvasRenderer;
    M = new FSS.SVGRenderer;
    (function(b) {
        v && B.removeChild(v.element);
        switch (b) {
            case "webgl":
                v = A;
                break;
            case "canvas":
                v = L;
                break;
            case "svg":
                v = M
        }
        v.setSize(w.offsetWidth, w.offsetHeight);
        B.appendChild(v.element)
    })(t.renderer);
    J = new FSS.Scene;
    b();
    (function() {
        var b, c;
        for (b = J.lights.length -
            1; 0 <= b; b--) c = J.lights[b], J.remove(c);
        v.clear();
        for (b = 0; b < n.count; b++) c = new FSS.Light(n.ambient, n.diffuse), c.ambientHex = c.ambient.format(), c.diffuseHex = c.diffuse.format(), J.add(c), c.mass = Math.randomInRange(.5, 1), c.velocity = FSS.Vector3.create(), c.acceleration = FSS.Vector3.create(), c.force = FSS.Vector3.create(), c.ring = document.createElementNS(FSS.SVGNS, "circle"), c.ring.setAttributeNS(null, "stroke", c.ambientHex), c.ring.setAttributeNS(null, "stroke-width", "0.5"), c.ring.setAttributeNS(null, "fill", "none"), c.ring.setAttributeNS(null, "r", "10"), c.core = document.createElementNS(FSS.SVGNS, "circle"), c.core.setAttributeNS(null, "fill", c.diffuseHex), c.core.setAttributeNS(null, "r", "4")
    })();
    window.addEventListener("resize", function(b) {
        c(w.offsetWidth, w.offsetHeight);
        h()
    });
    w.addEventListener("mousemove", function(b) {
        FSS.Vector3.set(u, b.x, v.height - b.y);
        FSS.Vector3.subtract(u, r)
    });
    c(w.offsetWidth, w.offsetHeight);
    l()
}();
