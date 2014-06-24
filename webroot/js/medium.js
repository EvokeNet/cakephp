var editor = new MediumEditor('.editable');

$(function () {
  $('.editable').mediumInsert({
    editor: editor,
    addons: {
      images: {},
      embeds: {}
    }
  });
});