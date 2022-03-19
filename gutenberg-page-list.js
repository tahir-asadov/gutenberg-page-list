wp.blocks.registerBlockType('gutenberg-page-list/gutenberg-page-list', {
  title: 'Gutenberg Page List',
  icon: 'hammer',
  category: 'common',
  edit: function() {
    return wp.element.createElement('h3', null, 'Gutenberg Page List');
  },
  save: function() {
    return wp.element.createElement('h3', null, 'Gutenberg Page List Front end');
  }
});