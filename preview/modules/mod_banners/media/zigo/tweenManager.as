class zigo.tweenManager
{
    var playing, autoStop, broadcastEvents, autoOverwrite, ints, lockedTweens, tweenList, updateTime, __get__updateInterval, tweenHolder, __get__controllerDepth, updateIntId, now, __set__controllerDepth, __set__updateInterval;
    function tweenManager()
    {
        playing = false;
        autoStop = false;
        broadcastEvents = false;
        autoOverwrite = true;
        ints = new Array();
        lockedTweens = new Object();
        tweenList = new Array();
    } // End of the function
    function cleanUp()
    {
        if (!(tweenList instanceof Array && tweenList.length > 0))
        {
            return;
        } // end if
        for (var _loc2 in tweenList)
        {
            if (tweenList[_loc2].mc._x == undefined)
            {
                tweenList.splice(Number(_loc2), 1);
            } // end if
        } // end of for...in
        if (tweenList.length == 0)
        {
            tweenList = [];
            this.deinit();
        } // end if
        for (var _loc2 in ints)
        {
            if (ints[_loc2] != undefined && ints[_loc2].mc._x == undefined)
            {
                this.removeDelayedTween(Number(_loc2));
            } // end if
        } // end of for...in
    } // End of the function
    function set updateInterval(time)
    {
        if (playing)
        {
            this.deinit();
            updateTime = time;
            this.init();
        }
        else
        {
            updateTime = time;
        } // end else if
        //return (this.updateInterval());
        null;
    } // End of the function
    function get updateInterval()
    {
        return (updateTime);
    } // End of the function
    function set controllerDepth(v)
    {
        if (_global.isNaN(v) == true)
        {
            return;
        } // end if
        if (tweenHolder._name != undefined)
        {
            tweenHolder.swapDepths(v);
        }
        else
        {
            _th_depth = v;
        } // end else if
        //return (this.controllerDepth());
        null;
    } // End of the function
    function get controllerDepth()
    {
        return (_th_depth);
    } // End of the function
    function init()
    {
        if (updateTime > 0)
        {
            clearInterval(updateIntId);
            updateIntId = setInterval(this, "update", updateTime);
        }
        else
        {
            if (tweenHolder._name == undefined)
            {
                tweenHolder = _root.createEmptyMovieClip("_th_", _th_depth);
            } // end if
            var tm = this;
            tweenHolder.onEnterFrame = function ()
            {
                tm.update.call(tm);
            };
        } // end else if
        playing = true;
        now = getTimer();
    } // End of the function
    function deinit()
    {
        playing = false;
        clearInterval(updateIntId);
        delete tweenHolder.onEnterFrame;
    } // End of the function
    function update()
    {
        var _loc2;
        var _loc10;
        var _loc3;
        var _loc13 = false;
        _loc10 = tweenList.length;
        if (broadcastEvents)
        {
            var _loc4;
            var _loc7;
            var _loc5;
            var _loc9;
            _loc4 = {};
            _loc7 = {};
            _loc5 = {};
            _loc9 = {};
        } // end if
        while (_loc10--)
        {
            _loc2 = tweenList[_loc10];
            if (_loc2.mc._x == undefined)
            {
                _loc13 = true;
                continue;
            } // end if
            if (_loc2.pt != -1)
            {
                continue;
            } // end if
            if (_loc2.ts + _loc2.d > now)
            {
                if (_loc2.ctm == undefined)
                {
                    _loc2.mc[_loc2.pp] = _loc2.ef(now - _loc2.ts, _loc2.ps, _loc2.ch, _loc2.d, _loc2.e1, _loc2.e2);
                }
                else
                {
                    var _loc8 = {};
                    for (var _loc3 in _loc2.ctm)
                    {
                        _loc8[_loc3] = _loc2.ef(now - _loc2.ts, _loc2.stm[_loc3], _loc2.ctm[_loc3], _loc2.d, _loc2.e1, _loc2.e2);
                    } // end of for...in
                    _loc2.c.setTransform(_loc8);
                } // end else if
                if (broadcastEvents)
                {
                    if (_loc4[targetPath(_loc2.mc)] == undefined)
                    {
                        _loc4[targetPath(_loc2.mc)] = _loc2.mc;
                    } // end if
                    if (_loc5[targetPath(_loc2.mc)] == undefined)
                    {
                        _loc5[targetPath(_loc2.mc)] = [];
                    } // end if
                    _loc5[targetPath(_loc2.mc)].push(_loc2.ctm != undefined ? ("_ct_") : (_loc2.pp));
                } // end if
                if (_loc2.cb.updfunc != undefined)
                {
                    var _loc6 = _loc2.cb.updfunc;
                    if (typeof(_loc6) == "string" && _loc2.cb.updscope != undefined)
                    {
                        _loc6 = _loc2.cb.updscope[_loc6];
                    } // end if
                    _loc6.apply(_loc2.cb.updscope, _loc2.cb.updargs);
                } // end if
                continue;
            } // end if
            if (_loc2.ctm == undefined)
            {
                _loc2.mc[_loc2.pp] = _loc2.ps + _loc2.ch;
            }
            else
            {
                _loc8 = {};
                for (var _loc3 in _loc2.ctm)
                {
                    _loc8[_loc3] = _loc2.stm[_loc3] + _loc2.ctm[_loc3];
                } // end of for...in
                _loc2.c.setTransform(_loc8);
            } // end else if
            if (broadcastEvents)
            {
                if (_loc4[targetPath(_loc2.mc)] == undefined)
                {
                    _loc4[targetPath(_loc2.mc)] = _loc2.mc;
                } // end if
                if (_loc7[targetPath(_loc2.mc)] == undefined)
                {
                    _loc7[targetPath(_loc2.mc)] = _loc2.mc;
                } // end if
                if (_loc5[targetPath(_loc2.mc)] == undefined)
                {
                    _loc5[targetPath(_loc2.mc)] = [];
                } // end if
                _loc5[targetPath(_loc2.mc)].push(_loc2.ctm != undefined ? ("_ct_") : (_loc2.pp));
                if (_loc9[targetPath(_loc2.mc)] == undefined)
                {
                    _loc9[targetPath(_loc2.mc)] = [];
                } // end if
                _loc9[targetPath(_loc2.mc)].push(_loc2.ctm != undefined ? ("_ct_") : (_loc2.pp));
            } // end if
            if (_loc2.cb.updfunc != undefined)
            {
                _loc6 = _loc2.cb.updfunc;
                if (typeof(_loc6) == "string" && _loc2.cb.updscope != undefined)
                {
                    _loc6 = _loc2.cb.updscope[_loc6];
                } // end if
                _loc6.updfunc.apply(_loc2.cb.updscope, _loc2.cb.updargs);
            } // end if
            if (endt == undefined)
            {
                var endt = new Array();
            } // end if
            endt.push(_loc10);
        } // end while
        if (_loc13)
        {
            this.cleanUp();
        } // end if
        for (var _loc3 in _loc4)
        {
            _loc4[_loc3].broadcastMessage("onTweenUpdate", {target: _loc4[_loc3], props: _loc5[_loc3]});
        } // end of for...in
        if (endt != undefined)
        {
            this.endTweens(endt);
        } // end if
        for (var _loc3 in _loc7)
        {
            _loc7[_loc3].broadcastMessage("onTweenEnd", {target: _loc7[_loc3], props: _loc9[_loc3]});
        } // end of for...in
        now = getTimer();
        if (updateTime > 0)
        {
            updateAfterEvent();
        } // end if
    } // End of the function
    function endTweens(tid_arr)
    {
        var _loc2;
        var _loc9;
        var _loc3;
        var _loc5;
        var _loc8;
        _loc2 = [];
        _loc9 = tid_arr.length;
        for (var _loc3 = 0; _loc3 < _loc9; ++_loc3)
        {
            _loc5 = tweenList[tid_arr[_loc3]].cb;
            if (_loc5 != undefined)
            {
                var _loc6 = true;
                for (var _loc8 in _loc2)
                {
                    if (_loc2[_loc8] == _loc5)
                    {
                        _loc6 = false;
                        break;
                    } // end if
                } // end of for...in
                if (_loc6)
                {
                    _loc2.push(_loc5);
                } // end if
            } // end if
            tweenList.splice(tid_arr[_loc3], 1);
        } // end of for
        for (var _loc3 = 0; _loc3 < _loc2.length; ++_loc3)
        {
            var _loc4 = _loc2[_loc3].func;
            if (typeof(_loc4) == "string" && _loc2[_loc3].scope != undefined)
            {
                _loc4 = _loc2[_loc3].scope[_loc4];
            } // end if
            _loc4.apply(_loc2[_loc3].scope, _loc2[_loc3].args);
        } // end of for
        if (tweenList.length == 0)
        {
            this.deinit();
        } // end if
    } // End of the function
    function removeDelayedTween(index)
    {
        clearInterval(ints[index].intid);
        ints[index] = undefined;
        var _loc2 = true;
        for (var _loc3 in ints)
        {
            if (ints[_loc3] != undefined)
            {
                _loc2 = false;
                break;
            } // end if
        } // end of for...in
        if (_loc2)
        {
            ints = [];
        } // end if
    } // End of the function
    function addTween(mc, props, pEnd, sec, eqFunc, callback, extra1, extra2)
    {
        var _loc4;
        var _loc13;
        var _loc6;
        var _loc3;
        var _loc2;
        if (!playing)
        {
            this.init();
        } // end if
        var _loc12 = [];
        for (var _loc4 in props)
        {
            _loc13 = props[_loc4];
            _loc6 = true;
            if (_loc13.substr(0, 4) != "_ct_")
            {
                var _loc17 = typeof(pEnd[_loc4]) == "string" ? (Number(pEnd[_loc4])) : (pEnd[_loc4] - mc[_loc13]);
                if (autoOverwrite)
                {
                    for (var _loc3 in tweenList)
                    {
                        _loc2 = tweenList[_loc3];
                        if (_loc2.mc == mc && _loc2.pp == _loc13)
                        {
                            _loc2.ps = mc[_loc13];
                            _loc2.ch = _loc17;
                            _loc2.ts = now;
                            _loc2.d = sec * 1000;
                            _loc2.ef = eqFunc;
                            _loc2.cb = callback;
                            _loc2.e1 = extra1;
                            _loc2.e2 = extra2;
                            _loc2.pt = -1;
                            _loc6 = false;
                            _loc12.push(_loc2.pp);
                            break;
                        } // end if
                    } // end of for...in
                } // end if
                if (_loc6)
                {
                    tweenList.unshift({mc: mc, pp: _loc13, ps: mc[_loc13], ch: _loc17, ts: now, d: sec * 1000, ef: eqFunc, cb: callback, e1: extra1, e2: extra2, pt: -1});
                } // end if
                continue;
            } // end if
            var _loc16 = new Color(mc);
            var _loc20 = _loc16.getTransform();
            var _loc19 = {};
            for (var _loc3 in pEnd[_loc4])
            {
                if (pEnd[_loc4][_loc3] != _loc20[_loc3] && pEnd[_loc4][_loc3] != undefined)
                {
                    _loc19[_loc3] = typeof(pEnd[_loc4][_loc3]) == "string" ? (_loc20[_loc3] + Number(pEnd[_loc4][_loc3])) : (pEnd[_loc4][_loc3] - _loc20[_loc3]);
                } // end if
            } // end of for...in
            if (autoOverwrite)
            {
                for (var _loc3 in tweenList)
                {
                    _loc2 = tweenList[_loc3];
                    if (_loc2.mc == mc && _loc2.ctm != undefined)
                    {
                        _loc2.c = _loc16;
                        _loc2.stm = _loc20;
                        (_loc2.ctm = _loc19, _loc2.ts = now);
                        _loc2.d = sec * 1000;
                        _loc2.ef = eqFunc;
                        _loc2.cb = callback;
                        _loc2.e1 = extra1;
                        _loc2.e2 = extra2;
                        _loc2.pt = -1;
                        _loc6 = false;
                        _loc12.push("_ct_");
                        break;
                    } // end if
                } // end of for...in
            } // end if
            if (_loc6)
            {
                tweenList.unshift({mc: mc, c: _loc16, stm: _loc20, ctm: _loc19, ts: now, d: sec * 1000, ef: eqFunc, cb: callback, e1: extra1, e2: extra2, pt: -1});
            } // end if
        } // end of for...in
        if (broadcastEvents)
        {
            if (_loc12.length > 0)
            {
                mc.broadcastMessage("onTweenInterrupt", {target: mc, props: _loc12});
            } // end if
            mc.broadcastMessage("onTweenStart", {target: mc, props: props});
        } // end if
        if (callback.startfunc != undefined)
        {
            var _loc27 = callback.startfunc;
            if (typeof(_loc27) == "string" && callback.startscope != undefined)
            {
                _loc27 = callback.startscope[_loc27];
            } // end if
            _loc27.apply(callback.startscope, callback.startargs);
        } // end if
        if (sec == 0)
        {
            this.update();
        } // end if
    } // End of the function
    function addTweenWithDelay(delay, mc, props, pEnd, sec, eqFunc, callback, extra1, extra2)
    {
        var il;
        var _loc3;
        il = ints.length;
        _loc3 = setInterval(function (obj)
        {
            obj.removeDelayedTween(il);
            if (mc._x != undefined)
            {
                obj.addTween(mc, props, pEnd, sec, eqFunc, callback, extra1, extra2);
            } // end if
        }, delay * 1000, this);
        ints[il] = {mc: mc, props: props, pend: pEnd, intid: _loc3, st: getTimer(), delay: delay * 1000, args: arguments.slice(1), pt: -1};
        if (!playing)
        {
            this.init();
        } // end if
    } // End of the function
    function removeTween(mc, props)
    {
        var _loc8;
        var _loc2;
        var _loc5;
        _loc8 = false;
        if (props == undefined && broadcastEvents != true)
        {
            _loc8 = true;
        } // end if
        _loc2 = tweenList.length;
        var _loc4 = {};
        while (_loc2--)
        {
            if (tweenList[_loc2].mc == mc)
            {
                if (_loc8)
                {
                    tweenList.splice(_loc2, 1);
                    continue;
                } // end if
                for (var _loc5 in props)
                {
                    if (tweenList[_loc2].pp == props[_loc5])
                    {
                        tweenList.splice(_loc2, 1);
                        if (_loc4[targetPath(mc)] == undefined)
                        {
                            _loc4[targetPath(mc)] = {t: mc, p: []};
                        } // end if
                        _loc4[targetPath(mc)].p.push(props[_loc5]);
                        continue;
                    } // end if
                    if (props[_loc5] == "_ct_" && tweenList[_loc2].ctm != undefined && tweenList[_loc2].mc == mc)
                    {
                        tweenList.splice(_loc2, 1);
                        if (_loc4[targetPath(mc)] == undefined)
                        {
                            _loc4[targetPath(mc)] = {t: mc, p: []};
                        } // end if
                        _loc4[targetPath(mc)].p.push("_ct_");
                    } // end if
                } // end of for...in
            } // end if
        } // end while
        _loc2 = ints.length;
        while (_loc2--)
        {
            if (ints[_loc2].mc == mc)
            {
                if (_loc8)
                {
                    this.removeDelayedTween(Number(_loc2));
                    continue;
                } // end if
                for (var _loc5 in props)
                {
                    for (var _loc11 in ints[_loc2].props)
                    {
                        if (ints[_loc2].props[_loc11] == props[_loc5])
                        {
                            ints[_loc2].props.splice(_loc11, 1);
                            ints[_loc2].pend.splice(_loc11, 1);
                            if (_loc4[targetPath(mc)] == undefined)
                            {
                                _loc4[targetPath(mc)] = {t: mc, p: []};
                            } // end if
                            _loc4[targetPath(mc)].p.push(props[_loc5]);
                        } // end if
                    } // end of for...in
                    if (ints[_loc2].props.length == 0)
                    {
                        clearInterval(ints[_loc2].intid);
                    } // end if
                } // end of for...in
            } // end if
        } // end while
        if (broadcastEvents)
        {
            for (var _loc11 in _loc4)
            {
                if (_loc4[_loc11].p.length > 0)
                {
                    _loc4[_loc11].t.broadcastMessage("onTweenInterrupt", {target: _loc4[_loc11].t, props: _loc4[_loc11].p});
                } // end if
            } // end of for...in
        } // end if
        if (tweenList.length == 0)
        {
            this.deinit();
        } // end if
    } // End of the function
    function isTweening(mc, prop)
    {
        var _loc4 = prop == undefined;
        for (var _loc6 in tweenList)
        {
            var _loc2 = tweenList[_loc6];
            if (tweenList[_loc6].mc == mc && tweenList[_loc6].pt == -1 && (_loc4 || prop == _loc2.pp || prop == "_ct_" && _loc2.ctm != undefined))
            {
                return (true);
            } // end if
        } // end of for...in
        return (false);
    } // End of the function
    function getTweens(mc)
    {
        var _loc2 = 0;
        for (var _loc4 in tweenList)
        {
            if (tweenList[_loc4].mc == mc)
            {
                ++_loc2;
            } // end if
        } // end of for...in
        return (_loc2);
    } // End of the function
    function lockTween(mc, bool)
    {
        lockedTweens[targetPath(mc)] = bool;
    } // End of the function
    function isTweenLocked(mc)
    {
        if (lockedTweens[targetPath(mc)] == undefined)
        {
            return (false);
        }
        else
        {
            return (lockedTweens[targetPath(mc)]);
        } // end else if
    } // End of the function
    function ffTween(mc, propsObj)
    {
        var _loc4 = mc == undefined;
        var _loc6 = propsObj == undefined;
        for (var _loc8 in tweenList)
        {
            var _loc2 = tweenList[_loc8];
            if ((_loc2.mc == mc || _loc4) && (_loc6 || propsObj[_loc2.pp] == true))
            {
                if (_loc2.pt != -1)
                {
                    _loc2.pt = -1;
                } // end if
                _loc2.ts = now - _loc2.d;
            } // end if
        } // end of for...in
        for (var _loc8 in ints)
        {
            if (ints[_loc8] != undefined)
            {
                if (ints[_loc8].mc == mc || _loc4)
                {
                    if (ints[_loc8].mc._x != undefined)
                    {
                        var _loc3 = ints[_loc8].args;
                        _loc3[3] = 0;
                        addTween.apply(this, _loc3);
                    } // end if
                    this.removeDelayedTween(Number(_loc8));
                } // end if
            } // end if
        } // end of for...in
        this.update();
    } // End of the function
    function rewTween(mc, propsObj)
    {
        var _loc3 = mc == undefined;
        var _loc5 = propsObj == undefined;
        for (var _loc7 in tweenList)
        {
            var _loc2 = tweenList[_loc7];
            if ((_loc2.mc == mc || _loc3) && (_loc5 || propsObj[_loc2.pp] == true))
            {
                if (_loc2.pt != -1)
                {
                    _loc2.pt = -1;
                } // end if
                _loc2.ts = now;
            } // end if
        } // end of for...in
        for (var _loc7 in ints)
        {
            if (ints[_loc7] != undefined)
            {
                if (ints[_loc7].mc == mc || _loc3)
                {
                    if (ints[_loc7].mc._x != undefined)
                    {
                        addTween.apply(this, ints[_loc7].args);
                    } // end if
                    this.removeDelayedTween(Number(_loc7));
                } // end if
            } // end if
        } // end of for...in
        this.update();
    } // End of the function
    function isTweenPaused(mc, prop)
    {
        if (mc == undefined)
        {
            return (null);
        } // end if
        var _loc5 = prop == undefined;
        for (var _loc6 in tweenList)
        {
            var _loc2 = tweenList[_loc6];
            if (tweenList[_loc6].mc == mc && (_loc5 || prop == _loc2.pp || prop == "_ct_" && _loc2.ctm != undefined))
            {
                return (Boolean(tweenList[_loc6].pt != -1));
            } // end if
        } // end of for...in
        for (var _loc6 in ints)
        {
            if (ints[_loc6] != undefined && ints[_loc6].mc == mc)
            {
                return (Boolean(ints[_loc6].pt != -1));
            } // end if
        } // end of for...in
        return (false);
    } // End of the function
    function pauseTween(mc, propsObj)
    {
        var _loc3 = mc == undefined;
        if (_loc3 == false && this.isTweenPaused(mc) == true)
        {
            return;
        } // end if
        var _loc6 = propsObj == undefined;
        for (var _loc7 in tweenList)
        {
            var _loc2 = tweenList[_loc7];
            if (_loc2.pt == -1 && (_loc2.mc == mc || _loc3) && (_loc6 || propsObj[_loc2.pp] == true || propsObj._ct_ != undefined && _loc2.ctm != undefined))
            {
                _loc2.pt = now;
            } // end if
        } // end of for...in
        for (var _loc7 in ints)
        {
            if (ints[_loc7] != undefined)
            {
                if (ints[_loc7].pt == -1 && (ints[_loc7].mc == mc || _loc3))
                {
                    ints[_loc7].pt = now;
                } // end if
            } // end if
        } // end of for...in
    } // End of the function
    function unpauseTween(mc, propsObj)
    {
        var _loc4 = mc == undefined;
        if (_loc4 == false && this.isTweenPaused(mc) === false)
        {
            return;
        } // end if
        var _loc7 = propsObj == undefined;
        if (!playing)
        {
            this.init();
        } // end if
        for (var _loc2 in tweenList)
        {
            var _loc3 = tweenList[_loc2];
            if (_loc3.pt != -1 && (_loc3.mc == mc || _loc4) && (_loc7 || propsObj[_loc3.pp] == true) || propsObj._ct_ != undefined && _loc3.ctm != undefined)
            {
                _loc3.ts = now - (_loc3.pt - _loc3.ts);
                _loc3.pt = -1;
            } // end if
        } // end of for...in
        for (var _loc2 in ints)
        {
            if (ints[_loc2] != undefined)
            {
                if (ints[_loc2].pt != -1 && (ints[_loc2].mc == mc || _loc4))
                {
                    ints[_loc2].delay = ints[_loc2].delay - (ints[_loc2].pt - ints[_loc2].st);
                    ints[_loc2].st = now;
                    ints[_loc2].intid = setInterval(function (obj, id)
                    {
                        obj.addTween.apply(obj, obj.ints[id].args);
                        clearInterval(obj.ints[id].intid);
                        obj.ints[id] = undefined;
                    }, ints[_loc2].delay, this, _loc2);
                } // end if
            } // end if
        } // end of for...in
    } // End of the function
    function pauseAll()
    {
        this.pauseTween();
    } // End of the function
    function unpauseAll()
    {
        this.unpauseTween();
    } // End of the function
    function stopAll()
    {
        for (var _loc2 in ints)
        {
            this.removeDelayedTween(Number(_loc2));
        } // end of for...in
        tweenList = new Array();
        this.deinit();
    } // End of the function
    function toString()
    {
        return ("[AS2 tweenManager 1.2.0]");
    } // End of the function
    var _th_depth = 6789;
} // End of Class
