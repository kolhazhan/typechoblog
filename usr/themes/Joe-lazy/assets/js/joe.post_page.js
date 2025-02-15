document.addEventListener("DOMContentLoaded", () => {
  const encryption = (str) => window.btoa(unescape(encodeURIComponent(str)));
  const decrypt = (str) => decodeURIComponent(escape(window.atob(str)));

  /* 当前页的CID */
  const cid = $(".joe_detail").attr("data-cid");

  /* 文章海报 */
  {
    const $posterImages = $(".article-poster-images");
    const $posterDownload = $(".poster-download");
    const $popoverMask = $(".poster-popover-mask");

    const createPoster = async () => {
      Qmsg.loading("正在生成海报，请稍候...");
      try {
        const response = await fetch(
          `/index.php/ArticlePoster/make?cid=${cid}`
        );
        const json = await response.json();
        Qmsg.closeAll();
        if (json.code === 200) {
          $posterImages.attr("src", json.data);
          $posterDownload.data("url", json.data);

          // 显示遮罩和弹出框
          $popoverMask.css("display", "flex");
          Qmsg.success("操作成功！");
        } else {
          throw new Error(json.data || "操作失败，请重试。");
        }
      } catch (error) {
        Qmsg.error(error.message);
      }
    };

    const downloadPoster = () => {
      $("<a>", {
        href: $posterDownload.data("url"),
        download: "海报",
      })
        .appendTo("body")
        .click()
        .remove();
    };

    $(".article-poster-button").on("click", createPoster);
    $posterDownload.on("click", downloadPoster);
    $popoverMask.on("click", function () {
      $(this).css("display", "none");
    });
  }

  /* 文章打赏 */
  {
    $(".icon.ysnizs").click(function () {
      $(".reward-overlay").css("display", "flex");
    });

    $(".reward-overlay").click(function () {
      $(this).css("display", "none");
    });
  }

  /* 获取本篇文章百度收录情况 */
  {
    $.ajax({
      url: Joe.BASE_API,
      type: "POST",
      dataType: "json",
      data: {
        routeType: "baidu_record",
        site: window.location.href,
      },
      success(res) {
        if (!res.data) {
          if (Joe.BAIDU_PUSH) {
            $("#Joe_Baidu_Record").html(
              `<a href="javascript:submit_baidu();" rel="noopener noreferrer nofollow" style="color: #F56C6C">检测失败，提交收录</a>`
            );
            return;
          }
          const url = `https://ziyuan.baidu.com/linksubmit/url?sitename=${encodeURI(
            window.location.href
          )}`;
          $("#Joe_Baidu_Record").html(
            `<a target="_blank" href="${url}" rel="noopener noreferrer nofollow" style="color: #F56C6C">检测失败，提交收录</a>`
          );
          return;
        }
        if (res.data === "已收录") {
          $("#Joe_Baidu_Record").css("color", "#67C23A");
          $("#Joe_Baidu_Record").html("已收录");
          return;
        }
        /* 如果填写了Token，则自动推送给百度 */
        if (res.data == "未收录" && Joe.BAIDU_PUSH) {
          submit_baidu("未收录，推送中...");
          return;
        }
        if (Joe.BAIDU_PUSH) {
          $("#Joe_Baidu_Record").html(
            `<a href="javascript:submit_baidu();" rel="noopener noreferrer nofollow" style="color: #F56C6C">${res.data}，提交收录</a>`
          );
          return;
        }
        const url = `https://ziyuan.baidu.com/linksubmit/url?sitename=${encodeURI(
          window.location.href
        )}`;
        $("#Joe_Baidu_Record").html(
          `<a target="_blank" href="${url}" rel="noopener noreferrer nofollow" style="color: #F56C6C">${res.data}，提交收录</a>`
        );
      },
    });
  }

  /* 激活代码高亮 */
  {
    if (typeof Prism !== "undefined") {
      var pres = document.getElementsByTagName("pre");
      for (var i = 0; i < pres.length; i++) {
        if (pres[i].getElementsByTagName("code").length > 0)
          pres[i].className = "line-numbers";
      }
      Prism.highlightAll(true, null);
    }
  }

  /* 监听网页复制行为 */
  {
    document.addEventListener("copy", function (e) {
      setTimeout(function () {
        if (window.code_copy !== true && window.post_copy !== true) {
          Qmsg.warning(`本文版权属于 ${Joe.TITLE} 转载请标明出处！`);
          window.post_copy = true;
        }
        window.code_copy = false;
      }, 100);
    });
  }

  /* 激活图片预览功能 */
  {
    $(".joe_detail__article img:not(img.owo_image)").each(function () {
      $(this).wrap(
        $(
          `<span style="display: block;" data-fancybox="Joe" href="${$(
            this
          ).attr("src")}"></span>`
        )
      );
    });
  }

  /* 设置文章内的链接为新窗口打开 */
  {
    $(".joe_detail__article a:not(.joe_detail__article-anote)").each(
      function () {
        $(this).attr({
          target: "_blank",
          rel: "noopener noreferrer nofollow",
        });
      }
    );
  }

  /* 激活浏览功能 */
  {
    let viewsArr = localStorage.getItem(encryption("views"))
      ? JSON.parse(decrypt(localStorage.getItem(encryption("views"))))
      : [];
    const flag = viewsArr.includes(cid);
    if (!flag) {
      $.ajax({
        url: Joe.BASE_API,
        type: "POST",
        dataType: "json",
        data: {
          routeType: "handle_views",
          cid,
        },
        success(res) {
          if (res.code !== 1) return;
          $("#Joe_Article_Views").html(`${res.data.views} 阅读`);
          viewsArr.push(cid);
          const name = encryption("views");
          const val = encryption(JSON.stringify(viewsArr));
          localStorage.setItem(name, val);
        },
      });
    }
  }

  /* 激活文章点赞功能 */
  {
    const iconElement = document.querySelector(".joe_detail__agree .icon");
    const textElement = document.querySelector(".joe_detail__agree .text");
    let agreeArr = JSON.parse(
      decrypt(localStorage.getItem(encryption("agree"))) || "[]"
    );
    let _loading = false;

    iconElement.addEventListener("click", async () => {
      if (_loading) return;
      _loading = true;

      const flag = agreeArr.includes(cid);
      const formData = new URLSearchParams({
        routeType: "handle_agree",
        cid,
        type: flag ? "disagree" : "agree",
      });

      const response = await fetch(Joe.BASE_API, {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: formData,
      });

      if (response.ok) {
        const res = await response.json();
        if (res.code !== 1) return;

        const index = agreeArr.indexOf(cid);
        if (flag && index !== -1) {
          agreeArr.splice(index, 1);
        } else if (!flag && index === -1) {
          agreeArr.push(cid);
        }

        localStorage.setItem(
          encryption("agree"),
          encryption(JSON.stringify(agreeArr))
        );
        textElement.textContent = res.data.agree;
      }

      _loading = false;
    });
  }

  /* 密码保护文章，输入密码访问 */
  {
    let isSubmit = false;
    $(".joe_detail__article-protected").on("submit", function (e) {
      e.preventDefault();
      const url = $(this).attr("action") + "&time=" + +new Date();
      const protectPassword = $(this).find('input[type="password"]').val();
      if (protectPassword.trim() === "") return Qmsg.info("请输入访问密码！");
      if (isSubmit) return;
      isSubmit = true;
      $.ajax({
        url,
        type: "POST",
        data: {
          cid,
          protectCID: cid,
          protectPassword,
        },
        dataType: "text",
        success(res) {
          let arr = [],
            str = "";
          arr = $(res).contents();
          Array.from(arr).forEach((_) => {
            if (_.parentNode.className === "container") str = _;
          });
          if (!/Joe/.test(res)) {
            Qmsg.warning(str.textContent.trim() || "");
            isSubmit = false;
            $(".joe_comment__respond-form .foot .submit button").html(
              "发表评论"
            );
          } else {
            location.reload();
          }
        },
      });
    });
  }

  /* 激活文章视频模块 */
  {
    if ($(".joe_detail__article-video").length > 0) {
      const player = $(".joe_detail__article-video .play iframe").attr(
        "data-player"
      );
      $(".joe_detail__article-video .episodes .item").on("click", function () {
        $(this).addClass("active").siblings().removeClass("active");
        const url = $(this).attr("data-src");
        let alt = $(this).attr("alt");
        $(".joe_detail__article-video .play iframe").attr({
          src:
            player +
            url +
            "&autoplay=1&screenshot=1&theme=" +
            encodeURIComponent(
              getComputedStyle(document.documentElement)
                .getPropertyValue("--theme")
                .trim()
            ),
        });
        alt ? $(".joe_detail__article-video .play .title").html(alt) : null;
      });
      $(".joe_detail__article-video .episodes .item").first().click();
    }
  }

  /* 分享 */
  {
    if ($(".joe_detail__operate-share").length) {
      $(".joe_detail__operate-share > svg").on("click", (e) => {
        e.stopPropagation();
        $(".joe_detail__operate-share").toggleClass("active");
      });
      $(document).on("click", () =>
        $(".joe_detail__operate-share").removeClass("active")
      );
    }
  }
});

/* 写在load事件里，为了解决图片未加载完成，滚动距离获取会不准确的问题 */
window.addEventListener("load", function () {
  /* 判断地址栏是否有锚点链接，有则跳转到对应位置 */
  {
    const scroll = new URLSearchParams(location.search).get("scroll");
    if (scroll) {
      let elementEL = null;
      if ($("#" + scroll).length > 0) {
        elementEL = $("#" + scroll);
      } else {
        elementEL = $("." + scroll);
      }
      if (elementEL && elementEL.length > 0) {
        const top = elementEL.offset().top - $(".joe_header").height() - 15;
        window.scrollTo({
          top,
          behavior: "smooth",
        });
      }
    }
  }
});

function submit_baidu(msg = "推送中...") {
  $("#Joe_Baidu_Record").html(`<span style="color: #E6A23C">${msg}</span>`);
  $.ajax({
    url: Joe.BASE_API,
    type: "POST",
    dataType: "json",
    data: {
      routeType: "baidu_push",
      domain: window.location.protocol + "//" + window.location.hostname,
      url: encodeURI(window.location.href),
    },
    success(res) {
      if (res.data.error) {
        $("#Joe_Baidu_Record").html(
          '<span style="color: #F56C6C">推送失败，请检查！</span>'
        );
      } else {
        $("#Joe_Baidu_Record").html(
          '<span style="color: #67C23A">推送成功！</span>'
        );
      }
    },
    error(res) {
      $("#Joe_Baidu_Record").html(
        '<span style="color: #F56C6C">推送失败，请检查！</span>'
      );
    },
  });
  // 	顺便推送URL到必应
  if (!Joe.BAIDU_PUSH) {
    return;
  }
  $.ajax({
    url: Joe.BASE_API,
    type: "POST",
    dataType: "json",
    data: {
      routeType: "bing_push",
      domain: window.location.protocol + "//" + window.location.hostname,
      url: encodeURI(window.location.href),
    },
  });
}
