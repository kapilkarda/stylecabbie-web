try{!function(d,t,m){"use strict";d.fn.yit_infinitescroll=function(e){var o=d.extend({nextSelector:!1,navSelector:!1,itemSelector:!1,contentSelector:!1,maxPage:!1,loader:!1,is_shop:!1},e),s=!1,a=!1,c=d(o.nextSelector).attr("href");d(o.nextSelector).length&&d(o.navSelector).length&&d(o.itemSelector).length&&d(o.contentSelector).length?d(o.navSelector).hide():a=!0;var f=d(o.contentSelector).find(o.itemSelector).first().nextUntil(".first",o.itemSelector).length+1,h=function(e,t,i){var n=t-e.prevUntil(".last",o.itemSelector).length,r=0;i.each(function(){var e=d(this);r++,e.removeClass("first"),e.removeClass("last"),(r-n)%t==0?e.addClass("first"):(r-(n-1))%t==0&&e.addClass("last")})};d(t).on("scroll touchstart",function(){d(this).trigger("yith_infs_start")}),d(t).on("yith_infs_start",function(){var l,e=d(this),t=d(o.itemSelector).last();void 0!==t&&(!s&&!a&&e.scrollTop()+e.height()>=t.offset().top-2*t.height()&&(l=d(o.contentSelector).find(o.itemSelector).last(),o.loader&&d(o.navSelector).after('<div class="yith-infs-loader">'+o.loader+"</div>"),s=!0,c=(c=decodeURIComponent(c)).replace(/^(?:\/\/|[^\/]+)*\//,"/"),d.ajax({url:c,dataType:"html",cache:!1,success:function(e){var t=d(e),i=t.find(o.itemSelector),n=t.find(o.nextSelector),r=c;n.length?c=n.attr("href"):(a=!0,d(m).trigger("yith-infs-scroll-finished")),!l.hasClass("last")&&o.is_shop&&h(l,f,i),l.after(i),d(".yith-infs-loader").remove(),d(m).trigger("yith_infs_adding_elem",[i,r]),i.addClass("yith-infs-animated"),setTimeout(function(){s=!1,i.removeClass("yith-infs-animated"),d(m).trigger("yith_infs_added_elem",[i,r])},1e3)}})))})}}(jQuery,window,document);}catch(e){}