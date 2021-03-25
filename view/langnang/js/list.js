$ = mdui.JQ;

$.fn.extend({
  sortElements: function (comparator, getSortable) {
    getSortable =
      getSortable ||
      function () {
        return this;
      };

    var placements = this.map(function () {
      var sortElement = getSortable.call(this),
        parentNode = sortElement.parentNode,
        nextSibling = parentNode.insertBefore(
          document.createTextNode(""),
          sortElement.nextSibling
        );

      return function () {
        parentNode.insertBefore(this, nextSibling);
        parentNode.removeChild(nextSibling);
      };
    });

    return [].sort.call(this, comparator).each(function (i) {
      placements[i].call(getSortable.call(this));
    });
  },
});

function downall() {
  let dl_link_list = Array.from(document.querySelectorAll("li a"))
    .map((x) => x.href) // 所有list中的链接
    .filter((x) => x.slice(-1) != "/"); // 筛选出非文件夹的文件下载链接

  let blob = new Blob([dl_link_list.join("\r\n")], {
    type: "text/plain",
  }); // 构造Blog对象
  let a = document.createElement("a"); // 伪造一个a对象
  a.href = window.URL.createObjectURL(blob); // 构造href属性为Blob对象生成的链接
  a.download = "folder_download_link.txt"; // 文件名称，你可以根据你的需要构造
  a.click(); // 模拟点击
  a.remove();
}

function thumb() {
  if ($(".mdui-fab i").text() == "apps") {
    $(".mdui-fab i").text("format_list_bulleted");
    $(".nexmoe-item").removeClass("thumb");
    $(".nexmoe-item .mdui-icon").show();
    $(".nexmoe-item .mdui-list-item").css("background", "");
  } else {
    $(".mdui-fab i").text("apps");
    $(".nexmoe-item").addClass("thumb");
    $(".mdui-col-xs-12 i.mdui-icon").each(function () {
      if ($(this).text() == "image" || $(this).text() == "ondemand_video") {
        var href = $(this).parent().parent().attr("href");
        var thumb = href.indexOf("?") == -1 ? "?t=220" : "&t=220";
        $(this).hide();
        $(this)
          .parent()
          .parent()
          .parent()
          .css("background", "url(" + href + thumb + ")  no-repeat center top");
      }
    });
  }
}


$(function () {
  $(".file a").each(function () {
    $(this).on("click", function () {
      var form = $("<form target=_self method=post></form>")
        .attr("action", $(this).attr("href"))
        .get(0);
      $(document.body).append(form);
      form.submit();
      $(form).remove();
      return false;
    });
  });

  $(".icon-sort").on("click", function () {
    let sort_type = $(this).attr("data-sort"),
      sort_order = $(this).attr("data-order");
    let sort_order_to = sort_order === "less" ? "more" : "less";

    $("li[data-sort]").sortElements(function (a, b) {
      let data_a = $(a).attr("data-sort-" + sort_type),
        data_b = $(b).attr("data-sort-" + sort_type);
      let rt = data_a.localeCompare(data_b, undefined, {
        numeric: true,
      });
      return sort_order === "more" ? 0 - rt : rt;
    });

    $(this)
      .attr("data-order", sort_order_to)
      .text("expand_" + sort_order_to);
  });
});
