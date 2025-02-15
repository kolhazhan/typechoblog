document.addEventListener("DOMContentLoaded", function () {
  var e = document.querySelectorAll(".joe_config__aside .item"),
    t = document.querySelector(".joe_config__notice"),
    s = document.querySelector(".joe_config > form"),
    n = document.querySelectorAll(".joe_content");
  if (
    (e.forEach(function (o) {
      o.addEventListener("click", function () {
        e.forEach(function (e) {
          e.classList.remove("active");
        }),
          o.classList.add("active");
        var c = o.getAttribute("data-current");
        sessionStorage.setItem("joe_config_current", c),
          "joe_notice" === c
            ? ((t.style.display = "block"), (s.style.display = "none"))
            : ((t.style.display = "none"), (s.style.display = "block")),
          n.forEach(function (e) {
            e.style.display = "none";
            var t = e.classList.contains(c);
            t && (e.style.display = "block");
          });
      });
    }),
    sessionStorage.getItem("joe_config_current"))
  ) {
    var o = sessionStorage.getItem("joe_config_current");
    "joe_notice" === o
      ? ((t.style.display = "block"), (s.style.display = "none"))
      : ((s.style.display = "block"), (t.style.display = "none")),
      e.forEach(function (e) {
        var t = e.getAttribute("data-current");
        t === o && e.classList.add("active");
      }),
      n.forEach(function (e) {
        e.classList.contains(o) && (e.style.display = "block");
      });
  } else
    e[0].classList.add("active"),
      (t.style.display = "block"),
      (s.style.display = "none");

  let content = `
  <h1>Joe懒人版</h1>
  <p>一款基于Typecho博客的双栏极致优化主题，本主题基于Joe再续前缘版修改而来，添加一些美化、优化。</p>
  <p style="color: red;">请定期访问获取最新版本：<a target="_blank" href="https://letanml.xyz/web-build/21.html">浅梦的小站</a></p>
  <br><h2>首页列表不显示：</h2>
  <ul>
	  <li>关闭typecho的debug模式，或者从官网下载typecho包，不要使用网上提供的二改后的</li>
	  <li>开启强制https后在网站域名设置处同样设置https域名</li>
  </ul><br>
  <h2>相关信息</h2>
  <ul>
	  <li>懒人版作者博客：<a href="https://letanml.xyz/web-build/21.html">浅梦的小站</a></li>
    <li>懒人版开源地址：<a href="https://gitee.com/xnnnjzk/Joe-lazy">Gitee</a></li>
	  <li>再续前缘版作者博客：<a href="http://blog.bri6.cn">易航博客</a></li>
    <li>再续前缘版开源地址：<a href="https://gitee.com/yh-it/Joe">Gitee</a></li>
    <li>原版作者博客：<a href="https://78.al/">HaoOuBa</a></li>
    <li>原版开源地址：<a href="https://github.com/HaoOuBa/Joe">Github</a></li>
	  <li>主题宗旨：简洁、超强、开源、精华</li>
  </ul>`;
  t.innerHTML = `<p class="title">当前版本：${Joe.version}</p>` + content;

  const update = () => {
    Swal.fire({
      title: "请手动检查并更新",
      icon: "info",
      html: '请前往 <a href="https://letanml.xyz/web-build/21.html" target="_blank">浅梦的小站</a> 检查并获取更新',
      showCancelButton: true,
      confirmButtonText: "立即前往",
      cancelButtonText: "取消",
    }).then((result) => {
      if (result.isConfirmed) {
        window.open("https://letanml.xyz/web-build/21.html", "_blank");
      }
    });
  };

  $("#update").on("click", () => update());

  function setCookie(name, value, days) {
    var expires = "";
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
      expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
  }

  function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(";");
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == " ") c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }

  // 弹窗的显示逻辑
  if (getCookie("noPopup") != new Date().toDateString()) {
    Swal.fire({
      title: "请检查并获取更新",
      icon: "info",
      html: '请前往 <a href="https://letanml.xyz/web-build/21.html" target="_blank">浅梦的小站</a> 检查并获取更新',
      showCancelButton: true,
      confirmButtonText: "立即前往",
      cancelButtonText: "今日不再弹出",
    }).then((result) => {
      if (result.isConfirmed) {
        window.open("https://letanml.xyz/web-build/21.html", "_blank");
      } else if (result.isDismissed) {
        setCookie("noPopup", new Date().toDateString(), 1);
      }
    });
  }
});
