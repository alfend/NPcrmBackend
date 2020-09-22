"use strict";!function(i){i("body");var e=i(".js-range-slider"),t=i("#range-calendar"),n=i(".counter"),o=i(".input-nao__field"),a=i(".chart"),r=i(".switch.switch-sm");if(i(window).on("load",function(){i(".preloader").removeClass("loading")}),i(window).on("scroll",function(){var e=i(".sticky");0<i(window).scrollTop()?e.addClass("fixed"):e.removeClass("fixed")}),n.length&&n.each(function(e,t){var n=i(t).find(".counter__circle-value");setTimeout(function(){n.attr("stroke-dashoffset",0)},500),i(t).find("span").each(function(){i(this).prop("Counter",0).animate({Counter:i(this).text()},{duration:1500,easing:"swing",step:function(e){i(this).text(Math.ceil(e))}})})}),t.length){var s=moment(),c=moment().add("months",12);t.rangeCalendar({lang:"ru",theme:"default-theme",themeContext:this,startDate:s,endDate:c,start:"+7",startRangeWidth:1,minRangeWidth:1,maxRangeWidth:1,weekends:!0,autoHideMonths:!1,visible:!0,trigger:"click",changeRangeCallback:function(){return!1}})}if(e.length&&e.ionRangeSlider({min:0,max:24,from:17,step:1,postfix:".00",skin:"round",hide_min_max:!0,hide_min_to:!0}),o.on("focus blur input",function(){""!==i(this).val()?i(this).addClass("input-nao__filled"):i(this).removeClass("input-nao__filled")}),a.length&&Highcharts.chart("chart",{chart:{plotBackgroundColor:null,plotBorderWidth:null,plotShadow:!1,type:"pie",margin:[0,0,0,0],spacing:[0,0,0,0]},title:{text:""},tooltip:{padding:4,distance:24,pointFormat:"{series.name}: <b>{point.percentage:.1f}%</b>"},plotOptions:{pie:{allowPointSelect:!0,cursor:"pointer",dataLabels:{enabled:!1},showInLegend:!1,animation:{duration:500},slicedOffset:4},series:{states:{inactive:{opacity:1},hover:{enabled:!0,halo:{opacity:.5,size:4}},select:{enabled:!0,halo:{opacity:.5,size:4}}}}},credits:{enabled:!1},series:[{name:"Brands",colorByPoint:!0,data:[{name:"Chrome",y:61.41,sliced:!1,selected:!1},{name:"Internet Explorer",y:11.84},{name:"Firefox",y:10.85},{name:"Edge",y:4.67},{name:"Safari",y:4.18},{name:"Other",y:7.05}]}]}),r.length){var l=r.find("input[type=checkbox]"),d=l.prop("checked"),h=i("#counters");d&&p(h,"hide"),l.on("change",function(){d=l.prop("checked"),p(h,d?"hide":"show")})}function p(e,t){e.animate({opacity:t,height:t},{duration:500,specialEasing:{opacity:"linear",height:"swing"}})}svg4everybody(),navigator.serviceWorker.controller?console.log("[PWA Builder] active service worker found, no need to register"):navigator.serviceWorker.register("js/sw.js",{scope:"./"}).then(function(e){console.log("Service worker has been registered for scope:"+e.scope)})}(jQuery);
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm1haW4uanMiXSwibmFtZXMiOlsiJCIsIiRib2R5IiwiJHJhbmdlU2xpZGVyIiwiJHJhbmdlQ2FsZW5kYXIiLCIkY291bnRlcnMiLCIkaW5wdXROYW8iLCIkY2hhcnQiLCJ3aW5kb3ciLCJvbiIsInJlbW92ZUNsYXNzIiwic2Nyb2xsIiwiJHN0aWNreSIsInNjcm9sbFRvcCIsImxlbmd0aCIsImVhY2giLCJwcm9wIiwiaW5kZXgiLCJlbGVtIiwiQ291bnRlciIsImZpbmQiLCJkdXJhdGlvbiIsImVhc2luZyIsInN0ZXAiLCJ0aGlzIiwiYW5pbWF0ZSIsInRleHQiLCJ0b2dnbGVBbmltYXRlIiwiTWF0aCIsImNlaWwiLCJub3ciLCJjdXJyZW50RGF0ZSIsIm1vbWVudCIsImVuZERhdGUiLCJyYW5nZUNhbGVuZGFyIiwibGFuZyIsInRoZW1lIiwidGhlbWVDb250ZXh0Iiwic3RhcnREYXRlIiwic3RhcnQiLCJzdGFydFJhbmdlV2lkdGgiLCJtaW5SYW5nZVdpZHRoIiwibWF4UmFuZ2VXaWR0aCIsIndlZWtlbmRzIiwiYXV0b0hpZGVNb250aHMiLCJ2aXNpYmxlIiwidHJpZ2dlciIsImNoYW5nZVJhbmdlQ2FsbGJhY2siLCJwb3N0Zml4IiwiaW9uUmFuZ2VTbGlkZXIiLCJza2luIiwiaGlkZV9taW5fbWF4IiwiaGlkZV9taW5fdG8iLCJ2YWwiLCJjaGFydCIsInR5cGUiLCJtYXJnaW4iLCJzcGFjaW5nIiwicGxvdEJhY2tncm91bmRDb2xvciIsInRpdGxlIiwidG9vbHRpcCIsInBhZGRpbmciLCJwb2ludEZvcm1hdCIsInBpZSIsImFsbG93UG9pbnRTZWxlY3QiLCJjdXJzb3IiLCJkYXRhTGFiZWxzIiwicGxvdE9wdGlvbnMiLCJzaG93SW5MZWdlbmQiLCJhbmltYXRpb24iLCJzbGljZWRPZmZzZXQiLCJzZXJpZXMiLCJzdGF0ZXMiLCJpbmFjdGl2ZSIsImVuYWJsZWQiLCJoYWxvIiwib3BhY2l0eSIsInNpemUiLCJob3ZlciIsInNlbGVjdCIsImNyZWRpdHMiLCJkYXRhIiwibmFtZSIsInNsaWNlZCIsInNlbGVjdGVkIiwiY29sb3JCeVBvaW50IiwieSIsIiRzd2l0Y2giLCJpc0NoZWNrZWQiLCJzd2l0Y2hJbnB1dCIsInBhcmFtIiwiaGVpZ2h0IiwibmF2aWdhdG9yIiwiY29uc29sZSIsInNlcnZpY2VXb3JrZXIiLCJjb250cm9sbGVyIiwialF1ZXJ5IiwibG9nIiwicmVnaXN0ZXIiLCJzY29wZSIsInRoZW4iLCJyZWciXSwibWFwcGluZ3MiOiJjQVNBLFNBQUFBLEdBQWVBLEVBQUEsUUFBYixJQUVLQyxFQUFTRCxFQUFmLG9CQUNNRSxFQUFpQkYsRUFBQSxtQkFDakJHLEVBQUFBLEVBQWMsWUFDZEMsRUFBYUosRUFBQyxxQkFDZEssRUFBU0wsRUFBR0EsVUFDWk0sRUFBV04sRUFBQSxxQkFrRGYsR0EvQ0ZBLEVBQUNPLFFBQURDLEdBQUEsT0FBQSxXQUNvQlIsRUFBRSxjQUR0QlMsWUFBQSxhQVFDVCxFQUFBTyxRQUFJRyxHQUFNLFNBQUtILFdBRGYsSUFBTUksRUFBVVgsRUFBRSxXQUtYLEVBRkdBLEVBQUdPLFFBQUdLLFlBR2ZELEVBQUFBLFNBQVFGLFNBUFZFLEVBQUFGLFlBQUEsV0FZSUwsRUFBVVMsUUE2S1hiLEVBQUVjLEtBQU1DLFNBQUtDLEVBQWJDLEdBQ0NDLElBQUFBLEVBQU9sQixFQUFHaUIsR0FBREUsS0FBQSwwQkFFVEMsV0FBQUEsV0FDQUMsRUFBQUEsS0FBTSxvQkFGSixJQUdGQyxLQUVDdEIsRUFBQWlCLEdBQUFFLEtBQUEsUUFBQUwsS0FBQSxXQUxDZCxFQUFBdUIsTUFGSFIsS0FBQSxVQUFBLEdBQUFTLFFBQUEsQ0FTQU4sUUFWRGxCLEVBQUF1QixNQUFBRSxRQVBELENBbUJBTCxTQUFBLEtBUEdDLE9BQVEsUUFVWkMsS0FBU0ksU0FBQUEsR0FDUlQsRUFBSU0sTUFBQ0MsS0FBUUcsS0FBQUMsS0FBQUMsV0F4TGExQixFQUFBVSxPQUFBLENBQUEsSUFDMUJpQixFQUFBQyxTQUNBQyxFQUFJRixTQUFjQyxJQUFNLFNBQXhCLElBR0E1QixFQUFBQSxjQUFlOEIsQ0FDZEMsS0FMUSxLQU1SQyxNQUFBQSxnQkFDQUMsYUFBQUEsS0FDQUMsVUFBQUEsRUFDQUwsUUFBQUEsRUFDQU0sTUFBQUEsS0FDQUMsZ0JBQWUsRUFDZkMsY0FBQUEsRUFDQUMsY0FBQUEsRUFDQUMsVUFBQUEsRUFDQUMsZ0JBQUFBLEVBQ0FDLFNBQUFBLEVBQ0FDLFFBQUFBLFFBYjRCQyxvQkF1QjlCLFdBQ0M1QyxPQUFBQSxLQThHQSxHQTFHQ29CLEVBSjJCVCxRQUszQmtDLEVBQVNDLGVBTGtCLENBTTNCQyxJQUFBQSxFQUNBQyxJQUFBQSxHQUNBQyxLQUFBQSxHQVIyQjdCLEtBQTVCLEVBVUF5QixRQUFBLE1BSkNFLEtBQU0sUUFNUjVDLGNBQWEsRUFFWjhDLGFBQVlDLElBSVgvQyxFQUFBRyxHQUFBLG1CQUFBLFdBSnFCLEtBQWxCUixFQUFFdUIsTUFBTTZCLE1BT2JwRCxFQUFBdUIsTUFBSWpCLFNBQUoscUJBRUUrQyxFQUFBQSxNQUFLNUMsWUFBRSx1QkFJTjZDLEVBQUl6QyxRQUNKMEMsV0FBQUEsTUFBUSxRQUxGLENBTU5DLE1BQUFBLENBTk1DLG9CQURrQixLQVN6QkMsZ0JBQU8sS0FDTmpDLFlBQU0sRUFEQTZCLEtBVGtCLE1BWXpCSyxPQUFBQSxDQUFPLEVBQUUsRUFBQSxFQUFBLEdBQ1JDLFFBQUFBLENBQUFBLEVBQVMsRUFERCxFQUFBLElBR1JDLE1BQUFBLENBSFFwQyxLQVpnQixJQWtCeEJxQyxRQUFHLENBQ0ZDLFFBQUFBLEVBQ0FDLFNBQUFBLEdBQ0FDLFlBQUFBLGlEQUFZQyxZQUhSLENBTUpDLElBQUFBLENBQ0FDLGtCQUFXLEVBQ1ZoRCxPQUFBQSxVQURVNkMsV0FQUCxDQVVKSSxTQUFBQSxHQUVEQyxjQUFRLEVBQ1BDLFVBQU0sQ0FDTEMsU0FBQUEsS0FBVUgsYUFESCxHQUtOSSxPQUFBQSxDQUNBQyxPQUFBQSxDQUNDQyxTQUFBQSxDQUNBQyxRQUFBQSxHQUpLQyxNQUpBLENBV1BDLFNBQUFBLEVBQ0NMLEtBQUFBLENBQ0FDLFFBQUFBLEdBQ0NDLEtBQUFBLElBSE1HLE9BQUEsQ0FYREwsU0FBQSxFQUREQyxLQUFBLENBOUJnQkMsUUFBQSxHQW9EekJJLEtBQU8sT0FNTkMsUUFBSSxDQUNIQyxTQUFBQSxHQUVBQyxPQUFBQSxDQUFBQSxDQUNBQyxLQUFBQSxTQUpNQyxjQUtKLEVBQ0ZILEtBQUFBLENBQUFBLENBQ0FJLEtBQUMsU0FGQ0EsRUFBQSxNQUlGSixRQUFBQSxFQUNBSSxVQUFHLEdBRkQsQ0FJRkosS0FBQUEsb0JBQ0FJLEVBQUFBLE9BRkUsQ0FJRkosS0FBQUEsVUFDQUksRUFBQUEsT0FGRSxDQUlGSixLQUFBQSxPQUNBSSxFQUFBQSxNQUZFLENBcEJLSixLQUFELFNBdkRUSSxFQUFBLE1BaUZBLENBTEdKLEtBQU0sUUFPVkksRUFBSUMsV0FLSEEsRUFBSUMsT0FBVyxDQUNkN0QsSUFBQUEsRUFBY3RCLEVBQURlLEtBQVksd0JBQ3pCb0UsRUFBQUMsRUFBQXpFLEtBQUEsV0FKS1gsRUFBWUosRUFBRSxhQU9uQnVGLEdBSkE3RCxFQUFjdEIsRUFBVyxRQVF4Qm9GLEVBQU1oRixHQUFBLFNBQUEsV0FDTmtCLEVBQUFBLEVBQWN0QixLQUFELFdBS2hCc0IsRUFBQXRCLEVBWENtRixFQVdELE9BTDRCLFVBd0NYLFNBQUE3RCxFQUFBVCxFQUFBd0UsR0FGYnhFLEVBSEhPLFFBQUEsQ0FVQW1ELFFBQUFjLEVBUkNDLE9BQVFELEdBVVYsQ0FDQ3JFLFNBQUl1RSxJQUNIQyxjQUFZLENBQ1pqQixRQUFNLFNBQ05nQixPQUFBQSxXQXZDRHZGLGdCQTZDQXVGLFVBQUFFLGNBQUFDLFdBRUNDLFFBaFBGQyxJQUFBLGtFQXdPRUwsVUFBVUUsY0FBY0ksU0FBUyxXQUFZLENBQzVDQyxNQUFPLE9BQ0xDLEtBQUssU0FBU0MsR0FDaEJSLFFBQVFJLElBQUksZ0RBQWlESSxFQUFJRixTQTNPckUsQ0FnUEdIIiwiZmlsZSI6Im1haW4uanMiLCJzb3VyY2VzQ29udGVudCI6WyIvKlxuICogVGhpcmQgcGFydHlcbiAqL1xuXG5cblxuLypcbiAqIEN1c3RvbVxuICovXG47KGZ1bmN0aW9uICgkKSB7XG5cblx0Y29uc3QgJGJvZHkgPSAkKFwiYm9keVwiKTtcblx0Y29uc3QgJHJhbmdlU2xpZGVyID0gJChcIi5qcy1yYW5nZS1zbGlkZXJcIik7XG5cdGNvbnN0ICRyYW5nZUNhbGVuZGFyID0gJChcIiNyYW5nZS1jYWxlbmRhclwiKTtcblx0Y29uc3QgJGNvdW50ZXJzID0gJCgnLmNvdW50ZXInKTtcblx0Y29uc3QgJGlucHV0TmFvID0gJCgnLmlucHV0LW5hb19fZmllbGQnKTtcblx0Y29uc3QgJGNoYXJ0ID0gJCgnLmNoYXJ0Jyk7XG5cdGNvbnN0ICRzd2l0Y2ggPSAkKCcuc3dpdGNoLnN3aXRjaC1zbScpO1xuXG5cdCQod2luZG93KS5vbignbG9hZCcsIGZ1bmN0aW9uICgpIHtcblx0XHRjb25zdCAkcHJlbG9hZGVyID0gJChcIi5wcmVsb2FkZXJcIik7XG5cblx0XHQkcHJlbG9hZGVyLnJlbW92ZUNsYXNzKCdsb2FkaW5nJylcblx0fSk7XG5cblx0JCh3aW5kb3cpLm9uKCdzY3JvbGwnLCBmdW5jdGlvbigpIHtcblx0XHRjb25zdCAkc3RpY2t5ID0gJCgnLnN0aWNreScpO1xuXHRcdGxldCBzY3JvbGwgPSAkKHdpbmRvdykuc2Nyb2xsVG9wKCk7XG5cblx0XHRpZiAoc2Nyb2xsID4gMCkge1xuXHRcdFx0JHN0aWNreS5hZGRDbGFzcygnZml4ZWQnKTtcblx0XHR9IGVsc2Uge1xuXHRcdFx0JHN0aWNreS5yZW1vdmVDbGFzcygnZml4ZWQnKTtcblx0XHR9XG5cblx0fSk7XG5cblx0aWYgKCRjb3VudGVycy5sZW5ndGgpIHtcblx0XHRjb3VudGVyKCk7XG5cdH1cblxuXHRpZiAoJHJhbmdlQ2FsZW5kYXIubGVuZ3RoKSB7XG5cdFx0bGV0IHJ1ID0gJ3J1Jztcblx0XHRsZXQgY3VycmVudERhdGUgPSBtb21lbnQoKTtcblx0XHRsZXQgZW5kRGF0ZSA9IG1vbWVudCgpLmFkZCgnbW9udGhzJywgMTIpO1xuXG5cdFx0JHJhbmdlQ2FsZW5kYXIucmFuZ2VDYWxlbmRhcih7XG5cdFx0XHRsYW5nOiBydSxcblx0XHRcdHRoZW1lOlwiZGVmYXVsdC10aGVtZVwiLFxuXHRcdFx0dGhlbWVDb250ZXh0OiB0aGlzLFxuXHRcdFx0c3RhcnREYXRlOiBjdXJyZW50RGF0ZSxcblx0XHRcdGVuZERhdGU6IGVuZERhdGUsXG5cdFx0XHRzdGFydCA6XCIrN1wiLFxuXHRcdFx0c3RhcnRSYW5nZVdpZHRoIDogMSxcblx0XHRcdG1pblJhbmdlV2lkdGg6IDEsXG5cdFx0XHRtYXhSYW5nZVdpZHRoOiAxLFxuXHRcdFx0d2Vla2VuZHM6IHRydWUsXG5cdFx0XHRhdXRvSGlkZU1vbnRoczogZmFsc2UsXG5cdFx0XHR2aXNpYmxlOiB0cnVlLFxuXHRcdFx0dHJpZ2dlcjogJ2NsaWNrJyxcblxuXHRcdFx0Y2hhbmdlUmFuZ2VDYWxsYmFjayA6IHJhbmdlQ2hhbmdlZFxuXHRcdH0pO1xuXG5cdFx0ZnVuY3Rpb24gcmFuZ2VDaGFuZ2VkKHRhcmdldCxyYW5nZSl7XG5cdFx0XHRyZXR1cm4gZmFsc2U7XG5cdFx0fVxuXHR9XG5cblx0aWYgKCRyYW5nZVNsaWRlci5sZW5ndGgpIHtcblx0XHQkcmFuZ2VTbGlkZXIuaW9uUmFuZ2VTbGlkZXIoe1xuXHRcdFx0bWluOiAwLFxuXHRcdFx0bWF4OiAyNCxcblx0XHRcdGZyb206IDE3LFxuXHRcdFx0c3RlcDogMSxcblx0XHRcdHBvc3RmaXg6IFwiLjAwXCIsXG5cdFx0XHRza2luOiAncm91bmQnLFxuXHRcdFx0aGlkZV9taW5fbWF4OiB0cnVlLFxuXHRcdFx0aGlkZV9taW5fdG86IHRydWVcblx0XHR9KTtcblx0fVxuXG5cdCRpbnB1dE5hby5vbignZm9jdXMgYmx1ciBpbnB1dCcsIGZ1bmN0aW9uKCkge1xuXG5cdFx0aWYgKCQodGhpcykudmFsKCkgIT09ICcnKSB7XG5cdFx0XHQkKHRoaXMpLmFkZENsYXNzKCdpbnB1dC1uYW9fX2ZpbGxlZCcpO1xuXHRcdH0gZWxzZSB7XG5cdFx0XHQkKHRoaXMpLnJlbW92ZUNsYXNzKCdpbnB1dC1uYW9fX2ZpbGxlZCcpO1xuXHRcdH1cblx0fSk7XG5cblx0aWYgKCRjaGFydC5sZW5ndGgpIHtcblx0XHRIaWdoY2hhcnRzLmNoYXJ0KCdjaGFydCcsIHtcblx0XHRcdGNoYXJ0OiB7XG5cdFx0XHRcdHBsb3RCYWNrZ3JvdW5kQ29sb3I6IG51bGwsXG5cdFx0XHRcdHBsb3RCb3JkZXJXaWR0aDogbnVsbCxcblx0XHRcdFx0cGxvdFNoYWRvdzogZmFsc2UsXG5cdFx0XHRcdHR5cGU6ICdwaWUnLFxuXHRcdFx0XHRtYXJnaW46IFswLCAwLCAwLCAwXSxcblx0XHRcdFx0c3BhY2luZzogWzAsIDAsIDAsIDBdLFxuXHRcdFx0fSxcblx0XHRcdHRpdGxlOiB7XG5cdFx0XHRcdHRleHQ6ICcnXG5cdFx0XHR9LFxuXHRcdFx0dG9vbHRpcDoge1xuXHRcdFx0XHRwYWRkaW5nOiA0LFxuXHRcdFx0XHRkaXN0YW5jZTogMjQsXG5cdFx0XHRcdHBvaW50Rm9ybWF0OiAne3Nlcmllcy5uYW1lfTogPGI+e3BvaW50LnBlcmNlbnRhZ2U6LjFmfSU8L2I+J1xuXHRcdFx0fSxcblx0XHRcdHBsb3RPcHRpb25zOiB7XG5cdFx0XHRcdHBpZToge1xuXHRcdFx0XHRcdGFsbG93UG9pbnRTZWxlY3Q6IHRydWUsXG5cdFx0XHRcdFx0Y3Vyc29yOiAncG9pbnRlcicsXG5cdFx0XHRcdFx0ZGF0YUxhYmVsczoge1xuXHRcdFx0XHRcdFx0ZW5hYmxlZDogZmFsc2Vcblx0XHRcdFx0XHR9LFxuXHRcdFx0XHRcdHNob3dJbkxlZ2VuZDogZmFsc2UsXG5cdFx0XHRcdFx0YW5pbWF0aW9uOiB7XG5cdFx0XHRcdFx0XHRkdXJhdGlvbjogNTAwXG5cdFx0XHRcdFx0fSxcblx0XHRcdFx0XHRzbGljZWRPZmZzZXQ6IDQsXG5cdFx0XHRcdH0sXG5cdFx0XHRcdHNlcmllczoge1xuXHRcdFx0XHRcdHN0YXRlczoge1xuXHRcdFx0XHRcdFx0aW5hY3RpdmU6IHtcblx0XHRcdFx0XHRcdFx0b3BhY2l0eTogMVxuXHRcdFx0XHRcdFx0fSxcblx0XHRcdFx0XHRcdGhvdmVyOiB7XG5cdFx0XHRcdFx0XHRcdGVuYWJsZWQ6IHRydWUsXG5cdFx0XHRcdFx0XHRcdGhhbG86IHtcblx0XHRcdFx0XHRcdFx0XHRvcGFjaXR5OiAwLjUsXG5cdFx0XHRcdFx0XHRcdFx0c2l6ZTogNFxuXHRcdFx0XHRcdFx0XHR9XG5cdFx0XHRcdFx0XHR9LFxuXHRcdFx0XHRcdFx0c2VsZWN0OiB7XG5cdFx0XHRcdFx0XHRcdGVuYWJsZWQ6IHRydWUsXG5cdFx0XHRcdFx0XHRcdGhhbG86IHtcblx0XHRcdFx0XHRcdFx0XHRvcGFjaXR5OiAwLjUsXG5cdFx0XHRcdFx0XHRcdFx0c2l6ZTogNFxuXHRcdFx0XHRcdFx0XHR9XG5cdFx0XHRcdFx0XHR9XG5cdFx0XHRcdFx0fVxuXHRcdFx0XHR9XG5cdFx0XHR9LFxuXHRcdFx0Y3JlZGl0czoge1xuXHRcdFx0XHRlbmFibGVkOiBmYWxzZVxuXHRcdFx0fSxcblx0XHRcdHNlcmllczogW3tcblx0XHRcdFx0bmFtZTogJ0JyYW5kcycsXG5cdFx0XHRcdGNvbG9yQnlQb2ludDogdHJ1ZSxcblx0XHRcdFx0ZGF0YTogW3tcblx0XHRcdFx0XHRuYW1lOiAnQ2hyb21lJyxcblx0XHRcdFx0XHR5OiA2MS40MSxcblx0XHRcdFx0XHRzbGljZWQ6IGZhbHNlLFxuXHRcdFx0XHRcdHNlbGVjdGVkOiBmYWxzZVxuXHRcdFx0XHR9LCB7XG5cdFx0XHRcdFx0bmFtZTogJ0ludGVybmV0IEV4cGxvcmVyJyxcblx0XHRcdFx0XHR5OiAxMS44NFxuXHRcdFx0XHR9LCB7XG5cdFx0XHRcdFx0bmFtZTogJ0ZpcmVmb3gnLFxuXHRcdFx0XHRcdHk6IDEwLjg1XG5cdFx0XHRcdH0sIHtcblx0XHRcdFx0XHRuYW1lOiAnRWRnZScsXG5cdFx0XHRcdFx0eTogNC42N1xuXHRcdFx0XHR9LCB7XG5cdFx0XHRcdFx0bmFtZTogJ1NhZmFyaScsXG5cdFx0XHRcdFx0eTogNC4xOFxuXHRcdFx0XHR9LCB7XG5cdFx0XHRcdFx0bmFtZTogJ090aGVyJyxcblx0XHRcdFx0XHR5OiA3LjA1XG5cdFx0XHRcdH1dXG5cdFx0XHR9XSxcblx0XHR9KTtcblx0fVxuXG5cdGlmICgkc3dpdGNoLmxlbmd0aCkge1xuXHRcdGNvbnN0IHN3aXRjaElucHV0ID0gJHN3aXRjaC5maW5kKCdpbnB1dFt0eXBlPWNoZWNrYm94XScpO1xuXHRcdGxldCBpc0NoZWNrZWQgPSBzd2l0Y2hJbnB1dC5wcm9wKCdjaGVja2VkJyk7XG5cdFx0Y29uc3QgJGNvdW50ZXJzID0gJChcIiNjb3VudGVyc1wiKTtcblxuXHRcdGlmIChpc0NoZWNrZWQpIHtcblx0XHRcdHRvZ2dsZUFuaW1hdGUoJGNvdW50ZXJzLCBcImhpZGVcIik7XG5cdFx0fVxuXG5cdFx0c3dpdGNoSW5wdXQub24oJ2NoYW5nZScsIGZ1bmN0aW9uICgpIHtcblx0XHRcdGlzQ2hlY2tlZCA9IHN3aXRjaElucHV0LnByb3AoJ2NoZWNrZWQnKTtcblxuXHRcdFx0aWYgKGlzQ2hlY2tlZCkge1xuXHRcdFx0XHR0b2dnbGVBbmltYXRlKCRjb3VudGVycywgXCJoaWRlXCIpO1xuXHRcdFx0fSBlbHNlIHtcblx0XHRcdFx0dG9nZ2xlQW5pbWF0ZSgkY291bnRlcnMsIFwic2hvd1wiKTtcblx0XHRcdH1cblx0XHR9KTtcblx0fVxuXG5cdC8vIHN2ZyBwb2x5ZmlsbCBmb3Igb2xkIGJyb3dzZXJzXG5cdHN2ZzRldmVyeWJvZHkoKTtcblxuXHQvLyBQV0EgaW5pdFxuXHRjb25kaXRpb25QV0EoKTtcblxuXHRmdW5jdGlvbiBjb3VudGVyKCkge1xuXHRcdCRjb3VudGVycy5lYWNoKGZ1bmN0aW9uIChpbmRleCwgZWxlbSkge1xuXHRcdFx0Y29uc3QgY2lyY2xlID0gJChlbGVtKS5maW5kKCcuY291bnRlcl9fY2lyY2xlLXZhbHVlJyk7XG5cblx0XHRcdHNldFRpbWVvdXQoZnVuY3Rpb24gKCkge1xuXHRcdFx0XHRjaXJjbGUuYXR0cignc3Ryb2tlLWRhc2hvZmZzZXQnLCAwKTtcblx0XHRcdH0sIDUwMCk7XG5cblx0XHRcdCQoZWxlbSkuZmluZCgnc3BhbicpLmVhY2goZnVuY3Rpb24gKCkge1xuXHRcdFx0XHQkKHRoaXMpLnByb3AoJ0NvdW50ZXInLCAwKS5hbmltYXRlKHtcblx0XHRcdFx0XHRDb3VudGVyOiAkKHRoaXMpLnRleHQoKVxuXHRcdFx0XHR9LCB7XG5cdFx0XHRcdFx0ZHVyYXRpb246IDE1MDAsXG5cdFx0XHRcdFx0ZWFzaW5nOiAnc3dpbmcnLFxuXHRcdFx0XHRcdHN0ZXA6IGZ1bmN0aW9uIChub3cpIHtcblx0XHRcdFx0XHRcdCQodGhpcykudGV4dChNYXRoLmNlaWwobm93KSk7XG5cdFx0XHRcdFx0fVxuXHRcdFx0XHR9KTtcblx0XHRcdH0pO1xuXHRcdH0pO1xuXHR9XG5cblxuXHRmdW5jdGlvbiB0b2dnbGVBbmltYXRlKGVsZW0sIHBhcmFtKSB7XG5cdFx0ZWxlbS5hbmltYXRlKHtcblx0XHRcdG9wYWNpdHk6IHBhcmFtLFxuXHRcdFx0aGVpZ2h0OiBwYXJhbVxuXHRcdH0sIHtcblx0XHRcdGR1cmF0aW9uOiA1MDAsXG5cdFx0XHRzcGVjaWFsRWFzaW5nOiB7XG5cdFx0XHRcdG9wYWNpdHk6ICdsaW5lYXInLFxuXHRcdFx0XHRoZWlnaHQ6ICdzd2luZydcblx0XHRcdH1cblx0XHR9KVxuXHR9XG5cblx0ZnVuY3Rpb24gY29uZGl0aW9uUFdBKCkge1xuXHRcdGlmIChuYXZpZ2F0b3Iuc2VydmljZVdvcmtlci5jb250cm9sbGVyKSB7XG5cdFx0XHRjb25zb2xlLmxvZygnW1BXQSBCdWlsZGVyXSBhY3RpdmUgc2VydmljZSB3b3JrZXIgZm91bmQsIG5vIG5lZWQgdG8gcmVnaXN0ZXInKVxuXHRcdH0gZWxzZSB7XG5cdFx0XHRuYXZpZ2F0b3Iuc2VydmljZVdvcmtlci5yZWdpc3RlcignanMvc3cuanMnLCB7XG5cdFx0XHRcdHNjb3BlOiAnLi8nXG5cdFx0XHR9KS50aGVuKGZ1bmN0aW9uKHJlZykge1xuXHRcdFx0XHRjb25zb2xlLmxvZygnU2VydmljZSB3b3JrZXIgaGFzIGJlZW4gcmVnaXN0ZXJlZCBmb3Igc2NvcGU6JysgcmVnLnNjb3BlKTtcblx0XHRcdH0pO1xuXHRcdH1cblx0fVxuXG59KShqUXVlcnkpOyJdfQ==