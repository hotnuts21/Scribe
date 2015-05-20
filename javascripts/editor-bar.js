  /* ===================================================
 * Editor bar JS
 * Adds an editor bar to the omeka scribe template.
 * Licensed under MIT licence.
 * ==================================================*/
jQuery("document").ready(function($){


  $('#head').on('click', function () {
      _insertAtCaret($('#scripto-transcription-page-wikitext'), "<head>  </head>", "<head>", "</head>");
  });

  $('#lb').on('click', function () {
      _insertAtCaret($('#scripto-transcription-page-wikitext'), "<lb/>", "","<lb>");
  });

  $('#add').on('click', function () {
      _insertAtCaret($('#scripto-transcription-page-wikitext'), "<add> </add>", "<add>", "</add>");
  });
  $('#del').on('click', function () {
      _insertAtCaret($('#scripto-transcription-page-wikitext'), "<del> </del>", "<del>", "</del>");
  });
  $('#subst').on('click', function () {
      _insertAtCaret($('#scripto-transcription-page-wikitext'), "<subst> </subst>", "<subst>", "</subst>");
  });
  $('#gap').on('click', function () {
      _insertAtCaret($('#scripto-transcription-page-wikitext'), "<gap/>", "","<gap/>");
  });
  $('#unclear').on('click', function () {
      _insertAtCaret($('#scripto-transcription-page-wikitext'), "<unclear>  </unclear>", "<unclear>","</unclear>");
  });
  $('#note').on('click', function () {
      _insertAtCaret($('#scripto-transcription-page-wikitext'), "<note>  </note>","<note>","</note>");
  });
  $('#subs').on('click', function () {
      _insertAtCaret($('#scripto-transcription-page-wikitext'), "<hi rend='superscript'>  </hi>","<hi rend='superscript'>","</hi>");
  });
  $('#sic').on('click', function () {
      _insertAtCaret($('#scripto-transcription-page-wikitext'), "<sic>  </sic>","<sic>","</sic>");
  });
  $('#foreign').on('click', function () {
      _insertAtCaret($('#scripto-transcription-page-wikitext'), "<foreign>  </foreign>","<foreign>","</foreign>");
  });
  $('#und').on('click', function () {
      _insertAtCaret($('#scripto-transcription-page-wikitext'), "<hi>  </hi>","<hi>","</hi>");
  });
  $('#person').on('click', function () {
      _insertAtCaret($('#scripto-transcription-page-wikitext'), "<person>  </person>","<person>","</person>");
  });
  $('#place').on('click', function () {
      _insertAtCaret($('#scripto-transcription-page-wikitext'), "<place>  </place>","<place>","</place>");
  });




    function _insertAtCaret(element, text, textBefore, textAfter) {
        var el = element[0];
        var start = el.selectionStart;
        var end = el.selectionEnd;
        var newStart = start;
        var newEnd = end;
        var val = el.value;
        var beforeSel = val.slice(0, start);
        var afterSel = val.slice(end);
        if (start == end) {
            el.value = beforeSel + text + afterSel;
            newEnd += text.length;
        } else {
            el.value = beforeSel + textBefore + val.slice(start, end) + textAfter + afterSel;
            newStart += textBefore.length;
            newEnd = newStart + end - start;
        }
        el.setSelectionRange(newStart, newEnd);
    }

})
