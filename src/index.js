import { Flex } from '@wordpress/components'

import "./index.scss";

wp.blocks.registerBlockType('gutenberg-page-list/gutenberg-page-list', {
  title: 'Page List',
  icon: 'editor-ul',
  category: 'common',
  description: "Gutenberg Page List",
  edit: EditComponent,
  save: (props) => { return null }
});

function EditComponent(props) {
  return (
    <div className="page-list">
      <Flex align="center">Page List</Flex>
    </div>
  )
}